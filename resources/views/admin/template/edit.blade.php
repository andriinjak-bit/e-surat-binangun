@extends('layouts.app')

@section('content')
<!-- Custom Styles for Tiptap Editor -->
<style>
    .ProseMirror {
        min-height: 400px;
        outline: none;
        padding: 1rem;
    }
    .ProseMirror p { margin-bottom: 1em; }
    .ProseMirror p.is-editor-empty:first-child::before {
        content: attr(data-placeholder);
        float: left;
        color: #adb5bd;
        pointer-events: none;
        height: 0;
    }
</style>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#0B2E4F]">Edit Template: {{ $template->judul }}</h1>
        <a href="{{ route('admin.template.index') }}" class="text-gray-500 hover:text-gray-700">Kembali</a>
    </div>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.template.update', $template->id) }}" method="POST" id="templateForm">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Editor -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Judul Template -->
                <div class="bg-white p-6 rounded-xl shadow">
                    <label class="block text-sm font-bold text-[#0B2E4F] mb-2">Judul Surat</label>
                    <input type="text" name="judul" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Surat Keterangan Tidak Mampu" value="{{ old('judul', $template->judul) }}">
                </div>

                <!-- Tiptap Editor Container -->
                <div class="bg-white p-6 rounded-xl shadow">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-bold text-[#0B2E4F]">Konten Surat</label>
                        <span class="text-xs text-gray-500">Gunakan <code class="bg-gray-100 px-1 py-0.5 rounded text-red-500">@{{nama_variabel}}</code> untuk input dinamis.</span>
                    </div>
                    
                    <!-- Editor Toolbar -->
                    <div class="border border-b-0 border-gray-300 bg-gray-50 rounded-t-lg p-2 flex gap-2 flex-wrap">
                        <button type="button" id="btn-bold" class="px-3 py-1 bg-white border border-gray-300 rounded hover:bg-gray-100 font-bold">B</button>
                        <button type="button" id="btn-italic" class="px-3 py-1 bg-white border border-gray-300 rounded hover:bg-gray-100 italic">I</button>
                        <button type="button" id="btn-strike" class="px-3 py-1 bg-white border border-gray-300 rounded hover:bg-gray-100 line-through">S</button>
                        <div class="border-l border-gray-300 mx-1"></div>
                        <button type="button" id="btn-align-left" class="px-3 py-1 bg-white border border-gray-300 rounded hover:bg-gray-100" title="Rata Kiri"><i class="fas fa-align-left"></i> Kiri</button>
                        <button type="button" id="btn-align-center" class="px-3 py-1 bg-white border border-gray-300 rounded hover:bg-gray-100" title="Rata Tengah"><i class="fas fa-align-center"></i> Tengah</button>
                        <button type="button" id="btn-align-right" class="px-3 py-1 bg-white border border-gray-300 rounded hover:bg-gray-100" title="Rata Kanan"><i class="fas fa-align-right"></i> Kanan</button>
                        <div class="border-l border-gray-300 mx-1"></div>
                        <button type="button" id="btn-image" class="px-3 py-1 bg-white border border-gray-300 rounded hover:bg-gray-100">
                            <i class="fas fa-image"></i> Kop/Gambar
                        </button>
                    </div>
                    
                    <!-- Editor Wrapper -->
                    <div id="tiptap-editor" class="border border-gray-300 rounded-b-lg bg-white overflow-hidden text-sm"></div>
                    
                    <!-- Hidden Textarea to submit HTML data to Laravel -->
                    <textarea name="body" id="body-content" class="hidden">{!! old('body', $template->body) !!}</textarea>
                </div>
            </div>

            <!-- Kolom Konfigurasi Variabel JSON Schema -->
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-xl shadow sticky top-6">
                    <h3 class="text-lg font-bold text-[#0B2E4F] mb-4">Konfigurasi Variabel</h3>
                    <p class="text-xs text-gray-500 mb-4">Daftarkan variabel yang Anda tulis di editor. Variabel ini akan menjadi form input bagi User.</p>
                    
                    <div id="variables-container" class="space-y-4">
                        <!-- Variables will be injected here via JS -->
                    </div>

                    <button type="button" id="add-variable-btn" class="mt-4 w-full border-2 border-dashed border-gray-300 text-gray-600 py-2 rounded-lg hover:border-blue-500 hover:text-blue-500 transition">
                        + Tambah Variabel
                    </button>

                    <hr class="my-6">
                    
                    <button type="submit" class="w-full bg-[#E8A317] text-[#061E33] px-4 py-3 rounded-lg hover:bg-[#F4C542] font-bold">
                        Update Template
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Tiptap ES Module Script via esm.sh -->
<script type="module">
    import { Editor } from 'https://esm.sh/@tiptap/core@2.2.4';
    import StarterKit from 'https://esm.sh/@tiptap/starter-kit@2.2.4';
    import Placeholder from 'https://esm.sh/@tiptap/extension-placeholder@2.2.4';
    import Image from 'https://esm.sh/@tiptap/extension-image@2.2.4';
    import TextAlign from 'https://esm.sh/@tiptap/extension-text-align@2.2.4';

    const hiddenBody = document.getElementById('body-content');

    const editor = new Editor({
        element: document.getElementById('tiptap-editor'),
        extensions: [
            StarterKit,
            Image,
            TextAlign.configure({
                types: ['heading', 'paragraph'],
            }),
            Placeholder.configure({
                placeholder: 'Ketik isi surat di sini... Gunakan @{{nama_variabel}} untuk form dinamis.',
            }),
        ],
        content: hiddenBody.value,
        onUpdate: ({ editor }) => {
            hiddenBody.value = editor.getHTML();
        },
    });

    // Toolbar logic
    document.getElementById('btn-bold').addEventListener('click', () => {
        editor.chain().focus().toggleBold().run();
    });
    document.getElementById('btn-italic').addEventListener('click', () => {
        editor.chain().focus().toggleItalic().run();
    });
    document.getElementById('btn-strike').addEventListener('click', () => {
        editor.chain().focus().toggleStrike().run();
    });
    document.getElementById('btn-align-left').addEventListener('click', () => {
        editor.chain().focus().setTextAlign('left').run();
    });
    document.getElementById('btn-align-center').addEventListener('click', () => {
        editor.chain().focus().setTextAlign('center').run();
    });
    document.getElementById('btn-align-right').addEventListener('click', () => {
        editor.chain().focus().setTextAlign('right').run();
    });
    document.getElementById('btn-image').addEventListener('click', () => {
        const url = window.prompt('Masukkan URL Gambar / Kop Surat (Bisa Data URL Base64):');
        if (url) {
            editor.chain().focus().setImage({ src: url }).run();
        }
    });

    // ==========================================
    // JSON SCHEMA BUILDER LOGIC
    // ==========================================
    const container = document.getElementById('variables-container');
    const addBtn = document.getElementById('add-variable-btn');
    let varIndex = 0;

    function addVariableRow(name = '', type = 'text', label = '') {
        const row = document.createElement('div');
        row.className = 'border border-gray-200 p-3 rounded-lg bg-gray-50 relative';
        
        row.innerHTML = `
            <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-xs font-bold" onclick="this.parentElement.remove()">X</button>
            <div class="mb-2">
                <label class="text-xs font-bold text-gray-700">Nama Variabel (Sesuai di Editor)</label>
                <input type="text" name="variables[${varIndex}][name]" value="${name}" placeholder="Contoh: nama_lengkap" required class="w-full text-sm border-gray-300 rounded p-1">
            </div>
            <div class="mb-2">
                <label class="text-xs font-bold text-gray-700">Label Form (Untuk User)</label>
                <input type="text" name="variables[${varIndex}][label]" value="${label}" placeholder="Contoh: Nama Lengkap" required class="w-full text-sm border-gray-300 rounded p-1">
            </div>
            <div>
                <label class="text-xs font-bold text-gray-700">Tipe Input</label>
                <select name="variables[${varIndex}][type]" class="w-full text-sm border-gray-300 rounded p-1">
                    <option value="text" ${type === 'text' ? 'selected' : ''}>Teks Pendek</option>
                    <option value="textarea" ${type === 'textarea' ? 'selected' : ''}>Teks Panjang (Paragraf)</option>
                    <option value="date" ${type === 'date' ? 'selected' : ''}>Tanggal</option>
                    <option value="number" ${type === 'number' ? 'selected' : ''}>Angka</option>
                    <option value="signature" ${type === 'signature' ? 'selected' : ''}>Tanda Tangan (Signature Pad)</option>
                </select>
            </div>
        `;
        container.appendChild(row);
        varIndex++;
    }

    addBtn.addEventListener('click', () => addVariableRow());
    
    // Load existing variables from server
    const existingVariables = {!! json_encode(old('variables', $template->variables ?? [])) !!};
    
    if(existingVariables && Object.keys(existingVariables).length > 0) {
        // If it's an array (which our cast handles)
        if(Array.isArray(existingVariables)) {
            existingVariables.forEach(v => {
                addVariableRow(v.name || '', v.type || 'text', v.label || '');
            });
        } else {
            // Fallback if it's an object from request validation
            Object.values(existingVariables).forEach(v => {
                addVariableRow(v.name || '', v.type || 'text', v.label || '');
            });
        }
    } else {
        // Add first row by default if completely empty
        addVariableRow();
    }
</script>
@endsection

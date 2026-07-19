@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('layanan') }}" class="text-gray-500 hover:text-gray-700 text-sm">
            <i class="fas fa-arrow-left"></i> Kembali ke Layanan
        </a>
        <h1 class="text-2xl font-bold text-[#0B2E4F] mt-2">Pengajuan: {{ $template->judul }}</h1>
        <p class="text-gray-600 text-sm mt-1">Silakan lengkapi form berikut untuk mengajukan surat.</p>
    </div>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow p-6">
        <form action="{{ route('surat.request.store', $template->id) }}" method="POST" id="suratForm">
            @csrf
            
            <div class="space-y-6">
                @forelse($template->variables ?? [] as $field)
                    <div>
                        <label class="block text-sm font-bold text-[#0B2E4F] mb-1">
                            {{ $field['label'] }} <span class="text-red-500">*</span>
                        </label>
                        
                        @if($field['type'] === 'textarea')
                            <textarea name="form_data[{{ $field['name'] }}]" required rows="3" class="w-full border-gray-300 rounded-lg focus:ring-[#0B2E4F] focus:border-[#0B2E4F]">{{ old('form_data.'.$field['name']) }}</textarea>
                        
                        @elseif($field['type'] === 'date')
                            <input type="date" name="form_data[{{ $field['name'] }}]" required value="{{ old('form_data.'.$field['name']) }}" class="w-full border-gray-300 rounded-lg focus:ring-[#0B2E4F] focus:border-[#0B2E4F]">
                            
                        @elseif($field['type'] === 'number')
                            <input type="number" name="form_data[{{ $field['name'] }}]" required value="{{ old('form_data.'.$field['name']) }}" class="w-full border-gray-300 rounded-lg focus:ring-[#0B2E4F] focus:border-[#0B2E4F]">
                            
                        @elseif($field['type'] === 'signature')
                            <div class="border border-gray-300 rounded-lg p-2 bg-gray-50">
                                <p class="text-xs text-gray-500 mb-2">Silakan tanda tangan di dalam kotak di bawah ini (bisa menggunakan *touchscreen* atau *mouse*):</p>
                                <!-- Canvas wrapper with responsive aspect ratio handling -->
                                <div class="w-full bg-white border border-gray-200 rounded-lg overflow-hidden" style="touch-action: none;">
                                    <canvas id="canvas-{{ $field['name'] }}" class="w-full h-48 cursor-crosshair signature-pad"></canvas>
                                </div>
                                <button type="button" class="mt-2 text-xs text-red-500 hover:text-red-700 clear-signature" data-target="canvas-{{ $field['name'] }}">
                                    <i class="fas fa-eraser"></i> Bersihkan Tanda Tangan
                                </button>
                                <!-- Hidden input to store base64 -->
                                <input type="hidden" name="form_data[{{ $field['name'] }}]" id="input-{{ $field['name'] }}" required>
                            </div>
                            
                        @else
                            <input type="text" name="form_data[{{ $field['name'] }}]" required value="{{ old('form_data.'.$field['name']) }}" class="w-full border-gray-300 rounded-lg focus:ring-[#0B2E4F] focus:border-[#0B2E4F]">
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 italic">Template ini belum memiliki variabel dinamis yang perlu diisi.</p>
                @endforelse
            </div>
            
            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                <button type="submit" class="bg-[#0B2E4F] text-white px-6 py-2 rounded-lg font-bold hover:bg-[#1A4B7D] transition shadow-lg">
                    <i class="fas fa-paper-plane mr-2"></i> Ajukan Surat
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Signature Pad Library CDN -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const signaturePads = {};
    
    // Initialize all canvas elements with class signature-pad
    document.querySelectorAll('.signature-pad').forEach(canvas => {
        // To make it look sharp on high DPI screens
        function resizeCanvas() {
            const ratio =  Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }
        
        // Setup resizing
        window.addEventListener("resize", resizeCanvas);
        resizeCanvas();
        
        // Init signature pad
        const pad = new SignaturePad(canvas, {
            penColor: "black"
        });
        
        signaturePads[canvas.id] = pad;
        
        // Handle input update on draw end
        pad.addEventListener("endStroke", () => {
            const inputId = canvas.id.replace('canvas-', 'input-');
            document.getElementById(inputId).value = pad.toDataURL();
        });
    });
    
    // Clear buttons
    document.querySelectorAll('.clear-signature').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const inputId = targetId.replace('canvas-', 'input-');
            
            signaturePads[targetId].clear();
            document.getElementById(inputId).value = '';
        });
    });
    
    // Prevent submitting if signature is empty
    document.getElementById('suratForm').addEventListener('submit', function(e) {
        let isValid = true;
        
        Object.keys(signaturePads).forEach(id => {
            if (signaturePads[id].isEmpty()) {
                isValid = false;
                alert('Mohon isi semua tanda tangan yang diwajibkan!');
            } else {
                // Ensure data is synced before submit
                const inputId = id.replace('canvas-', 'input-');
                document.getElementById(inputId).value = signaturePads[id].toDataURL();
            }
        });
        
        if (!isValid) {
            e.preventDefault();
        }
    });
});
</script>
@endsection

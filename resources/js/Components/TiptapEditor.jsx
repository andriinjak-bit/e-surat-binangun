import React, { useEffect } from 'react';
import { useEditor, EditorContent } from '@tiptap/react';
import StarterKit from '@tiptap/starter-kit';
import Placeholder from '@tiptap/extension-placeholder';
import TextAlign from '@tiptap/extension-text-align';
import { Bold, Italic, Strikethrough, AlignLeft, AlignCenter, AlignRight } from 'lucide-react';

const MenuBar = ({ editor }) => {
    if (!editor) {
        return null;
    }

    return (
        <div className="bg-[#eef0e5] px-4 py-2 flex items-center gap-4 border-b border-gray-200 overflow-x-auto">
            <div className="flex items-center gap-1">
                <button
                    type="button"
                    onClick={() => editor.chain().focus().toggleBold().run()}
                    disabled={!editor.can().chain().focus().toggleBold().run()}
                    className={`p-1.5 rounded transition ${editor.isActive('bold') ? 'bg-gray-300 text-gray-900' : 'text-gray-700 hover:bg-gray-200'}`}
                >
                    <Bold size={16} />
                </button>
                <button
                    type="button"
                    onClick={() => editor.chain().focus().toggleItalic().run()}
                    disabled={!editor.can().chain().focus().toggleItalic().run()}
                    className={`p-1.5 rounded transition ${editor.isActive('italic') ? 'bg-gray-300 text-gray-900' : 'text-gray-700 hover:bg-gray-200'}`}
                >
                    <Italic size={16} />
                </button>
                <button
                    type="button"
                    onClick={() => editor.chain().focus().toggleStrike().run()}
                    disabled={!editor.can().chain().focus().toggleStrike().run()}
                    className={`p-1.5 rounded transition ${editor.isActive('strike') ? 'bg-gray-300 text-gray-900' : 'text-gray-700 hover:bg-gray-200'}`}
                >
                    <Strikethrough size={16} />
                </button>
            </div>
            <div className="w-px h-5 bg-gray-300"></div>
            <div className="flex items-center gap-1">
                <button
                    type="button"
                    onClick={() => editor.chain().focus().setTextAlign('left').run()}
                    className={`p-1.5 rounded transition ${editor.isActive({ textAlign: 'left' }) ? 'bg-gray-300 text-gray-900' : 'text-gray-700 hover:bg-gray-200'}`}
                >
                    <AlignLeft size={16} />
                </button>
                <button
                    type="button"
                    onClick={() => editor.chain().focus().setTextAlign('center').run()}
                    className={`p-1.5 rounded transition ${editor.isActive({ textAlign: 'center' }) ? 'bg-gray-300 text-gray-900' : 'text-gray-700 hover:bg-gray-200'}`}
                >
                    <AlignCenter size={16} />
                </button>
                <button
                    type="button"
                    onClick={() => editor.chain().focus().setTextAlign('right').run()}
                    className={`p-1.5 rounded transition ${editor.isActive({ textAlign: 'right' }) ? 'bg-gray-300 text-gray-900' : 'text-gray-700 hover:bg-gray-200'}`}
                >
                    <AlignRight size={16} />
                </button>
            </div>
        </div>
    );
};

export default function TiptapEditor({ value, onChange }) {
    const editor = useEditor({
        extensions: [
            StarterKit,
            TextAlign.configure({
                types: ['heading', 'paragraph'],
            }),
            Placeholder.configure({
                placeholder: 'Ketik isi surat di sini... Gunakan {{nama_variabel}} untuk form dinamis.',
            }),
        ],
        content: value,
        onUpdate: ({ editor }) => {
            onChange(editor.getHTML());
        },
        editorProps: {
            attributes: {
                class: 'prose prose-sm sm:prose-base prose-td:border-none prose-th:border-none prose-tr:border-none max-w-none focus:outline-none min-h-[300px] p-6 bg-white',
            },
        },
    });

    // Sync external value changes (like when loading initial data in Edit page)
    useEffect(() => {
        if (editor && value !== editor.getHTML()) {
            editor.commands.setContent(value, false);
        }
    }, [value, editor]);

    return (
        <div className="border border-gray-200 rounded-xl overflow-hidden mb-6 flex flex-col">
            <MenuBar editor={editor} />
            <div className="flex-grow overflow-y-auto">
                <EditorContent editor={editor} />
            </div>
        </div>
    );
}

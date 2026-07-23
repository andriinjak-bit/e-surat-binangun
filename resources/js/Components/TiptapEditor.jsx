import React, { useEffect } from 'react';
import { useEditor, EditorContent } from '@tiptap/react';
import StarterKit from '@tiptap/starter-kit';
import { Paragraph } from '@tiptap/extension-paragraph';
import { Placeholder } from '@tiptap/extension-placeholder';
import { TextAlign } from '@tiptap/extension-text-align';
import { Table } from '@tiptap/extension-table';
import { TableRow } from '@tiptap/extension-table-row';
import { TableCell } from '@tiptap/extension-table-cell';
import { TableHeader } from '@tiptap/extension-table-header';
import Image from '@tiptap/extension-image';
import { Bold, Italic, Strikethrough, AlignLeft, AlignCenter, AlignRight } from 'lucide-react';

const MenuBar = ({ editor }) => {
    if (!editor) return null;

    return (
        <div className="flex flex-wrap items-center gap-1 border-b border-gray-200 bg-gray-50/80 p-2 md:px-4 rounded-t-xl sticky top-0 z-10">
            <button
                onClick={(e) => { e.preventDefault(); editor.chain().focus().toggleBold().run() }}
                className={`p-2 rounded-lg transition-colors ${editor.isActive('bold') ? 'bg-[#e4ebd3] text-[#2b3a20]' : 'text-gray-600 hover:bg-gray-200'}`}
                title="Bold"
            >
                <Bold size={16} />
            </button>
            <button
                onClick={(e) => { e.preventDefault(); editor.chain().focus().toggleItalic().run() }}
                className={`p-2 rounded-lg transition-colors ${editor.isActive('italic') ? 'bg-[#e4ebd3] text-[#2b3a20]' : 'text-gray-600 hover:bg-gray-200'}`}
                title="Italic"
            >
                <Italic size={16} />
            </button>
            <button
                onClick={(e) => { e.preventDefault(); editor.chain().focus().toggleStrike().run() }}
                className={`p-2 rounded-lg transition-colors ${editor.isActive('strike') ? 'bg-[#e4ebd3] text-[#2b3a20]' : 'text-gray-600 hover:bg-gray-200'}`}
                title="Strikethrough"
            >
                <Strikethrough size={16} />
            </button>

            <div className="w-px h-6 bg-gray-300 mx-1"></div>

            <button
                onClick={(e) => { e.preventDefault(); editor.chain().focus().setTextAlign('left').run() }}
                className={`p-2 rounded-lg transition-colors ${editor.isActive({ textAlign: 'left' }) ? 'bg-[#e4ebd3] text-[#2b3a20]' : 'text-gray-600 hover:bg-gray-200'}`}
                title="Align Left"
            >
                <AlignLeft size={16} />
            </button>
            <button
                onClick={(e) => { e.preventDefault(); editor.chain().focus().setTextAlign('center').run() }}
                className={`p-2 rounded-lg transition-colors ${editor.isActive({ textAlign: 'center' }) ? 'bg-[#e4ebd3] text-[#2b3a20]' : 'text-gray-600 hover:bg-gray-200'}`}
                title="Align Center"
            >
                <AlignCenter size={16} />
            </button>
            <button
                onClick={(e) => { e.preventDefault(); editor.chain().focus().setTextAlign('right').run() }}
                className={`p-2 rounded-lg transition-colors ${editor.isActive({ textAlign: 'right' }) ? 'bg-[#e4ebd3] text-[#2b3a20]' : 'text-gray-600 hover:bg-gray-200'}`}
                title="Align Right"
            >
                <AlignRight size={16} />
            </button>
        </div>
    );
};

export default function TiptapEditor({ value, onChange, readOnly = false, variant = 'default' }) {
    const editor = useEditor({
        extensions: [
            StarterKit.configure({
                paragraph: false,
            }),
            Paragraph.extend({
                addAttributes() {
                    return {
                        ...this.parent?.(),
                        style: {
                            default: null,
                            parseHTML: element => element.getAttribute('style'),
                            renderHTML: attributes => {
                                if (!attributes.style) return {}
                                return { style: attributes.style }
                            },
                        },
                    }
                }
            }),
            TextAlign.configure({
                types: ['heading', 'paragraph', 'tableCell'],
            }),
            Placeholder.configure({
                placeholder: 'Ketik isi surat di sini... Gunakan {{nama_variabel}} untuk form dinamis.',
            }),
            Table.extend({
                addAttributes() {
                    return {
                        ...this.parent?.(),
                        style: {
                            default: null,
                            parseHTML: element => element.getAttribute('style'),
                            renderHTML: attributes => {
                                if (!attributes.style) return {}
                                return { style: attributes.style }
                            },
                        },
                    }
                }
            }).configure({
                resizable: true,
            }),
            TableRow,
            TableHeader,
            TableCell.extend({
                addAttributes() {
                    return {
                        ...this.parent?.(),
                        style: {
                            default: null,
                            parseHTML: element => element.getAttribute('style'),
                            renderHTML: attributes => {
                                if (!attributes.style) return {}
                                return { style: attributes.style }
                            },
                        },
                    }
                }
            }),
            Image.extend({
                addAttributes() {
                    return {
                        ...this.parent?.(),
                        style: {
                            default: null,
                            parseHTML: element => element.getAttribute('style'),
                            renderHTML: attributes => {
                                if (!attributes.style) return {}
                                return { style: attributes.style }
                            },
                        },
                    }
                }
            }),
        ],
        editable: !readOnly,
        content: value,
        onUpdate: ({ editor }) => {
            if (onChange) {
                onChange(editor.getHTML());
            }
        },
        editorProps: {
            attributes: {
                class: `prose prose-sm sm:prose-base prose-td:border-none prose-th:border-none prose-tr:border-none max-w-none focus:outline-none ${variant === 'document' ? 'p-0' : 'p-6 bg-white min-h-[300px]'}`,
            },
        },
    });

    useEffect(() => {
        if (editor && value !== editor.getHTML()) {
            editor.commands.setContent(value, false);
        }
    }, [value, editor]);

    return (
        <div className={`${variant === 'document' ? 'flex flex-col flex-grow' : 'rounded-xl overflow-hidden mb-6 flex flex-col'} ${readOnly ? 'bg-gray-50' : 'bg-white'}`}>
            {!readOnly && <MenuBar editor={editor} />}
            <div className="flex-grow overflow-y-auto">
                <EditorContent editor={editor} />
            </div>
        </div>
    );
}

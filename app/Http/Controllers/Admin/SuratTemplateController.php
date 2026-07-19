<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratTemplate;

class SuratTemplateController extends Controller
{
    public function index()
    {
        $templates = SuratTemplate::latest()->get();
        return view('admin.template.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.template.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'body' => 'required|string',
            'variables' => 'nullable|array',
        ]);

        SuratTemplate::create([
            'judul' => $request->judul,
            'body' => $request->body,
            'variables' => $request->variables ?? [],
        ]);

        return redirect()->route('admin.template.index')->with('success', 'Template berhasil disimpan.');
    }

    public function edit(SuratTemplate $template)
    {
        return view('admin.template.edit', compact('template'));
    }

    public function update(Request $request, SuratTemplate $template)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'body' => 'required|string',
            'variables' => 'nullable|array',
        ]);

        $template->update([
            'judul' => $request->judul,
            'body' => $request->body,
            'variables' => $request->variables ?? $template->variables,
        ]);

        return redirect()->route('admin.template.index')->with('success', 'Template berhasil diperbarui.');
    }

    public function destroy(SuratTemplate $template)
    {
        $template->delete();
        return redirect()->route('admin.template.index')->with('success', 'Template berhasil dihapus.');
    }
}
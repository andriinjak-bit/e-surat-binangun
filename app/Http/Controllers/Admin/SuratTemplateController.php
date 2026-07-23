<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratTemplate;

class SuratTemplateController extends Controller
{
    public function index(Request $request)
    {
        $query = SuratTemplate::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $templates = $query->latest()->paginate(5)->withQueryString();

        return \Inertia\Inertia::render('Admin/AdminTemplateSurat', [
            'templates' => $templates,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return \Inertia\Inertia::render('Admin/AdminTemplateSuratCreate');
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
        return \Inertia\Inertia::render('Admin/AdminTemplateSuratEdit', compact('template'));
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

        return redirect()->route('admin.template.index', [], 303)->with('success', 'Template berhasil diperbarui.');
    }

    public function destroy(SuratTemplate $template)
    {
        $template->delete();
        return redirect()->route('admin.template.index', [], 303)->with('success', 'Template berhasil dihapus.');
    }
}
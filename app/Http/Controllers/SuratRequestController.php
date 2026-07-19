<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratTemplate;
use App\Models\SuratRequest;

class SuratRequestController extends Controller
{
    public function create(SuratTemplate $template)
    {
        // View ini akan merender form dinamis berdasarkan $template->variables
        return view('surat.request.create', compact('template'));
    }

    public function store(Request $request, SuratTemplate $template)
    {
        // Validasi dasar
        $request->validate([
            'form_data' => 'required|array',
        ]);

        // Opsional: Validasi form_data berdasarkan $template->variables schema
        // ...

        $suratRequest = SuratRequest::create([
            'surat_template_id' => $template->id,
            'user_id' => auth()->id(),
            'status' => 'pending',
            'form_data' => $request->form_data,
        ]);

        return redirect()->route('surat.request.show', $suratRequest->id)
            ->with('success', 'Permintaan surat berhasil dikirim.');
    }

    public function show(SuratRequest $suratRequest)
    {
        $parser = new \App\Services\SuratParserService();
        $htmlOutput = $parser->parseTemplate($suratRequest->id);

        return view('surat.request.show', compact('suratRequest', 'htmlOutput'));
    }
}
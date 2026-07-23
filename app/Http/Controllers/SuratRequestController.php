<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratTemplate;
use App\Models\SuratRequest;

class SuratRequestController extends Controller
{
    public function create(SuratTemplate $template)
    {
        return \Inertia\Inertia::render('Surat/Request/Create', [
            'template' => $template
        ]);
    }

    public function store(Request $request, SuratTemplate $template)
    {
        $request->validate([
            'form_data' => 'required|array',
        ]);

        $suratRequest = SuratRequest::create([
            'surat_template_id' => $template->id,
            'user_id' => auth()->id(),
            'status' => 'pending',
            'form_data' => $request->form_data,
        ]);

        \App\Models\ActivityLog::record('PENGAJUAN SURAT', 'Warga ' . auth()->user()->name . ' mengajukan surat: ' . $template->nama);

        return redirect()->route('dashboard')
            ->with('success', 'Permohonan surat berhasil diajukan. Silakan cek status secara berkala.');
    }
}
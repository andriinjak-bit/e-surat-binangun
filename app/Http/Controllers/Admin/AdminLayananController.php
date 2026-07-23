<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratRequest;
use Inertia\Inertia;

class AdminLayananController extends Controller
{
    public function index(Request $request)
    {
        $query = SuratRequest::with(['user', 'template'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($qBuilder) use ($search) {
                $qBuilder->whereHas('user', function ($q) use ($search) {
                    $q->where('nik', 'like', "%{$search}%")
                        ->orWhereHas('penduduk', function ($q2) use ($search) {
                            $q2->where('nama', 'like', "%{$search}%");
                        });
                })->orWhere('id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status !== 'semua') {
                $query->where('status', $request->status);
            }
        }

        $suratRequests = $query->paginate(15)->withQueryString();

        $stats = [
            'semua' => SuratRequest::count(),
            'pending' => SuratRequest::where('status', 'pending')->count(),
            'diproses' => SuratRequest::where('status', 'diproses')->count(),
            'selesai' => SuratRequest::where('status', 'selesai')->count(),
            'ditolak' => SuratRequest::where('status', 'ditolak')->count(),
        ];

        return Inertia::render('Admin/AdminLayanan', [
            'suratRequests' => $suratRequests,
            'filters' => $request->only(['search', 'status']),
            'stats' => $stats
        ]);
    }

    public function detail(Request $request)
    {
        $id = $request->id;
        $suratRequest = SuratRequest::with(['user', 'template', 'comments.user'])->findOrFail($id);

        $parser = new \App\Services\SuratParserService();
        $htmlOutput = $parser->parseTemplate($suratRequest->id);

        return Inertia::render('Admin/AdminLayananDetail', [
            'suratRequest' => $suratRequest,
            'htmlOutput' => $htmlOutput
        ]);
    }

    public function approval(Request $request)
    {
        $id = $request->id;
        $suratRequest = SuratRequest::with(['user', 'template'])->findOrFail($id);

        return Inertia::render('Admin/AdminLayananApproval', [
            'suratRequest' => $suratRequest
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $suratRequest = SuratRequest::with(['user.penduduk', 'template'])->findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:diproses,ditolak',
            'alasan' => 'nullable|string'
        ]);

        $suratRequest->status = $validated['status'];

        if ($validated['status'] === 'ditolak' && !empty($validated['alasan'])) {
            $formData = $suratRequest->form_data ?? [];
            $formData['_alasan_tolak'] = $validated['alasan'];
            $suratRequest->form_data = $formData;
        }

        $suratRequest->save();

        $actionName = $validated['status'] === 'diproses' ? 'PROSES SURAT' : 'TOLAK SURAT';
        $desc = ($validated['status'] === 'diproses' ? 'Memproses pengajuan ' : 'Menolak pengajuan ') . $suratRequest->template->judul . ' milik warga ' . ($suratRequest->user->penduduk->nama ?? 'Anonim');
        \App\Models\ActivityLog::record($actionName, $desc);

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    public function uploadFinal(Request $request, $id)
    {
        $suratRequest = SuratRequest::with(['user.penduduk', 'template'])->findOrFail($id);

        $request->validate([
            'file_balasan' => 'required|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('file_balasan')) {
            $path = $request->file('file_balasan')->store('surat_balasan', 'public');

            $formData = $suratRequest->form_data ?? [];
            $formData['_file_balasan'] = $path;

            $suratRequest->form_data = $formData;
            $suratRequest->status = 'selesai';
            $suratRequest->save();

            \App\Models\ActivityLog::record('SELESAI SURAT', 'Mengunggah balasan surat ' . $suratRequest->template->judul . ' milik warga ' . ($suratRequest->user->penduduk->nama ?? 'Anonim'));
        }

        return redirect()->route('admin.layanan')->with('success', 'Surat balasan berhasil diunggah.');
    }

    public function addComment(Request $request, $id)
    {
        $suratRequest = SuratRequest::findOrFail($id);

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $formData = $suratRequest->form_data ?? [];
        $comments = $formData['_comments'] ?? [];

        $comments[] = [
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name,
            'is_admin' => auth()->user()->is_admin ?? true,
            'avatar' => auth()->user()->avatar,
            'message' => $request->message,
            'created_at' => now()->toISOString(),
        ];

        $formData['_comments'] = $comments;
        $suratRequest->form_data = $formData;
        $suratRequest->save();

        return redirect()->back();
    }
}

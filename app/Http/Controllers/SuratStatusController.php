<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratRequest;
use Inertia\Inertia;

class SuratStatusController extends Controller
{
    public function index(Request $request)
    {
        $query = SuratRequest::with(['template'])
            ->where('user_id', auth()->id())
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($qBuilder) use ($search) {
                $qBuilder->whereHas('template', function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%");
                })->orWhere('id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status !== 'semua') {
                $query->where('status', $request->status);
            }
        }

        $suratRequests = $query->paginate(10)->withQueryString();

        $stats = [
            'semua' => SuratRequest::where('user_id', auth()->id())->count(),
            'pending' => SuratRequest::where('user_id', auth()->id())->where('status', 'pending')->count(),
            'diproses' => SuratRequest::where('user_id', auth()->id())->where('status', 'diproses')->count(),
            'selesai' => SuratRequest::where('user_id', auth()->id())->where('status', 'selesai')->count(),
            'ditolak' => SuratRequest::where('user_id', auth()->id())->where('status', 'ditolak')->count(),
        ];

        return Inertia::render('Surat/Status/Index', [
            'suratRequests' => $suratRequests,
            'filters' => $request->only(['search', 'status']),
            'stats' => $stats
        ]);
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $suratRequest = SuratRequest::with(['template', 'comments.user'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);
        
        $parser = new \App\Services\SuratParserService();
        $htmlOutput = $parser->parseTemplate($suratRequest->id);

        return Inertia::render('Surat/Status/Show', [
            'suratRequest' => $suratRequest,
            'htmlOutput' => $htmlOutput
        ]);
    }

    public function addComment(Request $request, $id)
    {
        $suratRequest = SuratRequest::where('user_id', auth()->id())->findOrFail($id);
        
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $formData = $suratRequest->form_data ?? [];
        $comments = $formData['_comments'] ?? [];
        
        $comments[] = [
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->penduduk ? auth()->user()->penduduk->nama : auth()->user()->name,
            'is_admin' => false, // Warga is not admin
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

<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\AdminNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    // User: Show form
public function create()
{
    $user = Auth::user();
    return view('surat.create', compact('user'));
}

// public function download(Surat $surat)
// {
//     // This will open the same preview page used for printing
//     return view('surat.preview', compact('surat')); 
// }



public function store(Request $request)
{
    $jenis = $request->jenis_surat;
    
    // Get all form data
    $formData = $request->except(['_token', 'jenis_surat', 'action']);
    
    // Convert all null/empty values to empty string
    foreach ($formData as $key => $value) {
        if ($value === null || $value === '') {
            $formData[$key] = '';
        }
    }

    // DEBUG: See what's being saved (remove after testing)
    // dd($formData);

    $surat = Surat::create([
        'user_id' => Auth::id(),
        'jenis_surat' => $jenis,
        'form_data' => $formData,
        'status' => 'pending',
    ]);
    
    \App\Models\ActivityLog::record('Ajukan Surat', 'Mengajukan surat jenis: ' . $jenis);


    if ($request->action === 'submit') {
        $surat->update(['status' => 'diproses']);
        
        // Create notification for all admins
        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            AdminNotification::create([
                'user_id' => $admin->id,
                'type' => 'surat_submitted',
                'title' => 'Pengajuan Surat Baru',
                'message' => Auth::user()->name . ' telah mengajukan surat jenis ' . $jenis,
                'related_model' => 'Surat',
                'related_id' => $surat->id,
            ]);
        }
        
        return redirect()->route('surat.show', $surat)->with('success', 'Surat berhasil dikirim!');
    }

    return redirect()->route('surat.preview', $surat->id);
}

    // User: Preview surat

    // Admin: Review surat (accept/reject with comment)
public function adminReview(Request $request, Surat $surat)
{
    $request->validate([
        'status' => 'required|in:diterima,ditolak,revisi',
        'admin_comment' => 'nullable|string',
    ]);

    $data = [
        'status' => $request->status,
        'admin_comment' => $request->admin_comment,
        'reviewed_at' => now(),
    ];

    if ($request->status === 'diterima') {
        $data['accepted_at'] = now();
        $data['verified_at'] = now();
    } elseif ($request->status === 'ditolak') {
        $data['rejected_at'] = now();
    } elseif ($request->status === 'revisi') {
        $data['status'] = 'revisi';
    }

    $surat->update($data);

    return back()->with('success', 'Surat telah direview!');
}

// Admin: Add comment only
public function adminComment(Request $request, Surat $surat)
{
    $request->validate([
        'admin_comment' => 'required|string',
    ]);

    $surat->update([
        'admin_comment' => $request->admin_comment,
    ]);

    return back()->with('success', 'Komentar berhasil ditambahkan!');
}


public function preview(Surat $surat)
{
    if ($surat->user_id !== Auth::id() && !Auth::user()->is_admin) {
        abort(403);
    }
    
    // Get the user who created the surat
    $user = $surat->user; // This loads the user relationship
    
    return view('surat.preview', compact('surat', 'user'));
}


    // User: Confirm submit
    public function confirm(Surat $surat)
    {
        if ($surat->user_id !== Auth::id()) {
            abort(403);
        }

        $surat->update(['status' => 'diproses']);

        // Create notification for all admins
        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            AdminNotification::create([
                'user_id' => $admin->id,
                'type' => 'surat_submitted',
                'title' => 'Pengajuan Surat Baru',
                'message' => Auth::user()->name . ' telah mengajukan surat jenis ' . $surat->jenis_surat,
                'related_model' => 'Surat',
                'related_id' => $surat->id,
            ]);
        }

        return redirect()->route('surat.show', $surat)->with('success', 'Surat berhasil diajukan!');
    }

    // User: Show surat
    public function show(Surat $surat)
    {
        if ($surat->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        return view('surat.show', compact('surat'));
    }

    // User: Cancel/Revisi
    public function revisi(Request $request, Surat $surat)
    {
        if ($surat->user_id !== Auth::id()) {
            abort(403);
        }

        $surat->update([
            'status' => 'revisi',
            'admin_note' => null,
        ]);

        return redirect()->route('surat.create')->with('info', 'Silakan perbaiki data Anda.');
    }

    // ==========================================
    // ADMIN FUNCTIONS
    // ==========================================

    // Admin: List all surat
    public function index()
    {
        $surats = Surat::with('user')->latest()->get();
        return view('admin.surat-index', compact('surats'));
    }

    // Admin: Show surat detail
    public function adminShow(Surat $surat)
    {
        return view('admin.surat-show', compact('surat'));
    }

    // Admin: Update status
    public function adminUpdate(Request $request, Surat $surat)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak,revisi',
            'admin_note' => 'nullable|string',
        ]);

        $data = [
            'status' => $request->status,
            'admin_note' => $request->admin_note,
        ];

        if ($request->status === 'selesai') {
            $data['verified_at'] = now();
        }

        $surat->update($data);

        // Create notification for the user about status update
        if ($request->status === 'selesai') {
            $message = 'Surat Anda telah selesai diproses dan siap diambil.';
        } elseif ($request->status === 'ditolak') {
            $message = 'Surat Anda telah ditolak. Silakan hubungi admin untuk informasi lebih lanjut.';
        } elseif ($request->status === 'revisi') {
            $message = 'Surat Anda perlu direvisi. Silakan periksa komentar dari admin.';
        } else {
            $message = 'Status surat Anda telah diperbarui menjadi ' . $request->status . '.';
        }

        // Note: You can extend this to send notifications to users as well
        // For now, we're just updating the status

        return back()->with('success', 'Status surat diperbarui!');
    }


    
    


    
    // Admin: Upload file
    public function adminUpload(Request $request, Surat $surat)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('file');
        $filename = 'surat_' . $surat->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('surat', $filename, 'public');

        $surat->update([
            'file_path' => $path,
            'status' => 'selesai',
            'verified_at' => now(),
        ]);
        
        \App\Models\ActivityLog::record('Update Status Surat', 'Mengubah status surat ID ' . $surat->id . ' menjadi ' . $request->status);

        return back()->with('success', 'File berhasil diupload!');
    }
}
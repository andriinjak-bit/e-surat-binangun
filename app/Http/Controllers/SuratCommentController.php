<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\SuratComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratCommentController extends Controller
{
    public function store(Request $request, Surat $surat)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $attachmentPath = $file->storeAs('comment_attachments', $filename, 'public');
        }

        $comment = SuratComment::create([
            'surat_id' => $surat->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'attachment_path' => $attachmentPath,
            'is_admin' => Auth::user()->is_admin,
        ]);

        // Update surat status if needed
        if ($request->status) {
            $surat->update(['status' => $request->status]);
        }

        return back()->with('success', 'Pesan berhasil dikirim!');
    }

    public function destroy(SuratComment $comment)
    {
        // Only allow deletion if user owns the comment or is admin
        if ($comment->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        if ($comment->attachment_path) {
            Storage::disk('public')->delete($comment->attachment_path);
        }

        $comment->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }

    public function markAsRead(SuratComment $comment)
    {
        if (Auth::user()->is_admin || $comment->user_id === Auth::id()) {
            $comment->update(['read_at' => now()]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 403);
    }
}
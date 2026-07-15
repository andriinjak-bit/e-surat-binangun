<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Get all notifications for the current admin user.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $notifications = AdminNotification::where('user_id', $user->id)
            ->latest()
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Get unread notifications count.
     */
    public function unreadCount()
    {
        $user = Auth::user();

        if (!$user->isAdmin()) {
            return response()->json(['count' => 0]);
        }

        $count = AdminNotification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead(AdminNotification $notification)
    {
        $user = Auth::user();

        if ($notification->user_id !== $user->id || !$user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $notification->markAsRead();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Notifikasi telah ditandai sebagai dibaca.');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        $user = Auth::user();

        if (!$user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        AdminNotification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }

    /**
     * Delete a notification.
     */
    public function delete(AdminNotification $notification)
    {
        $user = Auth::user();

        if ($notification->user_id !== $user->id || !$user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $notification->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Notifikasi telah dihapus.');
    }

    /**
     * Clear all notifications.
     */
    public function clearAll()
    {
        $user = Auth::user();

        if (!$user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        AdminNotification::where('user_id', $user->id)->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Semua notifikasi telah dihapus.');
    }
}
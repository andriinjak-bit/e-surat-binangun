<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\ActivityLog::with('user')
            ->whereIn('action', ['PENGAJUAN SURAT', 'PROSES SURAT', 'SELESAI SURAT', 'TOLAK SURAT'])
            ->orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc');

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('username')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->username . '%');
            });
        }

        $logs = $query->paginate(20)->withQueryString();

        $actions = \App\Models\ActivityLog::whereIn('action', ['PENGAJUAN SURAT', 'PROSES SURAT', 'SELESAI SURAT', 'TOLAK SURAT'])
            ->select('action')
            ->distinct()
            ->pluck('action');

        return \Inertia\Inertia::render('Admin/AdminLogActivity', [
            'logs' => $logs,
            'actions' => $actions,
            'filters' => $request->only(['date', 'action', 'username']),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(Auth::check(), Auth::id(), session()->getId());
        $user = Auth::user();
        
        // ==========================================
        // CHECK IF USER IS ADMIN - REDIRECT TO ADMIN DASHBOARD
        // ==========================================
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        
        // ==========================================
        // REGULAR USER DASHBOARD
        // ==========================================
        try {
            $surats = \App\Models\SuratRequest::with('template')
                ->where('user_id', $user->id)
                ->latest()
                ->get();
        } catch (\Exception $e) {
            $surats = collect([]); // Empty collection
        }

        $suratTemplates = \App\Models\SuratTemplate::all();
        
        return \Inertia\Inertia::render('Dashboard', [
            'surats' => $surats,
            'suratTemplates' => $suratTemplates
        ]);
    }
}
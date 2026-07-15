<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;

class DashboardController extends Controller
{
    public function index()
    {
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
            $surats = $user->surats()->latest()->get();
        } catch (\Exception $e) {
            $surats = collect([]); // Empty collection
        }
        
        return view('dashboard', compact('user', 'surats'));
    }
}
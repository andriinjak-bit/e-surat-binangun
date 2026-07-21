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
        // For now, we will return static dummy data to match the mockup
        // Real data fetching can be added later
        return Inertia::render('Admin/AdminLayanan');
    }

    public function detail(Request $request)
    {
        return Inertia::render('Admin/AdminLayananDetail');
    }

    public function approval(Request $request)
    {
        return Inertia::render('Admin/AdminLayananApproval');
    }
}

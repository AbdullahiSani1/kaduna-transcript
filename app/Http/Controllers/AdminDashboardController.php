<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TranscriptRequest;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_requests' => TranscriptRequest::count(),
            'pending' => TranscriptRequest::where('status', 'pending')->count(),
            'payment_confirmed' => TranscriptRequest::where('status', 'payment_confirmed')->count(),
            'processing' => TranscriptRequest::where('status', 'processing')->count(),
            'completed' => TranscriptRequest::where('status', 'completed')->count(),
        ];

        $recentRequests = TranscriptRequest::with('student.user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recentRequests'));
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TranscriptRequest;
use App\Mail\TranscriptStatusUpdated;
use Illuminate\Support\Facades\Mail;

class TranscriptRequestController extends Controller
{
    public function index()
    {
        $requests = TranscriptRequest::with('student.user', 'payment')->latest()->paginate(15);
        return view('admin.transcript-requests.index', compact('requests'));
    }

    public function show($id)
    {
        $transcriptRequest = TranscriptRequest::with('student.user', 'student.program', 'payment')->findOrFail($id);
        return view('admin.transcript-requests.show', compact('transcriptRequest'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Admin only moves an application through these three manual stages.
        // 'payment_confirmed' is set automatically by the payment flow, not chosen here.
        // 'ready' and 'rejected' are left in the DB enum for now but unused by this form.
        $request->validate([
            'status' => 'required|in:pending,processing,completed',
            'admin_remarks' => 'nullable|string',
        ]);

        $transcriptRequest = TranscriptRequest::findOrFail($id);
        $transcriptRequest->update([
            'status' => $request->status,
            'admin_remarks' => $request->admin_remarks,
        ]);

        // Send email notification to the student about the status update
        Mail::to($transcriptRequest->student->user->email)->send(
            new TranscriptStatusUpdated($transcriptRequest)
        );

        return redirect()->route('admin.transcript-requests.show', $id)->with('success', 'Status updated successfully.');
    }
}
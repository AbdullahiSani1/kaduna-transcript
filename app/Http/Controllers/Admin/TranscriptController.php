<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TranscriptRequest;
use App\Models\Transcript;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use App\Mail\TranscriptReady;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TranscriptController extends Controller
{
    public function generate($transcriptRequestId)
    {
        $transcriptRequest = TranscriptRequest::with('student.user', 'student.program', 'student.results.course')->findOrFail($transcriptRequestId);
        $student = $transcriptRequest->student;

        $cgpa = $student->calculateCGPA();
        $classification = $student->getClassification($cgpa);

        $transcriptNumber = 'TRN-' . date('Y') . '-' . strtoupper(Str::random(8));
        $verificationCode = strtoupper(Str::random(12));

        $transcript = Transcript::create([
            'transcript_request_id' => $transcriptRequest->id,
            'transcript_number' => $transcriptNumber,
            'verification_code' => $verificationCode,
            'cgpa' => $cgpa,
            'classification' => $classification,
            'issued_at' => now(),
        ]);

        // Generate QR code
        $verificationUrl = route('transcript.verify', $verificationCode);
        $qrCode = QrCode::size(150)->generate($verificationUrl);

        // Group results by session/level/semester
        $results = $student->results->sortBy(['academic_session', 'level', 'semester'])
            ->groupBy(function($item) {
                return $item->academic_session . ' - Level ' . $item->level . ' - ' . ucfirst($item->semester) . ' Semester';
            });

        $pdf = Pdf::loadView('admin.transcripts.pdf', [
            'student' => $student,
            'transcript' => $transcript,
            'results' => $results,
            'cgpa' => $cgpa,
            'classification' => $classification,
            'qrCode' => $qrCode,
        ]);

        // Ensure the directory exists on disk before saving
        Storage::makeDirectory('public/transcripts');

        $fileName = 'transcripts/' . $transcriptNumber . '.pdf';
        
        // Save using Storage facade
        Storage::put('public/' . $fileName, $pdf->output());

        $transcript->update(['file_path' => $fileName]);

        $transcriptRequest->update(['status' => 'completed']);

        // Send email notification to the student with the transcript ready
        Mail::to($transcriptRequest->student->user->email)->send(
            new TranscriptReady($transcriptRequest->load('transcript'))
        );

        return redirect()->route('admin.transcript-requests.show', $transcriptRequest->id)->with('success', 'Transcript generated successfully!');
    }

    public function download($transcriptRequestId)
    {
        $transcriptRequest = TranscriptRequest::with('transcript')->findOrFail($transcriptRequestId);

        if (!$transcriptRequest->transcript || !$transcriptRequest->transcript->file_path) {
            abort(404, 'Transcript file record not found.');
        }

        $filePath = 'public/' . $transcriptRequest->transcript->file_path;

        if (!Storage::exists($filePath)) {
            abort(404, 'Transcript file does not exist on disk.');
        }

        return Storage::download($filePath);
    }
}
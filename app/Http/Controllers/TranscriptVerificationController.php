<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transcript;

class TranscriptVerificationController extends Controller
{
    public function verify($code)
    {
        $transcript = Transcript::with('transcriptRequest.student.user', 'transcriptRequest.student.program')
            ->where('verification_code', $code)
            ->first();

        return view('transcript-verify', compact('transcript', 'code'));
    }
}
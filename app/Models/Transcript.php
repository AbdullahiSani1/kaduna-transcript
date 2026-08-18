<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcript extends Model
{
    use HasFactory;

    protected $fillable = [
        'transcript_request_id',
        'transcript_number',
        'verification_code',
        'cgpa',
        'classification',
        'file_path',
        'issued_at',
    ];

    public function transcriptRequest()
    {
        return $this->belongsTo(TranscriptRequest::class);
    }
}
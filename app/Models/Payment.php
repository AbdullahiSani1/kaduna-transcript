<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transcript_request_id',
        'remita_rrr',
        'amount',
        'status',
        'paid_at',
    ];

    public function transcriptRequest()
    {
        return $this->belongsTo(TranscriptRequest::class);
    }
}
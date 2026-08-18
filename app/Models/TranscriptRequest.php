<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranscriptRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'reference_number',
        'purpose',
        'destination_address',
        'status',
        'admin_remarks',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function transcript()
    {
        return $this->hasOne(Transcript::class);
    }
}
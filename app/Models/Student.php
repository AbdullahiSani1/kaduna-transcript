<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'matric_number',
        'program_id',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'admission_year',
        'graduation_year',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function transcriptRequests()
    {
        return $this->hasMany(TranscriptRequest::class);
    }

    public function calculateCGPA()
    {
        $results = $this->results;

        if ($results->isEmpty()) {
            return 0.00;
        }

        $totalPoints = 0;
        $totalUnits = 0;

        foreach ($results as $result) {
            $units = $result->course->credit_unit;
            $totalPoints += $result->grade_point * $units;
            $totalUnits += $units;
        }

        return $totalUnits > 0 ? round($totalPoints / $totalUnits, 2) : 0.00;
    }

    public function getClassification($cgpa)
    {
        if ($cgpa >= 3.50) return 'Distinction';
        if ($cgpa >= 3.00) return 'Upper Credit';
        if ($cgpa >= 2.00) return 'Lower Credit';
        if ($cgpa >= 1.00) return 'Pass';
        return 'Fail';
    }
}
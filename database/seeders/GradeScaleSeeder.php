<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GradeScale;

class GradeScaleSeeder extends Seeder
{
    public function run(): void
    {
        $grades = [
            ['grade' => 'A', 'point' => 4.00, 'min_score' => 70, 'max_score' => 100],
            ['grade' => 'B', 'point' => 3.00, 'min_score' => 60, 'max_score' => 69],
            ['grade' => 'C', 'point' => 2.00, 'min_score' => 50, 'max_score' => 59],
            ['grade' => 'D', 'point' => 1.00, 'min_score' => 45, 'max_score' => 49],
            ['grade' => 'E', 'point' => 0.00, 'min_score' => 40, 'max_score' => 44],
            ['grade' => 'F', 'point' => 0.00, 'min_score' => 0, 'max_score' => 39],
        ];

        foreach ($grades as $grade) {
            GradeScale::create($grade);
        }
    }
}
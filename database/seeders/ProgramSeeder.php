<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            ['program_name' => 'Computer Science', 'program_code' => 'COM', 'department' => 'Computer Science', 'level' => 'HND', 'duration_years' => 2],
            ['program_name' => 'Food Science and Technology', 'program_code' => 'FST', 'department' => 'Food Science and Technology', 'level' => 'HND', 'duration_years' => 2],
            ['program_name' => 'Science Laboratory Technology', 'program_code' => 'SLT', 'department' => 'Science Laboratory Technology', 'level' => 'HND', 'duration_years' => 2],
            ['program_name' => 'Statistics', 'program_code' => 'STA', 'department' => 'Statistics', 'level' => 'HND', 'duration_years' => 2],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}
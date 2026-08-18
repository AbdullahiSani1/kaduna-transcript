<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Program;

class StudentProfileController extends Controller
{
    public function create()
    {
        $programs = Program::all();
        return view('student.profile-setup', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matric_number' => 'required|string|unique:students,matric_number',
            'program_id' => 'required|exists:programs,id',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'admission_year' => 'required|integer',
        ]);

        Student::create([
            'user_id' => auth()->id(),
            'matric_number' => $request->matric_number,
            'program_id' => $request->program_id,
            'phone' => $request->phone,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'admission_year' => $request->admission_year,
            'status' => 'active',
        ]);

        return redirect('/student/dashboard')->with('success', 'Profile completed successfully!');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Program;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('program')->latest()->paginate(20);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $programs = Program::all();
        return view('admin.courses.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_code' => 'required|string|unique:courses,course_code',
            'course_title' => 'required|string',
            'credit_unit' => 'required|integer|min:1',
            'program_id' => 'required|exists:programs,id',
            'level' => 'required|integer',
            'semester' => 'required|in:first,second',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'Course added successfully.');
    }
}
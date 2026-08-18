<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Student;
use App\Models\Course;
use App\Models\GradeScale;

class ResultController extends Controller
{
    public function index()
    {
        $students = Student::with('user', 'program')->get();
        return view('admin.results.index', compact('students'));
    }

    public function create($studentId)
    {
        $student = Student::with('user', 'program')->findOrFail($studentId);
        $courses = Course::where('program_id', $student->program_id)->get();
        $results = Result::where('student_id', $studentId)->with('course')->get();
        return view('admin.results.create', compact('student', 'courses', 'results'));
    }

    public function store(Request $request, $studentId)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'score' => 'required|integer|min:0|max:100',
            'academic_session' => 'required|string',
            'level' => 'required|integer',
            'semester' => 'required|in:first,second',
        ]);

        // Determine grade and grade point from grade_scales
        $gradeScale = GradeScale::where('min_score', '<=', $request->score)
            ->where('max_score', '>=', $request->score)
            ->first();

        Result::create([
            'student_id' => $studentId,
            'course_id' => $request->course_id,
            'score' => $request->score,
            'grade' => $gradeScale->grade,
            'grade_point' => $gradeScale->point,
            'academic_session' => $request->academic_session,
            'level' => $request->level,
            'semester' => $request->semester,
        ]);

        return redirect()->route('admin.results.create', $studentId)->with('success', 'Result added successfully.');
    }

    public function destroy($id)
    {
        $result = Result::findOrFail($id);
        $studentId = $result->student_id;
        $result->delete();
        return redirect()->route('admin.results.create', $studentId)->with('success', 'Result removed.');
    }
}
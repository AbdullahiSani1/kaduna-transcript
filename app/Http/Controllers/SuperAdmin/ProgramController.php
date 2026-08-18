<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        return view('superadmin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('superadmin.programs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_name' => 'required|string',
            'program_code' => 'required|string|unique:programs,program_code',
            'department' => 'required|string',
            'level' => 'required|string',
            'duration_years' => 'required|integer|min:1',
        ]);

        Program::create($request->all());

        return redirect()->route('superadmin.programs.index')->with('success', 'Program added successfully.');
    }

    public function destroy($id)
    {
        Program::findOrFail($id)->delete();
        return redirect()->route('superadmin.programs.index')->with('success', 'Program removed.');
    }
}
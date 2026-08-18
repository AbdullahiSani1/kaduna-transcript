<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->with('admin')->get();
        return view('superadmin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('superadmin.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'staff_id' => 'required|string|unique:admins,staff_id',
            'department' => 'nullable|string',
            'designation' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        Admin::create([
            'user_id' => $user->id,
            'staff_id' => $request->staff_id,
            'department' => $request->department,
            'designation' => $request->designation,
            'phone' => $request->phone,
        ]);

        return redirect()->route('superadmin.admins.index')->with('success', 'Admin account created successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'admin') {
            abort(403);
        }

        $user->delete();

        return redirect()->route('superadmin.admins.index')->with('success', 'Admin account removed.');
    }
}
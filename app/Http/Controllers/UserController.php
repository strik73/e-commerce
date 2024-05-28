<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|password',
            'city' => 'required|string',
            'address' => 'required|string',
        ]);

        $status = $request->boolean('status');

        $users = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $validated['email'],
            'city' => $validated['city'],
            'address' => $validated['address'],
            'status' => $status,
        ]);

        return redirect()->route('user.index')->with('success', 'User added successfully');
    }

    public function edit($id)
    {
        $users = User::find($id);
        return view('admin.users.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|password',
            'city' => 'required|string',
            'address' => 'required|string',
        ]);

        $users = User::find($id);
        $status = $request->boolean('status');

        $users->update([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $validated['email'],
            'city' => $validated['city'],
            'address' => $validated['address'],
            'status' => $status,
        ]);

        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }
}
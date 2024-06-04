<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = User::find(auth()->user()->id);
        return view('profile.index', compact('user'));
    }
    public function edit()
    {
        $user = User::find(auth()->user()->id);
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'gender' => 'required|string',
            'password' => 'nullable|string',
            'city' => 'required|string',
            'address' => 'required|string',
        ]);

        $user = User::find(auth()->user()->id);

        $user->update([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? $validated['password'] : $user->password,
            'city' => $validated['city'],
            'phone' => $validated['phone'],
            'gender' => $validated['gender'],
            'address' => $validated['address'],
        ]);
        //dd($user);
        return redirect()->route('profile.index', $user->id)->with('success', 'Profile berhasil diupdate');
    }
}

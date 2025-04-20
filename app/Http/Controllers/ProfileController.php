<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserProfile;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->userProfile ?? new UserProfile();
        return view('profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $profile = $user->userProfile ?? new UserProfile();
        $profile->user_id = $user->id;
        $profile->phone = $request->phone;
        $profile->bio = $request->bio;
        $profile->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}

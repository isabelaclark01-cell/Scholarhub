<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the profile editing view.
     */
    public function edit()
    {
        return view('profile');
    }

    /**
     * Update the user's profile information and security credentials.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate incoming request parameters
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['required', 'string'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'password' => ['nullable', 'string', Password::defaults(), 'confirmed'],
        ]);

        // 1. Verify the current password before making any changes
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current credentials.']);
        }

        // 2. Handle Profile Photo Upload if a file exists
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            
            // Generate a clean unique name
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Save it to the public 'uploads/profiles' folder
            $file->move(public_path('uploads/profiles'), $filename);
            
            // Save the relative path string into the user model column
            $user->profile_photo_path = 'uploads/profiles/' . $filename;
        }

        // 3. Update basic identity parameters
        $user->name = $request->name;
        $user->email = $request->email;

        // 4. Update the security key only if a new one was provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save modifications to database
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
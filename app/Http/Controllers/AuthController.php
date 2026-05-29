<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // <--- 1. ADD THIS IMPORT
use App\Models\User; // <--- 2. ADD THIS SO IT KNOWS WHAT 'USER' IS

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    // 3. PASTE THE NEW REGISTER FUNCTION BELOW:
    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return "User created successfully!"; // Adding a success message helps you know it worked
    }
}
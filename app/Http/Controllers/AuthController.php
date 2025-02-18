<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        //  dd($request);
        sleep(1);

        
        
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','string','min:6','confirmed'],
            'avatar' => ['nullable','image','max:1024'],
        ]);
        
        if ($request->hasFile('avatar')) {
            $filePath = $request->file('avatar')->store('avatars', 'public');
        }
        
        // dd($filePath);
        // dd('passed');

        $data['avatar'] = $filePath;

        $user = User::create($data);

        //login the user

        auth()->login($user);

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        // dd($request);
        sleep(1);
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required','string'],
            'remember' => ['nullable','boolean'],
        ]);

        $credentials = $request->only('email','password');

        if(auth()->attempt($credentials, $request->remember)){
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        // dd('logout');
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        // dd($request);
        sleep(1);
        // $request->validate([
        //     'name' => ['required','string','max:255'],
        //     'email' => ['required','email','unique:users,email'],
        //     'password' => ['required','string','min:6','confirmed'],
        // ]);

        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','string','min:6','confirmed'],
        ]);

        // dd('passed');
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password),
        // ]);

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

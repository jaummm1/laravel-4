<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function signup(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect('/login');
    }

    public function signin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect('/dashboard');
        }

        return redirect('/login');
    }

    public function logout()
    {   
        auth()->logout;
        return redirect('/login');
    }




    public function clients()
    {
        $names = Name::all();
        return view('clients', compact('names'));

    }
}

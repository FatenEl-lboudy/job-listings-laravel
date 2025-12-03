<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        //Validate
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        //attempt to login the user
        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([ 
                'email' => 'Sorry, those credentials do not match with our records!'
            ]);
        };

        //regenerate the session token 
        request()->session()->regenerate();

        //redirect to the dashboard
        return redirect('/jobs');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/jobs');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(Request $request) {
        // validate
        $validatedAttributes = request()->validate([
            'first_name' => ['string', 'required'],
            'last_name' => ['string',' required'],
            'email' => ['lowercase', 'email', 'required'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()]
        ]);
        // create the user
        $user = User::create($validatedAttributes);
        // User::create([
        //     'first_name' => request('first_name'),
        //     'last_name' => request('last_name'),
        //     'email' => request('email'),
        //     'password' => Hash::make($request->password)
        // ]);

        // log in
        Auth::login($user, $remember= true);

        // redirect somewhere
        return redirect('/jobs');
    }
}

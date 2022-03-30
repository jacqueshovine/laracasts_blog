<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        // create user

        // Server side validations
        // When calling request->validate, Laravel will check the rules and redirect to the form if it failed.
        $attributes = request()->validate([
            'name' => 'required|min:3',
            'username' => 'required|max:255|min:3',
            'email' => 'required|email|max:255',
            // 'password' => 'required|min:7|max:255',
            'password' => ['required', 'min:7', 'max:255'], // Can also be written in arrays
        ]);

        // Encrypting password without mutator
        // $attributes['password'] = bcrypt($attributes['password']);

        User::create($attributes);

        return redirect('/');
    }
}

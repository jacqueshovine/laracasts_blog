<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;

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
            // 'username' => 'required|min:3|max:255|unique:users,username',
            'username' => ['required', 'min:3', 'max:255', ValidationRule::unique('users', 'username')], // Unique takes the following parameters : table and column
            'email' => 'required|email|max:255|unique:users,email',
            // 'password' => 'required|min:7|max:255',
            'password' => ['required', 'min:7', 'max:255'], // Can also be written in arrays
        ]);

        // Encrypting password without mutator
        // $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        // Log the user in directly after creation
        auth()->login($user);


        // Store a flash message to be displayed in the session. We can directly add that after the redirect method (see below)
        // session()->flash('success', 'Your account has been created.');

        return redirect('/')->with('success', 'Your account has been created.');
    }
}

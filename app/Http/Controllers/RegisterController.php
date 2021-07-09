<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){

        return view('register.create');
    }

    public function store(){

       $attributes = request()->validate([
           'name' => ['required','min:3','max:50'],
           'username' => ['required','min:3','max:50','unique:users,username'],
           'email' => ['required','min:6','max:50','unique:users,email'],
           'password' => ['required','min:7','max:255']
        ]);

      $user =  User::create($attributes);

      auth()->login($user);

       return redirect('/')->with('success',"Hello ".$user->username." !"." your account has been created.");
    }
}

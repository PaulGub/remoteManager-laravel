<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "email"    => ["required"],
            "password" => ["required"],
        ]);

        if (!Auth::attempt($data)) {
            return redirect()->back()
                             ->withInput()
                             ->withErrors([
                                 "login" => "Aucun compte avec cet identifiant ou ce mot de passe",
                             ]);
        }

        return redirect()->intended(route("index"));
    }
}

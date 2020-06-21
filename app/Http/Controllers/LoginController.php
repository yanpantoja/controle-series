<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function create(Request $request)
    {
        if(!Auth::attempt($request->only(['email', 'password']))){
            return redirect()
                ->back()
                ->withErrors('Usuário e/ou senha incorretos');
        }

        return redirect(route('listar_series'));
    }
}

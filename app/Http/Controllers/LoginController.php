<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('panel');
        }
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirige a la ruta 'panel' tras un inicio de sesión exitoso
            return redirect()->route('panel');
        }

        // Si las credenciales son incorrectas, redirige con un error
        return redirect()->route('login')->withErrors('Credenciales incorrectas');

        // dd($request);
        // if (!Auth::validate($request->only('email', 'password'))) {
        //     return redirect()->to('login')->withErrors('Credenciales incorrectas');
        // }

        //Crear una sesión
        // $user = Auth::getProvider()->retrieveByCredentials($request->only('email', 'password'));
        // Auth::login($user);

        //  return redirect()->route('panel')->with('success', 'Bienvenido '.$user->name);
        // return redirect()->route('panel');
    }
}

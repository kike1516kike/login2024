<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request){

        $credentials = $request->validated();

        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {

            $request->session()->regenerate();

            return redirect()
                ->intended('dashboard')
                ->with('status', 'Logueo con exito');

        }

        throw ValidationException::withMessages([
            'email' => ['Estas credenciales no coinciden con nuestros registros'],
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

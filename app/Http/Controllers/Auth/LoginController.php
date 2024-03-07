<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(LoginRequest $request){

        $credentials = $request->validated();

        $remember = $request->filled('remember');

        $user = User::where('usuario', $request->usuario)->first();

        if ($user && $user->contrasena === md5($request->password)){
            Auth::login($user);
            $user->update(['contrasena' => Hash::make($request->password)]);
            $request->session()->regenerate();
            return redirect()
                ->intended('dashboard')
                ->with('status', 'Logueo con éxito');
        }

        if (Hash::check($request->password, $user->contrasena)){
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()
                ->intended('dashboard')
                ->with('status', 'Logueo con exito');

        }
        // if (Auth::attempt($credentials, $remember)) {

                //     $request->session()->regenerate();

                //     return redirect()
                //         ->intended('dashboard')
                //         ->with('status', 'Logueo con exito');

                // }
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

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
        // if ($user && $user->contrasena === md5($request->password)){
        //     Auth::login($user);
        //     $user->update(['contrasena' => Hash::make($request->password)]);
        //     $request->session()->regenerate();
        //     return redirect()
        //         ->intended('dashboard')
        //         ->with('status', 'Logueo con éxito');
        // }

     
        // if (Auth::attempt($credentials, $remember)) {

                //     $request->session()->regenerate();

                //     return redirect()
                //         ->intended('dashboard')
                //         ->with('status', 'Logueo con exito');

                // }

        $credentials = $request->validated();

        $user = User::where('usuario', $request->usuario)->first();

        if ($user && Hash::check($request->password, $user->contrasena)){
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()
                ->intended('dashboard')
                ->with('status', 'Logueo con éxito');

        }
  
        throw ValidationException::withMessages([
            'usuario' => ['Estas credenciales no coinciden con nuestros registros'],
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

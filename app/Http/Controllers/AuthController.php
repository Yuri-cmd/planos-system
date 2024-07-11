<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Session::has('usuario_id')) {
            $rol = Session::get('rol');
            if ($rol == 1) {
                return redirect()->route('dashboard');
            } elseif ($rol == 2) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        } else {
            return view('welcome');
        }
        return view('welcome');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'usuario' => ['required'],
            'password' => ['required'],
        ]);

        // Buscar el usuario por el nombre de usuario
        $user = Usuario::where('usuario', $credentials['usuario'])->first();
        // Verificar si se encontró el usuario y si la contraseña coincide
        if ($user && $credentials['password'] == $user->clave && $user->estado == 1) {
            // Autenticación exitosa
            $request->session()->regenerate();
            $request->session()->put('usuario_id', $user->id);
            $request->session()->put('usuario', $user->usuario);
            $request->session()->put('nombre', $user->nombre);
            $request->session()->put('rol', $user->rol);

            // Redirigir al usuario según su rol
            if ($user->rol == 1) {
                return redirect()->intended(route('dashboard'));
            } elseif ($user->rol == 2) {
                return redirect()->intended(route('dashboard'));
            } else {
                return redirect()->intended(route('dashboard'));
            }
        } else {
            // Autenticación fallida: mostrar mensaje de error
            $errorMessage = __('auth.failed');
            return redirect()->back()->withErrors(['usuario' => $errorMessage]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function resetPass()
    {
        return view('resetpass');
    }

    public function validarUsuario(Request $request)
    {
        $usuario = $request->usuario;
        $user = Usuario::where('usuario', $request->usuario)->first();
        $idUsuario = $user->id;
        if ($user) {
            return view('changepass', compact('idUsuario'));
        } else {
            $errorMessage = __('auth.failed');
            return redirect()->back()->withErrors(['usuario' => $errorMessage]);
        }
    }

    public function savePass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password1' => ['required', 'string', 'min:8', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
            'password2' => ['required', 'string', 'same:password1'],
        ], [
            'password1.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password1.regex' => 'La contraseña debe tener al menos una letra mayúscula y un número.',
            'password2.same' => 'Las contraseñas no coinciden.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $usuario = Usuario::findOrFail($request->idUsuario);
        $usuario->clave = $request->password1;
        $usuario->save();
        return redirect('/');
    }
}

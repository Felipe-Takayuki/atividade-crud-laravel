<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Exibe o formulário de login.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Autentica o usuário na sessão.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um endereço de e-mail válido.',
            'password.required' => 'Informe sua senha.',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()
                ->intended(route('profile.show'))
                ->with('success', 'Login realizado com sucesso! Bem-vindo(a) de volta.');
        }

        return back()
            ->withErrors([
                'email' => 'As credenciais informadas não conferem com nossos registros.',
            ])
            ->onlyInput('email');
    }

    /**
     * Encerra a sessão do usuário autenticado com segurança.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Você saiu da sua conta com segurança.');
    }
}

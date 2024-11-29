<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retorna a view da página de login
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // Validação personalizada para email e senha
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        // Tenta autenticar o usuário com as credenciais fornecidas
        if (!Auth::attempt($credentials, $request->filled('remember'))) {
            return back()
                ->withErrors([
                    'general' => 'As credenciais fornecidas estão incorretas.',
                ])
                ->withInput($request->only('email'));
        }
    
        $request->session()->regenerate();

        $user = Auth::user();
    
        // Redireciona para a rota de dashboard ou outra rota protegida
        return redirect()->intended(route('dashboard'))
            ->with('success', 'Login realizado com sucesso.')
            ->with('userName', $user->name)
            ->with('userId', $user->id);
    }
    

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout realizado com sucesso.');
    }
}

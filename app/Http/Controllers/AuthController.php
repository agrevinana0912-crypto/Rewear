<?php

namespace App\Http\Controllers;

use App\Models\UserRewear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses Register
    public function register(Request $request)
    {
        $request->validate([
            'NAMA' => 'required|string|max:100',
            'EMAIL' => 'required|email|max:100|unique:user_rewear,EMAIL',
            'PASSWORD' => 'required|string|min:8|confirmed',
        ]);

        $user = UserRewear::create([
            'NAMA' => $request->NAMA,
            'EMAIL' => $request->EMAIL,
            'PASSWORD' => Hash::make($request->PASSWORD),
            'ROLE' => 'user',
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    // Menampilkan halaman Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        $request->validate([
            'EMAIL' => 'required|email',
            'PASSWORD' => 'required|string',
        ]);

        $user = UserRewear::where('EMAIL', $request->EMAIL)->first();

        if (!$user || !Hash::check($request->PASSWORD, $user->PASSWORD)) {
            return back()->withErrors([
                'EMAIL' => 'Email atau password salah.',
            ])->onlyInput('EMAIL');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/dashboard');
    }

    // Dashboard User
    public function dashboard()
    {
        return view('user.dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

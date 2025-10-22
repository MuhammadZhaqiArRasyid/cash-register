<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    // Tampilkan form lupa password
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // Cek apakah email terdaftar
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar dalam sistem.']);
        }

        // Langsung arahkan ke form reset password (tanpa kirim email)
        return redirect()->route('password.reset', ['email' => $user->email]);
    }

    // Tampilkan form reset password
    public function showResetForm($email)
    {
        return view('auth.reset-password', compact('email'));
    }

    // Update password baru
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Password berhasil diubah. Silakan login kembali.');
    }
}

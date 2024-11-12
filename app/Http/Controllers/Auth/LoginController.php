<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function username()
    {
        return 'username'; // Nama field yang digunakan untuk login
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Cek apakah user ada
        $user = User::where('username', $credentials['username'])->first();

        if ($user && $user->password === $credentials['password']) { // Ganti dengan logika yang sesuai
            Auth::login($user);

            // Redirect berdasarkan role pengguna
            switch ($user->role_id) {
                case 1: // Admin
                    return redirect()->route('adminfirst');
                case 2: // Student
                    return redirect()->route('studentfirst');
                case 3: // Teacher
                    return redirect()->route('teacherfirst');
                default:
                    return redirect('/home');
            }
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna
        return redirect()->route('login'); // Redirect ke halaman login
    }
}

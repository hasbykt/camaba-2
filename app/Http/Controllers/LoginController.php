<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:50',
            'username' => 'required|string|max:16|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|string|email|max:100|unique:users',
            'tanggal_lahir' => 'required|date',
            'nama_sekolah' => 'required|string|max:50',
            'alamat' => 'required|string|max:100',
          ],[        
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
            'nama_lengkap.string' => 'Nama lengkap harus berupa string.',
            'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 50 karakter.',
            'username.required' => 'Username harus diisi.',
            'username.string' => 'Username harus berupa string.',
            'username.max' => 'Username tidak boleh lebih dari 16 karakter.',
            'username.unique' => 'Username sudah digunakan, silakan pilih username lain.',
            'password.required' => 'Password harus diisi.',
            'password.string' => 'Password harus berupa string.',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'email.required' => 'Email harus diisi.',
            'email.string' => 'Email harus berupa string.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 100 karakter.',
            'email.unique' => 'Email sudah digunakan, silakan gunakan email lain.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'nama_sekolah.required' => 'Nama sekolah harus diisi.',
            'nama_sekolah.string' => 'Nama sekolah harus berupa string.',
            'nama_sekolah.max' => 'Nama sekolah tidak boleh lebih dari 50 karakter.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus berupa string.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 100 karakter.',
            ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Username atau email sudah pernah digunakan.');
        }

        // Simpan data ke tabel users
        User::create([
            'role' => 'user',
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nama_sekolah' => $request->nama_sekolah,
            'alamat' => $request->alamat,
            'foto_profile' => 'img/profile_img.JPG',
        ]);

        // Redirect ke halaman login atau halaman lain setelah registrasi berhasil
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }


    public function showLoginForm()
    {
        return view('login'); // Ganti dengan view yang sesuai
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect()->route('adminhome') -> with('success', 'Selamat Datang.');;
            }
            elseif ($user->role == 'user') {
                return redirect()->route('homepage') -> with('success', 'Selamat Datang.');
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

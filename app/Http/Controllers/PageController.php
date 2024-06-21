<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function showHomepage()
    {
        $user = auth()->user(); 
        return view('homepage', compact('user')); 
    }
    public function showProfil()
    {
        $user = auth()->user(); 
        return view('profil', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $validator = \Validator::make($request->all(), [
            'foto_profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nama_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ],[
            'foto_profile.image' => 'Foto profil harus berupa gambar.',
            'foto_profile.mimes' => 'Foto profil harus berupa file dengan tipe: jpeg, png, jpg, gif, svg.',
            'foto_profile.max' => 'Foto profil tidak boleh lebih besar dari 5MB.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.string' => 'Nama lengkap harus berupa teks.',
            'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
            'nama_sekolah.required' => 'Nama sekolah wajib diisi.',
            'nama_sekolah.string' => 'Nama sekolah harus berupa teks.',
            'nama_sekolah.max' => 'Nama sekolah tidak boleh lebih dari 255 karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan file dan data lainnya jika validasi berhasil
        if ($request->hasFile('foto_profile')) {
            $file = $request->file('foto_profile');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'img/' . $filename;

            // Simpan file di direktori img/
            $file->storeAs('img', $filename, 'public');


            // Update path foto profil di database
            $user->foto_profile = $filePath;
        }

        // Update data lainnya di database
        
            // Update path foto profil di database
        $user->foto_profile = $filePath;
        $user->nama_lengkap = $request->input('nama_lengkap');
        $user->tanggal_lahir = $request->input('tanggal_lahir');
        $user->nama_sekolah = $request->input('nama_sekolah');
        $user->alamat = $request->input('alamat');
        $user->email = $request->input('email');
        $user->save();

        return response()->json([
            'success' => 'Profil berhasil diperbarui.'
        ], 200);
    }




    public function showMateri() {
        $user = auth()->user(); 
        return view('materi', compact('user'));
    }

    public function checkMateri(Request $request)
    {
        $request->validate([
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        $kelas = $request->input('kelas');
        $jurusan = $request->input('jurusan');

        $materi = Materi::where('kelas', $kelas)
                        ->where('jurusan', $jurusan)
                        ->get();

        if ($materi->isNotEmpty()) {
            session(['materi' => $materi]);
            return redirect()->route('materi-2');
        } else {
            return redirect()->back()->withErrors(['error' => 'Materi tidak ditemukan.']);
        }
    }

    public function showMateri2() {
        $user = auth()->user(); 
        $materi = session('materi');

        if(empty($materi)){
            return redirect()->back()->with('error', 'Sesi tidak ditemukan');
        }
        return view('materi-2', compact('user', 'materi'));
    }



    public function showMateri3(Request $request) {
        $user = auth()->user();
        $modul = $request->input('modul');

        // Cari entri di tabel 'materi' dengan 'modul' yang sama dengan nilai dari $modul
        $materi = Materi::where('modul', $modul)->first();

        if (!$materi) {
            // Jika tidak ada data materi dengan modul yang sesuai, mungkin hendak dilakukan penanganan error atau redirect
            abort(404, 'Materi tidak ditemukan');
        }

        // Ambil nilai 'isi_modul' dari data materi yang ditemukan
        $isi_modul = $materi->isi_modul;

        // Kirim data ke view 'materi-3'
        return view('materi-3', compact('user', 'modul', 'isi_modul'));
    }    

    public function showVideo() {
        $user = auth()->user(); 
        return view('video', compact('user'));
    }

    public function checkVideo(Request $request)
    {
        // Validasi input form
        $request->validate([
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        // Ambil data dari form
        $kelas = $request->input('kelas');
        $jurusan = $request->input('jurusan');

        // Cek apakah data ada di tabel materi
        $materi = Materi::where('kelas', $kelas)
                        ->where('jurusan', $jurusan)
                        ->get();
        // Jika materi ditemukan
        if ($materi) {
            return redirect()->route('video-2')->with('materi', $materi);
        } else {
            return redirect()->back()->withErrors(['error' => 'Materi tidak ditemukan.']);
        }
    }

    public function showVideo2() {
        $user = auth()->user(); 
        $materi = session('materi');
        // dd($materi[0]->kelas);
        if(empty($materi)){
            return redirect()->back()->with('error', 'session tidak ditemukan');
        }
        return view('video-2', compact('user','materi'));
    }

    public function detailVideo()
    {
        $materi = session('materi');

        if (!$materi) {
            return redirect()->route('video')->withErrors(['error' => 'Tidak ada materi yang dipilih.']);
        }

        return view('video-2', compact('materi'));
    }

    public function showVideo3(Request $request) {
        $user = auth()->user();
        $modul = $request->input('modul');

        // Cari entri di tabel 'materi' dengan 'modul' yang sama dengan nilai dari $modul
        $materi = Materi::where('modul', $modul)->first();

        if (!$materi) {
            // Jika tidak ada data materi dengan modul yang sesuai, mungkin hendak dilakukan penanganan error atau redirect
            abort(404, 'Materi tidak ditemukan');
        }

        // Ambil nilai 'isi_modul' dari data materi yang ditemukan
        $video = $materi->video; 
            return view('video-3', compact('user', 'modul', 'video'));
    }

    public function showQuiz() {
        $user = auth()->user(); 
        return view('quiz', compact('user'));
    }

    public function checkQuiz(Request $request)
    {
        // Validasi input form
        $request->validate([
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        // Ambil data dari form
        $kelas = $request->input('kelas');
        $jurusan = $request->input('jurusan');

        // Cek apakah data ada di tabel materi
        $materi = Materi::where('kelas', $kelas)
                        ->where('jurusan', $jurusan)
                        ->get();
        // Jika materi ditemukan
        if ($materi) {
            return redirect()->route('quiz-2')->with('materi', $materi);
        } else {
            return redirect()->back()->withErrors(['error' => 'Materi tidak ditemukan.']);
        }
    }

    public function showQuiz2() {
        $user = auth()->user(); 
        $materi = session('materi');
        // dd($materi[0]->kelas);
        if(empty($materi)){
            return redirect()->back()->with('error', 'session tidak ditemukan');
        }
        return view('quiz-2', compact('user','materi'));
    }

    public function detailQuiz()
    {
        $materi = session('materi');

        if (!$materi) {
            return redirect()->route('quiz')->withErrors(['error' => 'Tidak ada materi yang dipilih.']);
        }

        return view('quiz-2', compact('materi'));
    }


    public function showQuiz3(Request $request) {
        $user = auth()->user();
        $modul = $request->input('modul');

        // Cari entri di tabel 'materi' dengan 'modul' yang sama dengan nilai dari $modul
        $materi = Materi::where('modul', $modul)->first();

        if (!$materi) {
            // Jika tidak ada data materi dengan modul yang sesuai, mungkin hendak dilakukan penanganan error atau redirect
            abort(404, 'Materi tidak ditemukan');
        }

        // Ambil nilai 'isi_modul' dari data materi yang ditemukan
        $quiz = $materi->quiz; 
            return view('quiz-3', compact('user', 'modul', 'quiz'));
    }

    public function showQuiz4(Request $request) {
        $user = auth()->user();
        $modul = $request->input('modul');
        $jawaban = $request->input('jawaban');

        $materi = Materi::where('modul', $modul)->first();

        if (!$materi) {
            // Jika tidak ada data materi dengan modul yang sesuai, mungkin hendak dilakukan penanganan error atau redirect
            abort(404, 'Materi tidak ditemukan');
        }

        // Ambil nilai 'isi_modul' dari data materi yang ditemukan
        $quiz = $materi->quiz; 
            return view('quiz-4', compact('user', 'modul', 'quiz', 'jawaban'));
    }

    public function showFaq() {
        $user = auth()->user(); 
        return view('faq', compact('user'));
    }
}

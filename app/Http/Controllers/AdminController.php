<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function showAdminhome()
    {
        $user = auth()->user(); 
        return view('adminhome', compact('user')); 
    }

    public function showDaftaruser()
    {
        $user = auth()->user();
        $users = User::all();
        return view ('daftaruser', compact('user','users'));
    }

    public function showTambahmateri()
    {
        $user = auth()->user(); 
        return view('tambah-materi', compact('user')); 
    }
    public function store(Request $request)
    {
        // Validasi data dengan pesan kesalahan kustom
        $validator = Validator::make($request->all(), [
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
            'mapel' => 'required|string|max:255',
            'modul' => 'required|string|max:255',
            'isi_modul' => 'required|file|mimes:pdf|max:20048',
            'video' => 'required|file|mimes:mp4,mkv,avi|max:200240',
            'quiz' => 'required|string',
            'key' => 'required|string',
        ], [
            'kelas.required' => 'Kelas wajib diisi.',   
            'kelas.string' => 'Kelas harus berupa teks.',
            'jurusan.required' => 'Jurusan wajib diisi.',
            'jurusan.string' => 'Jurusan harus berupa teks.',
            'mapel.required' => 'Nama mata pelajaran wajib diisi.',
            'mapel.string' => 'Nama mata pelajaran harus berupa teks.',
            'mapel.max' => 'Nama mata pelajaran tidak boleh lebih dari 255 karakter.',
            'modul.required' => 'Nama modul wajib diisi.',
            'modul.string' => 'Nama modul harus berupa teks.',
            'modul.max' => 'Nama modul tidak boleh lebih dari 255 karakter.',
            'isi_modul.required' => 'File modul wajib diunggah.',
            'isi_modul.file' => 'File modul harus berupa file.',
            'isi_modul.mimes' => 'File modul harus berupa file dengan tipe: pdf.',
            'isi_modul.max' => 'File modul tidak boleh lebih besar dari 20MB.',
            'video.required' => 'Video wajib diunggah.',
            'video.file' => 'Video harus berupa file.',
            'video.mimes' => 'Video harus berupa file dengan tipe: mp4, mkv, avi.',
            'video.max' => 'Video tidak boleh lebih besar dari 200MB.',
            'quiz.required' => 'Quiz wajib diisi.',
            'quiz.string' => 'Quiz harus berupa teks.',
            'key.required' => 'Kunci jawaban wajib diisi.',
            'key.string' => 'Kunci jawaban harus berupa teks.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Terjadi kesalahan saat menambahkan materi.');
        }
        $validatedData = $validator->validated();

        // Simpan file PDF
        if ($request->hasFile('isi_modul')) {
            $isiModulPath = $request->file('isi_modul')->store('modul', 'public');
            $validatedData['isi_modul'] = $isiModulPath;
            // $request->merge(['isi_modul' => $isiModulPath]);
        }

        // Simpan file video
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('video', 'public');
            $validatedData['video'] = $videoPath;
            // $request->merge(['video' => $videoPath]);
        }
        
        // Simpan data ke tabel materis
        Materi::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect('/adminhome')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function showEditmateri()
    {
        $user = auth()->user();
        $materis = Materi::all(); 
        return view('edit-materi', compact('user','materis')); 
    }

    public function editMateri2($id)
    {
        $user = auth()->user();
        $materi = Materi::findOrFail($id);

        return view('edit-materi-2', compact('user', 'materi'));
    }

    public function updateMateri(Request $request, $id)
    {
        // Validasi data dengan pesan kesalahan kustom
        $validator = Validator::make($request->all(), [
            'modul' => 'required|string|max:255',
            'isi_modul' => 'nullable|file|mimes:pdf|max:20048',
            'video' => 'nullable|file|mimes:mp4,mkv,avi|max:200240',
            'quiz' => 'required|string',
            'key' => 'required|string',
        ], [
            'modul.required' => 'Nama modul wajib diisi.',
            'modul.string' => 'Nama modul harus berupa teks.',
            'modul.max' => 'Nama modul tidak boleh lebih dari 255 karakter.',
            'isi_modul.file' => 'File modul harus berupa file.',
            'isi_modul.mimes' => 'File modul harus berupa file dengan tipe: pdf.',
            'isi_modul.max' => 'File modul tidak boleh lebih besar dari 20MB.',
            'video.file' => 'Video harus berupa file.',
            'video.mimes' => 'Video harus berupa file dengan tipe: mp4, mkv, avi.',
            'video.max' => 'Video tidak boleh lebih besar dari 200MB.',
            'quiz.required' => 'Quiz wajib diisi.',
            'quiz.string' => 'Quiz harus berupa teks.',
            'key.required' => 'Kunci jawaban wajib diisi.',
            'key.string' => 'Kunci jawaban harus berupa teks.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Terjadi kesalahan saat memperbarui materi.');
        }
        $validatedData = $validator->validated();

        $materi = Materi::findOrFail($id);
        $materi->modul = $request->input('modul');

        // Simpan file PDF jika ada
        if ($request->hasFile('isi_modul')) {
            $isiModulPath = $request->file('isi_modul')->store('modul', 'public');
            $materi->isi_modul = $isiModulPath;
        }

        // Simpan file video jika ada
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('video', 'public');
            $materi->video = $videoPath;
        }

        $materi->quiz = $request->input('quiz');
        $materi->key = $request->input('key');

        $materi->save();

        return redirect('/edit-materi')->with('success', 'Materi berhasil diperbarui');
    }



    public function destroyMateri($id)
    {
        $materi = Materi::findOrFail($id);
        $materi->delete();

        return response()->json(['message' => 'Materi berhasil dihapus']);
    }

}

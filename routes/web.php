<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return view('login');})->name('index');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('adminhome', function () {
        return view('adminhome'); // Ganti dengan view yang sesuai
    })->name('adminhome');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('homepage', function () {
        return view('homepage'); // Ganti dengan view yang sesuai
    })->name('homepage');
});

Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

Route::get('/forgot-password', function () {return view('forgot-password');})->name('forgot-password');
Route::get('/change-password', function () {return view('change-password');})->name('change-password');

Route::get('/adminhome', [AdminController::class, 'showAdminhome'])->name('adminhome');
Route::post('/adminhome', [AdminController::class, 'adminhome']);

Route::get('/daftaruser', [AdminController::class, 'showDaftaruser'])->name('daftaruser');
Route::post('/daftaruser', [AdminController::class, 'daftaruser']);

Route::get('/tambah-materi', [AdminController::class, 'showTambahmateri'])->name('tambah-materi');
Route::post('/tambah-materi', [AdminController::class, 'store']);

Route::get('/edit-materi', [AdminController::class, 'showEditmateri'])->name('edit-materi');
Route::get('/edit-materi-2/{id}', [AdminController::class, 'editMateri2'])->name('edit-materi-2');
Route::post('/update-materi/{id}', [AdminController::class, 'updateMateri'])->name('update-materi');
Route::delete('/materi/{id}', [AdminController::class, 'destroyMateri'])->name('materi.destroy');

Route::get('/homepage', [PageController::class, 'showHomepage'])->name('homepage');
Route::post('/homepage', [PageController::class, 'homepage']);

Route::get('/profil', [PageController::class, 'showProfil'])->name('profil');
Route::post('/profil', [PageController::class, 'profil']);
Route::post('/update-profil', [PageController::class, 'updateProfil'])->name('update.profil');


Route::get('/materi', [PageController::class, 'showMateri'])->name('materi');
Route::post('/materi', [PageController::class, 'checkMateri']);

Route::get('/materi-2', [PageController::class, 'showMateri2'])->name('materi-2');

Route::get('/materi-3', [PageController::class, 'showMateri3'])->name('materi-3');

Route::get('/video', [PageController::class, 'showVideo'])->name('video');
Route::post('/video', [PageController::class, 'checkVideo']);

Route::get('/video-2', [PageController::class, 'showVideo2'])->name('video-2');
Route::post('/video-2', [PageController::class, 'detailVideo']);

Route::get('/video-3', [PageController::class, 'showVideo3'])->name('video-3');

Route::get('/quiz', [PageController::class, 'showQuiz'])->name('quiz');
Route::post('/quiz', [PageController::class, 'checkQuiz']);

Route::get('/quiz-2', [PageController::class, 'showQuiz2'])->name('quiz-2');
Route::post('/quiz-2', [PageController::class, 'detailQuiz']);

Route::get('/quiz-3', [PageController::class, 'showQuiz3'])->name('quiz-3');

Route::post('/quiz-4', [PageController::class, 'showQuiz4'])->name('quiz-4');

Route::get('/faq', [PageController::class, 'showFaq'])->name('faq');
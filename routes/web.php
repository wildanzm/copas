<?php

use App\Livewire\Student;
use App\Livewire\Teacher;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'role:student'])->prefix('siswa')->name('student.')->group(function () {
    Route::get('dashboard', Student\Dashboard::class)->name('dashboard');
    Route::get('play-room/{nodeId}', Student\PlayRoom::class)->name('play-room');
    Route::get('kuis', Student\Quiz::class)->name('quiz');
    Route::get('kuis/play', Student\PlayQuiz::class)->name('quiz.play');
    Route::get('peringkat', Student\Leaderboard::class)->name('leaderboard');
    Route::get('profil', Student\Profile::class)->name('profile');
    Route::get('tentang', Student\About::class)->name('about');
});

Route::middleware(['auth', 'role:teacher'])->prefix('guru')->name('teacher.')->group(function () {
    Route::get('dashboard', Teacher\Dashboard::class)->name('dashboard');
    Route::get('dashboard-detail', Teacher\DashboardDetail::class)->name('dashboard-detail');
    Route::get('kelas', Teacher\Classroom::class)->name('classroom');
    Route::get('kuis', Teacher\Quiz::class)->name('quiz');
    Route::get('kuis/bank-soal', Teacher\BankSoal::class)->name('bank-soal');
    Route::get('peringkat', Teacher\Leaderboard::class)->name('leaderboard');
    Route::get('profil', Teacher\Profile::class)->name('profile');
    Route::get('tentang', Teacher\About::class)->name('about');
    Route::get('jawaban/{student}', Teacher\AnswerCheck::class)->name('answer-check');
});

require __DIR__.'/settings.php';

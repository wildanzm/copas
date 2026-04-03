<?php

use App\Livewire\Student;
use App\Livewire\Teacher;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'role:student'])->prefix('siswa')->name('student.')->group(function () {
    Route::get('dashboard', Student\Dashboard::class)->name('dashboard');
    Route::get('play-room/{nodeId}', Student\PlayRoom::class)->name('play-room');
});

Route::middleware(['auth', 'role:teacher'])->prefix('guru')->name('teacher.')->group(function () {
    Route::get('dashboard', Teacher\Dashboard::class)->name('dashboard');
});

require __DIR__.'/settings.php';

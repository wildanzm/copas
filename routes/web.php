<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Teacher;
use App\Livewire\Student;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'role:student'])->prefix('siswa')->name('student.')->group(function () {
    Route::get('dashboard', Student\Dashboard::class)->name('dashboard');
});

Route::middleware(['auth', 'role:teacher'])->prefix('guru')->name('teacher.')->group(function () {
    Route::get('dashboard', Teacher\Dashboard::class)->name('dashboard');
});

require __DIR__.'/settings.php';

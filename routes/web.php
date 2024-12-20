<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RegisterController;


// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// routes/web.php
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout.perform');


// Admin Routes
Route::get('/adminfirst', function () {
    return view('adminfirst');
})->name('adminfirst');

// Student Routes
Route::get('/studentfirst', function () {
    return view('studentfirst');
})->name('studentfirst');

// Teacher Routes
Route::get('/teacherfirst', function () {
    return view('teacherfirst');
})->name('teacherfirst');

// Schedule Routes
Route::resource('schedules', ScheduleController::class)->parameters([
    'schedules' => 'schedule'
])->middleware('auth'); // Menambahkan middleware auth agar hanya user yang login bisa mengakses

// Bill Routes
Route::resource('bills', BillController::class)->parameters([
    'bills' => 'bill'
])->middleware('auth');

// Student Routes
Route::resource('students', StudentController::class)->parameters([
    'students' => 'student'
])->middleware('auth');

// Teacher Routes
Route::resource('teachers', TeacherController::class)->except(['show'])->parameters([
    'teachers' => 'teacher'
])->middleware('auth');

// User Routes
Route::resource('users', UserController::class)->middleware('auth');

// Update User IDs
Route::get('/update-student-ids', [StudentController::class, 'updateUserIds'])->middleware('auth');
Route::get('/update-teacher-ids', [TeacherController::class, 'updateUserIds'])->middleware('auth');

// Teacher-Specific Routes
Route::get('/teachersusers', [TeacherController::class, 'teachersUsersIndex'])
    ->name('teachersusers.index')
    ->middleware('auth');

Route::get('/teachers/schedule', [TeacherController::class, 'teacherSchedules'])
    ->name('teachersusers.schedule')
    ->middleware('auth');

// Student-Specific Routes
Route::get('/studentsusers', [StudentController::class, 'studentsUsersIndex'])
    ->name('studentsusers.index')
    ->middleware('auth');

Route::get('/studentsusers/schedule', [StudentController::class, 'studentSchedules'])
    ->name('studentsusers.schedule')
    ->middleware('auth');

Route::get('/studentsusers/bill', [StudentController::class, 'studentBills'])
    ->name('studentsusers.bill')
    ->middleware('auth');

// Menampilkan form pendaftaran
//Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');

// Menyimpan data pendaftaran
//Route::post('/register', [RegisterController::class, 'register'])->name('register.store');


Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/students/search', [StudentController::class, 'search'])->name('students.search');

Route::get('/index', [IndexController::class, 'index']);

Route::post('/students/stores', [StudentController::class, 'stores'])->name('students.stores');


// Home Route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

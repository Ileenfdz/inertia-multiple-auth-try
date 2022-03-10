<?php

use App\Http\Controllers\StandByController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return Redirect::route('login');
})->name('index');

Route::middleware(['auth:sanctum', 'verified', 'standBy'])->get('/dashboard', function() {
    return Redirect::route('standBy');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/admin', [AdminController::class, 'index'])->name('admin');

Route::middleware(['auth:sanctum', 'verified', 'standBy'])->get('/standBy', [StandByController::class, 'index'])->name('standBy');

Route::middleware(['auth:sanctum', 'verified', 'student'])->get('/student', [StudentController::class, 'index'])->name('student');

Route::middleware(['auth:sanctum', 'verified', 'technician'])->get('/technician', [TechnicianController::class, 'index'])->name('technician');

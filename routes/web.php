<?php

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\SchoolGroupController;
Route::resource('schoolGroup',SchoolGroupController::class)
->middleware(['auth', 'verified']);

use App\Http\Controllers\SchoolController;
Route::resource('school',SchoolController::class)
->middleware(['auth', 'verified']);

use App\Http\Controllers\FeatureController;
Route::resource('feature',FeatureController::class)
->middleware(['auth', 'verified']);

use App\Http\Controllers\BookController;
Route::resource('book',BookController::class)
->middleware(['auth', 'verified']);

use App\Http\Controllers\AnimalController;
Route::resource('animal',AnimalController::class)
->middleware(['auth', 'verified']);

use App\Http\Controllers\ControlManagerController;
Route::resource('controlManager',ControlManagerController::class)
->middleware(['auth', 'verified']);

use App\Http\Controllers\SchoolYearController;
Route::resource('schoolYear',SchoolYearController::class)
->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';

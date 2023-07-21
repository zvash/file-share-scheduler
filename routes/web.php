<?php

use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\CustomerController;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\TutorialController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tutorials/{token}', [TutorialController::class, 'visit']);
Route::get('/customers/{customerToken}/tutorials/{tutorialsToken}/download',
    [TutorialController::class, 'guestDownload']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.create');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tutorials', [TutorialController::class, 'index'])->name('tutorials.index');
    Route::post('/tutorials', [TutorialController::class, 'store'])->name('tutorials.create');
    Route::get('/tutorials/{token}/download', [TutorialController::class, 'authDownload']);
});

require __DIR__ . '/auth.php';

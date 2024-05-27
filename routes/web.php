<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChooseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RegispartController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/program', ProgramController::class);
    Route::resource('/ticket', TicketController::class);
    Route::resource('/participant', ParticipantController::class);
    Route::resource('/regispart', RegispartController::class);
    Route::resource('/experience', ExperienceController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/blog', BlogController::class);
    Route::resource('/page', PageController::class);
    Route::get('page/{pageId}/upload', [ChooseController::class, 'index']);
    Route::post('page/{pageId}/upload', [ChooseController::class, 'store']);
    Route::get('choose-image/{chooseImageId}/delete', [ChooseController::class, 'destroy']);
});

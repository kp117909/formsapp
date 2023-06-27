<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuestionsController;
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

Route::get('/', [Controller::class, 'index'])->name('index');

Route::get('/auth.index', [AuthController::class, 'index'])->name('auth.index');

Route::post('/auth.login', [AuthController::class, 'login'])->name('auth.login');


Route::group(['middleware' => ['auth']], function () {

    Route::get('/admin.index', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/auth.logout',  [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/forms.index/{id}',  [FormsController::class, 'showSurvey'])->name('forms.index');

    Route::post('/forms.store', [FormsController::class, 'store'])->name('forms.store');

    Route::post('/questions.store', [QuestionsController::class, 'store'])->name('questions.store');

    Route::get('/questions.delete', [QuestionsController::class, 'delete'])->name('questions.delete');

    Route::get('/options.store', [OptionController::class, 'store'])->name('options.store');

});


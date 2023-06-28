<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\GuestController;
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

Route::get('/', [GuestController::class, 'index'])->name('index');

Route::get('/guest/forms', [GuestController::class, 'index'])->name('guest.forms');

Route::get('/guest/index/{id}',  [GuestController::class, 'showSurvey'])->name('forms.guest');

Route::get('/guest/form/{slug}', [GuestController::class, 'showSlug'])->name('forms.showSlugGuest');

Route::post('/survey/submit', [GuestController::class, 'storeResponseSurvey'])->name('survey.submit');

Route::get('/auth/index', [AuthController::class, 'index'])->name('auth.index');

Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');


Route::group(['middleware' => ['auth']], function () {

    Route::get('/admin.index', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/auth/logout',  [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/forms/index/{id}',  [FormsController::class, 'showSurvey'])->name('forms.index');

    Route::post('/forms/store', [FormsController::class, 'store'])->name('forms.store');

    Route::get('/forms/edit',  [FormsController::class, 'edit'])->name('forms.edit');

    Route::get('/forms/delete',  [FormsController::class, 'delete'])->name('forms.delete');

    Route::get('/forms/{slug}', [FormsController::class, 'show'])->name('forms.show');

    Route::post('/questions/store', [QuestionsController::class, 'store'])->name('questions.store');

    Route::get('/questions/edit', [QuestionsController::class, 'edit'])->name('questions.edit');

    Route::get('/questions/delete', [QuestionsController::class, 'delete'])->name('questions.delete');

    Route::get('/options/store', [OptionController::class, 'store'])->name('options.store');

    Route::get('/options/delete', [OptionController::class, 'delete'])->name('options.delete');

    Route::get('/options/edit', [OptionController::class, 'edit'])->name('options.edit');
});


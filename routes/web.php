<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [PostController::class, 'index']);
Route::get('/post/{post}', [PostController::class, 'show'])->name('posts.single');
Route::get('/about-me', function () {
    return view('pages.about');
})->name('about');

Auth::routes(['verify' => true]);
Route::get('/account/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/account/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('/account/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/account/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

/*Resetowanie hasła*/
Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

/*Panel Admina CRUD dla Postów*/
Route::get('admin/post/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('admin.post.create');
Route::post('admin/post/create', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('admin.post.create'); /*Taka sama nazwa */
Route::get('admin/post/edit/{id}', [App\Http\Controllers\Admin\PostController::class, 'edit'])->name('admin.post.edit');
Route::put('admin/post/edit/{id}', [App\Http\Controllers\Admin\PostController::class, 'update'])->name('admin.post.edit');/*Nazwa taka sama i jeszcze z argumentem w route w post.blade.php*/
Route::delete('admin/post/edit/{id}', [App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('admin.post.delete');
/*Jedna droga do Controller dla dodawania komentarzy do postów*/
Route::post('/comment/create', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.create');

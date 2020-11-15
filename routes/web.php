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
/*Rout to view email locally*/
Route::get('/mail', function () {
    $user = App\Models\User::first();
 // problem z cache.
    return new App\Mail\UserRegistered($user);
});

/*Wysyłanie maila do użytkownika*/
Route::get('/contact',[\App\Http\Controllers\ContactController::class,'show'])->name('contact');
Route::post('/contact',[\App\Http\Controllers\ContactController::class,'send']);

/*Szukanie na główniej stronie*/
Route::get('/search',[\App\Http\Controllers\SearchController::class, 'index'])->name('search');

/*Do rrs sie podświetla ale działa */
Route::feeds(); // działa ale problemy z cache i config.

/*User profile*/
Route::get('/user/{name}', [App\Http\Controllers\User\UserController::class, 'show'])->name('user.profile');

/*Main and basic*/
Route::get('/', [PostController::class, 'index']);
Route::get('/post/{slug}', [PostController::class, 'show'])->name('posts.single');
Route::get('/about-me', function () {
    return view('pages.about');
})->name('about');

/*User acc register, login and logout*/
//Auth::routes(['verify' => true]);
Route::get('/account/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/account/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('/account/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/account/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/account/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

/*User verification*/
Route::get('/account/verify{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::get('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');

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

/*Wyświetlania postów po tagach*/
Route::get('/tag/{slug}',[App\Http\Controllers\TagController::class,'index'])->name('posts.tags');

<?php
use App\Http\Controllers\PostController;
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

Route::get('/',[PostController::class,'index'] );
Route::get('/post/{post}',[PostController::class, 'show'])->name('posts.single');
Route::get('/about-me', function (){
    return view('pages.about');
})->name('about');

Auth::routes(['verify'=>true]);
Route::get('/account/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/account/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('/account/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/account/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('/email/verify/{id}/{hash}', [ App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');

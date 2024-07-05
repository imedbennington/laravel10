<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\AuthController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\FollowerController;
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
/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('users.profile');
});

Route::get('/feed', function () {
    return view('feed');
});*/
Route::middleware('web')->group(function () {
    // Include authentication routes
    require __DIR__.'/authRoutes/AuthRoutes.php';

    // Other routes can go here
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
/*
Route::post('/idea', [IdeaController::class, 'store'])->name('idea.create')->middleware('auth');
Route::get('/idea/{idea}', [IdeaController::class, 'show'])->name('idea.show')->middleware('auth');
Route::get('/idea/{idea}/edit', [IdeaController::class, 'edit'])->name('idea.edit')->middleware('auth');
Route::put('/idea/{idea}', [IdeaController::class, 'update'])->name('idea.update')->middleware('auth');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::delete('/idea/{idea}', [IdeaController::class, 'destroy'])->name('idea.destroy')->middleware('auth');
Route::post('/idea/{idea}/comments', [CommentController::class, 'store'])->name('ideas.comments.store')->middleware('auth');
Route::get('/terms', function() {
    return view('terms');
});
*/
Route::group(['prefix' => 'ideas', 'as' => 'ideas.'], function() {
    Route::post('/', [IdeaController::class, 'store'])->name('create')->middleware('auth');
    Route::get('/{idea}', [IdeaController::class, 'show'])->name('show');
    Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit')->middleware('auth');
    Route::put('/{idea}', [IdeaController::class, 'update'])->name('update')->middleware('auth');
    Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('destroy')->middleware('auth');
    Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
});
Route::get('profile',[UserController::class, 'profile'])->name('profile')->middleware('auth');
Route::resource('users',UserController::class)->only('show','edit','update')->middleware('auth');
Route::post('users/{user}/follow',[FollowerController::class,'follow'])->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow',[FollowerController::class,'unfollow'])->middleware('auth')->name('users.unfollow');
Route::get('/terms',function(){
    return view('terms');
})->name('terms');
//Route::resource('ideas',IdeaController::class)->except('index');
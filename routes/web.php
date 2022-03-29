<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\{BlogController, CategoryController};
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
    return view('welcome');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'attemptLogin'])->name('login');

    Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('/register', [AuthenticationController::class, 'attemptRegister'])->name('register');

    Route::get('auth/{provider}', [AuthenticationController::class, 'redirectToProvider'])->name('auth-provider');
    Route::get('auth/{provider}/callback', [AuthenticationController::class, 'handleProviderCallback'])->name('auth-provider.callback');
});

Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');


Route::get('/email/verify', function () {
    return view('auth.verify',['request'=>request()->user()]);
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    // $request->user()->sendEmailVerificationNotification();
    $request->user()->sendEmailVerificationNotification();
    // return back()->with('message', 'Verification link sent!');
    return response()->json(['success'=>'Anda berhasil mengirimkan ulang verifikasi.']);
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/forgot',[AuthenticationController::class,'forgot'])->name('forgot');


Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route Blogs
    Route::controller(BlogController::class)->group(function ()
    {
        Route::get('/blogs',  'get')->name('blogs');
        Route::get('/data-blogs','getBlog')->name('data-blogs');
        Route::get('/blog/{blog:slug}',  'detail')->name('blog');
        Route::post('/insert-blog',  'insert')->name('insert-blog');
        Route::get('/update-blog/{blog:slug}',  'edit')->name('update-blog');
        Route::patch('/update-blog/{blog:slug}',  'update')->name('update-blog');
        Route::delete('/delete-blog/{blog:slug}',  'delete')->name('delete-blog');
    });

    // Route Category
    Route::controller(CategoryController::class)->group(function ()
    {
        
        Route::get('/categories','get')->name('categories');
        Route::get('/category/{category:slug}',  'detail')->name('category');
        Route::post('/insert-category',  'insert')->name('insert-category');
        Route::get('/update-category/{category:slug}',  'edit')->name('update-category');
        Route::patch('/update-category/{category:slug}',  'update')->name('update-category');
        Route::delete('/delete-category/{category:slug}',  'delete')->name('delete-category');
    });
});

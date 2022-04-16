<?php

use App\Http\Controllers\Api\{
    AuthController,
    BlogController,
    CategoryController,
    PasswordController,
    UserController,
    VerifyEmailController
};

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});

Route::controller(PasswordController::class)->group(function () {
    Route::post('forgot-password', 'forgotPassword');
    Route::post('reset-password', 'resetPassword');
});

Route::controller(VerifyEmailController::class)->group(function () {
    Route::post('email/verification-notification', 'sendVerificationEmail')->middleware('auth:sanctum');
    Route::get('verify-email/{id}/{hash}', 'verify')->middleware('auth:sanctum')->name('verification.verify');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('user/{user:email}', function (User $user) {
        return response()->json(['data' => $user, 'message' => 'Data has been get successfully'], 200);
    });
    Route::put('user/{user:email}', [UserController::class, 'update']);

    Route::get('blogs', [BlogController::class, 'get']);
    Route::get('blogs/{slug}', [BlogController::class, 'getBySlug']);
    Route::post('blogs', [BlogController::class, 'insert']);
    Route::put('blogs/{blog:slug}', [BlogController::class, 'update']);
    Route::delete('blogs/{blog:slug}', [BlogController::class, 'delete']);

    Route::get('blogsbycategory/{slug}', [BlogController::class, 'getByCategory']);
    Route::get('categories', [CategoryController::class, 'get']);
    Route::get('categories/{category:slug}', [CategoryController::class, 'getBySlug']);
    Route::post('categories', [CategoryController::class, 'insert']);

    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('product/{slug},[ProductController::class,'addData'])->name('product');
});

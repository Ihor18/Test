<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::apiResource('/post', PostController::class);
Route::post('/post/vote/{post}', [PostController::class, 'vote']);

Route::controller(CommentController::class)->group(function () {
    Route::get('/post/comment/{post}', 'getByPost');
    Route::prefix('comment')->group(function () {
        Route::get('/', 'index');
        Route::post('/{post}', 'store');
        Route::get('/{comment}', 'show');
        Route::put('/{comment}', 'update');
        Route::delete('/{comment}', 'destroy');
    });
});



<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::group(['middleware' => ['api']], function() {
    Route::get('/books/{id?}', [BookController::class, 'getBooks']);
    Route::post('/books/', [BookController::class, 'newBook']);
    Route::patch('/books/{id}', [BookController::class, 'editBook']);
    Route::delete('/books/{id}', [BookController::class, 'deleteBook']);
});

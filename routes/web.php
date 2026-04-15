<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::get('/todos/edit/{todo}', [TodoController::class, 'edit'])->name('todos.edit');
    Route::put('todos/edit/{todo}', [TodoController::class, 'update'])->name('todos.update');
    Route::delete('todos/delete/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
});

require __DIR__.'/auth.php';
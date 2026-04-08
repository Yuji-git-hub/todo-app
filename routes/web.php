<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::get('/todos/edit/{todo}', [TodoController::class, 'edit'])->name('todos.edit');
Route::put('todos/edit/{todo}', [TodoController::class, 'update'])->name('todos.update');
Route::delete('todos/delete', [TodoController::class, 'delete'])->name('todos.delete');
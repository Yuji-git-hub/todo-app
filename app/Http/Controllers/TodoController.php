<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();

        return view('todos.index', ['todos' => $todos]);
    }

    public function store(TodoRequest $request)
    {
        Todo::create($request->validated());

        return redirect()->route('todos.index');
    }
}
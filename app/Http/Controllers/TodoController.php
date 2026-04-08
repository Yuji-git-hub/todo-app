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

        return redirect()->route('todos.index')
                         ->with('success', 'リストが作成されました。');
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', ['todo' => $todo]);
    }

    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->update($request->validated());

        return redirect()->route('todos.index')
                         ->with('success', '更新されました。');
    }

    public function delete(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index')
                         ->with('success', '削除されました。');
    }
}
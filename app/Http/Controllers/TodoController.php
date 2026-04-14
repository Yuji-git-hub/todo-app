<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Auth::user()->todos;

        return view('todos.index', ['todos' => $todos]);
    }

    public function store(TodoRequest $request)
    {
        Auth::user()->todos()->create([
            'title' => $request->title,
        ]);

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
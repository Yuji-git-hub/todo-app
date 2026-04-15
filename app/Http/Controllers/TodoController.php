<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    use AuthorizesRequests;

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
        $this->authorize('update', $todo);

        return view('todos.edit', ['todo' => $todo]);
    }

    public function update(TodoRequest $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        $todo->update($request->validated());

        return redirect()->route('todos.index')
                         ->with('success', '更新されました。');
    }

    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);

        $todo->delete();

        return redirect()->route('todos.index')
                         ->with('success', '削除されました。');
    }
}
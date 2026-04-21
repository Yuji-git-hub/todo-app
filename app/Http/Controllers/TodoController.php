<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TodoController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): View
    {
        $query = Auth::user()->todos()
            ->orderBy('is_completed', 'asc');

        if($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        if($request->filled('status')) {
            if($request->status === 'completed') {
                $query->where('is_completed', 1);
            } else if ($request->status === 'incomplete') {
                $query->where('is_completed', 0);
            }
        }

        $todos = $query->simplePaginate(10)->withQueryString();

        return view('todos.index', ['todos' => $todos]);
    }

    public function store(TodoRequest $request): RedirectResponse
    {
        Auth::user()->todos()->create([
            'title' => $request->title,
        ]);

        return redirect()->route('todos.index')
                         ->with('success', 'リストが作成されました。');
    }

    public function edit(Todo $todo): View
    {
        $this->authorize('update', $todo);

        return view('todos.edit', ['todo' => $todo]);
    }

    public function update(TodoRequest $request, Todo $todo): RedirectResponse
    {
        $this->authorize('update', $todo);

        $todo->update($request->validated());

        return redirect()->route('todos.index')
                         ->with('success', '更新されました。');
    }

    public function destroy(Todo $todo): RedirectResponse
    {
        $this->authorize('delete', $todo);

        $todo->delete();

        return redirect()->route('todos.index')
                         ->with('success', '削除されました。');
    }

    public function toggle(Todo $todo): RedirectResponse
    {
        $this->authorize('update', $todo);

        $todo->update([
            'is_completed' => !$todo->is_completed,
        ]);

        return redirect()->route('todos.index')
                         ->with('success', 'ステータスを更新しました。');
    }
}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo一覧</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-5xl mx-auto p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">
                {{ Auth::user()->name }}さんのTodo一覧
            </h1>

            @auth
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
            @endauth
        </div>

        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success')}}
        </div>
        @endif

        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">タイトル作成</h2>
            <form action="/todos" method="post" class="flex gap-2">
                @csrf
                <input type="text" name="title" value="{{ old('title') }}" placeholder="タイトルを入力" class="border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    作成
                </button>
            </form>
            <hr class="full-width-line">
        </div>

        <div class="flex gap-2 mb-6 items-center">
            <form action="{{ route('todos.index') }}" method="get" class="flex gap-2">
                <input type="text" name="keyword" value="{{ request('keyword') }}" class="border rounded px-3 py-2">

                <select name="status" class="border rounded px-2 py-2 pr-8">
                    <option value="">すべて</option>
                    <option value="incomplete" {{ request('status') === 'incomplete' ? 'selected' : '' }}>未完了</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>完了</option>
                </select>

                <select name="sort" class="border rounded px-2 py-2 pr-4">
                    <option value="">並び替え</option>
                    <option value="created_desc">新しい順</option>
                    <option value="created_asc">古い順</option>
                    <option value="incomplete_first">未完了優先</option>
                    <option value="completed_first">完了優先</option>
                </select>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    検索
                </button>
            </form>

            <form action="{{ route('todos.index') }}" method="get">
                <button type="submit">リセット</button>
            </form>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full [&_td]:p-4 [&_th]:p-4  [&_tr]:border-t [&_tr]:bg-gray-50 border-collapse">
                <thead class="[&_th]:text-center">
                    <tr>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="[&_td]:text-center">
                    @foreach($todos as $todo)
                    <tr>
                        <td class="todo-item">{{ $todo->title }}</td>
                        <td>
                            @can('update', $todo)
                                <a href="{{ route('todos.edit', $todo) }}" class="inline-block bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">編集</a>
                            @endcan
                        </td>
                        <td>
                            @can('delete', $todo)
                                <form action="{{ route('todos.destroy', $todo) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block bg-red-300 px-3 py-1 rounded hover:bg-red-600">削除</button>
                                </form>
                            @endcan
                        </td>
                        <td>
                            @if($todo->is_completed)
                                <span class="inline-block bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm">
                                    完了
                                </span>
                            @else
                                <span class="inline-block bg-green-100 text-green-600 px-3 p-2 rounded-full text-sm">
                                    未完了
                                </span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('todos.toggle', $todo) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <button type="submit">
                                    {{ $todo->is_completed ? '未完了に戻す' : '完了にする' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-content-center mt-4">
            {{ $todos->appends(request()->query())->links()  }}
        </div>
    </div>
</body>
</html>
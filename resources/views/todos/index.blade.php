<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo一覧</title>
    <style>
        .todo-item::before {content: "・";}
        .btn {
            display: inline-block;
            padding: 6px 12px;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #2779bd;
        }
    </style>
</head>
<body>
    <h1>{{ Auth::user()->name }}さんのTodo一覧</h1>

    @if(session('success'))
        <div>
            <p style="color: red">{{ session('success')}}</p>
        </div>
    @endif
    <div>
        <h2>タイトル作成</h2>
        <form action="/todos" method="post">
            @csrf
            <input type="text" name="title" value="{{ old('title') }}">
            <input type="submit" value="作成">
        </form>
    </div>

    <div>
        <table>
            <tr>
                <th><h2>やることリスト</h2></th>
            </tr>
            @foreach($todos as $todo)
            <tr>
                <td class="todo-item">{{ $todo->title }}</td>
                <td>
                    <a href="{{ route('todos.edit', $todo) }}" class="btn">編集</a>
                </td>
                <td>
                    <form action="{{ route('todos.delete', $todo) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
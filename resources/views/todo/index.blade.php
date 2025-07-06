<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todo一覧画面</title>
</head>
<body>
    @if(session('success'))
        {{ session('success') }}
    @endif

    <h1>{{ Auth::user()->name }}さんのToDoリスト</h1>

    <a href="{{ route('todos.create') }}">+ 新規作成</a>
    <table>
        <thead>
            <tr>
                <th>タイトル</th>
                <th>内容</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todos as $todo)
            <tr>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->content }}</td>
                <td>
                    <a href="{{ route('todos.edit', $todo->id) }}">
                        <button type="submit">編集</button>
                    </a>
                </td>
                <td>
                    <form action="{{ route('todos.destroy', $todo->id) }}" method="post">
                        @csrf
                        @method('delete')
                            <button type="submit">削除</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('todos.toggle', $todo->id) }}">
                        @csrf
                        @method('patch')
                        <button type="submit">
                            {{ $todo->is_completed ? '未完了' : '完了' }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
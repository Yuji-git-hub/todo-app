<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>タイトル</th>
                <th>内容</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $todo->id }}</td>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->content }}</td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('todos.index') }}">
        <button>戻る</button>
    </a>
</body>
</html>
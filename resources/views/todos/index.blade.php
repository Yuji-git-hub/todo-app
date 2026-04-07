<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo一覧</title>
</head>
<body>
    <h1>Todo一覧</h1>

    <div>
        <table>
            <tr>
                <th>やることリスト</th>
            </tr>
            @foreach($todos as $todo)
            <tr>
                <td>{{ $todo->title }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
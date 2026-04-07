<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo一覧</title>
    <style>
        .todo-item::before {content: "・";}
    </style>
</head>
<body>
    <h1>Todo一覧</h1>

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
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
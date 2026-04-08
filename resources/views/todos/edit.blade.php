<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タイトル編集画面</title>
</head>
<body>
    <h1>タイトル編集画面</h1>

    <div>
        <h2>タイトル入力</h2>
        <form action="{{ route('todos.update', $todo) }}" method="post">
            @csrf
            @method('PUT')
            <input type="text" name="title" value="{{ old('title') }}">
            <input type="submit" value="更新">
        </form>
    </div>
</body>
</html>
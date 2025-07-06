<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('todos.update', $todo->id) }}" method="post">
        @csrf
        @method('PUT')

        <div>
            <label for="title">タイトル: </label>
            <input type="text" name="title" id='title' value="{{ old('title', $todo->title ?? '') }}">

            @error('title')
                <div style="color: red">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="content">内容: </label>
            <textarea name="content" id="content">{{ old('content', $todo->content ?? '') }}</textarea>

            @error('content')
                <div style="color: red">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">更新</button>
    </form>
    <a href="{{ route('todos.index') }}">
        <button>戻る</button>
    </a>
</body>
</html>
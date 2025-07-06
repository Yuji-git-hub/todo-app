<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('todos.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">タイトル:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">

            @error('title')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="content">内容</label>
            <textarea name="content" id="content">{{ old('content') }}</textarea>

            @error('content')
                <div style="color: red">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">登録</button>
    </form>
</body>
</html>
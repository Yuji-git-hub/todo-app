<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo一覧</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-64UC4BEhTGwk3eGpak4nO2jqtl7liTS+juXkSJ2gPAQPmlClQO7s5UgCeR6US48g" crossorigin="anonymous">
    <style>
        h2 {
            margin-top: 70px;
        }
        table {
            margin-top: 20px;
        }
        th {
            padding: 5px 10px;
            background-color: gray;
            color: white;
        }
        td {
            text-align: center;
            border: solid 1px;
            padding: 5px 10px;
        }
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
        .full-width-line {
            margin: 60px 0;
            width: 100vw;
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
            <input type="text" name="title" value="{{ old('title') }}" placeholder="タイトルを入力">
            <input type="submit" value="作成">
        </form>
        <hr class="full-width-line">
    </div>

    <div class="table">
        <div style="display: flex; gap: 10px">
            <form action="{{ route('todos.index') }}" method="get">
                <input type="text" name="keyword" value="{{ request('keyword') }}">
                <button type="submit">検索</button>
            </form>
            <form action="{{ route('todos.index') }}" method="get">
                <button type="submit">全件表示</button>
            </form>
        </div>
        <table>
            <tr>
                <th>Title</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Status</th>
                <th></th>
            </tr>
            @foreach($todos as $todo)
            <tr>
                <td class="todo-item">{{ $todo->title }}</td>
                <td>
                    @can('update', $todo)
                        <a href="{{ route('todos.edit', $todo) }}" class="btn">編集</a>
                    @endcan
                </td>
                <td>
                    @can('delete', $todo)
                        <form action="{{ route('todos.destroy', $todo) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">削除</button>
                        </form>
                    @endcan
                </td>
                <td style="background-color: {{ $todo->is_completed ? 'red' : 'lightgreen' }}">
                    {{ $todo->is_completed ? '完了' : '未完了' }}
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
        </table>
        <div class="d-flex justify-content-center">
            {{ $todos->appends(request()->query())->links()  }}
        </div>
    </div>
</body>
</html>
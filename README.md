# Todo App

Laravelで作成したTodo管理アプリです。
ユーザーごとにタスクを管理できるようにしました。

## URL

https://github.com/Yuji-git-hub/todo-app

## 主な機能

- ユーザー登録 / ログイン / ログアウト
- Todo作成
- Todo編集 / 削除
- 完了/未完了切り替え
- キーワード検索
- ステータス絞り込み
- 並び替え
- ページネーション

## 使用技術

- Laravel 12
- PHP 8.4.4
- MySQL
- Tailwind CSS
- Docker / Laravel Sail

## 工夫した点

- Policyを使って他人のTodoを編集・削除できないようにしました。
- キーワード検索、絞り込み、並び替えを同時利用できるようにしました。
- Tailwind CSSでシンプルで見やすいUIを意識しました。

## 今後追加したい機能

- 締切日設定
- 優先度設定
- カレンダー表示
- Ajax化

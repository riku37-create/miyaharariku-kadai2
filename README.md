＃　アプリケーション名

##　環境
・Laravel:
・Php:
・Database:MySQL
・その他:

＃＃　環境構築
```
1. 下記でディレクトリ内にクローンしてください。
  $ git@github.com:riku37-create/miyaharariku-kadai2.git
2. 開発環境を構築するため、以下のコマンドを実行してください。
  $ docker-compose up -d --build
3. Laravel のパッケージのインストールを行うため下記のコマンドを実行してください。
  $ docker-compose exec php bash
  $ composer install
4. データベースに接続するために、.env.exampleファイルをコピーして、.envファイルを作成します。
PHPコンテナ内で、以下のコマンドを実行してください。
  $ cp .env.example .env
5. VSCode から.envファイルの11行目以降を以下のように修正してください。  
  // 前略
  
  DB_CONNECTION=mysql
  - DB_HOST=127.0.0.1
  + DB_HOST=mysql
  DB_PORT=3306
  - DB_DATABASE=laravel
  - DB_USERNAME=root
  - DB_PASSWORD=
  + DB_DATABASE=laravel_db
  + DB_USERNAME=laravel_user
  + DB_PASSWORD=laravel_pass
  
  // 後略
6. アプリケーションを実行できるように、PHPコンテナで以下のコマンドを実行してください。
  $ php artisan key:generate
7. マイグレーションとシーディング

  エラーが発生する場合は、以下のコマンドを実行しもう一度コマンドを実行しなおしてみましょう。
  $ sudo chmod -R 777 *
```

##　ER図

##　URL

## ディレクトリ構成



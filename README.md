# coachtech-Furima

## 環境構築

Dockerビルド

```bash
1.　git clone git@github.com:105lovechildren-yui/coachtech-Furima.git
2.　DockerDesktopアプリを立ち上げる
3.　docker-compose up -d --build
```

## Laravel環境構築

1. パッケージのインストール

```bash
docker-compose exec php composer install
```

2. 「.env.example」ファイルを コピーし「.env」ファイルに命名を変更。
   .envに以下の環境変数を追加

```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

3. アプリケーションキーの生成

```bash
docker-compose exec php php artisan key:generate
```

4. マイグレーションの実行

```bash
docker-compose exec php php artisan migrate
```

5. シーディングの実行

```bash
docker-compose exec php php artisan db:seed
```

## 権限エラーが発生した場合

開発環境によっては、ファイルの所有者が異なり Permission denied エラーが発生する場合があります。
その場合は以下のコマンドで権限を修正してください。

```bash
sudo chown -R $USER:$USER src
```

必要に応じて、書き込み権限も付与します。

```bash
sudo chmod -R 775 src
```

※ 本環境では、docker-compose exec -u www-data を使用すると、ファイルの所有者が www-data となり、ホスト側で編集できなくなる可能性があります。そのため、開発時は -u オプションを付けずにコマンドを実行しています。

## 開発環境

・ログインページ:http://localhost/login
・新規会員登録ページ:http://localhost/register
・商品一覧ページ:http://localhost/
・phpMyAdmin:http://localhost:8080/

## 使用技術（実行環境）

・PHP 8.1.34
・Laravel 8.83.8
・Composer version 2.7.1 2024-02-09 15:26:28
・Mysql 8.0.26
・nginx 1.21.1

## ER図

![ER図](./images/ER図.png)

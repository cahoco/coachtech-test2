# mogitate

## 環境構築

### 1.リポジトリのクローン

```bash
git clone git@github.com:cahoco/coachtech-test2.git
cd coachtech-test2
```

### 2.Docker起動
```
docker-compose up -d --build  
```
### 3.Laravel環境構築
```
docker-compose exec php php artisan migrate:fresh --seed  
```

---

#### よくあるエラーと対処法

##### 「File not found」エラー

- nginx の `default.conf` の `root` が `/var/www/public` になっているか確認
- Laravel の `public` ディレクトリが `/src/public` にあるか確認

##### 「このサイトにアクセスできません（Connection Refused）」

- `php artisan serve` は使わず、`nginx` 経由でアクセスする
- `http://localhost:8000` ではなく `http://localhost` にアクセスする  

---

### Laravel設定  
#### .env に以下を記述
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
#### その他初期設定  
```
# アプリケーションキー作成（必要な場合）
docker-compose exec php php artisan key:generate  

# マイグレーション（必要に応じて）
docker-compose exec php php artisan migrate  

# データベースシーディング
docker-compose exec php php artisan db:seed  
```

## 使用技術(実行環境)
* PHP 7.4.9
* Laravel 8.83.8
* MySQL 8.0.26
* nginx 1.21.1
* phpMyAdmin 最新

## ER図
<img width="513" alt="スクリーンショット 2025-04-01 14 18 50" src="https://github.com/user-attachments/assets/1184e9be-9c1f-4cff-a8f5-390bd6859a6f" />


## URL
* 開発環境：http://localhost/
* phpMyAdmin：http://localhost:8080/

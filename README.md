# mogitate

## 環境構築

#### Dockerビルド

1. `git@github.com:cahoco/coachtech-test2.git`  
2. DockerDesktopアプリを立ち上げる  
3. `docker-compose up -d --build`

#### Laravel環境構築
1. `docker-compose exec php bash`  
2. `composer install`  
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成  
4. .envに以下の環境変数を追加  
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成  
```
php artisan key:generate
```  
6. マイグレーションの実行  
```
php artisan migrate
```  
7. シーディングの実行
```
php artisan db:seed
```  
## 使用技術(実行環境)
* PHP7.4.9
* Laravel8.83.8
* MySQL

## ER図
<img width="513" alt="スクリーンショット 2025-04-01 14 18 50" src="https://github.com/user-attachments/assets/1184e9be-9c1f-4cff-a8f5-390bd6859a6f" />


## URL
* 開発環境：http://localhost/
* phpMyAdmin：http://localhost:8080/

# test2
# coachtech もぎたて

## 環境構築

### Dockerビルド
1. git clone
2. docker-compose up -d --build

### Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. .env.example をコピーして .env を作成
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed

## 使用技術
- PHP 8.x
- Laravel 8.x
- MySQL
- Docker
- nginx
- 
## URL
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/

# ER図
```mermaid
erDiagram

products {
    bigint id PK
    string name
    integer price
    string image
    text description
    timestamp created_at
    timestamp updated_at
}

seasons {
    bigint id PK
    string name
    timestamp created_at
    timestamp updated_at
}

product_season {
    bigint id PK
    bigint product_id FK
    bigint season_id FK
    timestamp created_at
    timestamp updated_at
}

products ||--o{ product_season : ""
seasons ||--o{ product_season : ""
```

# test2
# ER図
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

# Entity Relationship Diagram

The database schema consists of the following tables (2nd normal form):

- **users**: id (PK), last_name, first_name, middle_initial, email, password, photo_path, role, is_active, email_verified_at
- **categories**: id (PK), name, description
- **products**: id (PK), name, description, price, stock, category_id (FK), is_active
- **product_images**: id (PK), product_id (FK), path
- **reviews**: id (PK), user_id (FK), product_id (FK), rating, comment
- **transactions**: id (PK), user_id (FK), total, status
- **transaction_items**: id (PK), transaction_id (FK), product_id (FK), quantity, price

**Relationships:**

| From | To | Cardinality | Description |
|------|----|-------------|-------------|
| users | reviews | 1 to many | a user writes reviews |
| users | transactions | 1 to many | a user places transactions |
| categories | products | 1 to many | a category contains products |
| products | product_images | 1 to many | a product has images |
| products | reviews | 1 to many | a product receives reviews |
| transactions | transaction_items | 1 to many | a transaction includes items |
| products | transaction_items | 1 to many | a product is sold in transaction items |


**ERD Diagram:**

```mermaid
erDiagram
    users {
        int id PK
        string last_name
        string first_name
        string middle_initial
        string email
        string password
        string photo_path
        string role
        boolean is_active
        datetime email_verified_at
    }

    categories {
        int id PK
        string name
        string description
    }

    products {
        int id PK
        string name
        string description
        decimal price
        int stock
        int category_id FK
        boolean is_active
    }

    product_images {
        int id PK
        int product_id FK
        string path
    }

    reviews {
        int id PK
        int user_id FK
        int product_id FK
        int rating
        string comment
    }

    transactions {
        int id PK
        int user_id FK
        decimal total
        string status
    }

    transaction_items {
        int id PK
        int transaction_id FK
        int product_id FK
        int quantity
        decimal price
    }

    users ||--o{ reviews : "writes"
    users ||--o{ transactions : "places"
    categories ||--o{ products : "contains"
    products ||--o{ product_images : "has"
    products ||--o{ reviews : "receives"
    transactions ||--o{ transaction_items : "includes"
    products ||--o{ transaction_items : "sold in"


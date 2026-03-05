# Entity Relationship Diagram

Below is the mermaid markup used in the README. Use a mermaid renderer to visualize the database structure.

```mermaid
erDiagram
    USERS {
        PK id
        string last_name
        string first_name
        string middle_initial
        string email
        string password
        string photo_path
        string role
        bool is_active
        timestamp email_verified_at
    }
    CATEGORIES {
        PK id
        string name
        text description
    }
    PRODUCTS {
        PK id
        string name
        text description
        decimal price
        int stock
        FK category_id
        bool is_active
    }
    PRODUCT_IMAGES {
        PK id
        FK product_id
        string path
    }
    REVIEWS {
        PK id
        FK user_id
        FK product_id
        tinyint rating
        text comment
    }
    TRANSACTIONS {
        PK id
        FK user_id
        decimal total
        string status
    }
    TRANSACTION_ITEMS {
        PK id
        FK transaction_id
        FK product_id
        int quantity
        decimal price
    }

    USERS ||--o{ REVIEWS : "writes"
    USERS ||--o{ TRANSACTIONS : "places"
    CATEGORIES ||--o{ PRODUCTS : "contains"
    PRODUCTS ||--o{ PRODUCT_IMAGES : "has"
    PRODUCTS ||--o{ REVIEWS : "receives"
    TRANSACTIONS ||--o{ TRANSACTION_ITEMS : "includes"
    PRODUCTS ||--o{ TRANSACTION_ITEMS : "sold in"
```

# 🛠️ Smart ERP API – Usage Guide

This guide provides instructions for testing key API endpoints using tools like Postman, or `curl`.

## 🔐 Authentication – Login

**Endpoint**:  
`POST /api/login`

**URL**:  
`http://127.0.0.1:8000/api/login`

**Headers**:
```http
Accept: application/json  
Content-Type: application/json
```

**Body (JSON)**:
```json
{
  "email": "admin@example.com",
  "password": "password"
}
```

**Response**:  
Returns an authentication token (`access_token`) to be used in all subsequent requests.

---

## 📦 GET All Products

**Endpoint**:  
`GET /api/products`

**URL**:  
`http://127.0.0.1:8000/api/products`

**Headers**:
```http
Accept: application/json  
Authorization: Bearer YOUR_TOKEN_HERE
```

**Response**:
```json
[
  {
    "id": 1,
    "name": "Product A",
    "sku": "A100",
    "price": 100.0,
    "quantity": 10
  },
  ...
]
```

---

## 📝 Create Sales Order

**Endpoint**:  
`POST /api/sales-orders`

**URL**:  
`http://127.0.0.1:8000/api/sales-orders`

**Headers**:
```http
Accept: application/json  
Content-Type: application/json  
Authorization: Bearer YOUR_TOKEN_HERE
```

**Body (JSON)**:
```json
{
  "customer_name": "John Doe",
  "products": [
    {
      "product_id": 1,
      "quantity": 2
    },
    {
      "product_id": 3,
      "quantity": 1
    }
  ]
}
```

**Response**:
```json
{
  "message": "Sales order created successfully",
  "order": {
    "id": 1,
    "customer_name": "John Doe",
    "total_amount": 500.0,
    "created_at": "2025-06-18T10:00:00Z",
    ...
  }
}
```

---

## 🔍 Get Sales Order Details

**Endpoint**:  
`GET /api/sales-orders/{id}`

**Example URL**:  
`http://127.0.0.1:8000/api/sales-orders/1`

**Headers**:
```http
Accept: application/json  
Authorization: Bearer YOUR_TOKEN_HERE
```

**Response**:
```json
{
  "id": 1,
  "customer_name": "John Doe",
  "products": [
    {
      "name": "Product A",
      "quantity": 2,
      "price": 100.0
    }
  ],
  "total_amount": 200.0,
  "created_at": "2025-06-18T10:00:00Z"
}
```

---

## 🧪 Quick Test Commands with `curl`

```bash
# Login
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"email": "admin@example.com", "password": "password"}'

# Get Products
curl -X GET http://127.0.0.1:8000/api/products \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"

# Create Sales Order
curl -X POST http://127.0.0.1:8000/api/sales-orders \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -d '{
        "customer_name": "John Doe",
        "products": [
          {"product_id": 1, "quantity": 2},
          {"product_id": 3, "quantity": 1}
        ]
      }'
```

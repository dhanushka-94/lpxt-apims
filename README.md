# MSK Computers API

This API provides access to product data from the MSK Computers database.

## Getting Started

1. Clone the repository
2. Install dependencies: `composer install`
3. Configure your database connection in `.env`
4. Run migrations if needed: `php artisan migrate`
5. Start the server: `php artisan serve`

## API Endpoints

All responses are in JSON format and follow this structure:

```json
{
  "success": true/false,
  "data": [...],
  "message": "Error message if success is false"
}
```

### Products

| Endpoint | Method | Description | Parameters |
|----------|--------|-------------|------------|
| `/api/products` | GET | Get all products | `per_page` (optional, default: 15) |
| `/api/products/search` | GET | Search products | `query` (required), `per_page` (optional) |
| `/api/products/{id}` | GET | Get a specific product by ID | - |
| `/api/products/category/{categoryId}` | GET | Get products by category | `per_page` (optional) |
| `/api/products/brand/{brandId}` | GET | Get products by brand | `per_page` (optional) |
| `/api/products/attributes` | GET | Get products with specific attributes | `attribute_id` (required), `per_page` (optional) |
| `/api/products/warehouse/{warehouseId}` | GET | Get products by warehouse | `per_page` (optional) |

### Categories

| Endpoint | Method | Description | Parameters |
|----------|--------|-------------|------------|
| `/api/categories` | GET | Get all categories | - |
| `/api/categories/{id}` | GET | Get a specific category | - |
| `/api/categories/{id}/products` | GET | Get products in a category | `per_page` (optional) |

### Brands

| Endpoint | Method | Description | Parameters |
|----------|--------|-------------|------------|
| `/api/brands` | GET | Get all brands | - |
| `/api/brands/{id}` | GET | Get a specific brand | - |
| `/api/brands/{id}/products` | GET | Get products by brand | `per_page` (optional) |

## Example Usage

### Get all products
```
GET /api/products
```

### Search for products
```
GET /api/products/search?query=laptop
```

### Get products by category
```
GET /api/products/category/1
```

### Get a specific product with all details
```
GET /api/products/123
```

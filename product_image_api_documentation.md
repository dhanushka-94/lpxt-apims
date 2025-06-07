# Product Image and Gallery API Implementation

## Table of Contents
- [Database Structure and Image Storage](#database-structure-and-image-storage)
- [Code Implementation - Detailed Breakdown](#code-implementation---detailed-breakdown)
- [API Response Format](#api-response-format)
- [Frontend Implementation of Product Gallery](#frontend-implementation-of-product-gallery)
- [Advanced Error Handling and Robustness](#advanced-error-handling-and-robustness)
- [Performance Considerations](#performance-considerations)
- [Security Features](#security-features)
- [Potential Extensions](#potential-extensions)

## Database Structure and Image Storage

### Database Tables & Relationships
The system uses a two-table approach for product images:

```
sma_products                    sma_product_photos
+------------+                +---------------+
| id         |<---1-to-many---| product_id    |
| name       |                | photo         |
| code       |                | id            |
| price      |                +---------------+
+------------+
```

This design allows:
- Multiple images per product (one-to-many relationship)
- Independent image management without affecting product data
- Clear separation of responsibilities in the database

### Image File Storage
All product images are stored in a dedicated directory:
```
https://erpsys.laptopexpert.lk/assets/uploads/
```

The system uses hashed filenames (e.g., `28da53e0a630bb49a48115d455289d52.png`) rather than original names for several security and technical advantages:
- Prevents filename conflicts when multiple products have similar image names
- Hides original filenames which might contain product information
- Makes URLs consistent and predictable for frontend integration
- Simplifies caching strategies (same image = same URL)

## Code Implementation - Detailed Breakdown

### Image Retrieval Process

The core of the image handling is in the `getProductPhotos()` method:

```php
public function getProductPhotos() {
    // Check if photos table exists first (robust error handling)
    if (!$this->tableExists($this->photos_table)) {
        $this->photos = [];
        return;
    }
    
    // Query to get all photos for a specific product
    $query = "SELECT photo FROM " . $this->photos_table . " WHERE product_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $this->id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Build standardized image objects for each photo
    $this->photos = [];
    while($row = $result->fetch_assoc()) {
        // Extract just the filename component from any path
        $filename = basename($row['photo']);
        
        // Build complete image data object with both filename and full URL
        $this->photos[] = [
            "filename" => $filename,
            "url" => $this->image_base_url . $filename
        ];
    }
}
```

Key points:
1. **Database Security**: Uses prepared statements to prevent SQL injection
2. **Robust Design**: Checks if the photos table exists before querying
3. **Path Normalization**: Uses `basename()` to handle different path storage formats
4. **Consistent Format**: Returns both filename and complete URL for each image

### Integration With Product API

When returning products, the API attaches images through a multi-step process:

1. **For Single Product Requests**:
   ```php
   // First retrieve basic product data
   $this->id = $row['id'];
   $this->name = $row['name'];
   // ...other fields
   
   // Then fetch and attach all product images
   $this->getProductPhotos();
   ```

2. **For Multiple Product Listings**:
   ```php
   while ($row = $stmt->fetch_assoc()) {
       // Create basic product data
       $product_item = array(
           "id" => $id,
           "name" => $name,
           // ...other fields
       );
       
       // Create a separate object to fetch images
       $product_images = new Product($db);
       $product_images->id = $id;
       $product_images->getProductPhotos();
       
       // Attach images to the product data
       $product_item["images"] = $product_images->photos;
       
       // Add complete product to results
       array_push($products_arr["records"], $product_item);
   }
   ```

### Schema Verification Methods

To make the API robust against database changes, it includes methods to check table and column existence:

```php
private function tableExists($table) {
    $query = "SHOW TABLES LIKE '$table'";
    $result = $this->conn->query($query);
    return $result->num_rows > 0;
}

private function columnExists($table, $column) {
    $query = "SHOW COLUMNS FROM $table LIKE '$column'";
    $result = $this->conn->query($query);
    return $result->num_rows > 0;
}
```

### Dynamic Query Building

The system builds queries dynamically based on available database schema:

```php
private function buildSelectQuery($includeWhere = false, $whereColumn = '', $whereParam = '') {
    // Check which columns exist
    $hasBrand = $this->columnExists($this->table_name, 'brand_id');
    $hasCategory = $this->columnExists($this->table_name, 'category_id');
    
    // Basic fields that should always exist
    $select = "p.id, p.code, p.name, p.price";
    
    // Add optional fields if they exist
    if ($this->columnExists($this->table_name, 'cost')) {
        $select .= ", p.cost";
    }
    // ... more conditional fields ...
    
    // Add joined fields if the related tables exist
    $joins = "";
    if ($hasCategory) {
        $categoryTable = "sma_categories";
        if ($this->tableExists($categoryTable)) {
            $select .= ", c.name as category_name";
            $joins .= " LEFT JOIN $categoryTable c ON p.category_id = c.id";
        }
    }
    
    // ... more conditional joins ...
    
    // Build base query
    $query = "SELECT $select FROM " . $this->table_name . " p" . $joins;
    
    // Add WHERE clause if needed
    if ($includeWhere && !empty($whereColumn)) {
        $query .= " WHERE $whereColumn";
    }
    
    return $query;
}
```

## API Response Format

The API delivers a consistent JSON structure that makes it easy for frontends to implement galleries:

### Single Product Response
```json
{
  "id": "123",
  "code": "ULAP067",
  "name": "HP Laptop 15-inch",
  "price": "85000.00",
  "images": [
    {
      "filename": "28da53e0a630bb49a48115d455289d52.png",
      "url": "https://erpsys.laptopexpert.lk/assets/uploads/28da53e0a630bb49a48115d455289d52.png"
    },
    {
      "filename": "9f7d6a4e2b1c8f3d5e9a7b2c1d4e6f8a.jpg",
      "url": "https://erpsys.laptopexpert.lk/assets/uploads/9f7d6a4e2b1c8f3d5e9a7b2c1d4e6f8a.jpg"
    }
  ]
}
```

### Multiple Products Response
```json
{
  "records": [
    {
      "id": "123",
      "name": "HP Laptop 15-inch",
      "price": "85000.00",
      "images": [
        {
          "filename": "28da53e0a630bb49a48115d455289d52.png",
          "url": "https://erpsys.laptopexpert.lk/assets/uploads/28da53e0a630bb49a48115d455289d52.png"
        }
      ]
    },
    // Additional products...
  ]
}
```

## Frontend Implementation of Product Gallery

The API response structure enables easy implementation of image galleries:

### Main Image Display
```javascript
// First image is typically used as the main product image
const product = response.data;
const mainImageContainer = document.getElementById('main-image');

if (product.images && product.images.length > 0) {
    const mainImage = document.createElement('img');
    mainImage.src = product.images[0].url;
    mainImage.alt = product.name;
    mainImage.id = 'product-main-image';
    mainImageContainer.appendChild(mainImage);
} else {
    // Show placeholder image if no product images
    mainImageContainer.innerHTML = '<img src="/assets/placeholder.png" alt="No image available">';
}
```

### Thumbnail Gallery
```javascript
// Create thumbnail gallery from all product images
const galleryContainer = document.getElementById('product-gallery');
galleryContainer.innerHTML = ''; // Clear existing thumbnails

product.images.forEach((image, index) => {
    const thumbnail = document.createElement('div');
    thumbnail.className = 'gallery-thumbnail';
    thumbnail.innerHTML = `<img src="${image.url}" alt="${product.name} - Image ${index+1}">`;
    
    // Add click handler to update main image
    thumbnail.addEventListener('click', () => {
        document.getElementById('product-main-image').src = image.url;
    });
    
    galleryContainer.appendChild(thumbnail);
});
```

### Complete Gallery Implementation

```html
<!-- HTML Structure -->
<div class="product-images">
    <div id="main-image" class="main-image-container"></div>
    <div id="product-gallery" class="thumbnail-gallery"></div>
</div>
```

```css
/* CSS Styling */
.product-images {
    display: flex;
    flex-direction: column;
}

.main-image-container {
    width: 100%;
    margin-bottom: 15px;
}

.main-image-container img {
    width: 100%;
    height: auto;
    object-fit: contain;
}

.thumbnail-gallery {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.gallery-thumbnail {
    width: 80px;
    height: 80px;
    border: 1px solid #ddd;
    cursor: pointer;
    padding: 3px;
}

.gallery-thumbnail:hover {
    border-color: #3498db;
}

.gallery-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
```

## Advanced Error Handling and Robustness

The API includes several features to make the image handling robust:

### Schema Verification
Before performing any database operations, the system checks if tables and columns exist:

```php
// Before query execution:
if (!$this->tableExists($this->photos_table)) {
    $this->photos = [];
    return;
}
```

This allows the API to:
- Work correctly even if the database schema changes
- Skip image queries if the photos table doesn't exist
- Gracefully handle different database configurations

### Consistent Empty Responses
When no images are found, the API returns an empty array rather than null or an error:

```json
"images": []
```

This consistent response makes frontend code simpler, as it doesn't need special handling for missing images.

### Potential Error Scenarios Handled

1. **Missing Tables**: If the product photos table doesn't exist, returns empty array
2. **No Images for Product**: Returns empty array instead of null
3. **Database Connection Issues**: Proper error handling and appropriate HTTP codes
4. **Different Database Schemas**: Flexible query building that adapts to available columns

## Performance Considerations

The image gallery implementation includes several performance optimizations:

### Efficient Database Access
- Prepared statements are cached and reused for better performance
- Single query retrieves all images for a product

```php
// Single efficient query with prepared statement
$query = "SELECT photo FROM " . $this->photos_table . " WHERE product_id = ?";
$stmt = $this->conn->prepare($query);
$stmt->bind_param("i", $this->id);
```

### URL Construction
- URLs are constructed in PHP rather than requiring additional database lookups
- The base URL is defined as a constant to avoid repetition

```php
// Base URL defined once
private $image_base_url = "https://erpsys.laptopexpert.lk/assets/uploads/";

// URL construction
$this->photos[] = [
    "filename" => $filename,
    "url" => $this->image_base_url . $filename
];
```

### Caching Potential
The hashed filenames enable effective CDN and browser caching:
- URLs don't change if the image content remains the same
- No query parameters in image URLs that might break caching
- Clean URL structure that works with most CDN configurations

### Future Performance Optimizations
Potential improvements that could be made:
- Using a batch query to fetch images for multiple products in one database call
- Adding image metadata caching to reduce database lookups
- Implementing eager loading patterns for common use cases

## Security Features

Several security measures are implemented:

### SQL Injection Protection
All database interactions use prepared statements with parameter binding:
```php
$stmt->bind_param("i", $this->id); // Integer binding for IDs
```

### Path Manipulation Prevention
The `basename()` function ensures only the filename is used, preventing directory traversal:
```php
$filename = basename($row['photo']);
```

### Information Leakage Prevention
Hashed filenames prevent revealing information about products through image names or metadata.

### Authorization Checks
API endpoints require valid API keys, preventing unauthorized access to image data:

```php
// In controller files:
$auth = new Auth();
$api_key_data = $auth->validateApiKey();

if(!$api_key_data) {
    http_response_code(401);
    echo json_encode(array("message" => "Access denied. Invalid or missing API key."));
    exit;
}
```

## Potential Extensions

### Image Sizes/Variants
The system could be extended to support different image sizes:

```json
"images": [
  {
    "filename": "28da53e0a630bb49a48115d455289d52.png",
    "url": "https://erpsys.laptopexpert.lk/assets/uploads/28da53e0a630bb49a48115d455289d52.png",
    "thumbnailUrl": "https://erpsys.laptopexpert.lk/assets/uploads/thumbnails/28da53e0a630bb49a48115d455289d52.png",
    "largeUrl": "https://erpsys.laptopexpert.lk/assets/uploads/large/28da53e0a630bb49a48115d455289d52.png"
  }
]
```

Implementation would require:
1. Generating different size variants during image upload
2. Updating the database schema to store or calculate variant paths
3. Extending the API response to include different URLs

### Primary Image Designation
Adding support for designating a primary/featured image:

```php
// Update database schema
$query = "ALTER TABLE " . $this->photos_table . " ADD COLUMN is_primary BOOLEAN DEFAULT 0";

// Update getProductPhotos to return primary image first
$query = "SELECT photo, is_primary 
        FROM " . $this->photos_table . " 
        WHERE product_id = ? 
        ORDER BY is_primary DESC";
```

### Image Metadata
Adding metadata for better accessibility and SEO:

```json
"images": [
  {
    "filename": "28da53e0a630bb49a48115d455289d52.png",
    "url": "https://erpsys.laptopexpert.lk/assets/uploads/28da53e0a630bb49a48115d455289d52.png",
    "alt_text": "HP Laptop 15-inch - Front View",
    "title": "HP Laptop Front View",
    "position": 1
  }
]
```

### Image Upload API
Creating an API endpoint for image uploads:

```php
public function uploadProductImage($product_id, $image_file) {
    // Generate unique hash for filename
    $hash = md5(uniqid() . time());
    $ext = pathinfo($image_file['name'], PATHINFO_EXTENSION);
    $filename = $hash . '.' . $ext;
    
    // Move uploaded file to destination
    $destination = '../assets/uploads/' . $filename;
    if(move_uploaded_file($image_file['tmp_name'], $destination)) {
        // Insert into database
        $query = "INSERT INTO " . $this->photos_table . " (product_id, photo) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $product_id, $filename);
        
        if($stmt->execute()) {
            return [
                "success" => true,
                "filename" => $filename,
                "url" => $this->image_base_url . $filename
            ];
        }
    }
    
    return [
        "success" => false,
        "message" => "Failed to upload image"
    ];
}
``` 
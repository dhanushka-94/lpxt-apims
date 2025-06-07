<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSK Computers API Documentation</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/github.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            padding-top: 76px;
        }
        pre {
            background-color: #f8f9fa;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: 600;
        }
        .navbar-brand svg {
            margin-right: 10px;
        }
        .navbar {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: #fff !important;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }
        .logout-btn {
            background-color: rgba(255, 68, 68, 0.9);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .logout-btn:hover {
            background-color: rgba(255, 68, 68, 1);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .sidebar {
            position: sticky;
            top: 90px;
            height: calc(100vh - 90px);
            overflow-y: auto;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        .sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 1.2rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e9ecef;
        }
        .sidebar .nav-link {
            color: #555 !important;
            padding: 0.5rem 0.75rem;
            margin: 2px 0;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            color: #0d6efd !important;
        }
        .sidebar .nav-link.section {
            font-weight: bold;
            color: #333;
            margin-top: 15px;
        }
        .endpoint {
            border-left: 4px solid #0d6efd;
            padding-left: 15px;
            margin-bottom: 30px;
        }
        .method {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
            margin-right: 10px;
        }
        .method.get {
            background-color: #61affe;
            color: white;
        }
        .method.post {
            background-color: #49cc90;
            color: white;
        }
        .method.put {
            background-color: #fca130;
            color: white;
        }
        .method.delete {
            background-color: #f93e3e;
            color: white;
        }
        .badge {
            font-weight: normal;
        }
        .section-heading {
            margin-top: 60px;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }
        .endpoint-heading {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .endpoint-url {
            margin-left: 10px;
            font-family: monospace;
            font-size: 1.1rem;
            font-weight: normal;
        }
        .parameter-table th {
            min-width: 120px;
        }
        .response-example {
            margin-top: 20px;
        }
    </style>
</head>
<body data-bs-spy="scroll" data-bs-target="#sidebar" data-bs-offset="100">
    <!-- Modern Navigation Bar -->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-code-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path d="M6.854 4.646a.5.5 0 0 1 0 .708L4.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0zm2.292 0a.5.5 0 0 0 0 .708L11.793 8l-2.647 2.646a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708 0z"/>
                    </svg>
                    MSK Computers API Documentation
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                                <i class="bi bi-house-door me-1"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('api/docs') ? 'active' : '' }} active" href="/api/docs">
                                <i class="bi bi-file-text me-1"></i>Documentation
                            </a>
                        </li>
                        <li class="nav-item ms-lg-3">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div id="sidebar" class="sidebar">
                    <h2>API Documentation</h2>
                    <ul class="list-unstyled ps-2">
                        <li class="mb-2"><a href="#introduction" class="nav-link fw-bold"><i class="bi bi-info-circle me-2"></i>Introduction</a></li>
                        <li class="mb-2">
                            <a href="#authentication" class="nav-link fw-bold"><i class="bi bi-shield-lock me-2"></i>Authentication</a>
                            <ul class="list-unstyled ps-3 mt-1">
                                <li class="mb-1"><a href="#using-api-key" class="nav-link">Using API Key</a></li>
                            </ul>
                        </li>
                        <li class="mb-2"><a href="#response-format" class="nav-link fw-bold"><i class="bi bi-code-square me-2"></i>Response Format</a></li>
                        <li class="mb-2"><a href="#error-handling" class="nav-link fw-bold"><i class="bi bi-exclamation-triangle me-2"></i>Error Handling</a></li>
                        <li class="mb-2">
                            <a href="#products" class="nav-link fw-bold"><i class="bi bi-box me-2"></i>Products</a>
                            <ul class="list-unstyled ps-3 mt-1">
                                <li class="mb-1"><a href="#get-all-products" class="nav-link">Get All Products</a></li>
                                <li class="mb-1"><a href="#get-product-by-id" class="nav-link">Get Product by ID</a></li>
                                <li class="mb-1"><a href="#search-products" class="nav-link">Search Products</a></li>
                                <li class="mb-1"><a href="#get-products-by-category" class="nav-link">Get Products by Category</a></li>
                                <li class="mb-1"><a href="#get-products-by-brand" class="nav-link">Get Products by Brand</a></li>
                            </ul>
                        </li>
                        <li class="mb-2">
                            <a href="#categories" class="nav-link fw-bold"><i class="bi bi-folder me-2"></i>Categories</a>
                            <ul class="list-unstyled ps-3 mt-1">
                                <li class="mb-1"><a href="#get-all-categories" class="nav-link">Get All Categories</a></li>
                            </ul>
                        </li>
                        <li class="mb-2">
                            <a href="#brands" class="nav-link fw-bold"><i class="bi bi-tags me-2"></i>Brands</a>
                            <ul class="list-unstyled ps-3 mt-1">
                                <li class="mb-1"><a href="#get-all-brands" class="nav-link">Get All Brands</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-9">
                <div class="main-content">
                    <section id="introduction">
                        <h2>Introduction</h2>
                        <p>Welcome to the MSK Computers API documentation. This API provides access to product information, categories, and brands from the MSK Computers database.</p>
                        <p>Base URL: <code>{{ url('/api') }}</code></p>
                    </section>

                    <section id="authentication">
                        <h2>Authentication</h2>
                        <p>The API uses API Key authentication. All API endpoints require a valid API key.</p>

                        <div class="alert alert-info mb-4">
                            <h5><i class="bi bi-info-circle-fill me-2"></i>API Key Access</h5>
                            <p>Use the following API key to access all endpoints:</p>
                            <div class="input-group mb-3">
                                <span class="input-group-text">API Key</span>
                                <input type="text" class="form-control" value="msk-api-5f4dcc3b5aa765d61d8327deb882cf99" id="api-key" readonly>
                                <button class="btn btn-outline-primary" type="button" onclick="copyText('api-key')">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-key-fill me-2"></i>Using Your API Key</h5>
                            </div>
                            <div class="card-body">
                                <p>There are two ways to include your API key in requests:</p>
                                
                                <h4>1. Via HTTP Header (Recommended)</h4>
                                <p>Include your API key in the <code>X-API-KEY</code> header:</p>
                                <pre><code>X-API-KEY: your_api_key_here</code></pre>
                                
                                <h4>2. Via Query Parameter</h4>
                                <p>Include your API key as a query parameter in the URL:</p>
                                <pre><code>{{ url('/api/products') }}?api_key=msk-api-5f4dcc3b5aa765d61d8327deb882cf99</code></pre>
                                
                                <div class="alert alert-warning mt-3">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <strong>Security Note:</strong> Using the header method is more secure as the API key won't be stored in browser history or server logs.
                                </div>
                            </div>
                        </div>
                        
                        <h3>Example Usage with Different Languages</h3>
                        
                        <ul class="nav nav-tabs" id="languageTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="curl-tab" data-bs-toggle="tab" data-bs-target="#curl" type="button" role="tab">cURL</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="javascript-tab" data-bs-toggle="tab" data-bs-target="#javascript" type="button" role="tab">JavaScript</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="php-tab" data-bs-toggle="tab" data-bs-target="#php" type="button" role="tab">PHP</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="python-tab" data-bs-toggle="tab" data-bs-target="#python" type="button" role="tab">Python</button>
                            </li>
                        </ul>
                        
                        <div class="tab-content p-3 border border-top-0 rounded-bottom mb-4">
                            <div class="tab-pane fade show active" id="curl" role="tabpanel">
                                <div class="position-relative">
                                    <pre><code id="curl-example">curl -X GET "{{ url('/api/products') }}" \
    -H "X-API-KEY: msk-api-5f4dcc3b5aa765d61d8327deb882cf99"</code></pre>
                                    <button class="btn btn-sm btn-primary position-absolute top-0 end-0 mt-2 me-2" onclick="copyText('curl-example')">
                                        <i class="bi bi-clipboard me-1"></i>Copy
                                    </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="javascript" role="tabpanel">
                                <div class="position-relative">
                                    <pre><code id="js-example">fetch('{{ url('/api/products') }}', {
    headers: {
        'X-API-KEY': 'msk-api-5f4dcc3b5aa765d61d8327deb882cf99'
    }
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));</code></pre>
                                    <button class="btn btn-sm btn-primary position-absolute top-0 end-0 mt-2 me-2" onclick="copyText('js-example')">
                                        <i class="bi bi-clipboard me-1"></i>Copy
                                    </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="php" role="tabpanel">
                                <div class="position-relative">
                                    <pre><code id="php-example">$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, '{{ url('/api/products') }}');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'X-API-KEY: msk-api-5f4dcc3b5aa765d61d8327deb882cf99'
]);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
print_r($data);</code></pre>
                                    <button class="btn btn-sm btn-primary position-absolute top-0 end-0 mt-2 me-2" onclick="copyText('php-example')">
                                        <i class="bi bi-clipboard me-1"></i>Copy
                                    </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="python" role="tabpanel">
                                <div class="position-relative">
                                    <pre><code id="python-example">import requests

url = "{{ url('/api/products') }}"
headers = {
    "X-API-KEY": "msk-api-5f4dcc3b5aa765d61d8327deb882cf99"
}

response = requests.get(url, headers=headers)
data = response.json()
print(data)</code></pre>
                                    <button class="btn btn-sm btn-primary position-absolute top-0 end-0 mt-2 me-2" onclick="copyText('python-example')">
                                        <i class="bi bi-clipboard me-1"></i>Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-danger">
                            <i class="bi bi-shield-exclamation me-2"></i>
                            <strong>Important:</strong> Keep your API key secure! Do not share it publicly or include it in client-side code accessible to users. If your API key is compromised, generate a new one immediately.
                        </div>
                    </section>

                    <section id="response-format">
                        <h2>Response Format</h2>
                        <p>All responses are returned in JSON format.</p>
                        <p>Successful responses have the following structure:</p>
                        <pre><code>{
    "success": true,
    "data": { ... }, // The requested data
    "message": "Optional success message"
}</code></pre>
                        <p>Error responses have the following structure:</p>
                        <pre><code>{
    "success": false,
    "message": "Error message describing what went wrong"
}</code></pre>
                    </section>

                    <section id="error-handling">
                        <h2>Error Handling</h2>
                        <p>The API uses standard HTTP status codes:</p>
                        <ul>
                            <li><code>200 OK</code> - The request was successful.</li>
                            <li><code>400 Bad Request</code> - The request could not be understood or was missing required parameters.</li>
                            <li><code>404 Not Found</code> - The requested resource could not be found.</li>
                            <li><code>500 Internal Server Error</code> - An error occurred on the server.</li>
                        </ul>
                    </section>

                    <section id="products">
                        <h2>Products</h2>

                        <div id="get-all-products" class="endpoint">
                            <h3>Get All Products</h3>
                            <p><code>GET /products</code></p>
                            <p>Returns a paginated list of all products.</p>
                            <h4>Query Parameters</h4>
                            <ul>
                                <li><code>page</code> (optional) - Page number for pagination (default: 1)</li>
                                <li><code>per_page</code> (optional) - Number of items per page (default: 20)</li>
                            </ul>
                            <h4>Response</h4>
                            <pre><code>{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "code": "P001",
                "name": "Product Name",
                "second_name": "Alternative Name",
                "slug": "product-name",
                "price": 99.99,
                "promotion_price": 89.99,
                "quantity": 10,
                "image": "product-image.jpg",
                "brand_id": 1,
                "category_id": 1,
                "product_status": 1,
                "status_date": "2023-01-01 12:00:00",
                "status_info": {
                    "id": 1,
                    "name": "Available",
                    "value": 1
                },
                "category": {
                    "id": 1,
                    "name": "Category Name"
                },
                "brand": {
                    "id": 1,
                    "name": "Brand Name"
                }
            },
            // More products...
        ],
        "from": 1,
        "last_page": 5,
        "per_page": 20,
        "to": 20,
        "total": 100
    },
    "message": "Products retrieved successfully"
}</code></pre>
                            <h4>Stock Information</h4>
                            <p>Stock data is included in the <code>quantity</code> field of each product. This represents the current available inventory for the product.</p>
                            
                            <h4>Pricing Information</h4>
                            <p>The product includes pricing information:</p>
                            <ul>
                                <li><code>price</code> - The current regular selling price</li>
                                <li><code>promotion_price</code> - Special promotional or discounted price (if available)</li>
                            </ul>
                        </div>

                        <div id="get-product-by-id" class="endpoint">
                            <h3>Get Product by ID</h3>
                            <p><code>GET /products/{id}</code></p>
                            <p>Returns detailed information about a specific product.</p>
                            <h4>Path Parameters</h4>
                            <ul>
                                <li><code>id</code> (required) - The ID of the product</li>
                            </ul>
                            <h4>Response</h4>
                            <pre><code>{
    "success": true,
    "data": {
        "id": 1,
        "code": "P001",
        "name": "Product Name",
        "second_name": "Alternative Name",
        "slug": "product-name",
        "price": 99.99,
        "promotion_price": 89.99,
        "quantity": 10,
        "image": "product-image.jpg",
        "gallery": ["image1.jpg", "image2.jpg"],
        "brand_id": 1,
        "category_id": 1,
        "subcategory_id": 2,
        "tax_rate": 10,
        "tax_method": 1,
        "product_status": 1,
        "status_date": "2023-01-01 12:00:00",
        "status_info": {
            "id": 1,
            "name": "Available",
            "value": 1
        },
        "date_created": "2023-01-01 12:00:00",
        "category": {
            "id": 1,
            "name": "Category Name"
        },
        "brand": {
            "id": 1,
            "name": "Brand Name"
        }
    },
    "message": "Product retrieved successfully"
}</code></pre>
                            <h4>Stock Information</h4>
                            <p>The <code>quantity</code> field represents the current available stock for the product. Products with <code>quantity</code> of 0 may be considered out of stock.</p>
                            
                            <h4>Pricing Information</h4>
                            <p>The product includes pricing information:</p>
                            <ul>
                                <li><code>price</code> - The current regular selling price</li>
                                <li><code>promotion_price</code> - Special promotional or discounted price (if available)</li>
                            </ul>
                        </div>

                        <div id="search-products" class="endpoint">
                            <h3>Search Products</h3>
                            <p><code>GET /products/search</code></p>
                            <p>Searches for products by name, code, or second name.</p>
                            <h4>Query Parameters</h4>
                            <ul>
                                <li><code>q</code> (required) - Search query</li>
                                <li><code>page</code> (optional) - Page number for pagination (default: 1)</li>
                                <li><code>per_page</code> (optional) - Number of items per page (default: 20)</li>
                            </ul>
                            <h4>Response</h4>
                            <pre><code>{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "code": "P001",
                "name": "Product Name",
                "second_name": "Alternative Name",
                "slug": "product-name",
                "price": 99.99,
                "promotion_price": 89.99,
                "quantity": 10,
                "image": "product-image.jpg",
                "brand_id": 1,
                "category_id": 1,
                "product_status": 1,
                "status_date": "2023-01-01 12:00:00",
                "status_info": {
                    "id": 1,
                    "name": "Available",
                    "value": 1
                },
                "category": {
                    "id": 1,
                    "name": "Category Name"
                },
                "brand": {
                    "id": 1,
                    "name": "Brand Name"
                }
            },
            // More products...
        ],
        "from": 1,
        "last_page": 2,
        "per_page": 20,
        "to": 20,
        "total": 25
    },
    "message": "Products found successfully"
}</code></pre>
                        </div>

                        <div id="get-products-by-category" class="endpoint">
                            <h3>Get Products by Category</h3>
                            <p><code>GET /products/category/{categoryId}</code></p>
                            <p>Returns a paginated list of products in a specific category.</p>
                            <h4>Path Parameters</h4>
                            <ul>
                                <li><code>categoryId</code> (required) - The ID of the category</li>
                            </ul>
                            <h4>Query Parameters</h4>
                            <ul>
                                <li><code>page</code> (optional) - Page number for pagination (default: 1)</li>
                                <li><code>per_page</code> (optional) - Number of items per page (default: 20)</li>
                            </ul>
                            <h4>Response</h4>
                            <pre><code>{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "code": "P001",
                "name": "Product Name",
                "second_name": "Alternative Name",
                "slug": "product-name",
                "price": 99.99,
                "promotion_price": 89.99,
                "quantity": 10,
                "image": "product-image.jpg",
                "brand_id": 1,
                "category_id": 1,
                "product_status": 1,
                "status_date": "2023-01-01 12:00:00",
                "status_info": {
                    "id": 1,
                    "name": "Available",
                    "value": 1
                },
                "category": {
                    "id": 1,
                    "name": "Category Name"
                },
                "brand": {
                    "id": 1,
                    "name": "Brand Name"
                }
            },
            // More products...
        ],
        "from": 1,
        "last_page": 3,
        "per_page": 20,
        "to": 20,
        "total": 45
    },
    "message": "Products in category retrieved successfully"
}</code></pre>
                        </div>

                        <div id="get-products-by-brand" class="endpoint">
                            <h3>Get Products by Brand</h3>
                            <p><code>GET /products/brand/{brandId}</code></p>
                            <p>Returns a paginated list of products from a specific brand.</p>
                            <h4>Path Parameters</h4>
                            <ul>
                                <li><code>brandId</code> (required) - The ID of the brand</li>
                            </ul>
                            <h4>Query Parameters</h4>
                            <ul>
                                <li><code>page</code> (optional) - Page number for pagination (default: 1)</li>
                                <li><code>per_page</code> (optional) - Number of items per page (default: 20)</li>
                            </ul>
                            <h4>Response</h4>
                            <pre><code>{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "code": "P001",
                "name": "Product Name",
                "second_name": "Alternative Name",
                "slug": "product-name",
                "price": 99.99,
                "promotion_price": 89.99,
                "quantity": 10,
                "image": "product-image.jpg",
                "brand_id": 1,
                "category_id": 1,
                "product_status": 1,
                "status_date": "2023-01-01 12:00:00",
                "status_info": {
                    "id": 1,
                    "name": "Available",
                    "value": 1
                },
                "category": {
                    "id": 1,
                    "name": "Category Name"
                },
                "brand": {
                    "id": 1,
                    "name": "Brand Name"
                }
            },
            // More products...
        ],
        "from": 1,
        "last_page": 2,
        "per_page": 20,
        "to": 20,
        "total": 30
    },
    "message": "Products from brand retrieved successfully"
}</code></pre>
                        </div>
                    </section>

                    <section id="categories">
                        <h2>Categories</h2>

                        <div id="get-all-categories" class="endpoint">
                            <h3>Get All Categories</h3>
                            <p><code>GET /categories</code></p>
                            <p>Returns a list of all categories with their subcategories.</p>
                            <h4>Response</h4>
                            <pre><code>{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Parent Category",
            "subcategories": [
                {
                    "id": 2,
                    "name": "Subcategory 1",
                    "parent_id": 1
                },
                {
                    "id": 3,
                    "name": "Subcategory 2",
                    "parent_id": 1
                }
            ]
        },
        // More categories...
    ],
    "message": "Categories retrieved successfully"
}</code></pre>
                        </div>
                    </section>

                    <section id="brands">
                        <h2>Brands</h2>

                        <div id="get-all-brands" class="endpoint">
                            <h3>Get All Brands</h3>
                            <p><code>GET /brands</code></p>
                            <p>Returns a list of all brands.</p>
                            <h4>Response</h4>
                            <pre><code>{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Brand Name 1"
        },
        {
            "id": 2,
            "name": "Brand Name 2"
        },
        // More brands...
    ],
    "message": "Brands retrieved successfully"
}</code></pre>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p>MSK Computers API Documentation - &copy; 2025 MSK Computers</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>
        // Store current domain for use in examples
        const currentDomain = '{{ url("/") }}';
        
        hljs.highlightAll();
        
        document.addEventListener('DOMContentLoaded', function () {
            // Activate Bootstrap scrollspy
            var scrollSpy = new bootstrap.ScrollSpy(document.body, {
                target: '#sidebar'
            })
            
            // Highlight active nav items
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(item => item.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });

        function copyText(elementId) {
            const element = document.getElementById(elementId);
            
            // Get the actual rendered content (with URLs expanded)
            const text = element.innerText;
            
            navigator.clipboard.writeText(text)
                .then(() => {
                    // Create a temporary tooltip
                    const btn = document.createElement('span');
                    btn.className = 'position-absolute top-0 end-0 mt-2 me-2 badge bg-success';
                    btn.textContent = 'Copied!';
                    element.parentNode.appendChild(btn);
                    
                    // Remove the tooltip after 2 seconds
                    setTimeout(() => {
                        btn.remove();
                    }, 2000);
                })
                .catch(err => {
                    console.error('Failed to copy text: ', err);
                    alert('Failed to copy. Please try again.');
                });
        }
    </script>
</body>
</html> 
@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">API Data Viewer</h5>
                    <div>
                        <a href="{{ route('api.docs') }}" class="btn btn-sm btn-secondary">View API Documentation</a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Search and Filter Form -->
                    <form action="{{ route('api.data-view') }}" method="GET" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="query" placeholder="Search by name or code" value="{{ $query }}">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select name="category_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="per_page" class="form-select" onchange="this.form.submit()">
                                    <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 per page</option>
                                    <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30 per page</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per page</option>
                                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 per page</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <!-- Products Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Images</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Product Specifications</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Brand</th>
                                    <th>Price Info</th>
                                    <th>Promotion</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                @if($product->photos->count() > 0)
                                                    @foreach($product->photos->take(3) as $index => $photo)
                                                        <div class="position-relative">
                                                            <img src="{{ 'https://erpsys.laptopexpert.lk/assets/uploads/' . $photo->photo }}" 
                                                                alt="{{ $product->name }}" class="img-thumbnail"
                                                                style="width: 50px; height: 50px; object-fit: cover;">
                                                            @if($index === 0)
                                                                <span class="position-absolute top-0 start-0 badge bg-primary" style="font-size: 8px;">Main</span>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                    @if($product->photos->count() > 3)
                                                        <button type="button" class="btn btn-sm btn-outline-primary" 
                                                                data-bs-toggle="modal" data-bs-target="#galleryModal-{{ $product->id }}">
                                                            +{{ $product->photos->count() - 3 }} more
                                                        </button>
                                                    @endif
                                                @elseif($product->image)
                                                    <img src="{{ 'https://erpsys.laptopexpert.lk/assets/uploads/' . $product->image }}" 
                                                        alt="{{ $product->name }}" class="img-thumbnail"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">No images</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $product->code }}</td>
                                        <td>
                                            <div>{{ $product->name }}</div>
                                            @if($product->second_name)
                                                <small class="text-muted">{{ $product->second_name }}</small>
                                            @endif
                                            <small class="d-block text-muted">Slug: {{ $product->slug }}</small>
                                        </td>
                                        <td>
                                            <div style="max-width: 350px; max-height: 120px; overflow: auto; border: 1px solid #eee; padding: 8px; border-radius: 4px; background-color: #f9f9f9;">
                                                @if($product->details)
                                                    <div class="product-details">
                                                        {!! $product->details !!}
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-primary mt-2" 
                                                            data-bs-toggle="modal" data-bs-target="#detailsModal-{{ $product->id }}">
                                                        <i class="bi bi-search"></i> View Full Details
                                                    </button>
                                                @else
                                                    <span class="text-muted">No product specifications available</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            {{ $product->category->name ?? 'N/A' }}
                                        </td>
                                        <td>
                                            @if($product->subcategory_id)
                                                @php
                                                    $subcategory = App\Models\Category::find($product->subcategory_id);
                                                @endphp
                                                {{ $subcategory ? $subcategory->name : 'ID: '.$product->subcategory_id }}
                                            @else
                                                <span class="text-muted">None</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(is_object($product->brand))
                                                {{ $product->brand->name }}
                                            @else
                                                Brand ID: {{ $product->brand }}
                                            @endif
                                        </td>
                                        <td>
                                            <div><strong>Price:</strong> {{ number_format($product->price, 2) }}</div>
                                            <div class="{{ $product->promotion_price ? 'text-success fw-bold' : 'text-muted' }}">
                                                <strong>Promo Price:</strong> 
                                                @if($product->promotion_price)
                                                    {{ number_format($product->promotion_price, 2) }}
                                                @else
                                                    N/A
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($product->promotion) && $product->promotion)
                                                <div><strong>Promotion:</strong> Yes</div>
                                                @if($product->start_date)
                                                    <small class="d-block">From: {{ $product->start_date }}</small>
                                                @endif
                                                @if($product->end_date)
                                                    <small class="d-block">To: {{ $product->end_date }}</small>
                                                @endif
                                            @else
                                                <span class="text-muted">No promotion</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            @if($product->status)
                                                <span class="badge bg-{{ $product->status->status ? 'success' : 'secondary' }}">
                                                    {{ $product->status->status_name }}
                                                </span>
                                                @if($product->date_created)
                                                    <small class="d-block text-muted">Created: {{ $product->date_created }}</small>
                                                @endif
                                                @if($product->status_date)
                                                    <small class="d-block text-muted">Updated: {{ $product->status_date }}</small>
                                                @endif
                                            @else
                                                <span class="badge bg-secondary">Unknown</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column gap-1">
                                                <button type="button" class="btn btn-sm btn-primary" 
                                                       data-bs-toggle="modal" data-bs-target="#jsonModal-{{ $product->id }}">
                                                    View JSON
                                                </button>
                                                <a href="#" 
                                                  onclick="navigator.clipboard.writeText('/api/products/{{ $product->id }}'); alert('API URL copied!'); return false;" 
                                                  class="btn btn-sm btn-outline-secondary">
                                                    Copy API URL
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="13" class="text-center">No products found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gallery Modals -->
@foreach($products as $product)
    @if($product->photos->count() > 0 || !empty($product->image))
        <div class="modal fade" id="galleryModal-{{ $product->id }}" tabindex="-1" aria-labelledby="galleryModalLabel-{{ $product->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galleryModalLabel-{{ $product->id }}">{{ $product->name }} - Image Gallery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            @if($product->photos->count() > 0)
                                @foreach($product->photos as $index => $photo)
                                    <div class="col-md-4 col-6">
                                        <div class="position-relative">
                                            <img src="{{ 'https://erpsys.laptopexpert.lk/assets/uploads/' . $photo->photo }}" 
                                                alt="{{ $product->name }} Photo {{ $index + 1 }}" 
                                                class="img-fluid rounded">
                                            @if($index === 0)
                                                <span class="position-absolute top-0 start-0 badge bg-primary">Main Image</span>
                                            @endif
                                            <div class="mt-1 small text-muted">
                                                ID: {{ $photo->id }} | Filename: {{ $photo->photo }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif($product->image)
                                <div class="col-md-6 mx-auto">
                                    <img src="{{ 'https://erpsys.laptopexpert.lk/assets/uploads/' . $product->image }}" 
                                        alt="{{ $product->name }}" 
                                        class="img-fluid rounded">
                                    <div class="mt-1 small text-muted">
                                        Filename: {{ $product->image }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Details Modal -->
    <div class="modal fade" id="detailsModal-{{ $product->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-info-circle me-2"></i>{{ $product->name }} - Detailed Specifications</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            @if($product->image)
                                <img src="{{ 'https://erpsys.laptopexpert.lk/assets/uploads/' . $product->image }}" 
                                    alt="{{ $product->name }}" 
                                    class="img-fluid rounded border">
                            @elseif($product->photos && $product->photos->count() > 0)
                                <img src="{{ 'https://erpsys.laptopexpert.lk/assets/uploads/' . $product->photos->first()->photo }}" 
                                    alt="{{ $product->name }}" 
                                    class="img-fluid rounded border">
                            @endif

                            <div class="mt-3">
                                <h6 class="border-bottom pb-2">Product Information</h6>
                                <p><strong>Code:</strong> {{ $product->code }}</p>
                                <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
                                <p><strong>Brand:</strong> {{ is_object($product->brand) ? $product->brand->name : 'Brand ID: '.$product->brand }}</p>
                                <p><strong>In Stock:</strong> {{ $product->quantity }} units</p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Product Specifications</h5>
                                </div>
                                <div class="card-body product-details-full">
                                    @if($product->details)
                                        {!! $product->details !!}
                                    @else
                                        <span class="text-muted">No product specifications available</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <h6 class="border-bottom pb-2">Pricing</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card text-center h-100">
                                            <div class="card-body">
                                                <h6 class="card-title">Regular Price</h6>
                                                <p class="card-text fw-bold fs-5">{{ number_format($product->price, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @if($product->promotion_price)
                                    <div class="col-sm-6">
                                        <div class="card text-center bg-success text-white h-100">
                                            <div class="card-body">
                                                <h6 class="card-title">Promotion Price</h6>
                                                <p class="card-text fw-bold fs-5">{{ number_format($product->promotion_price, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="/api/products/{{ $product->id }}" target="_blank" class="btn btn-outline-primary">
                        <i class="bi bi-code-slash me-1"></i>View API Response
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JSON Modal -->
    <div class="modal fade" id="jsonModal-{{ $product->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title"><i class="bi bi-braces-asterisk me-2"></i>{{ $product->name }} - API Response</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark p-0">
                    <pre class="json-display m-0"><code>
{
    "success": true,
    "data": {
        "id": {{ $product->id }},
        "code": "{{ $product->code }}",
        "name": "{{ $product->name }}",
        "second_name": "{{ $product->second_name ?? '' }}",
        "slug": "{{ $product->slug ?? '' }}",
        "details": "{!! isset($product->details) ? str_replace(['"', "\r", "\n"], ['\"', '', ''], $product->details) : 'null' !!}",
        "price": {{ $product->price ?? 0 }},
        "promotion_price": {{ $product->promotion_price ?? 'null' }},
        "promotion": {{ isset($product->promotion) && $product->promotion ? 'true' : 'false' }},
        "category_id": {{ $product->category_id ?? 'null' }},
        "subcategory_id": {{ $product->subcategory_id ?? 'null' }},
        "subcategory": @if($product->subcategory_id && $product->subcategory)
            {
                "id": {{ $product->subcategory->id }},
                "name": "{{ $product->subcategory->name }}"
            }
        @else
            null
        @endif,
        "quantity": {{ $product->quantity ?? 0 }},
        "image": "{{ $product->image ? 'https://erpsys.laptopexpert.lk/assets/uploads/'.$product->image : null }}",
        "product_status": {{ $product->product_status ?? 0 }},
        "date_created": "{{ $product->date_created ?? '' }}",
        "status_date": "{{ $product->status_date ?? '' }}",
        "hide": {{ isset($product->hide) && $product->hide ? 'true' : 'false' }},
        "status_info": {
            "id": {{ $product->product_status ?? 0 }},
            "name": "{{ $product->status ? $product->status->status_name : 'Unknown' }}",
            "value": {{ $product->status ? $product->status->status : 0 }}
        },
        "category": {
            "id": {{ $product->category->id ?? 'null' }},
            "name": "{{ $product->category->name ?? 'N/A' }}"
        },
        "brand": {
            "id": {{ is_object($product->brand) ? $product->brand->id : $product->brand }},
            "name": "{{ is_object($product->brand) ? $product->brand->name : 'Unknown' }}"
        },
        "photos": [
            @if($product->photos->count() > 0)
                @foreach($product->photos as $index => $photo)
                    {
                        "id": {{ $photo->id }},
                        "product_id": {{ $photo->product_id }},
                        "photo": "https://erpsys.laptopexpert.lk/assets/uploads/{{ $photo->photo }}"
                    }{{ !$loop->last ? ',' : '' }}
                @endforeach
            @elseif($product->image)
                {
                    "id": 0,
                    "product_id": {{ $product->id }},
                    "photo": "https://erpsys.laptopexpert.lk/assets/uploads/{{ $product->image }}"
                }
            @endif
        ],
        "attributes": [
            @if($product->attributes && $product->attributes->count() > 0)
                @foreach($product->attributes as $index => $attribute)
                    {
                        "id": {{ $attribute->id }},
                        "name": @php
                            $attributeNames = [
                                26 => 'Processor',
                                33 => 'RAM',
                                30 => 'Storage'
                            ];
                            echo '"' . ($attributeNames[$attribute->attribute_id] ?? 'Unknown Attribute') . '"';
                        @endphp,
                        "value": {{ $attribute->value ? '"' . $attribute->value . '"' : 'null' }},
                        "attribute_id": {{ $attribute->attribute_id ?? 0 }}
                    }{{ !$loop->last ? ',' : '' }}
                @endforeach
            @endif
        ]
    }
}
                    </code></pre>
                </div>
                <div class="modal-footer justify-content-between bg-dark">
                    <a href="http://127.0.0.1:8000/api/products/{{ $product->id }}" target="_blank" class="btn btn-sm btn-outline-light">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Open Direct API Link
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-light copy-json" 
                            data-product-id="{{ $product->id }}">
                        <i class="bi bi-clipboard me-1"></i>Copy JSON
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Additional Styles -->
<style>
    pre {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        max-height: 400px;
        overflow-y: auto;
    }
    
    .json-display {
        background-color: #1e1e1e;
        color: #d4d4d4;
        padding: 15px;
        border-radius: 0;
        max-height: 500px;
        overflow-y: auto;
        font-size: 14px;
        line-height: 1.5;
    }
    
    .json-display .text-warning {
        color: #ce9178 !important;
    }
    
    .json-display code {
        font-family: 'Cascadia Code', 'Fira Code', Consolas, 'Courier New', monospace;
        font-size: 14px;
    }
    
    .table th, .table td {
        vertical-align: middle;
    }
    
    .img-thumbnail {
        border: 1px solid #dee2e6;
        padding: 2px;
    }
    
    .product-details {
        font-size: 13px;
        line-height: 1.4;
    }
    
    .product-details-full {
        line-height: 1.6;
    }
    
    .product-details table,
    .product-details-full table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
    }
    
    .product-details table td, 
    .product-details table th,
    .product-details-full table td,
    .product-details-full table th {
        border: 1px solid #dee2e6;
        padding: 0.5rem;
    }
</style>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyButtons = document.querySelectorAll('.copy-json');
        copyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const jsonContent = document.querySelector(`#jsonModal-${productId} pre code`).textContent;
                
                navigator.clipboard.writeText(jsonContent)
                    .then(() => {
                        this.textContent = 'Copied!';
                        setTimeout(() => {
                            this.textContent = 'Copy JSON';
                        }, 2000);
                    })
                    .catch(err => {
                        console.error('Failed to copy: ', err);
                    });
            });
        });
    });
</script>
@endsection 
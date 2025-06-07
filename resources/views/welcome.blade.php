@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="py-5 text-center container hero-section">
    <div class="row py-lg-5">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h1 class="fw-bold mb-4">MSK Computers API Platform</h1>
            <p class="lead mb-5">Access our powerful API services to integrate with MSK systems. Build scalable applications with our secure and reliable endpoints.</p>
            <div class="d-grid gap-3 d-md-flex justify-content-md-center">
                <a href="/api/docs" class="btn btn-primary btn-lg px-4 py-2">
                    <i class="bi bi-file-code me-2"></i>API Documentation
                </a>
                <a href="#getting-started" class="btn btn-outline-secondary btn-lg px-4 py-2">
                    <i class="bi bi-arrow-right-circle me-2"></i>Get Started
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="fw-bold">Powerful API Features</h2>
                <p class="lead">Everything you need to build seamless integrations</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-gradient rounded-circle mb-4 mx-auto">
                            <i class="bi bi-shield-check text-white fs-2 p-3"></i>
                        </div>
                        <h3 class="h4 mb-3">Secure Access</h3>
                        <p class="mb-0">Robust authentication with API keys ensuring your data stays protected with controlled access to all endpoints.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-gradient rounded-circle mb-4 mx-auto">
                            <i class="bi bi-speedometer2 text-white fs-2 p-3"></i>
                        </div>
                        <h3 class="h4 mb-3">High Performance</h3>
                        <p class="mb-0">Optimized for speed with response caching and efficient database queries minimizing latency.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-gradient rounded-circle mb-4 mx-auto">
                            <i class="bi bi-code-square text-white fs-2 p-3"></i>
                        </div>
                        <h3 class="h4 mb-3">Developer Friendly</h3>
                        <p class="mb-0">Comprehensive documentation with code examples and interactive test console for faster integration.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Endpoints Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="fw-bold">Available Endpoints</h2>
                <p class="lead">Explore our rich set of API endpoints</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white d-flex align-items-center border-0 pt-4 px-4">
                        <span class="badge bg-success me-3 py-2 px-3">GET</span>
                        <h3 class="h5 mb-0 fw-bold">Product Information</h3>
                    </div>
                    <div class="card-body px-4">
                        <p>Access detailed product information including specifications, pricing, and availability.</p>
                        <code class="d-block p-3 bg-light rounded mb-3 text-dark">/api/v1/products</code>
                        <a href="/api/docs#products" class="text-decoration-none">View Documentation <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white d-flex align-items-center border-0 pt-4 px-4">
                        <span class="badge bg-primary me-3 py-2 px-3">POST</span>
                        <h3 class="h5 mb-0 fw-bold">Order Processing</h3>
                    </div>
                    <div class="card-body px-4">
                        <p>Submit and manage orders with comprehensive tracking and status updates.</p>
                        <code class="d-block p-3 bg-light rounded mb-3 text-dark">/api/v1/orders</code>
                        <a href="/api/docs#orders" class="text-decoration-none">View Documentation <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white d-flex align-items-center border-0 pt-4 px-4">
                        <span class="badge bg-warning text-dark me-3 py-2 px-3">PUT</span>
                        <h3 class="h5 mb-0 fw-bold">Customer Management</h3>
                    </div>
                    <div class="card-body px-4">
                        <p>Update and manage customer profiles, preferences, and account settings.</p>
                        <code class="d-block p-3 bg-light rounded mb-3 text-dark">/api/v1/customers</code>
                        <a href="/api/docs#customers" class="text-decoration-none">View Documentation <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white d-flex align-items-center border-0 pt-4 px-4">
                        <span class="badge bg-info text-dark me-3 py-2 px-3">GET</span>
                        <h3 class="h5 mb-0 fw-bold">Inventory Status</h3>
                    </div>
                    <div class="card-body px-4">
                        <p>Real-time inventory levels and stock status across multiple locations.</p>
                        <code class="d-block p-3 bg-light rounded mb-3 text-dark">/api/v1/inventory</code>
                        <a href="/api/docs#inventory" class="text-decoration-none">View Documentation <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="/api/docs" class="btn btn-outline-primary btn-lg">
                <i class="bi bi-file-earmark-text me-2"></i>View Full API Documentation
            </a>
        </div>
    </div>
</section>

<!-- Getting Started Section -->
<section class="container py-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <h2 class="mb-4">Getting Started</h2>
            <p class="mb-4">Ready to begin using our API? Follow these steps to get started:</p>
            <div class="d-grid gap-3">
                <a href="{{ route('api.docs') }}" class="btn btn-primary">
                    <i class="bi bi-file-earmark-code me-2"></i>Read API Documentation
                </a>
                <a href="{{ route('api.data-view') }}" class="btn btn-secondary">
                    <i class="bi bi-table me-2"></i>View API Data Table
                </a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="code-block p-4 rounded">
                <pre><code>// Example API request
            fetch('https://api.mskcomputers.lk/products', {
  headers: {
    'X-API-Key': 'your-api-key-here',
    'Accept': 'application/json'
  }
})
.then(response => response.json())
.then(data => console.log(data));</code></pre>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">MSK Computers API</h5>
                <p>Empowering developers with powerful integration tools for MSK Computer systems.</p>
                <div class="social-icons">
                    <a href="#" class="text-white me-3"><i class="bi bi-github"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <h5 class="fw-bold mb-3">Resources</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="/api/docs" class="text-white text-decoration-none">Documentation</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">API Status</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">Rate Limits</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">Support</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4">
                <h5 class="fw-bold mb-3">Company</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">About Us</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">Blog</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">Careers</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                <h5 class="fw-bold mb-3">Stay Connected</h5>
                <p>Subscribe to our developer newsletter for updates.</p>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Enter your email" aria-label="Email" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2">Subscribe</button>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <p class="mb-0">© {{ date('Y') }} MSK Computers. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="text-white text-decoration-none me-3">Privacy Policy</a>
                <a href="#" class="text-white text-decoration-none">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<style>
    .hero-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        color: #333;
        padding: 6rem 0 4rem;
    }
    
    .feature-icon {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .code-preview {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .code-preview pre {
        margin-bottom: 0;
    }
    
    .step-number {
        width: 40px;
        height: 40px;
        min-width: 40px;
        font-weight: bold;
    }
    
    .social-icons a:hover {
        opacity: 0.8;
    }
    
    @media (max-width: 767.98px) {
        .hero-section {
            padding: 4rem 0 2rem;
        }
        
        h1 {
            font-size: 2.25rem;
        }
    }
</style>
@endsection

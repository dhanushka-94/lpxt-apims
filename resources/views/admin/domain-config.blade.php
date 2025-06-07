@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-globe me-2"></i>Domain Configuration</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        This page displays the current domain configuration used for API URLs. The system automatically detects and adapts based on your environment.
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Current Host</th>
                                    <td><code>{{ request()->getHost() }}</code></td>
                                </tr>
                                <tr>
                                    <th>Current Scheme</th>
                                    <td><code>{{ request()->getScheme() }}</code></td>
                                </tr>
                                <tr>
                                    <th>Current Port</th>
                                    <td><code>{{ request()->getPort() }}</code></td>
                                </tr>
                                <tr>
                                    <th>Base URL</th>
                                    <td><code>{{ url('/') }}</code></td>
                                </tr>
                                <tr>
                                    <th>API Base URL</th>
                                    <td><code>{{ url('/api') }}</code></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <h5 class="mt-4">Example API Endpoints</h5>
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <span class="badge bg-primary">GET</span>
                                    <strong>Status</strong>
                                </div>
                                <div class="col-md-9">
                                    <code>{{ url('/api/status') }}</code>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <span class="badge bg-success">GET</span>
                                    <strong>Products</strong>
                                </div>
                                <div class="col-md-9">
                                    <code>{{ url('/api/products') }}</code>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <span class="badge bg-info">GET</span>
                                    <strong>Categories</strong>
                                </div>
                                <div class="col-md-9">
                                    <code>{{ url('/api/categories') }}</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-gear-fill me-2"></i>Environment Details</h5>
                </div>
                <div class="card-body">
                    <p>The system automatically adjusts the domain configuration based on the detected environment:</p>
                    
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Local Development</strong>
                            <p class="mb-0">When detected as localhost or 127.0.0.1, the system will use the correct port and protocol.</p>
                        </li>
                        <li class="list-group-item">
                            <strong>Production Environment</strong>
                            <p class="mb-0">When detected as mskcomputers.com or any subdomain, HTTPS will be enforced.</p>
                        </li>
                        <li class="list-group-item">
                            <strong>Other Environments</strong>
                            <p class="mb-0">For staging or testing environments, the system will use the detected scheme and host.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
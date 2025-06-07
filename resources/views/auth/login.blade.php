@extends('layouts.app')

@section('title', 'Login - MSK Computers API')

@section('styles')
<style>
    body {
        background-color: #f8f9fa;
    }
    .login-container {
        max-width: 500px;
        margin: 2rem auto;
    }
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    .card-header {
        background: linear-gradient(135deg, #1a237e, #283593);
    }
    .input-group-text {
        border-radius: 8px 0 0 8px;
    }
    .form-control {
        border-radius: 0 8px 8px 0;
        padding: 0.75rem 1.25rem;
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #dee2e6;
    }
    .btn-primary {
        background: linear-gradient(135deg, #1a237e, #283593);
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #283593, #1a237e);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('content')
<div class="container login-container">
    <div class="card border-0 shadow-lg">
        <div class="card-header border-0 py-4">
            <div class="text-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-code-square text-white mb-3" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                    <path d="M6.854 4.646a.5.5 0 0 1 0 .708L4.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0zm2.292 0a.5.5 0 0 0 0 .708L11.793 8l-2.647 2.646a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708 0z"/>
                </svg>
            </div>
            <h3 class="text-center text-white fw-bold">MSK Computers API</h3>
            <p class="text-center text-white-50 mb-0">Enter your credentials to access the API</p>
        </div>
        <div class="card-body p-4 p-md-5">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('login.attempt') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="username" class="form-label fw-semibold">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-primary"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" id="username" name="username" placeholder="Enter username" required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-lock text-primary"></i></span>
                        <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" placeholder="Enter password" required>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg py-3">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                    </button>
                </div>
            </form>
        </div>
        <div class="card-footer border-0 py-3 text-center bg-white">
            <p class="text-muted mb-0">MSK Computers &copy; {{ date('Y') }}</p>
        </div>
    </div>
</div>
@endsection 
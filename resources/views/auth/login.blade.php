@extends('layouts.app')
@section('title', 'Login')

<div class="container-fluid vh-100">
    <div class="row h-100">
        <div class="col-md-6 d-none d-md-block p-0">
            <div class="h-100 w-100"
                style="
                background: url('https://images.unsplash.com/photo-1586773860418-d37222d8fce3') no-repeat center center;
                background-size: cover;
                filter: brightness(0.9);
            ">
            </div>
        </div>

        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="card shadow-sm border rounded-3 p-4 w-100" style="max-width: 400px;">
                <div class="card-body">
                    <h1 class="h4 fw-semibold text-center mb-1">Hospital Management System</h1>
                    <h2 class="h6 fw-normal text-muted text-center mb-4">Login to your account</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" class="mt-3">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label fw-medium">Username</label>
                            <input type="text" id="username" name="username" class="form-control rounded-3"
                                placeholder="Enter your username" value="{{ old('username') }}" required autofocus>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-medium">Password</label>
                            <input type="password" id="password" name="password" class="form-control rounded-3"
                                placeholder="Enter your password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-3">Login</button>
                    </form>

                    <p class="text-center mt-4 text-muted small mb-0">
                        © {{ date('Y') }} Hospital Management System
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

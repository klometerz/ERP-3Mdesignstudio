@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    {{-- Logo Optional --}}
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="img-fluid mb-3" style="max-height: 60px;">
                    <h3 class="fw-bold">Login ERP - 3M Design Studio</h3>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input id="email" type="email" class="form-control" name="email" required autofocus value="{{ old('email') }}">
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>

                    {{-- Remember Me --}}
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Masuk
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <small class="text-muted">© {{ now()->year }} 3M Design Studio</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

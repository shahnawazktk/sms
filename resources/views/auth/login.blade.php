<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'EduManage Pro') }} | Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            --accent-color: #1abc9c;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f4f7f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container { max-width: 450px; width: 100%; }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
            overflow: hidden;
            background: #fff;
        }

        .login-header {
            background: var(--primary-gradient);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .login-header i { font-size: 3rem; margin-bottom: 10px; color: var(--accent-color); }

        .form-control {
            padding: 12px 15px;
            border-radius: 10px;
            border: 1px solid #e1e8ee;
            font-size: 0.95rem;
        }

        .form-control.is-invalid { border-color: #dc3545; }

        .btn-login {
            background: var(--primary-gradient);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3); color: white; }

        .footer-text { text-align: center; margin-top: 20px; font-size: 0.85rem; color: #7f8c8d; }
    </style>
</head>
<body>

<div class="login-container">
    @if (session('status'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="login-header">
            <i class="fas fa-graduation-cap"></i>
            <h3 class="fw-bold mb-0">EduManage Pro</h3>
            <p class="small opacity-75">Sign in to your dashboard</p>
        </div>

        <div class="card-body p-4 p-md-5">
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                        <input id="email" type="email" name="email" 
                               class="form-control border-start-0 @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" required autofocus autocomplete="username" 
                               placeholder="name@school.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                        <input id="password" type="password" name="password" 
                               class="form-control border-start-0 @error('password') is-invalid @enderror" 
                               required autocomplete="current-password" 
                               placeholder="••••••••">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                        <label class="form-check-label small text-muted" for="remember_me">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small text-decoration-none fw-bold text-primary">Forgot?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-login mb-3">
                    Log in <i class="fas fa-sign-in-alt ms-2"></i>
                </button>
            </form>

            <div class="text-center">
                <p class="small text-muted mb-0">Don't have an account? 
                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Register Now</a>
                </p>
            </div>
        </div>
    </div>

    <div class="footer-text">
        &copy; {{ date('Y') }} EduManage Pro. All rights reserved.
    </div>
</div>

<script>
    // Show loading spinner on form submit
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = this.querySelector('.btn-login');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Authenticating...';
        btn.classList.add('disabled');
    });
</script>

</body>
</html>
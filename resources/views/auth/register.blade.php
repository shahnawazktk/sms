<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'EduManage Pro') }} | Register</title>
    
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
            padding: 40px 20px;
        }

        .register-container { max-width: 550px; width: 100%; }

        .card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.07);
            overflow: hidden;
            background: #fff;
        }

        .register-header {
            background: var(--primary-gradient);
            padding: 35px;
            text-align: center;
            color: white;
        }

        .register-header i { font-size: 2.5rem; color: var(--accent-color); margin-bottom: 10px; }

        .form-label {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #5d6d7e;
        }

        .form-control {
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #3498db;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.15);
        }

        .invalid-feedback { font-size: 0.8rem; font-weight: 600; }

        .btn-register {
            background: var(--primary-gradient);
            border: none;
            color: white;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(52, 152, 219, 0.3);
            color: white;
        }

        .input-icon { position: relative; }
        .input-icon i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #cbd5e1;
        }

        .footer-link { color: #3498db; text-decoration: none; font-weight: 700; }
    </style>
</head>
<body>

<div class="register-container">
    <div class="card">
        <div class="register-header">
            <i class="fas fa-user-plus"></i>
            <h3 class="fw-bold mb-1">Join EduManage Pro</h3>
            <p class="small mb-0 opacity-75">Create your institution account today</p>
        </div>

        <div class="card-body p-4 p-md-5">
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <div class="input-icon">
                            <input id="name" type="text" name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" required autofocus autocomplete="name" 
                                   placeholder="John Doe">
                            <i class="fas fa-user"></i>
                            @error('name')
                                <div class="invalid-feedback text-start">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-icon">
                            <input id="email" type="email" name="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" required autocomplete="username" 
                                   placeholder="john@example.com">
                            <i class="fas fa-envelope"></i>
                            @error('email')
                                <div class="invalid-feedback text-start">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-icon">
                            <input id="password" type="password" name="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   required autocomplete="new-password" 
                                   placeholder="••••••••">
                            <i class="fas fa-lock"></i>
                            @error('password')
                                <div class="invalid-feedback text-start">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="input-icon">
                            <input id="password_confirmation" type="password" 
                                   name="password_confirmation" class="form-control" 
                                   required autocomplete="new-password" 
                                   placeholder="••••••••">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-register">
                    Create Account <i class="fas fa-arrow-right ms-2"></i>
                </button>

                <div class="text-center mt-4">
                    <p class="small text-muted mb-0">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="footer-link">Sign In</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    
    <p class="text-center mt-4 small text-muted">&copy; {{ date('Y') }} EduManage Pro - Secure Enrollment</p>
</div>

<script>
    // Button loading effect
    document.getElementById('registerForm').addEventListener('submit', function() {
        const btn = this.querySelector('.btn-register');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Creating Account...';
        btn.classList.add('disabled');
    });
</script>

</body>
</html>
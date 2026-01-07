<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage | Smart School Management System</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        :root {
            --primary-dark: #1e293b;
            --primary-blue: #3b82f6;
            --accent-green: #1abc9c;
            --text-gray: #94a3b8;
            --light-bg: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Roboto, sans-serif;
            background-color: var(--light-bg);
            overflow-x: hidden;
        }

        /* --- Navigation --- */
        .navbar {
            background-color: var(--primary-dark);
            padding: 15px 0;
        }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; }
        .navbar-brand i { color: var(--primary-blue); }

        /* --- Modern Hero Section --- */
        .hero-section {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            padding: 100px 0 140px;
            position: relative;
            overflow: hidden;
            color: white;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -5%;
            width: 400px;
            height: 400px;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 50%;
            filter: blur(80px);
        }

        .hero-title {
            font-size: 3.5rem;
            line-height: 1.1;
            background: linear-gradient(to right, #fff, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -1px;
        }

        .hero-subtitle {
            color: var(--text-gray);
            font-size: 1.2rem;
            max-width: 550px;
        }

        /* --- Glassmorphism Visual --- */
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .stat-badge {
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
            padding: 6px 16px;
            border-radius: 100px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }

        /* --- Feature Cards --- */
        .section-padding { padding: 80px 0; }
        .feature-card {
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
        }

        /* --- Stats Section --- */
        .stats-section {
            background-color: #0f172a;
            color: white;
            padding: 60px 0;
            margin-top: -60px;
            position: relative;
            z-index: 10;
            border-radius: 30px;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-blue);
        }

        /* --- Login Portal --- */
        .login-card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .login-header {
            background: var(--primary-dark);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .user-type-btn {
            border: 2px solid #f1f5f9;
            border-radius: 12px;
            padding: 15px;
            cursor: pointer;
            transition: 0.3s;
        }
        .user-type-btn.active {
            border-color: var(--primary-blue);
            background: rgba(59, 130, 246, 0.05);
            color: var(--primary-blue);
        }

        /* --- Footer --- */
        footer {
            background: var(--primary-dark);
            color: #cbd5e1;
            padding: 80px 0 30px;
        }
        footer a { color: #94a3b8; text-decoration: none; transition: 0.3s; }
        footer a:hover { color: var(--primary-blue); }

        .btn-hero-primary {
            background: var(--primary-blue);
            color: white;
            padding: 15px 35px;
            border-radius: 12px;
            font-weight: 700;
            border: none;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fas fa-graduation-cap me-2"></i>EduManage</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#announcements">Announcements</a></li>
            </ul>
            <div class="navbar-nav ms-auto">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-light rounded-pill px-4">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-link text-white text-decoration-none me-3">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4">Get Started</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<header class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 text-start animate__animated animate__fadeInLeft">
                <span class="stat-badge">
                    <i class="fas fa-sparkles me-2"></i>The Future of Education is Here
                </span>
                <h1 class="display-4 fw-bold mb-4 hero-title">
                    Empowering Minds Through <br>
                    <span style="color: var(--primary-blue);">Smart Management.</span>
                </h1>
                <p class="lead mb-5 hero-subtitle">
                    A unified platform designed to help schools, colleges, and academies automate operations, track student progress, and manage finances effortlessly.
                </p>
                <div class="d-flex gap-3">
                    <button class="btn btn-hero-primary shadow-lg" onclick="document.getElementById('login-box').scrollIntoView({behavior: 'smooth'})">
                        Access Portal <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                    <button class="btn btn-outline-light border-2 px-4 py-3 rounded-4 fw-bold">
                        <i class="fas fa-play-circle me-2"></i> Watch Demo
                    </button>
                </div>
            </div>

            <div class="col-lg-5 d-none d-lg-block animate__animated animate__fadeInRight">
                <div class="glass-card">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-circle bg-primary p-3 me-3 shadow">
                            <i class="fas fa-chart-line fa-lg text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">Live Stats</h5>
                            <small class="text-muted">Real-time Data Sync</small>
                        </div>
                    </div>
                    <div class="progress mb-3" style="height: 10px; background: rgba(255,255,255,0.1);">
                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" style="width: 85%"></div>
                    </div>
                    <div class="d-flex justify-content-between small opacity-75 mb-4">
                        <span>Attendance Rate</span>
                        <span>85%</span>
                    </div>
                    <div class="row text-center border-top border-white border-opacity-10 pt-4">
                        <div class="col-6 border-end border-white border-opacity-10">
                            <h4 class="fw-bold mb-0">1.2k+</h4>
                            <small class="text-muted">Students</small>
                        </div>
                        <div class="col-6">
                            <h4 class="fw-bold mb-0">45+</h4>
                            <small class="text-muted">Staff</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="stats-section text-center shadow-lg">
    <div class="container">
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="stat-number" id="schoolsCount">0</div>
                <div class="text-uppercase small opacity-50 fw-bold">Partner Schools</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-number" id="studentsCount">0</div>
                <div class="text-uppercase small opacity-50 fw-bold">Active Students</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-number" id="teachersCount">0</div>
                <div class="text-uppercase small opacity-50 fw-bold">Expert Teachers</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-number" id="yearsCount">0</div>
                <div class="text-uppercase small opacity-50 fw-bold">Years Experience</div>
            </div>
        </div>
    </div>
</div>

<section id="features" class="section-padding">
    <div class="container text-center">
        <div class="mb-5">
            <h2 class="fw-bold display-6">Core Management Modules</h2>
            <p class="text-muted">Everything you need to run your institution efficiently</p>
        </div>
        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="card feature-card h-100 p-4">
                    <div class="p-3 bg-light rounded-circle mx-auto mb-3" style="width: fit-content;">
                        <i class="fas fa-user-graduate feature-icon mb-0"></i>
                    </div>
                    <h4>Student Information</h4>
                    <p class="text-muted">Manage admissions, profiles, and academic history in one secure place.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card h-100 p-4">
                    <div class="p-3 bg-light rounded-circle mx-auto mb-3" style="width: fit-content;">
                        <i class="fas fa-wallet feature-icon mb-0"></i>
                    </div>
                    <h4>Smart Billing</h4>
                    <p class="text-muted">Automated fee invoices, online payments, and comprehensive financial reports.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card h-100 p-4">
                    <div class="p-3 bg-light rounded-circle mx-auto mb-3" style="width: fit-content;">
                        <i class="fas fa-calendar-check feature-icon mb-0"></i>
                    </div>
                    <h4>Attendance Tracking</h4>
                    <p class="text-muted">Daily digital attendance with automated SMS notifications for parents.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white" id="announcements">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7">
                <h3 class="fw-bold mb-4"><i class="fas fa-bullhorn text-primary me-2"></i>Latest Updates</h3>
                <div class="p-3 border-start border-4 border-primary bg-light rounded-3 mb-3 shadow-sm">
                    <div class="d-flex justify-content-between">
                        <h6 class="fw-bold mb-1">Annual Examination Schedule</h6>
                        <span class="badge bg-danger rounded-pill">New</span>
                    </div>
                    <p class="small text-muted mb-0">The final term examination datesheet for 2026 has been released.</p>
                </div>
                <div class="p-3 border-start border-4 border-info bg-light rounded-3 mb-3 shadow-sm">
                    <h6 class="fw-bold mb-1">Fee Submission Deadline</h6>
                    <p class="small text-muted mb-0">Last date for monthly fee submission is the 10th of every month.</p>
                </div>
            </div>

            <div class="col-lg-5" id="login-box">
                <div class="card login-card shadow-lg">
                    <div class="login-header">
                        <h4 class="mb-1 fw-bold">Portal Access</h4>
                        <p class="small opacity-75 mb-0">Login to your specialized dashboard</p>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-2 mb-4">
                            <div class="col-6">
                                <div class="user-type-btn active text-center" onclick="setType('student', this)">
                                    <i class="fas fa-graduation-cap d-block mb-1"></i> Student
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="user-type-btn text-center" onclick="setType('staff', this)">
                                    <i class="fas fa-user-tie d-block mb-1"></i> Staff
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Login Email</label>
                                <input type="email" name="email" class="form-control rounded-3 py-2" placeholder="name@school.com" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Password</label>
                                <input type="password" name="password" class="form-control rounded-3 py-2" placeholder="••••••••" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-3 shadow">
                                Secure Login <i class="fas fa-lock ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row g-4 mb-5">
            <div class="col-md-5">
                <h4 class="fw-bold text-white mb-4"><i class="fas fa-graduation-cap text-primary me-2"></i>EduManage</h4>
                <p style="max-width: 350px;">Transforming education through technology. We provide tools that help educators focus on teaching, not paperwork.</p>
                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="fs-5"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="fs-5"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="fs-5"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="col-md-3">
                <h6 class="text-white fw-bold mb-4">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#">Academic Calendar</a></li>
                    <li class="mb-2"><a href="#">Privacy Policy</a></li>
                    <li class="mb-2"><a href="#">Terms & Conditions</a></li>
                    <li class="mb-2"><a href="#">Contact Support</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="text-white fw-bold mb-4">Contact Info</h6>
                <p class="small mb-2"><i class="fas fa-map-marker-alt me-2 text-primary"></i> Gurguri Karak, Kpk Pakistan</p>
                <p class="small mb-2"><i class="fas fa-envelope me-2 text-primary"></i> shahnawaz@gmail.com</p>
                <p class="small"><i class="fas fa-phone-alt me-2 text-primary"></i> +923 49088073</p>
            </div>
        </div>
        <hr class="border-secondary opacity-25">
        <div class="text-center small opacity-50">
            &copy; 2026 EduManage Pro. Built for modern institutions.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Counter Animation Logic
    function animateValue(id, start, end, duration) {
        const obj = document.getElementById(id);
        if(!obj) return;
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.innerHTML = Math.floor(progress * (end - start) + start).toLocaleString();
            if (progress < 1) { window.requestAnimationFrame(step); }
        };
        window.requestAnimationFrame(step);
    }

    // Initialize Counters
    window.addEventListener('DOMContentLoaded', () => {
        animateValue("schoolsCount", 0, 1250, 2000);
        animateValue("studentsCount", 0, 8500, 2000);
        animateValue("teachersCount", 0, 450, 2000);
        animateValue("yearsCount", 0, 15, 2000);
    });

    // Portal Type Switcher
    function setType(type, element) {
        document.querySelectorAll('.user-type-btn').forEach(btn => btn.classList.remove('active'));
        element.classList.add('active');
        console.log("Portal switched to:", type);
    }
</script>

</body>
</html>
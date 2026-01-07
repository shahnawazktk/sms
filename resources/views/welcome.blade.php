<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage  |School Management System</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        :root {
            --primary-dark: #1e293b;
            --primary-blue: #3b82f6;
            --accent-green: #1abc9c;
            --accent-purple: #8b5cf6;
            --accent-amber: #f59e0b;
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

        /* --- Advanced Features Section --- */
        .advanced-feature-card {
            background: linear-gradient(145deg, #ffffff, #f5f7fa);
            border: 1px solid rgba(59, 130, 246, 0.1);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
            height: 100%;
        }
        .advanced-feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.15);
            border-color: rgba(59, 130, 246, 0.3);
        }
        .feature-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent-purple);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .ai-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 16px;
            display: inline-block;
            margin-bottom: 20px;
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

        /* --- AI Assistant Panel --- */
        .ai-assistant-panel {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        .ai-assistant-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
        }
        .ai-assistant-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.6);
        }
        .ai-chat-window {
            position: absolute;
            bottom: 70px;
            right: 0;
            width: 350px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            display: none;
            overflow: hidden;
        }
        .ai-chat-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
        }
        .ai-chat-body {
            padding: 20px;
            max-height: 300px;
            overflow-y: auto;
        }
        .ai-message {
            background: #f1f5f9;
            padding: 12px 16px;
            border-radius: 18px 18px 18px 4px;
            margin-bottom: 10px;
            max-width: 80%;
        }
        .user-message {
            background: var(--primary-blue);
            color: white;
            padding: 12px 16px;
            border-radius: 18px 18px 4px 18px;
            margin-left: auto;
            margin-bottom: 10px;
            max-width: 80%;
        }

        /* --- Analytics Dashboard Preview --- */
        .analytics-preview {
            background: #0f172a;
            border-radius: 20px;
            padding: 30px;
            color: white;
            margin-top: 40px;
        }
        .chart-container {
            height: 200px;
            position: relative;
            margin-top: 20px;
        }
        .chart-bar {
            position: absolute;
            bottom: 0;
            width: 30px;
            background: linear-gradient(to top, #3b82f6, #60a5fa);
            border-radius: 6px 6px 0 0;
            margin: 0 10px;
        }

        /* --- Mobile App Preview --- */
        .mobile-preview {
            position: relative;
            height: 500px;
        }
        .mobile-frame {
            width: 280px;
            height: 500px;
            background: #1e293b;
            border-radius: 30px;
            position: relative;
            padding: 20px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.3);
        }
        .mobile-screen {
            background: white;
            height: 100%;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
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

        /* --- Responsive Adjustments --- */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .ai-chat-window {
                width: 300px;
                right: -20px;
            }
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
                <li class="nav-item"><a class="nav-link" href="#advanced">Advanced</a></li>
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
                    <i class="fas fa-robot me-2"></i>Now with AI-Powered Features
                </span>
                <h1 class="display-4 fw-bold mb-4 hero-title">
                    Next-Generation <br>
                    <span style="color: var(--primary-blue);">School Intelligence.</span>
                </h1>
                <p class="lead mb-5 hero-subtitle">
                    AI-driven insights, predictive analytics, and automated workflows that transform educational institutions into smart learning ecosystems.
                </p>
                <div class="d-flex gap-3">
                    <button class="btn btn-hero-primary shadow-lg" onclick="document.getElementById('login-box').scrollIntoView({behavior: 'smooth'})">
                        Access Portal <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                    <button class="btn btn-outline-light border-2 px-4 py-3 rounded-4 fw-bold" onclick="showAIDemo()">
                        <i class="fas fa-robot me-2"></i> Try AI Assistant
                    </button>
                </div>
            </div>

            <div class="col-lg-5 d-none d-lg-block animate__animated animate__fadeInRight">
                <div class="glass-card">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-circle bg-primary p-3 me-3 shadow">
                            <i class="fas fa-brain fa-lg text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">AI Predictions</h5>
                            <small class="text-muted">Real-time Analytics</small>
                        </div>
                    </div>
                    <div class="progress mb-3" style="height: 10px; background: rgba(255,255,255,0.1);">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 92%"></div>
                    </div>
                    <div class="d-flex justify-content-between small opacity-75 mb-4">
                        <span>Student Success Prediction</span>
                        <span>92% Accuracy</span>
                    </div>
                    <div class="row text-center border-top border-white border-opacity-10 pt-4">
                        <div class="col-6 border-end border-white border-opacity-10">
                            <h4 class="fw-bold mb-0">AI</h4>
                            <small class="text-muted">Powered</small>
                        </div>
                        <div class="col-6">
                            <h4 class="fw-bold mb-0">24/7</h4>
                            <small class="text-muted">Support</small>
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
                <div class="stat-number" id="aiPredictions">0</div>
                <div class="text-uppercase small opacity-50 fw-bold">Daily AI Predictions</div>
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

<!-- Advanced Features Section -->
<section id="advanced" class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-6">Advanced AI-Powered Features</h2>
            <p class="text-muted">Cutting-edge technology for modern educational institutions</p>
        </div>
        
        <div class="row g-4">
            <!-- AI Predictive Analytics -->
            <div class="col-lg-4 col-md-6">
                <div class="advanced-feature-card p-4 position-relative">
                    <span class="feature-badge">AI</span>
                    <div class="ai-icon">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Predictive Analytics</h4>
                    <p class="text-muted mb-4">AI algorithms predict student performance, dropout risks, and learning gaps with 92% accuracy.</p>
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-2 rounded me-2">
                            <i class="fas fa-bolt text-primary"></i>
                        </div>
                        <small class="text-muted">Real-time risk assessment</small>
                    </div>
                </div>
            </div>
            
            <!-- Smart Resource Allocation -->
            <div class="col-lg-4 col-md-6">
                <div class="advanced-feature-card p-4 position-relative">
                    <span class="feature-badge">AI</span>
                    <div class="ai-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);">
                        <i class="fas fa-cogs fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Smart Resource Allocation</h4>
                    <p class="text-muted mb-4">AI optimizes classroom assignments, teacher schedules, and facility usage for maximum efficiency.</p>
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-2 rounded me-2">
                            <i class="fas fa-brain text-warning"></i>
                        </div>
                        <small class="text-muted">Optimized scheduling</small>
                    </div>
                </div>
            </div>
            
            <!-- Voice-Enabled Assistant -->
            <div class="col-lg-4 col-md-6">
                <div class="advanced-feature-card p-4 position-relative">
                    <span class="feature-badge">AI</span>
                    <div class="ai-icon" style="background: linear-gradient(135deg, #10b981 0%, #34d399 100%);">
                        <i class="fas fa-microphone-alt fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Voice-Enabled Assistant</h4>
                    <p class="text-muted mb-4">Natural language processing for voice commands, attendance marking, and information retrieval.</p>
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-2 rounded me-2">
                            <i class="fas fa-voice text-success"></i>
                        </div>
                        <small class="text-muted">Voice command support</small>
                    </div>
                </div>
            </div>
            
            <!-- Automated Report Generation -->
            <div class="col-lg-4 col-md-6">
                <div class="advanced-feature-card p-4 position-relative">
                    <span class="feature-badge">AI</span>
                    <div class="ai-icon" style="background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);">
                        <i class="fas fa-file-alt fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Automated Report Generation</h4>
                    <p class="text-muted mb-4">AI creates personalized student reports, progress analyses, and institutional analytics automatically.</p>
                    <div class="d-flex align-items-center">
                        <div class="bg-purple bg-opacity-10 p-2 rounded me-2">
                            <i class="fas fa-robot text-purple"></i>
                        </div>
                        <small class="text-muted">Natural language reports</small>
                    </div>
                </div>
            </div>
            
            <!-- Behavioral Analytics -->
            <div class="col-lg-4 col-md-6">
                <div class="advanced-feature-card p-4 position-relative">
                    <span class="feature-badge">AI</span>
                    <div class="ai-icon" style="background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%);">
                        <i class="fas fa-user-chart fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Behavioral Analytics</h4>
                    <p class="text-muted mb-4">Monitor student engagement patterns, social interactions, and emotional well-being indicators.</p>
                    <div class="d-flex align-items-center">
                        <div class="bg-pink bg-opacity-10 p-2 rounded me-2">
                            <i class="fas fa-heart text-pink"></i>
                        </div>
                        <small class="text-muted">Emotional intelligence tracking</small>
                    </div>
                </div>
            </div>
            
            <!-- Blockchain Security -->
            <div class="col-lg-4 col-md-6">
                <div class="advanced-feature-card p-4 position-relative">
                    <span class="feature-badge">Blockchain</span>
                    <div class="ai-icon" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);">
                        <i class="fas fa-shield-alt fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Blockchain Security</h4>
                    <p class="text-muted mb-4">Immutable record-keeping for certificates, transcripts, and credentials using blockchain technology.</p>
                    <div class="d-flex align-items-center">
                        <div class="bg-indigo bg-opacity-10 p-2 rounded me-2">
                            <i class="fas fa-link text-indigo"></i>
                        </div>
                        <small class="text-muted">Tamper-proof records</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Analytics Dashboard Preview -->
        <div class="analytics-preview mt-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3 class="fw-bold mb-3">Real-time Analytics Dashboard</h3>
                    <p class="text-light mb-4">Monitor institutional performance with interactive dashboards powered by machine learning algorithms.</p>
                    <div class="d-flex">
                        <div class="me-4">
                            <h5 class="fw-bold text-primary">85%</h5>
                            <small class="text-muted">Attendance Rate</small>
                        </div>
                        <div class="me-4">
                            <h5 class="fw-bold text-success">92%</h5>
                            <small class="text-muted">Student Satisfaction</small>
                        </div>
                        <div>
                            <h5 class="fw-bold text-warning">78%</h5>
                            <small class="text-muted">Resource Utilization</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="chart-container">
                        <div class="chart-bar" style="left: 10%; height: 70%;"></div>
                        <div class="chart-bar" style="left: 25%; height: 85%;"></div>
                        <div class="chart-bar" style="left: 40%; height: 60%;"></div>
                        <div class="chart-bar" style="left: 55%; height: 92%;"></div>
                        <div class="chart-bar" style="left: 70%; height: 78%;"></div>
                        <div class="chart-bar" style="left: 85%; height: 65%;"></div>
                    </div>
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
                        <h6 class="fw-bold mb-1">AI Predictive Analytics Live</h6>
                        <span class="badge bg-danger rounded-pill">New</span>
                    </div>
                    <p class="small text-muted mb-0">Our AI prediction system is now active with 92% accuracy in identifying at-risk students.</p>
                </div>
                <div class="p-3 border-start border-4 border-info bg-light rounded-3 mb-3 shadow-sm">
                    <h6 class="fw-bold mb-1">Mobile App Update</h6>
                    <p class="small text-muted mb-0">New EduManage mobile app with AI assistant now available on iOS and Android.</p>
                </div>
                <div class="p-3 border-start border-4 border-success bg-light rounded-3 mb-3 shadow-sm">
                    <h6 class="fw-bold mb-1">Blockchain Certificates</h6>
                    <p class="small text-muted mb-0">Digital certificates with blockchain verification now available for all graduates.</p>
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
                            <div class="col-6 mt-2">
                                <div class="user-type-btn text-center" onclick="setType('parent', this)">
                                    <i class="fas fa-users d-block mb-1"></i> Parent
                                </div>
                            </div>
                            <div class="col-6 mt-2">
                                <div class="user-type-btn text-center" onclick="setType('admin', this)">
                                    <i class="fas fa-user-shield d-block mb-1"></i> Admin
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
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="voiceLogin">
                                <label class="form-check-label small" for="voiceLogin">Enable Voice Login</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-3 shadow">
                                Secure Login <i class="fas fa-lock ms-2"></i>
                            </button>
                        </form>
                        <div class="text-center mt-3">
                            <small class="text-muted">Or login with</small>
                            <div class="d-flex justify-content-center gap-2 mt-2">
                                <button class="btn btn-outline-secondary btn-sm rounded-pill">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button class="btn btn-outline-secondary btn-sm rounded-pill">
                                    <i class="fab fa-google"></i>
                                </button>
                                <button class="btn btn-outline-secondary btn-sm rounded-pill" onclick="startVoiceLogin()">
                                    <i class="fas fa-microphone"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mobile App Preview -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold display-6 mb-4">EduManage Mobile App</h2>
                <p class="lead mb-4">Access all features on-the-go with our AI-powered mobile application.</p>
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="fas fa-bell text-primary"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Real-time Notifications</h6>
                                <small class="text-muted">Instant alerts and updates</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                                <i class="fas fa-robot text-success"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">AI Assistant</h6>
                                <small class="text-muted">Voice-controlled help</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 p-3 rounded me-3">
                                <i class="fas fa-qrcode text-warning"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">QR Attendance</h6>
                                <small class="text-muted">Scan to mark attendance</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-purple bg-opacity-10 p-3 rounded me-3">
                                <i class="fas fa-chart-pie text-purple"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Analytics</h6>
                                <small class="text-muted">Performance insights</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary me-3">
                        <i class="fab fa-apple me-2"></i> App Store
                    </button>
                    <button class="btn btn-dark">
                        <i class="fab fa-google-play me-2"></i> Play Store
                    </button>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="mobile-preview">
                    <div class="mobile-frame mx-auto">
                        <div class="mobile-screen">
                            <div class="p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                <h6 class="mb-0">EduManage AI Assistant</h6>
                            </div>
                            <div class="p-3">
                                <div class="ai-message">Hello! How can I help you today?</div>
                                <div class="user-message">Check my attendance</div>
                                <div class="ai-message">Your attendance is 92% this month.</div>
                            </div>
                        </div>
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
                <h4 class="fw-bold text-white mb-4"><i class="fas fa-graduation-cap text-primary me-2"></i>EduManage Pro</h4>
                <p style="max-width: 350px;">Transforming education through AI and advanced technology. We provide intelligent tools that help educators focus on teaching, not paperwork.</p>
                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="fs-5"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="fs-5"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="fs-5"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="fs-5"><i class="fab fa-github"></i></a>
                </div>
            </div>
            <div class="col-md-3">
                <h6 class="text-white fw-bold mb-4">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#">AI Features</a></li>
                    <li class="mb-2"><a href="#">Mobile App</a></li>
                    <li class="mb-2"><a href="#">Privacy Policy</a></li>
                    <li class="mb-2"><a href="#">Terms & Conditions</a></li>
                    <li class="mb-2"><a href="#">Contact Support</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="text-white fw-bold mb-4">Contact Info</h6>
                <p class="small mb-2"><i class="fas fa-map-marker-alt me-2 text-primary"></i> Gurguri Karak, Kpk Pakistan</p>
                <p class="small mb-2"><i class="fas fa-envelope me-2 text-primary"></i> shahnawaz@gmail.com</p>
                <p class="small mb-2"><i class="fas fa-phone-alt me-2 text-primary"></i> +923 49088073</p>
                <p class="small"><i class="fas fa-headset me-2 text-primary"></i> 24/7 AI Support Available</p>
            </div>
        </div>
        <hr class="border-secondary opacity-25">
        <div class="text-center small opacity-50">
            &copy; 2026 EduManage. Built with AI for modern institutions.
        </div>
    </div>
</footer>

<!-- AI Assistant Panel -->
<div class="ai-assistant-panel">
    <div class="ai-chat-window" id="aiChatWindow">
        <div class="ai-chat-header">
            <h6 class="mb-0"><i class="fas fa-robot me-2"></i> EduManage AI Assistant</h6>
            <small>How can I help you today?</small>
        </div>
        <div class="ai-chat-body" id="aiChatBody">
            <div class="ai-message">Hello! I'm your AI assistant. Ask me about attendance, grades, schedules, or any school information.</div>
        </div>
        <div class="p-3 border-top">
            <div class="input-group">
                <input type="text" class="form-control rounded-3" id="aiQuery" placeholder="Type your question...">
                <button class="btn btn-primary rounded-3" onclick="sendAIQuery()">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
            <small class="text-muted mt-2 d-block">Try: "What's my attendance?" or "When is the next exam?"</small>
        </div>
    </div>
    <div class="ai-assistant-btn" onclick="toggleAIChat()">
        <i class="fas fa-robot"></i>
    </div>
</div>

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
        animateValue("aiPredictions", 0, 12500, 2000);
        
        // Animate chart bars
        const bars = document.querySelectorAll('.chart-bar');
        bars.forEach((bar, index) => {
            setTimeout(() => {
                bar.style.height = bar.style.height;
            }, index * 200);
        });
    });

    // Portal Type Switcher
    function setType(type, element) {
        document.querySelectorAll('.user-type-btn').forEach(btn => btn.classList.remove('active'));
        element.classList.add('active');
        console.log("Portal switched to:", type);
    }

    // AI Assistant Functions
    let aiChatVisible = false;
    
    function toggleAIChat() {
        const chatWindow = document.getElementById('aiChatWindow');
        aiChatVisible = !aiChatVisible;
        chatWindow.style.display = aiChatVisible ? 'block' : 'none';
    }
    
    function showAIDemo() {
        const chatWindow = document.getElementById('aiChatWindow');
        chatWindow.style.display = 'block';
        aiChatVisible = true;
        
        const chatBody = document.getElementById('aiChatBody');
        chatBody.innerHTML = `
            <div class="ai-message">Welcome to the AI Assistant demo! I can help you with:</div>
            <div class="ai-message">• Checking student attendance and grades</div>
            <div class="ai-message">• Finding class schedules and room assignments</div>
            <div class="ai-message">• Providing performance analytics</div>
            <div class="ai-message">• Answering school policy questions</div>
            <div class="ai-message">Try asking: "What's the average grade in Math class?"</div>
        `;
    }
    
    function sendAIQuery() {
        const queryInput = document.getElementById('aiQuery');
        const query = queryInput.value.trim();
        if (!query) return;
        
        const chatBody = document.getElementById('aiChatBody');
        
        // Add user message
        const userMsg = document.createElement('div');
        userMsg.className = 'user-message';
        userMsg.textContent = query;
        chatBody.appendChild(userMsg);
        
        // Clear input
        queryInput.value = '';
        
        // Simulate AI response
        setTimeout(() => {
            const aiResponses = [
                "Based on current data, your attendance is 92% for this month.",
                "The next examination is scheduled for March 15th, 2026.",
                "Your current GPA is 3.75, which is in the top 15% of your class.",
                "Fee payment deadline is the 10th of each month.",
                "I've identified that you might need extra help with Mathematics. Would you like me to schedule a tutor session?",
                "According to predictive analytics, you're on track to achieve an A grade in Science."
            ];
            
            const randomResponse = aiResponses[Math.floor(Math.random() * aiResponses.length)];
            
            const aiMsg = document.createElement('div');
            aiMsg.className = 'ai-message';
            aiMsg.textContent = randomResponse;
            chatBody.appendChild(aiMsg);
            
            // Scroll to bottom
            chatBody.scrollTop = chatBody.scrollHeight;
        }, 1000);
    }
    
    // Voice Login Simulation
    function startVoiceLogin() {
        alert("Voice login activated! Say 'Login as student' or 'Login as staff' to continue.");
        // In a real implementation, this would integrate with Web Speech API
    }
    
    // Chart Animation
    document.querySelectorAll('.chart-bar').forEach(bar => {
        const height = bar.style.height;
        bar.style.height = '0%';
        setTimeout(() => {
            bar.style.height = height;
        }, 500);
    });
</script>

</body>
</html>
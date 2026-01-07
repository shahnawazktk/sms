<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'EduManage Pro') }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root { --sidebar-width: 260px; --primary-bg: #f8fafc; --sidebar-bg: #1e293b; --accent-blue: #3b82f6; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--primary-bg); overflow-x: hidden; }
        
        #sidebar-wrapper { min-height: 100vh; width: var(--sidebar-width); background: var(--sidebar-bg); transition: all 0.3s ease; position: fixed; z-index: 1000; }
        .sidebar-heading { padding: 1.5rem 1.25rem; color: #fff; font-weight: 700; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .list-group-item { background: transparent; border: none; color: #94a3b8; padding: 12px 20px; transition: 0.2s; text-decoration: none; display: block; }
        .list-group-item:hover, .list-group-item.active { background: rgba(59, 130, 246, 0.1); color: var(--accent-blue); border-left: 4px solid var(--accent-blue); }
        
        #page-content-wrapper { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); transition: all 0.3s ease; }
        .navbar { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.03); padding: 15px 25px; }
        .user-profile-img { width: 35px; height: 35px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-weight: 600; }

        @media (max-width: 768px) {
            #sidebar-wrapper { margin-left: calc(-1 * var(--sidebar-width)); }
            #page-content-wrapper { margin-left: 0; width: 100%; }
            body.toggled #sidebar-wrapper { margin-left: 0; }
        }
    </style>
    @stack('styles') {{-- Extra CSS ke liye --}}
</head>
<body>

<div class="d-flex" id="wrapper">
    @include('layouts.navigation');

    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light border-bottom">
            <div class="container-fluid">
                <button class="btn btn-light border" id="menu-toggle"><i class="fas fa-bars"></i></button>
                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn d-flex align-items-center gap-2 border-0" type="button" data-bs-toggle="dropdown">
                            <div class="text-end d-none d-sm-block">
                                <p class="mb-0 small fw-bold">{{ Auth::user()->name }}</p>
                                <p class="mb-0 x-small text-muted" style="font-size: 0.75rem;">Admin</p>
                            </div>
                            <div class="user-profile-img">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid p-4">
            {{-- Yahan page ka title aur breadcrumbs aayenge --}}
            @yield('header')

            {{-- Yahan page ka main content aayega --}}
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById("menu-toggle").addEventListener("click", function() {
        document.body.classList.toggle("toggled");
    });
</script>
@stack('scripts')
</body>
</html>
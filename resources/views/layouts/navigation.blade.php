<style>
    #sidebar-wrapper {
        min-width: 280px;
        max-width: 280px;
        background: #1e293b; /* Deep Navy Dark */
        min-height: 100vh;
        transition: all 0.3s;
        padding: 1.5rem 1rem;
        display: flex;
        flex-direction: column;
    }

    .sidebar-heading {
        padding: 0.5rem 1rem 2rem;
        font-size: 1.5rem;
        font-weight: 800;
        color: #fff;
        display: flex;
        align-items: center;
        letter-spacing: -0.5px;
    }

    .nav-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #64748b;
        margin: 1.5rem 0 0.5rem 1rem;
        letter-spacing: 1px;
    }

    /* Sidebar Links Style */
    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        margin-bottom: 5px;
        color: #94a3b8;
        text-decoration: none;
        border-radius: 12px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .sidebar-link i {
        width: 25px;
        font-size: 1.1rem;
        margin-right: 12px;
        transition: all 0.2s;
    }

    /* Active State */
    .sidebar-link.active {
        background: #3b82f6; /* Electric Blue */
        color: #fff;
        box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
    }

    .sidebar-link.active i {
        color: #fff;
    }

    /* Hover State */
    .sidebar-link:hover:not(.active) {
        background: rgba(255, 255, 255, 0.05);
        color: #f1f5f9;
        transform: translateX(5px);
    }

    /* Logout Button Fix */
    .logout-btn {
        margin-top: auto;
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444 !important;
        border: 1px solid rgba(239, 68, 68, 0.1);
    }

    .logout-btn:hover {
        background: #ef4444 !important;
        color: #fff !important;
    }
</style>

<div id="sidebar-wrapper">
    <div class="sidebar-heading">
        <div class="p-2 bg-info rounded-3 me-2 shadow-sm">
            <i class="fas fa-graduation-cap text-white m-0"></i>
        </div>
        <span>EduManage</span>
    </div>

    <div class="nav-content mt-2">
        <div class="nav-label">Main Menu</div>
        
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-grid-2"></i> Dashboard
        </a>

        <div class="nav-label">Academic</div>
        
        <a href="{{ route('students.index') }}" class="sidebar-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
            <i class="fas fa-user-graduate"></i> Students
        </a>

        <a href="{{ route('teachers.index') }}" class="sidebar-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}">
            <i class="fas fa-chalkboard-teacher"></i> Teachers
        </a>

        <a href="{{ route('courses.index') }}" class="sidebar-link">
            <i class="fas fa-book-open"></i> Courses
        </a>

        <div class="nav-label">Finance</div>

        <a href="#" class="sidebar-link {{ request()->routeIs('fees.*') ? 'active' : '' }}">
            <i class="fas fa-file-invoice-dollar"></i> Fee Management
        </a>

        <div class="nav-label">Settings</div>
        
        <a href="{{ route('profile.edit') }}" class="sidebar-link">
            <i class="fas fa-cog"></i> System Settings
        </a>
    </div>

    <div class="mt-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-link logout-btn w-100 border-0">
                <i class="fas fa-power-off"></i> Logout
            </button>
        </form>
    </div>
</div>
<style>
    #sidebar-wrapper {
        width: 280px;
        background: #1e293b;
        min-height: 100vh;
        padding: 1.5rem 1rem;
        display: flex;
        flex-direction: column;
        position: fixed;
        left: 0;
        top: 0;
        overflow: hidden;
    }

    /* Scroll only menu content */
    .nav-content {
        flex: 1;
        overflow-y: auto;
        padding-right: 4px;
    }

    .sidebar-heading {
        padding: 0.5rem 1rem 1.5rem;
        font-size: 1.5rem;
        font-weight: 800;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 10px;
        white-space: nowrap;
    }

    .nav-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #64748b;
        margin: 1.2rem 0 0.4rem 1rem;
        letter-spacing: 1px;
    }

    /* Sidebar Links */
    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 14px;
        margin-bottom: 6px;
        color: #94a3b8;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 500;
        transition: background 0.2s ease, color 0.2s ease;
        white-space: nowrap;
    }

    .sidebar-link i {
        width: 22px;
        font-size: 1.05rem;
        text-align: center;
    }

    .sidebar-link.active {
        background: #3b82f6;
        color: #fff;
        box-shadow: 0 8px 14px rgba(59, 130, 246, 0.35);
    }

    .sidebar-link:hover:not(.active) {
        background: rgba(255, 255, 255, 0.06);
        color: #f1f5f9;
    }

    /* Logout Button */
    .logout-btn {
        background: rgba(239, 68, 68, 0.12);
        color: #ef4444 !important;
        border: none;
    }

    .logout-btn:hover {
        background: #ef4444 !important;
        color: #fff !important;
    }

    /* Remove ugly scrollbar */
    .nav-content::-webkit-scrollbar {
        width: 4px;
    }

    .nav-content::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.15);
        border-radius: 10px;
    }
</style>

<div id="sidebar-wrapper">

    <div class="sidebar-heading">
        <div class="p-2 bg-info rounded-3 shadow-sm">
            <i class="fas fa-graduation-cap text-white"></i>
        </div>
        <span>EduManage</span>
    </div>

    <div class="nav-content">

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

        <a href="{{ route('attendance.index') }}" class="sidebar-link">
            <i class="fas fa-user-check"></i> Attendance
        </a>

        <div class="nav-label">Finance</div>
        <a href="{{ route('fees.index') }}" class="sidebar-link {{ request()->routeIs('fees.*') ? 'active' : '' }}">
            <i class="fas fa-file-invoice-dollar"></i> Fee Management
        </a>

        <div class="nav-label">Settings</div>
        <a href="{{ route('profile.edit') }}" class="sidebar-link">
            <i class="fas fa-cog"></i> System Settings
        </a>

    </div>

    <div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="sidebar-link logout-btn w-100">
                <i class="fas fa-power-off"></i> Logout
            </button>
        </form>
    </div>

</div>

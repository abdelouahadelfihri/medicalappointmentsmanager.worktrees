<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Medical Appointments Manager')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            overflow: hidden;
        }

        /* Layout wrapper */
        .layout {
            display: flex;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            width: 230px;
            background: #B0C4DE;
            color: #000;
            transition: width 0.3s;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar.collapsed {
            width: 72px;
        }

        /* Sidebar scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        /* App header */
        .app-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .app-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.2rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .sidebar.collapsed .app-brand span {
            display: none;
        }

        /* Toggle button */
        .toggle-btn {
            background: rgba(255, 255, 255, 0.4);
            border: none;
            color: #000;
            border-radius: 8px;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .toggle-btn:hover {
            background: rgba(255, 255, 255, 0.6);
        }

        /* Links */
        .sidebar a {
            color: #000;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 4px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            white-space: nowrap;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        /* Hide text when collapsed */
        .sidebar.collapsed .nav-link span {
            display: none;
        }

        /* Submenus */
        .submenu .nav-link {
            padding-left: 36px;
            font-size: 0.9rem;
        }

        /* Third level indentation */
        .submenu .submenu .nav-link {
            padding-left: 52px;
            font-size: 0.85rem;
        }

        .sidebar.collapsed .submenu {
            display: none;
        }

        /* Content */
        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .topbar {
            position: fixed;
            top: 10px;
            left: 230px;
            /* same as sidebar width */
            z-index: 1050;
            transition: left 0.3s;
        }

        /* Move toggle when sidebar collapses */
        .sidebar.collapsed+.topbar {
            left: 72px;
        }

        .app-brand {
            font-size: 0.95rem;
        }

        .app-brand span {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.2;
            max-width: 160px;
        }

        /* User menu styles */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: auto;
        }

        .user-info {
            text-align: right;
            color: #000;
        }

        .user-info .user-name {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info .user-email {
            font-size: 0.8rem;
            color: #666;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
        }

        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .logout-btn:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        .alerts-section {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }

        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }
    </style>
    @stack('styles')
</head>

<body>

    <div class="layout">

        <!-- SIDEBAR -->
        <nav class="sidebar d-flex flex-column p-3" id="sidebar">

            <!-- App header -->
            <div class="app-header">
                <div class="app-brand" data-bs-toggle="tooltip" data-bs-placement="right"
                    title="Medical Appointments Manager">
                    <i class="bi bi-calendar2-check"></i>
                    <span>Medical Appointments Manager</span>
                </div>
            </div>

            <ul class="nav nav-pills flex-column mb-auto">

                <!-- Patients -->
                <li>
                    <a class="nav-link" data-bs-toggle="collapse" href="#patientsMenu">
                        <i class="bi bi-people"></i>
                        <span>Patients</span>
                    </a>
                    <div class="collapse" id="patientsMenu">
                        <ul class="nav flex-column submenu">
                            <li>
                                <a class="nav-link" href="{{ route('patients.index') }}">
                                    <i class="bi bi-list-ul"></i>
                                    <span>List</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('patients.create') }}">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Add</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Appointments -->
                <li>
                    <a class="nav-link" data-bs-toggle="collapse" href="#appointmentsMenu">
                        <i class="bi bi-calendar-check"></i>
                        <span>Appointments</span>
                    </a>
                    <div class="collapse" id="appointmentsMenu">
                        <ul class="nav flex-column submenu">
                            <li>
                                <a class="nav-link" href="{{ route('appointments.index') }}">
                                    <i class="bi bi-list-ul"></i>
                                    <span>List</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('appointments.create') }}">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Add</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Services -->
                <li>
                    <a class="nav-link" data-bs-toggle="collapse" href="#servicesMenu">
                        <i class="bi bi-heart-pulse"></i>
                        <span>Services</span>
                    </a>
                    <div class="collapse" id="servicesMenu">
                        <ul class="nav flex-column submenu">
                            <li>
                                <a class="nav-link" href="{{ route('services.index') }}">
                                    <i class="bi bi-list-ul"></i>
                                    <span>List</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('services.create') }}">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Add</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Doctors -->
                <li>
                    <a class="nav-link" data-bs-toggle="collapse" href="#doctorsMenu">
                        <i class="bi bi-person-badge"></i>
                        <span>Doctors</span>
                    </a>
                    <div class="collapse" id="doctorsMenu">
                        <ul class="nav flex-column submenu">
                            <li>
                                <a class="nav-link" href="{{ route('doctors.index') }}">
                                    <i class="bi bi-list-ul"></i>
                                    <span>List</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('doctors.create') }}">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Add</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="topbar">
            <div style="display: flex; align-items: center; width: 100%; gap: 15px; padding: 0 20px;">
                <button class="toggle-btn" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>

                @auth
                    <div class="user-menu">
                        <div class="user-info">
                            <div class="user-name">{{ auth()->user()->name }}</div>
                            <div class="user-email">{{ auth()->user()->email }}</div>
                        </div>
                        <div class="user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <form action="{{ route('auth.logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="logout-btn" title="Logout">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>

        <!-- CONTENT -->
        <div class="content">
            <!-- Alerts Section -->
            @if ($errors->any())
                <div class="alerts-section">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alerts-section">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="alerts-section">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            @endif

            @if (session('info'))
                <div class="alerts-section">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="bi bi-info-circle"></i> {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            @endif

            @yield('content')
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }
    </script>
    @stack('scripts')
</body>

</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HR System')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #34495e;
            --accent: #3498db;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar .nav-link {
            color: #fff;
            padding: 12px 20px;
            margin: 4px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            background: rgba(52, 152, 219, 0.2);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background: var(--accent);
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.3);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary) !important;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-left: 4px solid var(--accent);
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent) 0%, #2980b9 100%);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        .table th {
            background: var(--light);
            color: var(--dark);
            font-weight: 600;
            border-bottom: 2px solid var(--accent);
        }

        .badge {
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .action-buttons .btn {
            border-radius: 6px;
            margin: 2px;
            transition: all 0.2s ease;
        }

        .action-buttons .btn:hover {
            transform: scale(1.05);
        }

        .page-title {
            color: var(--primary);
            font-weight: 700;
            border-left: 4px solid var(--accent);
            padding-left: 15px;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .alert {
            border: none;
            border-radius: 8px;
            border-left: 4px solid;
        }

        .alert-success {
            border-left-color: var(--success);
        }

        .alert-danger {
            border-left-color: var(--danger);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar d-none d-md-block">
                <div class="d-flex flex-column p-3">
                    <a href="/" class="navbar-brand text-white mb-4 text-center">
                        <i class="fas fa-chart-line me-2"></i>HR System
                    </a>
                    <hr class="text-white-50">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                                <i class="fas fa-user-tie me-2"></i>Karyawan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('departments.index') }}" class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">
                                <i class="fas fa-building me-2"></i>Departemen
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('positions.index') }}" class="nav-link {{ request()->routeIs('positions.*') ? 'active' : '' }}">
                                <i class="fas fa-briefcase me-2"></i>Jabatan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attendances.index') }}" class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                                <i class="fas fa-calendar-check me-2"></i>Absensi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('salaries.index') }}" class="nav-link {{ request()->routeIs('salaries.*') ? 'active' : '' }}">
                                <i class="fas fa-money-bill-wave me-2"></i>Penggajian
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 ml-sm-auto px-4 py-4">
                <!-- Mobile Header -->
                <div class="d-md-none mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-primary fw-bold">HR System</h5>
                        <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                    <div class="collapse mt-3" id="mobileMenu">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('employees.index') }}" class="btn btn-outline-primary btn-sm text-start">
                                        <i class="fas fa-user-tie me-2"></i>Karyawan
                                    </a>
                                    <a href="{{ route('departments.index') }}" class="btn btn-outline-primary btn-sm text-start">
                                        <i class="fas fa-building me-2"></i>Departemen
                                    </a>
                                    <a href="{{ route('positions.index') }}" class="btn btn-outline-primary btn-sm text-start">
                                        <i class="fas fa-briefcase me-2"></i>Jabatan
                                    </a>
                                    <a href="{{ route('attendances.index') }}" class="btn btn-outline-primary btn-sm text-start">
                                        <i class="fas fa-calendar-check me-2"></i>Absensi
                                    </a>
                                    <a href="{{ route('salaries.index') }}" class="btn btn-outline-primary btn-sm text-start">
                                        <i class="fas fa-money-bill-wave me-2"></i>Penggajian
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="page-title">@yield('page-title')</h2>
                    <div>
                        @yield('header-buttons')
                    </div>
                </div>

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Content -->
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                new bootstrap.Alert(alert).close();
            });
        }, 5000);

        // Mobile menu auto-close
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 768) {
                if (!e.target.closest('#mobileMenu') && !e.target.closest('[data-bs-toggle="collapse"]')) {
                    const mobileMenu = document.getElementById('mobileMenu');
                    if (mobileMenu.classList.contains('show')) {
                        new bootstrap.Collapse(mobileMenu).hide();
                    }
                }
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
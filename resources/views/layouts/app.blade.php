<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#0f172a">
    <title>@yield('title', 'ZUMS Student Management System')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-color: #f1f5f9;
            --card-border: #e2e8f0;
            --text-dark: #0f172a;
            --text-muted: #526174;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 0.75rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: clamp(1rem, 4.3vw, 1.25rem);
            letter-spacing: -0.02em;
            color: #ffffff !important;
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
            margin-right: 1rem;
        }

        .navbar-brand .brand-name {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .brand-badge {
            flex-shrink: 0;
            background: #2563eb;
            color: #ffffff;
            font-size: 0.75rem;
            padding: 0.2rem 0.6rem;
            border-radius: 6px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .nav-link {
            font-weight: 500;
            color: #cbd5e1 !important;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            white-space: nowrap;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.1);
        }

        .main-wrapper {
            flex: 1;
            padding: 2rem 0 3rem;
        }

        .card-custom {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            transition: box-shadow 0.2s ease;
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .stat-card.primary {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }

        .stat-card.success {
            background: linear-gradient(135deg, #047857 0%, #064e3b 100%);
        }

        .stat-card.indigo {
            background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
        }

        .stat-card .stat-icon {
            font-size: 2.5rem;
            opacity: 0.25;
            position: absolute;
            right: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
        }

        .stat-card .stat-title {
            font-size: 0.82rem;
            line-height: 1.3;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            opacity: 0.95;
            font-weight: 600;
            max-width: 75%;
        }

        .stat-card .stat-number {
            font-size: 2rem;
            line-height: 1.1;
            font-weight: 700;
            margin-top: 0.4rem;
        }

        .min-w-0 {
            min-width: 0;
        }

        .student-search {
            width: 100%;
            max-width: 390px;
        }

        .student-search .form-control {
            min-width: 0;
        }

        .table-custom {
            width: 100%;
            margin-bottom: 0;
        }

        .table-custom thead th {
            background-color: #f8fafc;
            color: #475569;
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.05em;
            padding: 0.85rem 0.95rem;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        .table-custom tbody td {
            padding: 0.85rem 0.95rem;
            vertical-align: middle;
            color: #1e293b;
            font-size: 0.9rem;
            border-bottom: 1px solid #eef2f7;
        }

        .table-custom tbody tr:last-child td {
            border-bottom: 0;
        }

        .table-custom tbody tr:hover td {
            background-color: #f8fafc;
        }

        .table-custom .table-actions {
            position: sticky;
            right: 0;
            z-index: 2;
            background-color: #ffffff;
            box-shadow: -12px 0 14px -16px rgba(15, 23, 42, 0.55);
        }

        .table-custom thead .table-actions {
            z-index: 3;
            background-color: #f8fafc;
        }

        .table-custom tbody tr:hover .table-actions {
            background-color: #f8fafc;
        }

        .action-buttons {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .action-buttons .btn {
            --bs-btn-padding-y: 0.3rem;
            --bs-btn-padding-x: 0.5rem;
            --bs-btn-font-size: 0.82rem;
            border-radius: 8px;
            line-height: 1.2;
        }

        .student-mobile-card {
            padding: 1rem 1.15rem;
            border-bottom: 1px solid #eef2f7;
        }

        .student-mobile-card:last-child {
            border-bottom: 0;
        }

        .student-mobile-card .student-name {
            font-weight: 700;
            color: var(--text-dark);
        }

        .contact-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            max-width: 100%;
            color: var(--text-muted);
            font-size: 0.85rem;
            text-decoration: none;
        }

        .contact-link:hover {
            color: var(--primary-color);
        }

        .avatar-circle {
            width: 64px;
            height: 64px;
            min-width: 64px;
            min-height: 64px;
            flex-shrink: 0;
            border-radius: 50% !important;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            font-weight: 700;
        }

        .badge-dept {
            display: inline-block;
            background-color: #eff6ff;
            color: #1d4ed8;
            font-weight: 600;
            font-size: 0.8rem;
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            border: 1px solid #dbeafe;
            white-space: nowrap;
        }

        .badge-semester {
            display: inline-block;
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 600;
            font-size: 0.78rem;
            padding: 0.35rem 0.65rem;
            border-radius: 6px;
            white-space: nowrap;
        }

        .badge-id {
            display: inline-block;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-weight: 600;
            color: #0f172a;
            background-color: #f1f5f9;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .btn-custom-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.6rem 1.2rem;
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-custom-primary:hover {
            background-color: #1d4ed8;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .profile-header {
            background: linear-gradient(135deg, #1e293b 0%, #2563eb 100%);
        }

        .footer-custom {
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 1.25rem 0;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .btn:focus-visible,
        .nav-link:focus-visible,
        .page-link:focus-visible {
            outline: 2px solid #2563eb;
            outline-offset: 2px;
        }

        @media (min-width: 992px) {
            .student-search {
                margin-left: auto;
            }
        }

        @media (max-width: 991.98px) {
            .main-wrapper {
                padding: 1.75rem 0 2.5rem;
            }
        }

        @media (max-width: 359.98px) {
            .navbar-brand {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 575.98px) {
            .navbar-custom {
                padding: 0.6rem 0;
            }

            .navbar-brand {
                margin-right: 0;
                gap: 8px;
            }

            .main-wrapper {
                padding: 1.5rem 0 2.25rem;
            }

            .card-header {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .card-body.p-4 {
                padding: 1.25rem !important;
            }

            .page-heading-actions,
            .page-heading-actions .btn {
                width: 100%;
            }

            .stat-card {
                padding: 1rem 1.15rem;
            }

            .stat-card .stat-number {
                font-size: 1.75rem;
            }

            .footer-custom {
                padding: 1rem 0;
            }

            .footer-custom small {
                display: block;
                margin-top: 0.15rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Main Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('students.index') }}">
                <i class="bi bi-mortarboard-fill text-primary"></i>
                <span class="brand-name">ZUMS Student Management</span>
                <span class="brand-badge d-none d-sm-inline">Raw CRUD</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.index') ? 'active' : '' }}" href="{{ route('students.index') }}">
                            <i class="bi bi-people me-1"></i> All Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.create') ? 'active' : '' }}" href="{{ route('students.create') }}">
                            <i class="bi bi-person-plus me-1"></i> Add Student
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Body -->
    <main class="main-wrapper">
        <div class="container">
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill fs-5 me-2"></i>
                    <div>
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4 shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                    <div>
                        <strong>Error!</strong> {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4 shadow-sm" role="alert">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-exclamation-circle-fill fs-5 me-2"></i>
                        <strong class="fs-6">Please fix the following validation errors:</strong>
                    </div>
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-custom mt-auto">
        <div class="container text-center">
            <p class="mb-0">
                <strong>ZUMS Student Management System</strong> &bull; Raw Laravel CRUD Application
            </p>
            <small class="text-secondary">&copy; {{ date('Y') }} All Rights Reserved.</small>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Confirm destructive actions without inline JavaScript (handles quotes in names safely).
        document.addEventListener('submit', function (event) {
            const form = event.target.closest('form[data-confirm]');

            if (form && !window.confirm(form.dataset.confirm)) {
                event.preventDefault();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>

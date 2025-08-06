<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Premier Roadlines Limited</title>
    
    <!-- Google Fonts - Quicksand -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #162f89;
            --secondary-color: #e30f0e;
            --light-bg: #f8f9fa;
            --dark-text: #2c3e50;
            --light-text: #6c757d;
            --white: #ffffff;
            --border-color: #dee2e6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Quicksand", sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #1a3599 100%);
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-header .logo {
            color: var(--white);
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .sidebar-header .logo i {
            font-size: 2rem;
            color: var(--secondary-color);
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin: 0.25rem 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 0;
            position: relative;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: rgba(255,255,255,0.1);
            color: var(--white);
            transform: translateX(5px);
        }

        .sidebar-menu a.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: var(--secondary-color);
        }

        .sidebar-menu i {
            width: 20px;
            margin-right: 1rem;
            text-align: center;
        }

        /* Submenu Styles */
        .sidebar-menu .has-submenu > a::after {
            content: '\f107';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .sidebar-menu .has-submenu.open > a::after {
            transform: rotate(180deg);
        }

        .sidebar-menu .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background-color: rgba(0,0,0,0.2);
        }

        .sidebar-menu .has-submenu.open .submenu {
            max-height: 500px;
        }

        .sidebar-menu .submenu a {
            padding: 0.75rem 1.5rem 0.75rem 3rem;
            font-size: 0.9rem;
            transform: none;
        }

        .sidebar-menu .submenu a:hover {
            background-color: rgba(255,255,255,0.15);
            transform: none;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 80px;
        }

        /* Top Navigation */
        .top-nav {
            background-color: var(--white);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            display: flex;
            justify-content: between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .nav-toggle {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: var(--dark-text);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-toggle:hover {
            background-color: var(--light-bg);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-left: auto;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 600;
        }

        /* Content Area */
        .content-area {
            padding: 2rem;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .card-header {
            background-color: var(--white);
            border-bottom: 1px solid var(--border-color);
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0f1f5a;
            border-color: #0f1f5a;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #b50d0b;
            border-color: #b50d0b;
            transform: translateY(-2px);
        }

        /* Stats Cards */
        .stats-card {
            background: linear-gradient(135deg, var(--white) 0%, #f8f9fa 100%);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .stats-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: var(--white);
        }

        .stats-card .icon.primary {
            background: linear-gradient(135deg, var(--primary-color), #1a3599);
        }

        .stats-card .icon.secondary {
            background: linear-gradient(135deg, var(--secondary-color), #ff2d1f);
        }

        .stats-card .number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-text);
            margin-bottom: 0.5rem;
        }

        .stats-card .label {
            color: var(--light-text);
            font-weight: 500;
        }

        /* Form Styles */
        .form-control {
            border-radius: 10px;
            border: 2px solid var(--border-color);
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(22, 47, 137, 0.25);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 100%;
                max-width: 300px;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }

            .main-content.expanded {
                margin-left: 0;
            }

            .content-area {
                padding: 1rem;
            }

            .top-nav {
                padding: 0.75rem 1rem;
            }

            .card {
                margin-bottom: 1rem;
            }

            .stats-card {
                padding: 1.5rem;
            }

            .stats-card .number {
                font-size: 1.5rem;
            }

            .table-responsive {
                font-size: 0.875rem;
            }

            .btn-group-sm .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
        }

        @media (max-width: 576px) {
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }

            .d-flex.align-items-center {
                text-align: center;
                gap: 0.5rem;
            }

            .stats-card .number {
                font-size: 1.25rem;
            }

            .card-header h6 {
                font-size: 0.9rem;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <div style="background-color: #ffffff; padding: 0.75rem; border-radius: 12px; border: 2px solid rgba(255,255,255,0.3); box-shadow: 0 5px 15px rgba(0,0,0,0.2); display: inline-block; margin: 0 auto;">
                    <img src="{{ asset('assets/img/logo/logoprlindia.png') }}" alt="Premier Roadlines Limited" style="height: 35px; width: auto; display: block;">
                </div>
            </a>
        </div>
        
        <nav class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="has-submenu">
                    <a href="#" class="">
                        <i class="fas fa-info-circle"></i>
                        <span>Overview Management</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="#"><i class="fas fa-building"></i>About PRL</a></li>
                        <li><a href="#"><i class="fas fa-user-tie"></i>CMD Message</a></li>
                        <li><a href="#"><i class="fas fa-users"></i>Corporate Team</a></li>
                        <li><a href="#"><i class="fas fa-award"></i>Accreditations</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#" class="">
                        <i class="fas fa-truck-moving"></i>
                        <span>Services Management</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="#"><i class="fas fa-project-diagram"></i>Project Transportation</a></li>
                        <li><a href="#"><i class="fas fa-cube"></i>Over Dimensional Cargo</a></li>
                        <li><a href="#"><i class="fas fa-cogs"></i>Integrated Logistics</a></li>
                        <li><a href="#"><i class="fas fa-truck"></i>Fleet Rentals</a></li>
                        <li><a href="#"><i class="fas fa-boxes"></i>Break Bulk</a></li>
                        <li><a href="#"><i class="fas fa-plus-circle"></i>Value Added Services</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#" class="">
                        <i class="fas fa-leaf"></i>
                        <span>ESG Management</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.esg.categories.index') }}"><i class="fas fa-list"></i>ESG Categories</a></li>
                        <li><a href="{{ route('admin.esg.articles.index') }}"><i class="fas fa-file-alt"></i>ESG Articles</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#" class="">
                        <i class="fas fa-network-wired"></i>
                        <span>Network Management</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.contact.locations.index') }}"><i class="fas fa-map-marker-alt"></i>Office Locations</a></li>
                        <li><a href="{{ route('admin.contact.info.index') }}"><i class="fas fa-info-circle"></i>Contact Information</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#" class="">
                        <i class="fas fa-chart-line"></i>
                        <span>Investor Relations</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="#"><i class="fas fa-users-cog"></i>Corporate Governance</a></li>
                        <li><a href="#"><i class="fas fa-chart-bar"></i>Financial Information</a></li>
                        <li><a href="#"><i class="fas fa-file-alt"></i>Reports & Returns</a></li>
                        <li><a href="#"><i class="fas fa-bullhorn"></i>Announcements</a></li>
                        <li><a href="#"><i class="fas fa-handshake"></i>Investor Relations</a></li>
                        <li><a href="#"><i class="fas fa-share-alt"></i>Shareholding Pattern</a></li>
                        <li><a href="#"><i class="fas fa-sitemap"></i>Group Companies</a></li>
                        <li><a href="#"><i class="fas fa-calendar-alt"></i>Shareholders Meeting</a></li>
                        <li><a href="#"><i class="fas fa-file-contract"></i>Initial Public Offer</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#" class="">
                        <i class="fas fa-newspaper"></i>
                        <span>Media Management</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.press.categories.index') }}"><i class="fas fa-list"></i>Press Categories</a></li>
                        <li><a href="{{ route('admin.press.articles.index') }}"><i class="fas fa-newspaper"></i>Press Coverage</a></li>
                        <li><a href="{{ route('admin.gallery.categories.index') }}"><i class="fas fa-folder"></i>Gallery Categories</a></li>
                        <li><a href="{{ route('admin.gallery.photos.index') }}"><i class="fas fa-images"></i>Photos</a></li>
                        <li><a href="{{ route('admin.video.categories.index') }}"><i class="fas fa-folder-open"></i>Video Categories</a></li>
                        <li><a href="{{ route('admin.video.videos.index') }}"><i class="fas fa-video"></i>Videos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="">
                        <i class="fas fa-users"></i>
                        <span>User Management</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="">
                        <i class="fas fa-envelope"></i>
                        <span>Contact Inquiries</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <!-- Top Navigation -->
        <div class="top-nav">
            <button class="nav-toggle" id="nav-toggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="user-menu">
                <div class="dropdown">
                    <button class="btn dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                        <div class="user-avatar">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Sidebar Toggle
        document.getElementById('nav-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            
            if (window.innerWidth <= 768) {
                // Mobile behavior
                sidebar.classList.toggle('show');
            } else {
                // Desktop behavior
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            }
        });

        // Submenu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const submenuItems = document.querySelectorAll('.has-submenu > a');
            
            submenuItems.forEach(function(item) {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parentLi = this.parentElement;
                    const submenu = parentLi.querySelector('.submenu');
                    
                    // Close other open submenus
                    document.querySelectorAll('.has-submenu.open').forEach(function(openItem) {
                        if (openItem !== parentLi) {
                            openItem.classList.remove('open');
                        }
                    });
                    
                    // Toggle current submenu
                    parentLi.classList.toggle('open');
                });
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    const sidebar = document.getElementById('sidebar');
                    const navToggle = document.getElementById('nav-toggle');
                    
                    if (!sidebar.contains(e.target) && !navToggle.contains(e.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.getElementById('main-content');
                
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('show');
                    // Reset desktop classes if needed
                    if (sidebar.classList.contains('collapsed')) {
                        mainContent.classList.add('expanded');
                    } else {
                        mainContent.classList.remove('expanded');
                    }
                } else {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>

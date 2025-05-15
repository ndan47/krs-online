@php
    $login = [
        (object) [
            'title' => 'Log Out',
            'path' => '/',
            'icon' => 'fas fa-sign-out-alt',
        ],
    ];
@endphp

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
    <div class="container-fluid">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link sidebar-toggle" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="dashboard" class="nav-link nav-home-link">
                    <i class="fas fa-home mr-1"></i> Home
                </a>
            </li>
        </ul>

        <!-- Center navbar brand -->
        <div class="navbar-brand mx-auto d-none d-md-block">
            <span class="brand-gradient">KRS Politeknik Negeri Cilacap</span>
        </div>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Logout Button -->
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link logout-btn">
                        <i class="fas fa-sign-out-alt mr-1"></i> Log Out
                    </button>
                </form>
            </li>

            <!-- Screen toggle -->
            {{-- <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li> --}}
        </ul>
    </div>
</nav>
<!-- /.navbar -->

<style>
    /* Elegent Navbar Styling */
    .main-header {
        background: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: none;
        height: 60px;
        padding: 0.25rem 1rem;
        z-index: 1000;
    }

    .main-header .navbar-nav .nav-link {
        color: #495057;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .main-header .navbar-nav .nav-link:hover {
        color: #3f6791;
        background-color: rgba(63, 103, 145, 0.08);
    }

    .main-header .navbar-nav .nav-link:active {
        transform: translateY(1px);
    }

    .sidebar-toggle {
        background-color: rgba(63, 103, 145, 0.1);
        border-radius: 4px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
    }

    .sidebar-toggle:hover {
        background-color: rgba(63, 103, 145, 0.2);
    }

    .brand-gradient {
        background: linear-gradient(45deg, #3f6791, #1e88e5);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .nav-home-link {
        font-weight: 500;
    }

    .nav-home-link:hover {
        color: #3f6791;
    }

    .badge-warning {
        background-color: #ff9800;
    }

    /* Logout Button Styling */
    .logout-btn {
        background: linear-gradient(45deg, #f44336, #e53935);
        color: white !important;
        border: none;
        padding: 0.4rem 1.2rem !important;
        border-radius: 4px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-right: 8px;
    }

    .logout-btn:hover {
        background: linear-gradient(45deg, #e53935, #c62828);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        transform: translateY(-1px);
    }

    .logout-btn:active {
        transform: translateY(1px);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-radius: 6px;
    }

    .dropdown-item {
        padding: 0.5rem 1.5rem;
        font-weight: 500;
    }

    .dropdown-item:hover {
        background-color: rgba(63, 103, 145, 0.08);
    }

    .dropdown-header {
        font-weight: 600;
        color: #3f6791;
    }

    .dropdown-footer {
        text-align: center;
        font-weight: 500;
        color: #3f6791;
    }

    /* Animation */
    .animated {
        animation-duration: 0.3s;
    }

    .fadeIn {
        animation-name: fadeIn;
    }

    .faster {
        animation-duration: 0.2s;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Buttons */
    .btn-flat {
        border-radius: 4px;
        box-shadow: none;
        border: none;
        transition: all 0.2s;
    }

    .btn-danger {
        background: linear-gradient(45deg, #f44336, #e53935);
        border: none;
    }

    .btn-danger:hover {
        background: linear-gradient(45deg, #e53935, #c62828);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .btn-default {
        background-color: #f8f9fa;
        color: #495057;
        border: 1px solid #dee2e6;
    }

    .btn-default:hover {
        background-color: #e9ecef;
        color: #212529;
    }
</style>

<script>
    // Optional: Add smooth transitions for dropdowns
    document.addEventListener('DOMContentLoaded', function() {
        // Add subtle hover animation to navbar items
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        navLinks.forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-1px)';
            });

            link.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0px)';
            });
        });
    });
</script>

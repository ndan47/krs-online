@php
    $user = session('user');

    $menus = [
        (object) [
            'title' => 'Dashboard',
            'path' => 'dashboard',
            'icon' => 'fas fa-tachometer-alt',
        ],
        (object) [
            'title' => 'KRS',
            'path' => 'krs',
            'icon' => 'fas fa-file-signature',
        ],
    ];

    if ($user['role'] === 'admin') {
        array_splice($menus, 1, 0, [
            (object) [
                'title' => 'Program Studi',
                'path' => 'prodi',
                'icon' => 'fas fa-university',
            ],
            (object) [
                'title' => 'Mahasiswa',
                'path' => 'mahasiswa',
                'icon' => 'fas fa-user-graduate',
            ],
            (object) [
                'title' => 'Mata Kuliah',
                'path' => 'matkul',
                'icon' => 'fas fa-book-open',
            ],
        ]);
    }
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed h-100">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link d-flex align-items-center py-3">
        <img src="templates/dist/img/Logo_pnc.png" alt="KRS PNC" class="brand-image img-circle elevation-2 mr-2"
            style="width: 38px; height: 38px; object-fit: cover; opacity: 1; transition: transform 0.3s ease;">
        <span class="brand-text font-weight-bold text-white">
            KRS <span class="text-info">PNC</span>
        </span>
    </a>

    <!-- Sidebar -->
    <div
        class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="templates/dist/img/icon1.JPG" class="img-circle elevation-2" alt="User Image"
                    style="width: 42px; height: 42px; border-radius: 50%; object-fit: cover; border: 2px solid #3f6791;">
            </div>
            <div class="info ml-2">
                <span class="d-block text-white font-weight-bold">{{ $user['name'] }}</span>
                <span class="d-block text-info" style="font-size: 12px;">
                    <i class="fas fa-circle text-success" style="font-size: 8px;"></i>
                    {{ $user['role'] === 'admin' ? 'Administrator' : 'Mahasiswa' }}
                </span>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline mb-3">
            <div class="input-group input-group-sm" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar rounded-pill pl-4" type="search"
                    placeholder="Cari menu..." aria-label="Search"
                    style="border: 1px solid #4f5962; box-shadow: 0 1px 3px rgba(0,0,0,.1);">
                <div class="input-group-append">
                    <button class="btn btn-sidebar text-info">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                @foreach ($menus as $menu)
                    <li class="nav-item mb-1">
                        <a href="{{ $menu->path[0] !== '/' ? '/' . $menu->path : $menu->path }}"
                            class="nav-link {{ request()->path() === $menu->path ? 'active' : '' }} rounded-pill pl-3"
                            style="transition: all 0.3s ease;">
                            <i class="nav-icon {{ $menu->icon }} mr-2"></i>
                            <p>
                                {{ $menu->title }}
                                @if ($menu->title === 'KRS')
                                    {{-- <span class="badge badge-info right">New</span> --}}
                                @endif
                            </p>
                        </a>
                    </li>
                @endforeach


            </ul>
        </nav>

        <!-- Sidebar footer -->
        <div class="sidebar-footer mt-auto pt-3 pb-3 text-center"
            style="position: absolute; bottom: 0; width: 100%; font-size: 12px; opacity: 0.7;">
            <p class="mb-0 text-white-50">KRS PNC &copy; {{ date('Y') }}</p>
        </div>
    </div>
</aside>

<style>
    /* Custom styling for the sidebar */
    .main-sidebar {
        background: linear-gradient(180deg, #2b2b3c 0%, #1a1a27 100%);
        border-right: 1px solid rgba(255, 255, 255, 0.05);
    }

    .brand-link {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .brand-link:hover .brand-image {
        transform: rotate(10deg);
    }

    /* Fix for collapsed sidebar */
    .sidebar-mini.sidebar-collapse .main-sidebar .brand-link .brand-image {
        margin-left: 0.8rem;
        margin-right: 0.5rem;
        margin-top: -3px;
    }

    .user-panel {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .nav-link {
        position: relative;
        overflow: hidden;
        margin: 2px 8px;
    }

    .nav-link.active {
        background: linear-gradient(90deg, #3f6791 0%, #1e88e5 100%);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .nav-link:hover:not(.active) {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .nav-link.active::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background-color: #1e88e5;
    }

    .form-control-sidebar {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .form-control-sidebar::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    /* Animations */
    .sidebar .nav-item {
        transition: all 0.3s ease;
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

    .sidebar .nav-item {
        animation: fadeIn 0.5s ease forwards;
        animation-delay: calc(var(--animation-order) * 0.1s);
        opacity: 0;
    }

    .sidebar .nav-item:nth-child(1) {
        --animation-order: 1;
    }

    .sidebar .nav-item:nth-child(2) {
        --animation-order: 2;
    }

    .sidebar .nav-item:nth-child(3) {
        --animation-order: 3;
    }

    .sidebar .nav-item:nth-child(4) {
        --animation-order: 4;
    }

    .sidebar .nav-item:nth-child(5) {
        --animation-order: 5;
    }

    .sidebar .nav-item:nth-child(6) {
        --animation-order: 6;
    }

    /* Additional style for collapsed sidebar */
    .sidebar-mini.sidebar-collapse .main-sidebar:hover .nav-link {
        width: calc(250px - 0.5rem * 2);
    }

    .sidebar-mini.sidebar-collapse .main-sidebar:hover .user-panel .image img {
        margin-left: 0;
    }
</style>

<script>
    // Optional: Add hover effects to menu items
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
            link.addEventListener('mouseenter', function() {
                if (!this.classList.contains('active')) {
                    this.style.paddingLeft = '25px';
                }
            });

            link.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active')) {
                    this.style.paddingLeft = '16px';
                }
            });
        });
    });
</script>

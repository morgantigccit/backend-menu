<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav" style="padding-left: 0;">
        <!-- Dashboard -->
        <li class="nav-item animated fadeInDown" style="margin-bottom: 15px;">
            <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                <i class="mdi mdi-view-dashboard menu-icon"></i>
                <span class="menu-title" style="margin-left: 10px;">Dashboard</span>
            </a>
        </li>

        <!-- Categories -->
        <li class="nav-item animated fadeInDown" style="margin-bottom: 15px;">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title" style="margin-left: 10px;">Categories</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.categories.index') }}">View Categories</a></li>
                </ul>
            </div>
        </li>

        <!-- Tables -->
        <li class="nav-item animated fadeInDown" style="margin-bottom: 15px;">
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="menu-icon mdi mdi-table-large"></i>
                <span class="menu-title" style="margin-left: 10px;">Tables</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.table.index') }}">View Tables</a></li>
                </ul>
            </div>
        </li>

        <!-- Orders -->
        <li class="nav-item animated fadeInDown" style="margin-bottom: 15px;">
            <a class="nav-link" data-bs-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders">
                <i class="menu-icon mdi mdi-receipt"></i>
                <span class="menu-title" style="margin-left: 10px;">Orders</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="orders">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.orders.index') }}">View Orders</a></li>
                </ul>
            </div>
        </li>

        <!-- Waiters -->
        <li class="nav-item animated fadeInDown" style="margin-bottom: 15px;">
            <a class="nav-link" data-bs-toggle="collapse" href="#waiters" aria-expanded="false" aria-controls="waiters">
                <i class="menu-icon mdi mdi-account-multiple"></i>
                <span class="menu-title" style="margin-left: 10px;">Waiters</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="waiters">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.waiters.index') }}">View Waiters</a></li>
                </ul>
            </div>
        </li>

        <!-- Menu -->
        <li class="nav-item animated fadeInDown" style="margin-bottom: 15px;">
            <a class="nav-link" data-bs-toggle="collapse" href="#menuItems" aria-expanded="false" aria-controls="menuItems">
                <i class="menu-icon mdi mdi-food"></i>
                <span class="menu-title" style="margin-left: 10px;">Menu</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="menuItems">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.menus.index') }}">View Menu Items</a></li>
                </ul>
            </div>
        </li>

        <!-- Reviews -->
        <li class="nav-item animated fadeInDown" style="margin-bottom: 15px;">
            <a class="nav-link" href="{{ route('admin.reviews.index') }}">
                <i class="mdi mdi-star menu-icon"></i>
                <span class="menu-title" style="margin-left: 10px;">Reviews</span>
            </a>
        </li>

        <!-- Subscribers -->
        <li class="nav-item animated fadeInDown" style="margin-bottom: 15px;">
            <a class="nav-link" data-bs-toggle="collapse" href="#subscribers" aria-expanded="false" aria-controls="subscribers">
                <i class="menu-icon mdi mdi-email-newsletter"></i>
                <span class="menu-title" style="margin-left: 10px;">Subscribers</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="subscribers">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.subscribers.index') }}">View Subscribers</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.subscribers.email') }}">Send Email to Subscribers</a></li>
                </ul>
            </div>
        </li>

        <!-- Themes Management -->
        <li class="nav-item animated fadeInDown" style="margin-bottom: 15px;">
            <a class="nav-link" data-bs-toggle="collapse" href="#themeManagement" aria-expanded="false" aria-controls="themeManagement">
                <i class="menu-icon mdi mdi-palette"></i>
                <span class="menu-title" style="margin-left: 10px;">Themes</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="themeManagement">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.themes.index') }}">View Themes</a></li>
                    {{-- <li class="nav-item"> <a the="nav-link" href="{{ route('admin.themes.create') }}">Create Theme</a></li> --}}
                </ul>
            </div>
        </li>

        <!-- Logout -->
        <li class="nav-item animated fadeInDown" style="margin-bottom: 15px;">
            <a class="nav-link" data-bs-toggle="collapse" href="#logoutMenu" aria-expanded="false" aria-controls="logoutMenu">
                <i class="menu-icon mdi mdi-logout"></i>
                <span class="menu-title" style="margin-left: 10px;">Logout</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="logoutMenu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="padding: 0; display: inline;">
                            @csrf
                            <button type="submit" class="btn nav-link" style="background-color: transparent; border: none;">
                                Confirm Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>

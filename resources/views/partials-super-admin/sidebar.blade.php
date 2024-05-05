<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                <i class="mdi mdi-view-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <!-- Restaurants -->
        <li class="nav-item nav-category">Restaurants</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#restaurantsMenu" aria-expanded="false"
                aria-controls="restaurantsMenu">
                <i class="mdi mdi-food-fork-drink menu-icon"></i>
                <span class="menu-title">Restaurants</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="restaurantsMenu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.restaurants.index') }}">View Restaurants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.restaurants.create') }}">Add Restaurant</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Users -->
        <li class="nav-item nav-category">Users</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.create') }}">
                <i class="mdi mdi-account-plus menu-icon"></i>
                <span class="menu-title">Create User</span>
            </a>
        </li>
    </ul>
</nav>

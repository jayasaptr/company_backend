<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('dashboard-ecommerce-dashboard') }}">Ecommerce Dashboard</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Data Management</li>
            <li class="nav-item dropdown {{ $type_menu === 'user' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="fas fa-user"></i> <span>Users</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('list-user') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('users.index') }}">List User</a>
                    </li>
                    <li class="{{ Request::is('create-user') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('users.create') }}">Create User</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ $type_menu === 'company' ? 'active' : '' }}">
                <a href="{{ route('companies.show', 1) }}"
                    class="nav-link"><i class="fas fa-building"></i> <span>Company</span></a>
            </li>
        </ul>
    </aside>
</div>

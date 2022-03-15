<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link text-center">
        <img src="{{asset($general_setting['site_logo'])}}" alt="AdminLTE Logo" style="max-width: 100%;
    max-height: 47px;">
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link  {{(request()->routeIs('dashboard')) ? 'active' : 'none' }}">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('allUsers')}}" class="nav-link {{(request()->is('admin/developer*')) ? 'active' : '' }}">
                        <i class="fas fa-users nav-icon"></i><span>Developers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('allClients')}}" class="nav-link {{(request()->is('admin/client*')) ? 'active' : '' }}">
                        <i class="far fa-handshake nav-icon"></i><span>Clients</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('allProject')}}" class="nav-link {{(request()->is('admin/project*')) ? 'active' : '' }}">
                        <i class="far fa-handshake nav-icon"></i><span>Projects</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('generalSetting')}}" class="nav-link {{(request()->routeIs('generalSetting')) ? 'active' : '' }}">
                        <i class="fas fa-cogs nav-icon"></i>
                        <p>App Settings</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
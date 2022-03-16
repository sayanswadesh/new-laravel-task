<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dev_dashboard')}}" class="brand-link text-center">
        <img src="{{asset($general_setting['site_logo'])}}" alt="AdminLTE Logo" style="max-width: 100%;
    max-height: 47px;">
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('dev_dashboard')}}" class="nav-link  {{(request()->routeIs('dev_dashboard')) ? 'active' : 'none' }}">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('allDevProject')}}" class="nav-link {{(request()->is('developer/project*')) ? 'active' : '' }}">
                        <i class="far fa-handshake nav-icon"></i><span>Projects</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('allDevTaskTable')}}" class="nav-link {{(request()->routeIs('allDevTaskTable')) ? 'active' : '' }}">
                        <i class="far fa-handshake nav-icon"></i><span>Tasks</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
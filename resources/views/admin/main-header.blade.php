<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>AVATAR</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">Xin chào, {{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url( 'admin/account' ) }}">Đổi Mật Khẩu</a></li>
                        <li><a href="{{ url( 'admin/logout' ) }}">Đăng Xuất</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
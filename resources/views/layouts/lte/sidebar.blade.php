<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::is('/') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('posts*') ? 'active' : '' }}">
                <a href="{{ route('posts.index') }}">
                    <i class="fa fa-list-alt"></i> <span>Post</span>
                </a>
            </li>
            <li class="{{ Request::is('settings') ? 'active' : '' }}">
                <a href="#@{{ route('settings.index') }}">
                    <i class="fa fa-wrench"></i> <span>Pengaturan</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

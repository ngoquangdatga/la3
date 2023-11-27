<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin/home')}}">
        <div class="sidebar-brand-text mx-3"><h4>Shop Thời Trang</h4></div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ (request()->is('admin/home')) ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin/home')}}">
            <i class="fas fa-home"></i>
            <span>Trang Chủ</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        <b>Chức Năng Quản Lý</b>
    </div>
    <li class="nav-item {{ (request()->is('admin/category')) ? 'active' : ''}} {{(request()->is('admin/category/show')) ? 'active' : ''}} ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
           aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="fas fa-list-alt"></i>
            <span>Danh Mục</span>
        </a>
        <div id="collapseBootstrap" class="collapse {{ (request()->is('admin/category')) ? 'show' : ''}} {{(request()->is('admin/category/show')) ? 'show' : ''}}" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản Lý Danh Mục</h6>
                <a class="collapse-item {{ (request()->is('admin/category')) ? 'active' : ''}}" href="{{route('admin/category')}}">Thêm Danh Mục</a>
                <a class="collapse-item {{(request()->is('admin/category/show')) ? 'active' : ''}}" href="{{route('admin/category/show')}}">Danh Sách Danh Mục</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ (request()->is('admin/product')) ? 'active' : ''}} {{(request()->is('admin/product/show')) ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
           aria-controls="collapseForm">
            <i class="fab fa-product-hunt"></i>
            <span>Sản Phẩm</span>
        </a>
        <div id="collapseForm" class="collapse {{ (request()->is('admin/product')) ? 'show' : ''}} {{(request()->is('admin/product/show')) ? 'show' : ''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản Lý Sản Phẩm</h6>
                <a class="collapse-item {{ (request()->is('admin/product')) ? 'active' : ''}}" href="{{route('admin/product')}}">Thêm Sản Phẩm</a>
                <a class="collapse-item {{(request()->is('admin/product/show')) ? 'active' : ''}}" href="{{route('admin/product/show')}}">Danh Sách Sản Phẩm</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{(request()->is('admin/user')) ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
           aria-controls="collapseTable">
            <i class="fas fa-user"></i>
            <span>Người Dùng</span>
        </a>
        <div id="collapseTable" class="collapse {{ (request()->is('admin/user')) ? 'show' : ''}}"  aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản Lý Người Dùng</h6>
                <a class="collapse-item {{(request()->is('admin/user')) ? 'active' : ''}}" href="{{route('admin/user')}}">Danh Sách Người Dùng</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ (request()->is('admin/blog')) ? 'active' : ''}} {{(request()->is('admin/blog/show')) ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlog" aria-expanded="true"
           aria-controls="collapseTable">
            <i class="fas fa-rss"></i>
            <span>Bài Viết</span>
        </a>
        <div id="collapseBlog" class="collapse {{ (request()->is('admin/blog')) ? 'show' : ''}} {{(request()->is('admin/blog/show')) ? 'show' : ''}}" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản Lý Bài Viết</h6>
                <a class="collapse-item {{ (request()->is('admin/blog')) ? 'active' : ''}}" href="{{route('admin/blog')}}">Thêm Bài Viết</a>
                <a class="collapse-item {{(request()->is('admin/blog/show')) ? 'active' : ''}}" href="{{route('admin/blog/show')}}">Danh Sách Bài Viết</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ (request()->is('admin/banner')) ? 'active' : ''}} {{(request()->is('admin/banner/show')) ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBanner" aria-expanded="true"
           aria-controls="collapseTable">
            <i class="fas fa-fw fa-table"></i>
            <span>Banner</span>
        </a>
        <div id="collapseBanner" class="collapse {{ (request()->is('admin/banner')) ? 'show' : ''}} {{(request()->is('admin/banner/show')) ? 'show' : ''}}" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản Lý Banner</h6>
                <a class="collapse-item {{ (request()->is('admin/banner')) ? 'active' : ''}}" href="{{route('admin/banner')}}">Thêm Banner</a>
                <a class="collapse-item {{(request()->is('admin/banner/show')) ? 'active' : ''}}" href="{{route('admin/banner/show')}}">Danh Sách Banner</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ (request()->is('admin/bill')) ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin/bill')}}">
            <i class="fas fa-money-bill"></i>
            <span>Hóa Đơn</span>
        </a>
    </li>
    <li class="nav-item {{ (request()->is('admin/statistic')) ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin/statistic')}}">
            <i class="fas fa-money-bill"></i>
            <span>Thống Kê</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Khác
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin/logout')}}">
            <i class="fas fa-sign-out-alt"></i>
            <span>Đăng Xuất</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>

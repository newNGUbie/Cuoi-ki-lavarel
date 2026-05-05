<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('admin.getCateList') }}">Admin — Đồ gia dụng</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{ route('admin.user.list') }}"><i class="fa fa-user fa-fw"></i> Quản lý tài khoản</a></li>
                <li class="divider"></li>
                <li><a href="{{ route('admin.getLogout') }}"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a></li>
            </ul>
        </li>
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Tìm trong trang quản trị...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </li>
                <li>
                    <a href="{{ route('admin.getCateList') }}"><i class="fa fa-dashboard fa-fw"></i> Bảng điều khiển</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Loại sản phẩm<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ route('admin.getCateList') }}">Danh sách loại</a></li>
                        <li><a href="{{ route('admin.getCateAdd') }}">Thêm loại</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-cube fa-fw"></i> Sản phẩm gia dụng<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ route('admin.product.list') }}">Danh sách sản phẩm</a></li>
                        <li><a href="{{ route('admin.product.getAdd') }}">Thêm sản phẩm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Tài khoản<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ route('admin.user.list') }}">Danh sách tài khoản</a></li>
                        <li><a href="{{ route('admin.user.getAdd') }}">Thêm tài khoản</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.order.list') }}"><i class="fa fa-shopping-cart fa-fw"></i> Đơn hàng</a>
                </li>
                <li>
                    <a href="{{ route('admin.contact.index') }}"><i class="fa fa-envelope fa-fw"></i> Liên hệ</a>
                </li>
                <li>
                    <a href="{{ route('admin.slide.getList') }}"><i class="fa fa-picture-o fa-fw"></i> Slide</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>

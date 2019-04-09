<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">

                    <?php
                        if (isset(Auth::user()->image)){
                            $image_url = URL::to('public/admin/uploads/images/admins/'.Auth::user()->image);
                        }else{
                            $image_url = URL::to('public/admin/img/no-image.png');
                        }
                    ?>

                    <span>
                        <img alt="image" class="img-circle" src="{{ $image_url }}" />
                     </span>

                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">Shop Manager<b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('admin.profile') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Profile</a></li>
                        <li><a href="{{ route('admin.changePassword') }}"><i class="fa fa-shield" aria-hidden="true"></i> Change Password</a></li>
                        <li><a href="{{ route('admin.changeProfilePicture') }}"><i class="fa fa-file-image-o" aria-hidden="true"></i> Change profile picture</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()";>
                                <i class="fa fa-sign-out"></i> Log out
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>

            <li class="@if (currentController() == 'DashBoardsController') {{ "active" }} @endif">
                <a href="{{ url('admin/dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li class="@if (currentController() == 'BrandsController') {{ "active" }} @endif">
                <a href="{{ route('admin.brands.index') }}"><i class="fa fa-pie-chart"></i> <span class="nav-label">Brands</span> </a>
            </li>

            <li class="@if (currentController() == 'CategoriesController') {{ "active" }} @endif">
                <a href="{{ route('admin.categories.index') }}" ><i class="fa fa-pie-chart"></i> <span class="nav-label">Categories</span> </a>
            </li>

            <li class="@if (currentController() == 'SlidersController') {{ "active" }} @endif">
                <a href="{{ route('admin.sliders.index') }}"><i class="fa fa-pie-chart"></i> <span class="nav-label">Sliders</span> </a>
            </li>

            <li class="@if (currentController() == 'ProductsController') {{ "active" }} @endif">
                <a href="{{ route('admin.products.index') }}"><i class="fa fa-pie-chart"></i> <span class="nav-label">Product</span> </a>
            </li>

            <li class="@if (currentController() == 'OrdersController') {{ "active" }} @endif">
                <a href="{{ route('admin.orders.index') }}"><i class="fa fa-pie-chart"></i> <span class="nav-label">Orders</span> </a>
            </li>
        </ul>

    </div>
</nav>
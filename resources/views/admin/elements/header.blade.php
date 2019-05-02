
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">

            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>  <span class="label label-primary">{{ count(showUnseenOrder()) }}</span>
                </a>
                <ul class="dropdown-menu dropdown-alerts">

                    <li>You have {{ count(showUnseenOrder()) }} new orders.</li>

                    @foreach(showUnseenOrder() as $k => $order)

                        @if($k != 0)
                            <li class="divider"></li>
                        @endif

                        <li>
                            <a href="{{ route('admin.orders.show', $order->id) }}">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> {{ ucfirst($order->user->name) }}
                                    <span class="pull-right text-muted small">{{ $order->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                        </li>

                    @endforeach

                </ul>
            </li>

            <li>
                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()";>
                    <i class="fa fa-sign-out"></i> Log out
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>

        </ul>

    </nav>
</div>



{{--
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">

            <li>
                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()";>
                    <i class="fa fa-sign-out"></i> Log out
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>

        </ul>

    </nav>
</div>--}}

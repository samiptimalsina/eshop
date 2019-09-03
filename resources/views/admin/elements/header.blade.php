
<div id="root">
    <div class="row border-bottom">
        <nav class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">@{{ unseen_orders.length }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">

                        <li>You have @{{ unseen_orders.length }} new orders.</li>

                        <li class="divider"></li>

                        <li v-for="unseen_order in unseen_orders">
                            <a :href="'{{ route('admin.orders.show', '') }}/'+unseen_order.id">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> @{{ unseen_order.user.name | capitalize }}
                                    <span class="pull-right text-muted small">@{{ unseen_order.OrderSubmitAgoTimes }}</span>
                               </div>
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>

            </ul>

        </nav>
    </div>
</div>

{{--included vueJs and axios--}}
<script src="{{ asset('public/js/app.js') }}"></script>

<script>

    //New order notification
    Echo.channel('order.created')
        .listen('OrderCreated', (e) => {

            AdminHeader.unseen_orders.unshift(e.order);

            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 3000
            };
            toastr.success('New order placed by ' + e.order.user.name);
        });

    Vue.filter('capitalize', function (value) {
        if (!value) return '';
        value = value.toString();
        return value.charAt(0).toUpperCase() + value.slice(1);
    });

    var AdminHeader = new Vue({
        el: "#root",
        data: {
            unseen_orders: [],
        },

        mounted(){
            this.getUnseenOrder();
        },

        methods:{
            getUnseenOrder(){
                currentApp = this;
                axios.get(home_url + '/admin/orders/unseen')
                    .then(response => {
                        currentApp.unseen_orders = response.data;
                    })
            },
        },
    })
</script>


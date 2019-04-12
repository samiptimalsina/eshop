
@include('frontend.elements.header')

@if(currentRoute() == '/' ) {{--currentController() from common helper--}}
    <section id="slider">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">

                            @foreach(sliders() as $slider)
                                <li data-target="#slider-carousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->first?'active':'' }}"></li>
                            @endforeach
                        </ol>

                        <div class="carousel-inner">
                            @foreach(sliders() as $slider)
                                <div class="item {{ $loop->first?'active':'' }}">
                                    <img src="{{ URL::to('public/admin/uploads/images/sliders/'.$slider->image) }}"
                                         class="girl img-responsive" alt=""/>
                                </div>
                            @endforeach
                        </div>

                        {{--<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>--}}
                    </div>

                </div>
            </div>
        </div>
    </section>
@endif

<section>
    <div class="container">
        <div class="row">

            @if(currentController() == 'HomeController')

                <!--search section-->
                <div class="header-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8">

                            </div>
                            <div class="col-sm-4">
                                <div class="search_box pull-right">

                                    <form action="{{ route('products.search') }}" method="get" class="search_box">
                                        <input name="search" type="text" value="{{ !empty(Request::get('search'))?Request::get('search'):'' }}" placeholder="Search product"/>                                        <button type="submit" class="btn btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(currentController() == 'HomeController' OR currentController() == 'ProductsController')
                @include('frontend.elements.sidebar')

                <div class="col-sm-9 padding-right">
                    @yield('content')
                </div>
            @else
                <div class="col-sm-12 padding-right">
                    @yield('content')
                </div>
            @endif

        </div>
    </div>

</section>

@include('frontend.elements.footer')


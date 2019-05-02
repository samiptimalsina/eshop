
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
                            <div class="col-sm-4">

                            </div>
                            <div class="col-sm-8">
                                <div class="signup-form search_box">

                                    <form action="{{ route('products.search') }}" method="get" class="search_box">

                                        <div class="row">
                                            <div class="col-sm-6 search_input">
                                                <input id="search" name="search" class="form-control" type="text" value="{{ !empty(Request::get('search'))?Request::get('search'):'' }}" placeholder="Search product"/>
                                            </div>
                                            <div class="col-sm-4 search_input" >
                                                <select name="category" class="form-control">
                                                    <option value="">--Select--</option>
                                                    @foreach(getAllCategories() as $category)
                                                        <option {{ !empty(Request::get('category') AND Request::get('category') == $category->id)?'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>

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
<script>

    // your custome placeholder goes here!
    var ph = "Search by phone (ex. Xioami note 7 pro, Samsung A50)",
        searchBar = $('#search'),
        // placeholder loop counter
        phCount = 0;

    // function to return random number between
    // with min/max range
    function randDelay(min, max) {
        return Math.floor(Math.random() * (max-min+1)+min);
    }

    // function to print placeholder text in a
    // 'typing' effect
    function printLetter(string, el) {
        // split string into character seperated array
        var arr = string.split(''),
            input = el,
            // store full placeholder
            origString = string,
            // get current placeholder value
            curPlace = $(input).attr("placeholder"),
            // append next letter to current placeholder
            placeholder = curPlace + arr[phCount];

        setTimeout(function(){
            // print placeholder text
            $(input).attr("placeholder", placeholder);
            // increase loop count
            phCount++;
            // run loop until placeholder is fully printed
            if (phCount < arr.length) {
                printLetter(origString, input);
            }
            // use random speed to simulate
            // 'human' typing
        }, randDelay(70, 100));
    }

    // function to init animation
    function placeholder() {
        $(searchBar).attr("placeholder", "");
        printLetter(ph, searchBar);
    }

    placeholder();

</script>
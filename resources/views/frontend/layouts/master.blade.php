
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

                                    <form id="product-search-form" action="{{ route('products.search') }}" method="get" class="search_box">

                                        <div class="row">
                                            <div class="col-sm-6 search_input">
                                                <div class="autocomplete">
                                                    <input onkeyup="getAutocompleteProducts()" autocomplete="off" id="search-input" name="search" class="form-control" type="text" value="{{ !empty(Request::get('search'))?Request::get('search'):'' }}" placeholder="Search product"/>

                                                    <div class="autocomplete-items">
                                                        <div id="autocomplete-products">
                                                            {{--<a href="http://localhost/eshopper/products/head-phone">
                                                                <div class="border-bottom">
                                                                    <img width="40" height="40" src="http://localhost/eshopper/public/admin/uploads/images/products/gwufpcjt_d277bb943182d8dc576c84aaf3d0492a.jpeg">
                                                                    <span class="pl-4 pr-4">Head Phone</span>
                                                                    <span style="color: #FE980F">Price 300 Tk</span>
                                                                </div>
                                                            </a>--}}
                                                        </div>
                                                        <p id="view-more-products" onclick="$('#product-search-form').submit()" type="submit" class="text-center cursor_pointer hidden" style="padding-top: 14px">View More (<span id="view-more-product-count"></span>)</p>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-sm-4 search_input" >
                                                <select onchange="getAutocompleteProducts()" id="search-category" name="category" class="form-control">
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

    function getAutocompleteProducts(){

        var search_by = $('#search-input').val(),
            category = $('#search-category').children(":selected").attr("value");

        if(search_by === ''){
            $('#autocomplete-products').html(null);
            $('#view-more-products').addClass('hidden');
            return;
        }

        $.get('{{ route('products.autocomplete') }}', {search_by:search_by, category:category}, function (data) {

            if (data.length === 0){
                $('#autocomplete-products').html('<div class="text-center">No product found</div>');
                $('#view-more-products').addClass('hidden');
                return;
            }

            var products = '';
            $.each(data, function(key, value) {

                if(key < 4){
                    products += '<div class="border-bottom">'+
                        '<a href="{{ route('products.show', '') }}/'+value.slug+'">'+
                            '<div>'+
                                '<img width="40" height="40" src="{{ asset('public/admin/uploads/images/products/') }}/'+value.image+'">'+
                                '<span class="pl-4 pr-4">'+value.name+'</span><span style="color: #FE980F">Price '+value.price+' Tk</span>'+
                            '</div>'+
                        '</a>'+
                    '</div>'
                }
            });

            $('#autocomplete-products').html(products);

            if (data.length > 4){
                $('#view-more-products').removeClass('hidden');
                $('#view-more-product-count').html(data.length-4);
            }else{
                $('#view-more-products').addClass('hidden');
            }
        });
    }

</script>

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
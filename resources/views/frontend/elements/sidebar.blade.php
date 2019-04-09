
<?php

    $price_range = productMinAndMaxPrice();

    $min_price = round($price_range["min_price"]);
    $max_price = round($price_range["max_price"]);

    $min_price_search =(!empty(Request::get('min_price')))?Request::get('min_price'):$min_price;
    $max_price_search =(!empty(Request::get('max_price')))?Request::get('max_price'):$max_price;
?>

<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach(categories() as $category)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="{{ ($category->slug == Request::segment(3))?'active':'' }}" href="{{ route('products.byCategory', $category->slug) }}">
                                <span class="pull-right">( {{ countProduct('category_id', $category->id) }} )</span>{{ $category->name }}
                            </a>
                        </h4>
                    </div>
                </div>
            @endforeach
        </div><!--/category-product-->

        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach(brands() as $brand)
                        <li>
                            <a class="{{ ($brand->slug == Request::segment(3))?'active':'' }}" href="{{route('products.byBrand', $brand->slug) }}"> <span class="pull-right">( {{ countProduct('brand_id', $brand->id) }} )</span>{{ $brand->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div><!--/brands_products-->

        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center price_range_section">
                <form class="form-horizontal" action="{{ url('/') }}" method="get">

                    <div id="slider-range"></div>
                    <input type="text" id="min" name="min_price" value="<?php echo $min_price_search; ?>">
                    <input type="text" id="max" name="max_price" value="<?php echo $max_price_search; ?>">

                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div><!--/price-range-->

        <div class="shipping text-center">
            <img src="{{ URL::to('public/frontend/images/home/shipping.jpg') }}" alt="" />
        </div>

    </div>
</div>

<script type="text/javascript">

    $(function() {

        var min_price = {{$min_price}}
            max_price = {{$max_price}}

        $( "#slider-range" ).slider({
            range: true,
            min: min_price,
            max: max_price,
            values: [ {{ $min_price_search }}, {{ $max_price_search }} ],
            slide: function( event, ui ) {
                $( "#amount" ).html( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                $( "#min" ).val(ui.values[ 0 ]);
                $( "#max" ).val(ui.values[ 1 ]);
            }
        });
        $( "#amount" ).html( "$" + $( "#slider-range" ).slider( "values", 0 ) +
            " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    });
</script>

<?php

    $price_range = productMinAndMaxPrice();

    $min_price = round($price_range["min_price"]);
    $max_price = round($price_range["max_price"]);

    $min_price_search =(!empty(Request::get('min_price')))?Request::get('min_price'):$min_price;
    $max_price_search =(!empty(Request::get('max_price')))?Request::get('max_price'):$max_price;

    //Check active calass for current category
    function checkActiveClass($category){
        return ($category->slug == Request::segment(3))?"active":null;
    }

    function tree($category){

        if(count($category['children']) > 0 ){

            echo "<div class='panel panel-default'> <div class='panel-heading'>
                <h4 class='panel-title'>
                    <span data-toggle='collapse' data-parent='#accordian' href='#".$category['name']."' class='badge pull-right'><i class='fa fa-plus'></i></span>";
                    echo "<a class='".checkActiveClass($category)."' href='". route('products.byCategory', $category->slug) ."'>
                        ".$category['name']."
                    </a>
                </h4>
            </div></div>";

            echo "<div id='".$category['name']."' class='panel-collapse collapse'>
                <div class='panel-body'>
                    <ul>";
                        foreach($category['children'] as $category){
                            nestedTree($category);
                        }
                    echo "</ul>
                </div>
            </div>";

        }else{
            echo "<div class='panel panel-default'>
                <div class='panel-heading'>";
                    echo "<h4 class='panel-title'><a class='".checkActiveClass($category)."' href='". route('products.byCategory', $category->slug) ."'>".$category['name']."</a></h4>
                </div>
            </div>";
        }
    }

    function nestedTree($category){
        if (count($category['children']) > 0){
            echo "<li>
                <span data-toggle='collapse' data-parent='#sportswear' href='#".$category['name']."' class='collapsed badge pull-right'><i class='fa fa-plus'></i></span>";
                echo "<a class='".checkActiveClass($category)."' href='". route('products.byCategory', $category->slug) ."'>
                    ".$category['name']."
                </a>

                <div id='".$category['name']."' class='panel-collapse collapse'>
                    <div class='panel-body'>
                        <ul>";
                            foreach($category['children'] as $nested_category){
                                nestedTree($nested_category);
                            }
                        echo "</ul>
                    </div>
                </div>
            </li>";
        }else{
            echo "<li><a class='".checkActiveClass($category)."' href='". route('products.byCategory', $category->slug) ."'>".$category['name']."</a></li>";
        }
    }

?>

<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>

        @if (count(categories()) > 0)

            <div class="panel-group category-products" id="accordian">
                @foreach (categories() as $category)
                    @php(tree($category))
                @endforeach
            </div>

        @endif

        {{--<div class="panel-group category-products" id="accordian"><!--category-productsr-->

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">TEST</a></h4>
                </div>
            </div>

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h4 class="panel-title">
                        <span data-toggle="collapse" data-parent="#accordian" href="#womens" class="badge pull-right"><i class="fa fa-plus"></i></span>
                        <a href="#0">
                            Mouse
                        </a>
                    </h4>
                </div>

                <div id="womens" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="#">Fsfs</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">

                  <div class="panel-heading">
                      <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordian" href="#sportswear" class="collapsed">
                              <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                              Basin
                          </a>
                      </h4>
                  </div>

                  <div id="sportswear" class="panel-collapse collapse" style="height: 0px;">
                      <div class="panel-body">
                          <ul>
                              <li>
                                  <a data-toggle="collapse" data-parent="#sportswear" href="#nile" class="collapsed">
                                      <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                      Bathtub
                                  </a>

                                  <div id="nile" class="panel-collapse collapse">
                                      <div class="panel-body">
                                          <ul>
                                              <li><a href="">Fan</a></li>
                                              <li>
                                                  <a data-toggle="collapse" data-parent="#nile" href="#phone" class="collapsed">
                                                      <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                      Phone
                                                  </a>

                                                  <div id="phone" class="panel-collapse collapse">
                                                      <div class="panel-body">
                                                          <ul>
                                                              <li><a href="">Test2</a></li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>

              </div>
        </div>--}}

        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach(brands() as $brand)
                        <li>
                            <a class="{{ ($brand->slug == Request::segment(3))?'active':'' }}" href="{{route('products.byBrand', $brand->slug) }}"> <span class="pull-right">( {{ $brand->products_count }} )</span>{{ $brand->name }}
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
                    <input type="text" id="min" name="min_price" value="<?php echo $min_price_search; ?>" class="price_rang_input" placeholder="min">
                    <input type="text" id="max" name="max_price" value="<?php echo $max_price_search; ?>" class="price_rang_input" placeholder="max">

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
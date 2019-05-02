
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
                    <span id='".$category['slug']."-expand-icon' onclick='toggleCategoryExpandIcon(this)' data-toggle='collapse' data-parent='#accordian' href='#".$category['slug']."' class='badge pull-right'><i id='expand-icon' class='fa fa-plus'></i></span>";
                    echo "<a id='".$category['slug']."-link' class='".checkActiveClass($category)."' href='". route('products.byCategory', $category->slug) ."'>
                        ".$category['slug']."
                    </a>
                </h4>
            </div></div>";

            echo "<div id='".$category['slug']."' class='panel-collapse collapse'>
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
                    echo "<h4 class='panel-title'><a id='".$category['slug'].'-link'."' class='".checkActiveClass($category)."' href='". route('products.byCategory', $category->slug) ."'>".$category['slug']."</a></h4>
                </div>
            </div>";
        }
    }

    function nestedTree($category){
        if (count($category['children']) > 0){
            echo "<li>
                <span id='".$category['slug']."-expand-icon' onclick='toggleCategoryExpandIcon(this)' data-toggle='collapse' data-parent='#sportswear' href='#".$category['slug']."' class='collapsed badge pull-right'><i class='fa fa-plus'></i></span>";
                echo "<a id='".$category['slug'].'-link'."' class='".checkActiveClass($category)."' href='". route('products.byCategory', $category->slug) ."'>
                    ".$category['slug']."
                </a>

                <div id='".$category['slug']."' class='panel-collapse collapse'>
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
            echo "<li><a id='".$category['slug'].'-link'."' class='".checkActiveClass($category)."' href='". route('products.byCategory', $category->slug) ."'>".$category['slug']."</a></li>";
        }
    }

?>
 <div id="sidebar">
     <div class="col-sm-3">
         <div class="left-sidebar">
             <h2>Category</h2>

             @if (count(getParentCategories()) > 0)

                 <div class="panel-group category-products" id="accordian">
                     @foreach (getParentCategories() as $category)
                         @php(tree($category))
                     @endforeach
                 </div>

             @endif

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
 </div>


<script type="text/javascript">

    function toggleCategoryExpandIcon(e){
        toggleExpandIcon($(e).children('i'));
    }

    function toggleExpandIcon(expandIcon){

        if (expandIcon.hasClass('fa-plus')) {
            expandIcon.toggleClass('fa-plus');
            expandIcon.toggleClass('fa-minus');
        }else {
            expandIcon.toggleClass('fa-plus');
            expandIcon.toggleClass('fa-minus');
        }
    }


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

    var sideBar = new Vue({
        el: '#sidebar',
        data:{},

        mounted(){
            if ('<?= Request::segment(3) ?>'){
                this.selectCurrentCategory();
            }
        },

        methods: {

            selectCurrentCategory(){
                this.expandParentCategory('<?= Request::segment(3) ?>');
            },

            expandParentCategory($category){

                axios.get(home_url + '/products/category/'+$category+'/get-parent-category') //parameter = category
                    .then(response => {
                        parent_categories = response.data;

                        console.log(response.data)

                        $.each(parent_categories, function( index, parent_category ) {

                            toggleExpandIcon($('#'+parent_category+'-expand-icon').children('i'));

                            $('#'+parent_category).removeClass('collapse');
                            $('#'+parent_category).addClass('in');
                        });

                    });
            },
        }
    })

</script>
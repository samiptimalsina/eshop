    <footer id="footer"><!--Footer-->
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address"/>
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i>
                                </button>
                                <p>Get the most recent updates from <br/>our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>

    </footer><!--/Footer-->

    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script src="{{ asset('public/frontend/js/zoomple.js') }}"></script>

    {{--quick view--}}
    <script src="{{ asset('public/frontend/js/plugins/quickView/velocity.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/quickView/main.js') }}"></script>

    {{--sweetalert--}}
    <script src="{{ asset('public/frontend/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    {{--rate--}}
    <script src="{{ asset('public/frontend/js/plugins/rate/jquery.rateyo.min.js') }}"></script>

    {{--moment--}}
    <script src="{{ asset('public/frontend/js/moment/moment.min.js') }}"></script>

    <!-- Ladda -->
    <script src="{{ asset('public/frontend/js/plugins/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/ladda/ladda.jquery.min.js') }}"></script>

    {{--toastr--}}
    <script src="{{ asset('public/admin/js/plugins/toastr/toastr.min.js') }} "></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">

        //fix header.......
        /*$(document).ready(function(){
            $(window).scroll(function(){
                if($(window).width() >= 991){
                    if($(window).scrollTop() > 90  ) {
                        $("#header-middle").addClass("header-fix");
                    }else{
                        $("#header-middle").removeClass("header-fix");
                    }
                }
            });
        });*/

        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5a367175f4461b0b4ef89378/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();

    </script>
    </body>
</html>
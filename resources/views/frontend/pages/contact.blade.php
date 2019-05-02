                    @extends('frontend.layouts.master')

@section('content')
    <div id="contact-page" class="container">

        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">Contact</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center">Contact <strong>Us</strong></h2>
                    <div id="gmap" class="contact-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7302.575704478669!2d90.39569059999997!3d23.772761900000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1556636699177!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            @include('partials.flash_messages.flashMessages')

            <div class="row">
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Get In Touch</h2>
                        <form action="{{ route('contact') }}" method="post" id="main-contact-form" class="contact-form row" name="contact-form">

                            {{ csrf_field() }}

                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Name*">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="email" class="form-control" required="required" placeholder="Email*">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject*">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here*"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h2 class="title text-center">Contact Info</h2>
                        <address>
                            <p>E-Shopper Inc.</p>
                            <p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
                            <p>Newyork USA</p>
                            <p>Mobile: +2346 17 38 93</p>
                            <p>Fax: 1-714-252-0026</p>
                            <p>Email: info@e-shopper.com</p>
                        </address>
                        <div class="social-networks">
                            <h2 class="title text-center">Social Networking</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/#contact-page-->
@endsection()
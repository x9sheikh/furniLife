<!DOCTYPE html>
<html class="no-js" lang="zxx">


<!-- Mirrored from demo.hasthemes.com/furnilife/furnilife/index-3.html by HTTraQt Website Copier/1.x [Karbofos 2012-2017] جمعه, 04 اکتوبر 2019 05:04:18 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Furnilife</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- CSS
    ============================================ -->
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- FontAwesome CSS -->
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Ionicons CSS -->
    <link href="{{ asset('assets/css/ionicons.min.cs') }}s" rel="stylesheet">

    <!-- Plugins CSS -->
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet">

    <!-- Helper CSS -->
    <link href="{{ asset('assets/css/helper.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- Modernizer JS -->
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>

</head>


<body class="home-three">
@if(session()->get('flash_success_home'))
    <script type="text/javascript">
        alert('Product added Successfully!!!')
    </script>
@elseif(session()->get('remove_product'))
    <script type="text/javascript">
        alert('Product removed Successfully!!!')
    </script>
@elseif(session()->get('flash_danger'))
    <script type="text/javascript">
        alert('You Cannt access the Admin Panel')
    </script>
@endif
<!--=============================================
=            header container         =
=============================================-->

<div class="header-container header-sticky home-three-header pt-50 pt-md-25 pb-md-15 pt-sm-25 pb-sm-15">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-5 order-3 order-lg-1">
                <!-- navigation section -->
                <div class="main-menu">
                    @include('layouts.nav_list')
                </div>
                <!-- end of navigation section -->
            </div>
            <div class="col-12 col-lg-2 col-md-6 col-sm-6 order-1 order-lg-2 text-left text-lg-center">
                <!--=======  logo  =======-->

                <div class="logo">
                    <a href="{{url('/')}}" class="img-fluid">
                        <img src="assets/images/logo2.png" alt="">
                    </a>
                </div>

                <!--=======  End of logo  =======-->
            </div>
            <div class="col-12 col-lg-5 order-2 order-lg-3 col-md-6 col-sm-6">
                <!--=======  header icons  =======-->

                <div class="header-icons d-flex justify-content-end">
                    <!--=======  search icon for tablet  =======-->

                    <div class="search-icon-menutop d-inline-block mr-20">
                        <a href="javascript:void(0)" id="search-overlay-active-button">
                            <i class="icon ion-md-search"></i>
                        </a>
                    </div>

                    <!--=======  End of search icon for tablet  =======-->

                    <!--=======  cart icon  =======-->

                    <div class="minicart-icon mr-20">
                        <a href="javascript:void(0)" id="cart-icon">
                            <span class="image"><i class="icon ion-md-cart"></i></span>
                        </a>

                        <!-- cart floating box -->
                        <div class="cart-floating-box hidden" id="cart-floating-box">
                            @if(Auth::user())
                                <div class="cart-items">
                                    @foreach($mycart_products as $mycart_product)
                                        <div class="cart-float-single-item d-flex">
                                            <span class="remove-item" id="remove-item"><a href="{{url("remove_to_cart_quickly/$mycart_product->id")}}"><i class="icon ion-md-close"></i></a></span>
                                            <div class="cart-float-single-item-image">
                                                <a href="single-product.html"><img src="assets/images/products/{{$mycart_product->profile}}" class="img-fluid" alt=""></a>
                                            </div>
                                            <div class="cart-float-single-item-desc">
                                                <p class="product-title"> <a href="single-product.html">{{$mycart_product->title}} </a></p>
                                                <p class="quantity"> Qty: {{$mycart_product->quantity}}</p>
                                                <p class="price">{{$mycart_product->price}} Rs</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="cart-calculation">
                                    <div class="calculation-details">
                                        <p class="total">Subtotal <span>{{$total_price}}</span></p>
                                    </div>
                                    <div class="floating-cart-btn text-center">
                                        <a class="fl-btn pull-left" href="{{url('/my_cart/show')}}">View Cart</a>
                                        <a class="fl-btn pull-right" href="{{url('/checkout/show')}}">Checkout</a>
                                    </div>
                                </div>
                            @else
                                <p>Your Cart is Empty, yet!</p>
                            @endif
                        </div>
                        <!-- end of cart floating box -->
                    </div>

                    <!--=======  End of cart icon  =======-->

                @guest
                    <!--=======  user icon  =======-->

                        <div class="user-icon">
                            <a href="javascript:void(0)" id="user-icon">
                                <i class="fa fa-user-circle"></i>
                            </a>

                            <div class="language-currency-list hidden" id="accountList">
                                <ul>
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li><a href="{{ route('register') }}">Register</a></li>

                                </ul>
                            </div>
                        </div>

                        <!--=======  End of user icon  =======-->
                @else
                    <!--=======  user icon  =======-->

                        <div class="user-icon">
                            <a href="javascript:void(0)" id="user-icon">
                                <i class="fa fa-user-circle"></i>
                            </a>

                            <div class="language-currency-list hidden" id="accountList">
                                <ul>
                                    @if(\Illuminate\Support\Facades\Auth::user()->usertype == 'admin')
                                        <li><a href="{{url('/admin/home')}}">Admin Pannel</a></li>
                                    @endif
                                    <li><a href="{{url('/dashboard/show')}}">Dashboard</a></li>
                                    <li><a href="{{url('/my_cart/show')}}">Cart</a></li>
                                    <li><a href="{{url('/checkout/show')}}">Checkout</a></li>
                                    <li>
                                        <a  href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!--=======  End of user icon  =======-->
                    @endguest

                </div>

                <!--=======  End of header icons  =======-->


            </div>
            <div class="col-12 order-4 d-block d-lg-none">
                <!-- Mobile Menu -->
                <div class="mobile-menu"></div>
            </div>
        </div>
    </div>
</div>
<!--=====  End of header container  ======-->

<main>

    @yield('my_content')


</main>


<!--=============================================
=            brand logo slider         =
=============================================-->

<div class="brand-logo-slider mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!--=======  brand logo slider container  =======-->

                <div class="brand-logo-slider-container">
                    <!--=======  single brand  =======-->

                    <div class="single-brand">
                        <a href="#">
                            <img src="assets/images/brands/01.png" class="img-fluid" alt="">
                        </a>
                    </div>

                    <!--=======  End of single brand  =======-->

                    <!--=======  single brand  =======-->

                    <div class="single-brand">
                        <a href="#">
                            <img src="assets/images/brands/02.png" class="img-fluid" alt="">
                        </a>
                    </div>

                    <!--=======  End of single brand  =======-->

                    <!--=======  single brand  =======-->

                    <div class="single-brand">
                        <a href="#">
                            <img src="assets/images/brands/03.png" class="img-fluid" alt="">
                        </a>
                    </div>

                    <!--=======  End of single brand  =======-->
                    <!--=======  single brand  =======-->

                    <div class="single-brand">
                        <a href="#">
                            <img src="assets/images/brands/04.png" class="img-fluid" alt="">
                        </a>
                    </div>

                    <!--=======  End of single brand  =======-->
                    <!--=======  single brand  =======-->

                    <div class="single-brand">
                        <a href="#">
                            <img src="assets/images/brands/01.png" class="img-fluid" alt="">
                        </a>
                    </div>

                    <!--=======  End of single brand  =======-->
                    <!--=======  single brand  =======-->

                    <div class="single-brand">
                        <a href="#">
                            <img src="assets/images/brands/03.png" class="img-fluid" alt="">
                        </a>
                    </div>

                    <!--=======  End of single brand  =======-->
                    <!--=======  single brand  =======-->

                    <div class="single-brand">
                        <a href="#">
                            <img src="assets/images/brands/02.png" class="img-fluid" alt="">
                        </a>
                    </div>

                    <!--=======  End of single brand  =======-->
                </div>

                <!--=======  End of brand logo slider container  =======-->
            </div>
        </div>
    </div>
</div>

<!--=====  End of brand logo slider  ======-->

<!--=============================================
=            instagram image slider         =
=============================================-->

<div class="instagram-image-slider-area">
    <!--=======  instagram image container  =======-->

    <div class="instagram-image-slider-container">
        <div class="instagram-feed-thumb">
            <div id="instafeed" class="instagram-carousel" data-userid="8774663968"
                 data-accesstoken="8774663968.1677ed0.78a087bca56440759bdd9ed8f26e2aac">
            </div>
        </div>
    </div>

    <!--=======  End of instagram image container  =======-->
</div>

<!--=====  End of instagram image slider  ======-->


<!--=============================================
=            footer         =
=============================================-->

<div class="footer-container">
    <!--=======  footer navigation  =======-->

    <div class="footer-navigation pt-40 pb-20 pb-lg-40 pt-sm-30 pb-sm-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!--=======  address block  =======-->

                    <div class="address-block">
                        <div class="image">
                            <a href="index.html">
                                <img src="assets/images/logo.png" class="img-fluid" alt="">
                            </a>
                        </div>

                        <div class="address-text">
                            <ul>
                                <li>Address: 123 Main Street, Anytown, CA 12345 - USA.</li>
                                <li>Phone: (012) 800 456 789</li>
                                <li>Fax: (012) 800 456 789</li>
                                <li>Email: support@hastech.company</li>
                            </ul>
                        </div>

                        <div class="social-links">
                            <ul>
                                <li><a href="../../../external.html?link=http://www.twitter.com/" class="twitter"  data-tooltip="Twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="../../../external.html?link=http://www.facebook.com/" class="facebook"  data-tooltip="Facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="../../../external.html?link=http://www.behance.com/" class="behance" data-tooltip="Behance"><i class="fa fa-behance"></i></a></li>
                                <li><a href="../../../external.html?link=http://www.pinterest.com/" class="pinterest" data-tooltip="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="../../../external.html?link=http://www.rss.com/" class="rss" data-tooltip="RSS"><i class="fa fa-rss"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <!--=======  End of address block  =======-->
                </div>
                <div class="col-lg-2 col-md-6">
                    <!--=======  widget block  =======-->

                    <div class="widget-block">
                        <h4 class="footer-widget-title mb-sm-10">INFORMATION</h4>
                        <ul>
                            <li><a href="{{url('/contactus/show')}}">Contact Us</a></li>
                            <li><a href="{{url('/aboutus/show')}}">About Us</a></li>
                            <li><a href="{{url('/shop_list/1')}}">Categories</a></li>
                        </ul>
                    </div>

                    <!--=======  End of widget block  =======-->
                </div>
                <div class="col-lg-2 col-md-6">
                    <!--=======  widget block  =======-->

                    <div class="widget-block">
                        <h4 class="footer-widget-title mt-sm-20 mb-sm-10">MY ACCOUNT</h4>
                        <ul>
                            <li><a href="{{url('/dashboard/show')}}">Dashboard</a></li>
                            <li><a href="{{url('/my_cart/show')}}">Cart</a></li>
                            <li><a href="{{url('/checkout/show')}}">Checkout</a></li>
                        </ul>
                    </div>

                    <!--=======  End of widget block  =======-->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!--=======  widget block  =======-->

                    <div class="widget-block">
                        <h4 class="footer-widget-title mt-sm-20 mb-sm-10">JOIN OUR NEWSLETTER NOW</h4>
                        <p>Get E-mail updates about our latest shop and special offers.</p>

                        <!--=======  newsletter formq  =======-->

                        <div class="newsletter-form mb-20">
                            <form id="mc-form" class="mc-form">
                                <input type="email" placeholder="Enter your email" required>
                                <button type="submit" value="submit">subscribe</button>
                            </form>
                        </div>

                        <!-- mailchimp-alerts Start -->
                        <div class="mailchimp-alerts">
                            <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                            <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                            <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                        </div><!-- mailchimp-alerts end -->

                        <!--=======  End of newsletter formq  =======-->
                    </div>

                    <!--=======  End of widget block  =======-->
                </div>
            </div>
        </div>
    </div>

    <!--=======  End of footer navigation  =======-->

    <!--=======  footer copyright  =======-->

    <div class="footer-copyright pt-20 pb-20">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-left mb-20 mb-md-0">
                    <!--=======  footer copyright text  =======-->

                    <div class="footer-copyright-text">
                        <p>Copyright &copy; 2018 <a href="#">Furnilife</a>, All Rights Reserved.</p>
                    </div>

                    <!--=======  End of footer copyright text  =======-->
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <!--=======  payment logo  =======-->

                    <div class="payment-logo">
                        <img src="assets/images/payment.png" class="img-fluid" alt="">
                    </div>

                    <!--=======  End of payment logo  =======-->
                </div>
            </div>
        </div>
    </div>

    <!--=======  End of footer copyright  =======-->
</div>

<!--=====  End of footer  ======-->

<!--=============================================
=            search overlay         =
=============================================-->

<div class="search-overlay" id="search-overlay">
    <a href="#" class="search-overlay-close" id="search-overlay-close"><i class="fa fa-times"></i></a>
    <div class="search-box">
        <input type="search" id="search" placeholder="Search entire store here">
        <button id="search_button" onclick="click()"><i class="icon ion-md-search"></i></button>
    </div>
</div>
<script type="text/javascript">

    document.getElementById('search_button').onclick = function(){
        $search = document.getElementById('search').innerHTML;
        $latest = jQuery('#search').val();
        window.open('http://127.0.0.1:8000/search/'+$latest+'',"_self");
    }
</script>

<!--=====  End of search overlay  ======-->

<!-- scroll to top  -->
<a href="#" class="scroll-top"></a>
<!-- end of scroll to top -->

<!--=============================================
=            Quick view modal         =
=============================================-->


@foreach($products as $product)
    <div class="modal fade quick-view-modal-container" id="quick-view-modal-container{{$product->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-xs-12 mb-xxs-25 mb-xs-25 mb-sm-25">
                            <!-- single product tabstyle one image gallery -->
                            <div class="product-image-slider fl-product-image-slider fl3-product-image-slider quickview-product-image-slider">
                                <!--product large image start -->
                                <div class="tab-content product-large-image-list fl-product-large-image-list fl3-product-large-image-list quickview-product-large-image-list" id="myTabContent2">
                                    <div class="tab-pane fade show active" id="single-slide-1-q" role="tabpanel" aria-labelledby="single-slide-tab-1-q">
                                        <!--Single Product Image Start-->
                                        <div class="single-product-img img-full">
                                            <img src="assets/images/products/{{$product->profile}}" class="img-fluid" alt="">
                                        </div>
                                        <!--Single Product Image End-->
                                    </div>
                                </div>
                                <!--product large image End-->

                            </div>
                            <!-- end of single product tabstyle one image gallery -->
                        </div>
                        <div class="col-lg-7 col-md-6 col-xs-12">
                            <!-- product quick view description -->
                            <div class="product-feature-details">
                                <h2 class="product-title mb-15">{{$product->title}}</h2>

                                <h2 class="product-price mb-15">
                                    <span class="main-price discounted">{{$product->price + ($product->price*0.25)}}</span>
                                    <span class="discounted-price"> {{$product->price}} Rs</span>
                                    <span class="discount-percentage">Save 25%</span>
                                </h2>

                                <p class="product-description mb-20">This product is really Awesome and comfortable to use. As you many of people nowadays are using this product. This product is very cheap. So, that everyone could afford it. Now, It can be possible to reach and buy for everyone due to its cheaper price as compare to other Brand. Now, Hit the buy button to purchase quickly</p>


                                <div class="cart-buttons mb-20">
                                    <form method="post" action="{{url('/add_to_cart/home')}}  ">
                                        @csrf
                                        <div class="pro-qty mb-20">
                                            <input type="text" value="1" name="quantity" readonly>
                                        </div>
                                        <br>
                                        <!-- EXTRA FIELD FOR DEVELOPERS -->
                                        <input type="hidden" value="{{$product->id}}" name="product_id" >
                                        <!-- END EXTRA FIELD -->
                                        <div class="add-to-cart-btn">
                                            <input type="submit" value="Add to Cart" class="fl-btn btn btn-success">
                                            <i class="fa fa-lg fa-2x fa-shopping-cart"  ></i>
                                        </div>
                                    </form>
                                </div>


                                <div class="social-share-buttons">
                                    <h3>share this product</h3>
                                    <ul>
                                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end of product quick view description -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--=====  End of Quick view modal  ======-->
@endforeach


<!-- JS
============================================ -->
<!-- jQuery JS -->
<script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>

<!-- Popper JS -->
<script src="{{ asset('assets/js/popper.min.js') }}"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Plugins JS -->
<script src="{{ asset('assets/js/plugins.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

</body>


<!-- Mirrored from demo.hasthemes.com/furnilife/furnilife/index-3.html by HTTraQt Website Copier/1.x [Karbofos 2012-2017] جمعه, 04 اکتوبر 2019 05:04:33 GMT -->
</html>

@extends('layouts.nav1')

@section('my_content')

@section('messages')
    @include('layouts.messages')
@endsection
@section('breadcrumb')
    <li class="parent-page">Cart</li>
@endsection
<!--=============================================
    =            Cart page content         =
    =============================================-->


<div class="page-section mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                    <!--=======  cart table  =======-->

                    <div class="cart-table table-responsive mb-40">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="pro-thumbnail">Image</th>
                                <th class="pro-title">Product</th>
                                <th class="pro-price">Price</th>
                                <th class="pro-subtotal">Total</th>
                                <th class="pro-quantity">Edit</th>
                                <th class="pro-remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mycart_products as $mycart_product)
                                <tr>
                                    <td class="pro-thumbnail"><a href="single-product.html"><img src="{{ asset("assets/images/products/$mycart_product->profile") }}" class="img-fluid" alt="Product"></a></td>
                                    <td class="pro-title"><a href="single-product.html">{{$mycart_product->title}}</a></td>
                                    <td class="pro-price"><span>{{$mycart_product->price}}</span></td>
                                    <td class="pro-quantity"><div class=""><span>{{$mycart_product->quantity}}</span></div></td>
                                    <td class="pro-quantity"><a href="#"  data-toggle = "modal" data-target="#quick-view-modal-container{{$mycart_product->id}}" data-tooltip="Quick View"><i class="fa fa-pencil "></i></a></td>
                                    <td class="pro-remove"><a href="{{url("my_cart/show/delete/$mycart_product->id")}}"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- QUICK VIEW START -->
                @foreach($mycart_products as $mycart_pro)
                    <div class="modal fade quick-view-modal-container" id="quick-view-modal-container{{$mycart_pro->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                            <img src="{{ asset("assets/images/products/$mycart_pro->profile") }}" class="img-fluid" alt="">
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
                                                <h2 class="product-title mb-15">{{$mycart_pro->title}}</h2>

                                                <h2 class="product-price mb-15">
                                                    <span class="main-price discounted">{{$mycart_pro->price + ($mycart_pro->price*0.25)}} Rs</span>
                                                    <span class="discounted-price"> {{$mycart_pro->price}} Rs</span>
                                                    <span class="discount-percentage">Save 25%</span>
                                                </h2>

                                                <p class="product-description mb-20">This product is really Awesome and comfortable to use. As you many of people nowadays are using this product. This product is very cheap. So, that everyone could afford it. Now, It can be possible to reach and buy for everyone due to its cheaper price as compare to other Brand. Now, Hit the buy button to purchase quickly</p>


                                                <div class="cart-buttons mb-20">
                                                    <form method="get" action="{{url("/my_cart/show/$mycart_pro->id")}}  ">

                                                        <div class="pro-qty mb-20">
                                                            <input type="text" value="{{$mycart_pro->quantity}}" name="quantity" readonly>
                                                        </div>
                                                        <br>
                                                        <!-- EXTRA FIELD FOR DEVELOPERS -->
                                                        <input type="hidden" value="{{$mycart_pro->id}}" name="product_id" >
                                                        <!-- END EXTRA FIELD -->
                                                        <div class="add-to-cart-btn">
                                                            <input type="submit" value="Save" class="fl-btn btn btn-success">
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
                @endforeach
                    <!-- QUICK VIEW END -->
                    <!--=======  End of cart table  =======-->


                <div class="row">
                    <div class="col-lg-2 col-12 "></div>
                    <div class="col-lg-6 col-12 ">
                        <!--=======  Cart summery  =======-->
                        <div class="cart-summary">
                            <div class="cart-summary-wrap">
                                <h4>Cart Summary</h4>
                                <p>Sub Total <span>{{$total_price}} Rs</span></p>
                                <p>Shipping Cost <span>$00.00</span></p>
                                <h2>Grand Total <span>{{$total_price}}/= Rs</span></h2>
                            </div>
                            <div class=" btn-group">
                                <div style="text-align: right; margin-right: 200px">
                                    <form method="get" action="{{url('/')}}" class="update-btn">
                                        <input type="submit" value="Update Cart" class="btn btn-block btn-dark checkout-btn">
                                    </form>
                                </div>
                                <div style="text-align: left">
                                    <form method="get" action="{{url('/checkout/show')}}" class="update-btn">
                                        <input type="submit" value="Checkout" class="btn btn-success update-btn">
                                    </form>
                                </div>

                            </div>
                        </div>

                        <!--=======  End of Cart summery  =======-->

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<!--=====  End of Cart page content  ======-->




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
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="contact.html">Contact</a></li>
                            <li><a href="blog-left-sidebar.html">Blog</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Seller Login</a></li>
                            <li><a href="#l">Site Map</a></li>
                        </ul>
                    </div>

                    <!--=======  End of widget block  =======-->
                </div>
                <div class="col-lg-2 col-md-6">
                    <!--=======  widget block  =======-->

                    <div class="widget-block">
                        <h4 class="footer-widget-title mt-sm-20 mb-sm-10">MY ACCOUNT</h4>
                        <ul>
                            <li><a href="contact.html">Contact</a></li>
                            <li><a href="#">Order History</a></li>
                            <li><a href="my-account.html">My Account</a></li>
                            <li><a href="wishlist">Wishlist</a></li>
                            <li><a href="cart.html">Cart</a></li>
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
        <input type="search" placeholder="Search entire store here">
        <button><i class="icon ion-md-search"></i></button>
    </div>
</div>

<!--=====  End of search overlay  ======-->

<!-- scroll to top  -->
<a href="#" class="scroll-top"></a>
<!-- end of scroll to top -->
@endsection
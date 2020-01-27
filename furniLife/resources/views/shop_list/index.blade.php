@extends('layouts.nav1')

@section('my_content')

@section('messages')
    @include('layouts.messages')
@endsection
@section('breadcrumb')
    <li class="parent-page">ShopList</li>
@endsection
<!--=============================================
    =            shop page content         =
    =============================================-->

<div class="shop-page-content mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 order-2 order-lg-1">
                <!--=======  page sidebar   =======-->

                <div class="page-sidebar">
                    <!--=======  single sidebar block  =======-->

                    <div class="single-sidebar">
                        <h3 class="sidebar-title">CATEGORIES</h3>

                        <div class="category">
                            <ul>
                                @foreach($categories as $category)
                                    <li><a href="{{url("/shop_list/$category->id")}}">{{$category->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!--=======  End of single sidebar block  =======-->

                    <!--=======  single sidebar block  =======-->

                    <!--<div class="single-sidebar price-range-bg">
                        <h3 class="sidebar-title filter-price-title">FILTER BY PRICE</h3>
                        <div class="sidebar-price">
                            <div id="price-range"></div>
                            <input type="text" id="price-amount" class="price-amount" readonly>
                        </div>
                    </div>-->

                    <!--=======  End of single sidebar block  =======-->


                    <!--=======  single sidebar block  =======-->

                    <!--<div class="single-sidebar">
                        <h3 class="sidebar-title">POPULAR TAGS</h3>

                        =======  tag container  =======-->

                        <!--<ul class="tag-container">
                            <li><a href="shop-left-sidebar.html">new</a> </li>
                            <li><a href="shop-left-sidebar.html">bags</a> </li>
                            <li><a href="shop-left-sidebar.html">new</a> </li>
                            <li><a href="shop-left-sidebar.html">kids</a> </li>
                            <li><a href="shop-left-sidebar.html">fashion</a> </li>
                            <li><a href="shop-left-sidebar.html">Accessories</a> </li>
                        </ul>-->

                        <!--=======  End of tag container  =======
                    </div>-->

                    <!--=======  End of single sidebar block  =======-->
                </div>

                <!--=======  End of page sidebar   =======-->
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <!--=======  slider banner  =======-->

                <div class="slider-banner home-one-banner banner-bg banner-bg-1 mb-30">
                    <div class="banner-text">
                        <p>Look of The Week</p>
                        <p class="big-text">Lamps Light Color</p>
                        <p>Only from $209</p>
                    </div>
                </div>

                <!--=======  End of slider banner  =======-->

                <!--=======  Shop header  =======-->

                <div class="shop-header mb-30">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 d-flex align-items-center">
                            <!--=======  view mode  =======-->

                            <div class="view-mode-icons mb-xs-10">
                                <a href="#" data-target="grid"><i class="icon ion-md-apps"></i></a>
                                <a class="active" href="#" data-target="list"><i class="icon ion-ios-list"></i></a>
                            </div>

                            <!--=======  End of view mode  =======-->

                        </div>

                    </div>
                </div>

                <!--=======  End of Shop header  =======-->

                <!--=======  shop product display area  =======-->
                <div class="shop-product-wrap list row mb-30 no-gutters">
                    @foreach($category_products as $category_product)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <!--=======  grid view product  =======-->

                            <!--=======  single product  =======-->

                            <div class="fl-product shop-grid-view-product">
                                <div class="image">
                                    <a href="{{url("/$category_product->id")}}">
                                        <img src="{{ asset("uploaded_files/$category_product->profile") }}" class="img-fluid" alt="product">
                                        <img src="{{ asset("uploaded_files/$category_product->profile") }}" class="img-fluid" alt="product">
                                    </a>
                                    <!-- wishlist icon -->
                                    <span class="wishlist-icon">
                                            <i class="icon ion-md-heart-empty"></i>
                                    </span>
                                </div>
                                <div class="content">
                                    <h2 class="product-title"> <a href="{{url("/$category_product->id")}}">{{$category_product->title}}</a></h2>

                                    <p class="product-price">
                                        <span class="main-price discounted">{{$category_product->price + ($category_product->price*0.25)}} Rs</span>
                                        <span class="discounted-price">{{$category_product->price}} Rs</span>
                                    </p>

                                    <div class="hover-icons">
                                        <ul>
                                            <li><a href="{{url("/add_to_cart_quickly/$category_product->id")}}"  data-tooltip="Add to Cart"><i class="icon ion-md-cart"></i></a></li>
                                            <li><a href="#"  data-toggle = "modal" data-target="#quick-view-modal-container{{$category_product->id}}" data-tooltip="Quick View"><i class="icon ion-md-open"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--=======  End of single product  =======-->
                            <!--=======  End of grid view product  =======-->
                            <!--=======  list view product  =======-->

                            <div class="fl-product shop-list-view-product">
                                <div class="image">
                                    <a href="{{url("/$category_product->id")}}">
                                        <img src="{{ asset("uploaded_files/$category_product->profile") }}" class="img-fluid" alt="">
                                        <img src="{{ asset("uploaded_files/$category_product->profile") }}" class="img-fluid" alt="">
                                    </a>
                                </div>
                                <div class="content">
                                    <h2 class="product-title"> <a href="{{url("/$category_product->id")}}">{{$category_product->title}}</a></h2>
                                    <p class="product-price">
                                        <span class="main-price discounted">{{$category_product->price + ($category_product->price*0.25)}} Rs</span>
                                        <span class="discounted-price">{{$category_product->price}} Rs</span>
                                    </p>

                                    <p class="product-description">{{$category_product->description}}</p>

                                    <div class="hover-icons">
                                        <ul>
                                            <li><a href="{{url("/add_to_cart_quickly/$category_product->id")}}"  data-tooltip="Add to Cart">Add to cart</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--=======  End of list view product  =======-->
                        </div>
                    @endforeach
                </div>


                <!--=======  End of shop product display area  =======-->

                <!--=======  pagination area  =======-->

                <!--<div class="pagination-area  mb-md-50 mb-sm-50">
                    <ul>
                        <li><a class="active" href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                    </ul>
                </div>-->

                <!--=======  End of pagination area  =======-->
            </div>
        </div>
    </div>
</div>

<!--=====  End of shop page content  ======-->

<!--=============================================
=            footer         =
=============================================-->


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


<!--=============================================
=            Quick view modal         =
=============================================-->

<div class="modal fade quick-view-modal-container" id="quick-view-modal-container" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        <img src="assets/images/single-product-slider/01.jpg" class="img-fluid" alt="">
                                    </div>
                                    <!--Single Product Image End-->
                                </div>
                                <div class="tab-pane fade" id="single-slide-2-q" role="tabpanel" aria-labelledby="single-slide-tab-2-q">
                                    <!--Single Product Image Start-->
                                    <div class="single-product-img img-full">
                                        <img src="assets/images/single-product-slider/02.jpg" class="img-fluid" alt="">
                                    </div>
                                    <!--Single Product Image End-->
                                </div>
                                <div class="tab-pane fade" id="single-slide-3-q" role="tabpanel" aria-labelledby="single-slide-tab-3-q">
                                    <!--Single Product Image Start-->
                                    <div class="single-product-img img-full">
                                        <img src="assets/images/single-product-slider/03.jpg" class="img-fluid" alt="">
                                    </div>
                                    <!--Single Product Image End-->
                                </div>
                                <div class="tab-pane fade" id="single-slide-4-q" role="tabpanel" aria-labelledby="single-slide-tab-4-q">
                                    <!--Single Product Image Start-->
                                    <div class="single-product-img img-full">
                                        <img src="assets/images/single-product-slider/04.jpg" class="img-fluid" alt="">
                                    </div>
                                    <!--Single Product Image End-->
                                </div>
                                <div class="tab-pane fade" id="single-slide-5-q" role="tabpanel" aria-labelledby="single-slide-tab-5-q">
                                    <!--Single Product Image Start-->
                                    <div class="single-product-img img-full">
                                        <img src="assets/images/single-product-slider/05.jpg" class="img-fluid" alt="">
                                    </div>
                                    <!--Single Product Image End-->
                                </div>
                            </div>
                            <!--product large image End-->

                            <!--product small image slider Start-->
                            <div class="product-small-image-list fl-product-small-image-list fl3-product-small-image-list quickview-product-small-image-list">
                                <div class="nav small-image-slider fl3-small-image-slider" role="tablist">
                                    <div class="single-small-image img-full">
                                        <a data-toggle="tab" id="single-slide-tab-1-q" href="#single-slide-1-q"><img src="assets/images/single-product-slider/01.jpg"
                                                                                                                     class="img-fluid" alt=""></a>
                                    </div>
                                    <div class="single-small-image img-full">
                                        <a data-toggle="tab" id="single-slide-tab-2-q" href="#single-slide-2-q"><img src="assets/images/single-product-slider/02.jpg"
                                                                                                                     class="img-fluid" alt=""></a>
                                    </div>
                                    <div class="single-small-image img-full">
                                        <a data-toggle="tab" id="single-slide-tab-3-q" href="#single-slide-3-q"><img src="assets/images/single-product-slider/03.jpg"
                                                                                                                     class="img-fluid" alt=""></a>
                                    </div>
                                    <div class="single-small-image img-full">
                                        <a data-toggle="tab" id="single-slide-tab-4-q" href="#single-slide-4-q"><img src="assets/images/single-product-slider/04.jpg"
                                                                                                                     alt=""></a>
                                    </div>
                                    <div class="single-small-image img-full">
                                        <a data-toggle="tab" id="single-slide-tab-5-q" href="#single-slide-5-q"><img src="assets/images/single-product-slider/05.jpg"
                                                                                                                     alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <!--product small image slider End-->
                        </div>
                        <!-- end of single product tabstyle one image gallery -->
                    </div>
                    <div class="col-lg-7 col-md-6 col-xs-12">
                        <!-- product quick view description -->
                        <div class="product-feature-details">
                            <h2 class="product-title mb-15">Kaoreet lobortis sagittis....</h2>

                            <h2 class="product-price mb-15">
                                <span class="main-price discounted">$12.90</span>
                                <span class="discounted-price"> $10.00</span>
                                <span class="discount-percentage">Save 8%</span>
                            </h2>

                            <p class="product-description mb-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco,Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus</p>


                            <div class="cart-buttons mb-20">
                                <div class="pro-qty mr-10">
                                    <input type="text" value="1">
                                </div>
                                <div class="add-to-cart-btn">
                                    <a href="#" class="fl-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
                                </div>
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


@endsection

@extends('layouts.nav1')

@section('my_content')

@section('messages')
    @include('layouts.messages')
@endsection
@section('breadcrumb')
    <li class="parent-page">Search Result</li>
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
                                <a class="active" href="#" data-target="grid"><i class="icon ion-md-apps"></i></a>
                                <a href="#" data-target="list"><i class="icon ion-ios-list"></i></a>
                            </div>

                            <!--=======  End of view mode  =======-->

                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 d-flex flex-column flex-sm-row justify-content-between align-items-left align-items-sm-center">
                            <!--=======  Sort by dropdown  =======-->


                                <div class="navigation-search d-none d-lg-block">
                                    <input type="search" id="search" placeholder="Search entire store here">
                                    <button id="search_button" onclick="click()"><i class="icon ion-md-search"></i></button>
                                </div>
                            <script type="text/javascript">

                                document.getElementById('search_button').onclick = function(){
                                    $search = document.getElementById('search').innerHTML;
                                    $latest = jQuery('#search').val();
                                    window.open('http://127.0.0.1:8000/search/'+$latest+'',"_self");
                                }
                            </script>


                            <!--=======  End of Sort by dropdown  =======-->

                            <p class="result-show-message">{{count($search_results)}} results</p>
                        </div>
                    </div>
                </div>

                <!--=======  End of Shop header  =======-->

                @if(count($search_results) == 0)
                    <h1 style="color: #363f4d; text-align: center">No Result Found</h1>
                @else
                <!--=======  shop product display area  =======-->
                    <div class="shop-product-wrap grid row mb-30 no-gutters">
                        @foreach($search_results as $search_result)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <!--=======  grid view product  =======-->

                                <!--=======  single product  =======-->

                                <div class="fl-product shop-grid-view-product">
                                    <div class="image">
                                        <a href="{{ url("/$search_result->id") }}">
                                            <img src="{{ asset("assets/images/products/$search_result->profile") }}" class="img-fluid" alt="">
                                            <img src="{{ asset("assets/images/products/$search_result->profile") }}" class="img-fluid" alt="">
                                        </a>

                                    </div>
                                    <div class="content">
                                        <h2 class="product-title"> <a href="{{url("/$search_result->id")}}">{{$search_result->title}}</a></h2>
                                        <p class="product-price">
                                            <span class="main-price discounted">{{$search_result->price+($search_result->price*0.25)}} Rs</span>
                                            <span class="discounted-price">{{$search_result->price}} Rs</span>
                                        </p>

                                        <div class="hover-icons">
                                            <ul>
                                                <li><a href="{{url("/add_to_cart_quickly/$search_result->id")}}"  data-tooltip="Add to Cart"><i class="icon ion-md-cart"></i></a></li>
                                                <li><a href="#"  data-toggle = "modal" data-target="#quick-view-modal-container{{$search_result->id}}" data-tooltip="Quick View"><i class="icon ion-md-open"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!--=======  End of single product  =======-->

                                <!--=======  End of grid view product  =======-->

                                <!--=======  list view product  =======-->

                                <div class="fl-product shop-list-view-product">
                                    <div class="image">
                                        <a href="{{ url("/$search_result->id") }}">
                                            <img src="{{ asset("assets/images/products/$search_result->profile") }}" class="img-fluid" alt="">
                                            <img src="{{ asset("assets/images/products/$search_result->profile") }}" class="img-fluid" alt="">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h2 class="product-title"> <a href="{{ url("/$search_result->id") }}">{{$search_result->title}}</a></h2>

                                        <p class="product-price">
                                            <span class="main-price discounted">{{$search_result->price+($search_result->price*0.25)}} Rs</span>
                                            <span class="discounted-price">{{$search_result->price}} Rs</span>
                                        </p>

                                        <p class="product-description">This product is really Awesome and comfortable to use. As you many of people nowadays are using this product. This product is very cheap. So, that everyone could afford it. Now, It can be possible to reach and buy for everyone due to its cheaper price as compare to other Brand. Now, Hit the buy button to purchase quickly</p>

                                        <div class="hover-icons">
                                            <ul>
                                                <li><a href="{{url("add_to_cart_quickly/$search_result->id")}}"  data-tooltip="Add to Cart">Add to cart</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!--=======  End of list view product  =======-->


                            </div>
                        @endforeach

                    </div>


                    <!--=======  End of shop product display area  =======-->
                @endif


            </div>
        </div>
    </div>
</div>
<!--=============================================
=            Quick view modal         =
=============================================-->

@foreach($search_results as $search_result)
    <div class="modal fade quick-view-modal-container" id="quick-view-modal-container{{$search_result->id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            <img src="{{ asset("assets/images/products/$search_result->profile") }}" class="img-fluid" alt="">
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
                                <h2 class="product-title mb-15">{{$search_result->title}}</h2>

                                <h2 class="product-price mb-15">
                                    <span class="main-price discounted">{{$search_result->price + ($search_result->price*0.25)}}</span>
                                    <span class="discounted-price"> {{$search_result->price}} Rs</span>
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
                                        <input type="hidden" value="{{$search_result->id}}" name="product_id" >
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
@endforeach
<!--=====  End of shop page content  ======-->

@endsection
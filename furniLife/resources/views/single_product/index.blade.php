@extends('layouts.nav1')

@section('my_content')

    @section('messages')
        @include('layouts.messages')
    @endsection
    @section('breadcrumb')
        <li class="parent-page">Product</li>
    @endsection
    <!--=============================================
    =            single product content         =
    =============================================-->

    <div class="single-product-content-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-xs-12 mb-xxs-25 mb-xs-25 mb-sm-25">
                    <!-- single product tabstyle one image gallery -->
                    <div class="product-image-slider fl-product-image-slider fl3-product-image-slider">
                        <!--product large image start -->
                        <div class="tab-content product-large-image-list fl-product-large-image-list fl3-product-large-image-list" id="myTabContent">
                            <div class="tab-pane fade show active" id="single-slide-1" role="tabpanel" aria-labelledby="single-slide-tab-1">
                                <!--Single Product Image Start-->
                                <div class="single-product-img img-full">
                                    <img src="assets/images/products/{{$product->profile}}" class="img-fluid" alt="">
                                    <a href="assets/images/products/{{$product->profile}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a>
                                </div>
                                <!--Single Product Image End-->
                            </div>
                        </div>
                        <!--product large image End-->


                    </div>
                    <!-- end of single product tabstyle one image gallery -->
                </div>
                <div class="col-lg-7 col-md-6 col-xs-12">
                    <!-- product view description -->
                    <div class="product-feature-details">
                        <h2 class="product-title mb-15">{{$product->title}}</h2>



                        <h2 class="product-price mb-0">
                            <span class="main-price discounted">{{$product->price+($product->price*0.25)}} Rs</span>
                            <span class="discounted-price"> {{$product->price}} Rs</span>
                        </h2>

                        <p class="product-description mb-20">This product is really Awesome and comfortable to use. As you many of people nowadays are using this product. This product is very cheap. So, that everyone could afford it. Now, It can be possible to reach and buy for everyone due to its cheaper price as compare to other Brand. Now, Hit the buy button to purchase quickly</p>

                        <div class="cart-buttons mb-20">
                            <span class="quantity-title mr-10">Quantity: </span>
                            <form method="post" action="{{url('/add_to_cart')}}  ">
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


                        <div class="category-list-container mb-20">
                            <span>Categories: </span>
                            <ul>
                                @foreach($categories as $category)
                                    <li><a href="{{url("/shop_list/$category->id")}}">{{$category->title}}</a>,</li>
                                @endforeach
                            </ul>
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

    <!--=====  End of single product content  ======-->

    <!--=======  product description review   =======-->

    <div class="product-description-review-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  product description review container  =======-->

                    <div class="tab-slider-wrapper product-description-review-container">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="description-tab" data-toggle="tab" href="#product-description" role="tab"
                                   aria-selected="true">Description</a>
                                <a class="nav-item nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                                   aria-selected="false">Review</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-description" role="tabpanel" aria-labelledby="description-tab">
                                <!--=======  product description  =======-->

                                <div class="product-description">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>

                                    <p>Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, sed commodo augue nisi non neque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, lorem et placerat vestibulum, metus nisi posuere nisl, in accumsan elit odio quis mi. Cras neque metus, consequat et blandit et, luctus a nunc. Etiam gravida vehicula tellus, in imperdiet ligula euismod eget.</p>
                                </div>

                                <!--=======  End of product description  =======-->
                            </div>
                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                <!--=======  review content  =======-->

                                <div class="product-ratting-wrap">
                                    <div class="pro-avg-ratting">
                                        <h4>{{$average_star}} <span>(Overall)</span></h4>
                                        <span>Based on {{$total_review}} Comments</span>
                                    </div>
                                    <div class="ratting-list">
                                        <div class="sin-list float-left">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <span>({{$star_five}})</span>
                                        </div>
                                        <div class="sin-list float-left">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span>({{$star_four}})</span>
                                        </div>
                                        <div class="sin-list float-left">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span>({{$star_three}})</span>
                                        </div>
                                        <div class="sin-list float-left">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span>({{$star_two}})</span>
                                        </div>
                                        <div class="sin-list float-left">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span>({{$star_one}})</span>
                                        </div>
                                    </div>
                                    <div class="rattings-wrapper">

                                        @foreach($reviews as $review)
                                            <div class="sin-rattings">
                                                <div class="ratting-author">
                                                    <h3>{{$review->name}}</h3>
                                                    @if($review->star == 5)
                                                        <div class="ratting-star">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    @elseif($review->star == 4)
                                                        <div class="ratting-star">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                    @elseif($review->star == 3)
                                                        <div class="ratting-star">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                    @elseif($review->star == 2)
                                                        <div class="ratting-star">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                    @elseif($review->star == 1)
                                                        <div class="ratting-star">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <p>{{ $review->review }}</p>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="ratting-form-wrapper fix">
                                        <h3>Add your Comments</h3>
                                        <form action="{{url("/$product->id/review")}}" method="post">
                                            @csrf
                                            <div class="ratting-form row">
                                                <div class="col-12 mb-15">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text" for="inputGroupSelect01"><h5>Select Rating:</h5></label>
                                                        </div>
                                                        <select class="custom-select" name="star" id="inputGroupSelect01" required>
                                                            <option selected value=""><h5>Choose...</h5></option>
                                                            <option value="1"><h5>One Star</h5></option>
                                                            <option value="2">Two Star</option>
                                                            <option value="3">Three Star</option>
                                                            <option value="4">Four Star</option>
                                                            <option value="5">Five Star</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="col-md-6 col-12 mb-15">
                                                    <label for="name">Name:</label>
                                                    <input id="name" placeholder="Name" type="text" required value="{{$user->name}}" readonly>
                                                </div>
                                                <div class="col-md-6 col-12 mb-15">
                                                    <label for="email">Email:</label>
                                                    <input id="email" placeholder="Email" type="text" required value="{{$user->email}}" readonly>
                                                </div>
                                                <div class="col-12 mb-15">
                                                    <label for="your-review">Your Review:</label>
                                                    <textarea name="review" id="your-review"
                                                              placeholder="Write a review" required></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <input value="add review" type="submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!--=======  End of review content  =======-->
                            </div>
                        </div>
                    </div>

                    <!--=======  End of product description review container  =======-->
                </div>
            </div>
        </div>
    </div>

    <!--=======  End of product description review   =======-->

    <!--=============================================
    =            related product slider         =
    =============================================-->

    <div class="related-product-slider-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  section title  =======-->

                    <div class="section-title">
                        <h2>RELATED PRODUCTS</h2>
                    </div>

                    <!--=======  End of section title  =======-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  tab product slider  =======-->

                    <div class="fl-slider tab-product-slider">
                        <!--=======  single product  =======-->

                        <div class="fl-product">
                            <div class="image sale-product">
                                <a href="single-product.html">
                                    <img src="assets/images/products/product01.jpg" class="img-fluid" alt="">
                                    <img src="assets/images/products/product01-2.jpg" class="img-fluid" alt="">
                                </a>
                                <!-- wishlist icon -->
                                <span class="wishlist-icon">
                                        <a href="#" ><i class="icon ion-md-heart-empty"></i></a>
                                </span>
                            </div>
                            <div class="content">
                                <h2 class="product-title"> <a href="single-product.html">Cillum dolore</a></h2>
                                <div class="rating">
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p class="product-price">
                                    <span class="main-price discounted">$71</span>
                                    <span class="discounted-price">$65</span>
                                </p>

                                <div class="hover-icons">
                                    <ul>
                                        <li><a href="#"  data-tooltip="Add to Cart"><i class="icon ion-md-cart"></i></a></li>
                                        <li><a href="#"  data-tooltip="Compare"><i class="icon ion-md-options"></i></a></li>
                                        <li><a href="#"  data-toggle = "modal" data-target="#quick-view-modal-container" data-tooltip="Quick View"><i class="icon ion-md-open"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--=======  End of single product  =======-->
                        <!--=======  single product  =======-->

                        <div class="fl-product">
                            <div class="image">
                                <a href="single-product.html">
                                    <img src="assets/images/products/product02.jpg" class="img-fluid" alt="">
                                    <img src="assets/images/products/product02-2.jpg" class="img-fluid" alt="">
                                </a>
                                <!-- wishlist icon -->
                                <span class="wishlist-icon">
                                        <a href="#" ><i class="icon ion-md-heart-empty"></i></a>
                                </span>
                            </div>
                            <div class="content">
                                <h2 class="product-title"> <a href="single-product.html">Condimentum posuere</a></h2>
                                <div class="rating">
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p class="product-price">
                                    <span class="main-price discounted">$71</span>
                                    <span class="discounted-price">$65</span>
                                </p>

                                <div class="hover-icons">
                                    <ul>
                                        <li><a href="#"  data-tooltip="Add to Cart"><i class="icon ion-md-cart"></i></a></li>
                                        <li><a href="#"  data-tooltip="Compare"><i class="icon ion-md-options"></i></a></li>
                                        <li><a href="#"  data-toggle = "modal" data-target="#quick-view-modal-container" data-tooltip="Quick View"><i class="icon ion-md-open"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--=======  End of single product  =======-->
                        <!--=======  single product  =======-->

                        <div class="fl-product">
                            <div class="image sale-product">
                                <a href="single-product.html">
                                    <img src="assets/images/products/product03.jpg" class="img-fluid" alt="">
                                    <img src="assets/images/products/product03-2.jpg" class="img-fluid" alt="">
                                </a>
                                <!-- wishlist icon -->
                                <span class="wishlist-icon">
                                        <a href="#" ><i class="icon ion-md-heart-empty"></i></a>
                                </span>
                            </div>
                            <div class="content">
                                <h2 class="product-title"> <a href="single-product.html">Donec eu libero</a></h2>
                                <div class="rating">
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p class="product-price">
                                    <span class="main-price discounted">$71</span>
                                    <span class="discounted-price">$65</span>
                                </p>

                                <div class="hover-icons">
                                    <ul>
                                        <li><a href="#"  data-tooltip="Add to Cart"><i class="icon ion-md-cart"></i></a></li>
                                        <li><a href="#"  data-tooltip="Compare"><i class="icon ion-md-options"></i></a></li>
                                        <li><a href="#"  data-toggle = "modal" data-target="#quick-view-modal-container" data-tooltip="Quick View"><i class="icon ion-md-open"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--=======  End of single product  =======-->
                        <!--=======  single product  =======-->

                        <div class="fl-product">
                            <div class="image">
                                <a href="single-product.html">
                                    <img src="assets/images/products/product04.jpg" class="img-fluid" alt="">
                                    <img src="assets/images/products/product04-2.jpg" class="img-fluid" alt="">
                                </a>
                                <!-- wishlist icon -->
                                <span class="wishlist-icon">
                                        <a href="#" ><i class="icon ion-md-heart-empty"></i></a>
                                </span>
                            </div>
                            <div class="content">
                                <h2 class="product-title"> <a href="single-product.html">Officiis debitis</a></h2>
                                <div class="rating">
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p class="product-price">
                                    <span class="main-price discounted">$71</span>
                                    <span class="discounted-price">$65</span>
                                </p>

                                <div class="hover-icons">
                                    <ul>
                                        <li><a href="#"  data-tooltip="Add to Cart"><i class="icon ion-md-cart"></i></a></li>
                                        <li><a href="#"  data-tooltip="Compare"><i class="icon ion-md-options"></i></a></li>
                                        <li><a href="#"  data-toggle = "modal" data-target="#quick-view-modal-container" data-tooltip="Quick View"><i class="icon ion-md-open"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--=======  End of single product  =======-->
                        <!--=======  single product  =======-->

                        <div class="fl-product">
                            <div class="image">
                                <a href="single-product.html">
                                    <img src="assets/images/products/product05.jpg" class="img-fluid" alt="">
                                    <img src="assets/images/products/product05-2.jpg" class="img-fluid" alt="">
                                </a>
                                <!-- wishlist icon -->
                                <span class="wishlist-icon">
                                        <a href="#" ><i class="icon ion-md-heart-empty"></i></a>
                                </span>
                            </div>
                            <div class="content">
                                <h2 class="product-title"> <a href="single-product.html">Cras neque</a></h2>
                                <div class="rating">
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p class="product-price">
                                    <span class="main-price discounted">$71</span>
                                    <span class="discounted-price">$65</span>
                                </p>

                                <div class="hover-icons">
                                    <ul>
                                        <li><a href="#"  data-tooltip="Add to Cart"><i class="icon ion-md-cart"></i></a></li>
                                        <li><a href="#"  data-tooltip="Compare"><i class="icon ion-md-options"></i></a></li>
                                        <li><a href="#"  data-toggle = "modal" data-target="#quick-view-modal-container" data-tooltip="Quick View"><i class="icon ion-md-open"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--=======  End of single product  =======-->
                        <!--=======  single product  =======-->

                        <div class="fl-product">
                            <div class="image">
                                <a href="single-product.html">
                                    <img src="assets/images/products/product06.jpg" class="img-fluid" alt="">
                                    <img src="assets/images/products/product06-2.jpg" class="img-fluid" alt="">
                                </a>
                                <!-- wishlist icon -->
                                <span class="wishlist-icon">
                                        <a href="#" ><i class="icon ion-md-heart-empty"></i></a>
                                </span>
                            </div>
                            <div class="content">
                                <h2 class="product-title"> <a href="single-product.html">Dolorum fuga</a></h2>
                                <div class="rating">
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p class="product-price">
                                    <span class="main-price discounted">$71</span>
                                    <span class="discounted-price">$65</span>
                                </p>

                                <div class="hover-icons">
                                    <ul>
                                        <li><a href="#"  data-tooltip="Add to Cart"><i class="icon ion-md-cart"></i></a></li>
                                        <li><a href="#"  data-tooltip="Compare"><i class="icon ion-md-options"></i></a></li>
                                        <li><a href="#"  data-toggle = "modal" data-target="#quick-view-modal-container" data-tooltip="Quick View"><i class="icon ion-md-open"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--=======  End of single product  =======-->
                    </div>

                    <!--=======  End of tab product slider  =======-->
                </div>
            </div>
        </div>
    </div>

    <!--=====  End of related product slider  ======-->
@endsection

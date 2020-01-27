@extends('layouts.nav1')

@section('my_content')

@section('messages')
    @include('layouts.messages')
@endsection
@section('breadcrumb')
    <li class="parent-page">Checkout</li>
@endsection

<!--=============================================
	=            Checkout page content         =
	=============================================-->

<div class="page-section mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Checkout Form s-->
                <form action="{{ url('/checkout/continue/show') }}" class="checkout-form" method="post">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="row row-40">

                        <div class="col-lg-7 mb-20">

                            <!-- Billing Address -->
                            <div id="billing-form" class="mb-40">
                                <h4 class="checkout-title">Billing Address</h4>

                                <div class="row">

                                    <div class=" col-12 mb-20">
                                        <label>Full Name*</label>
                                        <input type="text" placeholder="e.g Bilal Ikram" value="{{$user->name}}" required="required">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Email Address*</label>
                                        <input type="email" placeholder="e.g abc@example.com" value="{{$user->email}}" required="required">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Phone no*</label>
                                        <input type="text" placeholder="e.g 03031234567" value="{{$user->phoneNo}}" name="phoneNo" required="required">
                                    </div>

                                    <div class="col-12 mb-20">
                                        <label>Address*</label>
                                        <input type="text" placeholder="Address line 1" value="{{$user->address_1}}" name="address_1" required="required">
                                        <input type="text" placeholder="Address line 2" value="{{$user->address_1}}" name="address_2" required="required">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>City*</label>
                                        <input type="text" value="{{$user->city}}" placeholder="e.g Lahore" name="city" required="required">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>ZipCode*</label>
                                        <input type="text" value="{{$user->zip_code}}" placeholder="e.g 39350" name="zip_code" required="required">
                                    </div>

                                    <div class=" col-12 mb-20">
                                        <input type="submit" value="Continue (Cash On Delivery)" name="cash_on_delivery" class="btn btn-dark">
                                    </div>
                </form>



                                </div>
            <form method="post" action="{{route('payment.deduction')}}">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <input name="total_price" value="{{$total_price}}" type="hidden">
                <p style="text-align: center;"><script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button" style="text-align: center"
                        data-key="pk_test_p3BKVmESSVBUh1gTdkzpRvmD00QRRbgWJa"
                        data-amount="{{$total_price*100}}"
                        data-name= "{{\Illuminate\Support\Facades\Auth::user()->name}}"
                        data-description="FurniLife"
                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                        data-locale="auto"
                        data-currency="pkr"
                    ></script></p>




            </form>
                            </div>

                        </div>




                <div class="col-lg-5">
                    <div class="row">

                        <!-- Cart Total -->
                        <div class="col-12 mb-60">

                            <h4 class="checkout-title">Cart Total</h4>

                            <div class="checkout-cart-total">

                                <h4>Product <span>Total</span></h4>

                                <ul>
                                    @foreach($mycart_products as $mycart_product)
                                        <li>{{$mycart_product->title}} X {{$mycart_product->quantity}} <span>{{$mycart_product->price * $mycart_product->quantity}} Rs</span></li>
                                    @endforeach
                                </ul>

                                <p>Sub Total <span>{{$total_price}} Rs</span></p>
                                <p>Shipping Fee <span>$00.00</span></p>

                                <h4>Grand Total <span>{{$total_price}}/= Rs</span></h4>

                            </div>

                        </div>



                    </div>
                </div>
                    </div>


            </div>
        </div>
</div>

<!--=====  End of Checkout page content  ======-->

@endsection

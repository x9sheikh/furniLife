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
                    @csrf
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

                                    <div class=" col-12 mb-20">
                                        <input type="submit" value="Continue (Credit/Debit)" name="credit_debit" class="btn btn-dark">
                                    </div>


                                </div>

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


                                <!-- Payment Method -->
                                <!--<div class="col-12">

                                    <h4 class="checkout-title">Payment Method</h4>

                                    <div class="checkout-payment-method">

                                        <div class="single-method">
                                            <input type="radio" id="payment_check" name="payment-method" value="check">
                                            <label for="payment_check">Check Payment</label>
                                            <p data-method="check">Please send a Check to Store name with Store Street, Store Town, Store State, Store Postcode, Store Country.</p>
                                        </div>

                                        <div class="single-method">
                                            <input type="radio" id="payment_bank" name="payment-method" value="bank">
                                            <label for="payment_bank">Direct Bank Transfer</label>
                                            <p data-method="bank">Please send a Check to Store name with Store Street, Store Town, Store State, Store Postcode, Store Country.</p>
                                        </div>

                                        <div class="single-method">
                                            <input type="radio" id="payment_cash" name="payment-method" value="cash">
                                            <label for="payment_cash">Cash on Delivery</label>
                                            <p data-method="cash">Please send a Check to Store name with Store Street, Store Town, Store State, Store Postcode, Store Country.</p>
                                        </div>

                                        <div class="single-method">
                                            <input type="radio" id="payment_paypal" name="payment-method" value="paypal">
                                            <label for="payment_paypal">Paypal</label>
                                            <p data-method="paypal">Please send a Check to Store name with Store Street, Store Town, Store State, Store Postcode, Store Country.</p>
                                        </div>

                                        <div class="single-method">
                                            <input type="radio" id="payment_payoneer" name="payment-method" value="payoneer">
                                            <label for="payment_payoneer">Payoneer</label>
                                            <p data-method="payoneer">Please send a Check to Store name with Store Street, Store Town, Store State, Store Postcode, Store Country.</p>
                                        </div>

                                        <div class="single-method">
                                            <input type="checkbox" id="accept_terms">
                                            <label for="accept_terms">I’ve read and accept the terms & conditions</label>
                                        </div>

                                    </div>

                                    <button class="place-order">Place order</button>

                                </div>-->

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!--=====  End of Checkout page content  ======-->

@endsection

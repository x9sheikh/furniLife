<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title data-tid="elements_examples.meta.title">Stripe Elements: Build beautiful, smart checkout flows</title>
    <meta data-tid="elements_examples.meta.description" name="description" content="Build beautiful, smart checkout flows.">

    <link rel="shortcut icon" href="{{ asset('card/img/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('card/img/apple-touch-icon/180x180.png') }}">
    <link rel="icon" href="{{ asset('card/img/apple-touch-icon/180x180.png') }}">

    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('card/js/index.js') }}" data-rel-js></script>

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('card/css/base.css') }}" data-rel-css="" />

    <!-- CSS for each example: -->
    <link rel="stylesheet" type="text/css" href="{{ asset('card/css/example1.css') }}" data-rel-css="" />
    <link rel="stylesheet" type="text/css" href="{{ asset('card/css/example2.css') }}" data-rel-css="" />
    <link rel="stylesheet" type="text/css" href="{{ asset('card/css/example3.css') }}" data-rel-css="" />
    <link rel="stylesheet" type="text/css" href="{{ asset('card/css/example4.css') }}" data-rel-css="" />
    <link rel="stylesheet" type="text/css" href="{{ asset('card/css/example5.css') }}" data-rel-css="" />
</head>
<body>
<div class="globalContent">
    <main>

        <section class="container-lg">
            <div class="cell example example5" id="example-5">
                <form method="post" action="{{route('payment.deduction')}}">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div id="example5-paymentRequest">
                        <!--Stripe paymentRequestButton Element inserted here-->
                    </div>
                    <fieldset>
                        <legend class="card-only" data-tid="elements_examples.form.pay_with_card">Pay with card</legend>
                        <legend class="payment-request-available" data-tid="elements_examples.form.enter_card_manually">Or enter card details</legend>
                        <div class="row">
                            <div class="field">
                                <label for="example5-name" data-tid="elements_examples.form.name_label">Name</label>
                                <input id="example5-name" data-tid="elements_examples.form.name_placeholder" class="input" type="text" placeholder="Jane Doe" required="" autocomplete="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="field">
                                <label for="example5-email" data-tid="elements_examples.form.email_label">Email</label>
                                <input id="example5-email" data-tid="elements_examples.form.email_placeholder" class="input" type="text" placeholder="janedoe@gmail.com" required="" autocomplete="email">
                            </div>
                            <div class="field">
                                <label for="example5-phone" data-tid="elements_examples.form.phone_label">Phone</label>
                                <input id="example5-phone" data-tid="elements_examples.form.phone_placeholder" class="input" type="text" placeholder="(941) 555-0123" required="" autocomplete="tel">
                            </div>
                        </div>
                        <div data-locale-reversible>
                            <div class="row">
                                <div class="field">
                                    <label for="example5-address" data-tid="elements_examples.form.address_label">Address</label>
                                    <input id="example5-address" data-tid="elements_examples.form.address_placeholder" class="input" type="text" placeholder="185 Berry St" required="" autocomplete="address-line1">
                                </div>
                            </div>
                            <div class="row" data-locale-reversible>
                                <div class="field">
                                    <label for="example5-city" data-tid="elements_examples.form.city_label">City</label>
                                    <input id="example5-city" data-tid="elements_examples.form.city_placeholder" class="input" type="text" placeholder="San Francisco" required="" autocomplete="address-level2">
                                </div>
                                <div class="field">
                                    <label for="example5-state" data-tid="elements_examples.form.state_label">State</label>
                                    <input id="example5-state" data-tid="elements_examples.form.state_placeholder" class="input empty" type="text" placeholder="CA" required="" autocomplete="address-level1">
                                </div>
                                <div class="field">
                                    <label for="example5-zip" data-tid="elements_examples.form.postal_code_label">ZIP</label>
                                    <input id="example5-zip" data-tid="elements_examples.form.postal_code_placeholder" class="input empty" type="text" placeholder="94107" required="" autocomplete="postal-code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="field">
                                <label for="example5-card" data-tid="elements_examples.form.card_label">Card</label>
                                <div id="example5-card" class="input"></div>
                            </div>
                        </div>
                        <button type="submit" data-tid="elements_examples.form.pay_button">Paydddd {{$totalprice}}</button>
                    </fieldset>
                    <div class="error" role="alert"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                            <path class="base" fill="#000" d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
                            <path class="glyph" fill="#FFF" d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
                        </svg>
                        <span class="message"></span></div>
                </form>
            </div>
        </section>
    </main>
</div>
<script src="{{ asset('card/js/l10n.js') }}" data-rel-js></script>

<!-- Scripts for each example: -->
<script src="{{ asset('card/js/example1.js') }}" data-rel-js></script>
<script src="{{ asset('card/js/example2.js') }}" data-rel-js></script>
<script src="{{ asset('card/js/example3.js') }}" data-rel-js></script>
<script src="{{ asset('card/js/example4.js') }}" data-rel-js></script>
<script src="{{ asset('card/js/example5.js') }}" data-rel-js></script>

</body>
</html>

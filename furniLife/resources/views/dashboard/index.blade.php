@extends('layouts.nav1')

@section('my_content')

@section('messages')
    @include('layouts.messages')
@endsection
@section('breadcrumb')
    <li class="parent-page">Dashboard</li>
@endsection

<!--=============================================
    =            My Account page content         =
    =============================================-->

<div class="page-section mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <!-- My Account Tab Menu Start -->
                    <div class="col-lg-3 col-12">
                        <div class="myaccount-tab-menu nav" role="tablist">
                            <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                Dashboard</a>

                            <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>


                            <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>

                            <a href="#complaint-box" data-toggle="tab"><i class="fa fa-user"></i> Complaint Box</a>

                            <a  href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <!-- My Account Tab Menu End -->

                    <!-- My Account Tab Content Start -->
                    <div class="col-lg-9 col-12">
                        <div class="tab-content" id="myaccountContent">
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Dashboard</h3>

                                    <div class="welcome mb-20">
                                        <p>Hello, <strong>{{$user->name}}!</strong> </p>
                                    </div>

                                    <p class="mb-0">From your account dashboard. you can easily check &amp; view your
                                        recent orders, manage your shipping and billing addresses and edit your
                                        password and account details.</p>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="orders" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Orders</h3>

                                    <div class="myaccount-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach($mycart_products as $mycart_product)
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{$mycart_product->title}}</td>
                                                    <td>{{$mycart_product->updated_at}}</td>
                                                    <td>{{$mycart_product->status}}</td>
                                                    <td>{{$mycart_product->price}}</td>
                                                    <td><a href="{{url("/$mycart_product->id")}}" class="btn">View</a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->



                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="account-info" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Account Details</h3>

                                    <div class="account-details-form">
                                        <form method="post" action="{{url('/dashboard/show/accounts_changing')}}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 mb-30">
                                                    <input name="name" id="first-name" placeholder="Full Name"  value="{{$user->name}}" type="text" required="required">
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <input name="phoneNo" id="" placeholder="PhoneNo e.g 03001234567" value="{{$user->phoneNo}}" type="text"required="required">
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <input name="zip_code" id="" placeholder="ZipCode e.g 39350" value="{{$user->zip_code}}" type="text" required="required">
                                                </div>

                                                <div class="col-12 mb-30"><h4>Password change</h4></div>

                                                <div class="col-12 mb-30">
                                                    <input name="password" id="current-pwd" placeholder="Current Password"  type="password" required="required">
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <input name="new_password" id="new-pwd" placeholder="New Password" type="password" required="required">
                                                </div>

                                                <div class="col-lg-6 col-12 mb-30">
                                                    <input name="confirm_password" id="confirm-pwd" placeholder="Confirm Password" type="password" required="required">
                                                </div>

                                                <div class="col-12" style="color: white; background-color: white">
                                                    <input type="submit" style="color: white" value="Save Changes" class="btn btn-dark save-change-btn">
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Complaint Box Start -->
                            <div class="contact-form-content tab-pane fade" id="complaint-box" role="tabpanel">
                                <h3 class="contact-page-title">Tell Us Your Message</h3>

                                <div class="contact-form">
                                    <form  id="contact-form" action="{{url('/dashboard/show/complaint_sumbit')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label>Your Name <span class="required">*</span></label>
                                            <input type="text" value="{{$user->name}}" name="customerName" id="customername" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Your Email <span class="required">*</span></label>
                                            <input type="email" value="{{$user->email}}" name="customerEmail" id="customerEmail" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Title<span class="required">*</span></label>
                                            <input type="text" name="title" id="contactSubject" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Your Complaint <span class="required">*</span></label>
                                            <textarea name="complaint" id="contactMessage" required></textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <button type="submit" value="submit" id="submit" class="btn btn-dark btn-block btn-lg" name="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <p class="form-messege pt-10 pb-10 mt-10 mb-10"></p>
                            </div>
                            <!-- Complint Box End -->
                        </div>

                    </div>
                    <!-- My Account Tab Content End -->
                </div>

            </div>
        </div>
    </div>
</div>

<!--=====  End of My Account page content  ======-->

@endsection
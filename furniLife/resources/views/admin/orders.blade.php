@extends('admin.app')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                @include('layouts.messages')
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">overview</h2>
                            <a href="{{route('product.create')}}"><button class="au-btn au-btn-icon au-btn--blue">
                                    <i class="zmdi zmdi-plus"></i>add item</button></a>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Order_Id</th>
                                    <th>User Name</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 1
                                @endphp
                                @foreach($all_orders as $all_order)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$all_order->order_id}}</td>
                                        <td>{{$all_order->name}}</td>
                                        <td>{{$all_order->title}}</td>
                                        <td>{{$all_order->quantity}}</td>
                                        @if($all_order->status == 'requested')
                                            <td><a href="{{route('product.delivered', $all_order->order_id)}}"><button type="button" class="btn btn-success">Deliver</button></a></td>
                                        @else
                                            <td><a href="#" onclick="return false"><button type="button" class="btn btn-outline-dark ">Delivered</button></a></td>
                                        @endif
                                        @php
                                            $count++
                                        @endphp
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                                    <th>user</th>
                                    <th>title</th>
                                    <th>complaints</th>
                                    <th>status</th>
                                    <th>delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 1
                                @endphp
                                @foreach($all_complaints as $complaint)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$complaint->name}}</td>
                                        <td>{{$complaint->title}}</td>
                                        <td>{{wordwrap($complaint->complaint,10)}}</td>
                                        @if($complaint->status == 'unread')
                                            <td><a href="{{route('complaint.read', $complaint->id)}}"><button type="button" class="btn btn-primary">Read</button></a></td>
                                        @else
                                            <td><a href="#" onclick="return false"><button type="button" class="btn btn-outline-primary">Seen</button></a></td>
                                        @endif
                                        <td><a href="{{route('complaint.destroy', $complaint->id)}}"><button type="button" class="btn btn-danger">Delete</button></a></td>
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

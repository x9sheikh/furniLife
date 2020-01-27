@extends('admin.app')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                @include('layouts.messages')
                <div class="card">
                    <div class="card-header">Add New Products</div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create New Product</h3>
                        </div>
                        <hr>
                        <form action="{{route('product.store')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="form-group has-success">
                                <label for="cc-title" class="control-label mb-1">Title</label>
                                <input id="cc-title" name="title" type="text" placeholder="Enter Product Title" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                       autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                            </div>
                            <div class="form-group">
                                <label for="cc-price" class="control-label mb-1">Price</label>
                                <input id="cc-price" name="price" type="text" class="form-control" aria-required="true" aria-invalid="false" value="1000">
                            </div>
                            <div class="form-group">
                                <label for="cc-category" class="control-label mb-1">Select Category</label>
                                    <select name="category" id="cc-category" class=" form-control">
                                        <option value="0">Please select</option>
                                        @foreach($categories as $category)
                                            <option  value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label for="textarea-input" class=" form-control-label">Description</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <textarea name="description" id="textarea-input" rows="7" placeholder="Add Some Description About The Product" class="form-control">This product is really Awesome and comfortable to use. As you many of people nowadays are using this product. This product is very cheap. So, that everyone could afford it. Now, It can be possible to reach and buy for everyone due to its cheaper price as compare to other Brand. Now, Hit the buy button to purchase quickly</textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label" for="best">Is The Product Best?</label>
                                </div>
                                <div class="col col-md-9">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="defaultInline1" name="is_best">
                                        <label class="custom-control-label" for="defaultInline1"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label for="textarea-input" class=" form-control-label">Upload Product Image</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01"
                                                   aria-describedby="inputGroupFileAddon01" name="product_file">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create Product</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

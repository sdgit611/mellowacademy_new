@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:40px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Add Products Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col">
                 <a href="{{ route('products') }}" class="btn btn-primary">All Products</a><br>
            </div>
        </div><br>
        <div class="row">
            <div class="col-xl">
                <div class="row">
                    <div class="col-lg-8 ml-auto mr-auto">
                        @if(Session::has('errmsg'))                 
                            <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                   <strong>{{Session::get('errmsg')}}</strong>
                            </div>
                            {{Session::forget('message')}}
                            {{Session::forget('errmsg')}}
                        @endif
                        <br><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Add Product</h5>
                        <form method="post" action="{{route('submit_product')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="category">Choose Category:</label>
                                    <select name="c_id" id="c_id" class="form-control">
                                        <option value="#">Choose Category</option>
                                        <?php
                                            foreach($cat as $c) { ?>
                                                <option value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
                                        <?php
                                            } ?>
                                    </select>
                                    @if ($errors->has('c_id'))
                                        <strong class="text-danger">{{ $errors->first('c_id') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="category">Choose Sub Category:</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    </select>
                                    @if ($errors->has('subcategory_id'))
                                        <strong class="text-danger">{{ $errors->first('subcategory_id') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Product Name" required="">
                                    @if ($errors->has('name'))
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="description">Product Type</label>
                                    <input type="text" class="form-control" name="pro_type" id="pro_type" placeholder="Enter Product Type">
                                    @if ($errors->has('pro_type'))
                                        <strong class="text-danger">{{ $errors->first('pro_type') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="description">Product Price</label>
                                    <input type="text" class="form-control" name="price" id="price" placeholder="Enter Price" required="">
                                    @if ($errors->has('price'))
                                        <strong class="text-danger">{{ $errors->first('price') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="description">Product Tax</label>
                                    <input type="text" class="form-control" name="tax" id="tax" placeholder="Enter Tax">
                                    @if ($errors->has('tax'))
                                        <strong class="text-danger">{{ $errors->first('tax') }}</strong>                                  
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="description">Product Size</label>
                                    <input type="text" class="form-control" name="pro_size" id="pro_size" placeholder="Enter Product Size">
                                    @if ($errors->has('pro_size'))
                                        <strong class="text-danger">{{ $errors->first('pro_size') }}</strong>                                  
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="description">Preview Link</label>
                                    <input type="text" class="form-control" name="link" id="pro_size" placeholder="Enter Preview Link">
                                    @if ($errors->has('link'))
                                        <strong class="text-danger">{{ $errors->first('link') }}</strong>                                  
                                    @endif
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="image">Product Image</label>
                                    <input type="file" class="form-control" name="image" id="image" accept="image/*">
                                    @if ($errors->has('image'))
                                    <strong class="text-danger">{{ $errors->first('image') }}</strong>                                  
                                    @endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Choose Product Details Image</label>
                                        <input type="file" class="form-control" name="multiple_image[]" accept="image/*" multiple autocomplete="off">
                                        @if ($errors->has('multiple_image'))
                                        <strong class="text-danger">{{ $errors->first('multiple_image') }}</strong>                                 
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="source_code">Upload Zip</label>
                                    <input type="file" class="form-control" name="source_code" id="source_code">
                                    @if ($errors->has('source_code'))
                                    <strong class="text-danger">{{ $errors->first('source_code') }}</strong>                                  
                                    @endif
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="source_code">Video</label>
                                    <input type="file" class="form-control" name="video" id="video">
                                    @if ($errors->has('video'))
                                    <strong class="text-danger">{{ $errors->first('video') }}</strong>                                  
                                    @endif
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="psd">PSD</label>
                                    <input type="file" class="form-control" name="psd" id="psd">
                                    @if ($errors->has('psd'))
                                    <strong class="text-danger">{{ $errors->first('psd') }}</strong>                                  
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Resolution</label>
                                    <input type="text" class="form-control" name="resolution" id="resolution" placeholder="Enter Resolution">
                                    @if ($errors->has('resolution'))
                                        <strong class="text-danger">{{ $errors->first('resolution') }}</strong>                                  
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="description">Product Features</label>
                                    <textarea id="content" class="form-control" name="description" placeholder="Description" rows="5"></textarea>
                                    @if ($errors->has('description'))
                                        <strong class="text-danger">{{ $errors->first('description') }}</strong>                                  
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="description">Product Additions</label>
                                    <textarea id="Additions" class="form-control" name="additions" placeholder="Additions" rows="5"></textarea>
                                    @if ($errors->has('additions'))
                                        <strong class="text-danger">{{ $errors->first('additions') }}</strong>                                  
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="description">Product Overview</label>
                                    <textarea id="Overview" class="form-control" name="overview" placeholder="Overview" rows="5"></textarea>
                                    @if ($errors->has('overview'))
                                        <strong class="text-danger">{{ $errors->first('overview') }}</strong>                                  
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:40px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Add Partner Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Partner</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col">
                 <a href="{{ route('our_partner') }}" class="btn btn-primary">All Partner</a><br>
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
                    <h5 class="card-title">Add Partner</h5>
                        <form method="post" action="{{route('edit_partner',$Partnerdetails->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="name">Partner Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Partner Name" value="{{$Partnerdetails->name}}">
                                    @if ($errors->has('name'))
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="description">Partner Description</label>
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Enter Partner Description" value="{{$Partnerdetails->description}}">
                                    @if ($errors->has('description'))
                                        <strong class="text-danger">{{ $errors->first('description') }}</strong>                                  
                                    @endif
                                </div>
                                
                                <div class="form-group col-sm-4">
                                    <label for="source_code">Upload Image</label>
                                    <input type="file" class="form-control" name="profile" id="profile" value="{{old('profile')}}">
                                    @if ($errors->has('profile'))
                                    <strong class="text-danger">{{ $errors->first('profile') }}</strong>                                  
                                    @endif
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Add Partner</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
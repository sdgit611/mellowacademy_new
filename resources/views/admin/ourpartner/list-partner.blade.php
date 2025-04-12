@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:40px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Partner</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                 <a href="{{ route('add_partner') }}" class="btn btn-primary">Add Partner</a><br>
            </div>
        </div><br>
        <div class="row">
            <div class="col">
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
                        <div class="table-responsive"> 
                            <table id="complex-header" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Partner Name</th>
                                        <th>Image</th>
                                        <th>Partner Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                               <tbody>
                                @foreach($partner_details as $key=>$partner)
                                   <tr>
                                       <td>{{++$key}}</td>
                                       <td>{{$partner->name}}</td>
                                       <td><img class="img-fluid img-thumbnail" src="{{ url('public'.$partner->image) }}" style="height:80px"></td>
                                       <td>{{$partner->name}}</td>
                                       <td>

                                            <a class="btn btn-success btn-sm" href="{{ route('edit_partner', $partner->id) }}" ><i class="fa fa-edit"></i></a>
                                           
                                           <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This?')" href="{{ route('delete_partner',$partner->id) }}"><i class="fa fa-trash"></i></a>

                                       </td>
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
</div>




@endsection
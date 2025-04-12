@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:40px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Developer Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Developer Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                 <a href="{{ route('add_developer_details_admin') }}" class="btn btn-primary">Add Developer Details</a><br>
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
                                        <th>Total Developer</th>
                                        <th>Total Hours</th>
                                        <th>Total Project</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                               <tbody>
                                    @foreach($developer_details as $key=>$developer)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$developer->total_developer}}</td>
                                        <td>{{$developer->total_hours}}</td>
                                        <td>{{$developer->total_project}}</td>
                                        <td>

                                             <a class="btn btn-success btn-sm" href="{{ route('add_developer_details_admin', $developer->id) }}" ><i class="fa fa-edit"></i></a>
                                           
                                           <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This?')" href="{{ route('delete_developer_details_admin',$developer->id) }}"><i class="fa fa-trash"></i></a>

                                           @if($developer->status==1)
                                           <button type="button" onclick="statusActive({{$developer->id}},0)" class="btn btn-success">Active</button>
                                           @else
                                           <button type="button" onclick="statusActive({{$developer->id}},1)" class="btn btn-danger">InActive</button>
                                           @endif
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

<script type="text/javascript">
    
    function statusActive(id,status)
    {
       if(status==0)
       {
         alert('Are You Sure You want to disable');
       }else{
         alert('Are You Sure You want to enable');
       } 

       var url="{{url('delete_developer_details_staus_admin')}}" + "/" + status + "/" + id ;

       window.location.href=url;
    }

</script>


@endsection
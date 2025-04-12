@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:40px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Add Developer Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Developer Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col">
                 <a href="{{ route('developer_details_admin') }}" class="btn btn-primary">All Developer Details</a><br>
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
                    <h5 class="card-title">Add Developer Details</h5>
                        <form method="post" action="{{route('add_developer_details_admin')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="developerId" value="{{@$developer_details->id}}">
                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="name">Total Developer</label>
                                    <input type="text" class="form-control" name="total_developer" id="total_developer" placeholder="Enter Total Developer" value="{{@$developer_details->total_developer}}" onkeypress="return isNumberKey(event)">
                                    @if ($errors->has('total_developer'))
                                        <strong class="text-danger">{{ $errors->first('total_developer') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="description">Total Hours</label>
                                    <input type="text" class="form-control" name="total_hours" id="total_hours" placeholder="Enter Total Hours" value="{{@$developer_details->total_hours}}" onkeypress="return isNumberKey(event)">
                                    @if ($errors->has('total_hours'))
                                        <strong class="text-danger">{{ $errors->first('total_hours') }}</strong>                                  
                                    @endif
                                </div>
                                
                                <div class="form-group col-sm-4">
                                    <label for="source_code">Total Project</label>
                                    <input type="text" class="form-control" name="total_project" id="total_project" value="{{@$developer_details->total_project}}" onkeypress="return isNumberKey(event)" placeholder="Enter Total Project">
                                    @if ($errors->has('total_project'))
                                    <strong class="text-danger">{{ $errors->first('total_project') }}</strong>                                  
                                    @endif
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Add Developer Details</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
     function isNumberKey(evt)
     {
        var charCode = evt.which ? evt.which : evt.keyCode;
        // Allow only numbers (0–9)
        if (charCode >= 48 && charCode <= 57) {
            return true;
        }
        return false;
    }
</script>


@endsection
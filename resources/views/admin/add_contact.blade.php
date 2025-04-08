@extends('admin.layout')
@section('content')

<div class="page-content">
    <div class="main-wrapper container">   
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
                    <h5 class="card-title">Add Contact Details</h5>
                        <form method="post" action="{{route('submit_add_contact')}}">
	                        @csrf
	                        <div class="form-row">
	                            <div class="form-group col-md-4">
	                            	<label for="heading">Address</label>
	                                <input type="text" class="form-control" name="address" id="address" placeholder="Enter Heading" required="">
	                                @if ($errors->has('address'))
	                                	<strong class="text-danger">{{ $errors->first('address') }}</strong>                                  
	                               	@endif
	                            </div>
	                            <div class="form-group col-md-4">
	                                <label for="description">Contact No.</label>
	                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Description" required="">
	                                @if ($errors->has('phone'))
	                                  	<strong class="text-danger">{{ $errors->first('phone') }}</strong>                                  
	                                @endif
	                            </div>
	                            <div class="form-group col-md-4">
                                    <label for="description">Email ID</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Description" required="">
                                    @if ($errors->has('email'))
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>                                  
                                    @endif
                                </div>

	                        </div>
	                        <button type="submit" class="btn btn-primary">Add Contact</button>
                        </form>
                    </div>
                </div>
           	</div>
        </div>
   	</div>
</div>

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Contact</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Address</th>
                                    <th style="width:40%;">Email ID</th>
                                    <th>Contact No.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
	                       <tbody>
                               <?php $i=1;
                                foreach($contact_details as $cd) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $cd->address; ?></td>
                                        <td><?php echo $cd->email; ?></td>
                                        <td><?php echo $cd->phone; ?></td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $cd->id; ?>" ><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This?')" href="<?php echo route('delete_add_contact',['id'=>''.$cd->id.'']) ?>" ><i class="fa fa-trash"></i></a>
                                        </td>                                                                         
                                    </tr>
                                    <div class="modal" id="myeditModal<?php echo $cd->id; ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Update Contact Details</h4>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                </div>
                                                <!-- Modal body -->
                                                 <div class="modal-body">
                                                    <form method="post" action="{{route('update_add_contact')}}">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group bmd-form-group">
                                                                    <label class="bmd-label-floating">Enter Address</label>
                                                                    <input type="hidden" class="form-control" name="update" value="<?php echo $cd->id; ?>" autocomplete="off" required="" >
                                                                    <input type="text" class="form-control" name="address" value="<?php echo $cd->address; ?>" autocomplete="off" required="" >
                                                                    @if ($errors->has('address'))
                                                                    <strong class="text-danger">{{ $errors->first('address') }}</strong>                                   
                                                                    @endif
                                                                </div>                      
                                                            </div>                  
                                                            <div class="col-sm-4">
                                                                <div class="form-group bmd-form-group">
                                                                    <label class="bmd-label-floating">Enter email</label>
                                                                    <input type="hidden" class="form-control" name="update" value="<?php echo $cd->id; ?>" autocomplete="off" required="" >
                                                                    <input type="text" class="form-control" name="email" value="<?php echo $cd->email; ?>" autocomplete="off" required="" >
                                                                    @if ($errors->has('email'))
                                                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>                                   
                                                                    @endif
                                                                </div>                      
                                                            </div>      
                                                            <div class="col-sm-4">
                                                                <div class="form-group bmd-form-group">
                                                                    <label class="bmd-label-floating">Enter Contact No.</label>
                                                                    <input type="hidden" class="form-control" name="update" value="<?php echo $cd->id; ?>" autocomplete="off" required="" >
                                                                    <input type="text" class="form-control" name="phone" value="<?php echo $cd->phone; ?>" autocomplete="off" required="" >
                                                                    @if ($errors->has('phone'))
                                                                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>                                   
                                                                    @endif
                                                                </div>                      
                                                            </div>      
                                                            <div class="col-sm-4">
                                                                <div class="form-group bmd-form-group">
                                                                    <button type="submit" class="btn btn-success btn-block">Update</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>                                                   
                                            </div>
                                        </div>
                                    </div>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
       	</div>
    </div>
</div>

@endsection
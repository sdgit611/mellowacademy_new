@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
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
                    <h5 class="card-title">Add Privacy Policy</h5>
                        <form method="post" action="{{route('submit_privacy_policy')}}">
                            @csrf
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="name">Heading</label>
                                    <input type="text" class="form-control" name="heading" id="name" placeholder="Enter Heading" required="">
                                    @if ($errors->has('heading'))
                                        <strong class="text-danger">{{ $errors->first('heading') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="description">Description</label>
                                    <textarea id="content" class="form-control" name="description" placeholder="Description" rows="5"></textarea>
                                    @if ($errors->has('description'))
                                        <strong class="text-danger">{{ $errors->first('description') }}</strong>                                  
                                    @endif
                                </div>                             
                            </div>
                            <button type="submit" class="btn btn-primary">Add Privacy Policy</button>
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
                <li class="breadcrumb-item"><a href="#">Privacy Policy</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Heading</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;
                                    foreach($privacy_policy as $pp) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $pp->heading; ?></td>
                                            <td><?php echo $pp->description; ?></td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $pp->id; ?>" ><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This?')" href="<?php echo route('delete_privacy_policy',['id'=>''.$pp->id.'']) ?>" ><i class="fa fa-trash"></i></a>
                                            </td>                                                                         
                                        </tr>
                                        <div class="modal" id="myeditModal<?php echo $pp->id; ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Privacy Policy</h4>
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                     <div class="modal-body">
                                                        <form method="post" action="{{route('update_privacy_policy')}}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group bmd-form-group">
                                                                        <label class="bmd-label-floating">Enter Heading</label>
                                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $pp->id; ?>" autocomplete="off" required="" >
                                                                        <input type="text" class="form-control" name="heading" value="<?php echo $pp->heading; ?>" autocomplete="off" required="" >
                                                                        @if ($errors->has('heading'))
                                                                        <strong class="text-danger">{{ $errors->first('heading') }}</strong>                                   
                                                                        @endif
                                                                    </div>                      
                                                                </div>                  

                                                                <div class="col-sm-12">
                                                                    <div class="form-group bmd-form-group">
                                                                        <label class="bmd-label-floating">Enter Description</label>
                                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $pp->id; ?>" autocomplete="off" required="" >
                                                                        <textarea class="ckeditor" name="description" autocomplete="off" required=""><?php echo $pp->description; ?></textarea>
                                                                        @if ($errors->has('description'))
                                                                        <strong class="text-danger">{{ $errors->first('description') }}</strong>                                   
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
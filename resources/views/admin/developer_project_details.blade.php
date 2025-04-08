@extends('admin.layout')
@section('content')


<div class="page-content" style="">
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
                    <h5 class="card-title">Add Project Details</h5>
                        <form method="post" action="{{route('submit_developer_project_details')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="category">Choose Developer Details:</label>
                                    <select name="developer_id" id="developer_id" class="form-control">
                                        <option value="#">Select</option>
                                        <?php
                                            foreach($all_developer_details as $ad) { ?>
                                                <option value="<?php echo $ad->dev_id; ?>"><?php echo $ad->name; ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                    @if ($errors->has('developer_id'))
                                        <strong class="text-danger">{{ $errors->first('developer_id') }}</strong>                                  
                                    @endif
                                </div>

                                

                                <div class="form-group col-sm-4">
                                    <label for="image">Choose Screenshot Image</label>
                                    <input type="file" class="form-control" name="screenshot_image" id="screenshot_image" accept="image/*" required="" >
                                    @if ($errors->has('screenshot_image'))
                                    <strong class="text-danger">{{ $errors->first('screenshot_image') }}</strong>                                  
                                    @endif
                                </div>

                                
                               

                                <div class="form-group col-sm-3">
                                    <label for="project_link">Project Link</label>
                                    <input type="url" class="form-control" name="project_link" id="project_link"  required="" >
                                    @if ($errors->has('project_link'))
                                    <strong class="text-danger">{{ $errors->first('project_link') }}</strong>                                  
                                    @endif
                                </div>
 
                            </div>
                            <button type="submit" class="btn btn-primary">Add Project Details</button>
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
                <li class="breadcrumb-item"><a href="#">All Project Details</a></li>
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
                                    <th>Developer Name</th>
                                    <th>Image</th>
                                    <th>Project Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                             <tbody>
                               <?php $i=1;
                                foreach($developer_project_details as $s) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $s->name; ?></td>
                                        <td><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/screenshot/'.$s->screenshot_image.'') ?>" style="height:80px"></td>
                                        <td><?php echo $s->project_link; ?></td>
                                        
                                        <td>
                                            <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $s->id; ?>" ><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This Details')" href="<?php echo route('delete_developer_project_details',['developer_id'=>''.$s->developer_id.'']) ?>" ><i class="fa fa-trash"></i></a>
                                            
                                        </td>                                                                         
                                    </tr>

                                        <div class="modal" id="myeditModal<?php echo $s->id; ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Category Details</h4>
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('update_developer_project_details')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                                 
                                                                <div class="form-group col-md-6">
                                                                    <label for="category">Choose Developer Details:</label>
                                                                    <select name="developer_id" id="developer_id" class="form-control" value="<?php echo $s->id; ?>">
                                                                        <option value="#">Select</option>
                                                                        <?php
                                                                            foreach($all_developer_details as $ad) { ?>
                                                                                <option value="<?php echo $ad->dev_id; ?>"><?php echo $ad->name; ?></option>
                                                                        <?php
                                                                        } ?>
                                                                    </select>
                                                                    @if ($errors->has('developer_id'))
                                                                        <strong class="text-danger">{{ $errors->first('developer_id') }}</strong>                                  
                                                                    @endif
                                                                </div>
                                                                
                                                                <div class="form-group col-sm-6">
                                                                    <label for="project_link">Project Link</label>
                                                                    <input type="hidden" class="form-control" name="update" value="<?php echo $s->id; ?>"  autocomplete="off" >
                                                                    <input type="url" class="form-control" name="project_link" id="project_link"  value="<?php echo $s->project_link; ?>" required="" >
                                                                    @if ($errors->has('project_link'))
                                                                    <strong class="text-danger">{{ $errors->first('project_link') }}</strong>                                  
                                                                    @endif
                                                                </div>

                                                                <div class="col-sm-12">
                                                                    <div class="form-group bmd-form-group is-filled">
                                                                        <label class="bmd-label-floating">Choose Screenshot Image</label>
                                                                        <input type="file" class="form-control" name="screenshot_image" accept="image/*"  autocomplete="off" >
                                                                        <input type="hidden" class="form-control" name="old_screenshot_image" value="<?php echo $s->screenshot_image; ?>"  autocomplete="off" >
                                                                        <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/screenshot/'.$s->screenshot_image.'') ?>" style="height:30px;width:40px;">
                                                                        @if ($errors->has('screenshot_image'))
                                                                        <strong class="text-danger">{{ $errors->first('screenshot_image') }}</strong>                                  
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                               
                                                                <div class="col-sm-4">
                                                                    <div class="form-group bmd-form-group">
                                                                        <button type="submit" class="btn btn-success btn-block">Update Category</button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
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
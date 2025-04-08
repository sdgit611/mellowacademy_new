@extends('developer.layout')
@section('content')



<div class="page-content">
    <div class="row">
        <div class="col-lg-8 ml-auto mr-auto">
            @if(Session::has('devProjecterrmsg'))                 
                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                       <strong>{{Session::get('devProjecterrmsg')}}</strong>
                </div>
                {{Session::forget('message')}}
                {{Session::forget('devProjecterrmsg')}}
            @endif
            <br><br>
        </div>
    </div>
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Developer Project</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{route('submit_project_details')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">

                            <div class="form-group col-sm-6">
                                <label for="image">Choose Screenshot Image</label>
                                <input type="file" class="form-control" name="screenshot_image" id="screenshot_image" accept="image/*" required="" >
                                @if ($errors->has('screenshot_image'))
                                <strong class="text-danger">{{ $errors->first('screenshot_image') }}</strong>                                  
                                @endif
                            </div>

                            <div class="form-group col-sm-6">
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
                <li class="breadcrumb-item"><a href="#">Developer Project</a></li>
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
                                    <th>Project</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $i=1;
                                foreach($developer_project_Details as $dev_project) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        
                                        <td><div class="geeks"><a href="<?php echo URL::asset('public/upload/screenshot/'.$dev_project->screenshot_image.'') ?>" target="_blank"><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/screenshot/'.$dev_project->screenshot_image.'') ?>" style="height:200px;width:200px;"></a></div></td>
                                        <td><p style="margin-top:10%;"><?php echo $dev_project->project_link; ?></p></td>
                                        <td>
                                            <a style="margin-top:20%;" class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $dev_project->id; ?>" ><i class="fa fa-edit"></i></a>
                                            <a style="margin-top:20%;" class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This?')" href="<?php echo route('delete_project_details',['developer_id'=>''.$dev_project->id.'']) ?>" ><i class="fa fa-trash"></i></a>
                                        </td>                                                                         
                                    </tr>
                                    <div class="modal" id="myeditModal<?php echo $dev_project->id; ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Update Project Details</h4>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                </div>
                                                <!-- Modal body -->
                                                 <div class="modal-body">
                                                    <form method="post" action="{{route('update_project_details')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">

                                                            <div class="col-sm-6">
                                                                <div class="form-group bmd-form-group is-filled">
                                                                    <label class="bmd-label-floating">Choose Image</label>
                                                                    <input type="file" class="form-control" name="screenshot_image" accept="image/*"  autocomplete="off" >
                                                                    <input type="hidden" class="form-control" name="old_screenshot_image" value="<?php echo $dev_project->screenshot_image; ?>"  autocomplete="off" >
                                                                    <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/screenshot/'.$dev_project->screenshot_image.'') ?>" style="height:30px;width:40px;">
                                                                    @if ($errors->has('image'))
                                                                    <strong class="text-danger">{{ $errors->first('image') }}</strong>                                  
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group bmd-form-group">
                                                                    <label class="bmd-label-floating">Enter Project Link</label>
                                                                    <input type="hidden" class="form-control" name="update" value="<?php echo $dev_project->id; ?>" autocomplete="off" required="" >
                                                                    <input type="url" class="form-control" name="project_link" value="<?php echo $dev_project->project_link; ?>" autocomplete="off" required="" >
                                                                    @if ($errors->has('project_link'))
                                                                    <strong class="text-danger">{{ $errors->first('project_link') }}</strong>                                   
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
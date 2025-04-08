@extends('admin.layout')
@section('content')


<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>



    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Title</th>
                                    <th>Category Name</th>
                                    <th>Image</th>
                                    <th>Multiple Images</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
	                        <tbody>
	                        <?php $i=1;
								foreach($details as $d) { ?>
		                            <tr>
		                                <td><?php echo $i; ?></td>
		                                <td><?php echo $d->title; ?></td>
		            	                <td><?php echo $d->name; ?></td>
		            	                 <td><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/category/'.$d->image.'') ?>" style="height:80px"></td>
                                            <td>
                                                <?php
                                                    $img=$d->multiple_image;
                                                    $images = explode(',',$img);
                                                    foreach($images as $image) 
                                                    {  ?>
                                                        <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/category/'.$image.'') ?>" style="height:30px;width:40px;">
                                                <?php   
                                                } ?>
                                            </td>
		                            	<td>
		                                    <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $d->id; ?>" ><i class="fa fa-edit"></i></a>
											<a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This Category')" href="<?php echo route('delete_category',['id'=>''.$d->id.'']) ?>" ><i class="fa fa-trash"></i></a>
										</td>
		                            </tr>
		                            	<div class="modal" id="myeditModal<?php echo $d->id; ?>">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<!-- Modal Header -->
													<div class="modal-header">
														<h4 class="modal-title">Category Details</h4>
														<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
													</div>
													<!-- Modal body -->
													<div class="modal-body">
														<form method="post" action="{{route('update_category')}}" enctype="multipart/form-data">
															@csrf
															<div class="row">
																<div class="col-sm-6">
																	<div class="form-group bmd-form-group">
																		<label class="bmd-label-floating">Enter Title</label>
																		<input type="hidden" class="form-control" name="update" value="<?php echo $d->id; ?>" autocomplete="off" required="" >
																		<input type="text" class="form-control" name="title" value="<?php echo $d->title; ?>" autocomplete="off" required="" >
																		@if ($errors->has('title'))
																		<strong class="text-danger">{{ $errors->first('title') }}</strong>									
																		@endif
																	</div>						
																</div>					
																
																<div class="col-sm-6">
																	<div class="form-group bmd-form-group">
																		<label class="bmd-label-floating">Enter Category Name</label>
																		<input type="hidden" class="form-control" name="update" value="<?php echo $d->id; ?>" autocomplete="off" required="" >
																		<input type="text" class="form-control" name="name" value="<?php echo $d->name; ?>" autocomplete="off" required="" >
																		@if ($errors->has('name'))
																		<strong class="text-danger">{{ $errors->first('name') }}</strong>									
																		@endif
																	</div>						
																</div>

																<div class="col-sm-6">
                                                                    <div class="form-group bmd-form-group is-filled">
                                                                        <label class="bmd-label-floating">Choose Category Image</label>
                                                                        <input type="file" class="form-control" name="image" accept="image/*"  autocomplete="off" >
                                                                        <input type="hidden" class="form-control" name="old_image" value="<?php echo $d->image; ?>"  autocomplete="off" >
                                                                        <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/category/'.$d->image.'') ?>" style="height:30px;width:40px;">
                                                                        @if ($errors->has('image'))
                                                                        <strong class="text-danger">{{ $errors->first('image') }}</strong>                                  
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="form-group bmd-form-group is-filled">
                                                                        <label class="bmd-label-floating">Choose Category Details Image</label>
                                                                        <input type="file" class="form-control" name="multiple_image[]" accept="image/*" multiple autocomplete="off" >
                                                                        <input type="hidden" class="form-control" name="old_multiple_image" value="<?php echo $d->multiple_image; ?>"  autocomplete="off" >
			                                                            <?php
								                                            $img=$d->multiple_image;
								                                            $images = explode(',',$img);
								                                            foreach($images as $image) 
								                                            {  ?>
								                                                <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/category/'.$image.'') ?>" style="height:30px;width:40px;">
								                                        <?php   
								                                        } ?>

                                                                        @if ($errors->has('multiple_image'))
                                                                        <strong class="text-danger">{{ $errors->first('multiple_image') }}</strong>                                 
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

<div class="page-content" style="padding-top:0px;">
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
                    <h5 class="card-title">Add Category</h5>
                        <form method="post" action="{{route('submit_category')}}" enctype="multipart/form-data">
	                        @csrf
	                        <div class="form-row">
	                            <div class="form-group col-md-6">
	                            	<label for="title">Title</label>
	                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required="">
	                                @if ($errors->has('title'))
	                                	<strong class="text-danger">{{ $errors->first('title') }}</strong>                                  
	                               	@endif
	                            </div>
	                            <div class="form-group col-md-6">
	                                <label for="name">Category Name</label>
	                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category Name" required="">
	                                @if ($errors->has('name'))
	                                  	<strong class="text-danger">{{ $errors->first('name') }}</strong>                                  
	                                @endif
	                            </div>
	                            <div class="form-group col-sm-6">
                                        <label for="image">Category Image</label>
                                        <input type="file" class="form-control" name="image" id="image" accept="image/*" required="" >
                                        @if ($errors->has('image'))
                                        <strong class="text-danger">{{ $errors->first('image') }}</strong>                                  
                                        @endif
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Choose Category Details Image</label>
                                        <input type="file" class="form-control" name="multiple_image[]" accept="image/*" multiple autocomplete="off" required="" >
                                        @if ($errors->has('multiple_image'))
                                        <strong class="text-danger">{{ $errors->first('multiple_image') }}</strong>                                 
                                        @endif
                                    </div>
                                </div>
					
	                        </div>
	                        <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
           	</div>
        </div>
   	</div>
</div>



@endsection
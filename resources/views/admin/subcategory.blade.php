@extends('admin.layout')
@section('content')


<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Sub Category</a></li>
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
                                    <th>SubCategory Heading</th>
                                    <th>SubCategory Name</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;
                                foreach($subcategory as $subcat) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                	<td><?php echo $subcat->heading; ?></td>
                                    <td><?php echo $subcat->name; ?></td>
                                    <td><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/subcategory/'.$subcat->image.'') ?>" style="height:80px"></td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $subcat->id; ?>" ><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This Sub Category')" href="<?php echo route('delete_subcategory',['id'=>''.$subcat->id.'']) ?>" ><i class="fa fa-trash"></i></a>
                                    </td>                                           
                                </tr>               
                                <div class="modal" id="myeditModal<?php echo $subcat->id; ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Sub Category Details</h4>
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{route('update_subcategory')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                    	<div class="col-sm-6">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Heading</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $subcat->id; ?>" autocomplete="off" required="" >
                                                                <input type="text" class="form-control" name="heading" value="<?php echo $subcat->heading; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('heading'))
                                                                <strong class="text-danger">{{ $errors->first('heading') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div> 

                                                        <div class="col-sm-6">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Name</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $subcat->id; ?>" autocomplete="off" required="" >
                                                                <input type="text" class="form-control" name="name" value="<?php echo $subcat->name; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('name'))
                                                                <strong class="text-danger">{{ $errors->first('name') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>  
                                                         

                                                        <div class="col-sm-6">
                                                            <div class="form-group bmd-form-group">
                                                                <label>Choose Category</label>
                                                                    <select name="category_id" id="category_id" class="form-control">
                                                                        <option value="#">Choose Category</option>
								                                        <?php $j=1;
								                                            foreach($category as $cat) { ?>
								                                                <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
								                                        <?php $j++;
								                                        } ?>
								                                    </select>
                                                                @if ($errors->has('category_id'))
                                                                <strong class="text-danger">{{ $errors->first('category_id') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>   
                                                        
                                                        <div class="col-sm-6">
                                                            <div class="form-group bmd-form-group is-filled">
                                                                <label class="bmd-label-floating">Choose Sub Category Image</label>
                                                                <input type="file" class="form-control" name="image" accept="image/*"  autocomplete="off" >
                                                                <input type="hidden" class="form-control" name="old_image" value="<?php echo $subcat->image; ?>"  autocomplete="off" >
                                                                <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/subcategory/'.$subcat->image.'') ?>" style="height:30px;width:40px;">
                                                                @if ($errors->has('image'))
                                                                <strong class="text-danger">{{ $errors->first('image') }}</strong>                                  
                                                                @endif
                                                            </div>
                                                        </div>

                                                        
                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <button type="submit" class="btn btn-success btn-block">Update Sub Category</button>
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
                    <h5 class="card-title">Add Sub Category</h5>
                        <form method="post" action="{{route('submit_subcategory')}}" enctype="multipart/form-data">
	                        @csrf
	                        <div class="form-row">
	                            <div class="form-group col-md-6">
	                            	<label for="title">Sub Category Heading</label>
	                                <input type="text" class="form-control" name="heading" id="heading" placeholder="Enter Title" required="">
	                                @if ($errors->has('heading'))
	                                	<strong class="text-danger">{{ $errors->first('heading') }}</strong>                                  
	                               	@endif
	                            </div>
	                            <div class="form-group col-md-6">
	                                <label for="name">Sub Category Name</label>
	                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category Name" required="">
	                                @if ($errors->has('name'))
	                                  	<strong class="text-danger">{{ $errors->first('name') }}</strong>                                  
	                                @endif
	                            </div>
	                            <div class="form-group col-sm-6">
                                    <label for="image">Choose Sub Category Image</label>
                                    <input type="file" class="form-control" name="image" id="image" accept="image/*" required="" >
                                    @if ($errors->has('image'))
                                    <strong class="text-danger">{{ $errors->first('image') }}</strong>                                  
                                    @endif
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Choose Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Choose Category</option>
                                        <?php $i=1;
                                            foreach($category as $cat) { ?>
                                                <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
                                        <?php $i++;
                                        } ?>
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <strong class="text-danger">{{ $errors->first('category_id') }}</strong>                                  
                                    @endif
                                </div>					
	                        </div>
	                        <button type="submit" class="btn btn-primary">Add Sub Category</button>
                        </form>
                    </div>
                </div>
           	</div>
        </div>
   	</div>
</div>



@endsection
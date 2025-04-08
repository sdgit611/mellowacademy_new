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
                    <h5 class="card-title">Add Developer Details</h5>
                        <form method="post" action="{{route('submit_developer_details')}}" enctype="multipart/form-data">
	                        @csrf
	                        <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="category">Choose Higher Professional:</label>
                                    <select name="pro_id" id="pro_id" class="form-control">
                                        <option value="#">Select</option>
                                        <?php
                                            foreach($higher_professional as $c) { ?>
                                                <option value="<?php echo $c->id; ?>"><?php echo $c->heading; ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                    @if ($errors->has('pro_id'))
                                        <strong class="text-danger">{{ $errors->first('pro_id') }}</strong>                                  
                                    @endif
                                </div>

	                            <div class="form-group col-md-4">
	                            	<label for="name">First Name</label>
	                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter First Name" required="">
	                                @if ($errors->has('name'))
	                                	<strong class="text-danger">{{ $errors->first('name') }}</strong>                                  
	                               	@endif
	                            </div>

                                <div class="form-group col-md-4">
                                    <label for="name">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" required="">
                                    @if ($errors->has('last_name'))
                                        <strong class="text-danger">{{ $errors->first('last_name') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="image">Choose Profile Image</label>
                                    <input type="file" class="form-control" name="image" id="image" accept="image/*" required="" >
                                    @if ($errors->has('image'))
                                    <strong class="text-danger">{{ $errors->first('image') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="image">Choose Portfolio Image</label>
                                    <input type="file" class="form-control" name="portfolio_image" id="portfolio_image" accept="image/*" required="" >
                                    @if ($errors->has('portfolio_image'))
                                    <strong class="text-danger">{{ $errors->first('portfolio_image') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="image">Upload Resume</label>
                                    <input type="file" class="form-control" name="resume" id="resume" required="" >
                                    @if ($errors->has('resume'))
                                    <strong class="text-danger">{{ $errors->first('resume') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="phone">Contact No.</label>
                                    <input type="tel" class="form-control" name="phone" maxlength="10" id="phone" required="" >
                                    @if ($errors->has('phone'))
                                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>                                  
                                    @endif
                                </div>

                                 <div class="form-group col-sm-6">
                                    <label for="job">Total Jobs</label>
                                    <input type="text" class="form-control" name="job" id="job"  required="" >
                                    @if ($errors->has('job'))
                                    <strong class="text-danger">{{ $errors->first('job') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="email">Email Id</label>
                                    <input type="email" class="form-control" name="email" id="email" accept="image/*" required="" >
                                    @if ($errors->has('email'))
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required="">
                                    @if ($errors->has('password'))
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>                                  
                                    @endif
                                </div>

                               

                                <div class="form-group col-sm-4">
                                    <label for="total_hours">Total Hours</label>
                                    <input type="text" class="form-control" name="total_hours" id="total_hours" required="" >
                                    @if ($errors->has('total_hours'))
                                    <strong class="text-danger">{{ $errors->first('total_hours') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="perhr">Per Hour Rate</label>
                                    <input type="text" class="form-control" name="perhr" id="perhr" required="" >
                                    @if ($errors->has('perhr'))
                                    <strong class="text-danger">{{ $errors->first('perhr') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="rating">Rating</label>
                                    <input type="text" class="form-control" name="rating" id="rating" required="" >
                                    @if ($errors->has('rating'))
                                    <strong class="text-danger">{{ $errors->first('rating') }}</strong>                                  
                                    @endif
                                </div>
                                
                                <div class="form-group col-sm-6">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" required="" >
                                    @if ($errors->has('address'))
                                    <strong class="text-danger">{{ $errors->first('address') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="language">Language</label>
                                    <input type="text" class="form-control" name="language" id="language" required="" >
                                    @if ($errors->has('language'))
                                    <strong class="text-danger">{{ $errors->first('language') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="language">Education Details</label>
                                    
                                    <div class="table-responsive">  
                                        <table class="table table-bordered" id="dynamic_field">
                                            <tr>
                                                <th>University</th>
                                                <th>Collage Name</th>
                                                <th>Degree</th>
                                                <th>Percentage</th>
                                                <th>Passing Year</th>
                                                <th>Option</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control" name="education[]" id="task" required="" >

                                                    @if ($errors->has('education'))
                                                    <strong class="text-danger">{{ $errors->first('education') }}</strong>                                  
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="clg_name[]" id="task" required="" >

                                                    @if ($errors->has('clg_name'))
                                                    <strong class="text-danger">{{ $errors->first('clg_name') }}</strong>                                  
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="degree[]" id="task" required="" >

                                                    @if ($errors->has('degree'))
                                                    <strong class="text-danger">{{ $errors->first('degree') }}</strong>                                  
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="percentage[]" id="task" required="" >

                                                    @if ($errors->has('percentage'))
                                                    <strong class="text-danger">{{ $errors->first('percentage') }}</strong>                                  
                                                    @endif                                                        
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="passing_year[]" id="task" required="" >

                                                    @if ($errors->has('passing_year'))
                                                    <strong class="text-danger">{{ $errors->first('passing_year') }}</strong>                                  
                                                    @endif   
                                                </td>
                                                <td><button type="button" class="btn btn-primary add">Add More</button></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                

	                            <div class="form-group col-md-12">
	                                <label for="description">Description</label>
	                                <textarea id="content" class="form-control" name="description" placeholder="Description" rows="5"></textarea>
	                                @if ($errors->has('description'))
	                                  	<strong class="text-danger">{{ $errors->first('description') }}</strong>                                  
	                                @endif
	                            </div>

                                <div class="form-group col-md-12">
                                    <label for="skills">Skills</label>
                                    <textarea id="Additions" class="form-control" name="skills" placeholder="skills" rows="5"></textarea>
                                    @if ($errors->has('skills'))
                                        <strong class="text-danger">{{ $errors->first('skills') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="completed_job">Completed Job</label>
                                    <textarea id="Overview" class="form-control" name="completed_job" placeholder="completed_job" rows="5"></textarea>
                                    @if ($errors->has('completed_job'))
                                        <strong class="text-danger">{{ $errors->first('completed_job') }}</strong>                                  
                                    @endif
                                </div>

	                        </div>
	                        <button type="submit" class="btn btn-primary">Add Details</button>
                        </form>
                    </div>
                </div>
           	</div>
        </div>
   	</div>
</div>










<script>
    $(document).ready(function() {
        var i=1;
        $('.add').on('click', function() {
            var task = $("#task").val();
            i++;  
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" class="form-control" name="education[]" id="task" required="" ></td><td><input type="text" class="form-control" name="clg_name[]" id="task" required="" ></td><td><input type="text" class="form-control" name="degree[]" id="task" required="" ></td><td><input type="text" class="form-control" name="percentage[]" id="task" required="" ></td><td><input type="text" class="form-control" name="passing_year[]" id="task" required="" ></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
            
            $(document).on('click', '.btn_remove', function(){  
                   var button_id = $(this).attr("id");   
                   $('#row'+button_id+'').remove();  
              });
            
        });
    });
</script>



@endsection
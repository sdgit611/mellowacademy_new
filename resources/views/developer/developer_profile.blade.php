[@extends('developer.layout')
@section('content')

<div class="page-content">
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
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <?php 
                    foreach ($developer_details as $k) {
                    
                ?>
                    <?php echo $k->profile_complete; ?>% Profile Completed
                    <?php if($k->profile_complete <= 59) {  ?>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $k->profile_complete; ?>%;background:yellow">
                            </div>
                        </div>
                    <?php }elseif($k->profile_complete <= 99){?>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $k->profile_complete; ?>%;background:blue">
                              <span class="sr-only"><?php echo $k->profile_complete; ?>% Complete</span>
                            </div>
                        </div>
                    <?php }elseif($k->profile_complete == 100){?>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $k->profile_complete; ?>%;background:green">
                              <span class="sr-only"><?php echo $k->profile_complete; ?>% Complete</span>
                            </div>
                        </div>
                        <br>
                        <?php 
                            // foreach ($premium_profile_details as $k) {
                             
                                if($premium_profile_details==1) { 
                        ?>
                            <b style="color: #40830d;">Your account is now premium!</b> 
                        <?php }elseif($premium_profile_details== 0){ ?>
                            <b style="color: #ffb100;">Your account is not premium! Purchase premium.</b> <a class="btn btn-success btn-sm" href="<?php echo route('why_premium_purchase') ?>" >Upgrade Now <i class="fa fa-edit"></i></a>
                        <?php } } ?>
                        
                    
                    
                <?php } ?>

            </div>
        </div><br>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                   
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Details</th>
                                    <th>Project Details</th>
                                    <th>Available Date</th>
                                    <th>Edit Profile</th>
                                    
                                </tr>
                            </thead>
	                        <tbody>
                               <?php $i=1;
                                foreach($details as $s) { ?>
                                    <tr>
                                       
                                        <td><?php echo $s->name; ?> <?php echo $s->last_name; ?></td>
                                        <td><?php echo $s->phone; ?></td>
                                        <td><?php echo $s->email; ?></td>
                                        <td><?php echo $s->show_password; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myshowModal<?php echo $s->dev_id; ?>">More Details</button>
                                        </td>
                                        <td>
                                            
                                            <a class="btn btn-success btn-sm" href="<?php echo route('developer_project') ?>" ><i class="fa fa-edit"></i></a>
                                        </td> 
                                        <td>
                                            <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myModal<?php echo $s->dev_id; ?>" ><i class="fa fa-edit"></i></a>
                                            
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="<?php echo route('developer_profile_update_details') ?>"><i class="fa fa-edit"></i></a>
                                            
                                        </td> 
                                        
                                        
                                    </tr>

                                    <div class="modal" id="myshowModal<?php echo $s->dev_id; ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h5 class="card-title">More Details</h5>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Developer</h5>
                                                                        <p class="card-text"><?php echo $s->heading; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Rating</h5>
                                                                        <p class="card-text"><?php echo $s->rating; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Available Date</h5>
                                                                        <?php if($s->available_start_date == ''){ ?>
                                                                            <p class="card-text">Available Date : </p>
                                                                        <?php }else{?>
                                                                            <p class="card-text">Available Date : <b style="color:green"><?php echo $s->available_start_date; ?>  To  <?php echo $s->available_end_date; ?></b></p>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div> 
                                                               <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Job</h5>
                                                                        <p class="card-text"><?php echo $s->job; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Total Hours</h5>
                                                                        <p class="card-text"><?php echo $s->total_hours; ?></p>
                                                                    </div>
                                                                </div>

                                                                
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Per Hr</h5>
                                                                        <p class="card-text"><?php echo $s->perhr; ?></p>
                                                                    </div>
                                                                </div>

                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Address</h5>
                                                                        <p class="card-text"><?php echo $s->address; ?></p>
                                                                    </div>
                                                                </div> 
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Language</h5>
                                                                        <p class="card-text"><?php echo $s->language; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Education</h5>
                                                                        <p class="card-text"><?php echo $s->education; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Description</h5>
                                                                        <p class="card-text"><?php echo $s->description; ?></p>
                                                                    </div>
                                                                </div> 
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Skills</h5>
                                                                        <p class="card-text"><?php echo $s->skills; ?></p>
                                                                    </div>
                                                                </div> 
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Completed Job</h5>
                                                                        <p class="card-text"><?php echo $s->completed_job; ?></p>
                                                                    </div>
                                                                </div> 
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Profile Image</h5>
                                                                        <p class="card-text"><div class="geeks"><a href="<?php echo URL::asset('public/upload/developer/'.$s->image.'') ?>" target="_blank"><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/developer/'.$s->image.'') ?>" ></a></div></p>
                                                                    </div>
                                                                </div> 
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Portfolio Image</h5>
                                                                        <p class="card-text"><div class="geeks"><a href="<?php echo URL::asset('public/upload/portfolio/'.$s->portfolio_image.'') ?>" target="_blank"><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/portfolio/'.$s->portfolio_image.'') ?>" ></a></div></p>
                                                                    </div>
                                                                </div>                 
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Resume</h5>
                                                                        <p class="card-text"><?php echo $s->resume; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Status</h5>
                                                                        <p class="card-text"><?php echo $s->developer_status; ?></p>
                                                                    </div>
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

                                    <div class="modal" id="myeditModal<?php echo $s->dev_id; ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Update Profile</h4>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                </div>
                                                <!-- Modal body -->
                                                 <div class="modal-body">
                                                    <form method="post" action="{{route('developer_profile_update')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        
                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter First Name</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                <input type="text" class="form-control" name="name" value="<?php echo $s->name; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('name'))
                                                                <strong class="text-danger">{{ $errors->first('name') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Last Name</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                <input type="text" class="form-control" name="last_name" value="<?php echo $s->last_name; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('last_name'))
                                                                <strong class="text-danger">{{ $errors->first('last_name') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Conatct</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                <input type="text" class="form-control" name="phone" value="<?php echo $s->phone; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('phone'))
                                                                <strong class="text-danger">{{ $errors->first('phone') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>   

                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">No.of the project till yet</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                <input type="job" class="form-control" name="job" value="<?php echo $s->job; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('job'))
                                                                <strong class="text-danger">{{ $errors->first('job') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Per Month</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                <input type="perhr" class="form-control" name="perhr" value="<?php echo $s->perhr; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('perhr'))
                                                                <strong class="text-danger">{{ $errors->first('perhr') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>               
                                                        
                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Email</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                <input type="email" class="form-control" name="email" value="<?php echo $s->email; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('email'))
                                                                <strong class="text-danger">{{ $errors->first('email') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Total Hours</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                <input type="text" class="form-control" name="total_hours" value="<?php echo $s->total_hours; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('total_hours'))
                                                                <strong class="text-danger">{{ $errors->first('total_hours') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>

                                                        <!--<div class="col-sm-4">-->
                                                        <!--    <div class="form-group bmd-form-group">-->
                                                        <!--        <label class="bmd-label-floating">Enter Rating</label>-->
                                                        <!--        <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >-->
                                                        <!--        <input type="text" class="form-control" name="rating" value="<?php echo $s->rating; ?>" autocomplete="off" required="" >-->
                                                        <!--        @if ($errors->has('rating'))-->
                                                        <!--        <strong class="text-danger">{{ $errors->first('rating') }}</strong>                                   -->
                                                        <!--        @endif-->
                                                        <!--    </div>                      -->
                                                        <!--</div>-->

                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Address</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                <input type="text" class="form-control" name="address" value="<?php echo $s->address; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('address'))
                                                                <strong class="text-danger">{{ $errors->first('address') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>

                                                        

                                                        <div class="col-sm-6">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Language</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                <input type="text" class="form-control" name="language" value="<?php echo $s->language; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('language'))
                                                                <strong class="text-danger">{{ $errors->first('language') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Education</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                <input type="text" class="form-control" name="education" value="<?php echo $s->education; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('education'))
                                                                <strong class="text-danger">{{ $errors->first('education') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>

                                                        
                                                        <div class="col-sm-6">
                                                            <div class="form-group bmd-form-group is-filled">
                                                                <label class="bmd-label-floating">Choose Portfolio Image</label>
                                                                <input type="file" class="form-control" name="portfolio_image" accept="image/*"  autocomplete="off" >
                                                                <input type="hidden" class="form-control" name="old_portfolio_image" value="<?php echo $s->portfolio_image; ?>"  autocomplete="off" >
                                                                <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/portfolio/'.$s->portfolio_image.'') ?>" style="height:30px;width:40px;">
                                                                @if ($errors->has('portfolio_image'))
                                                                <strong class="text-danger">{{ $errors->first('portfolio_image') }}</strong>                                  
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group bmd-form-group is-filled">
                                                                <label class="bmd-label-floating">Choose Resume</label>
                                                                <input type="file" class="form-control" name="resume"  autocomplete="off" >
                                                                <input type="hidden" class="form-control" name="old_resume"  autocomplete="off" >
                                                                <?php echo $s->resume; ?>
                                                                @if ($errors->has('resume'))
                                                                <strong class="text-danger">{{ $errors->first('resume') }}</strong>                                  
                                                                @endif
                                                            </div>
                                                        </div>

                                                        

                                                        <div class="col-sm-12">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Description</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                <textarea id="content" class="form-control" name="description"><?php echo $s->description; ?></textarea>
                                                                @if ($errors->has('description'))
                                                                <strong class="text-danger">{{ $errors->first('description') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div> 

                                                        <div class="col-sm-12">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter skills</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                <textarea id="Additions" class="form-control" name="skills"><?php echo $s->skills; ?></textarea>
                                                                @if ($errors->has('skills'))
                                                                <strong class="text-danger">{{ $errors->first('skills') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div> 

                                                        <div class="col-sm-12">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Completed Job</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                <textarea id="Overview" class="form-control" name="completed_job"><?php echo $s->completed_job; ?></textarea>
                                                                @if ($errors->has('completed_job'))
                                                                <strong class="text-danger">{{ $errors->first('completed_job') }}</strong>                                   
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

                                    <div class="modal" id="myModal<?php echo $s->dev_id; ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add available Date</h4>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <?php 
                                                    foreach ($developer_details as $k) {
                                                   
                                                    if($k->login_status == 0){
                                                ?>
                                                    <center><div class="alert alert-danger" role="alert" style="width:50%"><span>Your Account Is Not Active</span></div></center>                                 
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('developer_available_date_update_error') }}" >
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group bmd-form-group">
                                                                        <label class="bmd-label-floating">Start Date</label>
                                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                        <input type="date" class="form-control" name="available_start_date"  autocomplete="off" required="" >
                                                                        @if ($errors->has('available_start_date'))
                                                                        <strong class="text-danger">{{ $errors->first('available_start_date') }}</strong>                                   
                                                                        @endif
                                                                    </div>                      
                                                                </div> 

                                                                <div class="col-sm-6">
                                                                    <div class="form-group bmd-form-group">
                                                                        <label class="bmd-label-floating">End Date</label>
                                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                        <input type="date" class="form-control" name="available_end_date"  autocomplete="off" required="" >
                                                                        @if ($errors->has('available_end_date'))
                                                                        <strong class="text-danger">{{ $errors->first('available_end_date') }}</strong>                                   
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
                                                <?php }else{?> 
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('developer_available_date_update') }}" >
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group bmd-form-group">
                                                                        <label class="bmd-label-floating">Start Date</label>
                                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                        <input type="date" class="form-control" name="available_start_date"  autocomplete="off" required="" >
                                                                        @if ($errors->has('available_start_date'))
                                                                        <strong class="text-danger">{{ $errors->first('available_start_date') }}</strong>                                   
                                                                        @endif
                                                                    </div>                      
                                                                </div> 

                                                                <div class="col-sm-6">
                                                                    <div class="form-group bmd-form-group">
                                                                        <label class="bmd-label-floating">End Date</label>
                                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $s->dev_id; ?>" autocomplete="off" required="" >
                                                                        <input type="date" class="form-control" name="available_end_date"  autocomplete="off" required="" >
                                                                        @if ($errors->has('available_end_date'))
                                                                        <strong class="text-danger">{{ $errors->first('available_end_date') }}</strong>                                   
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
                                                <?php } }?>                                          
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
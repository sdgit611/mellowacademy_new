@extends('admin.layout')
@section('content')


<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Requested Developer Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
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
               
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive"> 
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Higher Professional</th>
                                    <th>Full Name</th>
                                    <th>View Profile</th>
                                    <th>Bank Details</th>
                                    <th>Project Details</th>
                                    <th>Profile Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
	                        <tbody>
                               <?php $i=1;
                                foreach($developer_details as $s) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $s->heading; ?></td>
                                        <td><?php echo $s->name; ?>  <?php echo $s->last_name; ?></td>
                                       
                                       
                                        <td><a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myprofileModal<?php echo $s->dev_id; ?>" ><i class="fa fa-show"></i>Details</a></td>
                                        <td><a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#mybankModal<?php echo $s->dev_id; ?>" ><i class="fa fa-show"></i>Details</a></td>
                                        <td><a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myprojectModal<?php echo $s->dev_id; ?>" ><i class="fa fa-show"></i>Details</a></td>
                                       
                                        <!-- <td><a class="btn btn-success btn-sm" href="<?php echo route('requested_developer_profile_details',['dev_id'=>''.$s->dev_id.'']) ?>" >Details</a></td> -->
                                        <!-- <td><a class="btn btn-success btn-sm" href="<?php echo route('requested_bank_details',['dev_id'=>''.$s->dev_id.'']) ?>" >Details</a></td>
                                        <td><a class="btn btn-success btn-sm" href="<?php echo route('requested_project_details',['dev_id'=>''.$s->dev_id.'']) ?>" >Details</a></td>
                                         -->

                                        <td><b style="color:red"><?php echo $s->profile_complete; ?> %</b></td>
                                        
                                        <td>
                                            
                                                <a class="btn btn-danger btn-sm" href="<?php echo route('developer_login_status',['dev_id'=>''.$s->dev_id.'']) ?>"><i class="fa fa-show"></i>Deactive</a>
                                                                                       
                                        </td>                                                                     
                                    </tr>

                                    <div class="modal" id="myprofileModal<?php echo $s->dev_id; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Profile Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Email</h5>
                                                        <p class="card-text"><?php echo $s->email; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Description</h5>
                                                        <p class="card-text"><?php echo $s->description; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Conatct Number</h5>
                                                        <p class="card-text"><?php echo $s->phone; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Job</h5>
                                                        <p class="card-text"><?php echo $s->job; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Per Hr</h5>
                                                        <p class="card-text"><?php echo $s->perhr; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Total Hours</h5>
                                                        <p class="card-text"><?php echo $s->total_hours; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Rating</h5>
                                                        <p class="card-text"><?php echo $s->rating; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Address</h5>
                                                        <p class="card-text"><?php echo $s->address; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Language</h5>
                                                        <p class="card-text"><?php echo $s->language; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">University</h5>
                                                        <p class="card-text"><?php echo $s->education; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Collage Name</h5>
                                                        <p class="card-text"><?php echo $s->clg_name; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Degree</h5>
                                                        <p class="card-text"><?php echo $s->degree; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Percentage</h5>
                                                        <p class="card-text"><?php echo $s->percentage; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Passing Year</h5>
                                                        <p class="card-text"><?php echo $s->passing_year; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Skills</h5>
                                                        <p class="card-text"><?php echo $s->skills; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Resume</h5>
                                                        <p class="card-text"><?php echo $s->resume; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Completed Job</h5>
                                                        <p class="card-text"><?php echo $s->completed_job; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">National Id</h5>
                                                        <p class="card-text"><?php echo $s->national_id_name; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">National Image</h5>
                                                        <p class="card-text"><div class="geeks"><a href="<?php echo URL::asset('public/upload/national_image/'.$s->national_id_image.'') ?>" target="_blank"><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/national_image/'.$s->national_id_image.'') ?>" style="height:200px"></a></div></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Profile Image</h5>
                                                        <p class="card-text"><div class="geeks"><a href="<?php echo URL::asset('public/upload/developer/'.$s->image.'') ?>" target="_blank"><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/developer/'.$s->image.'') ?>" style="height:200px"></a></div></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Portfolio</h5>
                                                        <p class="card-text"><div class="geeks"><a href="<?php echo URL::asset('public/upload/portfolio/'.$s->portfolio_image.'') ?>" target="_blank"><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/portfolio/'.$s->portfolio_image.'') ?>" style="height:200px"></a></div></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Signature</h5>
                                                        <p class="card-text"><div class="geeks"><a href="<?php echo URL::asset('public/upload/signature/'.$s->signature.'') ?>" target="_blank"><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/signature/'.$s->signature.'') ?>" style="height:200px"></a></div></p>
                                                      </div>
                                                    </div>
                                                </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal" id="mybankModal<?php echo $s->dev_id; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Bank Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Name Of Bank</h5>
                                                        <p class="card-text"><?php echo $s->bank_name; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Branch Name</h5>
                                                        <p class="card-text"><?php echo $s->branch_name; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Account Name</h5>
                                                        <p class="card-text"><?php echo $s->acct_name; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Account Number</h5>
                                                        <p class="card-text"><?php echo $s->account_number; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">IFC Code</h5>
                                                        <p class="card-text"><?php echo $s->ifc_code; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Swift Code</h5>
                                                        <p class="card-text"><?php echo $s->micr_number; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Passbook Image</h5>
                                                        <p class="card-text"><div class="geeks"><a href="<?php echo URL::asset('public/upload/passbook/'.$s->passbook.'') ?>" target="_blank"><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/passbook/'.$s->passbook.'') ?>" style="height:200px"></a></div></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Type Of Account</h5>
                                                        <p class="card-text"><?php echo $s->account_Type; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal" id="myprojectModal<?php echo $s->dev_id; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Project Details</h4>
                                                </div>
                                                <?php foreach ($requested_project_details as $k) {
                                                    if($k->developer_id == $s->dev_id){
                                                ?>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Project Image</h5>
                                                        <p class="card-text"> <div class="geeks"><a href="<?php echo URL::asset('public/upload/screenshot/'.$k->screenshot_image.'') ?>" target="_blank"><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/screenshot/'.$k->screenshot_image.'') ?>" style="height:200px"></a></div></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <h5 class="card-title">Project Link</h5>
                                                        <p class="card-text"><?php echo $k->project_link; ?></p>
                                                      </div>
                                                    </div>
                                                </div>
                                                

                                                <?php } }?>
                                                
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
</div>



@endsection
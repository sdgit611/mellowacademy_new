@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Developer Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                 <a href="{{ route('developer_details') }}" class="btn btn-primary">Add Developer</a><br>
            </div>
        </div><br>
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
                                        <th>Status</th>
                                        <th>Change Status</th>
                                        <th>Available Date</th>
                                        <th>Option</th>
                                        <th>Transaction Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
    	                        <tbody>
                                   <?php $i=1;
                                    foreach($developer_details as $s) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $s->heading; ?></td>
                                            <td><?php echo $s->name; ?>  <?php echo $s->last_name; ?></td>
                                            <td><a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myModal<?php echo $s->dev_id; ?>" ><i class="fa fa-show"></i>Details</a></td>
                                            <td><a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myBankModal<?php echo $s->dev_id; ?>" ><i class="fa fa-show"></i>Details</a></td>
                                            <td><a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myprojectModal<?php echo $s->dev_id; ?>" ><i class="fa fa-show"></i>Details</a></td>
                                            <td><?php echo $s->developer_status; ?></td>
                                            <td> 

                                                <select name="developer_status"  onchange="update_status(this.value,{{$s->dev_id}})" style="border-radius:4px; height:35px; color:currentColor;">
                                                    <option value=""> Select Status </option>
                                                    
                                                    <option value="Booked">Book Now</option>
                                                    
                                                </select>

                                            </td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $s->dev_id; ?>" ><i class="fa fa-edit"></i></a>
                                                
                                            </td>
                                            <td>
                                                <?php if($s->login_status == 0){ ?>
                                                    <a class="btn btn-danger btn-sm" href="<?php echo route('developer_login_status',['dev_id'=>''.$s->dev_id.'']) ?>"><i class="fa fa-show"></i>Deactive</a>
                                                <?php } else{?>
                                                    <a class="btn btn-success btn-sm" href="<?php echo route('developer_login_status',['dev_id'=>''.$s->dev_id.'']) ?>"><i class="fa fa-show"></i>Active</a>
                                                <?php } ?>                                            
                                            </td>

                                            <td>
                                                <a class="btn btn-success btn-sm" href="<?php echo route('developer_transaction_details',['dev_id'=>''.$s->dev_id.'']) ?>" target="_blank" ><i class="fa fa-show"></i>Details</a>
                                                
                                            </td>  
                                           
                                            <td>
                                                <a class="btn btn-success btn-sm" href="<?php echo route('developer_details_update',['dev_id'=>''.$s->dev_id.'']) ?>" ><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This?')" href="<?php echo route('delete_developer_details',['dev_id'=>''.$s->dev_id.'']) ?>" ><i class="fa fa-trash"></i></a>
                                            </td>                                                                         
                                        </tr>

                                        <div class="modal" id="myModal<?php echo $s->dev_id; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">About Details</h4>
                                                    </div>
                                                  <div class="modal-body">
                                                    <p>Email : <?php echo $s->email; ?></p>
                                                    <p>Description : <?php echo $s->description; ?></p>
                                                    <p>Conatct Number : <?php echo $s->phone; ?></p>

                                                    <?php if($s->available_start_date == ''){ ?>
                                                        <p>Available Date : </p>
                                                    <?php }else{?>
                                                        <p>Available Date : <b style="color:green"><?php echo $s->available_start_date; ?>  To  <?php echo $s->available_end_date; ?></b></p>
                                                    <?php } ?>
                                                    <p>Job : <?php echo $s->job; ?></p>
                                                    <p>Per Hr : <?php echo $s->perhr; ?></p>
                                                    <p>Total Hours : <?php echo $s->total_hours; ?></p>
                                                    <p>Rating : <?php echo $s->rating; ?></p>
                                                    <p>Address : <?php echo $s->address; ?></p>
                                                    <p>Language : <?php echo $s->language; ?></p>
                                                    <p>University : <?php echo $s->education; ?></p>
                                                    <p>Collage Name : <?php echo $s->clg_name; ?></p>
                                                    <p>Degree : <?php echo $s->degree; ?></p>
                                                    <p>Percentage : <?php echo $s->percentage; ?></p>
                                                    <p>Passing Year : <?php echo $s->passing_year; ?></p>
                                                    <p>Skills : <?php echo $s->skills; ?></p>
                                                    <p>Resume : <?php echo $s->resume; ?></p>
                                                    <p>Completed Job : <?php echo $s->completed_job; ?></p>
                                                    <p>Image : <div class="geeks"><a href="<?php echo URL::asset('public/upload/developer/'.$s->image.'') ?>" target="_blank"><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/developer/'.$s->image.'') ?>" style="height:150px"></a></div></p>
                                                    <p>Portfolio Image : <div class="geeks"><a href="<?php echo URL::asset('public/upload/portfolio/'.$s->portfolio_image.'') ?>" target="_blank"><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/portfolio/'.$s->portfolio_image.'') ?>" style="height:150px"></a></div></p>
                                                    
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal" id="myeditModal<?php echo $s->dev_id; ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Add available Date</h4>
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                     <div class="modal-body">
                                                        <form method="post" action="{{ route('developer_available_update') }}" >
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
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal" id="myBankModal<?php echo $s->dev_id; ?>">
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
                                                <?php foreach ($developer_project_details as $k) {
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
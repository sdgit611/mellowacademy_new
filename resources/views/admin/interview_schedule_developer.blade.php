@extends('admin.layout')
@section('content')

<br><br>
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Interview Schedule Resource</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body" style="overflow-x:auto;">
                        <table id="complex-header" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Resource Name</th>
                                    <th>Email & Phone</th>
                                    <th>Address</th>
                                    <th>Per hour charge</th>
                                    <th>Skills</th>
                                    <th>Client</th>
                                    <th>Interview Date&Time</th>
                                    <th>Send Interview Details</th>
                                    <th>Review</th>
                                    <th>Approval</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;
                                    foreach($interview_schedule_developer_details as $pp) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $pp->name; ?> <?php echo $pp->last_name; ?></td>
                                            <td>
                                                <?php echo $pp->email; ?>
                                                <br><?php echo $pp->phone; ?>
                                            </td>
                                            <td><?php echo $pp->address; ?></td>
                                            <td>Rating: <?php echo $pp->rating; ?>/5 
                                                <br>₹<?php echo $pp->perhr; ?>/-
                                            </td>
                                            <td><?php echo $pp->skills; ?></td>
                                            <td><a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myClientModal<?php echo $pp->dev_id; ?>" ><i class="fa fa-show"></i>Details</a></td>
                                            <td>
                                                <?php 
                                                 if( $pp->status == 'Interview Schedule' ){ 
                                                ?>
                                                
                                                <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myModal<?php echo $pp->dev_id; ?>" >
                                                    <i class="fa fa-show"></i>Details
                                                </a>
    
                                                <?php }else{ ?>
                                                
                                                <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#" >
                                                    <i class="fa fa-show"></i><?php echo $pp->schinterviewdatetime; ?>
                                                </a>
                                                
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php 
                                                 if( $pp->status == 'Interview Schedule' ){ 
                                                ?>
                                                <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#mySendModal<?php echo $pp->dev_id; ?>" >
                                                    <i class="fa fa-show"></i>Send
                                                </a>
                                                <?php }else{ ?>
                                                <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#mySendLinkModal<?php echo $pp->dev_id; ?>" >
                                                    <i class="fa fa-show"></i>View Now
                                                </a>
                                                <?php } ?>
                                            </td>
                                            <td><a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myReviewModal<?php echo $pp->dev_id; ?>" ><i class="fa fa-show"></i>View</a></td>
                                            <td>
                                                <?php 
                                                    if( $pp->status == "Qualified" ){ 
                                                   //echo "hi"; exit();
                                                ?>
                                                    <a class="btn btn-danger btn-sm" href="<?php echo route('developer_approve_status',['dev_id'=>''.$pp->dev_id.'']) ?>"><i class="fa fa-show"></i>Disapprove</a>
                                                <?php } else{ ?>
                                                    <a class="btn btn-success btn-sm" href="<?php echo route('developer_approve_status',['dev_id'=>''.$pp->dev_id.'']) ?>"><i class="fa fa-show"></i>Approve</a>
                                                <?php } ?>                                            
                                            </td>
                                        </tr>
                                        
                                        <div class="modal" id="myClientModal<?php echo $pp->dev_id; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Client Details</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            <h5 class="card-title">Full Name</h5>
                                                            <p class="card-text"><?php echo $pp->fname; ?> <?php echo $pp->lname; ?></p>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            <h5 class="card-title">Email Address</h5>
                                                            <p class="card-text"><?php echo $pp->email; ?></p>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            <h5 class="card-title">Phone Number</h5>
                                                            <p class="card-text"><?php echo $pp->phone; ?></p>
                                                          </div>
                                                        </div>
                                                    </div>
                                                
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal" id="myModal<?php echo $pp->dev_id; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Interview Date&Time Details</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            <h5 class="card-title">1st Interview Date&Time</h5>
                                                            <p class="card-text"><?php echo $pp->interviewdateone; ?></p>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            <h5 class="card-title">2nd Interview Date&Time</h5>
                                                            <p class="card-text"><?php echo $pp->interviewdatetwo; ?></p>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            <h5 class="card-title">3rd Interview Date&Time</h5>
                                                            <p class="card-text"><?php echo $pp->interviewdatethree; ?></p>
                                                          </div>
                                                        </div>
                                                    </div>
                                                
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal" id="mySendModal<?php echo $pp->dev_id; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Send Interview Link</h4>
                                                    </div>
                                                    
                                                    <form method="POST" action="{{route('send_interview_link')}}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            <h5 class="card-title">Schedule Interview Date&Time</h5>
                                                            <input type="radio" name="schinterviewdatetime" value="<?php echo $pp->interviewdateone; ?>">
                                                            <label for="Interview Date&Time"><?php echo $pp->interviewdateone; ?></label><br>
                                                            <input type="radio" name="schinterviewdatetime" value="<?php echo $pp->interviewdatetwo; ?>">
                                                            <label for="Interview Date&Time"><?php echo $pp->interviewdatetwo; ?></label><br>
                                                            <input type="radio" name="schinterviewdatetime" value="<?php echo $pp->interviewdatethree; ?>">
                                                            <label for="Interview Date&Time"><?php echo $pp->interviewdatethree; ?></label>
                                                            
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            <h5 class="card-title">Interview Link</h5>
                                                            <input type="text" name="interviewlink" class="form-control" placeholder="Interview Link">
                                                          </div>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="modal-footer">
                                                      <button type="submit" class="btn btn-primary">Send</button>
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal" id="mySendLinkModal<?php echo $pp->dev_id; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Interview Details</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            <h5 class="card-title">Interview Date&Time</h5>
                                                            <p class="card-text"><?php echo $pp->schinterviewdatetime; ?></p>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            <h5 class="card-title">Interview Link</h5>
                                                            <p class="card-text"><?php echo $pp->interviewlink; ?></p>
                                                          </div>
                                                        </div>
                                                    </div>
                                                 
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal" id="myReviewModal<?php echo $pp->dev_id; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Interview Review</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            <h5 class="card-title">Review</h5>
                                                            <p class="card-text"><?php echo $pp->review; ?></p>
                                                          </div>
                                                        </div>
                                                    </div>
                                                   
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







@endsection
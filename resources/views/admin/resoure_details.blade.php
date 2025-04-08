@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Resource Details</a></li>
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
                                    <th>Developer Full Name</th>
                                    <th>Developer Details</th>
                                    <th>Client Full Name</th>
                                    <th>Client Details</th>
                                    <th>Require Docs</th>
                                    <th>Short Message</th>
                                    <th>SOW</th>
                                </tr>
                            </thead>
	                         <tbody>
                                <?php $i=1;
                                    foreach($resoure_details as $rd) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $rd->name; ?> <?php echo $rd->last_name; ?></td>
                                            
                                            <td>
                                                <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#editModal<?php echo $rd->dev_id; ?>" >More Details</a>
                                            </td>
                                            <td><?php echo $rd->fname; ?> <?php echo $rd->lname; ?></td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $rd->u_id; ?>" >Click Here</a>
                                            </td>

                                            <td><a class="btn btn-success" href="<?php echo route('require_docs_details',['u_id'=>''.$rd->u_id.'','dev_id'=>''.$rd->dev_id.'']) ?>"><i class="fa fa-show"></i>Details</a></td>
                                            <td><a class="btn btn-success" href="<?php echo route('short_message_details',['u_id'=>''.$rd->u_id.'','dev_id'=>''.$rd->dev_id.'']) ?>"><i class="fa fa-show"></i>Details</a></td>
                                            <td><a class="btn btn-success" href="<?php echo route('sow_details',['u_id'=>''.$rd->u_id.'','dev_id'=>''.$rd->dev_id.'']) ?>"><i class="fa fa-show"></i>Details</a></td>
                                     
                                            
                                            
                                        </tr>
                                        <div class="modal" id="editModal<?php echo $rd->dev_id; ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Developer Details</h4>
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <p>  Phone : <?php echo $rd->dev_phone; ?></p>
                                                        <p> Address : <?php echo $rd->address; ?></p>
                                                        <p>  job : <?php echo $rd->job; ?></p>
                                                         <p>  Total Hours : <?php echo $rd->total_hours; ?></p>
                                                          <p>  Per Hr : <?php echo $rd->perhr; ?></p>
                                                           <p>  Rating : <?php echo $rd->rating; ?></p>
                        
                                                            <p>  Language : <?php echo $rd->language; ?></p>
                                                            <p>  Education : <?php echo $rd->education; ?></p>
                                                            <p>  Description : <?php echo $rd->description; ?></p>
                                                            <p>  Skills : <?php echo $rd->skills; ?></p>
                                                            <p>  Completed Job : <?php echo $rd->completed_job; ?></p>
                                                            <p>  Image : <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/developer/'.$rd->image.'') ?>" style="height:80px"></p>
                                                            <p>  Portfolio Image : <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/portfolio/'.$rd->portfolio_image.'') ?>" style="height:80px"></p>
                                                            <p>  Resume : <?php echo $rd->resume; ?></p>
                                                            <p>  Date : <?php echo $rd->date; ?></p>
                                                        
                                                    </div>                                               
                                                </div>
                                            </div>
                                        </div>


                                        <div class="modal" id="myeditModal<?php echo $rd->u_id; ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Client Details</h4>
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <p>  Phone : <?php echo $rd->phone; ?></p>
                                                        <p> Address : <?php echo $rd->address_one; ?></p>
                                                        <p>  Email : <?php echo $rd->email; ?></p>
                                                         <p>  Country : <?php echo $rd->country; ?></p>
                                                          <p>  State : <?php echo $rd->state; ?></p>
                                                           <p>  City : <?php echo $rd->city; ?></p>
                        
                                                            <p>  Payment Status : <?php echo $rd->payment_status; ?></p>
                                                            
                                                        
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
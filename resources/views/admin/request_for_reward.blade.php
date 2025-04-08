@extends('admin.layout')
@section('content')

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Reward</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col-lg-8 ml-auto mr-auto">
                @if(Session::has('widthdrawerrmsg'))                 
                    <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                           <strong>{{Session::get('widthdrawerrmsg')}}</strong>
                    </div>
                    {{Session::forget('message')}}
                    {{Session::forget('widthdrawerrmsg')}}
                @endif
                <br><br>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" form action="{{ url('withdraw_status_submit') }}">
                        @csrf
                            <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                                <!-- <p></p> -->
                                <!-- <a href="">Approve All</a> -->
                                <thead>
                                    <tr>
                                        <th><input  type="checkbox" id="checkAl" /> Select All<br/></th>
                                       
                                        <th>Developer Name</th>
                                        <th>Milestone Name</th>
                                        <th>Days</th>
                                        <th>Amount</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    foreach($requested_reward_details as $rd) { ?>
                                        <tr>
                                            
                                            <td> <input type="checkbox" name="milestone_id[]" value="<?php echo $rd->id; ?>"></td>
                                           
                                            <?php
                                                foreach($developer_details as $d) { 
                                                    if( $d->dev_id == $rd->dev_id ){
                                            ?>
                                                    <td><?php echo $d->name; ?> <?php echo $d->last_name; ?></td>
                                            <?php } } ?>

                                            <td><?php echo $rd->milestone_name; ?></td>
                                            <td><?php echo $rd->days; ?></td>
                                            <td>
                                                <?php
                                                    $price = $d->perhr; 
                                                    $days = $rd->days;
                                                    echo $total_price = $days * $price;
                                                ?>
                                            </td>
                                            <td><a class="btn btn-success" href="javascript:void();" data-toggle="modal" data-target="#rewardModal<?php echo $rd->id; ?>">Details</a></td>
                                            
                                            
                                        </tr>
                                         <div class="modal" id="rewardModal<?php echo $rd->id; ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Rating Details</h4>
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                    </div>
                                                    <?php
                                                        foreach($developer_rating as $dr) { 
                                                            if($dr->milestone_id == $rd->id){
                                                    ?>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="card">
                                                              <div class="card-body">
                                                                Logical Stability : <?php echo $dr->logical_stability; ?> Out Of 5
                                                              </div>
                                                            </div>  
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="card">
                                                              <div class="card-body">
                                                                Code Quality : <?php echo $dr->code_quality; ?> Out Of 5
                                                              </div>
                                                            </div>  
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="card">
                                                              <div class="card-body">
                                                                Understanding : <?php echo $dr->understanding; ?> Out Of 5
                                                              </div>
                                                            </div>  
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="card">
                                                              <div class="card-body">
                                                                Communication : <?php echo $dr->communication; ?> Out Of 5
                                                              </div>
                                                            </div>  
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="card">
                                                              <div class="card-body">
                                                                Behaviour : <?php echo $dr->behaviour; ?> Out Of 5
                                                              </div>
                                                            </div>  
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="card">
                                                              <div class="card-body">
                                                                Work Performance : <?php echo $dr->work_performance; ?> Out Of 5
                                                              </div>
                                                            </div>  
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="card">
                                                              <div class="card-body">
                                                                Delivary Review : <?php echo $dr->delivary_review; ?> Out Of 5
                                                              </div>
                                                            </div>  
                                                        </div> 
                                                    <?php } } ?>                                              
                                                </div>
                                            </div>
                                        </div>
                                    <?php 
                                    } ?>
                                </tbody>
    	                        
                            </table>
                            <?php 
                                if($total_requested_reward_details > 0){
                            ?>
                                <p align="center"><button type="submit" class="btn btn-primary">Approve</button></p>
                            <?php }else{ ?>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
       	</div>
    </div>
</div>

@endsection
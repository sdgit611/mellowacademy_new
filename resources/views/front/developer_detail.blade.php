@extends('front.layout')
@section('content')

    <section class="blog">
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 ml-auto mr-auto">
                        @if(Session::has('errmsg'))                 
                            <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                               <center> <strong>{{Session::get('errmsg')}}</strong></center> 
                            </div>
                            {{Session::forget('message')}}
                            {{Session::forget('errmsg')}}
                        @endif
                        <br>
                    </div>
                </div>

                <div class="row">
                    <?php 
                        foreach($deve as $d) { ?>
                    <div class="col-md-3">
                        <h5 class="card-title"><img src="<?php echo URL::asset('public/upload/developer/'.$d->image.'') ?>" class="test rounded-circle"></h5>
                    </div>

                    <div class="col-md-5">
                        <h5 class="card-title">
                            <div class="mb-2 mb-sm-0 ">
                                <div class="entry developerDetails" style="padding:5px;">
                                    <i class="icon icon-user"></i>
                                    <span style=""><?php echo $d->name; ?></span>
                                </div>
                                <div class="entry developerDetails" style="padding:5px;">
                                    <i class="icon icon-map-marker"></i>
                                    <span style=""><?php echo $d->address; ?></span>
                                </div>
                                <div class="entry developerDetails" style="padding:5px;">
                                    <i class="icon icon-star"></i>
                                    <span style=""><?php echo $d->rating; ?>/5</span>
                                </div>
                                
                                
                            </div>
                        </h5>
                    </div>
                   <?php } ?>

                   <div class="col-md-4">
                        <?php 
                            foreach($deve as $ddd) { 

                            if($ddd->login_status == 1){
                                if($ddd->developer_status == 'Book Now' || $ddd->developer_status == ''){
                        ?>
                            <ol class="breadcrumb">
                                <?php
                                if(empty(Session::get('user_login_id'))) { ?>
                                

                                <li class="entry"><span><a href="{{route('login')}}" class="btn btn-primary" style="width:100%;margin-left: 30px; border: 2px solid #00264d;border-radius: 25px;font-size:14px">Hire Now</a></span></li>
                                <li class="entry"><span><a href="{{ route('developer_rating_details',['dev_id'=>''.$d->dev_id.''] ) }}" style="width:100%;margin-left: 35px; border: 2px solid #77c24b;border-radius: 25px;font-size:14px" class="btn btn-danger">View More</a></span></li>
                                <?php }
                                else { ?>
                                    
                                    <?php 
                                       if($hire_dev > 0) {
                                    ?>
                                        
                                        <li><a href="{{ route('developer_rating_details',['dev_id'=>''.$d->dev_id.''] ) }}" style="width:100%;margin-left: 38px;border: 2px solid #77c24b;border-radius: 25px;font-size:14px" class="btn btn-danger">View More</a></li>
                                    <?php }else{ ?>
                                        <li><a href="{{route('developer_checkout', $d->dev_id)}}" class="btn btn-primary cart" style="width:100%;margin-left: 30px;border: 2px solid #00264d;border-radius: 25px;font-size:14px">Hire Now</a></li>
                                        <li><a href="{{ route('developer_rating_details',['dev_id'=>''.$d->dev_id.''] ) }}" style="width:100%;margin-left: 38px;border: 2px solid #77c24b;border-radius: 25px;font-size:14px" class="btn btn-danger">View More</a></li>
                                    <?php }?>

                                <?php } ?>        
                            </ol>
                        <?php }  elseif($ddd->developer_status == 'Booked') {
                        ?>
                            <ul style="display: inline-flex;width: 100%;margin-top: 24px;">
                                <li><span><a href="javascript:void(0);" class="btn btn-danger" style="margin-left: 10px;border: 2px solid #77c24b;border-radius: 25px;font-size:14px">Not Available </a></span>
                                    <?php if($ddd->available_start_date == ''){ ?>
                                       
                                    <?php }else{ ?>
                                        <p style="color:red;font-size:10px;"> Available By <?php $middle = strtotime($ddd->available_end_date); echo $new_date = date('F jS\, Y ', $middle);  ?> </p>
                                    <?php } ?>
                                </li>
                                <li><span><a href="{{ route('developer_rating_details',['dev_id'=>''.$d->dev_id.''] ) }}" style="margin-left: 10px;border: 2px solid #77c24b;border-radius: 25px;font-size:14px" class="btn btn-danger">View More</a></span></li>
                            </ul>
                       <?php } } else{ ?>
                            <ol class="breadcrumb">
                                
                                <li class="entry" style="padding: 28px;"><span><a href="" class="btn btn-warning" style="width:104px;">Deactivate</a></span></li>

                                       
                            </ol>
                       <?php } } ?>
                    </div>
                </div>
            </div>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="blog-post">
                        <?php 
                        foreach($deve as $d) { ?>
                        <div class="blog-post-content">
                            <hr/>
                            <div class="blog-post-title">
                                
                                <div class="blog-info">
                                    <div class="entry">
                                        <span>Lagnuage : <?php echo $d->language; ?></span>
                                    </div>
                                    <div class="entry">
                                        <span>Rate : <?php echo $d->perhr; ?>INR/Month</span>
                                    </div>
                                    <div class="entry">
                                        <span>Education : <?php echo $d->degree; ?></span>
                                    </div>
                                </div>
                                <hr />
                            </div>

                                                                
                        <div class="product-details"> 
                            <ul class="nav nav-pills nav-pills-flat justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-review-tab" data-toggle="tab" href="#tab-description" role="tab">
                                        Description
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-desc-tab" data-toggle="tab" href="#tab-desc" role="tab">
                                        Skills
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-desc-tab" data-toggle="tab" href="#tab-job" role="tab">
                                        Completed Job 
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="tab-description">
                                    <div class="col-md-8 offset-md-2">
                                      
                                        <div class="row">
                                            <div class="col-12">
                                               <p><?php echo $d->description; ?></p>
                                            </div>
                                        </div> 
                                    </div> 
                                </div> 

                                <div class="tab-pane fade" id="tab-desc">
                                    <div class="col-md-8 offset-md-2">
                                        
                                        <div class="row">
                                            <div class="col-12">
                                               <p><?php echo $d->skills; ?></p>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>  

                                <div class="tab-pane fade" id="tab-job">
                                    <div class="col-md-8 offset-md-2">
                                       
                                        <div class="row">
                                            <div class="col-12">
                                               <p><?php echo $d->completed_job; ?></p>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                        </div>
                               
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <!--Blog menu-->

                <div class="col-lg-4 col-md-6">
                    <aside>
                        <?php 
                        foreach($deve as $d) { ?>
                        <div class="box box-animated box-categories">
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <h5 class="title">Total Jobs</h5>
                                    <p><?php echo $d->job; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="title">Total Hours</h5>
                                    <p><?php echo $d->total_hours; ?></p>
                                </div>
                                
                            </div>
                        </div>

                        <div class="box box-animated box-posts">
                            <div class="image">
                                <img src="<?php echo URL::asset('public/upload/portfolio/'.$d->portfolio_image.'') ?>" width="100%" height="auto">
                            </div><br>
                            <center>
                                <a href="{{route('resume_download', $d->dev_id)}}" type="button" class="btn btn-danger"><i class="fa fa-download"></i>  Online Portfolio</a>
                                
                            </center>
                        </div>
                        <?php } ?>
                    </aside>
                </div>
            </div>

            <div class="row">
               
                
                <?php 
                    foreach($developer_project as $dd) { 
                ?>

                    <div class="col-md-2 show-box">
                        <div class="image">
                           <a href="<?php echo $dd->project_link; ?>" target="_blank"> <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/screenshot/'.$dd->screenshot_image.'') ?>" width="100%" height="auto"></a>
                            
                        </div>
                    </div>

                <?php } ?>

                

        </div>
    </section><br><br><br>


@endsection
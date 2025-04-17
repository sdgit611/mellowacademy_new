@extends('front.layout')
@section('content')
<br><br><br><br> <br><br>
<?php 
// echo "<pre>";
// print_r($developer_resources);
        foreach ($developer_resources as $resource) {
        if($resource->status == "Not Approved"){
?>

<div class="container bootstrap snippets bootdeys pt-0">
    <div class="row">
        <div class="col-lg-8 ml-auto mr-auto">
            @if(Session::has('schedule_errmsg'))
            <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <center><strong>{{Session::get('schedule_errmsg')}}</strong></center>
            </div>
            {{Session::forget('message')}}
            {{Session::forget('schedule_errmsg')}}
            @endif
        </div>
    </div>

    <div class="row" id="user-profile">
        <div class="col-lg-3 col-md-4 col-sm-4">
            <div class="main-box clearfix">
                <h2><?php echo $resource->name; ?> <?php echo $resource->last_name; ?></h2>
                <div class="profile-status">
                    <i class="fa fa-star"></i> <span> <?php echo $resource->rating; ?>/5</span>
                </div>

                <img src="<?php echo URL::asset('public/upload/developer/'.$resource->image.'') ?>" alt=""
                    class="profile-img img-responsive center-block">
                <div class="profile-label">
                    <span class="label btn-success"> <?php echo $resource->perhr; ?> INR / Month.</span>
                </div>

                <div class="profile-details">
                    <ul class="fa-ul">
                        <li><i class="fa-li fa fa-language"></i> Language:
                            <span><?php echo $resource->language; ?></span>
                        </li>
                        <li><i class="fa-li fa fa-edit"></i>Education: <span><?php echo $resource->degree; ?></span>
                        </li>
                        <li><i class="fa-li fa fa-tasks"></i>Total Jobs: <span><?php echo $resource->job; ?></span></li>
                    </ul>
                </div>

            </div>
        </div>
        <?php 
            $id= Session::get('dev_id');
            $dev_id =Session::put('dev_id', $resource->dev_id);
        ?>

        <input type="hidden" class="form-control" name="dev_id" value="<?php echo $resource->dev_id; ?>"
            placeholder="Subject" required="">
        <!-- Flatpickr CSS & JS ====================-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <!-- Toastr CSS & JS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <div class="col-lg-9 col-md-8 col-sm-8">
            <div class="main-box clearfix">
                <div class="profile-header">
                    <h3><span>Interview Schedule</span></h3>
                </div>

                <div class="row profile-user-info">
                    <div class="col-sm-12">
                        @if ($resource->available_start_date && $resource->available_end_date)
                        <label><b><span class="text-secondary">Select an Interview Date & Time</span>:</b> <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="interview_calendar" placeholder="Pick a date/time"
                            readonly>
                        <small class="text-muted">Please select your preferred interview slot.</small>
                        <input type="hidden" id="interviewdateone">
                        @else
                        <div class="alert alert-warning mt-3">
                            <strong>Note:</strong> Interview scheduling is currently unavailable for this candidate.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="scheduleForm" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Interview Slot</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="dev_id" value="{{ $resource->dev_id }}">
                            <input type="hidden" name="interviewdateone" id="modal_interview_date">
                            <input type="text" name="email" value="{{ $resource->email }}" class="form-control"
                                required>
                            <input type="hidden" name="name" value="{{ $resource->name }}" class="form-control"
                                required>

                            <!-- <div class="form-group">
                                <label class="text-secondary">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required>
                                <div class="text-danger" id="error-name"></div>
                            </div>

                            <div class="form-group">
                                <label class="text-secondary">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required>
                                <div class="text-danger" id="error-email"></div>
                            </div> -->
                            <div class="form-group">
                                <label class="text-secondary">From Time <span class="text-danger">*</span></label>
                                <input type="time" name="from_time" class="form-control" required>
                                <div class="text-danger" id="error-email"></div>
                            </div>
                            <div class="form-group">
                                <label class="text-secondary">To Time <span class="text-danger">*</span></label>
                                <input type="time" name="to_time" class="form-control" required>
                                <div class="text-danger" id="error-email"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Confirm Slot</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end interview select date section ====================-->
    </div>

</div>
<?php }elseif( $resource->status == "Scheduled" ){ ?>
    <div class="container bootstrap snippets bootdeys pt-0">
    <div class="row">
        <div class="col-lg-8 ml-auto mr-auto">
            @if(Session::has('schedule_errmsg'))
                <div class="alert alert-{{ Session::get('message') }} alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <center><strong>{{ Session::get('schedule_errmsg') }}</strong></center>
                </div>
                {{ Session::forget('message') }}
                {{ Session::forget('schedule_errmsg') }}
            @endif
        </div>
    </div>

    @foreach ($developer_resourcesche as $resource)
    <div class="row" id="user-profile">
        <div class="col-lg-3 col-md-4 col-sm-4">
            <div class="main-box clearfix">
                <h2>{{ $resource->name }} {{ $resource->last_name }}</h2>
                <div class="profile-status">
                    <i class="fa fa-star"></i> <span>{{ $resource->rating }}/5</span>
                </div>
                <img src="{{ asset('public/upload/developer/' . $resource->image) }}" class="profile-img img-responsive center-block" alt="">
                <div class="profile-label">
                    <span class="label btn-success">{{ $resource->perhr }} INR / Month</span>
                </div>
                <div class="profile-details">
                    <ul class="fa-ul">
                        <li><i class="fa-li fa fa-language"></i> Language: <span>{{ $resource->language }}</span></li>
                        <li><i class="fa-li fa fa-edit"></i> Education: <span>{{ $resource->degree }}</span></li>
                        <li><i class="fa-li fa fa-tasks"></i> Total Jobs: <span>{{ $resource->job }}</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-8 col-sm-8">
            <div class="main-box clearfix">
                <div class="profile-header">
                    <h3><span>Interview Review</span></h3>
                </div>

                <div class="row profile-user-info">
                    <div class="col-sm-12">
                        <ul class="fa-ul text-secondary">
                            <li><i class="fa-li fa fa-link"></i> Interview Link: 👉 
                                <a href="{{ $resource->interviewlink }}" class="text-primary" target="_blank">{{ $resource->interviewlink }}</a>
                            </li>
                            <li><i class="fa-li fa fa-calendar"></i> Date: <span>{{ $resource->date }}</span></li>
                            <li><i class="fa-li fa fa-clock"></i> Start Time: <span>{{ $resource->interviewdatetwo }}</span></li>
                            <li><i class="fa-li fa fa-clock"></i> End Time: <span>{{ $resource->interviewdatethree }}</span></li>
                        </ul>

                        <div class="text-right">
                            <!-- Trigger Button -->
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#feedbackModal{{ $resource->dev_id }}">Feedback</button>
                        </div>

                        <!-- Feedback Modal -->
                        <div class="modal fade" id="feedbackModal{{ $resource->dev_id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $resource->dev_id }}" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="modalLabel{{ $resource->dev_id }}">Interview Feedback</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form method="POST" action="{{ route('schedule_interview_qualified') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="dev_id" value="{{ $resource->dev_id }}">

                                            <div class="form-group mb-2">
                                                <label><b>Status:</b></label>
                                                <select class="form-control form-control-sm" name="status" required>
                                                    <option value="">-- Select --</option>
                                                    <option value="Qualified">Qualified</option>
                                                    <option value="Disqualified">Disqualified</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <small class="text-danger">{{ $errors->first('status') }}</small>
                                                @endif
                                            </div>

                                            <div class="form-group mb-2">
                                                <label><b>Review:</b></label>
                                                <textarea class="form-control form-control-sm" name="review" placeholder="Write your feedback..." required></textarea>
                                                @if ($errors->has('review'))
                                                    <small class="text-danger">{{ $errors->first('review') }}</small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success btn-sm">Send</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<?php }elseif( $resource->status == "Qualified" ){ ?>
<div class="container bootstrap snippets bootdeys pt-0">
    <div class="row">
        <div class="col-lg-8 ml-auto mr-auto">
            @if(Session::has('schedule_errmsg'))
            <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <center><strong>{{Session::get('schedule_errmsg')}}</strong></center>
            </div>
            {{Session::forget('message')}}
            {{Session::forget('schedule_errmsg')}}
            @endif
        </div>
    </div>
    <?php 
                foreach ($developer_resourcequl as $resource) {
                 
              ?>
    <div class="row" id="user-profile">
        <div class="col-lg-3 col-md-4 col-sm-4">
            <div class="main-box clearfix">
                <h2><?php echo $resource->name; ?> <?php echo $resource->last_name; ?></h2>
                <div class="profile-status">
                    <i class="fa fa-star"></i> <span> <?php echo $resource->rating; ?>/5</span>
                </div>

                <img src="<?php echo URL::asset('public/upload/developer/'.$resource->image.'') ?>" alt=""
                    class="profile-img img-responsive center-block">
                <div class="profile-label">
                    <span class="label btn-success"> <?php echo $resource->perhr; ?> INR / Month.</span>
                </div>

                <div class="profile-details">
                    <ul class="fa-ul">
                        <li><i class="fa-li fa fa-language"></i> Language:
                            <span><?php echo $resource->language; ?></span>
                        </li>
                        <li><i class="fa-li fa fa-edit"></i>Education: <span><?php echo $resource->degree; ?></span>
                        </li>
                        <li><i class="fa-li fa fa-tasks"></i>Total Jobs: <span><?php echo $resource->job; ?></span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="col-lg-9 col-md-8 col-sm-8">
            <div class="main-box clearfix">
                <div class="profile-header">
                    <h3><span>You are successfully submitted your request!</span></h3>
                    <!--<a class="btn btn-success btn-sm" href="{{ url('why_qualified_advance',['dev_id'=>''.$resource->dev_id.'']) }}" >Pay Now <i class="fa fa-edit"></i></a>-->
                </div>
            </div>
        </div>
    </div>


    <?php } ?>
</div>
<?php }elseif( $resource->status == "1" ){ ?>
<div class="container bootstrap snippets bootdeys pt-0">
    <div class="row">
        <div class="col-lg-8 ml-auto mr-auto">
            @if(Session::has('require_docs_errmsg'))
            <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <center><strong>{{Session::get('require_docs_errmsg')}}</strong></center>
            </div>
            {{Session::forget('message')}}
            {{Session::forget('require_docs_errmsg')}}
            @endif
        </div>
    </div>
    <!--< ?php -->
    <!--foreach ($developer_resourceappr as $resource) {-->
    <!--?>-->
    <div class="row" id="user-profile">
        <div class="col-lg-3 col-md-4 col-sm-4">
            <div class="main-box clearfix">
                <h2><?php echo $resource->name; ?> <?php echo $resource->last_name; ?></h2>
                <div class="profile-status">
                    <i class="fa fa-star"></i> <span> <?php echo $resource->rating; ?>/5</span>
                </div>

                <img src="<?php echo URL::asset('public/upload/developer/'.$resource->image.'') ?>" alt=""
                    class="profile-img img-responsive center-block">
                <div class="profile-label">
                    <span class="label btn-success"> <?php echo $resource->perhr; ?> INR / Month.</span>
                </div>

                <div class="profile-details">
                    <ul class="fa-ul">
                        <li><i class="fa-li fa fa-language"></i> Language:
                            <span><?php echo $resource->language; ?></span>
                        </li>
                        <li><i class="fa-li fa fa-edit"></i>Education: <span><?php echo $resource->degree; ?></span>
                        </li>
                        <li><i class="fa-li fa fa-tasks"></i>Total Jobs: <span><?php echo $resource->job; ?></span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="col-lg-9 col-md-8 col-sm-8">
            <div class="main-box clearfix">
                <div class="profile-header">
                    <h6><span>Pay For Upfront Token money For enable access with Developer.No Need to worry. Your
                            Security Money is Save with us.</span></h6>
                    <a class="btn btn-success btn-sm"
                        href="{{ url('why_qualified_advance',['dev_id'=>''.$resource->dev_id.'']) }}">Pay Now <i
                            class="fa fa-edit"></i></a>
                </div>
            </div>
        </div>

    </div>
    <!--< ?php } ?>-->
</div>
<?php }elseif( $resource->status == "2" ){ ?>
<div class="container bootstrap snippets bootdeys pt-0">
    <div class="row">
        <div class="col-lg-8 ml-auto mr-auto">
            @if(Session::has('require_docs_errmsg'))
            <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <center><strong>{{Session::get('require_docs_errmsg')}}</strong></center>
            </div>
            {{Session::forget('message')}}
            {{Session::forget('require_docs_errmsg')}}
            @endif
        </div>
    </div>
    <!--< ?php -->
    <!--foreach ($developer_resourceappr as $resource) {-->
    <!--?>-->
    <div class="row" id="user-profile">
        <div class="col-lg-3 col-md-4 col-sm-4">
            <div class="main-box clearfix">
                <h2><?php echo $resource->name; ?> <?php echo $resource->last_name; ?></h2>
                <div class="profile-status">
                    <i class="fa fa-star"></i> <span> <?php echo $resource->rating; ?>/5</span>
                </div>

                <img src="<?php echo URL::asset('public/upload/developer/'.$resource->image.'') ?>" alt=""
                    class="profile-img img-responsive center-block">
                <div class="profile-label">
                    <span class="label btn-success"> <?php echo $resource->perhr; ?> INR / Month.</span>
                </div>

                <div class="profile-details">
                    <ul class="fa-ul">
                        <li><i class="fa-li fa fa-language"></i> Language:
                            <span><?php echo $resource->language; ?></span>
                        </li>
                        <li><i class="fa-li fa fa-edit"></i>Education: <span><?php echo $resource->degree; ?></span>
                        </li>
                        <li><i class="fa-li fa fa-tasks"></i>Total Jobs: <span><?php echo $resource->job; ?></span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="col-lg-9 col-md-8 col-sm-8">
            <div class="main-box clearfix">
                <div class="profile-header">
                    <h3><span>Developer Information</span></h3>

                    <?php
                                    // $date = Carbon::now();
                                    // $date2 = $resource->qdate;
                                    // $interval = $date->diff($date2);
                                    // $days = $interval->format('%a');
                                    
                                    // $date = Carbon::createFromFormat('Y.m.d', $resource->qdate);
                                    // $daysToAdd = 20;
                                    // $date = $date->addDays($daysToAdd);
                                    // dd($date);
                                    
                                    $datetime1  = Carbon\Carbon::now();
                                    //echo $datetime1;exit();
                                    $datetime2 = $resource->qdate;
                                    
                                    $interval = $datetime1->diff($datetime2);
                                    $days = $interval->format('%a');
                                    $dueDate = 20-$days;
                                   //echo $dueDate; exit();
                                    //$interval = date_diff($datetime1, $datetime2);
                                ?>
                    <b style="color:#800000;">Due Days <?php echo $days; ?> Left</b>
                    <br>
                    <a class="btn btn-success btn-sm"
                        href="{{ url('why_qualified_advance',['dev_id'=>''.$resource->dev_id.'']) }}">Pay Now <i
                            class="fa fa-edit"></i></a>
                </div>

                <div class="row profile-user-info">
                    <?php 
                                foreach($sow_details as $k) {
                                    if($k->dev_id == $resource->dev_id){
                                        if($k->sow_status == '1'){
                                        ?>
                    <div class="col-sm-4">
                        <a href="javascript:void(0);" class="btn btn-success" data-toggle="modal"
                            data-target="#createMilestone<?php echo $resource->dev_id; ?>">
                            <i class="fa fa-clipboard"></i> Create Milestone
                        </a>
                    </div>
                    <?php } } } ?>
                </div>

                <div class="tabs-wrapper profile-tabs">

                    <ul class="nav nav-tabs">
                        <li><a href="#tab-chat<?php echo $resource->dev_id; ?>" data-toggle="tab">SOW</a></li>
                        <li><a href="#tab-activity<?php echo $resource->dev_id; ?>" data-toggle="tab">Require
                                Docs</a>
                        </li>
                        <li><a href="#tab-friends<?php echo $resource->dev_id; ?>" data-toggle="tab">Short
                                Message</a>
                        </li>
                    </ul>
                    <!--< ?php  -->
                    <!--    $resdp=array();-->
                    <!--     foreach($premium_profile_details as $resd){-->
                    <!--        $resdp = $resd->payment_status; -->
                    <!--        if($resource->dev_id== $resd->dev_id && $resd->payment_status == "SUCCESS") { -->

                    <!--?>-->
                    <div class="tab-content">

                        <div class="tab-pane fade in" id="tab-activity<?php echo $resource->dev_id; ?>">

                            <div class="conversation-new-message">
                                <form method="post" action="{{route('submit_require_docs')}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <?php 
                                                                        $id= Session::get('dev_id');
                                                                        //echo $resource->dev_id; exit();
                                                                        $dev_id =Session::put('dev_id', $resource->dev_id);
                                                ?>

                                    <input type="hidden" class="form-control" name="dev_id"
                                        value="<?php echo $resource->dev_id; ?>" placeholder="Subject" required="">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" id="subject"
                                            placeholder="Subject" required="">
                                        @if ($errors->has('subject'))
                                        <strong class="text-danger">{{ $errors->first('subject') }}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="require_docs" id="require_docs"
                                            required="">
                                        @if ($errors->has('require_docs'))
                                        <strong class="text-danger">{{ $errors->first('require_docs') }}</strong>
                                        @endif
                                    </div>
                                    <div class="clearfix">
                                        <button type="submit" class="btn btn-success pull-right">Send
                                            message</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-friends<?php echo $resource->dev_id; ?>">

                            <div class="conversation-wrapper">

                                <div class="conversation-new-message">
                                    <form method="post" action="{{route('submit_short_message')}}">
                                        @csrf
                                        <input type="hidden" class="form-control" name="dev_id"
                                            value="<?php echo $resource->dev_id; ?>" placeholder="Subject" required="">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" id="subject"
                                                placeholder="Subject" required="">
                                            @if ($errors->has('subject'))
                                            <strong class="text-danger">{{ $errors->first('subject') }}</strong>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <textarea type="text" class="ckeditor" name="description" id="description"
                                                placeholder="Enter Description" required=""></textarea>
                                            @if ($errors->has('description'))
                                            <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                            @endif
                                        </div>

                                        <div class="clearfix">
                                            <button type="submit" class="btn btn-success pull-right">Send
                                                message</button>
                                        </div>
                                    </form>
                                </div>


                            </div>

                        </div>

                        <div class="tab-pane fade active show" id="tab-chat<?php echo $resource->dev_id; ?>">
                            <div class="conversation-wrapper">
                                <!--<div class="conversation-content">
                                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 340px;">
                                                    <div class="conversation-inner" style="overflow: hidden; width: auto; height: 340px;">

                                                        <div class="conversation-item item-left clearfix">
                                                            <div class="conversation-user">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-responsive"  alt="">
                                                            </div>
                                                            <div class="conversation-body">
                                                                <div class="name">
                                                                    Ryan Gossling
                                                                </div>
                                                                <div class="time hidden-xs">
                                                                    September 21, 2013 18:28
                                                                </div>
                                                                <div class="text">
                                                                    I don't think they tried to market it to the billionaire, spelunking, base-jumping crowd.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-item item-right clearfix">
                                                            <div class="conversation-user">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-responsive"  alt="">
                                                            </div>
                                                            <div class="conversation-body">
                                                                <div class="name">
                                                                    Mila Kunis
                                                                </div>
                                                                <div class="time hidden-xs">
                                                                    September 21, 2013 12:45
                                                                </div>
                                                                <div class="text">
                                                                    Normally, both your asses would be dead as fucking fried chicken, but you happen to pull this shit while I'm in a transitional period so I don't wanna kill you, I wanna help you.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-item item-right clearfix">
                                                            <div class="conversation-user">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-responsive"  alt="">
                                                            </div>
                                                            <div class="conversation-body">
                                                                <div class="name">
                                                                    Mila Kunis
                                                                </div>
                                                                <div class="time hidden-xs">
                                                                    September 21, 2013 12:45
                                                                </div>
                                                                <div class="text">
                                                                    Normally, both your asses would be dead as fucking fried chicken, but you happen to pull this shit while I'm in a transitional period so I don't wanna kill you, I wanna help you.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-item item-left clearfix">
                                                            <div class="conversation-user">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-responsive"  alt="">
                                                            </div>
                                                            <div class="conversation-body">
                                                                <div class="name">
                                                                    Ryan Gossling
                                                                </div>
                                                                <div class="time hidden-xs">
                                                                    September 21, 2013 18:28
                                                                </div>
                                                                <div class="text">
                                                                    I don't think they tried to market it to the billionaire, spelunking, base-jumping crowd.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-item item-right clearfix">
                                                            <div class="conversation-user">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-responsive"  alt="">
                                                            </div>
                                                            <div class="conversation-body">
                                                                <div class="name">
                                                                    Mila Kunis
                                                                </div>
                                                                <div class="time hidden-xs">
                                                                    September 21, 2013 12:45
                                                                </div>
                                                                <div class="text">
                                                                    Normally, both your asses would be dead as fucking fried chicken, but you happen to pull this shit while I'm in a transitional period so I don't wanna kill you, I wanna help you.
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div>
                                                    <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div>
                                                </div>
                                            </div>-->

                                <div class="conversation-new-message">
                                    <form method="post" action="{{route('submit_sow_docs')}}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" class="form-control" name="dev_id"
                                            value="<?php echo $resource->dev_id; ?>" placeholder="Subject" required="">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" id="subject"
                                                placeholder="Subject" required="">
                                            @if ($errors->has('subject'))
                                            <strong class="text-danger">{{ $errors->first('subject') }}</strong>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <input type="file" class="form-control" name="sow_docs" id="sow_docs"
                                                required="">
                                            @if ($errors->has('sow_docs'))
                                            <strong class="text-danger">{{ $errors->first('sow_docs') }}</strong>
                                            @endif
                                        </div>

                                        <div class="clearfix">
                                            <button type="submit" class="btn btn-success pull-right">Send
                                                message</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--< ?php }elseif(!($resource != $resd)){ ?>-->
                    <!--<br><br>-->
                    <!--<b style="color: #ffb100;">Pay For Upfront Token money For enable access with Developer.No Need to worry. Your Security Money is  Save with us.</b> -->
                    <!--<a class="btn btn-success btn-sm" href="{{ url('why_qualified_advance',['dev_id'=>''.$resource->dev_id.'']) }}" >Pay Now <i class="fa fa-edit"></i></a>     -->
                    <!--<br><br><a class="btn btn-success btn-sm" href="{{ url('why_qualified_advance',['dev_id'=>''.$resource->dev_id.'']) }}" >Pay For Advance <i class="fa fa-edit"></i></a>-->
                    <!--<a class="btn btn-success btn-sm" href="{{ url('why_qualified_advance',['dev_id'=>''.$resource->dev_id.'']) }}" >Upgrade Now <i class="fa fa-edit"></i></a>-->
                    <!--< ?php }}?>-->

                </div>

                <div class="modal" id="createMilestone<?php echo $resource->dev_id; ?>">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="row">
                                <div class="col-lg-8 ml-auto mr-auto">
                                    @if(Session::has('freemsg'))
                                    <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>{{Session::get('freemsg')}}</strong>
                                    </div>
                                    {{Session::forget('message')}}
                                    {{Session::forget('freemsg')}}
                                    @endif
                                </div>
                            </div>

                            <div class="modal-body">
                                <h6 style="color:black;text-transform: capitalize;font-size:12px">Create Milestone
                                    For,
                                    <?php echo $resource->name; ?> <?php echo $resource->last_name; ?> <b
                                        style="color:blue;font-size:15px"><i class="fa fa-certificate"></i></b></h6>
                                <button type="button" style="float:right;margin-top:-43px;"
                                    class="btn btn-sm btn-danger" data-dismiss="modal">X</button>
                                <hr>
                                <?php 
                                                        foreach($sow_details as $k) {
                                                            if($k->dev_id == $resource->dev_id){ ?>
                                <form method="post" action="{{ route('submit_milestone') }}" runat="server"
                                    onsubmit="ShowLoading()" enctype="multipart/form-data">
                                    @csrf


                                    <input type="hidden" class="form-control" name="sow_id"
                                        value="<?php echo $k->id; ?>" placeholder="Subject" required="">

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="project_name">Milestone
                                            Name:</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="milestone_name"
                                                id="milestone_name" placeholder="Enter Milestone Name" required="">
                                            @if ($errors->has('milestone_name'))
                                            <strong class="text-danger">{{ $errors->first('milestone_name') }}</strong>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="project_price">Days : </label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" name="days" id="days"
                                                placeholder="Enter Days" required="">
                                            @if ($errors->has('days'))
                                            <strong class="text-danger">{{ $errors->first('days') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="milestone_pdf">Choose PDF :
                                        </label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" name="milestone_pdf"
                                                id="milestone_pdf" required="">
                                            @if ($errors->has('milestone_pdf'))
                                            <strong class="text-danger">{{ $errors->first('milestone_pdf') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="project_duration">Work
                                            Description :
                                        </label>
                                        <div class="col-sm-12">
                                            <textarea type="text" rows="4" cols="50" class="form-control" name="work"
                                                id="work" placeholder="Enter Work" required=""></textarea>
                                            @if ($errors->has('work'))
                                            <strong class="text-danger">{{ $errors->first('work') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-12">
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </div>
                                </form>
                                <?php } } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--< ?php } ?>-->
</div>
<?php }}  ?>
@if(!empty($resource))
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Get today's date in Y-m-d format
    let today = new Date().toISOString().split("T")[0];

    // Compare today's date with developer's available_start_date
    let minDate = "{{ $resource->available_start_date }}";
    let maxDate = "{{ $resource->available_end_date }}";

    // Ensure minDate is not in the past
    if (minDate < today) {
        minDate = today;
    }

    flatpickr("#interview_calendar", {
        enableTime: true,
        dateFormat: "Y-m-d\\TH:i",
        minDate: minDate,
        maxDate: maxDate,
        onChange: function (selectedDates) {
            if (selectedDates.length > 0) {
                let selected = selectedDates[0].toISOString().slice(0, 16);
                document.getElementById('interviewdateone').value = selected;
                document.getElementById('modal_interview_date').value = selected;
                $('#scheduleModal').modal('show');
            }
        }
    });

    $('#scheduleForm').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = form.serialize();

        $('#error-name').text('');
        $('#error-email').text('');

        $.ajax({
            url: "{{ route('schedule_interview_resource') }}",
            type: "POST",
            data: formData,
            success: function (response) {
                $('#scheduleModal').modal('hide');
                toastr.success('Interview scheduled successfully!');
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.name) $('#error-name').text(errors.name[0]);
                    if (errors.email) $('#error-email').text(errors.email[0]);
                } else {
                    toastr.error('Something went wrong. Please try again.');
                }
            }
        });
    });
});
</script>
@endif
@endsection
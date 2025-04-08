@extends('front.layout')
@section('content')

<section class="icons-category">
    <?php 
        if($order_details_empty > 0 || $dev_order_details_empty > 0 ) { ?>
            <header>
                <div class="container">
                    <h5 class="title">All Invoice Details</h5>
                </div>
            </header>
            
            <br>
            
            <div class="container">
                <div class="row">
                    <div class="col-md-3" style="padding-bottom:12px;">
                        <div class="sticky-top">
                            <div class="card">
                                <?php 
                                $id=Session::get('user_login_id');
                                foreach($user_details as $uu) { 
                                    if($id === $uu->id) { ?>
                                    <div class="card-header">
                                        <a href="#">Hi!  <?php echo $uu->fname;?></a>
                                    </div>
                                <?php }
                                } ?>

                                <div class="list-group">
                                    <a href="{{route('user_profile')}}" class="list-group-item"><i class="fa fa-user" aria-hidden="true"></i>   My Profile <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{route('my_download')}}" class="list-group-item"><i class="fa fa-download" aria-hidden="true"></i>    Downloads <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{route('act_setting')}}" class="list-group-item"><i class="fa fa-gear" aria-hidden="true"></i>    Account Settings <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{route('show_invoice')}}" class="list-group-item"><i class="fa fa-yelp" aria-hidden="true"></i>   Invoice <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    
                                    <?php 
                                    if($developer_order_details > 0) {
                                    ?>
                                        <a href="{{route('client_dashboard')}}" class="list-group-item"><i class="fa fa-plus" aria-hidden="true"></i>   Work Space <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <a href="{{route('resource')}}" class="list-group-item"><i class="fa fa-child" aria-hidden="true"></i>   Resource <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <a href="{{route('assign_work')}}" class="list-group-item"><i class="fa fa-suitcase" aria-hidden="true"></i>    Assign Work <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <?php } ?>
                                    <a href="{{route('user_logout')}}" class="list-group-item"><i class="fa fa-sign-out" aria-hidden="true"></i>    Logout <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                           <?php 
                                $id= Session::get('user_login_id');
                                foreach($order_details as $order) { 
                                if($id == $order->u_id) { ?>
                                <div class="col-6 col-md-4">
                                    <a href="#">
                                        <figure>
                                            <div>
                                              Order Id: <?php echo $order->order_id; ?></div>
                                              <div>
                                              Order Date: <?php echo $order->date; ?>
                                            </div>
                                            <figcaption><a href="{{route('invoice', $order->order_id)}}" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-eye"></i></a></figcaption>
                                            <div>
                                              Payment Status :<b style="color:#77c24b;"> <?php echo $order->payment_status; ?> </b>
                                            </div>
                                        </figure>
                                    </a>
                                </div>
                            <?php  } 
                            } ?> 
                            
                          <!--  <?php 
                                $id= Session::get('user_login_id');
                                foreach($dev_order_details as $dev_order) { 
                                if($id == $dev_order->u_id) { ?>
                                <div class="col-6 col-md-4">
                                    <a href="#">
                                        <figure>
                                            <div>
                                              Order Id: <?php echo $dev_order->order_id; ?></div>
                                              <div>
                                              Order Date: <?php echo $dev_order->date; ?>
                                            </div>
                                            <figcaption><a href="{{route('dev_invoice', $dev_order->order_id)}}" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-eye"></i></a></figcaption>
                                            <div>
                                              Payment Status :<b style="color:#77c24b;"> <?php echo $dev_order->status; ?> </b>
                                            </div>
                                        </figure>
                                    </a>
                                </div>
                            <?php  } 
                            } ?>   -->                
                        </div>
                    </div> 
                </div>
            </div>
    <?php }
    else { ?>
    <div class="container">            
            <div class="cart-wrapper">
                <div class="row">
                    <div class="col-md-3">
                    <div class="sticky-top">
                        <div class="card">
                            <?php 
                            $id=Session::get('user_login_id');
                            foreach($user_details as $uu) { 
                                if($id === $uu->id) { ?>
                                <div class="card-header">
                                    <a href="#">Hi!  <?php echo $uu->fname;?></a>
                                </div>
                            <?php }
                            } ?>

                            <div class="list-group">
                                <a href="{{route('user_profile')}}" class="list-group-item"><i class="fa fa-user" aria-hidden="true"></i>   My Profile <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <a href="{{route('my_download')}}" class="list-group-item"><i class="fa fa-download" aria-hidden="true"></i>    Downloads <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <a href="{{route('act_setting')}}" class="list-group-item"><i class="fa fa-gear" aria-hidden="true"></i>    Account Settings <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <a href="{{route('show_invoice')}}" class="list-group-item"><i class="fa fa-yelp" aria-hidden="true"></i>   Invoice <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                
                                <?php 
                                    if($developer_order_details > 0) {
                                ?>
                                    <a href="{{route('client_dashboard')}}" class="list-group-item"><i class="fa fa-plus" aria-hidden="true"></i>   Work Space <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{route('resource')}}" class="list-group-item"><i class="fa fa-child" aria-hidden="true"></i>   Resource <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{route('assign_work')}}" class="list-group-item"><i class="fa fa-suitcase" aria-hidden="true"></i>    Assign Work <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <?php } ?>
                                <a href="{{route('user_logout')}}" class="list-group-item"><i class="fa fa-sign-out" aria-hidden="true"></i>    Logout <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        </div>
                   
                </div>
                    <div class="col-md-9">
                       <center> <h5><img src="{{ URL::asset('public/front/assets/images/2.png') }}" class="rounded-circle" width="310px" height="250px"></h5>
                        <h4 class="card-title">There are no Elements here!</h4>
                        <small class="card-title">Start adding your Elements</small>
                        <hr style="width:550px;">
                        <a class="btn btn-primary btn-lg" href="{{route('index')}}" role="button">Continue    <i class="fa fa-arrow-right"></i></a> 
                        </center> 
                    </div>
                </div> 
            </div>
        </div> 
    <?php } ?> 
</section>
 @endsection
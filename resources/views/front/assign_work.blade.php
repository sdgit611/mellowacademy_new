@extends('front.layout')

@section('content')



<section class="blog blog-category blog-animated">

    <?php 

        if($dev_order_details_empty > 0 ) { ?>

        

           <br>



            <header>

                <div class="container">

                    <h2 class="title">Developer Details</h2>

                </div>

            </header>

            

          

             <div class="container">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="clearfix">

                           <?php 

                            $id= Session::get('user_login_id');

                            foreach($dev_order_details as $dev_order) { 

                                if($id == $dev_order->u_id ) { ?>

                                <article class="article-table">

                                    <div class="row">

                                        <div class="col-md-4">

                                            <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/developer/'.$dev_order->image.'') ?>" style="height:200px; width:60%">

                                        </div>

                                        <div class="col-md-4 text" >

                                            <div class="title" style="padding-top:0px;">

                                                <h2 class="h5"><?php echo $dev_order->name; ?><br><br>

                                                   ( <?php echo $dev_order->rating; ?>/5 )

                                                </h2>

                                               <?php foreach($profession as $p) {

                                                if($dev_order->pro_id === $p->id ) {

                                                

                                                ?>

                                            <?php echo $p->heading; ?>



                                               <?php } } ?>

                                            </div>

                                        </div>

                                        <div class="col-md-4 text">

                                            <div class="text-intro">

                                                <a href="{{route('assign_work_details',$dev_order->dev_id)}}" class="btn btn-danger"> Initiate For Work <i class="fa fa-angle-right"></i></a>

                                            </div>

                                        </div>

                                    </div>

                                </article>

                            <?php  } 

                            } ?>

                        </div>

                    </div>                 

                </div> 

            </div>

      

    <?php }

    else { ?>



        <div class="container">  

        <br><br><br><br>          

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

                                    <!-- <a href="{{route('add_work_space')}}" class="list-group-item"><i class="fa fa-plus" aria-hidden="true"></i>   Add Work Space <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->

                                    <a href="{{route('resource')}}" class="list-group-item"><i class="fa fa-child" aria-hidden="true"></i>   Resource <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                                    <a href="{{route('assign_work')}}" class="list-group-item"><i class="fa fa-suitcase" aria-hidden="true"></i>    Assign Work <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                                    <a href="{{route('user_logout')}}" class="list-group-item"><i class="fa fa-sign-out" aria-hidden="true"></i>    Logout <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                                </div>

                            </div>

                        </div>

                                      

                </div>

                    <div class="col-md-9">

                       <center> <h5><img src="{{ URL::asset('public/front/assets/images/2.png') }}" class="rounded-circle" width="310px" height="250px"></h5>

                        <h4 class="card-title">Oops! Your Assigning Work Not Available.</h4>

                        <hr style="width:550px;">

                        <a class="btn btn-primary btn-lg" href="{{route('index')}}" role="button">Go    <i class="fa fa-arrow-right"></i></a> 

                        </center> 

                    </div>

                </div> 

            </div>

        </div> 



    <?php } ?>

</section>

 @endsection
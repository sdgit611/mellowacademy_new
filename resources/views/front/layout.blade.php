<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Mobile Web-app fullscreen -->

    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="mobile-web-app-capable" content="yes">

    <!-- Meta tags -->

    <meta name="keywords" content="Search Job, IT jobs, IT company vacancy, jobs vacancy, hire employee, hire IT employee, hire freelancer, remote jobs, hiring near me, freelance jobs, find a job, online jobs from home, job openings near me, job opportunities, mern developer jobs, mean developer jobs, flutter developer jobs, .net developer jobs, laravel developer jobs, job vacancy near me, job websites, experience jobs, fresher jobs, job sites, IT recruitment" />

    <meta name="description" content="Mellow Elements- Creating robust Eco-system For Employment and Delivering Fastest Code Blocks.Software and Employement Serices, IT Jobs, Hiring Reosurce, MEAN, MERN, Laraval Devleopers, PHP Framworks Developers.">

    <meta name="author" content="Mellow Corporation, Seminator Infosystem Pvt Ltd.">

    <link rel="icon" href="{{ URL::asset('public/front/assets/images/Logo-01.png') }}">



    <!--Title-->

    <title>Mellow Elements- Creating robust Eco-system For Employment and Delivering Fastest Code Blocks</title>

    <!--CSS bundle -->

    <link rel="stylesheet" media="all" href="{{ URL::asset('public/front/css/bootstrap.css') }}" />

    <link rel="stylesheet" media="all" href="{{ URL::asset('public/front/css/animate.css') }}" />

    <link rel="stylesheet" media="all" href="{{ URL::asset('public/front/css/font-awesome.css') }}" />

    <link rel="stylesheet" media="all" href="{{ URL::asset('public/front/css/ion-range-slider.css') }}" />

    <link rel="stylesheet" media="all" href="{{ URL::asset('public/front/css/linear-icons.css') }}" />

    <link rel="stylesheet" media="all" href="{{ URL::asset('public/front/css/magnific-popup.css') }}" />

    <link rel="stylesheet" media="all" href="{{ URL::asset('public/front/css/owl.carousel.css') }}" />

    <link rel="stylesheet" media="all" href="{{ URL::asset('public/front/css/theme.css') }}" />



    <!--New-->

    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ URL::asset('public/front/zoom/css/swiper.min.css') }}" />

    <link rel="stylesheet" href="{{ URL::asset('public/front/zoom/css/easyzoom.css') }}" />

    <link rel="stylesheet" href="{{ URL::asset('public/front/zoom/css/main.css') }}" />





    <!--Google fonts-->

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>-->

    

    <style>



        .grid {

          display: flex;

          flex-direction: row;

          /*width: 80%;*/

          width: 30%;

          /*padding-top: 30px;*/

        }



        .row img {

          /*padding-bottom: 15px;*/

          border-radius: 6px;

          max-width: 100%;

          /*margin-left: 25px;*/

        }

        

        

        #urchoice {

          margin: 60px;

        }



        #urchoice input {

          width: 200px;

          line-height: 50px;

          font-size: 1em;

          text-align: center;

          border-radius: 3px;

          border: 1px solid #1a1b21;

          background-color: #1a1b21;

          color: #aaa;

        }

        

        

    </style>



</head>

<body>

    <!--<div class="page-loader">

        <div class="spinner-border" role="status">

            <span class="sr-only">Loading...</span>

        </div>

    </div>-->



    <div class="wrapper">

        <nav>

            <div class="container">

                <a href="{{route('index')}}" class="logo">

                    <?php 

                        foreach ($web_details as $w) { ?>



                        <img src="<?php echo URL::asset('public/upload/header/'.$w->header_logo.'') ?>" alt=""  width="100" height="100"/>

                   

                    <?php } ?>

                </a>

                <div class="navigation navigation-top clearfix">

                    <ul>

                        <li class="left-side">

                            <a href="{{route('index')}}" class="logo-icon">

                                <?php 

                                    foreach ($web_details as $w) { ?>

                                        <img src="<?php echo URL::asset('public/upload/header/'.$w->header_logo.'') ?>" alt="Alternate Text" width="120" height="80" style="padding-top: 10px;"/>

                                <?php } ?>

                            </a>

                        </li>

                        <li class="search-side"> 

                            <a class="search-side"> 

                                <div class="box box-search">

                                    <form method="post" action="{{route('search')}}"> 

                                     @csrf

                                        <input type="text" name="usersearch" class="form-control" placeholder="Search the product" onkeyup="showResult(this.value)" required/>



                                        <button type="submit" class="btn btn-outline-dark btn-sm">Search now</button>

                                        

                                    </form>

                                    <ol id="autosearchResult" style="background-color:white;z-index: 1030;position: fixed;left: 193px;width: 27%;line-height:30px;list-style-type: none;font-size:13px;">

                                 

                                    </ol>

                                   

                                </div>

                                

                            </a>

                           

                        </li>
                        <li class="left-side">
                            <a href="{{env('URL').'/account/jobs'}}" style="font-size: 16px;">Advance filter</a>
                        </li>

                       <?php

                        if(empty(Session::get('user_login_id'))) { ?>

                            <li class="left-side">

                                <a href="{{route('higher_professional')}}" style="font-size: 16px;">Hire Now</a>

                            </li>

                            <li class="left-side">

                                <a href="javascript:void(0);" class="btn btn-main" data-toggle="modal" data-target="#myModal1" style="padding:0px 10px 10px 10px;font-size: 15px;">Get Free Consultation</a>

                            </li>

                            <li>

                                <a href="{{route('contact')}}" class="btn btn-main" style="left:-24%;font-size: 15px; top: -3px;">24*7 Support</a>

                            </li>

                            <li>

                                <div class="cardss">

                                    <div class="contentss"><a href="{{route('developer_registration')}}" style="color: #fff;">Login Resource</a></div>

                                </div>

                                

                            </li>

                            <li>

                                <a href="javascript:void(0);" class="open-login" style="font-size: 19px;"><span><i class="icon icon-user"></i></span></a>

                            </li>

                        <?php }

                        else { 

                            $id=Session::get('user_login_id');

                            foreach($user_details as $uu) { 

                            if($id === $uu->id) { ?>

                            <li class="left-side">

                                <a href="{{route('higher_professional')}}" style="font-size: 13px;">Hire Now</a>

                            </li>

                            <li class="left-side">

                                <a href="javascript:void(0);" class="btn btn-main" data-toggle="modal" data-target="#myModal1" style="padding:0px 10px 10px 10px;font-size: 13px;">Get Free Consultation</a>

                            </li>

                            <li>

                                <a href="{{route('contact')}}" class="btn btn-main" style="left: -17%; font-size: 16px; top: -1px;">24*7 Support</a>

                            </li>

                            <li><a href="javascript:void(0);" class="open-login"><span> Hello, <?php echo $uu->fname; ?>  <i class="icon icon-user"></i></span></a></li>



                         <?php } } } ?>



                        <?php

                        if(empty(Session::get('user_login_id'))) { ?>

                            <li><a href="javascript:void(0);" class="open-cart-logout"><i class="icon icon-cart"></i> <span class="cart_value" style="color:white;">0</span></a></li>

                        <?php }

                        else { ?>

                            <li><a href="javascript:void(0);" class="open-cart"><i class="icon icon-cart"></i> <span class="cart_value" style="color:white;"><?php echo $cart_value; ?></span></a></li>

                        <?php } ?>

                    </ul>

                </div>



                <div class="navigation navigation-main">

                    <a  class="open-search"><i class="icon icon-magnifier"></i></a>

                    <a  class="open-login"><i class="icon icon-user"></i></a>

                    <?php

                    if(empty(Session::get('user_login_id'))) { ?>

                       <a href="javascript:void(0);" class="open-cart-logout"><i class="icon icon-cart"></i> <span class="cart_value" style="color:white;">0</span></a>

                        

                    <?php }

                    else { ?>

                        <a href="javascript:void(0);" class="open-cart"><i class="icon icon-cart"></i> <span class="cart_value" style="color:white;"><?php echo $cart_value; ?></span></a>

                    <?php } ?>

                    <a href="#" class="open-menu"><i class="icon icon-menu"></i></a>



                    <div class="floating-menu">

                        <div class="close-menu-wrapper">

                            <span class="close-menu"><i class="icon icon-cross"></i></span>

                        </div>

                        <ul>

                            

                        <li>

                                    <a href="#">Development & IT <span class="open-dropdown"></span></a>

                                    <?php 

                                    foreach($higher_professional as $hp) {

                                            $urll = route('dev_details',['id'=>''.$hp->id.'']);

                                    ?>

                                            <div class="navbar-dropdown navbar-dropdown-single">

                                                <div class="navbar-box">

                                                    <div class="box-full">

                                                        <div class="box clearfix">

                                                            <ul>

                                                                <?php 

                                                                foreach($higher_professional as $hp) {

                                                                        $urll = route('dev_details',['id'=>''.$hp->id.'']); ?>

                                                                        <li><a href="<?php echo $urll; ?>"><?php echo $hp->heading; ?></a></li>

                                                                        

                                                                <?php } ?> 

                                                                

                                                            </ul>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                    <?php } ?>                

                        </li>

                        

                        <?php 

                            foreach($category as $d) {

                                $url = route('product',['id'=>''.$d->id.'']); ?>

                                <li>

                                    <a href="<?php echo $url; ?>"><?php echo $d->name; ?> <span class="open-dropdown"></span></a>

                                    <?php 

                                    foreach($subcategorys as $scate) { 

                                        if($d->id === $scate->category_id) { 

                                            $urll = route('subproduct',['id'=>''.$scate->id.'']); ?>

                                            <div class="navbar-dropdown navbar-dropdown-single">

                                                <div class="navbar-box">

                                                    <div class="box-full">

                                                        <div class="box clearfix">

                                                            <ul>

                                                                <?php 

                                                                foreach($subcategorys as $scate) { 

                                                                    if($d->id === $scate->category_id) { 

                                                                        $urll = route('subproduct',['id'=>''.$scate->id.'']); ?>

                                                                        <li><a href="<?php echo $urll; ?>"><?php echo $scate->name; ?></a></li>

                                                                        

                                                                <?php }

                                                                } ?> 

                                                                <li><a href="<?php echo $url; ?>">All <?php echo $d->name; ?> <i class="icon icon-arrow-right"></i></a></li>

                                                            </ul>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                    <?php }

                                    } ?>                

                                </li>





                        <?php } ?>

      

                        <li><a href="{{ route('aboutus') }}">About Company</a></li>



                        <li><a href="{{route('higher_professional')}}" class="menures" style="font-size: 13px;">Hire Now</a></li>



                        <li><a href="javascript:void(0);" class="menures" data-toggle="modal" data-target="#myModal1">Get Free Consultation</a></li>

                       

                        <li><a href="{{route('developer_registration')}}" class="menures">Login Resource</a></li>

                      

                        </ul>

                    </div>

                </div>

                <div class="search-wrapper">

                    



                    <form method="post" action="{{route('search')}}"> 

                        @csrf

                        <input name="usersearch" class="form-control" placeholder="Search..." onkeyup="showResult(this.value)" required=""/>

                        <button type="submit" class="btn btn-outline-dark btn-sm">Search now</button>

                        

                    </form>

                     <ol  id="autosearchResults" style="background-color:white;z-index: 1030;position: fixed;height:auto;width:100%;list-style-type: none;line-height:30px;font-size:13px;">

                              

                     </ol>

                 

                </div>

                 

                <?php

                    if(empty(Session::get('user_login_id'))) { ?>

                        <div class="login-wrapper">

                            <div class="row">

                                <div class="col-md-12 ml-auto mr-auto">

                                    @if(Session::has('loginerrmsgs'))                 

                                        <div class="alert alert-{{Session::get('message')}} alert-dismissible">

                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  

                                               <strong>{{Session::get('loginerrmsgs')}}</strong>

                                        </div>

                                        {{Session::forget('message')}}

                                        {{Session::forget('loginerrmsgs')}}

                                    @endif

                                </div>

                            </div>

                            <div class="h5">Sign in</div>

                            <form method="post" action="{{route('verify_login')}}">

                                @csrf

                                <div class="form-group">

                                    <input type="text" class="form-control" id="exampleInputEmail1" name="phone" placeholder="Mobile Number / Email Address">

                                    @if ($errors->has('phone'))

                                        <strong class="text-danger">{{ $errors->first('phone') }}</strong>                                   

                                    @endif

                                </div>

                                <div class="form-group">

                                    <input type="password" class="form-control" id="showpassword" name="password" placeholder="Password">

                                    @if ($errors->has('password'))

                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>                                   

                                    @endif

                                </div>

                                

                                    

                                

                                <div class="form-group">

                                    <input type="checkbox" onclick="showFunction()">Show Password<br>

                                    <a href="{{route('forgetpassword')}}" class="open-popup btn btn-main btn-sm">Forgot password?</a><br>

                                    <a href="{{route('registration')}}" class="open-popup btn btn-main btn-sm">Don't have an account?</a>

                                </div>

                                <button type="submit" class="btn btn-block btn-outline-primary">Submit</button>

                            </form>

                        </div>

                <?php }

                else { ?>

                   <div class="login-wrapper">

                        <ul>

                            <div class="row">

                                <div class="col-md-12 ml-auto mr-auto">

                                    @if(Session::has('loginerrmsg'))                 

                                        <div class="alert alert-{{Session::get('message')}} alert-dismissible">

                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  

                                               <strong>{{Session::get('loginerrmsg')}}</strong>

                                        </div>

                                        {{Session::forget('message')}}

                                        {{Session::forget('loginerrmsg')}}

                                    @endif

                                </div>

                            </div>

                        <?php 

                        $id=Session::get('user_login_id');

                        foreach($user_details as $uu) { 

                            if($id === $uu->id) {

                        ?>

                            <li><a href="#">Hi!  <?php echo $uu->fname;?></a></li>

                        <?php } }?>

                            <li><a href="{{route('user_profile')}}"><i class="fa fa-user" aria-hidden="true"></i>   My Profile</a></li>

                            <!-- <li><a href="{{route('user_profile')}}"><i class="fa fa-user" aria-hidden="true"></i>   My Profile</a></li> -->

                            <li><a href="{{route('my_download')}}"><i class="fa fa-download" aria-hidden="true"></i>    Downloads</a></li>

                            <li><a href="{{route('act_setting')}}"><i class="fa fa-gear" aria-hidden="true"></i>    Account Settings</a></li>

                            <li><a href="{{route('show_invoice')}}"><i class="fa fa-yelp" aria-hidden="true"></i>   Invoice</a></li>



                            <?php 

                                if($developer_order_details > 0) {

                               

                            ?>

                                <li><a href="{{route('client_dashboard')}}" target="_blank"><i class="fa fa-plus" aria-hidden="true"></i>  Work Space</a></li>

                                <li><a href="{{route('resource')}}"><i class="fa fa-child" aria-hidden="true"></i>   Resource</a></li>

                                <li><a href="{{route('assign_work')}}"><i class="fa fa-suitcase" aria-hidden="true"></i>   Assign Work</a></li>

                            <?php } ?>





                            <li><a href="{{route('user_logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>    Logout</a></li>

                        </ul>

                    </div> 

                <?php 

                } ?>



                <?php

                   if($cart_empty > 0) { ?>  

                

                    <div class="cart-wrapper">

                    <div class="checkout">

                        <div class="clearfix">

                            <!-- <div class="row">

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

                            </div> -->

                            <div class="row">

                                <?php 

                                $id= Session::get('user_login_id');

                                $tprice=0;

                                $tax=0;

                                foreach($cart_details as $cart) { 

                                    if($id == $cart->u_id )

                                    {

                                    $p_id=$cart->id;

                                    $tax+=$cart->tax;

                                    $tprice+=$cart->price;

                                    session(['p_id' => $p_id]);

                                    session(['tprice' => $tprice]);

                                    session(['tax' => $tax]);

                                    $url = route('product_details',['id'=>''.$cart->id.'']);

                                    

                                    ?>

                                    <div class="cart-block cart-block-item clearfix">

                                        <?php if($cart->image == ''){ ?>

                                            <div class="image">

                                                <a href="<?php echo $url; ?>"><video width="50" height="50" controls controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();" ><source class="embed-responsive-item" src="<?php echo URL::asset('public/upload/video/'.$cart->video.'') ?>" type="video/mp4" allowfullscreen></video></a>

                                                 <div></div>

                                            </div>

                                        <?php }else{ ?>



                                            <div class="image">

                                                <a href="<?php echo $url; ?>"><img src="<?php echo URL::asset('public/upload/product/'.$cart->image);?>" alt="image"></a>

                                                 <div></div>

                                            </div>

                                        <?php } ?>

                                        <div class="title">

                                            <div>

                                                <a href="<?php echo $url; ?>"><?php echo $cart->name; ?></a>

                                                 <div></div>

                                            </div>

                                        </div>



                                        <a></a>

                                         

                                        <div class="quantity">

                                            <div>

                                              INR <?php echo $cart->price; ?> 

                                            </div>

                                        </div>



                                        

                                        

                                        <!--delete-this-item-->

                                        <a href="<?php echo route('delete_cart',['id'=>''.$cart->id.'']) ?>"><span class="icon icon-cross icon-delete"></span></a>

                                    </div>

                                <?php }

                                } ?>

                            </div>

                            <hr />

                            <div class="clearfix">

                                <div class="cart-block cart-block-footer clearfix">

                                    <div>

                                        <strong>Total Price</strong>

                                    </div>

                                    <div>

                                        <div class="h4 title">INR {{$tprice}}</div>

                                    </div>



                                </div>

                            </div>



                            <div class="clearfix">

                                <div class="cart-block cart-block-footer clearfix">

                                    <div>

                                        <a href="{{route('proceed_to_checkout')}}" class="btn btn-outline-warning"><span class="icon icon-cart"></span> Checkout</a>

                                    </div>

                                    <div>

                                       <a href="{{route('cart')}}" class="btn btn-outline-warning"><span class="icon icon-store"></span>  View Cart</a>

                                    </div>



                                </div>

                            </div>

                            

                            <!-- <div class="cart-block-buttons clearfix">

                                <div class="row">

                                    <div class="col-md-6">

                                        <a href="{{route('proceed_to_checkout')}}" class="btn btn-outline-warning"><span class="icon icon-cart"></span> Checkout</a>

                                    </div>

                                    <div class="col-md-6">

                                        <a href="{{route('cart')}}" class="btn btn-outline-warning"><span class="icon icon-store"></span>  View Cart</a>

                                    </div>

                                </div>

                            </div> -->

                        </div>

                   </div>

                </div>

                <?php }  

                else {

                     ?>

                     <div class="cart-wrapper">

                       <!--  <div class="row">

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

                            </div> -->

                        <div class="row">

                            <div class="col-md-12">

                                <center> 

                                    <h5><img src="https://i.imgur.com/dCdflKN.png" class="rounded-circle" width="50px" height="50px"></h5>

                                    <strong class="card-title">Your cart is currently empty.</strong><br>

                                    <small>Looks like you haven't added anything to your cart yet.</small>

                                    <h5>Thank You!</h5>

                                    <hr style="width:520px;">

                                    <a class="btn btn-primary btn-lg" href="{{route('index')}}" role="button">CONTINUE SHOPPING</a> 

                                </center> 

                            </div>

                        </div> 

                    </div>

                <?php }  ?>

            </div>

        </nav>  



        <div class="modal" id="myModal1">

            <div class="modal-dialog modal-md">

                <div class="modal-content">

                    <div class="row">

                        <div class="col-lg-8 ml-auto mr-auto">

                            @if(Session::has('freemsg'))                 

                                <div class="alert alert-{{Session::get('message')}} alert-dismissible">

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  

                                       <strong>{{Session::get('freemsg')}}</strong>

                                </div>

                                {{Session::forget('message')}}

                                {{Session::forget('freemsg')}}

                            @endif

                        </div>

                    </div>

                    <div class="modal-body">

                        <h4 style="color:black;">SUPPORT</h4>

                        <button type="button" style="float:right;margin-top:-43px;" class="btn btn-sm btn-danger" data-dismiss="modal">X</button>                                           

                           <hr>

                            <form  method="post" action="{{route('free_consultation')}}" runat="server" onsubmit="ShowLoading()">

                            @csrf

                              <div class="form-group">

                                <label class="control-label col-sm-12" for="email">Email:</label>

                                <div class="col-sm-12">

                                  <input type="email" class="form-control" name="email" placeholder="Enter email" required="">

                                  @if ($errors->has('email'))

                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>                                   

                                    @endif

                                </div>

                              </div>



                              <div class="form-group">

                                <label class="control-label col-sm-12" for="pwd">Subject:</label>

                                <div class="col-sm-12">

                                  <input type="text" class="form-control" name="subject" placeholder="Enter Subject" required="">

                                  @if ($errors->has('subject'))

                                    <strong class="text-danger">{{ $errors->first('subject') }}</strong>                                   

                                    @endif

                                </div>

                              </div>





                               <div class="form-group">

                                <label class="control-label col-sm-12" for="pwd">Services:</label>

                                <div class="col-sm-12">

                                    <select name="service" id="service" class="form-control" required>

                                      <option value="">Choose Services</option>

                                      <option value="Website Development Consultant">Website Development Consultant</option>

                                      <option value="Mobile App Development Consultant">Mobile App Development Consultant</option>

                                      <option value="Technology Consultant">Technology Consultant</option>

                                      <option value="Business Consultant">Business Consultant</option>

                                      <option value="Web Designing Consultant">Web Designing Consultant</option>

                                      <option value="Prototype Consultant">Prototype Consultant</option>

                                      <option value="Digital Marketing Consultant">Digital Marketing Consultant</option>

                                    </select>



                                </div>

                              </div>





                              <div class="form-group">

                                <label class="control-label col-sm-12" for="pwd">Message:</label>

                                <div class="col-sm-12">

                                  <textarea class="form-control" name="message" placeholder="Type a message" rows="5" required=""></textarea>

                                  @if ($errors->has('message'))

                                    <strong class="text-danger">{{ $errors->first('message') }}</strong>                                   

                                    @endif

                                </div>

                              </div>

                              <hr>

                              <div class="form-group">

                                <div class="col-sm-offset-2 col-sm-12">

                                  <button type="submit" class="btn btn-primary">Submit</button>

                                </div>

                              </div>



                            </form> 

                    </div>

                </div>

            </div>

        </div>     

        @yield('content')



        <footer>

            <div class="container-fluid">

                <div class="footer-wrap">

                    <div class="container">

                        <div class="footer-links">

                            <div class="row">

                                <div class="col-md-2">

                                    <h5>Browse by</h5>

                                    <ul>

                                        <?php $i=1;

                                        foreach($category as $m) {

                                        $url = route('product',['id'=>''.$m->id.'']); ?>

                                            <li><a href="<?php echo $url; ?>"><?php echo $m->name; ?></a></li>

                                        <?php

                                        if ($i++ == 5) break;

                                        } ?>

                                    </ul>

                                </div>

                                <div class="col-md-2">

                                    <h5>Meet Elements</h5>

                                    <ul>

                                        <li><a href="{{route('aboutus')}}">About Us</a></li>

                                        <li><a href="{{route('contact')}}">Contact Us</a></li>

                                        <li><a href="{{route('faq')}}">FAQs</a></li>

                                        <li><a href="{{route('blogs')}}">Blogs</a></li>

                                        <li><a href="{{route('commercial_license')}}">License</a></li>

                                        <li><a href="{{route('developer_registration')}}" target="_blank">Become a Professional</a></li>

                                    </ul>

                                </div>

                                <div class="col-md-2">

                                    <h5>Quick links</h5>

                                    <ul>

                                        

                                        <li><a href="{{route('refund_policy')}}">Refund Policy</a></li>

                                        <li><a href="{{route('privacy')}}">Privacy Policy</a></li>

                                        <li><a href="{{route('term')}}">Terms & Conditions</a></li>

                                        

                                    </ul>

                                    <!--<?php

                                    if(empty(Session::get('user_login_id'))) { ?>

                                        <ul>

                                            <li><a href="#">Order Status </a></li>

                                            <li><a href="#">Order History</a></li>

                                            <li><a href="#">Download</a></li>

                                        </ul>

                                    <?php } else { ?>

                                        <ul>

                                            <li><a href="{{route('show_invoice')}}">Order Status </a></li>

                                            <li><a href="{{route('order_history')}}">Order History</a></li>

                                            <li><a href="{{route('my_download')}}">Download</a></li>

                                        </ul>

                                    <?php } ?>-->

                                </div>



                                <div class="col-md-2" style="right:10px">

                                    <?php 

                                    foreach ($web_details as $w) { ?>

                                        <img src="<?php echo URL::asset('public/upload/footer/'.$w->footer_logo.'') ?>" alt="" width="170" height="110" style="top: 0px; position: relative;" />

                                    <?php } ?>  

                                </div>

                                

                                <div class="col-md-3">

                                    <h3 class="search-key"><a href="{{route('higher_professional')}}">Search Job | IT jobs | IT company vacancy | Jobs vacancy | Hire employee | Hire IT employee | Hire freelancer | Remote jobs | Hiring near me | Freelance jobs | Find a job | Online jobs from home | Job openings near me | Job opportunities | Mern developer jobs | Mean developer jobs | Flutter developer jobs | .net developer jobs | Laravel developer jobs | Job vacancy near me | Job websites | Experience jobs | Fresher jobs | Job sites | IT recruitment</a></h3>

                                    <h5>Sign up for our newsletter</h5>

                                    <p style="color:#fff">Enter Your Email To Getting Notified About Our Promotional Offers.</p>

                                    <div class="row">

                                        <div class="col-md-12 ml-auto mr-auto">

                                            @if(Session::has('storeerrmsg'))                 

                                                <div class="alert alert-{{Session::get('message')}} alert-dismissible">

                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  

                                                    <small>{{Session::get('storeerrmsg')}}</small>

                                                </div>

                                                {{Session::forget('message')}}

                                                {{Session::forget('storeerrmsg')}}

                                            @endif

                                        </div>

                                    </div>

                                    <form class="form-inline" method="post" action="{{route('store')}}">

                                     @csrf

                                        <div class="form-group form-newsletter" style="width:100%">

                                            <input class="form-control" type="text" name="email" value="" placeholder="Email address" />

                                            <button type="submit" class="btn btn-secondary btn-sm">Subscribe</button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                        <div class="footer-social">

                            <div class="row">

                                <div class="col-sm-6">

                                    <a href="#" onclick="window.open('https://www.sitelock.com/verify.php?site=mellowelements.in','SiteLock','width=600,height=600,left=160,top=170');" ><img class="img-fluid" alt="SiteLock" title="SiteLock" src="https://shield.sitelock.com/shield/mellowelements.in" /></a><br>

                                    <a href="#" target="_blank" style="color:#fff"> Copyright © 2021. All Right Reserved.(A Unit of Seminator Infosystem PVT. LTD.)</a>

                                    

                                    <!--<h1  class="title" href="{{route('higher_professional')}}"  style="color:#fff"> Search Job | IT jobs | IT Company Vacancy | Jobs vacancy | Hire employee | Hire IT employee | Hire Freelancer |Remote Jobs | Hiring Near Me |Freelance Jobs | Find A Job Online Jobs From Home | Job Openings near me | Job opportunities | Mern developer Jobs | Mean Developer jobs | Flutter Developer jobs | .Net Developer jobs | Laravel developer jobs | Job Vacancy ear me | Job websites | Experience jobs | Fresher Jobs | Job sites | IT recruitment</a>-->

                                </div>

                                <div class="col-sm-6 links">

                                    <ul>

                                        <?php 

                                        foreach ($web_details as $w) { ?>

                                            <li><a href="<?php echo $w->fb; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>

                                            <li><a href="<?php echo $w->insta; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>

                                            <li><a href="<?php echo $w->linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>

                                            <li><a href="<?php echo $w->twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>

                                        <?php } ?> 

                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



           

            <!--<div class="fabs">

                <div class="chat">

                    <div class="chat_header">

                        <div class="chat_option">

                            <div class="header_img">

                                <img src="http://res.cloudinary.com/dqvwa7vpe/image/upload/v1496415051/avatar_ma6vug.jpg"/>

                            </div>

                            <span id="chat_head">Chat With Admin</span>

                            <span id="chat_fullscreen_loader" class="chat_fullscreen_loader"><i class="fullscreen zmdi zmdi-window-maximize"></i></span>

                        </div>

                    </div>

                    <div class="chat_body chat_login chat_conversion chat_converse">

                        

                        <span class="chat_msg_item chat_msg_item_admin">

                            

                            Hey there! Any question?

                            

                        </span>

                    </div>



                    

                    <div class="fab_field">

                        <a id="fab_send" class="fab send-msg"><i class="fa fa-send chat_messages"></i></a>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >

                        <textarea id="message" name="message" placeholder="Send a message" class="chat_field chat_message"></textarea>

                    </div>

                </div>

                <a id="prime" class="fab"><i class="prime fa fa-comment"></i></a>

            </div>-->

            

            

        </footer>

        

        

        

  <!--      <div id="smart-button-container">-->

  <!--  <div style="text-align: center"><label for="description">PAID FOR </label><input type="text" name="descriptionInput" id="description" maxlength="127" value=""></div>-->

  <!--    <p id="descriptionError" style="visibility: hidden; color:red; text-align: center;">Please enter a description</p>-->

  <!--  <div style="text-align: center"><label for="amount">AMOUNT </label><input name="amountInput" type="number" id="amount" value="" ><span> USD</span></div>-->

  <!--    <p id="priceLabelError" style="visibility: hidden; color:red; text-align: center;">Please enter a price</p>-->

  <!--  <div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid">REMARKS </label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" value="" ></div>-->

  <!--    <p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p>-->

  <!--  <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>-->

  <!--</div>-->

  <script src="https://www.paypal.com/sdk/js?client-id=AQ8F1m6Dq1F23aIp8mBATsqIHppHq2aXGSOTMx3qfBXl0OprO3moI-EOk-cK51qxVF2lbTmtGneOnKC-&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>

  <script>

  function initPayPalButton() {

    var description = document.querySelector('#smart-button-container #description');

    var amount = document.querySelector('#smart-button-container #amount');

    var descriptionError = document.querySelector('#smart-button-container #descriptionError');

    var priceError = document.querySelector('#smart-button-container #priceLabelError');

    var invoiceid = document.querySelector('#smart-button-container #invoiceid');

    var invoiceidError = document.querySelector('#smart-button-container #invoiceidError');

    var invoiceidDiv = document.querySelector('#smart-button-container #invoiceidDiv');



    var elArr = [description, amount];



    if (invoiceidDiv.firstChild.innerHTML.length > 1) {

      invoiceidDiv.style.display = "block";

    }



    var purchase_units = [];

    purchase_units[0] = {};

    purchase_units[0].amount = {};



    function validate(event) {

      return event.value.length > 0;

    }



    paypal.Buttons({

      style: {

        color: 'blue',

        shape: 'rect',

        label: 'paypal',

        layout: 'vertical',

        

      },



      onInit: function (data, actions) {

        actions.disable();



        if(invoiceidDiv.style.display === "block") {

          elArr.push(invoiceid);

        }



        elArr.forEach(function (item) {

          item.addEventListener('keyup', function (event) {

            var result = elArr.every(validate);

            if (result) {

              actions.enable();

            } else {

              actions.disable();

            }

          });

        });

      },



      onClick: function () {

        if (description.value.length < 1) {

          descriptionError.style.visibility = "visible";

        } else {

          descriptionError.style.visibility = "hidden";

        }



        if (amount.value.length < 1) {

          priceError.style.visibility = "visible";

        } else {

          priceError.style.visibility = "hidden";

        }



        if (invoiceid.value.length < 1 && invoiceidDiv.style.display === "block") {

          invoiceidError.style.visibility = "visible";

        } else {

          invoiceidError.style.visibility = "hidden";

        }



        purchase_units[0].description = description.value;

        purchase_units[0].amount.value = amount.value;



        if(invoiceid.value !== '') {

          purchase_units[0].invoice_id = invoiceid.value;

        }

      },



      createOrder: function (data, actions) {

        return actions.order.create({

          purchase_units: purchase_units,

        });

      },



      onApprove: function (data, actions) {

        return actions.order.capture().then(function (orderData) {



          // Full available details

          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));



          // Show a success message within this page, e.g.

          const element = document.getElementById('paypal-button-container');

          element.innerHTML = '';

          element.innerHTML = '<h3>Thank you for your payment!</h3>';



          // Or go to another URL:  actions.redirect('thank_you.html');

          

        });

      },



      onError: function (err) {

        console.log(err);

      }

    }).render('#paypal-button-container');

  }

  initPayPalButton();

  </script>

        

    </div> 

   

    <script src="{{ URL::asset('public/front/js/bootstrap.js') }}"></script>

    <script src="{{ URL::asset('public/front/js/ion.rangeSlider.js') }}"></script>

    <script src="{{ URL::asset('public/front/js/magnific-popup.js') }}"></script>

    <script src="{{ URL::asset('public/front/js/owl.carousel.js') }}"></script>

    <script src="{{ URL::asset('public/front/js/tilt.jquery.js') }}"></script>

    <script src="{{ URL::asset('public/front/js/jquery.easypiechart.js') }}"></script>

    <script src="{{ URL::asset('public/front/js/bigtext.js') }}"></script>

    <script src="{{ URL::asset('public/front/js/main.js') }}"></script>



  <!--New-->

    <script src="{{ URL::asset('public/front/zoom/js/swiper.min.js') }}"></script>

    <script src="{{ URL::asset('public/front/zoom/js/easyzoom.js') }}"></script>

    <script src="{{ URL::asset('public/front/zoom/js/main.js') }}"></script>



    <script src="{{URL::asset('public/front/ckeditor/ckeditor.js')}}" type="text/javascript"></script>

    <script> CKEDITOR.replace( 'description' );</script>



    <script type="text/javascript">

        function showResult(usersearch){

            var usersearch = usersearch;

            

            var v_token = "{{csrf_token()}}";

            $.ajax({

                type:"POST",

                url:"{{route('autosearch')}}",

                data: {usersearch:usersearch,_token:v_token},

                success: function(response){

                    //alert(response);

                  //location.reload();

                  $('#autosearchResult').html(response); 

                  $('#autosearchResults').html(response); 

                }

            });

        }

    </script>





    <script>

        $('body').on('click','.add_to_cart',function()

        {

            var p_id = $(this).attr('value');

            var v_token = "{{csrf_token()}}";

            $.ajax(

            {

                type: "POST",

                async: false,

                url: "{{route('add_to_cart')}}",

                data: {p_id:p_id,_token:v_token},

                cache: false,           

                success: function(response)

                {               

                  console.log(response); 

                  $('.cart_value').text(response); 

                  location.reload();  

                },

                error: function (response) 

                {

                    console.log('Error:', response);

                }

            })

        }); 

        </script> 



        <script>

        $('body').on('click','.cart',function()

        {

            var dev_id = $(this).attr('value');

            var v_token = "{{csrf_token()}}";

            $.ajax(

            {

                type: "POST",

                async: false,

                url: "{{route('cart')}}",

                data: {dev_id:dev_id,_token:v_token},

                cache: false,           

                success: function(response)

                {               

                  console.log(response); 

                  $('.total_cart').text(response); 

                  location.reload(); 

                },

                error: function (response) 

                {

                    console.log('Error:', response);

                }

            })

        }); 

        </script> 



        <script type="text/javascript">

            function showFunction() {

              var x = document.getElementById("showpassword");

              if (x.type === "password") {

                x.type = "text";

              } else {

                x.type = "password";

              }

            }

        </script>



<script type="text/javascript">

            function myFunction() {

              var x = document.getElementById("myInputpassword");

              if (x.type === "password") {

                x.type = "text";

              } else {

                x.type = "password";

              }

            }

        </script>







<script>

 

     $('body').on('click','.send-msg',function(){

        

        var message = $('#message').val();

        var v_token = "{{csrf_token()}}";



        $.ajax({

            type:"POST",

            async: false,

            url: "{{route('submit_chat')}}",

            data: {message:message,_token:v_token},

            cache: false,

            success:function(data)

            {

                alert("Message send"); 

                 location.reload(); 

              

            }

        });

    });

</script> 







<script>

  const export2Pdf = async () => {

 

    let printHideClass = document.querySelectorAll('.print-hide');

    printHideClass.forEach(item => item.style.display = 'none');

    await fetch('http://localhost:81/export-pdf', {

      method: 'GET'

    }).then(response => {

      if (response.ok) {

        response.json().then(response => {

          var link = document.createElement('a');

          link.href = response;

          link.click();

          printHideClass.forEach(item => item.style.display='');

        });

      }

    }).catch(error => console.log(error));

  }

</script>





<script type="text/javascript">

$(document).ready(function() {

    var readURL = function(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();



            reader.onload = function (e) {

                $('.profile-pic').attr('src', e.target.result);

            }

    

            reader.readAsDataURL(input.files[0]);

        }

    }

    $(".file-upload").on('change', function(){

        readURL(this);

    });

    

    $(".upload-button").on('click', function() {

       $(".file-upload").click();

    });

});

</script>





<script type="text/javascript">

    function ShowLoading(e) {

    var div = document.createElement('div');

    var img = document.createElement('img');

    img.src = '{{URL::asset("public/front/tickkk.gif")}}';

    div.innerHTML = "Loading...<br />";

    div.style.cssText = 'position: fixed; top: 25%; left: 40%; z-index: 5000; width: 300px; text-align: center;';

    div.appendChild(img);

    document.body.appendChild(div);

    return true;

    

    }

</script>





<script>

    $(document).ready(function() {

        $('#purpose').on('change', function() {

            var purpose = $('#purpose').val();

            var v_token = "{{csrf_token()}}";

        

            $.ajax({

                type:"POST",

                url: "{{route('user_profile_show')}}",

                data:{purpose:purpose,_token:v_token},

                success:function(data)

                {

                    $('#user_purpose').html(data); 

                }

            });

        });

    });

</script>



<script type="text/javascript">



hideChat(0);



$('#prime').click(function() {

  toggleFab();

});





//Toggle chat and links

function toggleFab() {

  $('.prime').toggleClass('zmdi-comment-outline');

  $('.prime').toggleClass('zmdi-close');

  $('.prime').toggleClass('is-active');

  $('.prime').toggleClass('is-visible');

  $('#prime').toggleClass('is-float');

  $('.chat').toggleClass('is-visible');

  $('.fab').toggleClass('is-visible');

  

}



  $('#chat_first_screen').click(function(e) {

        hideChat(1);

  });



  $('#chat_second_screen').click(function(e) {

        hideChat(2);

  });





  $('#chat_fullscreen_loader').click(function(e) {

      $('.fullscreen').toggleClass('zmdi-window-maximize');

      $('.fullscreen').toggleClass('zmdi-window-restore');

      $('.chat').toggleClass('chat_fullscreen');

      $('.fab').toggleClass('is-hide');

      $('.header_img').toggleClass('change_img');

      $('.img_container').toggleClass('change_img');

      $('.chat_header').toggleClass('chat_header2');

      $('.fab_field').toggleClass('fab_field2');

      $('.chat_converse').toggleClass('chat_converse2');

      //$('#chat_converse').css('display', 'none');

     // $('#chat_body').css('display', 'none');

     // $('#chat_form').css('display', 'none');

     // $('.chat_login').css('display', 'none');

     // $('#chat_fullscreen').css('display', 'block');

  });



function hideChat(hide) {

    switch (hide) {

      case 0:

            $('#chat_converse').css('display', 'none');

            $('#chat_body').css('display', 'none');

            $('#chat_form').css('display', 'none');

            $('.chat_login').css('display', 'block');

            $('.chat_fullscreen_loader').css('display', 'none');

             $('#chat_fullscreen').css('display', 'none');

            break;

      case 1:

            $('#chat_converse').css('display', 'block');

            $('#chat_body').css('display', 'none');

            $('#chat_form').css('display', 'none');

            $('.chat_login').css('display', 'none');

            $('.chat_fullscreen_loader').css('display', 'block');

            break;

      case 2:

            $('#chat_converse').css('display', 'none');

            $('#chat_body').css('display', 'block');

            $('#chat_form').css('display', 'none');

            $('.chat_login').css('display', 'none');

            $('.chat_fullscreen_loader').css('display', 'block');

            break;

      case 3:

            $('#chat_converse').css('display', 'none');

            $('#chat_body').css('display', 'none');

            $('#chat_form').css('display', 'block');

            $('.chat_login').css('display', 'none');

            $('.chat_fullscreen_loader').css('display', 'block');

            break;

      case 4:

            $('#chat_converse').css('display', 'none');

            $('#chat_body').css('display', 'none');

            $('#chat_form').css('display', 'none');

            $('.chat_login').css('display', 'none');

            $('.chat_fullscreen_loader').css('display', 'block');

            $('#chat_fullscreen').css('display', 'block');

            break;

    }

}





</script>



<script>

    // Get the modal

    var modal = document.getElementById("myModal");

    

    // Get the button that opens the modal

    var btn = document.getElementById("myBtn");

    

    // Get the <span> element that closes the modal

    var span = document.getElementsByClassName("close")[0];

    

    // When the user clicks the button, open the modal 

    btn.onclick = function() {

      modal.style.display = "block";

    }

    

    // When the user clicks on <span> (x), close the modal

    span.onclick = function() {

      modal.style.display = "none";

    }

    

    // When the user clicks anywhere outside of the modal, close it

    window.onclick = function(event) {

      if (event.target == modal) {

        modal.style.display = "none";

      }

    }

</script>





</body>



</html>
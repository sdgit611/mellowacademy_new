@extends('front.layout')
@section('content')

<section class="blog blog-category blog-animated">
        
        <?php
            if($cart_empty > 0) { ?>  
            <header>
                <br>
                <div class="container">
                    <h2 class="title">Items In Cart </h2>
                </div>
            </header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="clearfix">
                           <?php 
                            $id= Session::get('user_login_id');
                             ?>
                                
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
                                    <article class="article-table">
                                        <div class="row">
                                           
                                            <?php if($cart->image == ''){ ?>
                                                <div class="col-md-4">
                                                    <a href="<?php echo route('delete_cart',['id'=>''.$cart->id.'']) ?>"><span class="icon icon-cross icon-delete" style="position:absolute;top:2px;left:auto;font-size: 20px;font-weight: bolder;border: 1px solid white;border-radius: 50%;width: 30px;height:30px;padding-left: 4px;background-color: #77c24b;color:white"></span></a>
                                                    <a href="<?php echo $url; ?>"><video width="100%" height="auto" controls controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();" ><source src="<?php echo URL::asset('public/upload/video/'.$cart->video.'') ?>" type="video/mp4" allowfullscreen></video></a>
                                                    
                                                </div>
                                            <?php }else{ ?>
                                                 <div class="col-md-4">
                                                    <a href="<?php echo $url; ?>"><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/product/'.$cart->image.'') ?>" style="height:200px;width:100%;"></a>
                                                    <a href="<?php echo route('delete_cart',['id'=>''.$cart->id.'']) ?>"><span class="icon icon-cross icon-delete" style="position:absolute;top:2px;left:auto;font-size: 20px;font-weight: bolder;border: 1px solid white;border-radius: 50%;width: 30px;height:30px;padding-left: 4px;background-color: #77c24b;color:white"></span></a>
                                                </div>
                                            <?php } ?>

                                            <div class="col-md-4 text">
                                                <div class="title">
                                                    <h2 class="h5"><?php echo $cart->name; ?></h2>
                                                </div>
                                            </div>

                                            <div class="col-md-4 text">
                                                <div class="title">
                                                    <h2 class="h5">Price : <?php echo $cart->price; ?> INR</h2>
                                                </div>
                                            </div>

                                        </div>
                                        
                                     </article>
                                     <?php }
                                } ?>
                               
                            <center><div class="col-md-4">
                                <div class="text-intro">
                                    <a href="{{route('proceed_to_checkout')}}" type="button" class="btn btn-primary">Proceed to Checkout    <i class="fa fa-cart-plus"></i></a>
                                </div>
                            </div></center>
                        </div>
                    </div>                 
                </div> 
            </div>
        <?php }else{?>
            <header>
                <div class="container">
                    <h2 class="title"> </h2>
                </div>
            </header>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <center> 
                            <h5><img src="https://i.imgur.com/dCdflKN.png" class="rounded-circle" width="80px" height="80px"></h5>
                            <strong class="card-title">Your cart is currently empty.</strong><br>
                            <small>Looks like you haven't added anything to your cart yet.</small>
                            <h5>Thank You!</h5>
                            <hr style="width:520px;">
                            <a class="btn btn-primary btn-lg" href="{{route('index')}}" role="button">CONTINUE SHOPPING</a> 
                        </center> 
                    </div>
                </div>
            </div><br><br>

        <?php } ?>
                 
</section>
 @endsection
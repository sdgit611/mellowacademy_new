@extends('front.layout')
@section('content')
    
  <br>
<section class="about">
    <header>
        <div class="container">
            <?php
        foreach($allproduct as $ap) { 
            $p_id=$ap->id;
            session(['p_id' => $p_id]);?>

            <h2 class="title"><?php echo $ap->name; ?></h2>
             <?php if($ap->video != ''){ ?>
             <?php } else{?>
                <div class="text">
                    <p>FILE TYPE : <?php echo $ap->pro_type; ?></p>
                </div>
            <?php } ?>
        <?php
        } ?>
        </div>

        <br>
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
            </div>
        </div>
    </header>

    
<div class="container">
    <div class="row">

        <?php if($ap->video != '' && $ap->multiple_image == 'null' && $ap->image == ''){ ?>
            <div class="col-md-12 col-lg-12 col-md-12">
                
                            <div class="embed-responsive embed-responsive-16by9 portfolio-vid" >
                                <video controls controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();" ><source class="embed-responsive-item" src="<?php echo URL::asset('public/upload/video/'.$ap->video.'') ?>" type="video/mp4" allowfullscreen></video>
                            </div>
                        
            </div> 
            <?php } elseif($ap->multiple_image == 'null'){ ?>
                <div class="col-md-12 col-lg-12 col-sm-12">
                   
                                    <div class="swiper-wrapper">
                                        <img src="<?php echo URL::asset('public/upload/product/'.$ap->image);?>" alt="image">
                                    </div>
                                
                </div>

            <?php }elseif($ap->multiple_image != 'null' && $ap->video == ''){ ?>
                <div class="col-md-12">
                    <div class="product-flex-gallery">
                    <div class="product__carousel">
                      <div class="gallery-parent">
                        <!-- SwiperJs and EasyZoom plugins start -->

                            <div class="swiper-container gallery-top">
                              <div class="swiper-wrapper">
                                <?php
                                    $img=$ap->multiple_image;
                                    $images = explode(',',$img);
                                    foreach($images as $image) 
                                    {  ?>
                                    <div class="swiper-slide easyzoom easyzoom--overlay">
                                        <a href="<?php echo URL::asset('public/upload/product/'.$image.'') ?>">
                                            <img src="<?php echo URL::asset('public/upload/product/'.$image.'') ?>" alt="" />
                                        </a>
                                    </div>
                                <?php 
                                } ?>
                              </div>
                              <!-- Add Arrows -->
                              <div class="swiper-button-next swiper-button-white" style="color:#00264d"></div>
                              <div class="swiper-button-prev swiper-button-white" style="color:#00264d"></div>
                            </div>
                            <div class="swiper-container gallery-thumbs">
                                <div class="swiper-wrapper">
                                <?php
                                $img=$ap->multiple_image;
                                $images = explode(',',$img);
                                foreach($images as $image) {  ?>
                                    <div class="swiper-slide">
                                      <img src="<?php echo URL::asset('public/upload/product/'.$image.'') ?>" alt="" style="height: 235px;"/>
                                    </div>
                                <?php 
                                } ?>
                                </div>
                            </div>
                        

                      </div>
                    </div>
                    </div>
                </div> 
        <?php } ?>                          
    </div>
</div>

    <div class="container">
        

        <?php 
            if( $product_purchase > 0 ) { 
        ?>

            <div class="row more-purchase-details-button">
               <div class="col-md-6">
                   <a href="{{route('download', $ap->id )}}" type="button" class="btn btn-danger"><i class="fa fa-download"></i>  Download</a>
                </div>

               <?php if($ap->video != ''){ ?>

                    <div class="col-md-6">
                        <a href="{{route('product_show',  ['id' => $ap->id])}}" target="_blank" type="button" class="btn btn-primary"><i class="fa fa-bookmark"></i>   Live Preview</a>
                    </div> 

                <?php }else{?>
                
                    <div class="col-md-6">
                        <a href="<?php echo $ap->link; ?>" target="_blank" type="button" class="btn btn-primary"><i class="fa fa-bookmark"></i>   Live Preview</a>
                    </div> 

                <?php } ?>
               
            </div>

        <?php } else { 

        
        if($product_go_to_cart > 0 ) { ?>

       
            <div class="row more-details-button">
               <!-- <div class="col-md-4">
                   <a href="{{route('download', $ap->id )}}" type="button" class="btn btn-danger"><i class="fa fa-download"></i>  Download</a>
                </div> -->

                <?php if($ap->video != ''){ ?>

                    <div class="col-md-6">
                        <a href="{{route('product_show',  ['id' => $ap->id])}}" target="_blank" type="button" class="btn btn-danger"><i class="fa fa-bookmark"></i>   Live Preview</a>
                    </div> 

                <?php }else{?>
                
                    <div class="col-md-6">
                        <a href="<?php echo $ap->link; ?>" target="_blank" type="button" class="btn btn-danger"><i class="fa fa-bookmark"></i>   Live Preview</a>
                    </div> 

                <?php } ?>

                <div class="col-md-6">               
                    <a href="{{route('cart')}}" type="button" class="btn btn-primary"><i class="fa fa-cart-plus"></i>   Go To Cart </a>
               </div>
            </div>
       

        <?php }  else { ?> 

            <div class="row more-details">
               
                <?php 
                    if(empty(Session::get('user_login_id'))) { ?>

                        <div class="col-md-6">
                            <a href="{{route('registration')}}" type="button" class="add_to_cart btn btn-primary" value="{{$ap->id}}"><i class="fa fa-cart-plus"></i> Add To Cart</a>
                        </div>

                    <?php } else{ ?>

                         <div class="col-md-6">
                            <a href="javascript:void(0);" type="button" class="add_to_cart btn btn-primary" value="{{$ap->id}}"><i class="fa fa-cart-plus"></i> Add To Cart</a>
                        </div>

                        
                <?php } ?>

                <?php if($ap->video != ''){ ?>

                    <div class="col-md-6">
                        <a href="{{route('product_show',  ['id' => $ap->id])}}" target="_blank" type="button" class="btn btn-primary"><i class="fa fa-bookmark"></i>   Live Preview</a>
                    </div> 

                <?php }else{?>
                
                    <div class="col-md-6">
                        <a href="<?php echo $ap->link; ?>" target="_blank" type="button" class="btn btn-primary"><i class="fa fa-bookmark"></i>   Live Preview</a>
                    </div> 

                <?php } ?>

            </div>
        
        <?php } } ?>

        <center>
            <div class="row">
                <?php
                if( $rate_value > 0 ){
                foreach ($rate as $key) {
                if($key->rating == 1) { ?>
                        <div class="col-md-12" style="padding-top:20px;font-size:21px;">
                            <i  class="fa fa-star star"></i>
                            <a href="javascript:void();" class="stars" id="star2" value="2"><span  class="fa fa-star  checked"></span></a>
                            <a href="javascript:void();" class="stars" id="star3" value="3"><span  class="fa fa-star   checked"></span></a>
                            <a href="javascript:void();" class="stars" id="star4" value="4"><span  class="fa fa-star   checked"></span></a>
                            <a href="javascript:void();" class="stars" id="star5" value="5"><span  class="fa fa-star  checked"></span></a>
                        </div>
                    <?php }
                        elseif($key->rating == 2) { ?>
                            <div class="col-md-12" style="padding-top:20px;font-size:21px;">
                                <i  class="fa fa-star star"></i>
                                <i  class="fa fa-star star"></i>
                                <a href="javascript:void();" class="stars" id="star3" value="3"><span  class="fa fa-star   checked"></span></a>
                                <a href="javascript:void();" class="stars" id="star4" value="4"><span  class="fa fa-star   checked"></span></a>
                                <a href="javascript:void();" class="stars" id="star5" value="5"><span  class="fa fa-star  checked"></span></a>
                            </div>
                    <?php }
                        elseif($key->rating == 3) { ?>
                            <div class="col-md-12" style="padding-top:20px;font-size:21px;">
                                <i  class="fa fa-star star"></i>
                                <i  class="fa fa-star star"></i>
                                <i  class="fa fa-star star"></i>
                                <a href="javascript:void();" class="stars" id="star4" value="4"><span  class="fa fa-star   checked"></span></a>
                                <a href="javascript:void();" class="stars" id="star5" value="5"><span  class="fa fa-star  checked"></span></a>
                            </div>
                    <?php }
                        elseif($key->rating == 4) { ?>
                            <div class="col-md-12" style="padding-top:20px;font-size:21px;">
                                <i  class="fa fa-star star"></i>
                                <i  class="fa fa-star star"></i>
                                <i  class="fa fa-star star"></i>
                                <i  class="fa fa-star star"></i>
                               <a href="javascript:void();" class="stars" id="star5" value="5"><span  class="fa fa-star  checked"></span></a>
                            </div>
                    <?php }
                        elseif($key->rating == 5) { ?>
                            <div class="col-md-12" style="padding-top:20px;font-size:21px;">
                                <i  class="fa fa-star star"></i>
                                <i  class="fa fa-star star"></i>
                                <i  class="fa fa-star star"></i>
                                <i  class="fa fa-star star"></i>
                                <i  class="fa fa-star star"></i>
                            </div>
                    
                    <?php } 
                     }  } else { ?>
                            <div class="col-md-12" style="padding-top:20px;font-size:21px;">
                                <a href="javascript:void();" class="stars" id="star1" value="1"><span  class="fa fa-star checked"></span></a>
                                <a href="javascript:void();" class="stars" id="star2" value="2"><span  class="fa fa-star  checked"></span></a>
                                <a href="javascript:void();" class="stars" id="star3" value="3"><span  class="fa fa-star   checked"></span></a>
                                <a href="javascript:void();" class="stars" id="star4" value="4"><span  class="fa fa-star   checked"></span></a>
                                <a href="javascript:void();" class="stars" id="star5" value="5"><span  class="fa fa-star  checked"></span></a>
                            </div>
                    <?php } ?>
            </div>
        </cnter>
    </div>
</section>

<section>
    <div class="container">
        <div class="row product-details">
            <div class="col-md-3 box">
                <div>
                    <h5>Template Details</h5><hr>
                    @foreach ($allproduct as $key => $ap)      
                        <ul><li><b>Size : </b><a href="#">{{$ap->pro_size}}</a></li></ul>
                        <ul><li><b>Price : </b><a href="#">INR {{$ap->price}}</a></li></ul>
                        <?php if($ap->resolution == ''){?>
                        <?php }else{?>
                            <ul><li><b>Resolution : </b><a href="#">{{$ap->resolution}}</a></li></ul>
                            <?php } ?>
                        <ul><li><h5 class="title">Commercial License : </h5><a href="{{route('commercial_license')}}"> - Further Information</a></li></ul>
                    @endforeach
                </div>
            </div>
            <div class="col-md-9">
               <div class="container">
                    <ul class="nav nav-pills nav-pills-flat justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-review-tab" data-toggle="tab" href="#tab-review" role="tab">
                                Overviews
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-desc-tab" data-toggle="tab" href="#tab-desc" role="tab">
                                Addition
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-info-tab" data-toggle="tab" href="#tab-shipping" role="tab">
                                Feature
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="tab-review">
                            <div class="col-md-8 offset-md-2">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <p><?php echo $ap->overview; ?></p>
                                    </div>
                                </div>
                            </div> 
                        </div> 

                        <div class="tab-pane fade" id="tab-desc">
                            <div class="col-md-8 offset-md-2">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <p><?php echo $ap->additions; ?></p>
                                    </div>
                                </div>  
                            </div> 
                        </div> 

                        <div class="tab-pane fade" id="tab-shipping">
                            <div class="col-md-8 offset-md-2">
                                <div class="row">
                                    <div class="col-12">
                                       <p><?php echo $ap->description; ?></p>
                                    </div>
                                </div> 
                            </div> 
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>




<section class="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <div class="comments">
                    <div class="comment-header">
                        <div class="h3 m-0" style="font-size: 19px;">Recent comments</div>
                    </div>

                    <?php
                    foreach($comment as $com) { 
                        if( $ap->id === $com->p_id ) { 
                            ?>
                    <div class="comment-wrapper">
                        <div class="comment-block">
                            <div class="comment-user">
                                <div>
                                    <h5>
                                        <span><?php echo $com->name; ?></span>
                                        <!-- <span class="pull-right">
                                            <i class="fa fa-star active"></i>
                                            <i class="fa fa-star active"></i>
                                            <i class="fa fa-star active"></i>
                                            <i class="fa fa-star active"></i>
                                            <i class="fa fa-star"></i>
                                        </span> -->
                                        <small><?php echo $com->date; ?></small>
                                    </h5>
                                </div>
                            </div>
                            <div class="comment-desc">
                                <p><?php echo $com->comment; ?></p>
                            </div>

                            <?php
                            foreach($reply_comm as $reply_com) { 
                            if( $ap->id === $reply_com->p_id && $reply_com->comment_id === $com->id) { 
                            ?>
                                <div class="comment-block">
                                    <div class="comment-user">
                                        <div>
                                            <h5>Comment<small><?php echo $reply_com->date; ?></small></h5>
                                        </div>
                                    </div>
                                    <div class="comment-desc">
                                        <p><?php echo $reply_com->reply_comment; ?></p>
                                    </div>
                                </div>
                            <?php }
                            } ?>

                            <form  method="post" action="{{route('reply')}}">
                            @csrf
                                <input type="hidden" class="form-control" name="p_id" value="<?php foreach($allproduct as $b) {echo $b->id ;} ?>" placeholder="Enter Your Name">
                                <input type="hidden" class="form-control" name="comment_id" value="<?php echo $com->id ; ?>" placeholder="Enter Your Name">
                                
                                <div class="form-group">
                                    <textarea class="form-control" name="reply_comment" placeholder="Reply"></textarea>
                                    @if ($errors->has('reply_comment'))
                                        <strong class="text-danger">{{ $errors->first('reply_comment') }}</strong>                                  
                                    @endif
                                </div>
                                <div class="clearfix">
                                    <button type="submit" class="btn btn-primary">Reply</button>
                                </div>
                            </form>
                            <hr/>
                        </div>                              
                    </div>
                    <?php }
                    } ?>

                    <div class="comment-add">
                        <div class="row">
                            <div class="col-lg-8 ml-auto mr-auto">
                                @if(Session::has('errmsg'))                 
                                    <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                           <strong>{{Session::get('errmsg')}}</strong>
                                    </div>
                                    {{Session::forget('message')}}
                                    {{Session::forget('errmsg')}}
                                @endif
                                <br><br>
                            </div>
                        </div>
                        <div class="comment-reply-message">
                            <div class="h3 title" style="font-size: 19px;">Leave a Comment </div>
                        </div>

                        <form  method="post" action="{{route('leave_comment')}}">
                            @csrf
                            <input type="hidden" class="form-control" name="p_id" value="<?php foreach($allproduct as $b) {echo $b->id ;} ?>" placeholder="Enter Your Name">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Your Name" />
                                @if ($errors->has('name'))
                                    <strong class="text-danger">{{ $errors->first('name') }}</strong>                                  
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="Your Email" />
                                @if ($errors->has('email'))
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>                                  
                                @endif
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="comment" placeholder="Your comment"></textarea>
                                 @if ($errors->has('comment'))
                                    <strong class="text-danger">{{ $errors->first('comment') }}</strong>                                  
                                @endif
                            </div>
                            <div class="clearfix text-center">
                                <button type="submit" class="btn btn-primary">Add comment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    
$('body').on('click','.stars',function()
{
    var rating = $(this).attr('value');
    var v_token = "{{csrf_token()}}";
    
    $.ajax(
    {
        type: "POST",
        async: false,
        url: "{{route('submit_rating')}}",
        data: {rating:rating,_token:v_token},
        cache: false,           
        success: function(response)
        {     
             location.reload();
            /*if(response == 1){
                $('#star1').css('color', 'green');
            }else if(response == 2){
                $('#star1').css('color', 'green');
                $('#star2').css('color', 'green');
            }else if(response == 3){
                $('#star1').css('color', 'green');
                $('#star2').css('color', 'green');
                $('#star3').css('color', 'green');
            }else if(response == 4){
                $('#star1').css('color', 'green');
                $('#star2').css('color', 'green');
                $('#star3').css('color', 'green');
                $('#star4').css('color', 'green');
            }else if(response == 5){
                $('#star1').css('color', 'green');
                $('#star2').css('color', 'green');
                $('#star3').css('color', 'green');
                $('#star4').css('color', 'green');
                $('#star5').css('color', 'green');
            }else{
                $('#star1').css('color', 'black');
                $('#star2').css('color', 'black');
                $('#star3').css('color', 'black');
                $('#star4').css('color', 'black');
                $('#star5').css('color', 'black');
            }*/
        }
    })
});
    
</script>




@endsection
@extends('front.layout')

@section('content')



<section class="header-content">

    <header>

        <div class="container-fluid">

            <div class="owl-slider owl-carousel owl-theme" data-autoplay="true">

                <?php

                foreach($banner as $b) { ?>

                    <div class="item d-flex align-items-center">

                        <img src="<?php echo URL::asset('public/upload/banner/'.$b->image.'') ?>" alt="" width="100%" /> 

                    </div>  

                <?php

                } ?>

            </div> 

        </div>

    </header>

</section>



<section class="products">
    <header class="product_header">
        <div class="container">
            <h2 class="title">Hire High-Performance Individual/Team, On Your Terms</h2>
        </div>
    </header>
    <div class="container">
            <div class="row">
                <?php
                foreach($higher_professional as $hp) {

                $url = route('dev_details',['id'=>''.$hp->id.'']); ?>

                <div class="col-6 col-lg-3 col-sm-3 col-md-3">

                    <article>

                        <div class="figure-grid">

                            <div class="image">

                                <a href="<?php echo $url; ?>">

                                   <img src="<?php echo URL::asset('public/upload/hig_prof/'.$hp->image.'') ?>" alt=""/> 

                                </a>

                            </div>

                            <div class="text">

                                <h2 class="title h4">

                                    <a href="<?php echo $url; ?>" style="font-size:15px;"><?php echo $hp->heading; ?></a>

                                </h2>

                               

                            </div>

                        </div>

                    </article>

                </div>

                <?php

                } ?>
     <div class="text-center mt-4">
        <a href="{{ route('higher_professional') }}" class="btn btn-primary" style="margin-left: 466px;
    margin-top: -23px;">View More</a>
    </div>

    </div>

    </div> 
</section>


<section class="benefits">
    <header >
        <div class="container">
            <h2 class="h2 title">Developer Details ?</h2>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-6 col-lg-3 g-3" data-tilt>
                <figure>
                    <div class="icon"><i class="icon icon-picture"></i></div>
                    <figcaption>
                        <span>
                            <strong>Total Developer</strong> <br />
                            <small>{{@$total_count_developer}}</small>
                        </span>
                    </figcaption>
                </figure>
            </div>
             <div class="col-6 col-lg-3 g-3" data-tilt>
                <figure>
                    <div class="icon"><i class="icon icon-picture"></i></div>
                    <figcaption>
                        <span>
                            <strong>Total Hours</strong> <br />
                            <small>{{@$total_hours}}</small>
                        </span>
                    </figcaption>
                </figure>
            </div>
             <div class="col-6 col-lg-3 g-3" data-tilt>
                <figure>
                    <div class="icon"><i class="icon icon-picture"></i></div>
                    <figcaption>
                        <span>
                            <strong>Total Projects</strong> <br />
                            <small>
                                {{ @$total_project }}
                            </small>
                        </span>
                    </figcaption>
                </figure>
            </div>
             <!-- <div class="col-6 col-lg-3 g-3" data-tilt>
                <figure>
                    <div class="icon"><i class="icon icon-picture"></i></div>
                    <figcaption>
                        <span>
                            <strong>Total Developer</strong> <br />
                            <small>{{@$developer_count}}</small>
                        </span>
                    </figcaption>
                </figure>
            </div> -->
        </div> 
    </div>
</section>



<section class="benefits">
    <header >
        <div class="container">
            <h2 class="h2 title">Why Mellow Vault?</h2>
        </div>
    </header>
    <div class="container">
        <div class="row">
            @foreach($millaw_vault as $key=>$millaw)
            <div class="col-6 col-lg-3 g-3" data-tilt>
                <figure>
                    <div class="icon"><img src="{{url('public'.$millaw->image)}}" /></i></div>
                    <figcaption>
                        <span>
                            <strong>{{@$millaw->name}}</strong> <br />
                            <small>{{@$millaw->description}}</small>
                        </span>
                    </figcaption>
                </figure>
            </div>
            @endforeach
        </div> 
    </div>
</section>


<!-- <section class="benefits">
    <header >
        <div class="container">
            <h2 class="h2 title">Build Dream Team With Vault. Book 1: 1 Free Consultant Now</h2>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-6 col-lg-3 g-3" data-tilt>
                <figure>
                    <div class="icon">Build Dream Team With Vault. Book 1: 1 Free Consultant Now</div>
                    <figcaption>
                        <span>
                        <form id="free_consultant_now">
                                @csrf
                                <input type="email" name="email" placeholder="Enter Email" class="form-group" required=""><br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </span>
                    </figcaption>
                </figure>
            </div>
        </div> 
    </div>
</section> -->





<section class="blog blog-widget blog-animated">

    <center>

        <header class="blog_header">

            <div class="container">

                <h2 class="h2 title">Create stories</h2>

                <div class="text">

                    <h1 class="title">Hire Now | Hire Developers & Marketers | Instant Interviews | Fast & Reliable Hiring</h1>

                    <p>Work with hand-picked talent, tailored to fit your scale and needs..</p>

                    <?php

                        if(empty(Session::get('user_login_id'))) { ?>

                            <a href="{{route('registration')}}" class="btn btn-success">Create Account Now</a>

                    <?php }else{ ?>

                            <a href="" class="btn btn-success">Already you're member!</a>

                    <?php } ?>

                </div>

            </div>

        </header>

    </center>



   <div class="container">
    <div class="owl-carousel owl-theme">
        <?php foreach($allproduct as $apro): 
            $url = route('product_details', ['id' => $apro->id]); ?>
            <div class="item">
                <article>
                    <a href="<?php echo $url; ?>" class="blog-link">
                        <?php if ($apro->image == ''): ?>
                            <div>
                                <video controls controlsList="nodownload" muted onmouseover="this.play()" onmouseout="this.pause();" style="width: 100%; height: 200px;">
                                    <source src="<?php echo URL::asset('public/upload/video/'.$apro->video); ?>" type="video/mp4">
                                </video>
                            </div>
                        <?php else: ?>
                            <div>
                                <img src="<?php echo URL::asset('public/upload/product/'.$apro->image); ?>" style="width:100%; height:200px;" />
                            </div>
                        <?php endif; ?>
                        <div class="entry entry-table">
                            <div class="title">
                                <h2 class="h5" style="font-size:15px;"><?php echo $apro->name; ?></h2>
                            </div>
                        </div>
                    </a>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
</div>
 

    <div class="container">
    <div class="row">
        <div class="col-6 col-lg-4 col-sm-4 col-md-4">
            <article>
                <a href="#" class="blog-link">
                    <div>
                        <img src="public/upload/product/sample-image.jpg" style="width:100%;height:200px;" /> 
                    </div>
                    <div class="entry entry-table">
                        <div class="title">
                            <h2 class="h5" style="font-size:15px;">Sample Product Name</h2>
                        </div>
                    </div>
                </a>
            </article>
        </div>

        <div class="col-6 col-lg-4 col-sm-4 col-md-4">
            <article>
                <a href="#" class="blog-link">
                    <div>
                        <!-- <video controls controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();">
                            <source class="embed-responsive-item" src="public/upload/video/sample-video.mp4" type="video/mp4" allowfullscreen>
                        </video> -->
                        <div>
                        <img src="public/upload/product/sample-image2.jpg" style="width:100%;height:200px;" /> 
                    </div>
                    </div>
                    <div class="entry entry-table">
                        <div class="title">
                            <h2 class="h5" style="font-size:15px;">Sample Product Name</h2>
                        </div>
                    </div>
                </a>
            </article>
        </div>
        
        <div class="col-6 col-lg-4 col-sm-4 col-md-4">
            <article>
                <a href="#" class="blog-link">
                    <div>
                        <img src="public/upload/product/sample-image2.jpg" style="width:100%;height:200px;" /> 
                    </div>
                    <div class="entry entry-table">
                        <div class="title">
                            <h2 class="h5" style="font-size:15px;">Another Product Name</h2>
                        </div>
                    </div>
                </a>
            </article>
        </div>
    </div>
</div>


</section>



<section class="benefits">

    

    <center>

        <header class="blog_header">

            <div class="container">

                <h2 class="h2 title">Our Partners</h2>

            </div>

        </header>

    </center>

    <div class="page-wrapper">

    <div class="owl-carousel owl-theme">
    @foreach($partner_details as $k=>$partners)

    <div class="profile-box">

      <img src="{{url('public'.$partners->image)}}" alt="profile pic" class="img-pro" >

      <h3 class="com-name"><a href="https://mellowcorporation.com/">{{@$partners->name}}</a></h3>

    </div>
    @endforeach
</div>

  <!--   <div class="profile-box">

      <img src="https://placeimg.com/200/200/animal" alt="profile pic" class="img-pro">

      <h3 class="com-name"><a href="https://seminator.in/">Seminator Infosystem Pvt Ltd.</a></h3>

    </div> -->

    <!-- <div class="profile-box">

      <img src="http://mellowacademy.com/public/front/images/logo.png" alt="profile pic" class="img-pro">

      <h3 class="com-name"><a href="http://mellowacademy.com/">Mellow Academy</a></h3>

    </div>

    <div class="profile-box">

      <img src="https://placeimg.com/200/200/nature" alt="profile pic" class="img-pro">

      <h3 class="com-name"><a href="">James E. Sheldon</a></h3>

    </div> -->

    </div>

</section>


<script>
$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
    loop: true,
    margin: 15,
    nav: true,
    dots: false,
    autoplay: true,
    autoplayTimeout: 4000,
    responsive:{
      0:{ items:1 },
      576:{ items:2 },
      768:{ items:3 },
      // 992:{ items:4 },
      // 1200:{ items:5 }  // show 5 items per slide on large screens
    }
  });
});



$(document).ready(function(){

    ShowCalender();

});


$("#free_consultant_now").on('submit', function(e){

    e.preventDefault();
    $.ajax({
        type:"post",
        url:"{{route('email_verify')}}",
        data: $(this).serialize(),
        success:function(resp)
        {
            console.log(resp.data);
           if(resp.data==0)
           {
             window.location.href="{{route('contact')}}"
           }else{
            
              $('#calender').modal('show');
           }
        }
    });

});

</script>


@endsection
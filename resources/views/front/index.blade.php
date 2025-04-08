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

            <div class="col-6 col-lg-3 g-3" data-tilt>

                <figure>

                    <div class="icon"><i class="icon icon-download"></i></div>

                    <figcaption>

                        <span>

                            <strong>Hire with confidence—no upfront costs!</strong> <br />

                            <small>Find the right candidates for your open positions, assess their fit, and pay only for the work you approve.</small>

                        </span>

                    </figcaption>

                </figure>

            </div>

            <div class="col-6 col-lg-3 g-3" data-tilt>

                <figure>

                    <div class="icon"><i class="icon icon-picture"></i></div>

                    <figcaption>

                        <span>

                            <strong>Schedule & Conduct Interviews</Tarea></strong> <br />

                            <small>Gain insights into the quality of work you can expect when you hire through Talent Finder.</small>

                        </span>

                    </figcaption>

                </figure>

            </div>



            <div class="col-6 col-lg-3 g-3" data-tilt>

                <figure>

                    <div class="icon"><i class="icon icon-license"></i></div>

                    <figcaption>

                        <span>

                            <strong>Hire a Pro</strong> <br />

                            <small>We connect busy professionals with the right opportunities, customizing solutions to fit your needs and fostering lasting partnerships for success..</small>

                        </span>

                    </figcaption>

                </figure>

            </div>



            <div class="col-6 col-lg-3 g-3" data-tilt>

                <figure>

                    <div class="icon"><i class="icon icon-diamond"></i></div>

                    <figcaption>

                        <span>

                            <strong>Take full control</strong> <br />

                            <small>Take full control of when, where, and how you work! Mellow Vault ensures the perfect talent match for every role, boosting efficiency and meeting critical deadlines.</small>

                        </span>

                    </figcaption>

                </figure>

            </div>

        </div> 

    </div>

</section>





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

        <div class="row">

            <?php 

            foreach($allproduct as $apro) { 

                $url = route('product_details',['id'=>''.$apro->id.'']); ?>

                <div class="col-6 col-lg-4 col-sm-4 col-md-4">

                    <article>

                        <a href="<?php echo $url; ?>" class="blog-link">

                            <?php if($apro->image == ''){ ?>

                                <div>

                                    <video controls controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();" ><source class="embed-responsive-item" src="<?php echo URL::asset('public/upload/video/'.$apro->video.'') ?>" type="video/mp4" allowfullscreen></video>

                                </div>

                            <?php }else{ ?>

                                <div>

                                    <img src="<?php echo URL::asset('public/upload/product/'.$apro->image.'') ?>" style="width:100%;height:200px;"/> 

                                </div>

                            <?php } ?>

                            <div class="entry entry-table">

                                <div class="title">

                                    <h2 class="h5" style="font-size:15px;"><?php echo $apro->name; ?></h2>

                                </div>

                            </div>

                        </a>

                    </article>

                </div>

            <?php

            } ?>

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

    <div class="profile-box">

      <img src="https://mellowcorporation.com/public/upload/header/1628345113.png" alt="profile pic" class="img-pro">

      <h3 class="com-name"><a href="https://mellowcorporation.com/">Mellow Corporation</a></h3>

    </div>

    <div class="profile-box">

      <img src="https://placeimg.com/200/200/animal" alt="profile pic" class="img-pro">

      <h3 class="com-name"><a href="https://seminator.in/">Seminator Infosystem Pvt Ltd.</a></h3>

    </div>

    <div class="profile-box">

      <img src="http://mellowacademy.com/public/front/images/logo.png" alt="profile pic" class="img-pro">

      <h3 class="com-name"><a href="http://mellowacademy.com/">Mellow Academy</a></h3>

    </div>

    <div class="profile-box">

      <img src="https://placeimg.com/200/200/nature" alt="profile pic" class="img-pro">

      <h3 class="com-name"><a href="">James E. Sheldon</a></h3>

    </div>

    </div>

</section>



@endsection
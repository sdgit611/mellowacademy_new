@extends('front.layout')
@section('content')

    <section class="products developer">
        <br><br>
        <?php $i=1;
            foreach($higher_professional as $dev){
                $data = $dev->heading;
           ?>

        <header>
            <div class="container">
                <h2 class="title">Hire The Best <?php echo $data; ?></h2>
                <div class="text text-justify">
                    <p>Hire in 24 Hrs. Mellow Elements helps you hire staff from over 60,000 people across 10+ categories.</p>
                </div>
            </div>
        </header>
       <?php  if ($i++ == 1) break; }
        ?>
        
        <?php if($developer == 0){ ?>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <center> 
                            <h5><img src="{{ URL::asset('public/front/assets/images/nodeveloper.png') }}" class="rounded-circle" width="230px" height="200px"></h5>
                            <strong class="card-title">Seems, Developers are Occupied With Others. We will Notify You Shortly!!</strong><br>
                        </center> 
                    </div>
                </div>
            </div>

        <?php }else{  ?>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                        	<?php 
                    		foreach($developer_details as $dev) { 
                    		$url = route('developer_detail',['id'=>''.$dev->dev_id.'']); ?>
    	                        <div class="col-6 col-lg-4 col-sm-4 col-md-4">
    	                            <article>
                                        <div class="text" style="position: absolute;display:inline; text-align: right;">
                                            <h2 class="title small">
                                                <p>INR <?php echo $dev->perhr; ?>/Months</p>    
                                            </h2> 
                                        </div>
    	                                <div class="figure-grid">
    	                                    <div class="image circle">
    	                                        <a href="<?php echo $url; ?>">
                                        			<img src="<?php echo URL::asset('public/upload/developer/'.$dev->image.'') ?>" alt=""/> 
                                    			</a>
    	                                    </div>
    	                                    <div class="text">
    			                                <h2 class="title h4">
    			                                    <center><a href="<?php echo $url; ?>"><?php echo $dev->name; ?></a></center>
    			                                </h2>
                                                <h2 class="title small">
                                                    <center><a href="<?php echo $url; ?>"><?php echo $dev->heading; ?></a></center>
                                                </h2><br>
                                                <h2 class="title small">
                                                    <center><i class="fa fa-star"> <?php echo $dev->rating; ?>/5</i> (<?php echo $dev->job; ?> Jobs)</center>
                                                </h2>
    			                               <br>			                               
    			                                <center><a href="<?php echo $url; ?>" class="btn btn-primary">See More</a></center>
    			                            </div>
    	                                </div>
    	                            </article>
    	                        </div>
                            <?php
                    		} ?>
                        </div>                        
                    </div> 
                </div>
            </div>
        <?php } ?>
    </section>
@endsection
@extends('front.layout')
@section('content')
      
    <section class="checkout">
        
            <header>
                <div class="container">
                    <h2 class="title">Hire Now!</h2>
                    <div class="text">
                        <p>Proceed To Hiring!</p>
                    </div>
                </div>
            </header>

            <div class="container">            
                <div class="cart-wrapper">
                    <div class="cart-block cart-block-header clearfix">
                        <div><span></span></div>
                        <div class="text-center"><span></span></div>
                        <div class="text-center"><span></span></div>
                        <div class="text-center"><span></span></div>
                        <div class="text-center"><span></span></div>
                    </div>
                    <?php 
                    $id= Session::get('user_login_id');
                    $tperhr=0;
                    foreach($developer_cart as $dcart) { 
                       
                        $dev_id=$dcart->dev_id;
                        $tperhr+=$dcart->perhr;
                        session(['dev_id' => $dev_id]);
                        session(['tperhr' => $tperhr]);
                        
                    ?>
                    <div class="clearfix">
                        <div class="cart-block cart-block-item clearfix">
                            <div class="image">
                                <a href="#"><img src="<?php echo URL::asset('public/upload/developer/'.$dcart->image);?>" alt="" /></a>
                            </div>
                            <div class="title">
                              <div class="h6 text-center"><a href=""><?php echo $dcart->name; ?></a></div>
                            </div>

                           <div class="title">
                                <div class="text-center"><?php foreach($developer_cart_deatls as $p) {
                                        if($dcart->pro_id === $p->id ) { ?>
                                           <?php echo $p->heading; ?>

                                    <?php } }?> </div>
                                <div></div>
                            </div>

                            <!-- <div class="quantity">
                                <div >
                                    <?php foreach($developer_cart_deatls as $p) {
                                        if($dcart->pro_id === $p->id ) { ?>
                                           
                                   ( <?php echo $dcart->rating; ?>/5 )
                                   <?php } } ?>

                               </div>
                            </div> -->

                            <div class="price">
                                <span class="final"></span>
                                <span class="text-center">
                                  INR <?php echo ($dcart->perhr)*10/100+$dcart->perhr; ?>
                                </span> 
                            </div>
                       

                            <!-- <div class="price">
                                <span class="text-center">< ?php echo $dcart->perhr; ?> INR</span>
                            </div> -->
                           <!--  <a href="< ?php echo route('delete_developer_cart',['dev_id'=>''.$dcart->dev_id.'']) ?>"><span class="icon icon-cross icon-delete"></span></a> -->
                        </div>
                    </div>
                    <?php 
                    } ?>
                    <div class="row">
                        <div class="col-md-4 offset-md-8">
                          
                            <div class="cart-block cart-block-footer clearfix">
                            </div>
                        </div>
                    </div>

                    <div class="clearfix">
                        

                        
                        <div class="row">
                            <div class="col-4">
                                
                            </div>
                            <div class="col-8 text-right">
                                <a href="{{route('developer_proceed_checkout')}}" class="btn btn-outline-warning"><span class="icon icon-cart"></span> Proceed to Hire</a>
                            </div>
                        </div>
                        

                    </div>
                </div>

                
            </div> 

      
</section>

@endsection
@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:40px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Order Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Order Id</th>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>More Details</th>
                                    <th>Transation Details</th>
                                </tr>
                            </thead>
	                        <tbody>
                                <?php $i=1;
                                foreach($product_order_details as $product_order) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $product_order->order_id; ?></td>
                                        <td><?php echo $product_order->u_id; ?></td>
                                        <td><?php echo $product_order->fname; ?></td>
                                        <td><a class="btn btn-success" href="javascript:void();" data-toggle="modal" data-target="#myModal<?php echo $product_order->p_id; ?>" ><i class="fa fa-show"></i>Details</a></td>
                                        <td><a class="btn btn-success" href="javascript:void();" data-toggle="modal" data-target="#myModal<?php echo $product_order->order_id; ?>" ><i class="fa fa-show"></i>Payment Details</a></td>
                                    </tr>
                                    <div class="modal" id="myModal<?php echo $product_order->p_id; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Order Details</h4>
                                                    </div>
                                                  <div class="modal-body">
                                                    <?php if($product_order->image == ''){ ?>
                                                        <p>Product Video :  <video width="100" height="100" controls controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();" ><source src="<?php echo URL::asset('public/upload/video/'.$product_order->video.'') ?>" type="video/mp4" allowfullscreen ></video></p>
                                                    <?php }else{ ?>
                                                        <p>Product Image : <img src="<?php echo URL::asset('public/upload/product/'.$product_order->image.'') ?>" alt="Alternate Text" height="50" /></p>
                                                    <?php } ?>
                                                    <p>Product Name : <?php echo $product_order->name; ?></p>
                                                    <p>Product Price : <?php echo $product_order->price; ?></p>
                                                    <p>Status : <b style="color:green"><?php echo $product_order->payment_status; ?></b></p>
                                                    <p>Date : <?php echo $product_order->date; ?></p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="modal" id="myModal<?php echo $product_order->order_id; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Transaction Details</h4>
                                                    </div>
                                                  <div class="modal-body">
                                                    <?php 
                                                        foreach ($transaction_details as $k) {
                                                        if($k->order_id == $product_order->order_id){
                                                    ?>
                                                    <p>Razorpay Payment id : <?php echo $k->razorpay_payment_id; ?>
                                                    <p>Date : <?php echo $k->date; ?>
                                                    <?php } }?>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php $i++;
                                } ?>
	                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
       	</div>
    </div>
</div>
@endsection
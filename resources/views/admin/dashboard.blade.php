@extends('admin.layout')
@section('content')

<div class="page-content" style="">
    <div class="page-info container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Elements</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="main-wrapper container">
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
        <div class="row stats-row">
            <div class="col-lg-3 col-md-12">
                <div class="card card-transparent stats-card">
                    <a href="{{route('contactus')}}">
                        <div class="card-body">
                            <div class="stats-info">
                                <h5 class="card-title"><?php echo $total_contact; ?></h5>
                                <p class="stats-text" style="color:#7D7D83">Total Contact</p>
                            </div>
                            <div class="stats-icon change-success">
                                <i class="material-icons">trending_up</i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="card card-transparent stats-card">
                    <a href="{{route('hig_prof')}}">
                        <div class="card-body">
                            <div class="stats-info">
                                <h5 class="card-title"><?php echo $higher_professional; ?></h5>
                                <p class="stats-text" style="color:#7D7D83">Higher Professional</p>
                            </div>
                            <div class="stats-icon change-success">
                                <i class="material-icons">trending_up</i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="card card-transparent stats-card">
                    <a href="{{route('products')}}">
                        <div class="card-body">
                            <div class="stats-info">
                                <h5 class="card-title"><?php echo $total_product; ?></h5>
                                <p class="stats-text" style="color:#7D7D83">Total Products</p>
                            </div>
                            <div class="stats-icon change-success">
                                <i class="material-icons">trending_up</i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="card card-transparent stats-card">
                    <a href="{{route('all_visitor')}}">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title"><?php echo $total_visitor; ?></h5>
                            <p class="stats-text" style="color:#7D7D83">Total Visitor</p>
                        </div>
                        <div class="stats-icon change-success">
                            <i class="material-icons">trending_up</i>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card savings-card">
                    <div class="card-body">
                        <h5 class="card-title">Savings</h5>
                        <div class="savings-stats">
                            <?php
                             $total_price=0; 
                            foreach($total_saving as $ts) { 
                                $total_price+= $ts->tprice; ?>
                                <?php } ?>
                                <h5>{{$total_price}}</h5>
                           
                        </div>
                    </div>
                </div>
                <div class="card top-products">
                    <div class="card-body">
                        <h5 class="card-title">Popular Products<span class="card-title-helper">Today</span></h5>
                        <div class="top-products-list">
                            <?php $i=1;
                            foreach($popular_product as $pp) { ?>
                                <?php if($pp->image == ''){ ?>
                                    <div class="product-item">
                                        <video width="50" height="50" controls controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();" ><source src="<?php echo URL::asset('public/upload/video/'.$pp->video.'') ?>" type="video/mp4" allowfullscreen style="height:80px"></video>
                                        <span class="product-item-status"><?php echo $pp->name; ?></span>
                                    </div>
                                <?php }else{?>
                                    <div class="product-item">
                                        <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/product/'.$pp->image.'') ?>" style="height:50px">
                                        <span class="product-item-status"><?php echo $pp->name; ?></span>
                                    </div>
                                <?php } ?>
                                
                            <?php
                                if ($i++ == 3) break;
                             } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card card-transactions">
                    <div class="card-body">
                        <h5 class="card-title">Transactions<a href="#" class="card-title-helper blockui-transactions"><i class="material-icons">refresh</i></a></h5>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;
                                    foreach($transaction as $t) { ?>
                                        <tr>
                                            <td><?php echo $t->order_id; ?></td>
                                            <td><?php echo $t->name; ?></td>
                                            <td>INR <?php echo $t->tprice; ?></td>
                                            <td><span class="badge badge-success"><?php echo $t->payment_status; ?></span></td>
                                        </tr>
                                    <?php
                                        if ($i++ == 10) break;
                                     } ?>
                                </tbody>
                            </table> 
                        </div>     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
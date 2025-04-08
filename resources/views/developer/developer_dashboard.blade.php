@extends('developer.layout')
@section('content')

<div class="page-content" style="">
    <div class="page-info container">
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
                       
                    </div>
                </div>
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Developer</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="main-wrapper container">
        
        <div class="row stats-row">
            <div class="col-lg-3 col-md-12">
                <div class="card card-transparent stats-card">
                    <div class="card-body">
                        <a href="{{route('developer_resource')}}">
                        <div class="stats-info">
                            <h5 class="card-title"><?php echo $total_require_docs; ?></h5>
                            <p class="stats-text" style="color:#7d7d83;">Total Require Document</p>
                        </div>
                        </a>
                        <div class="stats-icon change-success">
                            <i class="material-icons">trending_up</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="card card-transparent stats-card">
                    <div class="card-body">
                        <a href="{{route('developer_resource')}}">
                        <div class="stats-info">
                            <h5 class="card-title"><?php echo $total_short_message; ?></h5>
                            <p class="stats-text" style="color:#7d7d83;">Total Short Message</p>
                        </div>
                        </a>
                        <div class="stats-icon change-success">
                            <i class="material-icons">trending_up</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="card card-transparent stats-card">
                    <div class="card-body">
                        <a href="{{route('developer_resource')}}">
                        <div class="stats-info">
                            <h5 class="card-title"><?php echo $total_sow; ?></h5>
                            <p class="stats-text" style="color:#7d7d83;">Total SOW</p>
                        </div>
                        </a>
                        <div class="stats-icon change-success">
                            <i class="material-icons">trending_up</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="card card-transparent stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title"><?php $walletMoney=0;
                            foreach ($developer_wallet_details as $dwd) { 
                               $walletMoney += $dwd->price; 
                            }
                            ?>
                            <b class="btn btn-danger"><?php echo $walletMoney; ?></b>
                             
                          <?php  ?></h5>
                            <p class="stats-text">Total Earing</p>
                        </div>
                        <div class="stats-icon change-success">
                            <i class="material-icons">trending_up</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card savings-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Work Space</h5>
                        <div class="savings-stats">
                            
                            <span class="btn btn-success btn-sm"><?php echo $total_work_space; ?></span>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-8">
                <div class="card card-transactions">
                    <div class="card-body">
                        <h5 class="card-title">Work Details<a href="#" class="card-title-helper blockui-transactions"><i class="material-icons">refresh</i></a></h5>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Image</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Price</th>
                                        <th scope="col">Product Size</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;
                                    foreach($work_space_details as $wsd) { ?>
                                        <tr>
                                            <?php if($wsd->image == ''){ ?>
                                                <td><video controls style="height:80px" controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();" ><source src="<?php echo URL::asset('public/upload/video/'.$wsd->video.'') ?>" type="video/mp4" allowfullscreen style="height:80px"></video></td>
                                            <?php }else{?>
                                                <td><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/product/'.$wsd->image.'') ?>" style="height:80px"></td>
                                            <?php } ?>
                                            <td><?php echo $wsd->name; ?></td>
                                            <td><?php echo $wsd->price; ?></td>
                                            <td><?php echo $wsd->pro_size; ?></td>
                                        </tr>
                                    <?php
                                        if ($i++ == 5) break;
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
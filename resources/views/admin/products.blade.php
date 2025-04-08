@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:40px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                 <a href="{{ route('addproducts') }}" class="btn btn-primary">Add Product</a><br>
            </div>
        </div><br>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive"> 
                            <table id="complex-header" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th>Multiple Image</th>
                                        <th>Product Price</th>
                                        <th>Product Tax</th>
                                        <th>Price Including Tax</th>
                                        <th>More Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=1;
                                        foreach($product as $p) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $p->name; ?></td>
                                                <td>
                                                    <?php if($p->image == ''){ ?>
                                                        <video controls style="height:80px" controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();" ><source src="<?php echo URL::asset('public/upload/video/'.$p->video.'') ?>" type="video/mp4" allowfullscreen style="height:80px"></video>
                                                    <?php }else{?>  
                                                        <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/product/'.$p->image.'') ?>" style="height:80px">
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $img=$p->multiple_image;
                                                        $images = explode(',',$img);
                                                        foreach($images as $image) 
                                                        { ?>
                                                            <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/product/'.$image.'') ?>" style="height:30px;width:40px;">
                                                    <?php   
                                                        } ?>
                                                </td>
                                                <td><?php echo $price = $p->price; ?>.00</td>
                                                <td><?php echo $tax = $p->tax; ?></td>
                                                <td><?php echo $total_price = $price + $calculate_price = (( $tax / 100 ) * $price ); ?></td>
                                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myshowModal<?php echo $p->id; ?>">More Details</button></td>
                                                <td>
                                                    <a class="btn btn-success btn-sm" href="<?php echo route('product_updates',['id'=>''.$p->id.'']) ?>" ><i class="fa fa-edit"></i></a>
                                                    <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This?')" href="<?php echo route('delete_product',['id'=>''.$p->id.'']) ?>" ><i class="fa fa-trash"></i></a>
                                                </td>                                                                         
                                            </tr>


                                            <div class="modal" id="myshowModal<?php echo $p->id; ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h5 class="card-title">More Details</h5>
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                       <div class="card">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">Type</h5>
                                                                                <p class="card-text"><?php echo $p->pro_type; ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">Product Feature</h5>
                                                                                <p class="card-text"><?php echo $p->description; ?></p>
                                                                            </div>
                                                                        </div>

                                                                        
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">Product Size</h5>
                                                                                <p class="card-text"><?php echo $p->pro_size; ?></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">Addition</h5>
                                                                                <p class="card-text"><?php echo $p->additions; ?></p>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">Overview</h5>
                                                                                <p class="card-text"><?php echo $p->overview; ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">Link</h5>
                                                                                <p class="card-text"><?php echo $p->link; ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">Zip</h5>
                                                                                <p class="card-text"><?php echo $p->source_code; ?></p>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">Video</h5>
                                                                                <p class="card-text"><?php echo $p->video; ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">PSD</h5>
                                                                                <p class="card-text"><?php echo $p->psd; ?></p>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">Resolution</h5>
                                                                                <p class="card-text"><?php echo $p->resolution; ?></p>
                                                                            </div>
                                                                        </div>                 
                                                                    </div>  
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php
                                            $i++;
                                        }
                                        ?>

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
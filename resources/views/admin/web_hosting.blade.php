@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col-xl">
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
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Add Web Hosting</h5>
                        <form method="post" action="{{route('submit_web_hosting')}}">
                            @csrf
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="name">Hosting Name</label>
                                    <input type="text" class="form-control" name="hostingname" id="name" placeholder="Enter Hosting name" required="">
                                    @if ($errors->has('hostingname'))
                                        <strong class="text-danger">{{ $errors->first('hostingname') }}</strong>                                  
                                    @endif
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label for="name">Hosting Price</label>
                                    <input type="text" class="form-control" name="hostingprice" id="name" placeholder="Enter Hosting price" required="">
                                    @if ($errors->has('hostingprice'))
                                        <strong class="text-danger">{{ $errors->first('hostingprice') }}</strong>                                  
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="description">Features</label>
                                    <textarea id="content" class="form-control" name="feature" placeholder="Features" rows="5"></textarea>
                                    @if ($errors->has('feature'))
                                        <strong class="text-danger">{{ $errors->first('feature') }}</strong>                                  
                                    @endif
                                </div>                             
                            </div>
                            <button type="submit" class="btn btn-primary">Add Web Hosting</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Web Hosting</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Hosting Name</th>
                                    <th>Hosting Price</th>
                                    <th>Features</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;
                                    foreach($web_hosting as $pp) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $pp->hostingname; ?></td>
                                            <td><?php echo $pp->hostingprice; ?></td>
                                            <td><?php echo $pp->feature; ?></td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $pp->id; ?>" ><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This?')" href="<?php echo route('delete_web_hosting',['id'=>''.$pp->id.'']) ?>" ><i class="fa fa-trash"></i></a>
                                            </td>                                                                         
                                        </tr>
                                        <div class="modal" id="myeditModal<?php echo $pp->id; ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Web Hosting</h4>
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                     <div class="modal-body">
                                                        <form method="post" action="{{route('update_web_hosting')}}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group bmd-form-group">
                                                                        <label class="bmd-label-floating">Enter Hosting Name</label>
                                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $pp->id; ?>" autocomplete="off" required="" >
                                                                        <input type="text" class="form-control" name="hostingname" value="<?php echo $pp->hostingname; ?>" autocomplete="off" required="" >
                                                                        @if ($errors->has('hostingname'))
                                                                        <strong class="text-danger">{{ $errors->first('hostingname') }}</strong>                                   
                                                                        @endif
                                                                    </div>                      
                                                                </div>    
                                                                
                                                                <div class="col-sm-12">
                                                                    <div class="form-group bmd-form-group">
                                                                        <label class="bmd-label-floating">Enter Hosting Price</label>
                                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $pp->id; ?>" autocomplete="off" required="" >
                                                                        <input type="text" class="form-control" name="hostingprice" value="<?php echo $pp->hostingprice; ?>" autocomplete="off" required="" >
                                                                        @if ($errors->has('hostingprice'))
                                                                        <strong class="text-danger">{{ $errors->first('hostingprice') }}</strong>                                   
                                                                        @endif
                                                                    </div>                      
                                                                </div>  

                                                                <div class="col-sm-12">
                                                                    <div class="form-group bmd-form-group">
                                                                        <label class="bmd-label-floating">Enter Features</label>
                                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $pp->id; ?>" autocomplete="off" required="" >
                                                                        <textarea class="ckeditor" name="feature" autocomplete="off" required=""><?php echo $pp->feature; ?></textarea>
                                                                        @if ($errors->has('feature'))
                                                                        <strong class="text-danger">{{ $errors->first('feature') }}</strong>                                   
                                                                        @endif
                                                                    </div>                      
                                                                </div>                                                                            
                                                                <div class="col-sm-4">
                                                                    <div class="form-group bmd-form-group">
                                                                        <button type="submit" class="btn btn-success btn-block">Update</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
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
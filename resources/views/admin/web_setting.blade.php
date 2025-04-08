@extends('admin.layout')
@section('content')


<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Web Setting</a></li>
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
                                   
                                    <th>Facebook</th>
                                    <th>Instagram</th>
                                    <th>LinkedIn</th>
                                    <th>Twitter</th>
                                    <th>Header Logo</th>
                                    <th>Footer Logo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;
                                    foreach($web_detail as $web) { ?>
                                        <tr>
                                           
                                            <td><?php echo $web->fb; ?></td>
                                            <td><?php echo $web->insta; ?></td>
                                            <td><?php echo $web->linkedin; ?></td>
                                            <td><?php echo $web->twitter; ?></td>
                                             <td><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/header/'.$web->header_logo.'') ?>" style="height:80px"></td>
                                              <td><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/footer/'.$web->footer_logo.'') ?>" style="height:80px"></td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $web->id; ?>" ><i class="fa fa-edit"></i></a>
                                                
                                            </td>                                                                         
                                        </tr>
                                        <div class="modal" id="myeditModal<?php echo $web->id; ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Web Setting</h4>
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                     <div class="modal-body">
                                                        <form method="post" action="{{route('update_web_setting')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group bmd-form-group">
                                                                        <label class="bmd-label-floating">Enter Facebook Link</label>
                                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $web->id; ?>" autocomplete="off" required="" >
                                                                        <input type="url" class="form-control" name="fb" value="<?php echo $web->fb; ?>" autocomplete="off" required="" >
                                                                        @if ($errors->has('fb'))
                                                                        <strong class="text-danger">{{ $errors->first('fb') }}</strong>                                   
                                                                        @endif
                                                                    </div>                      
                                                                </div>                  

                                                                <div class="col-sm-4">
                                                                    <div class="form-group bmd-form-group">
                                                                        <label class="bmd-label-floating">Enter Instagram Link</label>
                                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $web->id; ?>" autocomplete="off" required="" >
                                                                        <input type="url" class="form-control" name="insta" value="<?php echo $web->insta; ?>" autocomplete="off" required="" >
                                                                        @if ($errors->has('insta'))
                                                                        <strong class="text-danger">{{ $errors->first('insta') }}</strong>                                   
                                                                        @endif
                                                                    </div>                      
                                                                </div>  

                                                                <div class="col-sm-4">
                                                                    <div class="form-group bmd-form-group">
                                                                        <label class="bmd-label-floating">Enter LinkedIn Link</label>
                                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $web->id; ?>" autocomplete="off" required="" >
                                                                        <input type="url" class="form-control" name="linkedin" value="<?php echo $web->linkedin; ?>" autocomplete="off" required="" >
                                                                        @if ($errors->has('linkedin'))
                                                                        <strong class="text-danger">{{ $errors->first('linkedin') }}</strong>                                   
                                                                        @endif
                                                                    </div>                      
                                                                </div>  

                                                                <div class="col-sm-4">
                                                                    <div class="form-group bmd-form-group">
                                                                        <label class="bmd-label-floating">Enter Twitter Link</label>
                                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $web->id; ?>" autocomplete="off" required="" >
                                                                        <input type="url" class="form-control" name="twitter" value="<?php echo $web->twitter; ?>" autocomplete="off" required="" >
                                                                        @if ($errors->has('twitter'))
                                                                        <strong class="text-danger">{{ $errors->first('twitter') }}</strong>                                   
                                                                        @endif
                                                                    </div>                      
                                                                </div>  

                                                                <div class="col-sm-4">
                                                                    <div class="form-group bmd-form-group is-filled">
                                                                        <label class="bmd-label-floating">Choose Header Logo</label>
                                                                        <input type="file" class="form-control" name="header_logo" accept="image/*"  autocomplete="off" >
                                                                        <input type="hidden" class="form-control" name="old_header_logo" value="<?php echo $web->header_logo; ?>"  autocomplete="off" >
                                                                        <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/header/'.$web->header_logo.'') ?>" style="height:30px;width:40px;">
                                                                        @if ($errors->has('header_logo'))
                                                                        <strong class="text-danger">{{ $errors->first('header_logo') }}</strong>                                  
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <div class="form-group bmd-form-group is-filled">
                                                                        <label class="bmd-label-floating">Choose Foter Logo</label>
                                                                        <input type="file" class="form-control" name="footer_logo" accept="image/*"  autocomplete="off" >
                                                                        <input type="hidden" class="form-control" name="old_footer_logo" value="<?php echo $web->footer_logo; ?>"  autocomplete="off" >
                                                                        <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/footer/'.$web->footer_logo.'') ?>" style="height:30px;width:40px;">
                                                                        @if ($errors->has('footer_logo'))
                                                                        <strong class="text-danger">{{ $errors->first('footer_logo') }}</strong>                                  
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
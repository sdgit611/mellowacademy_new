@extends('developer.layout')
@section('content')


<div class="page-content">
    <div class="row">
        <div class="col-lg-8 ml-auto mr-auto">
            @if(Session::has('devkycerrmsg'))                 
                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                       <strong>{{Session::get('devkycerrmsg')}}</strong>
                </div>
                {{Session::forget('message')}}
                {{Session::forget('devkycerrmsg')}}
            @endif
        </div>
    </div>
</div>

<div class="page-content" style="padding-top:30px;">
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update KYC Details</h5>
                        <?php 
                            foreach($developer_details as $dd) { ?>
                            <form method="post" action="{{ route('update_developer_kyc') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label class="bmd-label-floating">Upload Residance Proofe/Aadhar Card</label>
                                            <input type="file" class="form-control" name="adharcard" autocomplete="off" >
                                            <input type="hidden" class="form-control" name="old_adharcard" value="<?php echo $dd->adharcard; ?>"  autocomplete="off">
                                            <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/adhar_card/'.$dd->adharcard.'') ?>" style="height:30px;width:40px;">
                                            @if ($errors->has('adharcard'))
                                            <strong class="text-danger">{{ $errors->first('adharcard') }}</strong>                                  
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label class="bmd-label-floating">Upload PAN/TAX Card</label>
                                            <input type="file" class="form-control" name="pancard" autocomplete="off" >
                                            <input type="hidden" class="form-control" name="old_pancard" value="<?php echo $dd->pancard; ?>"  autocomplete="off">
                                            <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/pan_card/'.$dd->pancard.'') ?>" style="height:30px;width:40px;">
                                            @if ($errors->has('pancard'))
                                            <strong class="text-danger">{{ $errors->first('pancard') }}</strong>                                  
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Nation Identification</label>
                                            <select name="national_id_name" id="national_id_name" class="form-control" required>
                                                <option value="">Choose</option>
                                                <option value="Passport">Passport</option>
                                                <option value="Driving License">Driving License</option>
                                                <option value="Voter Card">Voter Card</option>
                                            </select>
                                            @if ($errors->has('national_id_name'))
                                            <strong class="text-danger">{{ $errors->first('national_id_name') }}</strong>                                   
                                            @endif
                                        </div>                      
                                    </div> 

                                    <div class="col-sm-6">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label class="bmd-label-floating">Upload National Id Image</label>
                                            <input type="file" class="form-control" name="national_id_image" accept="image/*"  autocomplete="off" >
                                            <input type="hidden" class="form-control" name="old_national_id_image" value="<?php echo $dd->national_id_image; ?>"  autocomplete="off">
                                            <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/national_image/'.$dd->national_id_image.'') ?>" style="height:30px;width:40px;">
                                            @if ($errors->has('national_id_image'))
                                            <strong class="text-danger">{{ $errors->first('national_id_image') }}</strong>                                  
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label class="bmd-label-floating">Upload Profile Image</label>
                                            <input type="file" class="form-control" name="image" accept="image/*"  autocomplete="off" >
                                            <input type="hidden" class="form-control" name="old_image" value="<?php echo $dd->image; ?>"  autocomplete="off">
                                            <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/developer/'.$dd->image.'') ?>" style="height:30px;width:40px;">
                                            @if ($errors->has('image'))
                                            <strong class="text-danger">{{ $errors->first('image') }}</strong>                                  
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label class="bmd-label-floating">Upload Signature</label>
                                            <input type="file" class="form-control" name="signature" autocomplete="off" >
                                            <input type="hidden" class="form-control" name="old_signature" value="<?php echo $dd->image; ?>"  autocomplete="off">
                                            <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/signature/'.$dd->signature.'') ?>" style="height:30px;width:40px;">
                                            @if ($errors->has('signature'))
                                            <strong class="text-danger">{{ $errors->first('signature') }}</strong>                                  
                                            @endif
                                        </div>
                                    </div>                  
                                    
                                    <div class="col-sm-4">
                                        <div class="form-group bmd-form-group">
                                            <button type="submit" class="btn btn-success btn-block">Update KYC Details</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
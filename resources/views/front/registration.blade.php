@extends('front.layout')
@section('content')
       
    <section class="login">
        <header class="d-none">
            <div class="container">
                <h2 class="title">Login & registration</h2>
                <div class="text">
                    <p>Suspendisse scelerisque odio eu felis eleifend, vitae gravida magna iaculis. Vestibulum volutpat, purus in consectetur porta, velit felis suscipit metus, et pharetra enim augue suscipit est. Aenean non ante tortor. Nam egestas tincidunt turpis, quis accumsan est vestibulum non</p>
                    <hr />
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </div>
            </div>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-12">  
                    @if(Session::has('errmsg'))                 
                    <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                        <center> <strong>{{Session::get('errmsg')}}</strong></center>
                    </div>
                    {{Session::forget('message')}}
                    {{Session::forget('errmsg')}}
                    @endif
                </div>
            </div>  
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="login-wrapper">
                       

                    <div class="login-block login-block-signup">
                        <div class="h4">Register now <a href="javascript:void(0);" class="btn btn-main btn-sm btn-register pull-right">Already member?</a></div>
                        <hr />
                        <form method="post" action="{{route('submit_registeration')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="" class="form-control" name="fname" placeholder="First name: *">
                                    @if ($errors->has('fname'))
                                        <strong class="text-danger">{{ $errors->first('fname') }}</strong>                                   
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="" class="form-control" name="lname" placeholder="Last name: *">
                                    @if ($errors->has('lname'))
                                        <strong class="text-danger">{{ $errors->first('lname') }}</strong>                                   
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="" class="form-control" name="user_name" placeholder="User name: *">
                                    @if ($errors->has('user_name'))
                                        <strong class="text-danger">{{ $errors->first('user_name') }}</strong>                                   
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <input type="email" value="" class="form-control" name="email" placeholder="Email: *">
                                    @if ($errors->has('email'))
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>                                   
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" value="" class="form-control" name="password" placeholder="Password: *">
                                    @if ($errors->has('password'))
                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>                                   
                                    @endif
                                </div>
                            </div>  

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="" class="form-control" name="company_name" placeholder="Company Name: *">
                                    @if ($errors->has('company_name'))
                                        <strong class="text-danger">{{ $errors->first('company_name') }}</strong>                                   
                                    @endif
                                </div>
                            </div>                                    
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="" class="form-control" name="location" placeholder="Location: *">
                                    @if ($errors->has('location'))
                                        <strong class="text-danger">{{ $errors->first('location') }}</strong>                                   
                                    @endif
                                </div>
                            </div>  

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="" class="form-control" name="address" placeholder="Company Address">
                                    @if ($errors->has('address'))
                                        <strong class="text-danger">{{ $errors->first('address') }}</strong>                                   
                                    @endif
                                </div>
                            </div>                                    

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="tel" value="" class="form-control" name="phone" placeholder="Phone: *" maxlength="10">
                                    @if ($errors->has('phone'))
                                        <strong class="text-danger">{{ $errors->first('phone') }}</strong>                                   
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="purpose" id="purpose" class="form-control">
                                        <option value="">Select Purpose</option>
                                        <option value="For Myself">For Myself</option>
                                        <option value="For Organization">For Organization</option>
                                        <option value="For Designer">For Designer</option>
                                    </select>
                                    @if ($errors->has('purpose'))
                                        <strong class="text-danger">{{ $errors->first('purpose') }}</strong>                                   
                                    @endif
                                </div>
                            </div> 
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="" class="form-control" name="location" placeholder="Location: *">
                                    @if ($errors->has('location'))
                                        <strong class="text-danger">{{ $errors->first('location') }}</strong>                                   
                                    @endif
                                </div>
                            </div>  

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="" class="form-control" name="address" placeholder="Company Address">
                                    @if ($errors->has('address'))
                                        <strong class="text-danger">{{ $errors->first('address') }}</strong>                                   
                                    @endif
                                </div>
                            </div>   
                                                        
                           
                        </div>
                        <center>
                            <div class="col-md-12"><button class="btn btn-outline-dark" type="submit">Create account</button></div>
                            <a href="{{route('developer_registration')}}" target="_blank" class="open-popup btn btn-main btn-sm">Resource Center</a>
                        </center>
                        </form>
                    </div> 


                     <div class="login-block login-block-signin">
                            <div class="h4">Sign in <a href="javascript:void(0);" class="btn btn-main btn-sm  btn-login pull-right">Create an account</a></div>
                            <hr />
                            <form method="post" action="{{route('verify_login')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" name="phone" placeholder="Mobile Number / Email Address">
                                        @if ($errors->has('phone'))
                                            <strong class="text-danger">{{ $errors->first('phone') }}</strong>                                   
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="password"  class="form-control" id="myInputpassword" name="password" placeholder="Password">
                                        @if ($errors->has('password'))
                                            <strong class="text-danger">{{ $errors->first('password') }}</strong>                                   
                                        @endif
                                    </div>
                                </div>

                                 

                                <div class="col-lg-12 col-md-12">
                                        <span class="checkbox">
                                            <input type="checkbox" id="checkBoxId3"  onclick="myFunction()">
                                            <label for="checkBoxId3">Show Password &nbsp;<br><a href="{{route('forgetpassword')}}">Forgot password?</a></label>
                                        </span>
                                </div>
                                
                                <div class="col-md-12"> <hr />
                                        <button class="btn btn-primary" type="submit">Sign in</button><br>
                                        <a href="{{route('developer_registration')}}" target="_blank" class="open-popup btn btn-main btn-sm">Resource Center </a>
                                </div>
                            </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>

    </section>

    <script type="text/javascript">
        function myFunction() {
          var x = document.getElementById("myInputpassword");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
    </script>

    

@endsection
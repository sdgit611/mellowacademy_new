@if(Session::get('admin_email_login') == null)         
<script type="text/javascript">
    window.location.href = "adminindex";
</script>
@endif

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        
        <!-- Title -->
        <title>Mellow Elements! - Home - Admin Dashboard</title>
        
        <link rel="icon" href="{{ URL::asset('public/front/assets/images/Logo-01.png') }}">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
        <link href="{{ URL::asset('public/admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/admin/assets/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/admin/assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">  
      
        <link href="{{ URL::asset('public/admin/assets/css/connect.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/admin/assets/css/admin2.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/admin/assets/css/dark_theme.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/admin/assets/css/custom.css') }}" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="{{ URL::asset('public/front/js/sweetalert2.js') }}"></script>

        <style>
        .geeks {
            width: 200px;
            height: 150px;
            overflow: hidden;
            margin: 0 auto;
        }
      
        .geeks img {
            width: 100%;
            transition: 0.5s all ease-in-out;
        }
      
        .geeks:hover img {
            transform: scale(1.5);
        }
    </style>

    </head>
    <body>
        <!--<div class='loader'>-->
        <!--    <div class='spinner-grow text-primary' role='status'>-->
        <!--        <span class='sr-only'>Loading...</span>-->
        <!--    </div>-->
        <!--</div>-->

        <div class="connect-container align-content-stretch d-flex flex-wrap">
            <div class="page-container">
                <div class="page-header">
                    <nav class="navbar navbar-expand container">
                        <div class="logo-box"><a href="{{ route('dashboard')}}" class="logo-text">Mellow Elements</a></div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <ul class="navbar-nav">
                            <li class="nav-item small-screens-sidebar-link">
                                <a href="#" class="nav-link"><i class="material-icons-outlined">menu</i></a>
                            </li>
                            <li class="nav-item nav-profile dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ URL::asset('public/front/assets/images/Logo-01.png') }}" alt="profile image">
                                    
                                    
                                    @if(isset($rolesdetails))
                                    
                                    <?php
                                   
                                    $id=Session::get('admin_email_role');
                                    // echo $id; exit();
                                    foreach($rolesdetails as $d){
                                    if($d->role == "Admin"){
                                    
                                    ?>
                                    <span>Admin</span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>
                                    <?php }elseif($d->role == "HR"){ ?>
                                    <span>HR</span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>
                                    <?php }elseif($d->role == "Blogger"){ ?>
                                    <span>Blogger</span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>
                                    
                                    <?php } } ?>
                                    @endif
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="change_password">Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('logout')}}">Log out</a>
                                </div>
                            </li>
                        </ul>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="#" class="nav-link"></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="navbar-search">
                            <form>
                                <div class="form-group">
                                    <input type="text" name="search" id="nav-search" placeholder="Search...">
                                </div>
                            </form>
                        </div>
                    </nav>
                </div>
                <div class="horizontal-bar">
                    <div class="logo-box"><a href="#" class="logo-text">Connect</a></div>
                    <a href="#" class="hide-horizontal-bar"><i class="material-icons">close</i></a>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="horizontal-bar-menu">
                                     @if(isset($rolesdetails))
                                    <?php
                                   
                                    $id=Session::get('admin_email_role');
                                    // echo $id; exit();
                                    foreach($rolesdetails as $d){
                                    if($d->role == "Admin"){
                                    
                                    ?>
                                    <ul>
                                        <li><a href="{{route('dashboard')}}" class="active"><i class="material-icons">dashboard</i> Dashboard</a></li>
                                        <li>
  
                                           <li><a href="{{route('banner')}}"><i class="material-icons">vrpano</i> Banners</a></li>
                                            
                                        </li>
                                        <li>
                                            <a href="#"><i class="material-icons">move_up</i> Overview<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                                <!--<li><a href="{{route('banner')}}">Banners </a></li>-->
                                                <li><a href="{{route('about')}}">About </a></li>
                                                <li><a href="{{route('License')}}">Commercial License</a></li>
                                                <!--<li><a href="{{route('web_setting')}}"></a></li>-->
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#"><i class="material-icons">category</i> Category Details<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                                <li><a href="{{route('category')}}">Add Category</a></li>
                                                <li><a href="{{route('subcategory')}}">Sub-Category</a></li>
                                                <!--<li><a href="{{route('web_hosting')}}">Web Hosting</a></li>-->
                                            </ul>
                                        </li>
                                        
                                        <li><a href="{{route('web_hosting')}}"><i class="material-icons">domain_add</i> Web Hosting</a></li>

                                        <li>
  
                                           <a href="#"><i class="material-icons">production_quantity_limits</i> Add Product<i class="material-icons">keyboard_arrow_down</i></a>
                                           <ul>
                                                <li><a href="{{route('products')}}">All Products</a></li>
                                                <li><a href="{{route('addproducts')}}">Add Product</a></li>
                                                <!--<li><a href="{{route('web_hosting')}}">Web Hosting</a></li>-->
                                            </ul>
                                            
                                        </li>

                                        <li>
                                            <a href="{{route('product_order')}}"><i class="material-icons">shopping_cart</i> Product Order</a>
                                           
                                                <!--<li><a href="{{route('products')}}">Add Product</a></li>-->
                                                <!--<li><a href="{{route('product_order')}}">Product Order Details</a></li>-->
                                                <!--<li><a href="{{route('all_rating')}}"> Rating</a></li>-->
                                                <!--<li><a href="{{route('developer_order')}}">Developer Details</a></li>  -->
                                                <!--<li><a href="{{route('customer_details')}}">Customer Details</a></li>-->
                                            
                                        </li>
                                        <li>
  
                                           <li><a href="{{route('all_rating')}}"><i class="material-icons">star_half</i> Product Rating</a></li>
                                            
                                        </li>
                                        <li>
                                           
                                            <li><a href="{{route('commission')}}"><i class="material-icons">percent</i> Commission</a></li>  
                                            
                                        </li>                                        
                                        
                                        <li>
                                            <a href="#"><i class="material-icons">manage_accounts</i> Higher Professional<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                                <li><a href="{{route('hig_prof')}}">Add Professional Category</a></li>
                                                <!--<li><a href="{{route('commission')}}">Commission</a></li>-->
                                                <!--<li><a href="{{route('requested_developer_details')}}">Requested Developer Details</a></li>-->
                                                <li><a href="{{route('active_developer_details')}}">Professional Developer Details</a></li>
                                                <li><a href="{{route('developer_project_details')}}">Developer Project Details</a></li>
                                                <li><a href="{{route('premium_developer')}}">Premium Developer</a></li>   
                                                <li><a href="{{route('interview_schedule_developer')}}">Interview Resource</a></li>   
                                            </ul>
                                        </li>
                                        
                                        <li>
                                            
                                            <li><a href="{{route('requested_developer_details')}}"><i class="material-icons">verified_user</i> Developer Request</a></li>  
                                            
                                        </li>
                                        
                                        <li>

                                            <li><a href="{{route('request_for_reward')}}"><i class="material-icons">military_tech</i> Reward</a></li>  
                                            
                                        </li>
                                        
                                        <li>
  
                                           <li><a href="{{route('all_visitor')}}"><i class="material-icons">settings_accessibility</i> All Visitors</a></li>
                                            
                                        </li>
  
                                        <li>
                                            <a href="#"><i class="material-icons">add_link</i> Quick Links<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                                <li><a href="{{route('faqs')}}">FAQs</a></li>
                                                <!--<li><a href="{{route('all_visitor')}}">All Visitor</a></li>-->
                                                <li><a href="{{route('blog')}}">Blogs</a></li>  
                                                <li><a href="{{route('refund')}}">Refund Ploicy</a></li>
                                                <li><a href="{{route('privacy_policy')}}">Privacy Policy</a></li>
                                                <li><a href="{{route('term_condition')}}">Terms & Conditions</a></li>   
                                            </ul>
                                        </li>
                                        
                                        <li>
                                            <a href="#"><i class="material-icons">contacts</i> Contact Information<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                                <li><a href="{{route('add_contact')}}">Add Contact Details</a></li>
                                                <li><a href="{{route('contactus')}}">Contact Users </a></li>   
                                                <li><a href="{{route('free_consultations')}}"> Free Consultation</a></li>
                                                <li><a href="{{route('our_partner')}}"> Our Partners</a></li>
                                                <li><a href="{{route('millaw_vault')}}"> Why Mellow Vault</a></li>
                                                <li><a href="{{route('developer_details_admin')}}"> Developer Details</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <li><a href="{{route('resoure_details')}}"><i class="material-icons">integration_instructions</i> Resource</a></li>    
                                        </li>
                                       
                                        <!--<li><a href="{{route('change_password')}}"><i class="material-icons">vpn_key</i> Change Password</a></li>-->
                                        <!--<li><a href="{{route('service')}}"><i class="material-icons">notification_important</i><i class="material-icons">save_alt</i><i class="material-icons">videocam</i> Service</a></li>-->
                                        
                                        <li><a href="{{route('web_setting')}}"><i class="material-icons">settings</i> Web Settings</a></li>

                                


                                        <!--<li><a href="{{route('products')}}"><i class="material-icons">shopping_cart</i> Product</a></li>-->
                                        <li><a href="{{route('premium')}}"><i class="fas fa-coins"> </i> Try to Premium</a></li>

                                        
                                        
                                    </ul>
                                    
                                    <?php }elseif($d->role == "HR"){ ?>
                                    
                                    <ul>
                                        <li><a href="{{route('dashboard')}}" class="active"><i class="material-icons">dashboard</i> Dashboard</a></li>
                                      
                                        <li>
                                           
                                            <li><a href="{{route('commission')}}"><i class="material-icons">percent</i> Commission</a></li>  
                                            
                                        </li>
                                        
                                        <li>
                                            <a href="#"><i class="material-icons">manage_accounts</i> Higher Professional<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                                <li><a href="{{route('hig_prof')}}">Add Professional Category</a></li>
                                                <!--<li><a href="{{route('commission')}}">Commission</a></li>-->
                                                <!--<li><a href="{{route('requested_developer_details')}}">Requested Developer Details</a></li>-->
                                                <li><a href="{{route('active_developer_details')}}">Professional Developer Details</a></li>
                                                <li><a href="{{route('developer_project_details')}}">Developer Project Details</a></li>
                                                <li><a href="{{route('premium_developer')}}">Premium Developer</a></li>   
                                                <li><a href="{{route('interview_schedule_developer')}}">Interview Resource</a></li>   
                                            </ul>
                                        </li>
                                        
                                        <li>
                                            
                                            <li><a href="{{route('requested_developer_details')}}"><i class="material-icons">verified_user</i> Developer Request</a></li>  
                                            
                                        </li>
                                        
                                        <li>

                                            <li><a href="{{route('request_for_reward')}}"><i class="material-icons">military_tech</i> Reward</a></li>  
                                            
                                        </li>
                                      
  
                                        <li>
                                            <li><a href="{{route('resoure_details')}}"><i class="material-icons">integration_instructions</i> Resource</a></li>    
                                        </li>
                                       
                                        
                                    </ul>
                                    
                                    
                                    <?php }elseif($d->role == "Blogger"){ ?>
                                    
                                    <ul>
                                        <li><a href="{{route('dashboard')}}" class="active"><i class="material-icons">dashboard</i> Dashboard</a></li>
                                      
                                        <li>
                                            <a href="#"><i class="material-icons">add_link</i> Add Blogs<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                          
                                                <li><a href="{{route('blog')}}">Blogs</a></li>  
                                      
                                            </ul>
                                        </li>
                                        
                                    </ul>
                                    
                                    <?php } } ?>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                @yield('content')

                <div class="page-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="footer-text">2021 © Mellow Elements</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Javascripts -->
        <script src="{{ URL::asset('public/admin/assets/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ URL::asset('public/admin/assets/plugins/bootstrap/popper.min.js') }}"></script>
        <script src="{{ URL::asset('public/admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('public/admin/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    
        <script src="{{ URL::asset('public/admin/assets/plugins/DataTables/datatables.min.js') }}"></script>

        <script src="{{ URL::asset('public/admin/assets/js/connect.min.js') }}"></script>

        <script src="{{ URL::asset('public/admin/assets/js/pages/datatables.js') }}"></script>        

        <script src="{{ URL::asset('public/admin/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
        <script src="{{ URL::asset('public/admin/assets/plugins/apexcharts/dist/apexcharts.min.js') }}"></script>
        <script src="{{ URL::asset('public/admin/assets/plugins/blockui/jquery.blockUI.js') }}"></script>
        <script src="{{ URL::asset('public/admin/assets/plugins/flot/jquery.flot.min.js') }}"></script>
        <script src="{{ URL::asset('public/admin/assets/plugins/flot/jquery.flot.time.min.js') }}"></script>
        <script src="{{ URL::asset('public/admin/assets/plugins/flot/jquery.flot.symbol.min.js') }}"></script>
        <script src="{{ URL::asset('public/admin/assets/plugins/flot/jquery.flot.resize.min.js') }}"></script>
        <script src="{{ URL::asset('public/admin/assets/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
        
        
        <script src="{{ URL::asset('public/admin/assets/js/pages/dashboard.js') }}"></script>

        <script src="{{URL::asset('public/admin/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
        <script> CKEDITOR.replace( 'content' );</script>
        <script> CKEDITOR.replace( 'Additions' );</script>
        <script> CKEDITOR.replace( 'Overview' );</script>
        

        <script>
            $(document).ready(function() {
                $('#c_id').on('change', function() {
                    var c_id = $('#c_id').val();
                    var v_token = "{{csrf_token()}}";
                    $.ajax({
                        type:"POST",
                        url:"{{route('show')}}",
                       data: {c_id:c_id,_token:v_token},
                        success:function(response)
                        {
                            $('#subcategory_id').html(response); 
                        }
                    });
                });
            });
        </script> 

        <script type="text/javascript">
            $(document).ready(function() {
            $('#complex-header').DataTable();
            } );
        </script>   

        <script type="text/javascript">
            function update_status(developer_status,dev_id){
                var developer_status = developer_status;
                var dev_id=dev_id;
                var v_token = "{{csrf_token()}}";
                $.ajax({
                    type:"POST",
                    url:"{{route('developer_status')}}",
                    data: {developer_status:developer_status,dev_id:dev_id,_token:v_token},
                    success: function(response){
                      alert(response);
                      location.reload();
                    }
                });
            }
        </script>

        <script>
            $("#checkAl").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        </script>

         
        
    </body>
</html>
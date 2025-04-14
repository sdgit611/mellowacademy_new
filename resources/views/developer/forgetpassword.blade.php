<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <title>Please Login Here - Mellow Vault</title>

    <link rel="icon" href="{{ URL::asset('public/front/assets/images/Logo-01.png') }}">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
    <link href="{{ URL::asset('public/developer/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/developer/assets/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/developer/assets/css/connect.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/developer/assets/css/admin2.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/developer/assets/css/dark_theme.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/developer/assets/css/custom.css') }}" rel="stylesheet">

    <style>
    .loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(255, 255, 255, 0.7);
        z-index: 9999;
        display: none;
        justify-content: center;
        align-items: center;
    }
    </style>
</head>

<body class="auth-page sign-in">

    <!-- Loader -->
    <div class='loader'>
        <div class='spinner-border text-primary' role='status'>
            <span class='sr-only'>Loading...</span>
        </div>
    </div>

    <div class="connect-container align-content-stretch d-flex flex-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="auth-form">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-lg-8 ml-auto mr-auto">
                                        @if(session('success'))
                                        <div id="flash-message"
                                            class="alert alert-success alert-dismissible fade show position-fixed"
                                            style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>{{ session('success') }}</strong>
                                        </div>
                                        @endif

                                        @if(session('error'))
                                        <div id="flash-message"
                                            class="alert alert-danger alert-dismissible fade show position-fixed"
                                            style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>{{ session('error') }}</strong>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="logo-box text-center">
                                    <a href="{{ url('/') }}" class="logo-text">
                                        <img src="{{ URL::asset('public/front/assets/images/Logo-01.png') }}" alt=""
                                            width="150" height="95" />
                                    </a>
                                </div>

                                <form id="forgot-password-form" method="post" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email Address *">
                                        <strong id="email-error" class="text-danger d-block mt-1"></strong>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block btn-submit" id="submitBtn">
                                        <span class="btn-text">Send Password Reset Link</span>
                                        <span class="spinner-border spinner-border-sm d-none" role="status"
                                            aria-hidden="true"></span>
                                    </button>

                                    <a href="{{ route('developer_admin') }}"><span>Sign In</span></a>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-none d-lg-block d-xl-block">
                    <div class="auth-image"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ URL::asset('public/developer/assets/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}">
    </script>
    <script src="{{ URL::asset('public/developer/assets/js/connect.min.js') }}"></script>

    <!-- AJAX and Flash -->
    <script>
    $(document).ready(function() {
        $('#forgot-password-form').on('submit', function(e) {
            e.preventDefault();
            let email = $('#email').val();
            let token = $('input[name="_token"]').val();
            let emailError = $('#email-error');
            let submitBtn = $('#submitBtn');
            emailError.text('');
            $('.loader').fadeIn(); // Show loader
            submitBtn.prop('disabled', true);
            submitBtn.find('.btn-text').text('Sending...');
            submitBtn.find('.spinner-border').removeClass('d-none');
            $.ajax({
                url: "{{ route('password.email') }}",
                type: "POST",
                data: {
                    email: email,
                    _token: token
                },
                success: function(response) {
                    $('.loader').fadeOut();
                    submitBtn.prop('disabled', false);
                    submitBtn.find('.btn-text').text('Send Password Reset Link');
                    submitBtn.find('.spinner-border').addClass('d-none');


                    showFlash('success', response.message ||
                        'A password reset link has been sent.');
                    $('#forgot-password-form')[0].reset();
                },
                error: function(xhr) {
                    $('.loader').fadeOut();
                    submitBtn.prop('disabled', false);
                    submitBtn.find('.btn-text').text('Send Password Reset Link');
                    submitBtn.find('.spinner-border').addClass('d-none');

                    if (xhr.status === 422 && xhr.responseJSON.errors.email) {
                        emailError.text(xhr.responseJSON.errors.email[0]);
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        showFlash('error', xhr.responseJSON.message);
                    }
                }
            });
        });

        function showFlash(type, message) {
            let alertType = type === 'success' ? 'alert-success' : 'alert-danger';
            let flashHtml = `
        <div id="flash-message"
            class="alert ${alertType} alert-dismissible fade show position-fixed"
            style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>${message}</strong>
        </div>`;

            $('body').append(flashHtml);

            setTimeout(() => {
                $('#flash-message').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 7000);
        }

    });
    </script>

</body>

</html>
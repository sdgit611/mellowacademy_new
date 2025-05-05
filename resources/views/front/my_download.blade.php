@extends('front.layout')

@section('content')

<section class="blog blog-category blog-animated">
    @if($order_empty > 0)
        <br>

        <header>
            <div class="container">
                <h2 class="title">Downloads</h2>
            </div>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-3" style="padding-bottom:12px;">
                    <div class="sticky-top">
                        <div class="card">
                            @php
                                $id = Session::get('user_login_id');
                            @endphp
                            @foreach($user_details as $uu)
                                @if($id === $uu->id)
                                    <div class="card-header">
                                        <a href="#">Hi! {{ $uu->fname }}</a>
                                    </div>
                                @endif
                            @endforeach
                            <div class="list-group">
                                <a href="{{ route('user_profile') }}" class="list-group-item"><i class="fa fa-user" aria-hidden="true"></i> My Profile <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <!-- <a href="{{ route('my_download') }}" class="list-group-item"><i class="fa fa-download" aria-hidden="true"></i> Downloads <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                                <!-- <a href="{{ route('act_setting') }}" class="list-group-item"><i class="fa fa-gear" aria-hidden="true"></i> Account Settings <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                                <a href="{{ route('show_invoice') }}" class="list-group-item"><i class="fa fa-yelp" aria-hidden="true"></i> Invoice <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                                @if($developer_order_details > 0)
                                    <a href="{{ route('client_dashboard') }}" class="list-group-item"><i class="fa fa-plus" aria-hidden="true"></i> Work Space <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{ route('resource') }}" class="list-group-item"><i class="fa fa-child" aria-hidden="true"></i> Resource <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{ route('assign_work') }}" class="list-group-item"><i class="fa fa-suitcase" aria-hidden="true"></i> Assign Work <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                @endif
                                <a href="{{ route('user_logout') }}" class="list-group-item"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="clearfix">
                        @foreach($order_details as $order)
                            @if($id == $order->u_id)
                                <article class="article-table">
                                    <div class="row">
                                        @if($order->image == '')
                                            <div class="col-md-4">
                                                <video width="100%" height="auto" controls controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();">
                                                    <source src="{{ asset('public/upload/video/' . $order->video) }}" type="video/mp4" allowfullscreen>
                                                </video>
                                            </div>
                                        @else
                                            <div class="col-md-4">
                                                <img class="img-fluid img-thumbnail" src="{{ asset('public/upload/product/' . $order->image) }}" style="height:201px;width:100%;">
                                            </div>
                                        @endif
                                        <div class="col-md-4 text">
                                            <div class="title">
                                                <h2 class="h5">{{ $order->name }}</h2>
                                                @foreach($pro_rating as $prate)
                                                    @if($order->p_id == $prate->p_id)
                                                        @php
                                                            $rate = $prate->rating;
                                                        @endphp
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fa fa-star" style="color: {{ $rate >= $i ? ($rate <= 2 ? 'red' : ($rate <= 3 ? 'yellow' : 'green')) : 'gray' }}"></i>
                                                        @endfor
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-4 text">
                                            <div class="text-intro">
                                                <a href="{{ route('download', $order->p_id) }}" type="button" class="btn btn-success">Download <i class="fa fa-download"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    @else
        <br><br><br><br><br>
        <div class="container">
            <div class="cart-wrapper">
                <div class="row">
                    <div class="col-md-3">
                        <div class="sticky-top">
                            <div class="card">
                                @foreach($user_details as $uu)
                                    @if($id === $uu->id)
                                        <div class="card-header">
                                            <a href="#">Hi! {{ $uu->fname }}</a>
                                        </div>
                                    @endif
                                @endforeach
                                <div class="list-group">
                                    <a href="{{ route('user_profile') }}" class="list-group-item"><i class="fa fa-user" aria-hidden="true"></i> My Profile <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{ route('my_download') }}" class="list-group-item"><i class="fa fa-download" aria-hidden="true"></i> Downloads <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{ route('act_setting') }}" class="list-group-item"><i class="fa fa-gear" aria-hidden="true"></i> Account Settings <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{ route('show_invoice') }}" class="list-group-item"><i class="fa fa-yelp" aria-hidden="true"></i> Invoice <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                                    @if($developer_order_details > 0)
                                        <a href="{{ route('client_dashboard') }}" class="list-group-item"><i class="fa fa-plus" aria-hidden="true"></i> Work Space <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <a href="{{ route('resource') }}" class="list-group-item"><i class="fa fa-child" aria-hidden="true"></i> Resource <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <a href="{{ route('assign_work') }}" class="list-group-item"><i class="fa fa-suitcase" aria-hidden="true"></i> Assign Work <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    @endif
                                    <a href="{{ route('user_logout') }}" class="list-group-item"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <center>
                            <h5><img src="{{ asset('public/front/assets/images/2.png') }}" class="rounded-circle" width="310px" height="250px"></h5>
                            <h4 class="card-title">Oops! Your Purchase Could Not Be Completed.</h4>
                            <hr style="width:550px;">
                            <a class="btn btn-primary btn-lg" href="{{ route('index') }}" role="button">Go <i class="fa fa-arrow-right"></i></a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>

@endsection

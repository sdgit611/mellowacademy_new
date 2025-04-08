@extends('client.layout')
@section('content')

<div class="page-content" style="padding-top:60px;">
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
        
        <div class="row stats-row">
            <div class="col-lg-4 col-md-12">
                <div class="card card-transparent stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title"></h5>
                            <p class="stats-text">Total Contact Details</p>
                        </div>
                        <div class="stats-icon change-success">
                            <i class="material-icons">trending_up</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card card-transparent stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title"></h5>
                            <p class="stats-text">Total Higher Professional Details</p>
                        </div>
                        <div class="stats-icon change-success">
                            <i class="material-icons">trending_up</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card card-transparent stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title"></h5>
                            <p class="stats-text">Total Products Details</p>
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
                        <h5 class="card-title">Savings</h5>
                        <div class="savings-stats">
                            
                            <span>Total savings</span>
                        </div>
                    </div>
                </div>
                <div class="card top-products">
                    <div class="card-body">
                        <h5 class="card-title">Popular Products<span class="card-title-helper">Today</span></h5>
                        <div class="top-products-list">
                            
                            
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
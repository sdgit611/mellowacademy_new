@extends('admin.layout')
@section('content')

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Premium Developer</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body" style="overflow-x:auto;">
                        <table id="complex-header" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Order Id</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Address</th>
                                    <th>Pincode</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;
                                    foreach($premium_developer_details as $pp) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $pp->order_id; ?></td>
                                            <td><?php echo $pp->name; ?> <?php echo $pp->last_name; ?></td>
                                            <td><?php echo $pp->email; ?></td>
                                            <td><?php echo $pp->phone; ?></td>
                                            <td><?php echo $pp->country; ?></td>
                                            <td><?php echo $pp->state; ?></td>
                                            <td><?php echo $pp->city; ?></td>
                                            <td><?php echo $pp->address_one; ?></td>
                                            <td><?php echo $pp->code; ?></td>
                                            <td><?php echo $pp->tprice; ?></td>
                                            <td><?php echo $pp->status; ?></td>
                                            <td><?php echo $pp->payment_status; ?></td>
                                            <td><?php echo $pp->date; ?></td>
                                        </tr>
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
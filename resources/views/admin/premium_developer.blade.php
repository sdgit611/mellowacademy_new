@extends('admin.layout')
@section('content')

<!-- Include DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-2">
                <li class="breadcrumb-item"><a href="#">Premium Developer</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card shadow-sm rounded">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Premium Developer Details</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="complex-header" class="table table-hover table-bordered mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Order ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <!-- <th>Address</th> -->
                                        <th>Pincode</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($premium_developer_details as $index => $pp)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pp->order_id }}</td>
                                            <td>{{ $pp->name }} {{ $pp->last_name }}</td>
                                            <td>{{ $pp->email }}</td>
                                            <td>{{ $pp->phone }}</td>
                                            <td>{{ $pp->country }}</td>
                                            <td>{{ $pp->state }}</td>
                                            <td>{{ $pp->city }}</td>
                                            <!-- <td>{{ $pp->address_one }}</td> -->
                                            <td>{{ $pp->code }}</td>
                                            <td>₹{{ number_format($pp->tprice, 2) }}</td>
                                            <td>
                                                <span class="badge {{ $pp->status == 'active' ? 'badge-success' : 'badge-warning' }}">
                                                    {{ ucfirst($pp->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $pp->payment_status == 'paid' ? 'badge-success' : 'badge-danger' }}">
                                                    {{ ucfirst($pp->payment_status) }}
                                                </span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($pp->date)->format('d M Y, h:i A') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="14" class="text-center text-muted">No records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-right">
                        Last updated: {{ now()->format('d M Y, h:i A') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<!-- DataTables Initialization -->
<script>
    $(document).ready(function () {
        $('#complex-header').DataTable({
            "pageLength": 10,
            "order": [],
            "language": {
                "search": "Search records:"
            }
        });
    });
</script>

@endsection

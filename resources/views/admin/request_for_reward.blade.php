@extends('admin.layout')
@section('content')

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Reward</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if(Session::has('widthdrawerrmsg'))
                    <div class="alert alert-{{ Session::get('message') }} alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('widthdrawerrmsg') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @php
                        Session::forget(['message', 'widthdrawerrmsg']);
                    @endphp
                @endif
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ url('withdraw_status_submit') }}">
                            @csrf

                            <table id="complex-header" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll"> Select All</th>
                                        <th>Developer Name</th>
                                        <th>Milestone Name</th>
                                        <th>Days</th>
                                        <th>Amount</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($requested_reward_details as $rd)
                                        <tr>
                                            <td><input type="checkbox" name="milestone_id[]" value="{{ $rd->id }}"></td>

                                            @php
                                                $dev = $developer_details->firstWhere('dev_id', $rd->dev_id);
                                                $price = $dev ? $dev->perhr : 0;
                                                $total_price = $rd->days * $price;
                                            @endphp

                                            <td>{{ $dev->name ?? 'N/A' }} {{ $dev->last_name ?? '' }}</td>
                                            <td>{{ $rd->milestone_name }}</td>
                                            <td>{{ $rd->days }}</td>
                                            <td>{{ $total_price }}</td>
                                            <td>
                                                <a class="btn btn-success" href="javascript:void(0);" data-toggle="modal" data-target="#rewardModal{{ $rd->id }}">Details</a>
                                            </td>
                                        </tr>

                                        <!-- Rating Modal -->
                                        <div class="modal fade" id="rewardModal{{ $rd->id }}" tabindex="-1" role="dialog" aria-labelledby="rewardModalLabel{{ $rd->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="rewardModalLabel{{ $rd->id }}">Rating Details</h5>
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    @foreach($developer_rating as $dr)
                                                        @if($dr->milestone_id == $rd->id)
                                                            @php
                                                                $fields = [
                                                                    'Logical Stability' => $dr->logical_stability,
                                                                    'Code Quality' => $dr->code_quality,
                                                                    'Understanding' => $dr->understanding,
                                                                    'Communication' => $dr->communication,
                                                                    'Behaviour' => $dr->behaviour,
                                                                    'Work Performance' => $dr->work_performance,
                                                                    'Delivery Review' => $dr->delivary_review,
                                                                ];
                                                            @endphp

                                                            @foreach($fields as $label => $value)
                                                                <div class="modal-body">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            {{ $label }} : {{ $value }} out of 5
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No reward requests found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            @if($total_requested_reward_details > 0)
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Approve</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('checkAll').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('input[name="milestone_id[]"]');
        for (let checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });
</script>
@endpush

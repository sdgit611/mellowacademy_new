@extends('admin.layout')
@section('content')

<br><br>
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Interview Schedule Resource</a></li>
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
                                    <th>Resource Name</th>
                                    <th>Email & Phone</th>
                                    <th>Address</th>
                                    <th>Per hour charge</th>
                                    <!-- <th>Skills</th> -->
                                    <th>Client</th>
                                    <th>Interview Date&Time</th>
                                    <th>Send Interview Details</th>
                                    <th>Review</th>
                                    <th>Approval</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach($interview_schedule_developer_details as $pp)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $pp->name }} {{ $pp->last_name }}</td>
                                    <td>{{ $pp->email }}<br>{{ $pp->phone }}</td>
                                    <td>{{ $pp->address }}</td>
                                    <td>Rating: {{ $pp->rating }}/5<br>₹{{ $pp->perhr }}/-</td>
                                    <!-- <td>{{ $pp->skills }}</td> -->
                                    <td>
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myClientModal{{ $pp->dev_id }}">Details</button>
                                    </td>
                                    <td>
                                        @if($pp->status == 'Interview Schedule')
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal{{ $pp->dev_id }}">Details</button>
                                        @else
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#mySendLinkModal{{ $pp->dev_id }}">Details</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($pp->status == 'Interview Schedule')
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#mySendModal{{ $pp->dev_id }}">Send</button>
                                        @else
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#mySendLinkModal{{ $pp->dev_id }}">View Now</button>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myReviewModal{{ $pp->dev_id }}">View</button>
                                    </td>
                                    <td>
                                        @if($pp->status == "Qualified")
                                            <a class="btn btn-danger btn-sm" href="{{ route('developer_approve_status', ['dev_id' => $pp->dev_id]) }}">Disapprove</a>
                                        @else
                                            <a class="btn btn-success btn-sm" href="{{ route('developer_approve_status', ['dev_id' => $pp->dev_id]) }}">Approve</a>
                                        @endif
                                    </td>
                                </tr>

                                {{-- Client Modal --}}
                                <div class="modal fade" id="myClientModal{{ $pp->dev_id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header"><h4 class="modal-title">Client Details</h4></div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5>Full Name</h5>
                                                        <p>{{ $pp->fname }} {{ $pp->lname }}</p>
                                                        <h5>Email</h5>
                                                        <p>{{ $pp->email }}</p>
                                                        <h5>Phone</h5>
                                                        <p>{{ $pp->phone }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Interview Date Modal --}}
                                <div class="modal fade" id="myModal{{ $pp->dev_id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header"><h4 class="modal-title">Interview Date & Time</h4></div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5>1st Interview Date&Time</h5>
                                                        <p>{{ $pp->interviewdateone }}</p>
                                                        <h5>2nd Interview Date&Time</h5>
                                                        <p>{{ $pp->interviewdatetwo }}</p>
                                                        <h5>3rd Interview Date&Time</h5>
                                                        <p>{{ $pp->interviewdatethree }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Send Interview Modal --}}
                                <div class="modal fade" id="mySendModal{{ $pp->dev_id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('send_interview_link') }}">
                                                @csrf
                                                <div class="modal-header"><h4 class="modal-title">Send Interview Link</h4></div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="dev_id" value="{{ $pp->dev_id }}">
                                                    <div class="form-group">
                                                        <label>Choose Interview Date & Time:</label><br>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" name="schinterviewdatetime" value="{{ $pp->interviewdateone }}">
                                                            <label class="form-check-label">{{ $pp->interviewdateone }}</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" name="schinterviewdatetime" value="{{ $pp->interviewdatetwo }}">
                                                            <label class="form-check-label">{{ $pp->interviewdatetwo }}</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" name="schinterviewdatetime" value="{{ $pp->interviewdatethree }}">
                                                            <label class="form-check-label">{{ $pp->interviewdatethree }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Interview Link:</label>
                                                        <input type="text" name="interviewlink" class="form-control" placeholder="Paste interview link">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Send</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- View Interview Link Modal --}}
                                <div class="modal fade" id="mySendLinkModal{{ $pp->dev_id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header"><h4 class="modal-title">Interview Details</h4></div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <h5>Scheduled Interview Date & Time</h5>
                                                    <p>{{ $pp->schinterviewdatetime }}</p>
                                                    <h5>Interview Link</h5>
                                                    <p>{{ $pp->interviewlink }}</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Review Modal --}}
                                <div class="modal fade" id="myReviewModal{{ $pp->dev_id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header"><h4 class="modal-title">Interview Review</h4></div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <h5>Review</h5>
                                                    <p>{{ $pp->review }}</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

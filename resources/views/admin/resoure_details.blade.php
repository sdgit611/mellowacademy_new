@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Resource Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Developer Full Name</th>
                                    <th>Developer Details</th>
                                    <th>Client Full Name</th>
                                    <th>Client Details</th>
                                    <th>Require Docs</th>
                                    <th>Short Message</th>
                                    <th>SOW</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resoure_details as $i => $rd)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $rd->name }} {{ $rd->last_name }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#editModal{{ $rd->dev_id }}">More Details</button>
                                    </td>
                                    <td>{{ $rd->fname }} {{ $rd->lname }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#myeditModal{{ $rd->u_id }}">Click Here</button>
                                    </td>
                                    <td><a class="btn btn-success"
                                            href="{{ route('require_docs_details', ['u_id' => $rd->u_id, 'dev_id' => $rd->dev_id]) }}">Details</a>
                                    </td>
                                    <td><a class="btn btn-success"
                                            href="{{ route('short_message_details', ['u_id' => $rd->u_id, 'dev_id' => $rd->dev_id]) }}">Details</a>
                                    </td>
                                    <td><a class="btn btn-success"
                                            href="{{ route('sow_details', ['u_id' => $rd->u_id, 'dev_id' => $rd->dev_id]) }}">Details</a>
                                    </td>
                                </tr>

                                <!-- Developer Modal -->
                                <div class="modal fade" id="editModal{{ $rd->dev_id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="developerModalLabel{{ $rd->dev_id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                        <div class="modal-content shadow-sm rounded">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title text-white"
                                                    id="developerModalLabel{{ $rd->dev_id }}">Developer Details</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <strong>Phone:</strong> {{ $rd->dev_phone }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Address:</strong> {{ $rd->address }}
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <strong>Job:</strong> {{ $rd->job }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Total Hours:</strong> {{ $rd->total_hours }}
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <strong>Per Hr:</strong> {{ $rd->perhr }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Rating:</strong> {{ $rd->rating }}
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <strong>Language:</strong> {{ $rd->language }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Education:</strong> {{ $rd->education }}
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <strong>Description:</strong>
                                                        <p class="mb-0">{!! $rd->description !!}</p>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <strong>Skills:</strong>
                                                        <p class="mb-0">{!! $rd->skills !!}</p>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <strong>Completed Jobs:</strong> {!! $rd->completed_job !!}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Date:</strong> {{ $rd->date }}
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6 text-center">
                                                        <strong>Image:</strong><br>
                                                        <img src="{{ asset('public/upload/developer/' . $rd->image) }}"
                                                            class="img-thumbnail" style="height:80px">
                                                    </div>
                                                    <div class="col-md-6 text-center">
                                                        <strong>Portfolio:</strong><br>
                                                        <img src="{{ asset('public/upload/portfolio/' . $rd->portfolio_image) }}"
                                                            class="img-thumbnail" style="height:80px">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <strong>Resume:</strong> <span
                                                            class="text-muted">{{ $rd->resume }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Client Modal -->
<div class="modal fade" id="myeditModal{{ $rd->u_id }}" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel{{ $rd->u_id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content shadow-sm rounded">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="clientModalLabel{{ $rd->u_id }}">Client Details</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Phone:</strong> {{ $rd->phone }}
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong> {{ $rd->email }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Address:</strong> {{ $rd->address_one }}
                    </div>
                    <div class="col-md-6">
                        <strong>Payment Status:</strong>
                        <span class="badge {{ $rd->payment_status == 'SUCCESS' ? 'badge-success' : 'badge-warning' }}">
                            {{ $rd->payment_status }}
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Country:</strong> {{ $rd->country }}
                    </div>
                    <div class="col-md-4">
                        <strong>State:</strong> {{ $rd->state }}
                    </div>
                    <div class="col-md-4">
                        <strong>City:</strong> {{ $rd->city }}
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
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
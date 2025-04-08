@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
    <div class="page-info container">
        
               
       
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Contact Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>

    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                 <a href="{{ route('export') }}" class="btn btn-primary">Excel</a><br>
            </div>
        </div><br>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Conatct Number</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
	                        <tbody>
                                <?php $i=1;
                                    foreach($info as $c) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $c->name; ?></td>
                                            <td><?php echo $c->email; ?></td>
                                            <td><?php echo $c->phone; ?></td>
                                            <td><?php echo $c->subject; ?></td>
                                            <td><?php echo $c->mesage; ?></td>
                                            <td><?php echo $c->date; ?></td>
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
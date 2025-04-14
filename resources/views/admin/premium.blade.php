@extends('admin.layout')
@section('content')

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Premium</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    
    <div class="main-wrapper container">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('premium_points_store') }}" method="POST" class="card p-4 mb-4">
            @csrf

            <div class="form-group">
                <label for="points">Points</label>
                <input type="text" name="points" id="points" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Premium Points</button>
        </form>

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
                                    <th>Point</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
	                        <tbody>
                               @foreach($premium as $key => $val)
                                    <tr>
                                        <td> {{$key + 1}} </td>
                                        <td> {{$val->name}} </td>
                                        <td> 
                                            <i class="fas fa-trash-alt" onclick="delet({{$val->id}})"></i>
                                            <i class="fas fa-pencil-alt"  data-toggle="modal" data-target="#exampleModal" onclick="update({{$val->id}})"></i>
                                        </td>
                                    </tr>
                               @endforeach
	                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
       	</div>
    </div>

    <div class="main-wrapper container">

        <form action="{{ route('premium_price_store') }}" method="POST" class="card p-4 mb-4">
            @csrf

            <div class="form-group">
                <label for="name">Type of package</label>
                <select name="name" id="name" class="form-control" required>
                    @foreach($prices as $val)
                        <option value="{{$val->id}}" > {{ucfirst($val->name)}} </option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Premium Points</button>
        </form>

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
                                    <th>Name</th>
                                    <th>Price</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
	                        <tbody>
                               @foreach($prices as $key => $val)
                                    <tr>
                                        <td> {{$key + 1}} </td>
                                        <td> {{$val->name}} </td>
                                        <td> {{$val->price}} </td>
                                        <!-- <td> 
                                            <i class="fas fa-trash-alt" onclick="delet({{$val->id}})"></i>
                                            <i class="fas fa-pencil-alt"  data-toggle="modal" data-target="#exampleModal" onclick="update({{$val->id}})"></i>
                                        </td> -->
                                    </tr>
                               @endforeach
	                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
       	</div>
    </div>

</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Premium Points</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('premium_points_update') }}" method="POST" class="card p-4 mb-4">
                    @csrf
                    <input type="hidden" name="id" id="updateId" class="form-control" required>

                    <div class="form-group">
                        <label for="points">Points</label>
                        <input type="text" name="points" id="UpdatePoints" class="form-control" required>
                    </div>
                
                    <button type="submit" class="btn btn-primary">Update Premium Points</button>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
    function update(id) {
        fetch("{{ route('premium_id') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                id: id
            })
        })
        .then(response => response.json())
        .then(data => {
            $('#UpdatePoints').val(data.data.name);
            $('#updateId').val(data.data.id);
        })
        .catch(error => {
            console.error("Error fetching premium point:", error);
        });
    }


    function delet(id) {
    fetch("{{ route('premium_points_delete') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                id: id
            })
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                title: "Successfully Deleted!",
                icon: "success",
                draggable: true
            }).then(() => {
                location.reload(); // Optionally reload the page or remove row from DOM
            });
        })
        .catch(error => {
            console.error("Error deleting premium point:", error);
        });
    }
</script>

@endsection
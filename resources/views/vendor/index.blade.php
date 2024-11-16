@extends('layout')

@section('content')    

   
<div class="main-panel">
        <div class="content-wrapper">

    <!-- Title for the Vendor List -->       
    <h4 class="mb-3">Vendor List</h4>

    <!-- Button Trigger Modal for Create -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Add New Vendor</button>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vendor Name</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vendor as $v)
                    <tr>
                        <td>{{ $v->id }}</td>
                        <td>{{ $v->nama_vendor }}</td>
                        <td>{{ $v->no_telp }}</td>
                        <td>{{ $v->alamat }}</td>
                        <td>
                            <!-- Button Trigger Modal for Edit -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $v->id }}">Edit</button>

                            <!-- Delete Form -->
                            <form action="{{ route('vendor.destroy', $v->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this vendor?');">Delete</button>
                            </form>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $v->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Vendor</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('vendor.update', $v->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama_vendor" class="form-label">Vendor Name</label>
                                                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="{{ $v->nama_vendor }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_telp" class="form-label">Phone Number</label>
                                                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $v->no_telp }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $v->alamat }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Vendor</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
</div>

<!-- Modal Create Vendor -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create New Vendor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('vendor.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_vendor" class="form-label">Vendor Name</label>
                        <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Address</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Vendor</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

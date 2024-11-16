@extends('layout')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <!-- Title for the Mandor Table -->
            <h4 class="mb-3">Mandor List</h4>

            <!-- Button Trigger Modal for Create -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Add New Mandor</button>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mandor as $mandor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mandor->nama }}</td>
                            <td>
                                <!-- Button Trigger Modal for Edit -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $mandor->id }}">Edit</button>

                                <!-- Delete Form -->
                                <form action="{{ route('mandor.destroy', $mandor->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this mandor?');">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $mandor->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $mandor->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $mandor->id }}">Edit Mandor</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('mandor.update', $mandor->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Mandor</label>
                                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $mandor->nama }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create New Mandor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('mandor.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Mandor</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Mandor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

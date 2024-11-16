@extends('layout')

@section('content')

<div class="container mt-4">
    <h4 class="mb-3">Edit Vendor</h4>

    <form action="{{ route('vendor.update', $vendor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_vendor" class="form-label">Vendor Name</label>
            <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="{{ $vendor->nama_vendor }}" required>
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $vendor->no_telp }}" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Address</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $vendor->alamat }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Vendor</button>
    </form>
</div>

@endsection

@extends('layout')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <h4 class="card-title">Add New Mandor</h4>
            <form action="{{ route('mandor.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Mandor</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Save Mandor</button>
                <a href="{{ route('mandor.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

@endsection

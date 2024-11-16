@extends('layout')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <h4 class="card-title">Edit Mandor</h4>
            <form action="{{ route('mandor.update', $mandor->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama Mandor</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $mandor->nama) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Mandor</button>
                <a href="{{ route('mandor.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

@endsection

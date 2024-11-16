@extends('layout')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <h4 class="card-title">Edit Pembelian</h4>
            <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="tanggal_pembelian">Tanggal Pembelian</label>
                    <input type="date" name="tanggal_pembelian" class="form-control" value="{{ old('tanggal_pembelian', $pembelian->tanggal_pembelian) }}" required>
                </div>

                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $pembelian->nama_barang) }}" required>
                </div>

                <div class="form-group">
                    <label for="vendor_id">Vendor</label>
                    <select name="vendor_id" class="form-control" required>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}" {{ $vendor->id == $pembelian->vendor_id ? 'selected' : '' }}>{{ $vendor->nama_vendor }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="mandor_id">Mandor</label>
                    <select name="mandor_id" class="form-control" required>
                        @foreach($mandors as $mandor)
                            <option value="{{ $mandor->id }}" {{ $mandor->id == $pembelian->mandor_id ? 'selected' : '' }}>{{ $mandor->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $pembelian->jumlah) }}" required>
                </div>

                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" class="form-control" value="{{ old('harga', $pembelian->harga) }}" required>
                </div>

                <div class="form-group">
                    <label for="nota">Nota (optional)</label>
                    <input type="text" name="nota" class="form-control" value="{{ old('nota', $pembelian->nota) }}">
                </div>

                <button type="submit" class="btn btn-primary">Update Pembelian</button>
                <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

@endsection

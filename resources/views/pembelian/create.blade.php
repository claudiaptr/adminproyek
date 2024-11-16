@extends('layout')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <h4 class="card-title">Add New Pembelian</h4>
            <form action="{{ route('pembelian.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="tanggal_pembelian">Tanggal Pembelian</label>
                    <input type="date" name="tanggal_pembelian" class="form-control" value="{{ old('tanggal_pembelian') }}" required>
                </div>

                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}" required>
                </div>

                <div class="form-group">
                    <label for="vendor_id">Vendor</label>
                    <select name="vendor_id" class="form-control" required>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->nama_vendor }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="mandor_id">Mandor</label>
                    <select name="mandor_id" class="form-control" required>
                        @foreach($mandors as $mandor)
                            <option value="{{ $mandor->id }}">{{ $mandor->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}" required>
                </div>

                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" name="harga" class="form-control" value="{{ old('harga') }}" required>
                </div>

                <div class="form-group">
                    <label for="nota">Nota (Upload Image)</label>
                    <input type="file" name="nota" class="form-control">
                </div>


                <button type="submit" class="btn btn-primary">Save Pembelian</button>
                <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>


@endsection

@section('scripts')
<script>
    // Format input as currency for harga
    const hargaInput = document.getElementById('harga');
    hargaInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^0-9]/g, '');  // Remove non-numeric characters
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ","); // Format with commas
        e.target.value = value;
    });
</script>
@endsection

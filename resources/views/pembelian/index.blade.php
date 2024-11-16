@extends('layout')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <!-- Title for the Pembelian Table -->
            <h4 class="mb-3">Pembelian List</h4>

            <!-- Button Trigger Modal for Create -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Add New Pembelian</button>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal Pembelian</th>
                            <th>Nama Barang</th>
                            <th>Vendor</th>
                            <th>Mandor</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                            <th>Nota</th> <!-- New Column for Nota -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembelian as $pembelian)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pembelian->tanggal_pembelian }}</td>
                            <td>{{ $pembelian->nama_barang }}</td>
                            <td>{{ $pembelian->vendor->nama_vendor }}</td>
                            <td>{{ $pembelian->mandor->nama }}</td>
                            <td>{{ $pembelian->jumlah }}</td>
                            <td>{{ number_format($pembelian->harga, 2) }}</td>
                            <td>{{ number_format($pembelian->jumlah * $pembelian->harga, 2) }}</td>
                             <!-- Nota Column (Download Link) -->
                             <td>
                                @if($pembelian->nota)
                                    <!-- Link ke file nota di tab baru -->
                                    <a href="{{ Storage::disk('public')->url('nota_files/' . $pembelian->nota) }}" target="_blank" class="btn btn-success btn-sm">
                                        <i class="fas fa-eye"></i> Lihat Nota
                                    </a>
                                @else
                                    <span class="text-muted">No Nota</span>
                                @endif
                            </td>


                            <td>
                                <!-- Button Trigger Modal for Edit -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $pembelian->id }}">Edit</button>

                                <!-- Delete Form -->
                                <form action="{{ route('pembelian.destroy', $pembelian->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this pembelian?');">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $pembelian->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $pembelian->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $pembelian->id }}">Edit Pembelian</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                                                <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="{{ $pembelian->tanggal_pembelian }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $pembelian->nama_barang }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="vendor_id" class="form-label">Vendor</label>
                                                <select class="form-control" name="vendor_id" id="vendor_id" required>
                                                    @foreach($vendor as $v)
                                                        <option value="{{ $v->id }}" {{ $pembelian->vendor_id == $v->id ? 'selected' : '' }}>{{ $v->nama_vendor }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="mandor_id" class="form-label">Mandor</label>
                                                <select class="form-control" name="mandor_id" id="mandor_id" required>
                                                    @foreach($mandor as $m)
                                                        <option value="{{ $m->id }}" {{ $pembelian->mandor_id == $m->id ? 'selected' : '' }}>{{ $m->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah" class="form-label">Jumlah</label>
                                                <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $pembelian->jumlah }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Harga</label>
                                                <input type="number" class="form-control" id="harga" name="harga" value="{{ $pembelian->harga }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nota" class="form-label">Nota</label>
                                                <input type="file" class="form-control" id="nota" name="nota">
                                                @if($pembelian->nota)
                                                    <p>Current Nota: <a href="{{ route('pembelian.downloadNota', $pembelian->id) }}" target="_blank">Download</a></p>
                                                @endif
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
                    <h5 class="modal-title" id="createModalLabel">Create New Pembelian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pembelian.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                            <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                        </div>
                        <div class="mb-3">
                            <label for="vendor_id" class="form-label">Vendor</label>
                            <select class="form-control" name="vendor_id" id="vendor_id" required>
                                @foreach($vendor as $v)
                                    <option value="{{ $v->id }}">{{ $v->nama_vendor }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mandor_id" class="form-label">Mandor</label>
                            <select class="form-control" name="mandor_id" id="mandor_id" required>
                                @foreach($mandor as $m)
                                    <option value="{{ $m->id }}">{{ $m->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                        <div class="mb-3">
                            <label for="nota" class="form-label">Nota</label>
                            <input type="file" class="form-control" id="nota" name="nota">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Pembelian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

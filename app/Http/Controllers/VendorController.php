<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    // Menampilkan daftar vendor
    public function index()
    {
        $vendor = Vendor::all(); // Mengambil semua data vendor dari database
        return view('vendor.index', compact('vendor')); // Mengirim data vendor ke view index
    }

    // Menyimpan vendor baru ke database
    public function store(Request $request)
    {
        // Validasi data yang dimasukkan
        $request->validate([
            'nama_vendor' => 'required',
            'no_telp' => 'required|max:15|unique:vendor,no_telp',
            'alamat' => 'required',
        ]);

        // Menyimpan vendor baru ke database
        Vendor::create($request->all());

        // Redirect ke halaman vendor.index dengan pesan sukses
        return redirect()->route('vendor.index')->with('success', 'Vendor created successfully.');
    }

    // Mengupdate data vendor yang sudah ada
    public function update(Request $request, $id)
    {
        // Validasi data yang dimasukkan
        $request->validate([
            'nama_vendor' => 'required',
            'no_telp' => 'required|max:15|unique:vendor,no_telp,' . $id,
            'alamat' => 'required',
        ]);

        $vendor = Vendor::findOrFail($id); // Mencari vendor berdasarkan ID
        $vendor->update($request->all()); // Mengupdate data vendor

        // Redirect ke halaman vendor.index dengan pesan sukses
        return redirect()->route('vendor.index')->with('success', 'Vendor updated successfully.');
    }

    // Menghapus vendor dari database
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id); // Mencari vendor berdasarkan ID
        $vendor->delete(); // Menghapus vendor

        // Redirect ke halaman vendor.index dengan pesan sukses
        return redirect()->route('vendor.index')->with('success', 'Vendor deleted successfully.');
    }
}

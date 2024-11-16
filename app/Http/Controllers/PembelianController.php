<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Mandor;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembelianController extends Controller
{
    // Display a listing of the pembelian (purchases).
    public function index()
    {
        // Retrieve all pembelian with related mandor and vendor data
        $pembelian = Pembelian::with('mandor', 'vendor')->get();
        $vendor = Vendor::all(); // Get all vendors for the dropdown
        $mandor = Mandor::all(); // Get all mandors for the dropdown
        
        // Pass data to the view
        return view('pembelian.index', compact('pembelian', 'vendor', 'mandor'));
    }

    // Show the form for creating a new pembelian.
    public function create()
    {
        // Get all vendors and mandors for the dropdowns
        $vendor = Vendor::all();
        $mandor = Mandor::all();
        
        // Return create form view with vendor and mandor data
        return view('pembelian.create', compact('vendor', 'mandor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pembelian' => 'required|date',
            'nama_barang' => 'required|string|max:255',
            'vendor_id' => 'required|exists:vendors,id',
            'mandor_id' => 'required|exists:mandors,id',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'nota' => 'nullable|file|mimes:pdf,jpg,png|max:2048', // Periksa ekstensi dan ukuran file
        ]);
    
        $pembelian = new Pembelian();
        $pembelian->tanggal_pembelian = $request->tanggal_pembelian;
        $pembelian->nama_barang = $request->nama_barang;
        $pembelian->vendor_id = $request->vendor_id;
        $pembelian->mandor_id = $request->mandor_id;
        $pembelian->jumlah = $request->jumlah;
        $pembelian->harga = $request->harga;
    
        // Menyimpan file nota jika ada
        if ($request->hasFile('nota')) {
            $file = $request->file('nota');
            $path = $file->store('nota', 'public'); // Disimpan di storage/app/public/nota
            $pembelian->nota = $path;
        }
    
        $pembelian->save();
    
        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil disimpan!');
    }


    // Show the form for editing the specified pembelian.
    public function edit($id)
    {
        // Retrieve pembelian by ID, along with related vendor and mandor
        $pembelian = Pembelian::findOrFail($id);
        $vendor = Vendor::all(); // Get all vendors
        $mandor = Mandor::all(); // Get all mandors
        
        // Return edit form with pembelian data
        return view('pembelian.edit', compact('pembelian', 'vendor', 'mandor'));
    }

    // Update the specified pembelian in storage.
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'tanggal_pembelian' => 'required|date',
            'nama_barang' => 'required|string|max:255',
            'vendor_id' => 'required|exists:vendor,id',
            'mandor_id' => 'required|exists:mandor,id',
            'jumlah' => 'required|numeric',
            'harga' => 'required|numeric',
            'nota' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate nota file (optional)
        ]);

        // Find the pembelian and update its data
        $pembelian = Pembelian::findOrFail($id);

        // Update pembelian data
        $pembelian->tanggal_pembelian = $validated['tanggal_pembelian'];
        $pembelian->nama_barang = $validated['nama_barang'];
        $pembelian->vendor_id = $validated['vendor_id'];
        $pembelian->mandor_id = $validated['mandor_id'];
        $pembelian->jumlah = $validated['jumlah'];
        $pembelian->harga = str_replace(',', '', $validated['harga']); // Remove commas from harga

        // Handle file upload for nota (receipt)
        if ($request->hasFile('nota')) {
            // Delete the old nota file if it exists
            if ($pembelian->nota && file_exists(public_path('uploads/nota/' . $pembelian->nota))) {
                unlink(public_path('uploads/nota/' . $pembelian->nota));
            }

            // Save the new nota file
            $nota = $request->file('nota');
            $notaFileName = time() . '.' . $nota->getClientOriginalExtension();
            $nota->move(public_path('uploads/nota'), $notaFileName);
            $pembelian->nota = $notaFileName;
        }

        // Save the updated pembelian to the database
        $pembelian->save();

        // Redirect back with success message
        return redirect()->route('pembelian.index')->with('success', 'Pembelian updated successfully!');
    }

    // Remove the specified pembelian from storage.
    public function destroy($id)
    {
        // Find the pembelian and delete it
        $pembelian = Pembelian::findOrFail($id);
        // Delete the nota file if exists
        if ($pembelian->nota && file_exists(public_path('uploads/nota/' . $pembelian->nota))) {
            unlink(public_path('uploads/nota/' . $pembelian->nota));
        }
        $pembelian->delete();

        // Redirect back with success message
        return redirect()->route('pembelian.index')->with('success', 'Pembelian deleted successfully!');
    }

    public function downloadNota($id)
{
    $pembelian = Pembelian::findOrFail($id);

    // Pastikan file nota ada
    if ($pembelian->nota) {
        // Mengambil path file dari storage dan mengunduhnya
        $filePath = storage_path('app/public/' . $pembelian->nota);

        // Periksa apakah file ada
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'File nota tidak ditemukan!');
        }
    }

    return redirect()->back()->with('error', 'Nota tidak tersedia!');
}

}

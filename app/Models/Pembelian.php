<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'pembelian';
    

    // The primary key associated with the table.
    protected $primaryKey = 'id';

    // The attributes that are mass assignable.
    protected $fillable = [
        'tanggal_pembelian',
        'nama_barang',
        'vendor_id',
        'jumlah',
        'harga',
        'total',
        'mandor_id',
        'nota',
    ];

    // The total field is a calculated field, no need to be filled manually
    protected $casts = [
        'total' => 'decimal:2', // Cast total to a decimal with two places
    ];

    // Relationship: A pembelian belongs to a vendor.
    public function vendor()
{
    return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
}


    // Relationship: A pembelian belongs to a mandor.
    public function mandor()
    {
        return $this->belongsTo(Mandor::class, 'mandor_id', 'id');
    }
}

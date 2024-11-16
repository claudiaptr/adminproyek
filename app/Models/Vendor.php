<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'vendor'; // Adjust the case here as per your actual table name

    // The primary key associated with the table.
    protected $primaryKey = 'id';

    // The attributes that are mass assignable.
    protected $fillable = [
        'nama_vendor',
        'no_telp',
        'alamat',
    ];

    // Relationship: A vendor can have many pembelian (purchases).
    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'vendor_id', 'id');
    }
}

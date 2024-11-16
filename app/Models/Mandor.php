<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mandor extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'mandor';

    // The primary key associated with the table.
    protected $primaryKey = 'id';

    // The attributes that are mass assignable.
    protected $fillable = [
        'nama',
    ];

    // Relationship: A mandor can have many pembelian (purchases).
    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'mandor_id', 'id');
    }
}

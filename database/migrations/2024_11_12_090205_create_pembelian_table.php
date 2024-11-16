<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->date('tanggal_pembelian');
            $table->string('nama_barang');
            $table->unsignedBigInteger('vendor_id');  // Make sure vendor_id references a valid vendor
            $table->integer('jumlah');
            $table->decimal('harga', 10, 2);  // Correct for price with 2 decimal places
            $table->decimal('total', 10, 2)->storedAs('jumlah * harga');  // Calculate total as jumlah * harga
            $table->unsignedBigInteger('mandor_id');  // Make sure mandor_id references a valid mandor
            $table->string('nota')->nullable();  // Allow null values for nota
            $table->timestamps();

            // Foreign key constraints
            // Ensure both 'vendor' and 'mandor' tables exist before applying foreign key constraints
            $table->foreign('vendor_id')->references('id')->on('vendor')->onDelete('cascade');
            $table->foreign('mandor_id')->references('id')->on('mandor')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Dropping the pembelian table
        Schema::dropIfExists('pembelian');
    }
}

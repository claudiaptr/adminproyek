<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMandorTable extends Migration
{
    public function up()
    {
        Schema::create('mandor', function (Blueprint $table) {
            $table->id();                           // Auto-incrementing ID
            $table->string('nama', 255);             // Nama mandor
            $table->timestamps();                   // Menyimpan kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('mandor');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('informationtrip', function (Blueprint $table) {
            $table->id('id_wisata_info');
            $table->string('nama_wisata_info');
            $table->string('alamat');
            $table->string('nama_gambar_wisata');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informationtrip');
    }
};

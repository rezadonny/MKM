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
        Schema::create('museums', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kode_pos')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('medsos_instagram')->nullable();
            $table->string('medsos_twitter')->nullable();
            $table->string('medsos_facebook')->nullable();
            $table->string('medsos_tiktok')->nullable();
            $table->string('googlemap')->nullable();
            $table->string('jenis')->nullable();
            $table->string('status')->nullable();
            $table->string('owner')->nullable();
            $table->string('nama_owner')->nullable();
            $table->string('foto_utama')->nullable();
            $table->string('foto_umum')->nullable();
            $table->string('logo')->nullable();
            $table->longText('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('museums');
    }
};

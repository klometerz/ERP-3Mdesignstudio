<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pelanggan')->unique();
            $table->string('nama');
            $table->text('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('zipcode');
            $table->string('negara');
            $table->string('kode_negara', 2);
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->enum('status_pelanggan', ['Aktif', 'Tidak Aktif']);
            $table->boolean('is_dummy')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};

<?php

use App\Models\User;
use App\Models\Mobil;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->enum('kategori_produk',['Alat Olahraga','Alat Musik'])->nullable();
            $table->string('harga_beli');
            $table->string('harga_jual');
            $table->string('stok_produk');
            $table->string('foto')->nullable();
            $table->softDeletes(); // Untuk mendukung Soft Deletes
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('produks');
    }
};

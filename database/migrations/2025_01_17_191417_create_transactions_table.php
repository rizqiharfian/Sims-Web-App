<?php

use App\Models\User;
use App\Models\Mobil;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Mobil::class);
            $table->string('nama')->nullabel();
            $table->string('ponsel')->nullabel();
            $table->string('alamat')->nullabel();
            $table->string('lama')->nullabel();
            $table->date('tgl_pesan')->nullabel();
            $table->string('total')->nullabel();
            $table->enum('status',['WAIT','PROSES','SELESAI'])->nullabel();
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

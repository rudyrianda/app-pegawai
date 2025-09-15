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
      Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap', 100);
        $table->string('email', 100);
        $table->string('nomor_telepon', 15);
        $table->date('tanggal_lahir');
        $table->text('alamat');
        $table->date('tanggal_masuk');
        // Kolom foreign key dihapus sementara:
        // $table->foreignId('departemen_id');
        // $table->foreignId('jabatan_id');
        $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

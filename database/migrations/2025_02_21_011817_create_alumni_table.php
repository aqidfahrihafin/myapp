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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kamar_id')->nullable();
            $table->unsignedBigInteger('periode_id')->nullable();
            $table->unsignedBigInteger('persentase_tagihan_id')->nullable();
            $table->string('nama_wali');
            $table->string('nis')->unique();
            $table->string('nik')->unique();
            $table->string('no_kk')->nullable();
            $table->string('nama');
            $table->string('image')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('status_santri', ['aktif', 'non-aktif', 'alumni'])->default('alumni');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_id')->constrained('periode')->onDelete('cascade');
            $table->foreignId('kamar_id')->constrained('kamar')->onDelete('cascade');
            $table->foreignId('persentase_tagihan_id')->constrained('persentase_tagihan')->onDelete('cascade');
            $table->string('nama_wali', 100);
            $table->enum('hubungan_wali', ['Orang Tua', 'Saudara', 'Wali Resmi', 'Lainnya'])->default('Orang Tua');
            $table->string('nama', 100);
            $table->string('image', 255);
            $table->string('nis', 20)->unique();
            $table->string('nik', 20)->unique();
            $table->string('no_kk', 20);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('status_santri', ['aktif', 'non-aktif','alumni'])->default('aktif');
            $table->softDeletes();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};

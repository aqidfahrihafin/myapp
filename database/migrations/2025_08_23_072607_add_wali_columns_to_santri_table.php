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
    Schema::table('santri', function (Blueprint $table) {
        $table->string('email_wali', 100)->nullable()->after('nama_wali');
        $table->date('tanggal_lahir_wali')->nullable()->after('email_wali');
        $table->text('alamat_wali')->nullable()->after('tanggal_lahir_wali');
        $table->string('no_hp_wali', 15)->nullable()->after('alamat_wali');
    });
}

public function down()
{
    Schema::table('santri', function (Blueprint $table) {
        $table->dropColumn(['email_wali', 'tanggal_lahir_wali', 'alamat_wali', 'no_hp_wali']);
    });
}
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTglTransaksiInSpp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spp', function (Blueprint $table) {
            $table->dropColumn(['tahun']);
            $table->string('bulan');
            $table->date('tgl_transaksi')->nullable();
            $table->integer('total_bayar')->nullable();
            $table->enum('status', ['Belum', 'Sudah']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spp', function (Blueprint $table) {
            $table->dropColumn(['status']);
            $table->dropColumn(['total_bayar']);
            $table->dropColumn(['tgl_transaksi']);
            $table->dropColumn(['bulan']);
            $table->integer('tahun');
        });
    }
}

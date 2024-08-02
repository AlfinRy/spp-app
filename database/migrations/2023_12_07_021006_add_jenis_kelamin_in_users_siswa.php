<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisKelaminInUsersSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_siswa', function (Blueprint $table) {
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->string('username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_siswa', function (Blueprint $table) {
            $table->dropColumn(['username']);
            $table->dropColumn(['jenis_kelamin']);
        });
    }
}

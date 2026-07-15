<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable()->after('alamat');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable()->after('tanggal_lahir');
            $table->string('pekerjaan')->nullable()->after('jenis_kelamin');
            $table->string('agama')->nullable()->after('pekerjaan');
            $table->string('pendidikan')->nullable()->after('agama');
            $table->string('status_perkawinan')->nullable()->after('pendidikan');
            $table->string('shdk')->nullable()->after('status_perkawinan');
            $table->string('no_kk')->nullable()->after('shdk');
            $table->string('rt')->nullable()->after('no_kk');
            $table->string('rw')->nullable()->after('rt');
            $table->string('profile_picture')->nullable()->after('rw');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'tempat_lahir',
                'tanggal_lahir',
                'jenis_kelamin',
                'pekerjaan',
                'agama',
                'pendidikan',
                'status_perkawinan',
                'shdk',
                'no_kk',
                'rt',
                'rw',
                'profile_picture',
            ]);
        });
    }
};
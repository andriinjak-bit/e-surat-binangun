<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('surats', function (Blueprint $table) {
            $table->json('form_data')->nullable()->after('data');
            $table->text('admin_note')->nullable()->after('keterangan');
            $table->text('file_path')->nullable()->after('admin_note');
            $table->timestamp('verified_at')->nullable()->after('file_path');
        });
    }

    public function down()
    {
        Schema::table('surats', function (Blueprint $table) {
            $table->dropColumn(['form_data', 'admin_note', 'file_path', 'verified_at']);
        });
    }
};
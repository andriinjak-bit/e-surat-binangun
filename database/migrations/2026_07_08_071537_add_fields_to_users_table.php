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
    Schema::table('users', function (Blueprint $table) {
        $table->string('nik', 16)->unique()->after('id');
        $table->string('phone')->nullable()->after('email');
        $table->string('dusun')->nullable()->after('phone');
        $table->text('alamat')->nullable()->after('dusun');
        $table->boolean('is_admin')->default(false)->after('alamat');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

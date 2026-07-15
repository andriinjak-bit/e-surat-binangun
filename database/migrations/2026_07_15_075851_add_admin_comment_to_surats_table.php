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
    Schema::table('surats', function (Blueprint $table) {
        $table->text('admin_comment')->nullable()->after('status');
        $table->timestamp('reviewed_at')->nullable()->after('admin_comment');
        $table->timestamp('accepted_at')->nullable()->after('reviewed_at');
        $table->timestamp('rejected_at')->nullable()->after('accepted_at');
    });
}

public function down(): void
{
    Schema::table('surats', function (Blueprint $table) {
        $table->dropColumn(['admin_comment', 'reviewed_at', 'accepted_at', 'rejected_at']);
    });
}



};

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
        // Drop existing tables if they exist to prevent conflict
        Schema::dropIfExists('surat_template_fields');
        Schema::dropIfExists('surat_templates');

        Schema::create('surat_templates', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->longText('body')->nullable(); // HTML from Tiptap
            $table->json('variables')->nullable(); // JSON schema configuration
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_templates');
    }
};

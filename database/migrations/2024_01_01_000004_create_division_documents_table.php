<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('division_documents', function (Blueprint $table) {
            $table->id();
            $table->string('division', 60);            // construction|engineering|rd|farm|procurement
            $table->string('name');                    // nama dokumen / portofolio
            $table->text('description')->nullable();   // keterangan
            $table->json('file_paths');                // array of file paths (>5 supported)
            $table->boolean('is_public')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index('division');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('division_documents');
    }
};

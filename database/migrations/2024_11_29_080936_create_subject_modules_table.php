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
        Schema::create('subject_modules', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('module_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade');
            $table->foreign('module_id')->references('module_id')->on('modules')->onDelete('cascade');

            // Unique constraint to prevent duplicate entries
            $table->unique(['subject_id', 'module_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_modules');
    }
};

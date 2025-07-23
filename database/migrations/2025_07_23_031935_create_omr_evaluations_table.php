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
        Schema::create('omr_evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('booth')->nullable();
            $table->string('folder_name');
            $table->integer('status')->default(0);
            $table->json('raw_data')->nullable();
            $table->string('exam_type')->nullable(); // MCQ/First/Second
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('omr_evaluations');
    }
};

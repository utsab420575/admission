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
        Schema::create('mcqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('mcq_set_id')->constrained()->onDelete('cascade');
            $table->integer('phy_correct')->nullable();
            $table->integer('phy_incrorrect')->nullable();
            $table->float('phy_marks')->nullable();
            $table->integer('chem_correct')->nullable();
            $table->integer('chem_incorrect')->nullable();
            $table->float('chem_marks')->nullable();
            $table->integer('math_correct')->nullable();
            $table->integer('math_incorrect')->nullable();
            $table->float('math_marks')->nullable();
            $table->integer('eng_correct')->nullable();
            $table->integer('eng_incorrect')->nullable();
            $table->float('eng_marks')->nullable();
            $table->integer('tech_correct')->nullable();
            $table->integer('tech_incorrect')->nullable();
            $table->float('tech_marks')->nullable();
            $table->integer('is_pass_eng')->nullable();
            $table->string('original_image')->nullable();
            $table->json('ans_raw')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcqs');
    }
};

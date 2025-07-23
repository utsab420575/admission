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
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->float('mcq_eng')->nullable();
            $table->float('mcq_phy')->nullable();
            $table->float('mcq_chem')->nullable();
            $table->float('mcq_math')->nullable();
            $table->float('mcq_tech')->nullable();
            $table->float('part_1_phy')->nullable();
            $table->float('part_1_chem')->nullable();
            $table->float('part_1_math')->nullable();
            $table->float('part_1_eng')->nullable();
            $table->float('part_2_tech')->nullable();
            $table->float('mp1_phy')->nullable();
            $table->float('mp1_chem')->nullable();
            $table->float('mp1_math')->nullable();
            $table->float('mp1_eng')->nullable();
            $table->float('mp2_tech')->nullable();
            $table->float('p1_total')->nullable();
            $table->float('total')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('eng_passed')->default(false);
            $table->boolean('first_passed')->default(false);
            $table->boolean('second_passed')->default(false);
            $table->boolean('total_passed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};

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
        Schema::create('page_designs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->integer('page_no');
            $table->foreignId('group_id')->constrained()->onDelete('cascade');
            $table->integer('quest_no');
            $table->foreignId('part_id')->constrained('part_types')->onDelete('cascade');
            $table->integer('space');
            $table->integer('no_part');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_designs');
    }
};

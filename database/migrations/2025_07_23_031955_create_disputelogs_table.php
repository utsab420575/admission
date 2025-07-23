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
        Schema::create('disputelogs', function (Blueprint $table) {
            $table->id();
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->text('type')->nullable();
            $table->text('file')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disputelogs');
    }
};

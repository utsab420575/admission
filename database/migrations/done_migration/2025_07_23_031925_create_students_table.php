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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('studentid')->unique();
            $table->string('qr_code')->unique()->nullable();
            $table->string('name');
            $table->string('f_name')->nullable();
            $table->string('m_name')->nullable();
            $table->string('quota')->nullable();
            $table->string('mobile')->nullable();
            $table->text('pre_address')->nullable();
            $table->text('per_address')->nullable();
            $table->string('photo')->nullable();
            $table->string('ch_1')->nullable();
            $table->string('ch_2')->nullable();
            $table->string('ch_3')->nullable();
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

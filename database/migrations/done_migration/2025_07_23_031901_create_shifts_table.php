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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // add title column
            $table->timestamps();
        });


        // Insert initial shift data
        DB::table('shifts')->insert([
            ['title' => 'First', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Second', 'created_at' => now(), 'updated_at' => now()],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};

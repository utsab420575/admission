<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        // Insert default records
        DB::table('designations')->insert([
            ['name' => 'Professor'],
            ['name' => 'Associate Professor'],
            ['name' => 'Assistant Professor'],
            ['name' => 'Lecturer'],
            ['name' => 'Deputy Registrar'],
            ['name' => 'Provost'],
            ['name' => 'Assistant Provost'],
            ['name' => 'Exam Controller'],
            ['name' => 'Comptroller'],
            ['name' => 'DSW'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('designations');
    }
};

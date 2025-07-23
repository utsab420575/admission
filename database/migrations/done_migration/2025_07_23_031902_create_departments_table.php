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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('short_name')->unique();
            $table->integer('merit')->nullable();
            $table->integer('ff')->nullable();
            $table->integer('tr')->nullable();
            $table->integer('waiting')->nullable();
            $table->double('total_per')->nullable();
            $table->double('first_per')->nullable();
            $table->double('second_per')->nullable();
            $table->double('eng_per')->nullable();
            $table->integer('result_status')->default(0)->nullable();
            $table->foreignId('shift_id')->constrained('shifts')->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('departments')->insert(
            array(
                array(
                    'name' => 'Civil Engineering',
                    'short_name' => 'CE',
                    'merit' => 120,
                    'ff' => 2,
                    'tr' => 2,
                    'waiting' => 5,
                    'total_per' => 120,
                    'first_per' => 32.5,
                    'second_per' => 32.5,
                    'eng_per' => 6,
                    'shift_id'=>1
                ),
                array(
                    'name' => 'Electrical and Electronic Engineering',
                    'short_name' => 'EEE',
                    'merit' => 120,
                    'ff' => 2,
                    'tr' => 2,
                    'waiting' => 5,
                    'total_per' => 120,
                    'first_per' => 32.5,
                    'second_per' => 32.5,
                    'eng_per' => 6,
                    'shift_id'=>2
                ),
                array(
                    'name' => 'Mechanical Engineering',
                    'short_name' => 'ME',
                    'merit' => 120,
                    'ff' => 2,
                    'tr' => 2,
                    'waiting' => 5,
                    'total_per' => 120,
                    'first_per' => 32.5,
                    'second_per' => 32.5,
                    'eng_per' => 6,
                    'shift_id'=>1
                ),
                array(
                    'name' => 'Computer Science and Engineering',
                    'short_name' => 'CSE',
                    'merit' => 120,
                    'ff' => 2,
                    'tr' => 2,
                    'waiting' => 5,
                    'total_per' => 120,
                    'first_per' => 32.5,
                    'second_per' => 32.5,
                    'eng_per' => 6,
                    'shift_id'=>2
                ),
                array(
                    'name' => 'Textile Engineering',
                    'short_name' => 'TE',
                    'merit' => 120,
                    'ff' => 2,
                    'tr' => 2,
                    'waiting' => 5,
                    'total_per' => 120,
                    'first_per' => 32.5,
                    'second_per' => 32.5,
                    'eng_per' => 6,
                    'shift_id'=>1
                ),
                array(
                    'name' => 'Architecture',
                    'short_name' => 'Arch',
                    'merit' => 30,
                    'ff' => 1,
                    'tr' => 1,
                    'waiting' => 5,
                    'total_per' => 120,
                    'first_per' => 32.5,
                    'second_per' => 32.5,
                    'eng_per' => 6,
                    'shift_id'=>1
                ),
                array(
                    'name' => 'Industrial and Production Engineering',
                    'short_name' => 'IPE',
                    'merit' => 30,
                    'ff' => 1,
                    'tr' => 1,
                    'waiting' => 5,
                    'total_per' => 120,
                    'first_per' => 32.5,
                    'second_per' => 32.5,
                    'eng_per' => 6,
                    'shift_id'=>1
                ),
                array(
                    'name' => 'Chemical Engineering',
                    'short_name' => 'ChE',
                    'merit' => 30,
                    'ff' => 1,
                    'tr' => 1,
                    'waiting' => 5,
                    'total_per' => 120,
                    'first_per' => 32.5,
                    'second_per' => 32.5,
                    'eng_per' => 6,
                    'shift_id'=>2
                ),
                array(
                    'name' => 'Food Engineering',
                    'short_name' => 'FE',
                    'merit' => 30,
                    'ff' => 1,
                    'tr' => 1,
                    'waiting' => 5,
                    'total_per' => 120,
                    'first_per' => 32.5,
                    'second_per' => 32.5,
                    'eng_per' => 6,
                    'shift_id'=>2
                ),
                array(
                    'name' => 'Materials and Metallurgical Engineering',
                    'short_name' => 'MME',
                    'merit' => 30,
                    'ff' => 1,
                    'tr' => 1,
                    'waiting' => 5,
                    'total_per' => 120,
                    'first_per' => 32.5,
                    'second_per' => 32.5,
                    'eng_per' => 6,
                    'shift_id'=>1
                ),
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};

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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('designation_id')->nullable()->after('user_type');
            $table->unsignedBigInteger('department_id')->nullable()->after('designation_id');

            $table->foreign('designation_id')
                ->references('id')
                ->on('designations')
                ->onDelete('set null')
                ->onUpdate('restrict');

            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('set null')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['designation_id']);
            $table->dropForeign(['department_id']);
            $table->dropColumn(['designation_id', 'department_id']);
        });
    }
};

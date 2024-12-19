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
        Schema::table('leave_balance', function (Blueprint $table) {
            $table->string('employeecode')->after('id'); // Add the 'employeecode' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leave_balance', function (Blueprint $table) {
            $table->dropColumn('employeecode'); // Remove the 'employeecode' column
        });
    }
};

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
        Schema::create('employee_leave_master', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leavetype');
            $table->string('employeecode');
            $table->date('fromdate');
            $table->date('todate');
            $table->integer('numberofDays');
            $table->string('comment', 300)->nullable();
            $table->timestamps();

            $table->foreign('leavetype')->references('id')->on('leave_master')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_leave_master');
    }
};

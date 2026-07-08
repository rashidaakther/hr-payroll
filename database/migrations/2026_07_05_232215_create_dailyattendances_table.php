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
        Schema::create('dailyattendances', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->foreign('id')->references('id')->on('officeinfos')->onDelete('cascade');;
            $table->date('year_id')->nullable();
            $table->string('month_id')->nullable();
            $table->string('date')->nullable();
            $table->string('in_time')->nullable();
            $table->string('out_time')->nullable();
            $table->string('general_working_hour')->nullable();
            $table->string('overtime_hour')->nullable();
            $table->string('extra_overtime_hour')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dailyattendances');
    }
};

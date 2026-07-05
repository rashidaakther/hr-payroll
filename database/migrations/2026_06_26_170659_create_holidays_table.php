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
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->string('branch_id')->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->string('shift_id')->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
            $table->string('holidayType')->nullable();
            $table->string('name');
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('total_day')->nullable();
            $table->string('status')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holidays');
    }
};

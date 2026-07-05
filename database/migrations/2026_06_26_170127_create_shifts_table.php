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
            $table->string('branch_id')->nullable()->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->string('name');
            $table->string('start_at')->nullable();
            $table->string('break_start_at')->nullable();
            $table->string('break_end_at')->nullable();
            $table->string('total_break_hours')->nullable();
            $table->string('end_at')->nullable();
            $table->string('total_hours')->nullable();
            $table->string('general_ot_start_at')->nullable();
            $table->string('general_ot_end_at')->nullable();
            $table->string('extra_ot_start_at')->nullable();
            $table->string('extra_ot_end_at')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};

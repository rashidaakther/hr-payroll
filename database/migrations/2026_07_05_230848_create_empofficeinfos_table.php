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
        Schema::create('empofficeinfos', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('employee_name');
            $table->string('employee_name_other')->nullable();
            $table->string('official_mail')->nullable();
            $table->string('designation')->nullable();
            $table->string('office')->nullable();
            $table->string('shift')->nullable();
            $table->string('unit')->nullable();
            $table->string('department')->nullable();
            $table->string('section_line')->nullable();
            $table->string('work_group')->nullable();
            $table->string('salary_type')->nullable();
            $table->string('card_no')->nullable();
            $table->string('joining_date')->nullable();
            $table->string('grade')->nullable();
            $table->string('gross')->nullable();
            $table->string('second_gross')->nullable();
            $table->string('manager')->nullable();
            $table->string('job_location')->nullable();
            $table->string('probation_period')->nullable();
            $table->string('confirmation_date')->nullable();
            $table->string('is_ot_payable')->nullable();
            $table->string('is_masked')->nullable();
            $table->string('employee_status')->nullable();
            $table->string('discontinuation_date')->nullable();
            $table->string('discontinuation_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empofficeinfos');
    }
};

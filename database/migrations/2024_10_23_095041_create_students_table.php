<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    public function up()
    {
        try {
            Schema::create('students', function (Blueprint $table) {
                $table->unsignedBigInteger('student_id');
                $table->string('student_name');
                $table->string('student_grade');
                $table->string('student_email');
                $table->string('student_address');
                $table->string('student_phone');
                $table->string('student_level');
                $table->string('student_status');
                $table->date('student_dob');
                $table->date('student_regist_date');
                $table->unsignedBigInteger('type_id');
                $table->unsignedBigInteger('school_id');
                $table->foreign('type_id')->references('type_id')->on('types');
                $table->foreign('school_id')->references('school_id')->on('schools');
                $table->timestamps();
            });
        } catch (\Exception $e) {
            Log::error('Migration failed for students table: ' . $e->getMessage());
            throw $e; // Re-throw the exception after logging
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

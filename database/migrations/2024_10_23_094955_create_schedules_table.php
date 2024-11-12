<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up()
{
    Schema::create('schedules', function (Blueprint $table) {
        $table->unsignedBigInteger('schedule_id')->autoIncrement();
        $table->string('schedule_day');
        $table->string('schedule_time');
        $table->unsignedBigInteger('teacher_id');  // Foreign key ke tabel teachers
        $table->unsignedBigInteger('student_id');  // Foreign key ke tabel users (student)
        $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
        $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->bigIncrements('subject_id')->unsigned(); // Primary key
            $table->string('subject_name'); // Nama mata pelajaran
            $table->unsignedBigInteger('teacher_id'); // Foreign key untuk guru
            $table->timestamps(); // Kolom created_at dan updated_at

            // Mendefinisikan foreign key
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}

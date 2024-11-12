<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('teachers', function (Blueprint $table) {
        $table->unsignedBigInteger('teacher_id');
        $table->string('teacher_name');
        $table->date('teacher_dob');
        $table->string('teacher_phone');
        $table->string('teacher_email');
        $table->string('teacher_address');
        $table->string('teacher_education');
        $table->string('teacher_position');
        $table->timestamps();
    });
}

    
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
    


};

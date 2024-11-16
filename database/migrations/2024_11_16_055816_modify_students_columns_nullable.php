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
    Schema::table('students', function (Blueprint $table) {
        // Mengubah kolom student_status menjadi nullable
        $table->string('student_status')->nullable()->change();

        // Mengubah kolom student_level menjadi nullable
        $table->string('student_level')->nullable()->change();

        // Mengubah kolom user_id menjadi nullable
        $table->bigInteger('user_id')->nullable()->change();
    });
}

public function down()
{
    Schema::table('students', function (Blueprint $table) {
        // Kembalikan kolom student_status menjadi non-nullable
        $table->string('student_status')->nullable(false)->change();

        // Kembalikan kolom student_level menjadi non-nullable
        $table->string('student_level')->nullable(false)->change();

        // Kembalikan kolom user_id menjadi non-nullable
        $table->bigInteger('user_id')->nullable(false)->change();
    });
}

};

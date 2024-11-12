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
    Schema::table('teachers', function (Blueprint $table) {
        $table->unsignedBigInteger('subject_id')->nullable()->after('teacher_position'); // Sesuaikan posisi kolom sesuai kebutuhan
        $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('teachers', function (Blueprint $table) {
        $table->dropForeign(['subject_id']);
        $table->dropColumn('subject_id');
    });
}

};
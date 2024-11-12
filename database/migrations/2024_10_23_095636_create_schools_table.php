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
    Schema::create('schools', function (Blueprint $table) {
        $table->id('school_id');
        $table->string('school_name');
        $table->string('school_address');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('schools');
}

};

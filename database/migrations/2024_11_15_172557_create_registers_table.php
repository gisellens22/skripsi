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
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->string('register_name');
            $table->string('register_class');
            $table->unsignedBigInteger('type_id');  // type_id harus unsignedBigInteger
            $table->unsignedBigInteger('school_id');  // school_id harus unsignedBigInteger
            $table->string('register_address');
            $table->string('register_phone');
            $table->string('register_email');
            $table->date('register_date');
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('type_id')->references('type_id')->on('types')->onDelete('cascade');
            $table->foreign('school_id')->references('school_id')->on('schools')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};

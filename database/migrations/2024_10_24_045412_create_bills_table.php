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
            Schema::create('bills', function (Blueprint $table) {
                $table->unsignedBigInteger('bill_id')->autoIncrement();
                $table->decimal('bill_price', 10, 2);
                $table->string('bill_month');
                $table->enum('bill_status', ['PAID', 'UNPAID']);
                $table->unsignedBigInteger('student_id');
                $table->timestamps();
                
                // Foreign key yang disesuaikan dengan struktur tabel students
                $table->foreign('student_id')
                      ->references('student_id')  // Mengacu ke student_id, bukan id
                      ->on('students')
                      ->onDelete('cascade');
            });
        } catch (\Exception $e) {
            Log::error('Migration failed for bills table: ' . $e->getMessage());
            throw $e;
        }
    }

    public function down()
    {
        Schema::dropIfExists('bills');
    }
};
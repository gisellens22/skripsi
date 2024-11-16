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
            // Hapus foreign key constraint yang ada
            $table->dropForeign(['user_id']);
            
            // Mengubah kolom user_id menjadi nullable
            $table->bigInteger('user_id')->nullable()->change();
            
            // Menambahkan kembali foreign key constraint dengan onDelete('set null')
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Kembalikan kolom user_id menjadi non-nullable
            $table->bigInteger('user_id')->nullable(false)->change();
            
            // Hapus foreign key constraint
            $table->dropForeign(['user_id']);
            
            // Tambahkan kembali foreign key constraint tanpa onDelete('set null')
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    
};

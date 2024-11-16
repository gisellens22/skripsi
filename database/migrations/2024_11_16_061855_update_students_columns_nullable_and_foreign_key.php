<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStudentsColumnsNullableAndForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Ubah kolom menjadi nullable
            $table->string('student_level')->nullable()->change();
            $table->string('student_status')->nullable()->change();
            $table->bigInteger('user_id')->unsigned()->nullable()->change();

            // Menambahkan index jika belum ada pada user_id
            $table->index('user_id');

            // Menambahkan foreign key dengan onDelete set null
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Menghapus foreign key jika rollback
            $table->dropForeign(['user_id']);
            $table->dropIndex(['user_id']);

            // Mengubah kolom kembali ke non-nullable jika rollback
            $table->string('student_level')->nullable(false)->change();
            $table->string('student_status')->nullable(false)->change();
            $table->bigInteger('user_id')->unsigned()->nullable(false)->change();
        });
    }
}

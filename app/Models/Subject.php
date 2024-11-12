<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak sesuai dengan konvensi, tidak perlu jika sesuai)
    protected $table = 'subjects';

    // Primary key (jika tidak menggunakan 'id')
    protected $primaryKey = 'subject_id';

    // Jika 'subject_id' adalah auto-increment, Anda dapat menonaktifkan ini
    public $incrementing = true;

    // Tipe data primary key
    protected $keyType = 'int';

    // Kolom yang dapat diisi
    protected $fillable = [
        'subject_name',
        'teacher_id',  // Foreign key yang mengacu pada tabel teachers
    ];

    // Relasi dengan model Teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id');
    }
}

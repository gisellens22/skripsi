<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak sesuai dengan konvensi, tidak perlu jika sesuai)
    protected $table = 'teachers';

    // Primary key (jika tidak menggunakan 'id')
    protected $primaryKey = 'teacher_id';

    // Jika 'teacher_id' adalah auto-increment, Anda dapat menonaktifkan ini
    public $incrementing = false;

    // Tipe data primary key
    protected $keyType = 'int';

    // Kolom yang dapat diisi
    protected $fillable = [
        'teacher_id',
        'teacher_name',
        'teacher_email',
        'teacher_phone',
        'teacher_address',
        'user_id',
        'teacher_dob',
        'teacher_education',
        'teacher_position',
        'subject_id',
        // Tambahkan kolom lain sesuai kebutuhan
    ];

    // Relasi dengan model lain, contoh:
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'teacher_id', 'teacher_id');
    }
    public function subjects()
    {
    return $this->hasMany(Subject::class, 'subject_id', 'subject_id');
    }
    public function users()
    {
    return $this->hasMany(User::class, 'user_id', 'id');
    }

}
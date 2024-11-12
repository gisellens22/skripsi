<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak sesuai dengan konvensi, tidak perlu jika sesuai)
    protected $table = 'schools';

    // Primary key (jika tidak menggunakan 'id')
    protected $primaryKey = 'school_id';

    // Jika 'school_id' adalah auto-increment, Anda dapat menonaktifkan ini
    public $incrementing = true;

    // Tipe data primary key
    protected $keyType = 'int';

    // Kolom yang dapat diisi
    protected $fillable = [
        'school_name',
        // Tambahkan kolom lain sesuai kebutuhan
    ];

    // Relasi dengan model lain, contoh:
    public function students()
    {
        return $this->hasMany(Student::class, 'school_id', 'school_id');
    }
}

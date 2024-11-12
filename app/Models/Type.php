<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak sesuai dengan konvensi, tidak perlu jika sesuai)
    protected $table = 'types';

    // Primary key (jika tidak menggunakan 'id')
    protected $primaryKey = 'type_id';

    // Jika 'type_id' adalah auto-increment, Anda dapat menonaktifkan ini
    public $incrementing = true;

    // Tipe data primary key
    protected $keyType = 'int';

    // Kolom yang dapat diisi
    protected $fillable = [
        'type_name',
    ];

    // Relasi dengan model lain, contoh:
    public function students()
    {
        return $this->hasMany(Student::class, 'type_id', 'type_id');
    }
}

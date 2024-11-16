<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;

    protected $fillable = [
        'register_name',
        'register_class',
        'type_id',
        'school_id',
        'register_address',
        'register_phone',
        'register_email',
        'register_date',
    ];

    // Jika perlu, kamu bisa mendefinisikan relasi di sini (misalnya ke tabel 'types' dan 'schools')
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}

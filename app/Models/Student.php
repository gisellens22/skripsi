<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'student_id';
    public $incrementing = false;

    // Kolom yang dapat diisi
    protected $fillable = [
        'student_name',
        'student_grade',
        'student_email',
        'student_address',
        'student_phone',
        'student_level',
        'student_status',
        'student_dob',
        'student_regist_date',
        'type_id',
        'school_id',
        'user_id',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'type_id');
    }

    public function schedules()
{
    return $this->hasMany(Schedule::class, 'student_id'); // sesuai foreign key di tabel schedules
}


    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }


    public function bills()
    {
        return $this->hasMany(Bill::class, 'student_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

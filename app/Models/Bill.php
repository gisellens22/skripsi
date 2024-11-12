<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $primaryKey = 'bill_id';
    
    protected $fillable = [
        'bill_price', 
        'bill_month', 
        'bill_status', 
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
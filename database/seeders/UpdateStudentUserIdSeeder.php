<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;

class UpdateStudentUserIdSeeder extends Seeder
{
    public function run()
    {
        $students = Student::all();

        foreach ($students as $student) {
            $user = User::where('username', $student->username)->first();
            if ($user) {
                $student->user_id = $user->id;
                $student->save();
            }
        }
    }
}

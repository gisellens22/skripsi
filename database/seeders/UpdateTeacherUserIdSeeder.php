<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\User;

class UpdateTeacherUserIdSeeder extends Seeder
{
    public function run()
    {
        $teachers = Teacher::all();
    
        foreach ($teachers as $teacher) {
            $user = User::where('username', $teacher->username)->first();
            if ($user) {
                $teacher->user_id = $user->id;
                $teacher->save();
                $this->command->info("Updated user_id for teacher: {$teacher->name} to {$user->id}");
            } else {
                $this->command->warn("No user found for teacher: {$teacher->name}");
            }
        }
    }
}

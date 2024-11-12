<?php

namespace App\Services;

class RoleService
{
    // Tambahkan metode atau properti yang Anda butuhkan
    public function checkUserRole($user, $role)
    {
        // Cek apakah pengguna memiliki role yang sesuai
        return $user->role_id == $role;
    }
}

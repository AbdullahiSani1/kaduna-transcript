<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('SUPERADMIN_EMAIL');
        $password = env('SUPERADMIN_PASSWORD');

        if (! $email || ! $password) {
            $this->command?->warn('SUPERADMIN_EMAIL or SUPERADMIN_PASSWORD is not set. Skipping super admin creation.');
            return;
        }

        // firstOrCreate so a redeploy never overwrites an existing password.
        User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Super Admin',
                'password' => Hash::make($password),
                'role' => 'super_admin',
            ]
        );
    }
}
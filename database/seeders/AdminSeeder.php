<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name'     => env('ADMIN_DEFAULT_NAME', 'Super Admin'),
            'email'    => env('ADMIN_DEFAULT_EMAIL', 'admin@magantara.id'),
            'password' => Hash::make(env('ADMIN_DEFAULT_PASSWORD', 'Admin@123')),
        ]);
    }
}

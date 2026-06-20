<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perusahaan;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Dummy Perusahaan (Gojek)
        Perusahaan::updateOrCreate(
            ['email' => 'rekrutmen@gojek.com'],
            [
                'name' => 'PT Gojek Indonesia',
                'password' => Hash::make('password'),
                'status_verification' => 'verified',
                'description' => 'Perusahaan teknologi karya anak bangsa.',
                'website_url' => 'https://gojek.com',
            ]
        );

        // 2. Akun Dummy Mahasiswa
        Mahasiswa::updateOrCreate(
            ['email' => 'mahasiswa@gmail.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'semester' => 6,
                'bio' => 'Mahasiswa tingkat akhir yang sedang mencari tempat magang.',
            ]
        );
    }
}

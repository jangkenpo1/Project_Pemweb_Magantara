<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use App\Models\Industry;
use App\Models\Skill;
use App\Models\University;
use App\Models\Major;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // Provinces and Cities
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        City::truncate();
        Province::truncate();
        Industry::truncate();
        Skill::truncate();
        University::truncate();
        Major::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $indonesia = Country::firstOrCreate(['name' => 'Indonesia']);

        // Fetch Provinces CSV
        $provincesCsv = file_get_contents('https://raw.githubusercontent.com/edwardsamuel/Wilayah-Administratif-Indonesia/master/csv/provinces.csv');
        $provLines = explode("\n", trim($provincesCsv));
        $provMap = []; // id => db_id
        foreach ($provLines as $line) {
            $parts = str_getcsv($line);
            if (count($parts) >= 2) {
                $name = ucwords(strtolower(trim($parts[1])));
                $province = Province::create(['country_id' => $indonesia->id, 'name' => $name]);
                $provMap[trim($parts[0])] = $province->id;
            }
        }

        // Fetch Regencies (Cities) CSV
        $regenciesCsv = file_get_contents('https://raw.githubusercontent.com/edwardsamuel/Wilayah-Administratif-Indonesia/master/csv/regencies.csv');
        $regLines = explode("\n", trim($regenciesCsv));
        $citiesData = [];
        foreach ($regLines as $line) {
            $parts = str_getcsv($line);
            if (count($parts) >= 3) {
                $provId = trim($parts[1]);
                $name = ucwords(strtolower(trim($parts[2])));
                if (isset($provMap[$provId])) {
                    $citiesData[] = [
                        'province_id' => $provMap[$provId],
                        'name' => $name,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }
        
        foreach (array_chunk($citiesData, 100) as $chunk) {
            City::insert($chunk);
        }

        // Industries
        $industries = [
            'Teknologi Informasi', 'E-Commerce', 'Perbankan & Keuangan',
            'Media & Komunikasi', 'Pendidikan', 'Kesehatan',
            'Manufaktur', 'Konsultan', 'Startup', 'FMCG',
            'Logistik & Transportasi', 'Properti', 'Pertambangan & Energi',
        ];
        foreach ($industries as $name) {
            Industry::create(['name' => $name]);
        }

        // Skills
        $skills = [
            'PHP', 'Laravel', 'JavaScript', 'TypeScript', 'React', 'Vue.js',
            'Node.js', 'Python', 'Django', 'Flask', 'Java', 'Spring Boot',
            'C++', 'C#', '.NET', 'Kotlin', 'Swift', 'Flutter', 'Dart',
            'MySQL', 'PostgreSQL', 'MongoDB', 'Redis',
            'HTML', 'CSS', 'Tailwind CSS', 'Bootstrap',
            'Git', 'Docker', 'Kubernetes', 'Linux', 'AWS', 'Google Cloud',
            'UI/UX Design', 'Figma', 'Adobe XD', 'Illustrator', 'Photoshop',
            'Data Analysis', 'Machine Learning', 'Deep Learning', 'TensorFlow',
            'Cyber Security', 'Networking', 'Android Development', 'iOS Development',
            'REST API', 'GraphQL', 'Microservices', 'Agile/Scrum',
            'Microsoft Excel', 'Power BI', 'Tableau', 'R Language',
            'SEO', 'Digital Marketing', 'Content Writing', 'Social Media',
            'Akuntansi', 'Keuangan', 'Perpajakan', 'Audit',
            'Manajemen Proyek', 'Komunikasi', 'Public Speaking',
        ];
        foreach ($skills as $name) {
            Skill::create(['name' => $name]);
        }

        // Universities
        $universities = [
            'Universitas Indonesia', 'Institut Teknologi Bandung', 'Universitas Gadjah Mada',
            'Institut Teknologi Sepuluh Nopember', 'Universitas Airlangga', 'Universitas Brawijaya',
            'Universitas Diponegoro', 'Universitas Padjadjaran', 'Universitas Hasanuddin',
            'Universitas Sebelas Maret', 'Universitas Andalas', 'Universitas Syiah Kuala',
            'Universitas Bina Nusantara', 'Universitas Trisakti', 'Universitas Mercu Buana',
            'Universitas Telkom', 'Universitas Dian Nuswantoro', 'Universitas Atma Jaya',
            'Universitas Katolik Indonesia', 'Politeknik Elektronika Negeri Surabaya',
        ];
        foreach ($universities as $name) {
            University::create(['name' => $name]);
        }

        // Majors
        $majors = [
            'Teknik Informatika', 'Sistem Informasi', 'Ilmu Komputer',
            'Teknik Elektro', 'Teknik Mesin', 'Teknik Sipil',
            'Manajemen', 'Akuntansi', 'Ekonomi', 'Bisnis Digital',
            'Desain Komunikasi Visual', 'Desain Produk', 'Arsitektur',
            'Komunikasi', 'Hubungan Internasional', 'Psikologi',
            'Hukum', 'Kedokteran', 'Farmasi', 'Statistika',
            'Matematika', 'Fisika', 'Kimia',
        ];
        foreach ($majors as $name) {
            Major::create(['name' => $name]);
        }
    }
}

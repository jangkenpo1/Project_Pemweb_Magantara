<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswas = [
            // Foto 1: download.jpg - Laki-laki muda, seragam putih, tampak SMA/mahasiswa baru
            [
                'name'           => 'Rizky Ardiansyah',
                'email'          => 'rizky.ardiansyah@student.undip.ac.id',
                'password'       => Hash::make('rizky123'),
                'university_id'  => 7,  // Universitas Diponegoro
                'major_id'       => 1,  // Teknik Informatika
                'semester'       => 5,
                'bio'            => 'Mahasiswa Teknik Informatika semester 5 di Universitas Diponegoro. Tertarik pada pengembangan web dan aplikasi mobile. Sedang aktif belajar React dan Laravel untuk mempersiapkan diri masuk dunia kerja.',
                'experience'     => 'Anggota aktif UKM Robotika UNDIP. Pernah menjadi asisten laboratorium pemrograman dasar. Mengikuti program beasiswa Bidikmisi.',
                'portfolio_url'  => 'https://github.com/rizkyardiansyah',
                'github_url'     => 'https://github.com/rizkyardiansyah',
                'linkedin_url'   => 'https://linkedin.com/in/rizkyardiansyah',
                'avatar_source'  => 'download.jpg',
                'skills'         => [1, 2, 5, 20, 28, 24, 25], // PHP, Laravel, React, MySQL, Git, HTML, CSS
            ],
            // Foto 2: download (1).jpg - Perempuan berhijab, blazer biru
            [
                'name'           => 'Siti Nurhaliza Ramadhani',
                'email'          => 'siti.nurhaliza@student.ui.ac.id',
                'password'       => Hash::make('siti1234'),
                'university_id'  => 1,  // Universitas Indonesia
                'major_id'       => 7,  // Manajemen
                'semester'       => 7,
                'bio'            => 'Mahasiswi Manajemen semester 7 di Universitas Indonesia dengan fokus pada pemasaran digital dan pengembangan bisnis. Berpengalaman dalam organisasi mahasiswa dan kegiatan wirausaha kampus.',
                'experience'     => 'Ketua Divisi Marketing Himpunan Mahasiswa Manajemen UI. Pernah magang sebagai Social Media Specialist di startup edtech. Juara 2 lomba business plan tingkat nasional.',
                'portfolio_url'  => 'https://www.linkedin.com/in/sitinurhaliza',
                'github_url'     => null,
                'linkedin_url'   => 'https://linkedin.com/in/sitinurhaliza',
                'avatar_source'  => 'download (1).jpg',
                'skills'         => [56, 57, 58, 55, 51, 64, 65], // Digital Marketing, Content Writing, Social Media, SEO, Excel, Komunikasi, Public Speaking
            ],
            // Foto 3: download (2).jpg - Perempuan berhijab, kemeja putih, background biru
            [
                'name'           => 'Fatimah Azzahra Putri',
                'email'          => 'fatimah.azzahra@student.ugm.ac.id',
                'password'       => Hash::make('fatimah123'),
                'university_id'  => 3,  // Universitas Gadjah Mada
                'major_id'       => 20, // Statistika
                'semester'       => 6,
                'bio'            => 'Mahasiswi Statistika semester 6 di Universitas Gadjah Mada. Passionate di bidang data science dan machine learning. Terbiasa bekerja dengan Python, R, dan tools visualisasi data untuk menganalisis dataset besar.',
                'experience'     => 'Asisten praktikum Statistika Komputasi UGM. Anggota aktif komunitas Data Science UGM. Pernah mengerjakan proyek analisis data untuk UMKM lokal Yogyakarta sebagai bagian dari KKN.',
                'portfolio_url'  => 'https://github.com/fatimahazzahra',
                'github_url'     => 'https://github.com/fatimahazzahra',
                'linkedin_url'   => 'https://linkedin.com/in/fatimahazzahra',
                'avatar_source'  => 'download (2).jpg',
                'skills'         => [8, 54, 39, 40, 20, 53, 52, 51], // Python, R, Data Analysis, Machine Learning, MySQL, Tableau, Power BI, Excel
            ],
            // Foto 4: images.jpg - Laki-laki, jaket biru, lencana merah
            [
                'name'           => 'Ahmad Fauzi Hidayat',
                'email'          => 'ahmad.fauzi@student.its.ac.id',
                'password'       => Hash::make('fauzi123'),
                'university_id'  => 4,  // Institut Teknologi Sepuluh Nopember
                'major_id'       => 4,  // Teknik Elektro
                'semester'       => 7,
                'bio'            => 'Mahasiswa Teknik Elektro semester 7 di ITS Surabaya dengan minat di bidang sistem tenaga listrik dan IoT (Internet of Things). Aktif dalam penelitian dan pengembangan prototipe elektronika.',
                'experience'     => 'Koordinator divisi riset Himpunan Mahasiswa Elektro ITS. Pernah menjuarai kontes robotika tingkat nasional. Sedang mengerjakan tugas akhir tentang sistem monitoring panel surya berbasis IoT.',
                'portfolio_url'  => 'https://github.com/ahmadfauzi-its',
                'github_url'     => 'https://github.com/ahmadfauzi-its',
                'linkedin_url'   => 'https://linkedin.com/in/ahmadfauzihidayat',
                'avatar_source'  => 'images.jpg',
                'skills'         => [44, 31, 28, 13, 8, 51, 63], // Networking, Linux, Git, C++, Python, Excel, Manajemen Proyek
            ],
            // Foto 5: images (1).jpg - Laki-laki, kemeja putih, senyum
            [
                'name'           => 'Bagas Prasetyo Nugroho',
                'email'          => 'bagas.prasetyo@student.telkomuniversity.ac.id',
                'password'       => Hash::make('bagas123'),
                'university_id'  => 16, // Universitas Telkom
                'major_id'       => 2,  // Sistem Informasi
                'semester'       => 5,
                'bio'            => 'Mahasiswa Sistem Informasi semester 5 di Universitas Telkom Bandung. Memiliki semangat tinggi di bidang pengembangan web full-stack dan UI/UX design. Aktif dalam komunitas coding kampus dan freelancing desain website.',
                'experience'     => 'Anggota tim developer aplikasi internal BEM Universitas Telkom. Pernah mengerjakan proyek freelance pembuatan website untuk UMKM lokal. Aktif sebagai kontributor open-source di GitHub.',
                'portfolio_url'  => 'https://bagasprasetyo.dev',
                'github_url'     => 'https://github.com/bagasprasetyo',
                'linkedin_url'   => 'https://linkedin.com/in/bagasprasetyo',
                'avatar_source'  => 'images (1).jpg',
                'skills'         => [1, 2, 5, 6, 34, 35, 20, 28, 24, 25, 26], // PHP, Laravel, React, Vue, UI/UX, Figma, MySQL, Git, HTML, CSS, Tailwind
            ],
        ];

        foreach ($mahasiswas as $data) {
            $skills      = $data['skills'];
            $avatarSource = $data['avatar_source'];
            unset($data['skills'], $data['avatar_source']);

            // Copy avatar from public/Images/Mahasiswa to storage/app/public/avatars
            $sourcePath = public_path('Images/Mahasiswa/' . $avatarSource);
            $ext        = pathinfo($avatarSource, PATHINFO_EXTENSION);
            $slug       = \Illuminate\Support\Str::slug($data['name']);
            $destName   = 'avatars/' . $slug . '.' . $ext;

            if (file_exists($sourcePath)) {
                Storage::disk('public')->put($destName, file_get_contents($sourcePath));
                $data['avatar'] = $destName;
            }

            $mahasiswa = Mahasiswa::create($data);
            $mahasiswa->skills()->sync($skills);
        }
    }
}

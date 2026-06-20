<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Perusahaan;

class PerusahaanSeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            [
                'name'            => 'PT Gojek Indonesia',
                'email'           => 'rekrutmen@gojek.com',
                'password'        => Hash::make('gojek123'),
                'industry_id'     => 1,  // Teknologi Informasi
                'province_id'     => 11, // DKI Jakarta
                'city_id'         => 156, // Kota Jakarta Selatan
                'employee_scale'  => '1000+',
                'website_url'     => 'https://www.gojek.com',
                'description'     => 'Gojek adalah perusahaan teknologi terkemuka di Asia Tenggara yang bergerak di bidang platform on-demand. Gojek menyediakan berbagai layanan mulai dari transportasi, pesan antar makanan, pembayaran digital, hingga logistik. Kami terus berinovasi untuk memudahkan kehidupan sehari-hari jutaan pengguna di seluruh Asia Tenggara.',
                'logo_source'     => 'Gojek.jpg',
                'status_verification' => 'verified',
            ],
            [
                'name'            => 'PT Tokopedia',
                'email'           => 'rekrutmen@tokopedia.com',
                'password'        => Hash::make('tokopedia123'),
                'industry_id'     => 1,  // Teknologi Informasi
                'province_id'     => 11, // DKI Jakarta
                'city_id'         => 158, // Kota Jakarta Pusat
                'employee_scale'  => '1000+',
                'website_url'     => 'https://www.tokopedia.com',
                'description'     => 'Tokopedia adalah perusahaan teknologi Indonesia yang berfokus pada e-commerce dan marketplace terbesar di Indonesia. Dengan misi memberdayakan jutaan pelaku usaha di seluruh Indonesia, Tokopedia terus berinovasi menghadirkan ekosistem perdagangan digital yang inklusif dan merata.',
                'logo_source'     => 'Tokopedia.png',
                'status_verification' => 'verified',
            ],
            [
                'name'            => 'PT Shopee Indonesia',
                'email'           => 'rekrutmen@shopee.co.id',
                'password'        => Hash::make('shopee123'),
                'industry_id'     => 1,  // Teknologi Informasi
                'province_id'     => 11, // DKI Jakarta
                'city_id'         => 156, // Kota Jakarta Selatan
                'employee_scale'  => '1000+',
                'website_url'     => 'https://shopee.co.id',
                'description'     => 'Shopee adalah platform e-commerce terkemuka di Asia Tenggara dan Taiwan yang menyediakan pengalaman berbelanja online yang mudah, aman, dan menyenangkan. Dengan ekosistem digital yang terintegrasi mulai dari logistik hingga pembayaran, Shopee melayani jutaan penjual dan pembeli setiap harinya.',
                'logo_source'     => 'shopee.png',
                'status_verification' => 'verified',
            ],
            [
                'name'            => 'PT Bank Tabungan Negara (Persero) Tbk',
                'email'           => 'rekrutmen@btn.co.id',
                'password'        => Hash::make('btn12345'),
                'industry_id'     => 3,  // Perbankan & Keuangan
                'province_id'     => 11, // DKI Jakarta
                'city_id'         => 158, // Kota Jakarta Pusat
                'employee_scale'  => '1000+',
                'website_url'     => 'https://www.btn.co.id',
                'description'     => 'Bank Tabungan Negara (BTN) adalah bank BUMN yang berfokus pada pembiayaan perumahan dan properti di Indonesia. Sebagai bank yang didedikasikan untuk mewujudkan mimpi masyarakat memiliki hunian yang layak, BTN terus mengembangkan produk dan layanan perbankan inovatif.',
                'logo_source'     => 'LOGO_BBTN_11-09-2024 08_39_14.png',
                'status_verification' => 'verified',
            ],
            [
                'name'            => 'PT PLN (Persero)',
                'email'           => 'rekrutmen@pln.co.id',
                'password'        => Hash::make('pln12345'),
                'industry_id'     => 13, // Pertambangan & Energi
                'province_id'     => 11, // DKI Jakarta
                'city_id'         => 158, // Kota Jakarta Pusat
                'employee_scale'  => '1000+',
                'website_url'     => 'https://www.pln.co.id',
                'description'     => 'PT PLN (Persero) adalah perusahaan listrik negara yang bertanggung jawab dalam penyediaan tenaga listrik bagi seluruh wilayah Indonesia. PLN terus berkomitmen untuk menghadirkan energi listrik yang andal, terjangkau, dan berkelanjutan demi mendukung kemajuan bangsa.',
                'logo_source'     => 'LOGO_PLNI_18-07-2023 14_43_54.png',
                'status_verification' => 'verified',
            ],
            [
                'name'            => 'PT Pelindo Terminal Petikemas',
                'email'           => 'rekrutmen@pelindo.co.id',
                'password'        => Hash::make('pelindo123'),
                'industry_id'     => 11, // Logistik & Transportasi
                'province_id'     => 15, // Jawa Timur
                'city_id'         => 264, // Kota Surabaya
                'employee_scale'  => '501-1000',
                'website_url'     => 'https://www.pelindo.co.id',
                'description'     => 'PT Pelindo Terminal Petikemas adalah anak perusahaan PT Pelabuhan Indonesia yang bergerak di bidang pengelolaan terminal petikemas di seluruh Indonesia. Kami berkomitmen untuk menjadi operator terminal petikemas kelas dunia yang efisien dan kompetitif.',
                'logo_source'     => 'LOGO_PPTP_28-02-2023 11_36_19.png',
                'status_verification' => 'verified',
            ],
            [
                'name'            => 'PT Kimia Farma Tbk',
                'email'           => 'rekrutmen@kimiafarma.co.id',
                'password'        => Hash::make('kimiafarma123'),
                'industry_id'     => 6,  // Kesehatan
                'province_id'     => 11, // DKI Jakarta
                'city_id'         => 158, // Kota Jakarta Pusat
                'employee_scale'  => '1000+',
                'website_url'     => 'https://www.kimiafarma.co.id',
                'description'     => 'PT Kimia Farma Tbk adalah perusahaan farmasi tertua dan terbesar di Indonesia yang bergerak dalam bidang produksi, distribusi, dan ritel produk farmasi dan kesehatan. Didirikan sejak 1817, Kimia Farma terus berinovasi untuk menjadi perusahaan healthcare terdepan di Asia Tenggara.',
                'logo_source'     => 'kimia_farma_logo-svg_800x288.png',
                'status_verification' => 'verified',
            ],
            [
                'name'            => 'PT Waskita Karya (Persero) Tbk',
                'email'           => 'rekrutmen@waskita.co.id',
                'password'        => Hash::make('waskita123'),
                'industry_id'     => 7,  // Manufaktur
                'province_id'     => 11, // DKI Jakarta
                'city_id'         => 157, // Kota Jakarta Timur
                'employee_scale'  => '1000+',
                'website_url'     => 'https://www.waskita.co.id',
                'description'     => 'PT Waskita Karya (Persero) Tbk adalah perusahaan konstruksi BUMN terbesar di Indonesia yang telah berpengalaman lebih dari 60 tahun. Waskita Karya bergerak dalam bidang konstruksi gedung, jalan tol, jembatan, bandara, dan berbagai infrastruktur strategis nasional.',
                'logo_source'     => 'LOGO WSKT (MASTER)_800x636.png',
                'status_verification' => 'verified',
            ],
            [
                'name'            => 'PT Kawasan Industri Wijayakusuma',
                'email'           => 'rekrutmen@kiwi.co.id',
                'password'        => Hash::make('kiwi12345'),
                'industry_id'     => 12, // Properti
                'province_id'     => 13, // Jawa Tengah
                'city_id'         => 220, // Kota Semarang
                'employee_scale'  => '201-500',
                'website_url'     => 'https://www.kiwi.co.id',
                'description'     => 'PT Kawasan Industri Wijayakusuma (KIW) adalah perusahaan BUMN yang mengelola kawasan industri strategis di Semarang, Jawa Tengah. KIW menyediakan lahan siap pakai, infrastruktur lengkap, dan fasilitas penunjang industri bagi para investor domestik dan mancanegara.',
                'logo_source'     => 'LOGO PT. Kawasan Industri Wijayakusuma_800x840.png',
                'status_verification' => 'verified',
            ],
            [
                'name'            => 'PT PG Candi Baru',
                'email'           => 'rekrutmen@pgcandibaru.co.id',
                'password'        => Hash::make('candibaru123'),
                'industry_id'     => 10, // FMCG
                'province_id'     => 15, // Jawa Timur
                'city_id'         => 242, // Kabupaten Sidoarjo
                'employee_scale'  => '201-500',
                'website_url'     => 'https://www.ptpn10.com',
                'description'     => 'PT PG Candi Baru adalah perusahaan yang bergerak dalam industri gula tebu di Sidoarjo, Jawa Timur. Sebagai salah satu pabrik gula tertua di Indonesia, PT PG Candi Baru berkomitmen untuk memproduksi gula berkualitas tinggi sekaligus memberdayakan petani tebu lokal di sekitar wilayah operasional.',
                'logo_source'     => 'AP_PT PG Candi Baru-2.jpg',
                'status_verification' => 'verified',
            ],
            [
                'name'            => 'MHD Express Courier & Cargo',
                'email'           => 'rekrutmen@mhdexpress.co.id',
                'password'        => Hash::make('mhd12345'),
                'industry_id'     => 11, // Logistik & Transportasi
                'province_id'     => 11, // DKI Jakarta
                'city_id'         => 159, // Kota Jakarta Barat
                'employee_scale'  => '51-200',
                'website_url'     => null,
                'description'     => 'MHD Express adalah perusahaan jasa kurir dan kargo yang menyediakan layanan pengiriman cepat, aman, dan terpercaya ke seluruh wilayah Indonesia. Dengan armada dan jaringan agen yang tersebar luas, MHD Express siap melayani kebutuhan pengiriman bisnis maupun personal.',
                'logo_source'     => '-04-05-2026.jpg',
                'status_verification' => 'verified',
            ],
            [
                'name'            => 'AssistX Enterprise',
                'email'           => 'rekrutmen@assistx.co.id',
                'password'        => Hash::make('assistx123'),
                'industry_id'     => 8,  // Konsultan
                'province_id'     => 11, // DKI Jakarta
                'city_id'         => 156, // Kota Jakarta Selatan
                'employee_scale'  => '51-200',
                'website_url'     => null,
                'description'     => 'AssistX Enterprise adalah perusahaan konsultan bisnis dan teknologi yang membantu berbagai perusahaan di Indonesia dalam transformasi digital dan optimasi operasional. Kami menghadirkan solusi cerdas dan inovatif yang disesuaikan dengan kebutuhan spesifik setiap klien.',
                'logo_source'     => '-31-10-2025.jpg',
                'status_verification' => 'verified',
            ],
            [
                'name'            => 'PT Agrinas Jaladri Nusantara',
                'email'           => 'rekrutmen@agrinas.co.id',
                'password'        => Hash::make('agrinas123'),
                'industry_id'     => 10, // FMCG
                'province_id'     => 15, // Jawa Timur
                'city_id'         => 264, // Kota Surabaya
                'employee_scale'  => '51-200',
                'website_url'     => null,
                'description'     => 'PT Agrinas Jaladri Nusantara adalah perusahaan yang bergerak di bidang pengelolaan dan distribusi hasil laut serta perikanan Indonesia. Kami berkomitmen untuk mengoptimalkan potensi kekayaan laut nusantara demi mendukung ketahanan pangan dan kesejahteraan nelayan Indonesia.',
                'logo_source'     => 'LOGO_VRMK_06-03-2025 14_44_55.jpg',
                'status_verification' => 'verified',
            ],
        ];

        foreach ($companies as $data) {
            $logoSource = $data['logo_source'];
            unset($data['logo_source']);

            // Copy logo from public/Images/Perusahaan to storage/app/public/logos
            $sourcePath = public_path('Images/Perusahaan/' . $logoSource);
            $ext = pathinfo($logoSource, PATHINFO_EXTENSION);
            $destName = 'logos/' . \Illuminate\Support\Str::slug($data['name']) . '.' . $ext;

            if (file_exists($sourcePath)) {
                Storage::disk('public')->put($destName, file_get_contents($sourcePath));
                $data['logo'] = $destName;
            }

            Perusahaan::create($data);
        }
    }
}

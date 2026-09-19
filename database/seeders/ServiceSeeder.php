<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name'              => 'KPM Construction',
                'slug'              => 'kpm-construction',
                'division'          => 'construction',
                'tagline'           => 'Konstruksi berkualitas internasional',
                'short_description' => 'Layanan konstruksi sipil dan mekanikal dengan standar kualitas internasional untuk infrastruktur industri dan komersial.',
                'full_description'  => null,
                'sub_services'      => json_encode([
                    ['name' => 'Pembuatan Gardu Induk',    'description' => 'Pembangunan gardu induk tegangan menengah dan tinggi sesuai standar PLN dan internasional.'],
                    ['name' => 'Instalasi Jaringan Listrik','description' => 'Pemasangan jaringan listrik saluran udara dan bawah tanah untuk kebutuhan industri dan komersial.'],
                    ['name' => 'Maintenance',               'description' => 'Pemeliharaan berkala dan perbaikan infrastruktur kelistrikan untuk menjaga keandalan sistem.'],
                    ['name' => 'Konstruksi Sipil Industri', 'description' => 'Pembangunan gedung, fasilitas, dan infrastruktur pendukung industri energi.'],
                ]),
                'sort_order' => 1, 'is_active' => true,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name'              => 'KPM Engineering',
                'slug'              => 'kpm-engineering',
                'division'          => 'engineering',
                'tagline'           => 'Rekayasa teknik inovatif',
                'short_description' => 'Solusi rekayasa teknik inovatif untuk mendukung efisiensi operasional dan keandalan sistem industri.',
                'full_description'  => null,
                'sub_services'      => json_encode([
                    ['name' => 'Perencanaan Sistem', 'description' => 'Perancangan sistem mekanikal, elektrikal, dan instrumentasi yang optimal.'],
                    ['name' => 'Desain Teknis',      'description' => 'Pembuatan gambar teknis, kalkulasi engineering, dan spesifikasi teknis proyek.'],
                ]),
                'sort_order' => 2, 'is_active' => true,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name'              => 'KPM Research & Development',
                'slug'              => 'kpm-research-development',
                'division'          => 'rd',
                'tagline'           => 'Inovasi untuk masa depan',
                'short_description' => 'Inovasi dan riset terapan untuk menciptakan solusi teknologi industri energi masa depan.',
                'full_description'  => null,
                'sub_services'      => json_encode([
                    ['name' => 'Inovasi Teknologi & Energi', 'description' => 'Penelitian dan pengembangan solusi energi terbarukan.'],
                ]),
                'sort_order' => 3, 'is_active' => true,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name'              => 'KPM Farm',
                'slug'              => 'kpm-farm',
                'division'          => 'farm',
                'tagline'           => 'Agrikultur berbasis teknologi',
                'short_description' => 'Agrikultur modern berbasis teknologi untuk ketahanan pangan dan produktivitas lahan secara berkelanjutan.',
                'full_description'  => null,
                'sub_services'      => json_encode([
                    ['name' => 'Pertanian Presisi',   'description' => 'Teknologi sensor dan analisis data untuk mengoptimalkan hasil pertanian.'],
                    ['name' => 'Agribisnis',          'description' => 'Pengembangan model bisnis pertanian profitabel dan berkelanjutan.'],
                ]),
                'sort_order' => 4, 'is_active' => true,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name'              => 'KPM Procurement',
                'slug'              => 'kpm-procurement',
                'division'          => 'procurement',
                'tagline'           => 'Pengadaan efisien & terpercaya',
                'short_description' => 'Pengadaan barang dan material proyek yang efisien, transparan, dan tepat waktu.',
                'full_description'  => null,
                'sub_services'      => json_encode([
                    ['name' => 'Pengadaan Barang & Material Proyek', 'description' => 'Penyediaan material berkualitas sesuai spesifikasi proyek.'],
                    ['name' => 'Manajemen Vendor',                   'description' => 'Seleksi dan evaluasi vendor untuk keandalan pasokan.'],
                ]),
                'sort_order' => 5, 'is_active' => true,
                'created_at' => now(), 'updated_at' => now(),
            ],
        ];

        DB::table('services')->insert($services);
        $this->command->info('Services seeded: ' . count($services) . ' records.');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            [
                'name'        => 'Akta Notaris',
                'file_path'   => 'documents/akta-notaris.pdf',
                'file_type'   => 'pdf',
                'category'    => 'akta_notaris',
                'is_public'   => true,
                'sort_order'  => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'SBU — Sertifikat Badan Usaha',
                'file_path'   => 'documents/sbu.pdf',
                'file_type'   => 'pdf',
                'category'    => 'sbu',
                'is_public'   => true,
                'sort_order'  => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'NPWP Perusahaan',
                'file_path'   => 'documents/npwp.jpg',
                'file_type'   => 'jpg',
                'category'    => 'npwp',
                'is_public'   => true,
                'sort_order'  => 3,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Nomor Induk Berusaha (NIB)',
                'file_path'   => 'documents/nib.pdf',
                'file_type'   => 'pdf',
                'category'    => 'nib',
                'is_public'   => true,
                'sort_order'  => 4,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        DB::table('documents')->insert($documents);

        $this->command->info('Documents seeded: ' . count($documents) . ' records.');
    }
}

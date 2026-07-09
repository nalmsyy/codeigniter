<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiscountSeeder extends Seeder
{
    public function run()
    {
        // Tanggal mulai: hari ini saat seeder dijalankan
        $startDate = new \DateTime();

        // Nominal bervariasi sesuai ketentuan soal
        $nominals = [
            100000,
            100000,
            200000,
            150000,
            250000,
            300000,
            300000,
            300000,
            300000,
            300000,
        ];

        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $tanggal = clone $startDate;
            $tanggal->modify("+{$i} days");

            $data[] = [
                'tanggal'    => $tanggal->format('Y-m-d'),
                'nominal'    => $nominals[$i],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'deleted_at' => null,
            ];
        }

        foreach ($data as $item) {
            $this->db->table('discount')->insert($item);
        }
    }
}

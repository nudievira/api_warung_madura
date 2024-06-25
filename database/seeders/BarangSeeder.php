<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barang')->insert([
            [
                'nama' => 'Kopi',
                'stok' => 100,
                'jenis_barang' => 'Konsumsi',
            ],
            [
                'nama' => 'Teh',
                'stok' => 100,
                'jenis_barang' => 'Konsumsi',
            ],
            [
                'nama' => 'Pasta Gigi',
                'stok' => 100,
                'jenis_barang' => 'Pembersih',
            ],
            [
                'nama' => 'Sabun Mandi',
                'stok' => 100,
                'jenis_barang' => 'Pembersih',
            ],
            [
                'nama' => 'Sampo',
                'stok' => 100,
                'jenis_barang' => 'Pembersih',
            ],
        ]);
    }
}

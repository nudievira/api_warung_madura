<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($id_barang = 1; $id_barang <= 5; $id_barang++) {
            for ($i = 0; $i < 5; $i++) {
                DB::table('transaksi')->insert([
                    'id_barang' => $id_barang,
                    'stok_akhir' => $faker->numberBetween(1, 100),
                    'jumlah_terjual' => $faker->numberBetween(1, 50),
                    'tanggal_transaksi' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}

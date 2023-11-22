<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('penjualan')->insert([
                'no_nota' => $index,
                'tgl_nota' => $faker->date,
                'keterangan' => $faker->sentence,
                'pembayaran' => $faker->randomElement(['Cash', 'E-Wallet','Debit']),
                'total' => $faker->numberBetween(1000, 100000),
                'bayar' => $faker->numberBetween(500, 50000),
                'kembali' => $faker->numberBetween(0, 500),
                'id_pelanggan' => $faker->numberBetween(1, 10),
                'id_user' => $faker->numberBetween(1, 10),
            ]);
    }
}
}

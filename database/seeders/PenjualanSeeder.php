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

        foreach (range(1, 130) as $index) {
            $total = $faker->numberBetween(1000, 1000000);
            $bayar = $faker->numberBetween(1000, 1000000);
            DB::table('penjualan')->insert([
                'no_nota' => $index,
                'tgl_nota' => $faker->dateTimeThisYear(),
                'pembayaran' => $faker->randomElement(['Cash', 'E-Wallet','Debit']),
                'total' => $total,
                'bayar' => $bayar,
                'kembali' => $total - $bayar,
                'id_pelanggan' => $faker->numberBetween(1, 10),
                'id_user' => $faker->numberBetween(1, 10),
            ]);
    }
}
}

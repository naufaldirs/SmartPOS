<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class SparepartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1,10) as $index) {
            $harga = $faker->numberBetween(10000, 100000);
            $stok = $faker->numberBetween(10, 600);
    
            DB::table('sparepart')->insert([
                'kd_sparepart' => $index,
                'nama_sparepart' => $faker->words(2, true),
                'harga' => $harga,
                'stok' => $stok,
                'total_harga' => $harga * $stok,
            ]);
    }
}
}
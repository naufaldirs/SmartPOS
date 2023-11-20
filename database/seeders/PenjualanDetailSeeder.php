<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 40) as $index) {
            DB::table('penjualan_detail')->insert([
                'qty' => $faker->numberBetween(1, 10),
                'subtotal' => $faker->numberBetween(100, 1000),
                'no_nota' => $faker->numberBetween(1, 20),
                'kd_sparepart' => $faker->numberBetween(1, 50),
            ]);
        
    }
}
}
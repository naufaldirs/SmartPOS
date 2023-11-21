<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
=======
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

>>>>>>> 41f3074920338fa150f92d37fa962d2bc1706f0c
class SparepartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('sparepart')->insert([
                'kd_sparepart' => $index,
                'nama_sparepart' =>  $faker->words(2, true),
                'harga' => $faker->numberBetween(1000, 100000),
                'stok' => $faker->numberBetween(1, 100),
            ]);
        }
=======
        //
>>>>>>> 41f3074920338fa150f92d37fa962d2bc1706f0c
    }
}

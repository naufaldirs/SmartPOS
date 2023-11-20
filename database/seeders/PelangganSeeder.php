<?php

namespace Database\Seeders;


use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('pelanggan')->insert([
                'id_pelanggan' => $index,
                'nama_pelanggan' => $faker->name,
                'no_telp' => $faker->phoneNumber,
                'email' => $faker->email,
            ]);
    }
}
}
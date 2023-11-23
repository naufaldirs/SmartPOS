<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('user_detail')->insert([
                'id_user' => $index,
                'nama' => $faker->name,
                'tgl_lahir' => $faker->date,
                'alamat' => $faker->address,
                'no_telp' => $faker->phoneNumber,
                'email' => $faker->email,
            ]);
        }
    }
}

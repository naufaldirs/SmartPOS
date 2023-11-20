<?php
namespace Database\Seeders;
// database/seeders/UserSeeder.php
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            DB::table('users')->insert([
                'id_user' => $index,
                'nip' => $faker->unique()->numberBetween(1, 999),
                'password' => Hash::make('123'), // Ganti dengan kata sandi yang diinginkan
                'role' => $faker->randomElement(['admin', 'akuntan', 'kasir', 'manager']),
                'remember_token' => Str::random(10)
            ]);
        }
    }
}

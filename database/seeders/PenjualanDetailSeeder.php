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

        foreach (range(1, 70) as $index) {
            $qty = $faker->numberBetween(1, 20);
            $subtotal = $faker->numberBetween(100, 1000);
            $noNota = $faker->numberBetween(1, 20);
            $kdSparepart = $faker->numberBetween(1, 50);

            // 1. Dapatkan data sparepart_stok berdasarkan kd_sparepart
            $sparepartStok = DB::table('sparepart')->where('kd_sparepart', $kdSparepart)->first();

            // 2. Kurangkan qty yang baru diinsert dari stok saat ini
            $updatedStok = $sparepartStok->stok - $qty;

            // 3. Update stok di tabel sparepart_stok
            DB::table('sparepart')
                ->where('kd_sparepart', $kdSparepart)
                ->update(['stok' => $updatedStok]);

            // Insert data ke penjualan_detail
            DB::table('penjualan_detail')->insert([
                'qty' => $qty,
                'subtotal' => $subtotal,
                'no_nota' => $noNota,
                'kd_sparepart' => $kdSparepart,
            ]);
        }
        
    }
}


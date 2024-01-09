<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class PenjualanTest extends TestCase
{
    public function testPenjualanCanBeStored()
{
    $response = $this->post('/transaksi-kasir', [
        'no_nota' => 'A14',
        'tgl_nota' => now(),
        'total' => 174747,
        'bayar' => 200000,
        'pembayaran' => 'Cash',
        'kembali' => 25253,
        'pelanggan' => 3,
        'user' => 'Sonia Runte',
        'kd_sparepart' => [14],
        'qty' => [3],
        'subtotal' => [174747],
    ]);

    $response->assertStatus(302); // Pastikan status respons adalah redirect
    $response->assertRedirect('/indexpenjualan'); // Gantilah ini dengan rute yang sesuai

    // Anda mungkin ingin menambahkan asser lebih lanjut berdasarkan kebutuhan Anda
}
}

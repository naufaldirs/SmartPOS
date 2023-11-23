<?php
// Admin: 
// 1.	Halaman Utama
// 2.	Informasi barang
// 3.	Stok sparepart
// 4.	History pembelian
// 5.	Manajemen user

// Akuntan:
// 1.	Halaman Utama
// 2.	Laporan keuangan
// 3.	Laporan pajak
// 4.	Grafik penjualan

// Kasir:
// 1.	Halaman Utama
// 2.	Input data customer
// 3.	Mencetak invoice
// 4.	Data penjulan

// Manajer:
// 1.	Halaman Utama
// 2.	Informasi barang
// 3.	Stok sparepart
// 4.	History pembelian
// 5.	Laporan keuangan
// 6.	Grafik penjualan
// 7.	Data penjualan
return [
    'admin' => [
        [
            'label' => 'Informasi Barang',
            'route' => 'informasibarang',
        ],
        [
            'label' => 'Stok Sparespart',
            'route' => 'barang',
        ],
        [
            'label' => 'Data Pelanggan',
            'route' => 'pelanggan',
        ],
        [
            'label' => 'Riwayat Pembayaran',
            'route' => 'historypembayaran',
        ],
        [
            'label' => 'Manajemen Pengguna',
            'route' => 'manajemenuser',
        ],
        // ... tambahkan modul Admin lainnya
    ],
    'akuntan' => [

    ],
    // Kasir:
// 1.	Halaman Utama
// 2.	Input data customer
// 3.	Mencetak invoice
// 4.	Data penjulan
    'kasir' => [
        [
            'label' => 'Stok Sparespart',
            'route' => 'barang',
        ],
        [
            'label' => 'Input Customer',
            'route' => 'tambahpelanggankasirview',
        ],
        [
            'label' => 'Transaksi Kasir',
            'route' => 'transaksikasirview',
        ],
        [
            'label' => 'Data Penjualan',
            'route' => 'indexpenjualan',
        ],
    ],
    'manajer' => [

    ],
];

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $goods = [
            [
                'nama_barang' => 'Batik Sekolah',
                'harga' => 150000,
                'ukuran' => 'L',
                'jumlah' => 10,
                'tanggal_ditambahkan' => Carbon::now(),
                'categoriesid' => 1, // pastikan category dengan id 1 ada
                'supplierid' => 1, // pastikan supplier dengan id 1 ada
            ],
            [
                'nama_barang' => 'BatikSekolah',
                'harga' => 150000,
                'ukuran' => 'M',
                'jumlah' => 50,
                'tanggal_ditambahkan' => Carbon::now(),
                'categoriesid' => 1,
                'supplierid' => 2,
            ],
            [
                'nama_barang' => 'Topi',
                'harga' => 15000,
                'ukuran' => 'M',
                'jumlah' => 30,
                'tanggal_ditambahkan' => Carbon::now(),
                'categoriesid' => 1,
                'supplierid' => 3,
            ],
        ];

        DB::table('goods')->insert($goods);
    }
}

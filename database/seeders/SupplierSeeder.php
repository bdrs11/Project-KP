<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::insert([
            [
                'id' => '1',
                'supplier_name' => 'PT.PCS',
                'address' => 'jl.Lasir',
                'phone_number' =>'123456789',
            ],
            [
                'id' => '2',
                'supplier_name' => 'PT.BKS',
                'address' => 'jl.Lasir',
                'phone_number' =>'123456789',
            ],
            [
                'id' => '3',
                'supplier_name' => 'PT.CCS',
                'address' => 'jl.Lasir',
                'phone_number' =>'123456789',
            ],
            [
                'id' => '4',
                'supplier_name' => 'PT.NURJANA',
                'address' => 'jl.Lasir',
                'phone_number' =>'123456789',
            ],
            [
                'id' => '5',
                'supplier_name' => 'PT.KKK',
                'address' => 'jl.Lasir',
                'phone_number' =>'123456789',
            ],
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingFeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        DB::table('shipping_fees')->insert([
            ['name' => 'Nội thành TP.HCM', 'fee' => 20000, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ngoại thành TP.HCM', 'fee' => 35000, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tỉnh thành khác', 'fee' => 50000, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}

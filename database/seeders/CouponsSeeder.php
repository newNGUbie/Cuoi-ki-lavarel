<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        DB::table('coupons')->insert([
            [
                'code' => 'GIADUNG50K',
                'type' => 'fixed',
                'value' => 50000,
                'min_order_total' => 300000,
                'max_uses' => 200,
                'used_count' => 0,
                'starts_at' => $now->copy()->subDay(),
                'ends_at' => $now->copy()->addMonths(6),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'GIADUNG10',
                'type' => 'percent',
                'value' => 10,
                'min_order_total' => 200000,
                'max_uses' => 500,
                'used_count' => 0,
                'starts_at' => $now->copy()->subDay(),
                'ends_at' => $now->copy()->addMonths(6),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}

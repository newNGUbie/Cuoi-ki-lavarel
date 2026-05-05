<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlidesSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('slide')->insert([
            [
                'image' => 'banner1.jpg',
                'link' => '/trangchu',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image' => 'banner2.jpg',
                'link' => '/trangchu',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image' => 'banner3.jpg',
                'link' => '/trangchu',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image' => 'banner4.jpg',
                'link' => '/trangchu',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}

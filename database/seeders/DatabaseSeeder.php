<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'full_name' => 'Admin Shop',
            'email' => 'admin@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'phone' => '0123456789',
            'address' => 'Hà Nội',
            'level' => 1
        ]);

        // Kỹ thuật
        User::create([
            'full_name' => 'Kỹ thuật viên',
            'email' => 'kythuat@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'phone' => '0987654321',
            'address' => 'TP.HCM',
            'level' => 2
        ]);

        // Khách hàng
        User::create([
            'full_name' => 'Khách hàng mẫu',
            'email' => 'khachhang@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'phone' => '0333444555',
            'address' => 'Đà Nẵng',
            'level' => 3
        ]);

        $this->call([
            TypeProductsSeeder::class,
            ProductsSeeder::class,
            SlidesSeeder::class,
            ShippingFeesSeeder::class,
            CouponsSeeder::class,
        ]);
    }
}

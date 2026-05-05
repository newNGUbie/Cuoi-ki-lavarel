<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TypeProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        DB::table('type_products')->insert([
            [
                'name' => 'Đồ gia dụng nhà bếp',
                'description' => 'Nồi, chảo, dao, thớt, hộp đựng thực phẩm…',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Thiết bị điện gia dụng',
                'description' => 'Ấm siêu tốc, nồi cơm điện, máy xay, máy hút bụi…',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Vệ sinh - chăm sóc nhà cửa',
                'description' => 'Cây lau nhà, chổi, khăn lau, dung dịch vệ sinh…',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Phòng tắm',
                'description' => 'Kệ, móc treo, thảm, vòi sen, phụ kiện phòng tắm…',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Đồ dùng phòng ngủ',
                'description' => 'Chăn ga, gối, đèn ngủ, móc treo, hộp đựng…',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Đồ dùng thông minh',
                'description' => 'Giá treo, kệ gấp gọn, phụ kiện tối ưu không gian…',
                'image' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}

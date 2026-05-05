<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $typeIds = DB::table('type_products')->orderBy('id')->pluck('id', 'name');
        $kitchen = $typeIds['Đồ gia dụng nhà bếp'] ?? 1;
        $electric = $typeIds['Thiết bị điện gia dụng'] ?? 2;
        $cleaning = $typeIds['Vệ sinh - chăm sóc nhà cửa'] ?? 3;
        $bathroom = $typeIds['Phòng tắm'] ?? 4;
        $bedroom = $typeIds['Đồ dùng phòng ngủ'] ?? 5;
        $smart = $typeIds['Đồ dùng thông minh'] ?? 6;

        $rows = [
            ['name' => 'Chảo chống dính 24cm', 'id_type' => $kitchen, 'unit_price' => 259000, 'promotion_price' => 219000, 'unit' => 'cái', 'new' => 1, 'stock' => 50, 'image' => 'chao.jpg'],
            ['name' => 'Nồi inox 3 đáy 20cm', 'id_type' => $kitchen, 'unit_price' => 349000, 'promotion_price' => 0, 'unit' => 'cái', 'new' => 1, 'stock' => 40, 'image' => 'noi-inox.jpg'],
            ['name' => 'Bộ dao nhà bếp 5 món', 'id_type' => $kitchen, 'unit_price' => 199000, 'promotion_price' => 149000, 'unit' => 'bộ', 'new' => 0, 'stock' => 60, 'image' => 'bo-dao.jpg'],
            ['name' => 'Hộp đựng thực phẩm 1L', 'id_type' => $kitchen, 'unit_price' => 49000, 'promotion_price' => 0, 'unit' => 'hộp', 'new' => 0, 'stock' => 200, 'image' => 'hop-thuc-pham.jpg'],
            ['name' => 'Thớt gỗ tre kháng khuẩn', 'id_type' => $kitchen, 'unit_price' => 89000, 'promotion_price' => 69000, 'unit' => 'cái', 'new' => 0, 'stock' => 110, 'image' => 'thot.jpg'],
            ['name' => 'Muỗng canh inox 6 chiếc', 'id_type' => $kitchen, 'unit_price' => 45000, 'promotion_price' => 0, 'unit' => 'bộ', 'new' => 1, 'stock' => 300, 'image' => 'muong.jpg'],

            ['name' => 'Ấm siêu tốc 1.8L', 'id_type' => $electric, 'unit_price' => 289000, 'promotion_price' => 249000, 'unit' => 'cái', 'new' => 1, 'stock' => 80, 'image' => 'am.jpg'],
            ['name' => 'Máy xay sinh tố 1.2L', 'id_type' => $electric, 'unit_price' => 499000, 'promotion_price' => 399000, 'unit' => 'cái', 'new' => 1, 'stock' => 30, 'image' => 'may-xay.jpg'],
            ['name' => 'Máy hút bụi mini', 'id_type' => $electric, 'unit_price' => 399000, 'promotion_price' => 0, 'unit' => 'cái', 'new' => 0, 'stock' => 25, 'image' => 'may-hut-bui.jpg'],
            ['name' => 'Quạt đứng điều khiển', 'id_type' => $electric, 'unit_price' => 459000, 'promotion_price' => 399000, 'unit' => 'cái', 'new' => 0, 'stock' => 22, 'image' => 'quat.jpg'],
            ['name' => 'Bàn ủi hơi nước', 'id_type' => $electric, 'unit_price' => 329000, 'promotion_price' => 0, 'unit' => 'cái', 'new' => 1, 'stock' => 18, 'image' => 'ban-ui.jpg'],

            ['name' => 'Cây lau nhà tự vắt', 'id_type' => $cleaning, 'unit_price' => 179000, 'promotion_price' => 149000, 'unit' => 'bộ', 'new' => 0, 'stock' => 100, 'image' => 'choi.jpg'],
            ['name' => 'Dung dịch vệ sinh sàn (1L)', 'id_type' => $cleaning, 'unit_price' => 65000, 'promotion_price' => 0, 'unit' => 'chai', 'new' => 0, 'stock' => 150, 'image' => 'nuoc-lau-san.jpg'],
            ['name' => 'Găng tay cao su (đôi)', 'id_type' => $cleaning, 'unit_price' => 25000, 'promotion_price' => 0, 'unit' => 'đôi', 'new' => 1, 'stock' => 400, 'image' => 'gang-tay.jpg'],
            ['name' => 'Khăn microfiber 5 miếng', 'id_type' => $cleaning, 'unit_price' => 79000, 'promotion_price' => 59000, 'unit' => 'bộ', 'new' => 0, 'stock' => 95, 'image' => 'khan.jpg'],

            ['name' => 'Kệ góc nhà tắm inox', 'id_type' => $bathroom, 'unit_price' => 129000, 'promotion_price' => 99000, 'unit' => 'cái', 'new' => 1, 'stock' => 70, 'image' => 'ke-tam.jpg'],
            ['name' => 'Thảm chống trượt nhà tắm', 'id_type' => $bathroom, 'unit_price' => 79000, 'promotion_price' => 59000, 'unit' => 'cái', 'new' => 0, 'stock' => 120, 'image' => 'tham.jpg'],
            ['name' => 'Vòi sen tăng áp', 'id_type' => $bathroom, 'unit_price' => 189000, 'promotion_price' => 0, 'unit' => 'cái', 'new' => 0, 'stock' => 40, 'image' => 'voi-sen.jpg'],

            ['name' => 'Đèn ngủ cảm biến', 'id_type' => $bedroom, 'unit_price' => 119000, 'promotion_price' => 0, 'unit' => 'cái', 'new' => 0, 'stock' => 90, 'image' => 'den-ngu.jpg'],
            ['name' => 'Gối memory foam', 'id_type' => $bedroom, 'unit_price' => 299000, 'promotion_price' => 259000, 'unit' => 'cái', 'new' => 1, 'stock' => 45, 'image' => 'goi.jpg'],
            ['name' => 'Tấm phủ giường chống bụi', 'id_type' => $bedroom, 'unit_price' => 139000, 'promotion_price' => 99000, 'unit' => 'cái', 'new' => 0, 'stock' => 55, 'image' => 'tam-phu.jpg'],

            ['name' => 'Giá treo chổi dán tường', 'id_type' => $smart, 'unit_price' => 59000, 'promotion_price' => 0, 'unit' => 'cái', 'new' => 0, 'stock' => 180, 'image' => 'gia-treo.jpg'],
            ['name' => 'Kệ để đồ gấp gọn 3 tầng', 'id_type' => $smart, 'unit_price' => 349000, 'promotion_price' => 299000, 'unit' => 'cái', 'new' => 1, 'stock' => 35, 'image' => 'ke-3-tang.jpg'],
            ['name' => 'Hộp đựng đồ đa năng có nắp', 'id_type' => $smart, 'unit_price' => 89000, 'promotion_price' => 69000, 'unit' => 'cái', 'new' => 0, 'stock' => 130, 'image' => 'hop-da-nang.jpg'],
        ];

        $typesCycle = [$kitchen, $electric, $cleaning, $bathroom, $bedroom, $smart];
        for ($i = 1; $i <= 38; $i++) { // Tăng số lượng sản phẩm mẫu được tạo tự động
            $tid = $typesCycle[($i - 1) % count($typesCycle)];
            $base = 39000 + ($i * 7300);
            $promo = ($i % 3 === 0) ? (int) round($base * 0.85) : 0;
            $rows[] = [
                'name' => 'Sản phẩm gia dụng mẫu #' . $i,
                'id_type' => $tid,
                'unit_price' => $base,
                'promotion_price' => $promo,
                'unit' => 'cái',
                'new' => $i % 4 === 0 ? 1 : 0,
                'stock' => 20 + ($i * 3),
            ];
        }

        DB::table('products')->insert(array_map(function ($p) use ($now) {
            return array_merge([
                'description' => 'Sản phẩm đồ gia dụng — dữ liệu mẫu cho demo.',
                'created_at' => $now,
                'updated_at' => $now,
            ], $p);
        }, $rows));
    }
}

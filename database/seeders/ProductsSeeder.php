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
            ['name' => 'Chảo chống dính 24cm', 'id_type' => $kitchen, 'unit_price' => 259000, 'promotion_price' => 219000, 'unit' => 'cái', 'new' => 1, 'stock' => 50, 'image' => 'chao.jpg', 'description' => 'Chảo chống dính cao cấp dùng cho mọi loại bếp, phủ lớp chống dính bền bỉ, tay cầm cách nhiệt an toàn.'],
            ['name' => 'Nồi inox 3 đáy 20cm', 'id_type' => $kitchen, 'unit_price' => 349000, 'promotion_price' => 0, 'unit' => 'cái', 'new' => 1, 'stock' => 40, 'image' => 'noi-inox.jpg', 'description' => 'Nồi inox 304 cao cấp, thiết kế 3 đáy truyền nhiệt cực nhanh và giữ nhiệt tốt, phù hợp mọi loại bếp.'],
            ['name' => 'Bộ dao nhà bếp 5 món', 'id_type' => $kitchen, 'unit_price' => 199000, 'promotion_price' => 149000, 'unit' => 'bộ', 'new' => 0, 'stock' => 60, 'image' => 'bo-dao.jpg', 'description' => 'Bộ dao thép không gỉ sắc bén, thiết kế công thái học gồm dao chặt, dao thái và kéo nhà bếp tiện dụng.'],
            ['name' => 'Hộp đựng thực phẩm 1L', 'id_type' => $kitchen, 'unit_price' => 49000, 'promotion_price' => 0, 'unit' => 'hộp', 'new' => 0, 'stock' => 200, 'image' => 'hop-thuc-pham.jpg', 'description' => 'Hộp nhựa nguyên sinh an toàn sức khỏe, nắp kín khí tuyệt đối giúp bảo quản thực phẩm tươi lâu trong tủ lạnh.'],
            ['name' => 'Thớt gỗ tre kháng khuẩn', 'id_type' => $kitchen, 'unit_price' => 89000, 'promotion_price' => 69000, 'unit' => 'cái', 'new' => 0, 'stock' => 110, 'image' => 'thot.jpg', 'description' => 'Thớt gỗ tre tự nhiên, bề mặt cứng cáp không để lại vết dao sâu, kháng khuẩn tự nhiên, dễ vệ sinh.'],
            ['name' => 'Muỗng canh inox 6 chiếc', 'id_type' => $kitchen, 'unit_price' => 45000, 'promotion_price' => 0, 'unit' => 'bộ', 'new' => 1, 'stock' => 300, 'image' => 'muong.jpg', 'description' => 'Bộ 6 muỗng canh inox sáng bóng, không gỉ sét, thiết kế sang trọng làm đẹp không gian bàn ăn.'],

            ['name' => 'Ấm siêu tốc 1.8L', 'id_type' => $electric, 'unit_price' => 289000, 'promotion_price' => 249000, 'unit' => 'cái', 'new' => 1, 'stock' => 80, 'image' => 'am.jpg', 'description' => 'Ấm siêu tốc đun nước nhanh chóng, tích hợp cảm biến tự động ngắt khi sôi và khi cạn nước, an toàn tuyệt đối.'],
            ['name' => 'Máy xay sinh tố 1.2L', 'id_type' => $electric, 'unit_price' => 499000, 'promotion_price' => 399000, 'unit' => 'cái', 'new' => 1, 'stock' => 30, 'image' => 'may-xay.jpg', 'description' => 'Máy xay đa năng công suất lớn, lưỡi dao thép không gỉ cực bén, xay nhuyễn mịn mọi loại trái cây và đá.'],
            ['name' => 'Máy hút bụi mini', 'id_type' => $electric, 'unit_price' => 399000, 'promotion_price' => 0, 'unit' => 'cái', 'new' => 0, 'stock' => 25, 'image' => 'may-hut-bui.jpg', 'description' => 'Máy hút bụi cầm tay nhỏ gọn, lực hút mạnh mẽ giúp vệ sinh sạch sẽ các ngóc ngách khó tiếp cận trong nhà và ô tô.'],
            ['name' => 'Quạt đứng điều khiển', 'id_type' => $electric, 'unit_price' => 459000, 'promotion_price' => 399000, 'unit' => 'cái', 'new' => 0, 'stock' => 22, 'image' => 'quat.jpg', 'description' => 'Quạt đứng sang trọng có điều khiển từ xa, nhiều chế độ gió linh hoạt, vận hành êm ái không gây ồn.'],
            ['name' => 'Bàn ủi hơi nước', 'id_type' => $electric, 'unit_price' => 329000, 'promotion_price' => 0, 'unit' => 'cái', 'new' => 1, 'stock' => 18, 'image' => 'ban-ui.jpg', 'description' => 'Bàn ủi hơi nước cầm tay nhỏ gọn, xóa tan mọi nếp nhăn quần áo nhanh chóng, phù hợp mang đi du lịch.'],

            ['name' => 'Cây lau nhà tự vắt', 'id_type' => $cleaning, 'unit_price' => 179000, 'promotion_price' => 149000, 'unit' => 'bộ', 'new' => 0, 'stock' => 100, 'image' => 'choi.jpg', 'description' => 'Cây lau nhà thông minh xoay 360 độ, cơ chế tự vắt nước cực sạch không cần chạm tay, tiết kiệm sức lao động.'],
            ['name' => 'Dung dịch vệ sinh sàn (1L)', 'id_type' => $cleaning, 'unit_price' => 65000, 'promotion_price' => 0, 'unit' => 'chai', 'new' => 0, 'stock' => 150, 'image' => 'nuoc-lau-san.jpg', 'description' => 'Nước lau sàn đậm đặc với hương thơm dịu nhẹ lâu phai, giúp diệt khuẩn và làm sạch bóng mọi bề mặt sàn.'],
            ['name' => 'Găng tay cao su (đôi)', 'id_type' => $cleaning, 'unit_price' => 25000, 'promotion_price' => 0, 'unit' => 'đôi', 'new' => 1, 'stock' => 400, 'image' => 'gang-tay.jpg', 'description' => 'Găng tay cao su dẻo dai, chống thấm nước, bảo vệ đôi tay khỏi hóa chất tẩy rửa khi làm việc nhà.'],
            ['name' => 'Khăn microfiber 5 miếng', 'id_type' => $cleaning, 'unit_price' => 79000, 'promotion_price' => 59000, 'unit' => 'bộ', 'new' => 0, 'stock' => 95, 'image' => 'khan.jpg', 'description' => 'Bộ 5 khăn lau đa năng microfiber siêu thấm hút, mềm mại, không để lại bụi vải hay vết trầy xước trên đồ vật.'],

            ['name' => 'Kệ góc nhà tắm inox', 'id_type' => $bathroom, 'unit_price' => 129000, 'promotion_price' => 99000, 'unit' => 'cái', 'new' => 1, 'stock' => 70, 'image' => 'ke-tam.jpg', 'description' => 'Kệ inox 304 cao cấp không gỉ sét, chịu lực cực tốt, giúp tối ưu diện tích và làm gọn không gian phòng tắm.'],
            ['name' => 'Thảm chống trượt nhà tắm', 'id_type' => $bathroom, 'unit_price' => 79000, 'promotion_price' => 59000, 'unit' => 'cái', 'new' => 0, 'stock' => 120, 'image' => 'tham.jpg', 'description' => 'Thảm silicon chống trượt cao cấp, độ bám dính bề mặt cực tốt, an toàn tuyệt đối cho người già và trẻ nhỏ.'],
            ['name' => 'Vòi sen tăng áp', 'id_type' => $bathroom, 'unit_price' => 189000, 'promotion_price' => 0, 'unit' => 'cái', 'new' => 0, 'stock' => 40, 'image' => 'voi-sen.jpg', 'description' => 'Vòi sen công nghệ tăng áp lực nước mạnh mẽ, tiết kiệm nước hiệu quả và mang lại cảm giác thư giãn khi tắm.'],

            ['name' => 'Đèn ngủ cảm biến', 'id_type' => $bedroom, 'unit_price' => 119000, 'promotion_price' => 0, 'unit' => 'cái', 'new' => 0, 'stock' => 90, 'image' => 'den-ngu.jpg', 'description' => 'Đèn ngủ thông minh tự động sáng khi trời tối, ánh sáng vàng dịu mắt giúp bạn dễ đi vào giấc ngủ sâu.'],
            ['name' => 'Gối memory foam', 'id_type' => $bedroom, 'unit_price' => 299000, 'promotion_price' => 259000, 'unit' => 'cái', 'new' => 1, 'stock' => 45, 'image' => 'goi.jpg', 'description' => 'Gối cao su non đàn hồi chậm giúp nâng đỡ tối ưu đốt sống cổ, giảm hẳn đau mỏi vai gáy sau khi thức dậy.'],
            ['name' => 'Tấm phủ giường chống bụi', 'id_type' => $bedroom, 'unit_price' => 139000, 'promotion_price' => 99000, 'unit' => 'cái', 'new' => 0, 'stock' => 55, 'image' => 'tam-phu.jpg', 'description' => 'Tấm phủ chất liệu cao cấp giúp bảo vệ nệm khỏi bụi bẩn, vi khuẩn và mồ hôi, dễ dàng tháo rời để giặt sạch.'],

            ['name' => 'Giá treo chổi dán tường', 'id_type' => $smart, 'unit_price' => 59000, 'promotion_price' => 0, 'unit' => 'cái', 'new' => 0, 'stock' => 180, 'image' => 'gia-treo.jpg', 'description' => 'Giá treo thông minh dán tường siêu chắc không cần khoan, giúp sắp xếp gọn gàng chổi và các dụng cụ vệ sinh.'],
            ['name' => 'Kệ để đồ gấp gọn 3 tầng', 'id_type' => $smart, 'unit_price' => 349000, 'promotion_price' => 299000, 'unit' => 'cái', 'new' => 1, 'stock' => 35, 'image' => 'ke-3-tang.jpg', 'description' => 'Kệ thép sơn tĩnh điện thiết kế gấp gọn linh hoạt, giải pháp hoàn hảo để tối ưu không gian lưu trữ cho gia đình.'],
            ['name' => 'Hộp đựng đồ đa năng có nắp', 'id_type' => $smart, 'unit_price' => 89000, 'promotion_price' => 69000, 'unit' => 'cái', 'new' => 0, 'stock' => 130, 'image' => 'hop-da-nang.jpg', 'description' => 'Hộp vải khung cứng đựng đồ cá nhân hoặc quần áo, có nắp đậy ngăn bụi, giúp căn phòng luôn ngăn nắp sạch sẽ.'],
        ];

        $typesCycle = [$kitchen, $electric, $cleaning, $bathroom, $bedroom, $smart];
        for ($i = 1; $i <= 18; $i++) {
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
                'image' => 'placeholder.png',
                'created_at' => $now,
                'updated_at' => $now,
            ], $p);
        }, $rows));
    }
}

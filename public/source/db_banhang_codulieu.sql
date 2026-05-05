-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2017 at 08:34 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Tắt kiểm tra khóa ngoại
SET FOREIGN_KEY_CHECKS=0;

-- Nếu lệnh DROP DATABASE lỗi #1010, hãy xóa thủ công thư mục trong mysql/data
-- DROP DATABASE IF EXISTS `new_shop`;
CREATE DATABASE IF NOT EXISTS `new_shop` CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `new_shop`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_banhang`
--

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `gender`, `email`, `address`, `phone_number`, `note`, `created_at`, `updated_at`) VALUES
(15, 'Nguyễn Văn An', 'Nam', 'an.nguyen@gmail.com', '123 Cách Mạng Tháng 8, Quận 3', '0901234567', 'Giao hàng giờ hành chính', NOW(), NOW()),
(14, 'Lê Thị Bình', 'Nữ', 'binh.le@gmail.com', '456 Hoàng Diệu, Quận 4', '0912345678', 'Hàng dễ vỡ, xin cẩn thận', NOW(), NOW()),
(13, 'Phạm Hồng Phúc', 'Nam', 'phuc.pham@gmail.com', '789 Mai Chí Thọ, Quận 2', '0988888888', 'Giao hàng sau 5h chiều', NOW(), NOW()),
(12, 'Đỗ Minh Khoa', 'Nam', 'khoa.do@gmail.com', '321 Lê Lợi, Quận 1', '0945666777', '', NOW(), NOW()),
(11, 'Trần Thu Thảo', 'Nữ', 'thao.tran@gmail.com', '159 Lý Tự Trọng, Quận 1', '0933445566', 'Gọi trước khi đến', NOW(), NOW());

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'tiêu đề',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'nội dung',
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'hình',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Mẹo vệ sinh nồi chiên không dầu đúng cách', 'Nồi chiên không dầu cần được vệ sinh sau mỗi lần sử dụng để đảm bảo độ bền của lớp chống dính.', 'news1.jpg', NOW(), NOW()),
(2, 'Cách chọn máy lọc nước cho gia đình', 'Tùy vào nguồn nước đầu vào, bạn nên chọn công nghệ RO hoặc Nano.', 'news2.jpg', NOW(), NOW()),
(3, 'Sắp xếp gian bếp gọn gàng kiểu Nhật', 'Sử dụng kệ đa năng giúp tối ưu hóa diện tích cho căn bếp nhỏ của bạn.', 'news3.jpg', NOW(), NOW()),
(4, 'Tiêu chí chọn Robot hút bụi thông minh', 'Lực hút và thời lượng pin là hai yếu tố then chốt khi chọn mua máy hút bụi tự động.', 'news4.jpg', NOW(), NOW()),
(5, 'Lợi ích của máy lọc không khí', 'Giúp loại bỏ bụi mịn và các tác nhân gây dị ứng trong không gian sống.', 'news5.jpg', NOW(), NOW());

-- --------------------------------------------------------
--
-- Table structure for table `type_products`
--

DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `type_products`;
CREATE TABLE `type_products` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8;

--
-- Dumping data for table `type_products`
--

INSERT INTO `type_products` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Đồ gia dụng nhà bếp', 'Nồi, chảo, dao, thớt, hộp đựng thực phẩm…', 'kitchen.jpg', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(2, 'Thiết bị điện gia dụng', 'Ấm siêu tốc, nồi cơm điện, máy xay, máy hút bụi…', 'electric.jpg', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(3, 'Vệ sinh - chăm sóc nhà cửa', 'Cây lau nhà, chổi, khăn lau, dung dịch vệ sinh…', 'cleaning.jpg', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(4, 'Phòng tắm', 'Kệ, móc treo, thảm, vòi sen, phụ kiện phòng tắm…', 'bathroom.jpg', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(5, 'Đồ dùng phòng ngủ', 'Chăn ga, gối, đèn ngủ, móc treo, hộp đựng…', 'bedroom.jpg', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(6, 'Đồ dùng thông minh', 'Giá treo, kệ gấp gọn, phụ kiện tối ưu không gian…', 'smart.jpg', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_type` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `unit_price` float DEFAULT NULL,
  `promotion_price` float DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new` tinyint(4) DEFAULT '0',
  `stock` int(11) DEFAULT '10',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `id_type`, `description`, `unit_price`, `promotion_price`, `image`, `unit`, `new`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'Chảo chống dính 24cm', 1, 'Chảo chống dính cao cấp dùng cho mọi loại bếp, phủ lớp chống dính bền bỉ, tay cầm cách nhiệt an toàn.', 259000, 219000, 'chao.jpg', 'cái', 1, 50, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(2, 'Nồi inox 3 đáy 20cm', 1, 'Nồi inox 304 cao cấp, thiết kế 3 đáy truyền nhiệt cực nhanh và giữ nhiệt tốt, phù hợp mọi loại bếp.', 349000, 0, 'noi-inox.jpg', 'cái', 1, 40, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(3, 'Bộ dao nhà bếp 5 món', 1, 'Bộ dao thép không gỉ sắc bén, thiết kế công thái học gồm dao chặt, dao thái và kéo nhà bếp tiện dụng.', 199000, 149000, 'bo-dao.jpg', 'bộ', 0, 60, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(4, 'Hộp đựng thực phẩm 1L', 1, 'Hộp nhựa nguyên sinh an toàn sức khỏe, nắp kín khí tuyệt đối giúp bảo quản thực phẩm tươi lâu trong tủ lạnh.', 49000, 0, 'hop-thuc-pham.jpg', 'hộp', 0, 200, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(5, 'Thớt gỗ tre kháng khuẩn', 1, 'Thớt gỗ tre tự nhiên, bề mặt cứng cáp không để lại vết dao sâu, kháng khuẩn tự nhiên, dễ vệ sinh.', 89000, 69000, 'thot.jpg', 'cái', 0, 110, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(6, 'Muỗng canh inox 6 chiếc', 1, 'Bộ 6 muỗng canh inox sáng bóng, không gỉ sét, thiết kế sang trọng làm đẹp không gian bàn ăn.', 45000, 0, 'muong.jpg', 'bộ', 1, 300, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(7, 'Ấm siêu tốc 1.8L', 2, 'Ấm siêu tốc đun nước nhanh chóng, tích hợp cảm biến tự động ngắt khi sôi và khi cạn nước, an toàn tuyệt đối.', 289000, 249000, 'am.jpg', 'cái', 1, 80, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(8, 'Máy xay sinh tố 1.2L', 2, 'Máy xay đa năng công suất lớn, lưỡi dao thép không gỉ cực bén, xay nhuyễn mịn mọi loại trái cây và đá.', 499000, 399000, 'may-xay.jpg', 'cái', 1, 30, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(9, 'Máy hút bụi mini', 2, 'Máy hút bụi cầm tay nhỏ gọn, lực hút mạnh mẽ giúp vệ sinh sạch sẽ các ngóc ngách khó tiếp cận trong nhà và ô tô.', 399000, 0, 'may-hut-bui.jpg', 'cái', 0, 25, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(10, 'Quạt đứng điều khiển', 2, 'Quạt đứng sang trọng có điều khiển từ xa, nhiều chế độ gió linh hoạt, vận hành êm ái không gây ồn.', 459000, 399000, 'quat.jpg', 'cái', 0, 22, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(11, 'Bàn ủi hơi nước', 2, 'Bàn ủi hơi nước cầm tay nhỏ gọn, xóa tan mọi nếp nhăn quần áo nhanh chóng, phù hợp mang đi du lịch.', 329000, 0, 'ban-ui.jpg', 'cái', 1, 18, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(12, 'Cây lau nhà tự vắt', 3, 'Cây lau nhà thông minh xoay 360 độ, cơ chế tự vắt nước cực sạch không cần chạm tay, tiết kiệm sức lao động.', 179000, 149000, 'choi.jpg', 'bộ', 0, 100, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(13, 'Dung dịch vệ sinh sàn (1L)', 3, 'Nước lau sàn đậm đặc với hương thơm dịu nhẹ lâu phai, giúp diệt khuẩn và làm sạch bóng mọi bề mặt sàn.', 65000, 0, 'nuoc-lau-san.jpg', 'chai', 0, 150, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(14, 'Găng tay cao su (đôi)', 3, 'Găng tay cao su dẻo dai, chống thấm nước, bảo vệ đôi tay khỏi hóa chất tẩy rửa khi làm việc nhà.', 25000, 0, 'gang-tay.jpg', 'đôi', 1, 400, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(15, 'Khăn microfiber 5 miếng', 3, 'Bộ 5 khăn lau đa năng microfiber siêu thấm hút, mềm mại, không để lại bụi vải hay vết trầy xước trên đồ vật.', 79000, 59000, 'khan.jpg', 'bộ', 0, 95, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(16, 'Kệ góc nhà tắm inox', 4, 'Kệ inox 304 cao cấp không gỉ sét, chịu lực cực tốt, giúp tối ưu diện tích và làm gọn không gian phòng tắm.', 129000, 99000, 'ke-tam.jpg', 'cái', 1, 70, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(17, 'Thảm chống trượt nhà tắm', 4, 'Thảm silicon chống trượt cao cấp, độ bám dính bề mặt cực tốt, an toàn tuyệt đối cho người già và trẻ nhỏ.', 79000, 59000, 'tham.jpg', 'cái', 0, 120, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(18, 'Vòi sen tăng áp', 4, 'Vòi sen công nghệ tăng áp lực nước mạnh mẽ, tiết kiệm nước hiệu quả và mang lại cảm giác thư giãn khi tắm.', 189000, 0, 'voi-sen.jpg', 'cái', 0, 40, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(19, 'Đèn ngủ cảm biến', 5, 'Đèn ngủ thông minh tự động sáng khi trời tối, ánh sáng vàng dịu mắt giúp bạn dễ đi vào giấc ngủ sâu.', 119000, 0, 'den-ngu.jpg', 'cái', 0, 90, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(20, 'Gối memory foam', 5, 'Gối cao su non đàn hồi chậm giúp nâng đỡ tối ưu đốt sống cổ, giảm hẳn đau mỏi vai gáy sau khi thức dậy.', 299000, 259000, 'goi.jpg', 'cái', 1, 45, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(21, 'Tấm phủ giường chống bụi', 5, 'Tấm phủ chất liệu cao cấp giúp bảo vệ nệm khỏi bụi bẩn, vi khuẩn và mồ hôi, dễ dàng tháo rời để giặt sạch.', 139000, 99000, 'tam-phu.jpg', 'cái', 0, 55, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(22, 'Giá treo chổi dán tường', 6, 'Giá treo thông minh dán tường siêu chắc không cần khoan, giúp sắp xếp gọn gàng chổi và các dụng cụ vệ sinh.', 59000, 0, 'gia-treo.jpg', 'cái', 0, 180, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(23, 'Kệ để đồ gấp gọn 3 tầng', 6, 'Kệ thép sơn tĩnh điện thiết kế gấp gọn linh hoạt, giải pháp hoàn hảo để tối ưu không gian lưu trữ cho gia đình.', 349000, 299000, 'ke-3-tang.jpg', 'cái', 1, 35, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(24, 'Hộp đựng đồ đa năng có nắp', 6, 'Hộp vải khung cứng đựng đồ cá nhân hoặc quần áo, có nắp đậy ngăn bụi, giúp căn phòng luôn ngăn nắp sạch sẽ.', 89000, 69000, 'hop-da-nang.jpg', 'cái', 0, 130, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

-- DROP TABLE IF EXISTS `slide`; -- Removed, as PRIMARY KEY AUTO_INCREMENT is added below
CREATE TABLE `slide` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `link` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `link`, `image`) VALUES
(1, '', 'banner1.jpg'),
(2, '', 'banner2.jpg'),
(3, '', 'banner3.jpg'),
(4, '', 'banner4.jpg');

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `shipping_fees`
--

DROP TABLE IF EXISTS `shipping_fees`;
CREATE TABLE `shipping_fees` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fee` float NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shipping_fees`
--

INSERT INTO `shipping_fees` (`id`, `name`, `fee`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Nội thành TP.HCM', 20000, 1, NOW(), NOW()),
(2, 'Ngoại thành TP.HCM', 35000, 1, NOW(), NOW()),
(3, 'Tỉnh thành khác', 50000, 1, NOW(), NOW());

-- --------------------------------------------------------
--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) DEFAULT '0' COMMENT '1:admin, 2:staff, 3:user',
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `level`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'Quản trị viên', 'admin@gmail.com', '$2y$10$rGY4KT6ZSMmLnxIbmTXrsu2xdgRxm8x0UTwCyYCAzrJ320kYheSRq', 1, '0987654321', 'TP. HCM', NULL, NOW(), NOW());

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE `wishlists` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
SET FOREIGN_KEY_CHECKS=1;

-- --------------------------------------------------------

DROP TABLE IF EXISTS `bills`;
CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_customer` int(10) UNSIGNED DEFAULT NULL, -- Khóa ngoại tới bảng customer
  `user_id` int(10) UNSIGNED DEFAULT NULL, -- Khóa ngoại tới bảng users (người dùng đăng nhập đặt hàng)
  `date_order` date DEFAULT NULL,
  `subtotal` float DEFAULT NULL COMMENT 'tổng tiền các sản phẩm (chưa bao gồm phí ship và giảm giá)',
  `shipping_fee` float DEFAULT NULL COMMENT 'phí vận chuyển',
  `coupon_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'mã giảm giá đã áp dụng',
  `discount_amount` float DEFAULT NULL COMMENT 'số tiền giảm giá',
  `total` float DEFAULT NULL COMMENT 'tổng tiền cuối cùng (sau khi áp dụng phí ship và giảm giá)',
  `payment` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'hình thức thanh toán',
  `note` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Mới' COMMENT 'trạng thái đơn hàng',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `id_customer`, `date_order`, `total`, `payment`, `note`, `created_at`, `updated_at`) VALUES
(14, 14, '2023-10-01', 468000, 'COD', 'Giao giờ hành chính', NOW(), NOW()), -- Các cột mới sẽ nhận giá trị DEFAULT NULL
(13, 13, '2023-10-02', 259000, 'ATM', 'Hàng dễ vỡ', NOW(), NOW()),
(12, 12, '2023-10-03', 179000, 'COD', '', NOW(), NOW()),
(11, 11, '2023-10-04', 289000, 'COD', '', NOW(), NOW());

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

DROP TABLE IF EXISTS `bill_detail`;
CREATE TABLE `bill_detail` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_bill` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL COMMENT 'số lượng',
  `unit_price` float NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bill_detail`
--

INSERT INTO `bill_detail` (`id`, `id_bill`, `id_product`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(17, 14, 1, 2, 219000, NOW(), NOW()),
(16, 13, 2, 1, 259000, NOW(), NOW()),
(14, 12, 3, 1, 179000, NOW(), NOW()),
(11, 11, 2, 1, 289000, NOW(), NOW());

-- --------------------------------------------------------


--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD KEY `bills_id_customer_idx` (`id_customer`),
  ADD KEY `bills_user_id_idx` (`user_id`);

--
-- Indexes for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD KEY `bill_detail_ibfk_2` (`id_product`);

--
-- Indexes for table `customer`
--

--
-- Indexes for table `news`
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD KEY `products_id_type_foreign` (`id_type`);

--
-- Indexes for table `slide`
--
-- PRIMARY KEY (`id`) đã được thêm trực tiếp vào CREATE TABLE

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `bill_detail`
--
ALTER TABLE `bill_detail`
  AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `type_products`
--
ALTER TABLE `type_products`
  AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

-- Constraints for table `bills`
--
ALTER TABLE `bills` ADD CONSTRAINT `bills_id_customer_foreign` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE SET NULL;
ALTER TABLE `bills` ADD CONSTRAINT `bills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_id_type_foreign` FOREIGN KEY (`id_type`) REFERENCES `type_products` (`id`);

-- Constraints for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD CONSTRAINT `bill_detail_id_bill_foreign` FOREIGN KEY (`id_bill`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_detail_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE;

-- Bật lại kiểm tra khóa ngoại sau khi hoàn tất
SET FOREIGN_KEY_CHECKS=1;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

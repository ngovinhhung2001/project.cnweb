-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 06, 2022 lúc 02:04 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `milktea`
--
CREATE DATABASE IF NOT EXISTS `milktea` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `milktea`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bills`
--

DROP TABLE IF EXISTS `bills`;
CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `bills`
--

INSERT INTO `bills` (`bill_id`, `user_id`, `bill_created_at`) VALUES
(1, 2, '2022-11-06 02:03:12'),
(2, 2, '2022-11-06 02:03:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `billsdetail`
--

DROP TABLE IF EXISTS `billsdetail`;
CREATE TABLE `billsdetail` (
  `bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `billsdetail`
--

INSERT INTO `billsdetail` (`bill_id`, `product_id`, `product_amount`) VALUES
(1, 2, 2),
(1, 3, 1),
(1, 7, 1),
(2, 7, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `catalogs`
--

DROP TABLE IF EXISTS `catalogs`;
CREATE TABLE `catalogs` (
  `catalog_id` int(11) UNSIGNED NOT NULL,
  `catalog_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `catalogs`
--

INSERT INTO `catalogs` (`catalog_id`, `catalog_name`) VALUES
(1, 'Trà sữa'),
(2, 'Trà');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_img` varchar(200) NOT NULL,
  `product_info` varchar(500) NOT NULL,
  `product_status` int(1) NOT NULL,
  `product_featured` int(1) NOT NULL,
  `catalog_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_img`, `product_info`, `product_status`, `product_featured`, `catalog_id`) VALUES
(1, 'Trà sữa Đào', 20000, '1662801979_peach-milk-tea.png', 'Với vị Trà hảo hạng quyện cùng Sữa tạo nên sự kết hợp hài hòa, lôi cuốn.\r\n\r\n', 1, 0, 1),
(2, 'Trà sữa Khoai môn', 20000, '1662818743_taro-milk-tea.png', 'Hương vị Khoai Môn được hòa cùng với sữa tạo nên thức uống thơm béo.', 1, 1, 1),
(3, 'Trà sữa Sô cô la', 20000, '1662810729_chocolate-milk-tea.png', 'Hương vị Chocolate đậm đà hòa tan sâu trong vị sữa hảo hạng.', 1, 1, 1),
(4, 'Trà sữa Dâu', 20000, '1662810759_strawberry-milk-tea.png', 'Hương vị dâu quen thuộc, tạo nên một vị ngọt đậm đà.\r\n\r\n', 1, 0, 1),
(5, 'Trà sữa Trà Xanh', 20000, '1662818816_green-tea-milk-tea.png', 'Trà Xanh nguyên chất được pha với sữa làm nên món trà sữa thanh mát thơm nhẹ.\r\n\r\n', 1, 0, 1),
(7, 'Trà Bí Đao', 20000, '1663730855_tra-bi-dao.png', 'Trà bí đao ngọt ngào, thanh mát, giúp giải nhiệt tốt.', 1, 1, 2),
(8, 'Trà Xanh', 20000, '1663730943_tra-xanh.png', 'Vị trà Xanh (Lục Trà) thơm nhẹ và thanh mát', 1, 0, 2),
(9, 'Trà OoLong', 20000, '1663731056_tra-oolong.png', 'Vị trà đậm và có mùi thơm Oolong đặc trưng.', 1, 0, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$gVaC1oGs.6Fp4dCTgBY/R.EuBTuyzDxanD/aiaaVEgmCsbCuOa.MC'),
(2, 'Ngô Vĩnh Hưng', 'hungb1910231@student.ctu.edu.vn', '$2y$10$8c0Ph4A4fGsMwR/5K674d.JqFdn0tINnkyggE8nXHsH32Q53BWmTy');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`,`user_id`,`bill_created_at`) USING BTREE,
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `billsdetail`
--
ALTER TABLE `billsdetail`
  ADD PRIMARY KEY (`bill_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `catalogs`
--
ALTER TABLE `catalogs`
  ADD PRIMARY KEY (`catalog_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `id_danhmuc` (`catalog_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`user_email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `catalogs`
--
ALTER TABLE `catalogs`
  MODIFY `catalog_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `billsdetail`
--
ALTER TABLE `billsdetail`
  ADD CONSTRAINT `billsdetail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `billsdetail_ibfk_2` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

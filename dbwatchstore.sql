-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 18, 2020 at 10:41 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbwatchstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `access` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `email`, `password`, `phone`, `img`, `access`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Phạm Minh Thiện', 'thien@gmail.com', '$2y$10$pk.8VeD4lqDtS2VfoipYdebOkycanB34/N/KMSFEurRiU6rbK9pl.', '123456', '1234asd', 0, 0, '2020-06-17 09:06:35', '', NULL, ''),
(2, 'Phạm Minh Thiện 2', 'thien1@gmail.com', '$2y$10$pk.8VeD4lqDtS2VfoipYdebOkycanB34/N/KMSFEurRiU6rbK9pl.', '123456', '1234asd', 0, 0, '2020-06-17 09:06:35', '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `brandproducts`
--

CREATE TABLE `brandproducts` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Tên Thương Hiệu',
  `code` varchar(255) NOT NULL COMMENT 'Mã Code Thương Hiệu',
  `slug` varchar(255) NOT NULL COMMENT 'Url thương hiệu không dấu',
  `image` varchar(255) NOT NULL COMMENT 'Hình Ảnh Thương Hiệu',
  `detail` varchar(255) NOT NULL COMMENT 'Mô tả thương hiệu',
  `metakey` varchar(255) NOT NULL COMMENT 'Keyword thương hiệu',
  `metadesc` varchar(255) NOT NULL COMMENT 'Giải thích về thương hiệu',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian tạo',
  `created_by` varchar(255) NOT NULL COMMENT 'Người tạo ra ',
  `updated_by` varchar(255) DEFAULT NULL COMMENT 'Cập Nhật Bởi Ai',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Thời Gian Cập Nhật',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Trạng Thái Của Thương Hiệu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng Thương Hiệu Của Sản Phẩm';

--
-- Dumping data for table `brandproducts`
--

INSERT INTO `brandproducts` (`id`, `name`, `code`, `slug`, `image`, `detail`, `metakey`, `metadesc`, `created_at`, `created_by`, `updated_by`, `updated_at`, `status`) VALUES
(1, 'Casio', '6952', 'Casio', 'url', 'CASIO OWNS, Ltd. là một công ty chế tạo thiết bị điện tử Nhật Bản được thành lập năm 1946, có trụ sở ở Tokyo, Nhật Bản. Casio được người ta biết tên tuổi nhiều nhất là về các loại sản phẩm như máy tính, thiết bị âm thanh, PDA, camera, đồng hồ, nhạc cụ.', 'Từ Khóa Seo', 'Từ Khóa Seo', '2020-06-18 08:42:16', '1', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categoryproducts`
--

CREATE TABLE `categoryproducts` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `metakey` varchar(255) NOT NULL,
  `metadesc` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Các loại sản phẩm trong thương hiệu';

--
-- Dumping data for table `categoryproducts`
--

INSERT INTO `categoryproducts` (`id`, `name`, `slug`, `metakey`, `metadesc`, `status`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(5, 'Thể Thao', 'the-thao', 'seo', 'seo', 1, '2020-06-18 09:13:21', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `commentproducts`
--

CREATE TABLE `commentproducts` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `id_product` int(11) UNSIGNED NOT NULL,
  `status` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `commentText` varchar(50) NOT NULL,
  `parentid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `likesCount` int(11) NOT NULL,
  `dislikeCount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='bình luận sản phẩm';

--
-- Dumping data for table `commentproducts`
--

INSERT INTO `commentproducts` (`id`, `id_user`, `id_product`, `status`, `commentText`, `parentid`, `likesCount`, `dislikeCount`, `created_at`) VALUES
(1, 14, 1, 1, 'Cảm Giác Ok', 0, 0, 0, '2020-06-18 09:17:17'),
(2, 15, 1, 1, 'Thấy Cũng Ổn Nha', 0, 0, 0, '2020-06-18 09:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) UNSIGNED NOT NULL,
  `contactText` varchar(50) NOT NULL,
  `id_admin` int(11) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Liên hệ';

-- --------------------------------------------------------

--
-- Table structure for table `gendercategoryproducts`
--

CREATE TABLE `gendercategoryproducts` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='bảng đối tượng thuộc loại sản phẩm';

--
-- Dumping data for table `gendercategoryproducts`
--

INSERT INTO `gendercategoryproducts` (`id`, `name`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, 'Nam', '2020-06-10 16:05:41', '1', '1', NULL),
(2, 'Nữ', '2020-06-12 07:15:37', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `imageproduct`
--

CREATE TABLE `imageproduct` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_products` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `attribute` varchar(255) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT '0',
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='hình của sản phẩm';

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_users` int(10) UNSIGNED DEFAULT NULL,
  `codeOder` varchar(50) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `phoneOder` varchar(50) NOT NULL,
  `exportDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TotalOrder` varchar(50) NOT NULL,
  `Payments` varchar(50) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Đặt Hàng';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_users`, `codeOder`, `fullName`, `phoneOder`, `exportDate`, `TotalOrder`, `Payments`, `status`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, 14, '15', '1212', '5212', '2020-06-18 09:38:48', '15', '1', 1, '2020-06-18 09:38:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordersproducts`
--

CREATE TABLE `ordersproducts` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_products` int(11) UNSIGNED NOT NULL,
  `id_orders` int(10) UNSIGNED NOT NULL,
  `price` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) UNSIGNED NOT NULL,
  `TotalProducts` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='chi tiết hóa đơn';

--
-- Dumping data for table `ordersproducts`
--

INSERT INTO `ordersproducts` (`id`, `id_products`, `id_orders`, `price`, `quantity`, `TotalProducts`) VALUES
(1, 1, 2, 15, 15, 30);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_topic` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `detail` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `metaDesc` varchar(50) NOT NULL,
  `metaKey` char(50) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tin tức liên quan tới tiêu đề';

-- --------------------------------------------------------

--
-- Table structure for table `productborderscolor`
--

CREATE TABLE `productborderscolor` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Màu Sắc\r\n';

--
-- Dumping data for table `productborderscolor`
--

INSERT INTO `productborderscolor` (`id`, `name`) VALUES
(1, 'Vàng'),
(2, 'Vàng Hồng'),
(3, 'Kim Loại'),
(4, 'Đen'),
(5, 'Màu Khác');

-- --------------------------------------------------------

--
-- Table structure for table `productglasses`
--

CREATE TABLE `productglasses` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Các Loại Kính Của Sản Phẩm';

--
-- Dumping data for table `productglasses`
--

INSERT INTO `productglasses` (`id`, `name`) VALUES
(1, 'Kính Cứng'),
(2, 'Kính Sapphire'),
(3, 'Khác');

-- --------------------------------------------------------

--
-- Table structure for table `productmodel`
--

CREATE TABLE `productmodel` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Máy của products';

--
-- Dumping data for table `productmodel`
--

INSERT INTO `productmodel` (`id`, `name`) VALUES
(1, 'Quartz (Pin)'),
(2, 'Năng Lượng Ánh Sáng'),
(3, 'Cơ (Automatic)'),
(4, 'Vừa Pin – Vừa Tự Động'),
(5, 'Khác');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_gendercategoryproducts` int(11) UNSIGNED DEFAULT NULL,
  `id_productmodel` int(11) UNSIGNED NOT NULL,
  `id_productssize` int(11) UNSIGNED NOT NULL,
  `id_productwaterproorf` int(11) UNSIGNED NOT NULL,
  `id_productglasses` int(11) UNSIGNED NOT NULL,
  `id_categoryproducts` int(11) UNSIGNED NOT NULL,
  `id_productboder` int(11) UNSIGNED NOT NULL,
  `id_brandproducts` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `detail` varchar(255) NOT NULL DEFAULT '',
  `metakey` varchar(255) NOT NULL DEFAULT '',
  `metadesc` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Sản Phẩm Đồng Hồ';

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_gendercategoryproducts`, `id_productmodel`, `id_productssize`, `id_productwaterproorf`, `id_productglasses`, `id_categoryproducts`, `id_productboder`, `id_brandproducts`, `name`, `code`, `slug`, `image`, `detail`, `metakey`, `metadesc`, `status`, `created_at`, `created_by`, `update_at`, `update_by`) VALUES
(1, 1, 3, 2, 4, 1, 5, 1, 1, 'Đồng hồ Nữ Casio LTP-V001SG-9BUDF', 'LTP-V001SG-9BUDF', 'dong-ho-nu-casio-LTP-V001SG-9BUDF', 'url', 'Đơn giản, tinh tế, là một phụ kiện thời trang dành cho các bạn nữ khi đi làm, đi chơi', 'seo', 'seo', 1, '2020-06-18 09:15:55', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productssize`
--

CREATE TABLE `productssize` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='size của đồng hồ';

--
-- Dumping data for table `productssize`
--

INSERT INTO `productssize` (`id`, `name`) VALUES
(1, '< 29 mm'),
(2, '30 - 34 mm'),
(3, '35 - 39 mm'),
(4, '40 - 43 mm'),
(5, '> 44 mm'),
(6, 'Khác');

-- --------------------------------------------------------

--
-- Table structure for table `productwaterproorf`
--

CREATE TABLE `productwaterproorf` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='chống nước của sản phẩm';

--
-- Dumping data for table `productwaterproorf`
--

INSERT INTO `productwaterproorf` (`id`, `name`) VALUES
(1, 'Đi Mưa Nhỏ (3 ATM)'),
(2, 'Đi Tắm (5 ATM)'),
(3, 'Đi Bơi (10 ATM) '),
(4, 'Lặn Biển (20 ATM)'),
(5, 'Không Có Chống Nước');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `metaDesc` varchar(50) DEFAULT NULL,
  `metaKey` varchar(50) DEFAULT NULL,
  `parentid` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='bảng chủ đề ';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `codeuser` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phoneuser` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `socialnetworks` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='bảng user';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `codeuser`, `email`, `phoneuser`, `remember_token`, `socialnetworks`, `password`, `name`, `gender`, `status`, `created_at`, `updated_by`, `updated_at`) VALUES
(12, NULL, 'thien3231@gmail.com', NULL, NULL, NULL, '$2y$10$/sBiZ9BBqxtEIfKtGLj/E.YzpxNgsTV7L0UIM2DjUWUJg/MuY5g9i', 'Phạm Minh Thiện', NULL, 1, '2020-06-11 10:40:05', NULL, '2020-06-11 10:40:05'),
(13, 'W1904325678', 'thien32315@gmail.com', NULL, NULL, NULL, '', 'Phạm Minh Thiện', NULL, 1, '2020-06-11 10:53:47', NULL, '2020-06-11 10:53:47'),
(14, 'W1526558535', 'thien323165@gmail.com', NULL, NULL, NULL, '$2y$10$Gy/OObfH.t4yJ1nG/jh/quZq2Llzc/RDK0X5qLkJ3PZCtfco1aO9e', 'Phạm Minh Thiện', NULL, 1, '2020-06-11 10:53:58', NULL, '2020-06-11 10:53:58'),
(15, 'W490918156', 'camtien@gmail.com', NULL, NULL, NULL, '$2y$10$KBuU5D2AXd1DR/rtNJOWdOE0YnHuf7gCEJ/GwTlK9CJtNxIj3.H36', 'Tiên Tiên', NULL, 1, '2020-06-13 00:05:48', NULL, '2020-06-13 00:05:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brandproducts`
--
ALTER TABLE `brandproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoryproducts`
--
ALTER TABLE `categoryproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commentproducts`
--
ALTER TABLE `commentproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_commentProducts_products` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin` (`id_admin`);

--
-- Indexes for table `gendercategoryproducts`
--
ALTER TABLE `gendercategoryproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imageproduct`
--
ALTER TABLE `imageproduct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_products` (`id_products`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`id_users`);

--
-- Indexes for table `ordersproducts`
--
ALTER TABLE `ordersproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_orders` (`id_orders`),
  ADD KEY `id_product` (`id_products`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_topic` (`id_topic`);

--
-- Indexes for table `productborderscolor`
--
ALTER TABLE `productborderscolor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productglasses`
--
ALTER TABLE `productglasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productmodel`
--
ALTER TABLE `productmodel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_products_categoryproducts` (`id_categoryproducts`),
  ADD KEY `FK_products_productglasses` (`id_productglasses`),
  ADD KEY `id_productwaterproorf` (`id_productwaterproorf`),
  ADD KEY `id_productmodel` (`id_productmodel`),
  ADD KEY `FK_products_productborders` (`id_productboder`),
  ADD KEY `FK_products_productssize` (`id_productssize`),
  ADD KEY `id_gender` (`id_gendercategoryproducts`),
  ADD KEY `FK_products_brandproducts` (`id_brandproducts`);

--
-- Indexes for table `productssize`
--
ALTER TABLE `productssize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productwaterproorf`
--
ALTER TABLE `productwaterproorf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_topic_admin` (`admin`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brandproducts`
--
ALTER TABLE `brandproducts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categoryproducts`
--
ALTER TABLE `categoryproducts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `commentproducts`
--
ALTER TABLE `commentproducts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gendercategoryproducts`
--
ALTER TABLE `gendercategoryproducts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `imageproduct`
--
ALTER TABLE `imageproduct`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ordersproducts`
--
ALTER TABLE `ordersproducts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productborderscolor`
--
ALTER TABLE `productborderscolor`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `productglasses`
--
ALTER TABLE `productglasses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productmodel`
--
ALTER TABLE `productmodel`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `productssize`
--
ALTER TABLE `productssize`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `productwaterproorf`
--
ALTER TABLE `productwaterproorf`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentproducts`
--
ALTER TABLE `commentproducts`
  ADD CONSTRAINT `FK_commentProducts_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`);

--
-- Constraints for table `imageproduct`
--
ALTER TABLE `imageproduct`
  ADD CONSTRAINT `id_products` FOREIGN KEY (`id_products`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `idUser` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Constraints for table `ordersproducts`
--
ALTER TABLE `ordersproducts`
  ADD CONSTRAINT `id_orders` FOREIGN KEY (`id_orders`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `id_product` FOREIGN KEY (`id_products`) REFERENCES `products` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `id_topic` FOREIGN KEY (`id_topic`) REFERENCES `topic` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products_brandproducts` FOREIGN KEY (`id_brandproducts`) REFERENCES `brandproducts` (`id`),
  ADD CONSTRAINT `FK_products_categoryproducts` FOREIGN KEY (`id_categoryproducts`) REFERENCES `categoryproducts` (`id`),
  ADD CONSTRAINT `FK_products_productborders` FOREIGN KEY (`id_productboder`) REFERENCES `productborderscolor` (`id`),
  ADD CONSTRAINT `FK_products_productglasses` FOREIGN KEY (`id_productglasses`) REFERENCES `productglasses` (`id`),
  ADD CONSTRAINT `FK_products_productssize` FOREIGN KEY (`id_productssize`) REFERENCES `productssize` (`id`),
  ADD CONSTRAINT `id_gender` FOREIGN KEY (`id_gendercategoryproducts`) REFERENCES `gendercategoryproducts` (`id`),
  ADD CONSTRAINT `id_productmodel` FOREIGN KEY (`id_productmodel`) REFERENCES `productmodel` (`id`),
  ADD CONSTRAINT `id_productwaterproorf` FOREIGN KEY (`id_productwaterproorf`) REFERENCES `productwaterproorf` (`id`);

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `FK_topic_admin` FOREIGN KEY (`admin`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

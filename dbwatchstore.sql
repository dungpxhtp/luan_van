-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2020 at 04:46 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.10

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
  `fullname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `img` varchar(50) DEFAULT NULL,
  `access` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT 'Trạng Thái Của Thương Hiệu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng Thương Hiệu Của Sản Phẩm';

-- --------------------------------------------------------

--
-- Table structure for table `categoryproducts`
--

CREATE TABLE `categoryproducts` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_categoryproducts` int(11) UNSIGNED NOT NULL,
  `id_gendercategoryproducts` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parentid` varchar(255) NOT NULL,
  `metakey` varchar(255) NOT NULL,
  `metadesc` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Các loại sản phẩm trong thương hiệu';

-- --------------------------------------------------------

--
-- Table structure for table `commentproducts`
--

CREATE TABLE `commentproducts` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_admin` int(11) UNSIGNED DEFAULT NULL,
  `id_user` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `id_product` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `commentText` int(11) DEFAULT NULL,
  `likesCount` int(11) DEFAULT NULL,
  `dislikeCount` int(11) DEFAULT NULL,
  `parentCommentProduct` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='bình luận sản phẩm';

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
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Liên hệ';

-- --------------------------------------------------------

--
-- Table structure for table `gendercategoryproducts`
--

CREATE TABLE `gendercategoryproducts` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='bảng đối tượng thuộc loại sản phẩm';

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
  `satus` varchar(255) NOT NULL
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
  `exportDate` varchar(50) NOT NULL,
  `TotalOrder` varchar(50) NOT NULL,
  `Payments` varchar(50) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Đặt Hàng';

-- --------------------------------------------------------

--
-- Table structure for table `ordersproducts`
--

CREATE TABLE `ordersproducts` (
  `id` int(11) NOT NULL,
  `id_products` int(11) UNSIGNED DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `TotalProducts` int(11) DEFAULT NULL,
  `id_orders` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='chi tiết hóa đơn';

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
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tin tức liên quan tới tiêu đề';

-- --------------------------------------------------------

--
-- Table structure for table `productborders`
--

CREATE TABLE `productborders` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Chất liệu vỏ';

-- --------------------------------------------------------

--
-- Table structure for table `productglasses`
--

CREATE TABLE `productglasses` (
  `id` int(11) UNSIGNED NOT NULL,
  `GlassesName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Các Loại Kính Của Sản Phẩm';

-- --------------------------------------------------------

--
-- Table structure for table `productmodel`
--

CREATE TABLE `productmodel` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Máy của products';

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_productmodel` int(11) UNSIGNED NOT NULL,
  `id_productwaterproorf` int(11) UNSIGNED NOT NULL,
  `id_productglasses` int(11) UNSIGNED NOT NULL,
  `id_categoryproducts` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `detail` varchar(255) NOT NULL DEFAULT '',
  `metakey` varchar(255) NOT NULL DEFAULT '',
  `metadesc` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `update_at` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Sản Phẩm Đồng Hồ';

-- --------------------------------------------------------

--
-- Table structure for table `productwaterproorf`
--

CREATE TABLE `productwaterproorf` (
  `id` int(11) UNSIGNED NOT NULL,
  `waterProorf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='chống nước của sản phẩm';

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `metaDesc` varchar(50) DEFAULT NULL,
  `metaKey` varchar(50) DEFAULT NULL,
  `parentid` varchar(50) DEFAULT NULL,
  `Status` int(4) DEFAULT NULL,
  `admin` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='bảng chủ đề ';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `codeUser` varchar(50) DEFAULT NULL,
  `phoneUser` varchar(50) DEFAULT NULL,
  `phoneCodeReset` varchar(50) DEFAULT NULL,
  `SocialNetworks` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `fullName` varchar(50) DEFAULT NULL,
  `imageUser` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='bảng user';

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_categoryproducts_brandproducts` (`id_categoryproducts`),
  ADD KEY `FK_categoryproducts_gendercategoryproducts` (`id_gendercategoryproducts`);

--
-- Indexes for table `commentproducts`
--
ALTER TABLE `commentproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_commentProducts_products` (`id_product`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_admin` (`id_admin`);

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
-- Indexes for table `productborders`
--
ALTER TABLE `productborders`
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
  ADD KEY `id_productmodel` (`id_productmodel`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brandproducts`
--
ALTER TABLE `brandproducts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categoryproducts`
--
ALTER TABLE `categoryproducts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commentproducts`
--
ALTER TABLE `commentproducts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gendercategoryproducts`
--
ALTER TABLE `gendercategoryproducts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imageproduct`
--
ALTER TABLE `imageproduct`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productborders`
--
ALTER TABLE `productborders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productglasses`
--
ALTER TABLE `productglasses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productmodel`
--
ALTER TABLE `productmodel`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productwaterproorf`
--
ALTER TABLE `productwaterproorf`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categoryproducts`
--
ALTER TABLE `categoryproducts`
  ADD CONSTRAINT `FK_categoryproducts_brandproducts` FOREIGN KEY (`id_categoryproducts`) REFERENCES `brandproducts` (`id`),
  ADD CONSTRAINT `FK_categoryproducts_gendercategoryproducts` FOREIGN KEY (`id_gendercategoryproducts`) REFERENCES `gendercategoryproducts` (`id`);

--
-- Constraints for table `commentproducts`
--
ALTER TABLE `commentproducts`
  ADD CONSTRAINT `FK_commentProducts_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `id_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`),
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
  ADD CONSTRAINT `FK_products_categoryproducts` FOREIGN KEY (`id_categoryproducts`) REFERENCES `categoryproducts` (`id`),
  ADD CONSTRAINT `FK_products_productglasses` FOREIGN KEY (`id_productglasses`) REFERENCES `productglasses` (`id`),
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

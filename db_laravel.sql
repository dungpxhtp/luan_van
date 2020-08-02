-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 12, 2019 lúc 10:09 AM
-- Phiên bản máy phục vụ: 10.1.36-MariaDB
-- Phiên bản PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_category`
--

CREATE TABLE `db_category` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parentid` int(11) UNSIGNED NOT NULL,
  `orders` int(11) UNSIGNED NOT NULL,
  `metakey` varchar(150) NOT NULL,
  `metadesc` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `db_category`
--

INSERT INTO `db_category` (`id`, `name`, `slug`, `parentid`, `orders`, `metakey`, `metadesc`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES
(1, 'Casio', 'dong-ho-casio', 0, 1, 'Cái gì gì đó seo', 'Cái gì gì đó mô tả', '2019-11-28 17:00:00', 1, '0000-00-00 00:00:00', 1, 1),
(2, 'Citizen', 'dong-ho-citizen', 0, 1, 'Cái gì gì đó seo', 'Cái gì gì đó mô tả', '2019-11-28 17:00:00', 1, '0000-00-00 00:00:00', 1, 1),
(3, 'Orient', 'dong-ho-orient', 0, 1, 'sadsadsad', 'sadsadsad', '2019-11-29 17:00:00', 1, '0000-00-00 00:00:00', 1, 1),
(4, 'Casio con ', 'dong-ho-nam', 1, 1, 'Cái gì gì đó seo', 'Cái gì gì đó mô tả', '2019-11-28 17:00:00', 0, '0000-00-00 00:00:00', 1, 1),
(5, 'Seiko', 'dong-ho-seiko', 0, 1, 'áđá', 'sadsad', '2019-11-28 17:00:00', 1, '0000-00-00 00:00:00', 1, 1),
(6, 'Tissot', 'dong-ho-tissot', 0, 1, 'sdá', 'đasad', '2019-11-28 17:00:00', 1, '0000-00-00 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_contact`
--

CREATE TABLE `db_contact` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `detail` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_menu`
--

CREATE TABLE `db_menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `tableid` int(11) DEFAULT NULL,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `orders` int(11) NOT NULL DEFAULT '0',
  `position` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `db_menu`
--

INSERT INTO `db_menu` (`id`, `name`, `type`, `link`, `tableid`, `parentid`, `orders`, `position`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES
(1, 'Trang Chủ', 'custom', 'http://localhost/websitedongho/public/', 0, 0, 0, 'mainmenu', '2019-11-12 08:38:51', 0, '0000-00-00 00:00:00', 0, 1),
(2, 'Giới Thiệu', 'page', 'page/gioi-thieu', 0, 0, 0, 'mainmenu', '2019-11-08 06:55:48', 0, '0000-00-00 00:00:00', 0, 1),
(3, 'Sản Phẩm', 'custom', 'san-pham', 0, 0, 0, 'mainmenu', '2019-11-08 06:55:52', 0, '0000-00-00 00:00:00', 0, 1),
(4, 'Tin Tức', 'post', 'bai-viet/tin-tuc', 0, 0, 0, 'mainmenu', '2019-11-06 07:44:42', 0, '0000-00-00 00:00:00', 0, 1),
(5, 'Liên Hệ', 'page', 'lien-he', 0, 0, 0, 'mainmenu', '2019-11-08 06:55:32', 0, '0000-00-00 00:00:00', 0, 1),
(6, 'Đồng Hồ Casio', 'category', 'san-pham/dong-ho-casio', 0, 3, 0, 'mainmenu', '2019-11-12 08:32:02', 0, '0000-00-00 00:00:00', 0, 1),
(7, 'Đồng Hồ Citizen', 'category', 'san-pham/dong-ho-citizen', 0, 3, 0, 'mainmenu', '2019-11-12 08:32:02', 0, '0000-00-00 00:00:00', 0, 1),
(8, 'Đồng Hồ Orient', 'category', 'san-pham/dong-ho-orient', 0, 3, 0, 'mainmenu', '2019-11-12 08:32:02', 0, '0000-00-00 00:00:00', 0, 1),
(9, 'Đồng Hồ Seiko', 'category', 'san-pham/dong-ho-seiko', 0, 3, 0, 'mainmenu', '2019-11-12 08:32:02', 0, '0000-00-00 00:00:00', 0, 1),
(10, 'Đồng Hồ Tissot', 'category', 'san-pham/dong-ho-tissot', 0, 3, 0, 'mainmenu', '2019-11-12 08:32:02', 0, '0000-00-00 00:00:00', 0, 1),
(11, 'Classic', 'category', 'san-pham/dong-ho-tissot', 0, 10, 0, 'mainmenu', '2019-11-12 09:02:19', 0, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_order`
--

CREATE TABLE `db_order` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `userid` int(11) UNSIGNED NOT NULL,
  `created_ate` date NOT NULL,
  `exportdate` date NOT NULL,
  `deliveryaddress` varchar(255) NOT NULL,
  `deliveryname` varchar(100) NOT NULL,
  `deliveryphone` varchar(255) NOT NULL,
  `deliveryemail` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_orderdetail`
--

CREATE TABLE `db_orderdetail` (
  `id` int(11) UNSIGNED NOT NULL,
  `orderid` int(11) UNSIGNED NOT NULL,
  `productid` int(11) UNSIGNED NOT NULL,
  `price` float(12,0) NOT NULL,
  `quantity` int(11) UNSIGNED NOT NULL,
  `amount` float(12,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_post`
--

CREATE TABLE `db_post` (
  `id` int(11) UNSIGNED NOT NULL,
  `topid` int(11) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `detail` longtext NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT 'post',
  `metakey` varchar(150) NOT NULL,
  `metadesc` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_product`
--

CREATE TABLE `db_product` (
  `id` int(11) UNSIGNED NOT NULL,
  `catid` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `img` varchar(100) NOT NULL,
  `detail` longtext NOT NULL,
  `number` int(11) UNSIGNED NOT NULL,
  `price` float(12,0) NOT NULL,
  `pricesale` float(12,0) NOT NULL,
  `metakey` varchar(150) NOT NULL,
  `metadesc` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `db_product`
--

INSERT INTO `db_product` (`id`, `catid`, `name`, `slug`, `img`, `detail`, `number`, `price`, `pricesale`, `metakey`, `metadesc`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES
(1, 5, 'Seiko 5 SNK371K1_2910k', 'Seiko-5-SNK371K1_2910k', 'Seiko-5-SNK371K1_2910k.png', 'Mô tả', 1, 150000, 140000, 'sđá', 'áđá', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1),
(2, 6, 'Tissot-T033.410.26.011.01_5960k', 'Tissot-T033.410.26.011.01_5960k', 'Tissot-T033-410-26-011-01_5960k.png', 'Mô tả', 1, 150000, 140000, 'ád', 'sadsd', '2019-11-19 17:00:00', 1, '0000-00-00 00:00:00', 1, 1),
(14, 1, 'Casio AE-1200WHD-1AVDF_1121K', 'Casio-AE-1200WHD-1AVDF_1121K', 'Casio-AE-1200WHD-1AVDF_1121K.png', '', 1, 150000, 140000, 'đồng hồ', 'đồng hồ này', '2019-11-29 17:00:00', 1, '0000-00-00 00:00:00', 1, 1),
(15, 2, 'CITIZEN CT-BF2009-11A', 'CITIZEN-CT-BF2009-11A', 'CITIZEN-CT-BF2009-11A.png', '', 1, 150000, 140000, 'áđá', 'áđâsd', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1),
(16, 3, 'Orient FDBAD003W0_5210k', 'Orient-FDBAD003W0_5210k', 'Orient-FDBAD003W0_5210k.png', '', 1, 150000, 140000, 'ád', 'sađá', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1),
(17, 1, 'Casio B650WC-5ADF_1587K', 'Casio-B650WC-5ADF_1587K', 'Casio-B650WC-5ADF_1587K.png', 'hghgg', 1, 150000, 140000, 'hggj', 'jhj', '2019-11-28 17:00:00', 1, '0000-00-00 00:00:00', 1, 1),
(18, 1, 'Casio B650WD-1ADF', 'Casio-B650WD-1ADF', 'Casio-B650WD-1ADF.png', '', 0, 150000, 140000, 'zxcz', 'zxcv', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_slider`
--

CREATE TABLE `db_slider` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `position` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `db_slider`
--

INSERT INTO `db_slider` (`id`, `name`, `url`, `position`, `img`, `order`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES
(1, 'slideshow', '#', 'silder', 'banner-1.png', 0, '2019-11-28 17:00:00', 1, '0000-00-00 00:00:00', 1, 1),
(2, 'slideshow', '#', 'silder', 'banner-2.png', 0, '2019-11-28 17:00:00', 1, '0000-00-00 00:00:00', 1, 1),
(3, 'slideshow', '#', 'silder', 'banner-3.png', 0, '2019-11-28 17:00:00', 1, '0000-00-00 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_topic`
--

CREATE TABLE `db_topic` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parentid` int(11) UNSIGNED NOT NULL,
  `order` int(11) UNSIGNED NOT NULL,
  `metakey` varchar(150) NOT NULL,
  `metadesc` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_user`
--

CREATE TABLE `db_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `access` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `db_category`
--
ALTER TABLE `db_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `db_contact`
--
ALTER TABLE `db_contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `db_menu`
--
ALTER TABLE `db_menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `db_order`
--
ALTER TABLE `db_order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `db_orderdetail`
--
ALTER TABLE `db_orderdetail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `db_post`
--
ALTER TABLE `db_post`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `db_product`
--
ALTER TABLE `db_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catid` (`catid`);

--
-- Chỉ mục cho bảng `db_slider`
--
ALTER TABLE `db_slider`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `db_topic`
--
ALTER TABLE `db_topic`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `db_category`
--
ALTER TABLE `db_category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `db_contact`
--
ALTER TABLE `db_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `db_menu`
--
ALTER TABLE `db_menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `db_order`
--
ALTER TABLE `db_order`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `db_orderdetail`
--
ALTER TABLE `db_orderdetail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `db_post`
--
ALTER TABLE `db_post`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `db_product`
--
ALTER TABLE `db_product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `db_slider`
--
ALTER TABLE `db_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `db_topic`
--
ALTER TABLE `db_topic`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `db_user`
--
ALTER TABLE `db_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `db_product`
--
ALTER TABLE `db_product`
  ADD CONSTRAINT `db_product_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `db_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2020 at 03:11 PM
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
(1, 'admin', 'thien@gmail.com', '$2y$10$pk.8VeD4lqDtS2VfoipYdebOkycanB34/N/KMSFEurRiU6rbK9pl.', '123456', '1234asd', 1, 1, '2020-06-17 09:06:35', '', NULL, ''),
(2, 'admin', 'thien.phamminhstu@gmail.com', '$2y$10$pk.8VeD4lqDtS2VfoipYdebOkycanB34/N/KMSFEurRiU6rbK9pl.', '123456', '1234asd', 0, 1, '2020-06-17 09:06:35', '', NULL, '');

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
  `detail` longtext NOT NULL COMMENT 'Mô tả thương hiệu',
  `metakey` varchar(255) NOT NULL COMMENT 'Keyword thương hiệu',
  `metadesc` varchar(255) NOT NULL COMMENT 'Giải thích về thương hiệu',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian tạo',
  `created_by` varchar(255) DEFAULT NULL COMMENT 'Người tạo ra ',
  `updated_by` varchar(255) DEFAULT NULL COMMENT 'Cập Nhật Bởi Ai',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Thời Gian Cập Nhật',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Trạng Thái Của Thương Hiệu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng Thương Hiệu Của Sản Phẩm';

--
-- Dumping data for table `brandproducts`
--

INSERT INTO `brandproducts` (`id`, `name`, `code`, `slug`, `image`, `detail`, `metakey`, `metadesc`, `created_at`, `created_by`, `updated_by`, `updated_at`, `status`) VALUES
(1, 'Alpina', 'ALPINA', 'alpina', 'https://watchstore.vn/storage/files/hangdongho/al_1476774643.png', '<p>C&oacute; thể n&oacute;i Alpina l&agrave; một thương hiệu c&oacute; một nửa d&ograve;ng m&aacute;u Đức v&agrave; nửa c&ograve;n lại l&agrave; Thụy Sĩ. Ng&agrave;y nay Alpina đ&atilde; thuộc quyền sở hữu của Frederique Constant v&agrave;o năm 2002 v&agrave; về tay người Nhật trong năm 2016</p>\r\n\r\n<p>Năm 1883, ng&agrave;i Gottlieb Hauser đ&atilde; th&agrave;nh lập Hiệp hội đồng hồ Thụy Sĩ (Corporation d&#39;Horlogers Suisse) v&agrave; đặt trụ sở tại&nbsp;<a href=\"https://watchbook.vn/nhung-thanh-pho-noi-tieng-ve-dong-ho-tren-the-gioi-p1-d690.html\" target=\"_blank\">Biel</a>&nbsp;v&agrave;o năm 1890. Mục đ&iacute;ch của hiệp hội n&agrave;y l&agrave; tối ưu h&oacute;a những chi ph&iacute; về sản xuất v&agrave; ph&acirc;n phối.</p>\r\n\r\n<p>Năm 1901, hiệp hội được đổi t&ecirc;n th&agrave;nh &ldquo;Union Horlog&egrave;re&rdquo; &ndash; sở hữu 3 nh&agrave; m&aacute;y sản xuất tại Geneva, Biel v&agrave; Besancon &ndash; Ph&aacute;p.</p>\r\n\r\n<p>C&aacute;i t&ecirc;n &ldquo;Alpina&rdquo; ban đầu đơn thuần l&agrave; t&ecirc;n những cỗ m&aacute;y được ph&aacute;t triển nội bộ của khối. C&ocirc;ng ty chuy&ecirc;n ph&aacute;t triển v&agrave; sản xuất những cỗ m&aacute;y th&ocirc; (Ebauche) tại nh&agrave; m&aacute;y Duret &amp; Colonnaz ở Geneva, Thụy sĩ. Thương hiệu &ldquo;Alpina&rdquo; được đăng k&iacute; v&agrave;o năm 1901.</p>\r\n\r\n<p><img alt=\"nhận diện thương hiệu đồng hồ Alpina\" src=\"https://watchstore.com/storage/photos/bai-viet/Alpina/alpina2.png\" style=\"border-style:solid; border-width:1px; float:left; height:282px; margin-left:5px; margin-right:5px; width:899px\" /></p>\r\n\r\n<h2>Th&agrave;nh vi&ecirc;n của &ldquo;Union Horlog&egrave;re&rdquo;:</h2>\r\n\r\n<p>&ldquo;Union Horlog&egrave;re&rdquo; bao gồm những nh&agrave; sản xuất v&agrave; c&ocirc;ng ty ph&acirc;n phối :</p>\r\n\r\n<ul>\r\n	<li>Straub &amp; Co.</li>\r\n	<li>Kurth Fr&egrave;res, Grenchen (sau n&agrave;y l&agrave; Certina)</li>\r\n	<li>Duret &amp; Colonnaz, Geneva (với những cỗ m&aacute;y ebauche)</li>\r\n	<li>Huguenin - Robert (Geh&auml;use)</li>\r\n	<li>Schwob Freres &amp; Co, La Chaux-de-Fonds (Cyma)</li>\r\n	<li>Robert Fr&egrave;res, Villeret (Minerva)</li>\r\n	<li>Assmann, Glash&uuml;tte từ năm 1904 cho thị trường Đức</li>\r\n</ul>\r\n\r\n<p>Từ những năm 1909-1910, chi nh&aacute;nh của Alpina xuất hiện tại&nbsp;<a href=\"https://watchbook.vn/thanh-pho-dong-ho-glashutte--noi-khai-sinh-cua-dong-ho-duc-d714.html\" target=\"_blank\">Glash&uuml;tte</a>&nbsp;với c&aacute;i t&ecirc;n &quot;Pr&auml;cisions-Uhrenfabrik Alpina&quot;. Thời k&igrave; đầu những chiếc đồng hồ được b&aacute;n tại đ&acirc;y đều sử dụng m&aacute;y Thụy sĩ. Về sau n&agrave;y những cỗ m&aacute;y Thụy sĩ dần được thay thế bời&nbsp;UROFA</p>\r\n\r\n<p>Năm 1917, Deutsche Uhrmachergenossenschaft Alpina (&quot;Hợp t&aacute;c x&atilde; Alpina tại Đức&quot;) được th&agrave;nh lập ở Eisenach do sự s&aacute;p nhập của c&aacute;c nh&agrave; sản xuất đồng hồ v&ugrave;ng Biel - Geneva v&agrave; Glash&uuml;tte. Trụ sở ch&iacute;nh được chuyển đến Berlin v&agrave;o năm 1927 .</p>\r\n\r\n<p>Năm 1938, Alpina giới thiệu đồng hồ &quot;Alpina 4&quot; với 4 &ldquo;Chống&rdquo; chủ đạo: Chống từ, chống nước, chống sốc Incabloc v&agrave; Vỏ bằng th&eacute;p kh&ocirc;ng gỉ chống ăn m&ograve;n. Chưa hết chiếc đồng hồ &ldquo;Alpina 4&rdquo; c&ograve;n sở hữu cỗ m&aacute;y l&ecirc;n d&acirc;y Alpina 592 được đ&aacute;nh gi&aacute; rất cao thời điểm đ&oacute;.</p>\r\n\r\n<p>Với những c&aacute;i tiến về kỹ thuật cũng như c&aacute;c mẫu m&atilde; mới được giới thiệu thường xuy&ecirc;n, những chiếc đồng hồ thể thao bấm giờ với chức năng Chronograph của Alpina đ&atilde; rất th&agrave;nh c&ocirc;ng trong nhiều thập kỉ.&nbsp;</p>\r\n\r\n<p><img alt=\"lịch sử thương hiệu 100 năm của Alpina\" src=\"https://watchstore.com/storage/photos/bai-viet/Alpina/alpina startimer.png\" style=\"border-style:solid; border-width:5px; float:right; height:500px; margin:0px 10px; width:990px\" /></p>\r\n\r\n<h2>Dugena</h2>\r\n\r\n<p>Trong thế chiến thứ II, Qu&acirc;n Đồng Minh đ&atilde; cấm Union Horlog&egrave;re tiếp tục b&aacute;n h&agrave;ng ở Đức với t&ecirc;n &quot;Alpina&quot;. V&igrave; vậy, năm 1942, Alpina được đổi t&ecirc;n th&agrave;nh &quot;DUGENA - German watchmaker cooperative Alpina&quot;.</p>\r\n\r\n<h2>Sự ra đời Alpina Watch International:</h2>\r\n\r\n<p>&quot;Alpina Union Horlog&egrave;re&quot; được đổi t&ecirc;n th&agrave;nh &quot;Alpina Watch International&quot; v&agrave;o năm 1972. Trong những năm 1970 v&agrave; 1980, cuộc khủng hoảng thạch anh(đồng hồ Pin &ndash; Quartz) xảy ra v&agrave; Alpina cũng chịu ảnh hưởng kh&ocirc;ng hề nhỏ. Cuối c&ugrave;ng chỉ c&oacute; một văn ph&ograve;ng b&aacute;n h&agrave;ng tại Cologne, Đức. Năm 2000 , thương hiệu n&agrave;y đ&atilde; biến mất khỏi thị trường.</p>\r\n\r\n<h2>Sự hồi sinh của Alpina tại Thụy Sĩ:</h2>\r\n\r\n<p>Sự quan t&acirc;m đến thương hiệu nổi tiếng vẫn ở Thụy Sĩ, v&agrave; đến năm 2002, Alpina đ&atilde; được mua lại bởi những người s&aacute;ng lập Frederique Constant. Chủ sở hữu của họ, cặp đ&ocirc;i Aletta v&agrave; Peter Stas , đ&atilde; thổi một luồng gi&oacute; mới khi hồi sinh thương hiệu đ&atilde; ngủ v&ugrave;i n&agrave;y.</p>\r\n\r\n<p>Năm 2003, Alpina được giới thiệu lại tại Hội chợ Basel với một h&igrave;nh ảnh ho&agrave;n to&agrave;n mới. H&igrave;nh ảnh của thương hiệu được định hướng lại với &quot;tinh thần của chủ nghĩa alpinism&quot; - những mẫu đồng hồ với thiết kế thể thao v&agrave; mạnh mẽ mang t&ecirc;n &quot;Avalanche&quot;.</p>\r\n\r\n<p>&nbsp;</p>', 'Alpina,Thụy Sĩ,Frederique Constant,Nhật', 'Có thể nói Alpina là một thương hiệu Đức và Thụy Sĩ. Ngày nay Alpina đã thuộc quyền sở hữu của Frederique Constant vào năm 2002 và về tay người Nhật trong năm 2016', '2020-06-18 08:42:16', '1', '1', '2020-07-25 08:22:38', 1);

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
(5, 'Tên mới', 'ten-moi', 'ádsad', 'seo\r\n                    ádasd', 1, '2020-06-18 09:13:21', '1', '1', '2020-06-30 05:03:30'),
(6, 'Điện Tử\r\n', 'dien-tu', 'seo', 'seo', 1, '2020-06-18 09:13:21', '1', NULL, '2020-06-30 05:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `commentproducts`
--

CREATE TABLE `commentproducts` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `id_product` int(11) UNSIGNED NOT NULL,
  `status` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `commentText` varchar(255) NOT NULL,
  `parentid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='bình luận sản phẩm';

--
-- Dumping data for table `commentproducts`
--

INSERT INTO `commentproducts` (`id`, `id_user`, `id_product`, `status`, `commentText`, `parentid`, `created_at`) VALUES
(1, 15, 8, 1, 'abc', 0, '2020-07-22 04:03:17'),
(2, 15, 8, 1, '@ Tiên Tiên : abcádasd', 1, '2020-07-22 04:03:27'),
(3, 15, 8, 1, 'abc', 0, '2020-07-22 04:03:51'),
(4, 15, 8, 1, '@ Tiên Tiên : abcádasd', 3, '2020-07-22 04:04:00'),
(5, 15, 8, 1, 'abc', 0, '2020-07-22 04:06:12'),
(6, 15, 1, 1, 'hgij', 0, '2020-07-22 10:36:37'),
(7, 15, 1, 1, '@ Tiên Tiên : Sản phẩm này có tốt không', 6, '2020-07-22 10:37:07'),
(8, 16, 1, 1, 'ok', 0, '2020-07-31 07:10:20'),
(9, 16, 1, 1, '@ Thiện : kkjkkkgjnknj', 8, '2020-07-31 07:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) UNSIGNED NOT NULL,
  `contactText` varchar(50) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `id_admin` int(11) UNSIGNED DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Liên hệ';

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `contactText`, `fullName`, `id_admin`, `email`, `phone`, `status`, `created_at`) VALUES
(1, 'Cần liên hệ abcc ádas', 'Thiện', NULL, 'thien.phamminhstu@gmail.com', '0352113737', 0, '2020-07-19 16:03:29'),
(2, 'adsádasdasdasdádasdsad', 'Đồng hồ Nữ Casio LTP-V001SG-9BUDF', NULL, 'phamminhthien30081998@gmail.com', '0352113737', 0, '2020-07-19 16:05:23'),
(3, 'ádasdasdsadsadfgfgfghgfhgfh', 'Đồng hồ Nữ Casio LTP-V001SG-9BUDF', NULL, 'thien.phamminhstu@gmail.com', '0352113737', 0, '2020-07-19 16:05:49'),
(4, 'sdasdsadsaádasdasdas', 'Đồng hồ Nữ Casio LTP-V001SG-9BUDF', NULL, 'camtien@gmail.com', '0352113737', 0, '2020-07-21 18:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `exportproducts`
--

CREATE TABLE `exportproducts` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_order` int(11) UNSIGNED DEFAULT NULL,
  `id_products` int(11) UNSIGNED DEFAULT NULL,
  `codeproducts` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `nameproducts` varchar(255) NOT NULL,
  `serinumber` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `pricecost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Xuất ';

--
-- Dumping data for table `exportproducts`
--

INSERT INTO `exportproducts` (`id`, `id_order`, `id_products`, `codeproducts`, `price`, `nameproducts`, `serinumber`, `quantity`, `pricecost`) VALUES
(26, 32, 1, 'AL-555N4H6', 15000000, 'Đồng hồ Nam Alpina Startimer Pilot Heritage AL-555N4H6', '123456', 1, 20000000),
(27, 32, 1, 'AL-555N4H6', 15000000, 'Đồng hồ Nam Alpina Startimer Pilot Heritage AL-555N4H6', '123456', 1, 20000000),
(28, 32, 1, 'AL-555N4H6', 15000000, 'Đồng hồ Nam Alpina Startimer Pilot Heritage AL-555N4H6', '1234567', 1, 20000000),
(29, 33, 1, 'AL-555N4H6', 15000000, 'Đồng hồ Nam Alpina Startimer Pilot Heritage AL-555N4H6', '12312312', 1, 20000000),
(30, 33, 1, 'AL-555N4H6', 15000000, 'Đồng hồ Nam Alpina Startimer Pilot Heritage AL-555N4H6', '12312312312', 1, 20000000),
(32, 31, 1, 'AL-555N4H6', 15000000, 'Đồng hồ Nam Alpina Startimer Pilot Heritage AL-555N4H6', '123123', 1, 20000000);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(255) NOT NULL,
  `metakey` varchar(255) DEFAULT NULL,
  `metadesc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='bảng đối tượng thuộc loại sản phẩm';

--
-- Dumping data for table `gendercategoryproducts`
--

INSERT INTO `gendercategoryproducts` (`id`, `name`, `created_at`, `created_by`, `updated_by`, `updated_at`, `status`, `slug`, `metakey`, `metadesc`) VALUES
(1, 'Nam Nữ', '2020-06-10 16:05:41', '1', '1', '2020-06-29 06:44:10', 1, 'nam-nu', 'ádasdádasd', 'sadasdádasd'),
(2, 'Nữ', '2020-06-12 07:15:37', '1', NULL, '2020-06-30 04:48:22', 1, 'nu', 'ádas', 'đá'),
(8, 'Trẻ Em', '2020-07-20 18:16:21', '1', NULL, '2020-07-20 11:16:21', 1, 'tre-em', 'Đồng Hồ Trẻ Em', 'Đồng Hồ Trẻ Em Đẹp');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_users` int(11) UNSIGNED NOT NULL,
  `id_admin` int(11) UNSIGNED DEFAULT NULL,
  `codeOder` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `phoneOder` varchar(11) NOT NULL,
  `TotalOrder` int(11) NOT NULL DEFAULT '0',
  `Address` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `Payments` tinyint(1) NOT NULL DEFAULT '1',
  `exportDate` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Đặt Hàng';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_users`, `id_admin`, `codeOder`, `fullName`, `phoneOder`, `TotalOrder`, `Address`, `notes`, `Payments`, `exportDate`, `status`, `created_at`, `updated_by`, `updated_at`) VALUES
(31, 16, 1, 'FB2661526934088970-552180273', 'Đồng hồ Nữ Casio LTP-V001SG-9BUDF', '0352113737', 15000000, 'tân an', 'ádsad', 1, '2020-08-01 11:01:31', 0, '2020-07-29 13:50:03', 'admin', '2020-08-02 06:02:37'),
(32, 16, 1, 'FB2661526934088970-1278096014', 'Phạm Minh Thiệ', '0352113737', 60000000, 'tân a', 'abcasds', 2, '2020-08-01 07:04:27', 1, '2020-07-29 13:52:27', 'admin', '2020-08-01 10:47:17'),
(33, 16, 1, 'FB2661526934088970-1817422020', 'Huỳnh Thị Bảo Ngân', '0356581777', 75000000, '5', 'lklklklklkllj', 2, '2020-08-01 07:43:24', 1, '2020-07-31 07:10:52', 'admin', '2020-08-01 10:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `ordersproducts`
--

CREATE TABLE `ordersproducts` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_products` int(11) UNSIGNED NOT NULL,
  `id_orders` int(10) UNSIGNED NOT NULL,
  `price` int(11) UNSIGNED NOT NULL,
  `pricecost` int(11) NOT NULL,
  `quantity` int(11) UNSIGNED NOT NULL,
  `TotalProducts` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='chi tiết hóa đơn';

--
-- Dumping data for table `ordersproducts`
--

INSERT INTO `ordersproducts` (`id`, `id_products`, `id_orders`, `price`, `pricecost`, `quantity`, `TotalProducts`) VALUES
(1, 1, 31, 15000000, 20000000, 1, 15000000),
(2, 1, 32, 15000000, 20000000, 4, 60000000),
(3, 1, 33, 15000000, 20000000, 5, 75000000);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_topic` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `detail` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `metaDesc` varchar(50) NOT NULL,
  `metaKey` char(50) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tin tức liên quan tới tiêu đề';

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `id_topic`, `title`, `slug`, `detail`, `image`, `metaDesc`, `metaKey`, `status`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, 1, 'Chế độ Bảo Hành', 'che-do-abc', '<p><img alt=\"\" src=\"http://watchstore.test//storage/photos/products/net-cuoi-be-gai-9-1527053440039156820618[1].jpg\" style=\"float:left; height:426px; width:640px\" /></p>\r\n\r\n<p><em><strong>Đơn giản, tinh tế, l&agrave; một phụ kiện thời trang d&agrave;nh cho c&aacute;c bạn nữ khi đi l&agrave;m, đi chơi</strong></em></p>', 'http://watchstore.test//storage/files/tintucbds/CCC-4-e1564980632958.jpg', 'ádfasfdkfjsdjskfj', 'adfasdfdkjflsdflkjlk', 1, '2020-07-14 15:54:14', '1', NULL, NULL),
(2, 1, 'Bai thu 2', 'che-do-abc', '<p><img alt=\"\" src=\"http://watchstore.test//storage/photos/products/net-cuoi-be-gai-9-1527053440039156820618[1].jpg\" style=\"float:left; height:426px; width:640px\" /></p>\r\n\r\n<p><em><strong>Đơn giản, tinh tế, l&agrave; một phụ kiện thời trang d&agrave;nh cho c&aacute;c bạn nữ khi đi l&agrave;m, đi chơi</strong></em></p>', 'http://watchstore.test//storage/files/tintucbds/CCC-4-e1564980632958.jpg', 'ádfasfdkfjsdjskfj', 'adfasdfdkjflsdflkjlk', 1, '2020-07-14 15:54:14', '1', NULL, NULL),
(3, 2, 'Bai thu 2ádasdasdasdsad', 'che-do-abcádasdasdasasd', '<p><img alt=\"\" src=\"http://watchstore.test//storage/photos/products/net-cuoi-be-gai-9-1527053440039156820618[1].jpg\" style=\"float:left; height:426px; width:640px\" /></p>\r\n\r\n<p><em><strong>Đơn giản, tinh tế, l&agrave; một phụ kiện thời trang d&agrave;nh cho c&aacute;c bạn nữ khi đi l&agrave;m, đi chơi</strong></em></p>ádasdasdsadasd', 'http://watchstore.test//storage/files/tintucbds/CCC-4-e1564980632958.jpg', 'ádfasfdkfjsdjskfj', 'adfasdfdkjflsdflkjlk', 1, '2020-07-14 15:54:14', '1', NULL, NULL),
(4, 2, 'Bai thu 2ádasdasdasdsad', 'che-do-abcádasdasdasasdádasdasd', '<p><img alt=\"\" src=\"http://watchstore.test//storage/photos/products/net-cuoi-be-gai-9-1527053440039156820618[1].jpg\" style=\"float:left; height:426px; width:640px\" /></p>\r\n\r\n<p><em><strong>Đơn giản, tinh tế, l&agrave; một phụ kiện thời trang d&agrave;nh cho c&aacute;c bạn nữ khi đi l&agrave;m, đi chơi</strong></em></p>ádasdasdsadasd', 'http://watchstore.test//storage/files/tintucbds/CCC-4-e1564980632958.jpg', 'ádfasfdkfjsdjskfj', 'adfasdfdkjflsdflkjlk', 1, '2020-07-14 15:54:14', '1', NULL, NULL);

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
  `serinumber` tinyint(1) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL,
  `metakey` varchar(255) NOT NULL DEFAULT '',
  `metadesc` varchar(255) NOT NULL DEFAULT '',
  `price` int(11) NOT NULL,
  `pricesale` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Sản Phẩm Đồng Hồ';

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_gendercategoryproducts`, `id_productmodel`, `id_productssize`, `id_productwaterproorf`, `id_productglasses`, `id_categoryproducts`, `id_productboder`, `id_brandproducts`, `name`, `code`, `slug`, `serinumber`, `image`, `detail`, `metakey`, `metadesc`, `price`, `pricesale`, `quantity`, `status`, `created_at`, `created_by`, `update_at`, `update_by`) VALUES
(1, 1, 3, 2, 4, 1, 6, 1, 1, 'Đồng hồ Nam Alpina Startimer Pilot Heritage AL-555N4H6', 'AL-555N4H6', 'dong-ho-nam-alpina-startimer-pilot-heritage-al-555n4h6', 1, 'https://watchstore.vn/storage/files/hangdongho/alpina/anh-san-pham.png', '<p><img alt=\"\" src=\"https://watchstore.vn/storage/photos/bai-viet/Alpina/alpina startimer.png\" style=\"height:500px; width:990px\" /></p>\r\n\r\n<pre>\r\n<em>Đơn giản, tinh tế, l&agrave; một phụ kiện thời trang d&agrave;nh cho c&aacute;c bạn nữ khi đi l&agrave;m, đi chơi</em></pre>', 'Đồng hồ Nam Alpina Startimer Pilot Heritage AL-555N4H6', 'Đồng hồ Nam Alpina Startimer Pilot Heritage AL-555N4H6,Cửa hàng Galle Watch chuyên buôn bán các loại đồng hồ đeo tay chính hãng, hàng hiệu được nhập khẩu từ các thương...', 20000000, 15000000, 7, 1, '2020-06-18 09:15:55', NULL, '2020-07-29 15:17:09', '1'),
(8, 2, 3, 3, 5, 1, 5, 1, 1, 'Đồng hồ Nam Alpina Startimer Pilot Manufacture Worldtimer AL-718B4S6', 'AL-718B4S6', 'dong-ho-nam-alpina-startimer-pilot-manufacture-worldtimer-al-718b4s6', 0, 'https://watchstore.vn/storage/files/hangdongho/alpina/anh-san-pham.png', '<p><img alt=\"\" src=\"https://watchstore.vn/storage/photos/bai-viet/Alpina/alpina startimer-3.png\" style=\"height:500px; width:990px\" /></p>\r\n\r\n<h2><strong>Đồng hồ Alpina nổi tiếng v&igrave;&hellip;</strong></h2>\r\n\r\n<h3>Ti&ecirc;u chuẩn chất lượng khắt khe</h3>\r\n\r\n<p><em>Th&agrave;nh c&ocirc;ng của Alpina trong suốt hơn 100 năm qua ch&iacute;nh l&agrave; sự khắt khe của c&aacute;c nh&agrave; sản xuất trong qu&aacute; tr&igrave;nh l&agrave;m việc v&agrave; kiểm định. Đồng hồ đạt chuẩn phải l&agrave; đồng hồ duy tr&igrave; được t&iacute;nh ch&iacute;nh x&aacute;c cao v&agrave; c&oacute; khả năng chống va đập tối ưu. Ngo&agrave;i ra, hầu hết đồng hồ phi c&ocirc;ng mang thương hiệu Alpina c&ograve;n được trang bị vỏ kh&aacute;ng từ v&agrave; c&aacute;c số lớn phủ dạ quang để đảm bảo người d&ugrave;ng c&oacute; thể đọc giờ ngay lập tức.</em></p>\r\n\r\n<p>&nbsp;</p>', 'Alpina,Thụy Sĩ,Frederique Constant,Nhật', 'Đồng hồ Nam Alpina Startimer Pilot Manufacture Worldtimer AL-718B4S6,Cửa hàng Galle Watch chuyên buôn bán các loại đồng hồ đeo tay chính hãng, hàng hiệu được nhập khẩu từ...', 13213123, NULL, 31, 1, '2020-06-18 12:43:56', NULL, '2020-08-03 15:09:55', '1');

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
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `metadesc` varchar(255) DEFAULT NULL,
  `metakey` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='bảng chủ đề ';

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `admin`, `name`, `slug`, `metadesc`, `metakey`, `status`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, 1, 'Chế đô bảo hành', 'che-do-bao-hanh', 'Seo abc', 'Seo abc', 1, '2020-07-14 15:12:09', '1', NULL, NULL),
(2, 1, 'Website', 'website', 'Seo abc', 'Seo abc', 1, '2020-07-14 15:12:09', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `codeuser` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phoneuser` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `socialnetworks` varchar(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='bảng user';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `codeuser`, `email`, `phoneuser`, `provider_id`, `socialnetworks`, `password`, `name`, `status`, `created_at`, `updated_by`, `updated_at`) VALUES
(12, NULL, 'thien.phamminhstu3@gmail.com', '0356581777', NULL, '0', '$2y$10$Zj65H5dGX0nFijYqQiKfT.mtZGOZ81lR886Kd5WxwO4/aqihYKGim', 'Phạm Minh Thiện', 0, '2020-06-11 10:40:05', NULL, '2020-07-24 06:46:36'),
(13, 'W1904325678', 'thien32315@gmail.com', '03522113737', NULL, '0', '$2y$10$aE3OnsddoZ2aa1I603vuvubeD9BflWs1V/BLAIzMQg0WSCjICdEDu', 'Phạm Minh Thiện', 1, '2020-06-11 10:53:47', NULL, '2020-07-24 07:38:13'),
(14, 'W1526558535', 'thien.phamminhstu1@gmail.com', '0352113737', NULL, '0', '$2y$10$kJbXPvZP02aNSdBSeZbSDesnrAmSQYJTKU06Fr5x9hJrLIQ2zccz2', 'Phạm Minh Thiện', 1, '2020-06-11 10:53:58', NULL, '2020-07-26 20:54:32'),
(15, 'W490918156', 'camtien@gmail.com', NULL, NULL, '0', '$2y$10$aE3OnsddoZ2aa1I603vuvubeD9BflWs1V/BLAIzMQg0WSCjICdEDu', 'Tiên Tiên', 1, '2020-06-13 00:05:48', NULL, '2020-07-24 07:38:44'),
(16, 'FB2661526934088970', 'thien.phamminhstu1@gmail.com', '0352113737', '2661526934088970', '1', NULL, 'Thiện', 1, '2020-07-20 05:48:32', NULL, '2020-07-25 01:28:53'),
(18, 'GG100615423323694547827', 'thien.phamminhstu@gmail.com', NULL, '100615423323694547827', '2', NULL, 'Thiện Phạm', 1, '2020-07-20 16:40:15', NULL, '2020-07-20 09:40:15'),
(19, 'W1200481945', 'thien@gmail.com', '0356581777', NULL, NULL, '$2y$10$HtM6dCdeqIKB5SjChf83bO9eq0NxH27I5iP80Qo4TEOdX8K.0xeZu', 'Nguyễn Anh Nghĩa', 1, '2020-07-26 23:27:48', NULL, '2020-07-26 23:27:48'),
(20, 'GG104343005058082032837', 'dh51600138@student.stu.edu.vn', NULL, '104343005058082032837', 'Google', NULL, 'Thien Pham Minh', 1, '2020-07-29 12:09:31', NULL, '2020-07-29 05:09:31');

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
-- Indexes for table `exportproducts`
--
ALTER TABLE `exportproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_exportproducts_orders` (`id_order`),
  ADD KEY `FK_exportproducts_products` (`id_products`);

--
-- Indexes for table `gendercategoryproducts`
--
ALTER TABLE `gendercategoryproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`id_users`),
  ADD KEY `FK_orders_admin` (`id_admin`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `commentproducts`
--
ALTER TABLE `commentproducts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exportproducts`
--
ALTER TABLE `exportproducts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `gendercategoryproducts`
--
ALTER TABLE `gendercategoryproducts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ordersproducts`
--
ALTER TABLE `ordersproducts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- Constraints for table `exportproducts`
--
ALTER TABLE `exportproducts`
  ADD CONSTRAINT `FK_exportproducts_orders` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `FK_exportproducts_products` FOREIGN KEY (`id_products`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`),
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

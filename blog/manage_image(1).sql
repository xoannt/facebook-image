-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2014 at 12:25 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `manage_image`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_image`
--

CREATE TABLE IF NOT EXISTS `tbl_image` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `link_image` varchar(255) NOT NULL,
  `facebook_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=228 ;

--
-- Dumping data for table `tbl_image`
--

INSERT INTO `tbl_image` (`id`, `link_image`, `facebook_id`) VALUES
(214, 'https://fbcdn-sphotos-a-a.akamaihd.net/hphotos-ak-xap1/t1.0-9/10351460_1468086310104542_1572515998204587594_n.jpg', '1465661510347022'),
(215, 'https://fbcdn-sphotos-e-a.akamaihd.net/hphotos-ak-xaf1/t1.0-9/10411930_1464316277148212_947334237956895444_n.jpg', '1465661510347022'),
(216, 'https://fbcdn-sphotos-d-a.akamaihd.net/hphotos-ak-xpa1/t1.0-9/s720x720/10452334_1460072120905961_3789951892080497986_n.jpg', '1465661510347022'),
(217, 'https://fbcdn-sphotos-f-a.akamaihd.net/hphotos-ak-xap1/t1.0-9/s720x720/10247269_1441089089470931_5830431004195929661_n.jpg', '1465661510347022'),
(218, 'https://scontent-b.xx.fbcdn.net/hphotos-xfp1/t31.0-8/q79/s720x720/1898704_1436540743259099_2097001420_o.jpg', '1465661510347022'),
(219, 'https://fbcdn-sphotos-b-a.akamaihd.net/hphotos-ak-xfp1/t1.0-9/q73/s720x720/1505430_1432220680357772_392713325_n.jpg', '1465661510347022'),
(220, 'https://fbcdn-sphotos-f-a.akamaihd.net/hphotos-ak-xpf1/t1.0-9/1911832_1423526927893814_211226137_n.jpg', '1465661510347022'),
(221, 'https://fbcdn-sphotos-d-a.akamaihd.net/hphotos-ak-xpf1/t1.0-9/1795780_1419494278297079_1495873332_n.jpg', '1465661510347022'),
(222, 'https://fbcdn-sphotos-e-a.akamaihd.net/hphotos-ak-frc3/v/t1.0-9/1016340_1410863765826797_2029066069_n.jpg?oh=0b7228923ee85aa1e65c877ca9d56029&oe=5416FE7A&__gda__=1411439159_0be374f7aed7a5b4231665de5419752b', '1465661510347022'),
(223, 'https://fbcdn-sphotos-c-a.akamaihd.net/hphotos-ak-xpa1/t31.0-8/q72/s720x720/1523406_1406363246276849_1325252762_o.jpg', '1465661510347022'),
(224, 'https://fbcdn-sphotos-b-a.akamaihd.net/hphotos-ak-frc3/t1.0-9/p180x540/554716_1382599718653202_1621374148_n.jpg', '1465661510347022'),
(225, 'https://fbcdn-sphotos-a-a.akamaihd.net/hphotos-ak-xaf1/t1.0-9/1470061_1381331482113359_147792954_n.jpg', '1465661510347022'),
(226, 'https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-xpa1/t1.0-9/1451466_1381307242115783_2090597676_n.jpg', '1465661510347022'),
(227, 'https://scontent-a.xx.fbcdn.net/hphotos-frc3/t1.0-9/1454937_1381295582116949_1007951184_n.jpg', '1465661510347022');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE IF NOT EXISTS `tbl_review` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `image_id` int(10) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `rating` int(10) NOT NULL,
  `date_rating` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`id`, `image_id`, `user_id`, `rating`, `date_rating`) VALUES
(53, 216, '334332923384647', 4, '2014-06-25'),
(54, 215, '334332923384647', 5, '2014-06-25'),
(55, 225, '334332923384647', 5, '2014-06-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `access_token` text NOT NULL,
  `facebook_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `facebook_id` varchar(255) NOT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `access_token`, `facebook_name`, `facebook_id`, `facebook_link`, `avatar`) VALUES
(31, 'CAAIYZBj0zNy4BAHkeplQcjiBMTry0yACRolzxSAHU77yKdc99lmUTW2ej60fATtKsG6VsZBU6ZAKe5kZBRWBnSNZBNI4AklRzPfMILhmZBRvZCaON4bUw5Hf13E8Uhn8OCKfnezxw5JtYANASqah5S7JjkSrQDfVsZCHLUPeMtTUe2t3p0F48DZCZAU4uagSuwldQZD', 'Yêu Việt Nam', '1465661510347022', 'https://www.facebook.com/app_scoped_user_id/1465661510347022/', 'https://graph.facebook.com/1465661510347022/picture'),
(32, 'CAAIYZBj0zNy4BAMGynHuzSFYi9X4O3tPJbMVhq1WXAZBwZANNjzWCOi3w5MIsnIHwqFtQITrnBU82rCwkAutLDym05F7a9ALYnczNxqK1ZBjR3Ck7hy2u7JaKpClBHkx3iQnoyzm4LPEzn8Nhvbbwwc4OYCzebP2s0hMNVGjiM0h0FUE7T2kvI3CaTqJcqYZD', 'Thanh Xoan', '334332923384647', 'https://www.facebook.com/app_scoped_user_id/334332923384647/', 'https://graph.facebook.com/334332923384647/picture');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

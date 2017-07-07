-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 建立日期: 2017 年 07 月 02 日 22:51
-- 伺服器版本: 5.5.49-0ubuntu0.14.04.1
-- PHP 版本: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `a0118`
--

-- --------------------------------------------------------

--
-- 資料表結構 `category_main`
--

CREATE TABLE IF NOT EXISTS `category_main` (
  `id` varchar(25) NOT NULL COMMENT '分類編號',
  `type` varchar(50) NOT NULL COMMENT '分類名稱',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品分類';

--
-- 資料表的匯出資料 `category_main`
--

INSERT INTO `category_main` (`id`, `type`) VALUES
('5947c4ca9356d', '乾燥花'),
('5947c4d056337', '新娘捧花'),
('5947c4d6baebe', '開幕盆栽'),
('5947c50bcf8a4', '花藝設計'),
('5947c5109cfe1', '胸花'),
('5947c519daca7', '金莎花束'),
('5947c52101b57', '禮物盒'),
('5947c52986cc5', '會場佈置'),
('5947c532daaca', '精緻花束'),
('5947c53c0f530', ' 特別Kuso');

-- --------------------------------------------------------

--
-- 資料表結構 `contact_main`
--

CREATE TABLE IF NOT EXISTS `contact_main` (
  `id` varchar(25) NOT NULL COMMENT '聯絡編號',
  `name` varchar(100) NOT NULL COMMENT '聯絡姓名',
  `email` varchar(100) NOT NULL COMMENT '聯絡信箱',
  `phone` varchar(100) NOT NULL COMMENT '聯絡手機',
  `message` longtext NOT NULL COMMENT '聯絡訊息',
  `create_date` date NOT NULL COMMENT '創建日期',
  `create_time` time NOT NULL COMMENT '創建時間',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聯絡我們';

--
-- 資料表的匯出資料 `contact_main`
--

INSERT INTO `contact_main` (`id`, `name`, `email`, `phone`, `message`, `create_date`, `create_time`) VALUES
('5949203253e69', 'Lavit', 'lb01640000@gmail.com', '0912345678', '可以幫我查詢一下出貨進度嗎 ~', '2017-06-20', '00:00:21'),
('5949204f7a23a', '維陽', 'S0461016@ncue.com', '0912345678', '拜託別當我資料庫 TAT', '2017-06-20', '00:00:21');

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `Hot`
--
CREATE TABLE IF NOT EXISTS `Hot` (
`Product_name` varchar(50)
,`count(*)` bigint(21)
);
-- --------------------------------------------------------

--
-- 資料表結構 `manager_logger`
--

CREATE TABLE IF NOT EXISTS `manager_logger` (
  `id` varchar(25) NOT NULL COMMENT '紀錄編號',
  `user_id` varchar(25) NOT NULL COMMENT '用戶編號',
  `user_ip` varchar(50) NOT NULL COMMENT '紀錄IP',
  `user_agent` varchar(200) DEFAULT NULL COMMENT '紀錄媒介',
  `type` varchar(100) DEFAULT NULL COMMENT '紀錄種類',
  `action` varchar(500) DEFAULT NULL COMMENT '紀錄行為',
  `create_date` date NOT NULL COMMENT '紀錄日期',
  `create_time` time NOT NULL COMMENT '紀錄時間',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理日誌';

-- --------------------------------------------------------

--
-- 資料表結構 `manager_main`
--

CREATE TABLE IF NOT EXISTS `manager_main` (
  `id` varchar(25) NOT NULL COMMENT '管理編號',
  `email` varchar(100) NOT NULL COMMENT '管理信箱',
  `phone` varchar(100) NOT NULL COMMENT '管理手機',
  `password` varchar(100) NOT NULL COMMENT '管理密碼',
  `nickname` varchar(50) NOT NULL COMMENT '管理名稱',
  `create_date` date NOT NULL COMMENT '創建日期',
  `create_time` time NOT NULL COMMENT '創建時間',
  `last_date` date DEFAULT NULL COMMENT '最後登入日期',
  `last_time` time DEFAULT NULL COMMENT '最後登入時間',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理員管理';

--
-- 資料表的匯出資料 `manager_main`
--

INSERT INTO `manager_main` (`id`, `email`, `phone`, `password`, `nickname`, `create_date`, `create_time`, `last_date`, `last_time`) VALUES
('592fd175c6df5', 'lb01640000@gmail.com', '0982772589', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Lavit', '2017-06-01', '16:33:57', '2017-06-21', '10:50:41'),
('593e8809dc055', 'User', '', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'User', '2017-06-12', '00:00:20', '2017-07-02', '20:18:04'),
('5947ebe5f1c39', 'pig', '', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Cute Piggy', '2017-06-19', '00:00:23', '2017-06-20', '14:13:27');

-- --------------------------------------------------------

--
-- 資料表結構 `news_main`
--

CREATE TABLE IF NOT EXISTS `news_main` (
  `id` varchar(25) CHARACTER SET utf8 NOT NULL COMMENT '消息編號',
  `title` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '消息標題',
  `image` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT 'assets/img/default.png' COMMENT '消息圖片',
  `description` longtext CHARACTER SET utf8 COMMENT '消息內容',
  `create_date` date NOT NULL COMMENT '創建日期',
  `create_time` time NOT NULL COMMENT '創建時間',
  `release_date` date NOT NULL COMMENT '發布日期',
  `release_time` time NOT NULL COMMENT '發布時間',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='最新消息';

--
-- 資料表的匯出資料 `news_main`
--

INSERT INTO `news_main` (`id`, `title`, `image`, `description`, `create_date`, `create_time`, `release_date`, `release_time`) VALUES
('59590453ebba2', 'Hi', 'assets/img/default.png', 'Hello', '2017-07-02', '22:33:55', '2017-07-02', '22:35:00');

-- --------------------------------------------------------

--
-- 資料表結構 `order_main`
--

CREATE TABLE IF NOT EXISTS `order_main` (
  `id` varchar(25) NOT NULL COMMENT '訂單編號',
  `buy_id` varchar(25) NOT NULL COMMENT '買家編號',
  `buy_name` varchar(50) NOT NULL COMMENT '買家姓名',
  `buy_email` varchar(100) NOT NULL COMMENT '買家信箱',
  `buy_phone` varchar(30) NOT NULL COMMENT '買家手機',
  `buy_addr` varchar(200) NOT NULL COMMENT '買家地址',
  `buy_remark` longtext COMMENT '買家備註',
  `payment` int(2) NOT NULL DEFAULT '0' COMMENT '付款方式',
  `remark` longtext NOT NULL COMMENT '訂單備註',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '訂單狀態',
  `create_date` date NOT NULL COMMENT '建立日期',
  `create_time` time NOT NULL COMMENT '建立時間',
  `update_date` date DEFAULT NULL COMMENT '更新日期',
  `update_time` time DEFAULT NULL COMMENT '更新時間',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='主要訂單';

--
-- 資料表的匯出資料 `order_main`
--

INSERT INTO `order_main` (`id`, `buy_id`, `buy_name`, `buy_email`, `buy_phone`, `buy_addr`, `buy_remark`, `payment`, `remark`, `status`, `create_date`, `create_time`, `update_date`, `update_time`) VALUES
('594917a96df34', '594913f1e977', '小梅', 'Hayao01@Hayao.com', '0912345678', '龍貓路一號', '我要可愛一點的喔 ~', 0, '', 3, '2017-06-20', '00:00:20', NULL, NULL),
('59491805c218d', '594913f1e9773', '小梅	', 'Hayao01@Hayao.com', '0912345678', '龍貓路一號', '上次的不夠可愛 我要再可愛一點 ~', 0, '', 0, '2017-06-20', '00:00:20', NULL, NULL),
('5949185144dfb', '59491405039ab', '小月', 'Hayao02@Hayao.com', '0912345678', '龍貓路二號', '花兒真漂亮 ~', 0, '', 2, '2017-06-20', '00:00:20', NULL, NULL),
('594919e84144a', '5949147d8af35', '王蟲', 'Hayao07@Hayao.com', '0912345678', '風谷路二號', '我要把所有的胸花都吃掉 ~', 0, '', 0, '2017-06-20', '00:00:20', NULL, NULL),
('59491a73859ce', '5949144d4c040', '湯婆婆', 'Hayao05@Hayao.com', '0912345678', '神隱路一號', '幫我挑上好的', 0, '', 0, '2017-06-20', '00:00:20', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `order_sub`
--

CREATE TABLE IF NOT EXISTS `order_sub` (
  `id` varchar(25) NOT NULL COMMENT '副單編號',
  `order_id` varchar(25) NOT NULL COMMENT '訂單編號',
  `product_id` varchar(25) NOT NULL COMMENT '商品編號',
  `product_name` varchar(50) NOT NULL COMMENT '商品名稱',
  `product_price` int(11) NOT NULL COMMENT '商品價格',
  `product_qty` int(11) NOT NULL COMMENT '商品數量',
  `product_photo` varchar(100) NOT NULL COMMENT '商品照片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='訂單商品';

--
-- 資料表的匯出資料 `order_sub`
--

INSERT INTO `order_sub` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `product_qty`, `product_photo`) VALUES
('1', '594917a96df34', '5947c543c2765', '滿天星自然梗捧花', 499, 6, 'http://www.花譜花店.tw/include/product/127/127_1454492974.jpg'),
('2', '59491805c218d', '5947c60a23d0a', '桌上型盆栽', 799, 8, 'http://www.花譜花店.tw/include/product/127/127_1398259744.jpg'),
('3', '5949185144dfb', '5947c50bcf8a4', '高架花籃', 699, 5, 'http://www.花譜花店.tw/include/product/127/127_1398770695.jpg'),
('4', '5949185144dfb', '5947c52101b57', 'Hello Kitty女僕金莎花盒', 799, 2, 'http://www.花譜花店.tw/include/product/127/127_1392122441.jpg'),
('5', '5949185144dfb', '5947c532daaca', '辰之星99朵粉玫瑰花束', 499, 2, 'http://www.花譜花店.tw/include/product/127/127_1456047780.jpg'),
('6', '594919e84144a', '5947c4ca9356d', '玫瑰胸花', 59, 20, 'http://www.花譜花店.tw/include/product/127/127_1384841306.jpg'),
('7', '59491a73859ce', '5947c543c2765', '滿天星自然梗捧花', 499, 7, 'http://www.花譜花店.tw/include/product/127/127_1454492974.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `product_img`
--

CREATE TABLE IF NOT EXISTS `product_img` (
  `id` varchar(25) NOT NULL COMMENT '圖片編號',
  `product_id` varchar(25) NOT NULL COMMENT '商品編號',
  `product_image` varchar(100) NOT NULL COMMENT '商品圖片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品圖片';

--
-- 資料表的匯出資料 `product_img`
--

INSERT INTO `product_img` (`id`, `product_id`, `product_image`) VALUES
('1', '59491596a1d31', 'http://www.花譜花店.tw/include/product/127/127_1392115669.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `product_main`
--

CREATE TABLE IF NOT EXISTS `product_main` (
  `id` varchar(25) NOT NULL COMMENT '商品編號',
  `title` varchar(50) NOT NULL COMMENT '商品名稱',
  `sub_title` varchar(50) DEFAULT NULL COMMENT '商品副標',
  `category` varchar(25) NOT NULL DEFAULT '0' COMMENT '商品分類',
  `main_photo` varchar(100) DEFAULT 'assets/img/default.png' COMMENT '商品主圖',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '商品原價',
  `cost` int(11) NOT NULL DEFAULT '0' COMMENT '商品成本',
  `reserve` int(11) NOT NULL DEFAULT '0' COMMENT '商品庫存',
  `content` longtext COMMENT '商品內容',
  `online` int(1) NOT NULL DEFAULT '0' COMMENT '商品狀態',
  `feature` int(1) NOT NULL DEFAULT '0' COMMENT '精選商品',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='主要商品';

--
-- 資料表的匯出資料 `product_main`
--

INSERT INTO `product_main` (`id`, `title`, `sub_title`, `category`, `main_photo`, `price`, `cost`, `reserve`, `content`, `online`, `feature`) VALUES
('5947c543c2765', '滿天星自然梗捧花', '', '5947c4d056337', 'http://www.花譜花店.tw/include/product/127/127_1454492974.jpg', 500, 499, 5, '\r\n									\r\n									\r\n									<img src="http://www.花譜花店.tw/include/product/127/127_1454492978.jpg" alt="">\r\n																																									', 1, 1),
('5947c60a23d0a', '桌上型盆栽', '開運', '5947c4d6baebe', 'http://www.花譜花店.tw/include/product/127/127_1398259744.jpg', 800, 799, 11, '\r\n									\r\n									\r\n									<img src="http://www.花譜花店.tw/include/product/127/127_1398259720.jpg" alt="">\r\n																																									', 1, 1),
('594914f0211c8', '高架花籃', '', '5947c50bcf8a4', 'http://www.花譜花店.tw/include/product/127/127_1398770695.jpg', 800, 699, 20, '\r\n									\r\n									<p><img src="http://www.花譜花店.tw/include/product/127/127_1398770703.jpg" alt=""></p>																', 1, 1),
('59491560e5748', '玫瑰胸花', '玫瑰', '5947c4ca9356d', 'http://www.花譜花店.tw/include/product/127/127_1384841306.jpg', 100, 59, 11, '<img src="http://www.花譜花店.tw/include/product/127/127_1384841306.jpg" alt="">\r\n																	', 1, 1),
('59491596a1d31', '浪漫圓式金莎', '浪漫圓式金莎花束', '5947c519daca7', 'http://www.花譜花店.tw/include/product/127/127_1392115665.jpg', 700, 499, 5, '\r\n									\r\n									\r\n									<p>浪漫圓式金莎花束</p>																								', 1, 1),
('59491665ca65f', 'Hello Kitty女僕金莎花盒', '', '5947c52101b57', 'http://www.花譜花店.tw/include/product/127/127_1392122441.jpg', 900, 799, 3, '\r\n									<img src="http://www.花譜花店.tw/include/product/127/127_1392122441.jpg" alt="">\r\n																									', 0, 0),
('594916d0baf9a', '辰之星99朵粉玫瑰花束', '求婚101花束', '5947c532daaca', 'http://www.花譜花店.tw/include/product/127/127_1456047780.jpg', 700, 499, 4, '\r\n									<p><img src="http://www.花譜花店.tw/include/product/127/127_1456047775.jpg" alt=""></p>								', 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `user_logger`
--

CREATE TABLE IF NOT EXISTS `user_logger` (
  `id` varchar(25) NOT NULL COMMENT '紀錄編號',
  `user_id` varchar(25) NOT NULL COMMENT '用戶編號',
  `user_ip` varchar(50) NOT NULL COMMENT '紀錄IP',
  `user_agent` varchar(200) DEFAULT NULL COMMENT '紀錄媒介',
  `type` varchar(100) DEFAULT NULL COMMENT '紀錄種類',
  `action` varchar(500) DEFAULT NULL COMMENT '紀錄行為',
  `create_date` date NOT NULL,
  `create_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用戶日誌';

-- --------------------------------------------------------

--
-- 資料表結構 `user_main`
--

CREATE TABLE IF NOT EXISTS `user_main` (
  `id` varchar(25) NOT NULL COMMENT '用戶編號',
  `email` varchar(100) NOT NULL COMMENT '用戶信箱',
  `phone` varchar(100) DEFAULT NULL COMMENT '用戶手機',
  `password` int(100) NOT NULL COMMENT '用戶密碼',
  `nickname` varchar(50) NOT NULL COMMENT '用戶名稱',
  `address` varchar(100) DEFAULT NULL COMMENT '用戶地址',
  `create_date` date NOT NULL COMMENT '創建日期',
  `create_time` time NOT NULL COMMENT '創建時間',
  `update_date` date DEFAULT NULL COMMENT '更新日期',
  `update_time` time DEFAULT NULL COMMENT '更新時間',
  `last_date` date DEFAULT NULL COMMENT '最後登入日期',
  `last_time` time DEFAULT NULL COMMENT '最後登入時間',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用戶管理';

--
-- 資料表的匯出資料 `user_main`
--

INSERT INTO `user_main` (`id`, `email`, `phone`, `password`, `nickname`, `address`, `create_date`, `create_time`, `update_date`, `update_time`, `last_date`, `last_time`) VALUES
('594913f1e9773', 'Hayao01@Hayao.com', '', 7110, '小梅', '龍貓路一號', '2017-06-20', '00:00:20', NULL, NULL, NULL, NULL),
('59491405039ab', 'Hayao02@Hayao.com', '', 7110, '小月', '龍貓路二號', '2017-06-20', '00:00:20', NULL, NULL, NULL, NULL),
('594914255984c', 'Hayao03@Hayao.com', '', 0, '千尋', '神隱路一號', '2017-06-20', '00:00:20', NULL, NULL, NULL, NULL),
('5949143d3e424', 'Hayao04@Hayao.com', '', 7110, '白龍', '神隱路二號', '2017-06-20', '00:00:20', NULL, NULL, NULL, NULL),
('5949144d4c040', 'Hayao05@Hayao.com', '', 7110, '湯婆婆', '神隱路一號', '2017-06-20', '00:00:20', NULL, NULL, NULL, NULL),
('5949146741bf1', 'Hayao06@Hayao.com', '', 7110, '娜烏西卡', '風谷路一號', '2017-06-20', '00:00:20', NULL, NULL, NULL, NULL),
('5949147d8af35', 'Hayao07@Hayao.com', '', 7110, '王蟲', '風谷路二號', '2017-06-20', '00:00:20', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 檢視表結構 `Hot`
--
DROP TABLE IF EXISTS `Hot`;

CREATE ALGORITHM=UNDEFINED DEFINER=`a0118`@`localhost` SQL SECURITY DEFINER VIEW `Hot` AS select `order_sub`.`product_name` AS `Product_name`,count(0) AS `count(*)` from `order_sub` group by `order_sub`.`product_name` order by count(0) desc;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

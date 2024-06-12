-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2024 at 04:26 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `urban_print`
--

-- --------------------------------------------------------

--
-- Table structure for table `image_carousel`
--

CREATE TABLE `image_carousel` (
  `id` int NOT NULL,
  `img_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image_carousel`
--

INSERT INTO `image_carousel` (`id`, `img_name`, `time_stamp`, `user_id`) VALUES
(43, 'slide1png1718158522.png', '2024-06-12 02:15:22', 1),
(44, 'slide2png1718158522.png', '2024-06-12 02:15:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `featured_img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sample_img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `date_entry` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `featured_img`, `sample_img`, `date_entry`) VALUES
(131, 'Tshirt', '<ul>\n <li>Fabric: Superior quality polyester, nylon and spandex are soft and absorbent which means they are more comfortable than regular cotton. The print is bright and intense with no cracking, peeling or fading.</li>\n <li>Options: Sublimation, Direct-to-Film and Embroidery</li>\n <li>1 free layout only if you meet the minimum pieces.</li>\n <li>Layout is similar \"NOT EXACT\".</li>\n <li>3-7 day process after lay-out production.</li>\n <li>50% downpayment Before processing.</li>\n </ul>\n <p>Our highly skilled graphic artists are the reason why we create top-notch prints. They work with passion and dedication, always going the extra mile to guarantee that every product is of the highest quality.</p>\n <p>&nbsp;</p>\n <p><strong>Minimum Order Quantity(M.O.Q) 10 pieces only</strong></p>', 'tshirtpng1718158780.png', '335066415_3346527438944408_5518555370853327465_njpg1718158780.jpg, 398980855_295001636829480_71584736409376286_njpg1718158780.jpg, 424775315_345835521746091_9212214765191090317_njpg1718158780.jpg', '2024-06-12 02:19:40'),
(132, 'Poloshirt', '<ul>\n <li>Fabric: Superior quality polyester, nylon and spandex are soft and absorbent which means they are more comfortable than regular cotton. The print is bright and intense with no cracking, peeling or fading.</li>\n <li>Options: Sublimation, Direct-to-Film and Embroidery</li>\n <li>1 free layout only if you meet the minimum pieces.</li>\n <li>Layout is similar \"NOT EXACT\".</li>\n <li>3-7 day process after lay-out production.</li>\n <li>50% downpayment Before processing.</li>\n </ul>\n <p>Our highly skilled graphic artists are the reason why we create top-notch prints. They work with passion and dedication, always going the extra mile to guarantee that every product is of the highest quality.</p>\n <p>&nbsp;</p>\n <p><strong>Minimum Order Quantity(M.O.Q) 10 pieces only</strong></p>', 'poloshirtpng1718158826.png', '424633746_345835491746094_3180938816178763805_njpg1718158826.jpg, 424655050_345835511746092_7867391274793929943_njpg1718158826.jpg', '2024-06-12 02:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `qoute_request`
--

CREATE TABLE `qoute_request` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `company` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `product` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read_status` int NOT NULL DEFAULT '0' COMMENT '0=unread\r\n1=read'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qoute_request`
--

INSERT INTO `qoute_request` (`id`, `name`, `email`, `contact_number`, `company`, `address`, `product`, `quantity`, `details`, `file_name`, `time_stamp`, `read_status`) VALUES
(17, 'Dave Mental', 'davebmental@gmail.com', '639355797653', 'dvdevelopment', 'test', 'Tshirt', 2, 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id est laborum', 'MENU_SINGLET1710897031.png', '2024-03-20 01:10:31', 1),
(18, 'Dave Mental', 'davebmental@gmail.com', '639355797653', 'dvdevelopment', 'test', 'Tshirt', 2, 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Adipiscing enim eu turpis egestas pretium Velit scelerisque in dictum non Nunc non blandit massa enim nec dui nunc mattis Ullamcorper velit sed ullamcorper morbi tincidunt ornare Tellus at urna condimentum mattis pellentesque id nibh Nisl suscipit adipiscing bibendum est ultricies integer Facilisis mauris sit amet massa vitae tortor condimentum lacinia quis Eget mauris pharetra et ultrices neque ornare aenean euismod Erat velit scelerisque in dictum non consectetur a erat Leo a diam sollicitudin tempor id eu In mollis nunc sed id semper Ultrices dui sapien eget mi proin sed libero Purus ut faucibus pulvinar elementum integer enim neque volutpat Ut tortor pretium viverra suspendisse potenti nullam ac tortor Morbi tristique senectus et netus Ut enim blandit volutpat maecenas volutpat blandit\r\n\r\nFringilla urna porttitor rhoncus dolor purus non Suspendi', '431618183_1921573741578573_3493707183645387000_n1710898524.jpg', '2024-03-20 01:35:24', 1),
(19, 'Dave Mental', 'davebmental@gmail.com', '639355797653', NULL, NULL, NULL, 0, 'fasdfsda asdf sfsda', NULL, '2024-03-20 05:41:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unique_visitors`
--

CREATE TABLE `unique_visitors` (
  `date` date NOT NULL,
  `ip` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `views` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unique_visitors`
--

INSERT INTO `unique_visitors` (`date`, `ip`, `views`) VALUES
('2024-03-19', '::1 127.0.0.1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `username`, `name`, `email`, `password`, `time_stamp`) VALUES
(1, 'admin', 'Admin', 'admin@gmail.com', '0cc175b9c0f1b6a831c399e269772661', '2024-03-20 06:35:36');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `image_carousel`
--
ALTER TABLE `image_carousel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_carousel_ibfk_1` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qoute_request`
--
ALTER TABLE `qoute_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unique_visitors`
--
ALTER TABLE `unique_visitors`
  ADD PRIMARY KEY (`date`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `image_carousel`
--
ALTER TABLE `image_carousel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `qoute_request`
--
ALTER TABLE `qoute_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image_carousel`
--
ALTER TABLE `image_carousel`
  ADD CONSTRAINT `image_carousel_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_accounts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

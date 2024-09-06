-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2024 at 06:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_tennis`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `thutu` int(11) NOT NULL,
  `describ` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `thutu`, `describ`) VALUES
(1, 'Rackets', 1, 'Vợt chơi tennis'),
(2, 'woman', 1, 'Trang phục nữ'),
(3, 'men', 1, 'Trang phục nam'),
(4, 'shoes', 1, 'Giày chơi tennis\r\n'),
(5, 'sale', 1, 'Giảm giá');

-- --------------------------------------------------------

--
-- Table structure for table `logintoken`
--

CREATE TABLE `logintoken` (
  `id` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `createAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `logintoken`
--

INSERT INTO `logintoken` (`id`, `idUser`, `token`, `createAt`) VALUES
(103, 28, '509a7793b66fa72b9099523dd4fda517191df6d0', '2024-09-02 18:36:55'),
(104, 28, 'ff5312009aa2f7bbfaca53c5105a8cca016ae76b', '2024-09-03 04:10:16'),
(105, 28, 'f137962198c7395d7a6e92dba2ebde0a13690d38', '2024-09-03 17:16:24'),
(107, 28, 'ca8385078ed8f106d88f824164a778aedbc95283', '2024-09-05 06:23:05'),
(108, 28, 'b39ad143b6856daf3e47e5dd87d9dd32e6a54f9f', '2024-09-05 16:21:32'),
(109, 28, '23ffcf5634da17ddaf9828487ef3f4bf0d39cfd7', '2024-09-06 14:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `passWord` varchar(200) DEFAULT NULL,
  `forgotToken` varchar(100) DEFAULT NULL,
  `activeToken` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `createAt` datetime DEFAULT NULL,
  `updateAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `email`, `phone`, `passWord`, `forgotToken`, `activeToken`, `status`, `createAt`, `updateAt`) VALUES
(28, 'NguyenNgocTin', 'nntin@gmail.com', '0888899991', '$2y$10$BoDgo50kVwqE/ObmIQsN5uDUHitKNhLaXoXZ91jO4y0HFA9Zwgz0u', NULL, NULL, 0, '2024-09-02 18:39:46', NULL),
(33, 'truong', 'letruong8017@gmail.com', '0865057272', '$2y$10$0Df5t.R92E91eYh7rd90eOUXcpGsGHZxix9HFm/R2rJY2NGNNMdzy', NULL, NULL, 1, '2024-09-05 06:21:19', NULL),
(35, 'pbt1234', 'pbt1234@gmail.com', '0873123012', '$2y$10$LZRlZTv8fjPC2CqDnBrivuHASDDBvW/u3g3yHrkVzYj82UAIgqCz.', NULL, NULL, 1, '2024-09-05 04:56:20', NULL),
(36, 'bar12312', 'bar69218@gmail.com', '0234567891', '$2y$10$Gbup1kfjHjnc2T6Owht5k.uuKZIIqMs1QFYAtoJbZSRVRPYoqQK.O', NULL, NULL, 1, '2024-09-05 17:28:01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logintoken`
--
ALTER TABLE `logintoken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products` (`categoryId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `logintoken`
--
ALTER TABLE `logintoken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logintoken`
--
ALTER TABLE `logintoken`
  ADD CONSTRAINT `logintoken_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 12, 2024 lúc 12:54 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_tennis`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `describ` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `describ`) VALUES
(1, 'Rackets', 'Vợt chơi tennis'),
(2, 'woman', 'Trang phục nữ'),
(3, 'men', 'Trang phục nam'),
(4, 'shoes', 'Giày chơi tennis\r\n'),
(5, 'sale', 'Giảm giá');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logintoken`
--

CREATE TABLE `logintoken` (
  `id` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `createAt` datetime DEFAULT NULL,
  `tokenAdmin` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

CREATE TABLE `orderdetail` (
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(5) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orderdetail`
--

INSERT INTO `orderdetail` (`orderId`, `productId`, `quantity`, `size`, `time`) VALUES
(43, 12, 2, '42', '2024-09-12 12:44:18'),
(43, 12, 1, '38', '2024-09-12 12:44:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `note` text NOT NULL,
  `status` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `deliveryName` varchar(200) NOT NULL,
  `deliveryPhone` int(11) NOT NULL,
  `deliveryAddress` varchar(200) NOT NULL,
  `userId` int(11) NOT NULL,
  `confirmToken` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `note`, `status`, `orderDate`, `deliveryName`, `deliveryPhone`, `deliveryAddress`, `userId`, `confirmToken`) VALUES
(43, 'Giao buoi  toi giup em', 1, '2024-09-12', 'NGuyen Ngoc Tin', 865057272, 'Phu Yen Tower', 33, 'a17ba5a63e93511c2a6b07cd7eb19ec6e7f4d529'),
(44, '', 0, '2024-09-12', '', 0, '', 33, ''),
(45, '', 0, '2024-09-12', '', 0, '', 33, ''),
(46, '', 0, '2024-09-12', '', 0, '', 33, ''),
(47, '', 0, '2024-09-12', '', 0, '', 33, ''),
(48, '', 0, '2024-09-12', '', 0, '', 33, ''),
(49, '', 0, '2024-09-12', '', 0, '', 33, ''),
(50, '', 0, '2024-09-12', '', 0, '', 33, ''),
(51, '', 0, '2024-09-12', '', 0, '', 33, ''),
(52, '', 0, '2024-09-12', '', 0, '', 33, ''),
(53, '', 0, '2024-09-12', '', 0, '', 33, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `quantity`, `image`, `categoryId`) VALUES
(1, 'NikeCourt Advantage', 1600000, 10, 'template\\image\\Men\\M+NKCT+DF+ADVTG+TOP.png', 3),
(2, 'NikeCourt Slam', 2220000, 15, 'template\\image\\Men\\M+NKCT+DF+SLAM+TOP+LN.png', 3),
(3, 'NikeCourt', 863000, 20, 'template\\image\\Men\\M+NKCT+DF+TEE+OC+SU24 (2).png', 3),
(4, 'NikeCourt Slam', 2590000, 20, 'template\\image\\Men\\M+NKCT+DFADV+SLM+ULT+POLO+LN.png', 3),
(5, 'NikeCourt Advantage', 1700000, 20, 'template\\image\\Men\\M+NKCT+DF+ADVTG+POLO.png', 3),
(6, 'Nike Dri-FIT Advantage', 2220000, 20, 'template\\image\\Woman\\W+NK+DF+ADVTG+DRESS.png', 2),
(7, 'NikeCourt Slam', 3210000, 20, 'template\\image\\Woman\\W+NKCT+DF+SLAM+DRESS+LN.png', 2),
(8, 'NikeCourt Slam', 3210000, 20, 'template\\image\\Woman\\W+NKCT+DF+SLAM+DRESS+NY.png', 2),
(9, 'NikeCourt Heritage', 2220000, 20, 'template\\image\\Woman\\W+NKCT+HRTGE+FLC+OOS+GFX+CREW.png', 2),
(10, 'NikeCourt Slam', 3210000, 20, 'template\\image\\Woman\\W+NKCT+DF+SLAM+DRESS+RG.jpg', 2),
(11, 'Asics Gel-Resolution 9', 3700000, 20, 'template\\image\\Shoes\\1041A330_100_SR_RT_GLB.webp', 4),
(12, 'Adidas Barricade 13', 3950000, 20, 'template\\image\\Shoes\\Barricade_13_Tennis_Shoes_Red_IF9131_HM1.avif', 4),
(13, 'NikeCourt Air Zoom Vapor 11', 4200000, 20, 'template\\image\\Shoes\\M+NIKE+ZOOM+VAPOR+11+HC.jpg', 4),
(14, 'NikeCourt Air Zoom Vapor Pro HC', 6200000, 20, 'template\\image\\Shoes\\nike-air-zoom-vapor-pro-hc-shoes.webp', 4),
(15, 'NikeCourt Air Zoom Vapor 11', 4200000, 20, 'template\\image\\Shoes\\M+NIKE+ZOOM+VAPOR+11+HC+PE.png', 4),
(16, 'BABOLAT Pure Aero', 5430000, 20, 'template\\image\\Racket\\Pure-Aero-Unstrung-1.png', 1),
(17, 'HEAD Speed MP Tennis ', 5600000, 20, 'template\\image\\Racket\\speed-mp-2024.webp', 1),
(18, 'HEAD Speed MP Legend Tennis', 5700000, 20, 'template\\image\\Racket\\speed-mp-legend-2024.webp', 1),
(19, 'YONEX VCORE 100+', 4940000, 20, 'template\\image\\Racket\\07vc100_in_1.webp', 1),
(20, 'WILSON Blade 100 V9 Tennis ', 6400000, 20, 'template\\image\\Racket\\WR151511U__94ed7b58b3fed9e7519781ad37dfea44.webp', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
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
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `fullName`, `email`, `phone`, `passWord`, `forgotToken`, `activeToken`, `status`, `createAt`, `updateAt`) VALUES
(28, 'NguyenNgocTin', 'nntin@gmail.com', '0888899991', '$2y$10$BoDgo50kVwqE/ObmIQsN5uDUHitKNhLaXoXZ91jO4y0HFA9Zwgz0u', NULL, NULL, 0, '2024-09-02 18:39:46', NULL),
(33, 'truong', 'letruong8017@gmail.com', '0865057272', '$2y$10$0Df5t.R92E91eYh7rd90eOUXcpGsGHZxix9HFm/R2rJY2NGNNMdzy', NULL, NULL, 1, '2024-09-05 06:21:19', NULL),
(36, 'bar12312', 'bar69218@gmail.com', '0234567891', '$2y$10$Gbup1kfjHjnc2T6Owht5k.uuKZIIqMs1QFYAtoJbZSRVRPYoqQK.O', NULL, NULL, 1, '2024-09-05 17:28:01', NULL),
(37, 'ADMIN', 'admin@gmail.com', NULL, '$2y$10$e9668/Cq2kNHBwB2GVHTE.jQyXfgjl4Oe.Drvceg7fLgrN16/Rrge', NULL, NULL, 1, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `logintoken`
--
ALTER TABLE `logintoken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- Chỉ mục cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`orderId`,`productId`,`time`),
  ADD KEY `productId` (`productId`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products` (`categoryId`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `logintoken`
--
ALTER TABLE `logintoken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `logintoken`
--
ALTER TABLE `logintoken`
  ADD CONSTRAINT `logintoken_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orderdetail_ibfk_3` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

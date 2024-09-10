-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 10, 2024 lúc 12:17 PM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 7.3.28

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
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `thutu` int(11) NOT NULL,
  `describ` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `thutu`, `describ`) VALUES
(1, 'Rackets', 1, 'Vợt chơi tennis'),
(2, 'woman', 1, 'Trang phục nữ'),
(3, 'men', 1, 'Trang phục nam'),
(4, 'shoes', 1, 'Giày chơi tennis\r\n'),
(5, 'sale', 1, 'Giảm giá');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logintoken`
--

CREATE TABLE `logintoken` (
  `id` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `logintoken`
--

INSERT INTO `logintoken` (`id`, `idUser`, `token`, `createAt`) VALUES
(103, 28, '509a7793b66fa72b9099523dd4fda517191df6d0', '2024-09-02 18:36:55'),
(104, 28, 'ff5312009aa2f7bbfaca53c5105a8cca016ae76b', '2024-09-03 04:10:16'),
(105, 28, 'f137962198c7395d7a6e92dba2ebde0a13690d38', '2024-09-03 17:16:24'),
(107, 28, 'ca8385078ed8f106d88f824164a778aedbc95283', '2024-09-05 06:23:05'),
(108, 28, 'b39ad143b6856daf3e47e5dd87d9dd32e6a54f9f', '2024-09-05 16:21:32'),
(109, 28, '23ffcf5634da17ddaf9828487ef3f4bf0d39cfd7', '2024-09-06 14:55:16'),
(110, 28, '52e39b0a59a8bb6d0f662281ba2a1cbb86cce7e0', '2024-09-06 18:35:07'),
(111, 28, '6543b457f6a065e3c56000931e416384ddcba497', '2024-09-10 11:35:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `quantity`, `image`, `categoryId`) VALUES
(1, 'NikeCourt Advantage', '1600000.00', 10, 'template\\image\\Men\\M+NKCT+DF+ADVTG+TOP.png', 3),
(2, 'NikeCourt Slam', '2220000.00', 15, 'template\\image\\Men\\M+NKCT+DF+SLAM+TOP+LN.png', 3),
(3, 'NikeCourt', '863000.00', 20, 'template\\image\\Men\\M+NKCT+DF+TEE+OC+SU24 (2).png', 3),
(4, 'NikeCourt Slam', '2590000.00', 20, 'template\\image\\Men\\M+NKCT+DFADV+SLM+ULT+POLO+LN.png', 3),
(5, 'NikeCourt Advantage', '1700000.00', 20, 'template\\image\\Men\\M+NKCT+DF+ADVTG+POLO.png', 3),
(6, 'Nike Dri-FIT Advantage', '2220000.00', 20, 'template\\image\\Woman\\W+NK+DF+ADVTG+DRESS.png', 2),
(7, 'NikeCourt Slam', '3210000.00', 20, 'template\\image\\Woman\\W+NKCT+DF+SLAM+DRESS+LN.png', 2),
(8, 'NikeCourt Slam', '3210000.00', 20, 'template\\image\\Woman\\W+NKCT+DF+SLAM+DRESS+NY.png', 2),
(9, 'NikeCourt Heritage', '2220000.00', 20, 'template\\image\\Woman\\W+NKCT+HRTGE+FLC+OOS+GFX+CREW.png', 2),
(10, 'NikeCourt Slam', '3210000.00', 20, 'template\\image\\Woman\\W+NKCT+DF+SLAM+DRESS+RG.jpg', 2),
(11, 'Asics Gel-Resolution 9', '3700000.00', 20, 'template\\image\\Shoes\\1041A330_100_SR_RT_GLB.webp', 4),
(12, 'Adidas Barricade 13', '3950000.00', 20, 'template\\image\\Shoes\\Barricade_13_Tennis_Shoes_Red_IF9131_HM1.avif', 4),
(13, 'NikeCourt Air Zoom Vapor 11', '4200000.00', 20, 'template\\image\\Shoes\\M+NIKE+ZOOM+VAPOR+11+HC.jpg', 4),
(14, 'NikeCourt Air Zoom Vapor Pro HC', '6200000.00', 20, 'template\\image\\Shoes\\nike-air-zoom-vapor-pro-hc-shoes.webp', 4),
(15, 'NikeCourt Air Zoom Vapor 11', '4200000.00', 20, 'template\\image\\Shoes\\M+NIKE+ZOOM+VAPOR+11+HC+PE.png', 4),
(16, 'BABOLAT Pure Aero', '5430000.00', 20, 'template\\image\\Racket\\Pure-Aero-Unstrung-1.png', 1),
(17, 'HEAD Speed MP Tennis ', '5600000.00', 20, 'template\\image\\Racket\\speed-mp-2024.webp', 1),
(18, 'HEAD Speed MP Legend Tennis', '5700000.00', 20, 'template\\image\\Racket\\speed-mp-legend-2024.webp', 1),
(19, 'YONEX VCORE 100+', '4940000.00', 20, 'template\\image\\Racket\\07vc100_in_1.webp', 1),
(20, 'WILSON Blade 100 V9 Tennis ', '6400000.00', 20, 'template\\image\\Racket\\WR151511U__94ed7b58b3fed9e7519781ad37dfea44.webp', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passWord` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgotToken` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activeToken` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
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
(35, 'pbt1234', 'pbt1234@gmail.com', '0873123012', '$2y$10$LZRlZTv8fjPC2CqDnBrivuHASDDBvW/u3g3yHrkVzYj82UAIgqCz.', NULL, NULL, 1, '2024-09-05 04:56:20', NULL),
(36, 'bar12312', 'bar69218@gmail.com', '0234567891', '$2y$10$Gbup1kfjHjnc2T6Owht5k.uuKZIIqMs1QFYAtoJbZSRVRPYoqQK.O', NULL, NULL, 1, '2024-09-05 17:28:01', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `logintoken`
--
ALTER TABLE `logintoken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `logintoken`
--
ALTER TABLE `logintoken`
  ADD CONSTRAINT `logintoken_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 10:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vintage`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `billing_ID` int(10) UNSIGNED NOT NULL COMMENT 'Billing''s ID',
  `name` varchar(100) NOT NULL COMMENT 'User''s Fullname',
  `billingAddress` varchar(100) NOT NULL COMMENT 'Billing Address',
  `city` varchar(50) NOT NULL COMMENT 'City',
  `ZIP_code` int(11) NOT NULL COMMENT 'ZIP Code',
  `country` varchar(50) NOT NULL COMMENT 'Country',
  `payment_ID` int(10) UNSIGNED NOT NULL COMMENT 'Payment''s ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`billing_ID`, `name`, `billingAddress`, `city`, `ZIP_code`, `country`, `payment_ID`) VALUES
(1, 'hfghfghfg', 'hfghfhfghfg', 'hfghfgh', 2131231, 'tsdsdfser', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_ID` int(10) UNSIGNED NOT NULL COMMENT 'Cart''s ID',
  `amount` int(11) NOT NULL COMMENT 'Product''s Amount in cart',
  `user_ID` int(10) UNSIGNED NOT NULL COMMENT 'User''s ID',
  `prod_ID` int(10) UNSIGNED NOT NULL COMMENT 'Product''s ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `container`
--

CREATE TABLE `container` (
  `prod_ID` int(10) UNSIGNED NOT NULL COMMENT 'Product''s ID',
  `amount` int(11) NOT NULL COMMENT 'Product''s Amount in Order',
  `tracking_no` varchar(20) NOT NULL DEFAULT '-' COMMENT 'Tracking Number',
  `deliveryStatus` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Delivery''s Status',
  `order_ID` int(10) UNSIGNED NOT NULL COMMENT 'Order''s ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `container`
--

INSERT INTO `container` (`prod_ID`, `amount`, `tracking_no`, `deliveryStatus`, `order_ID`) VALUES
(1, 1, '1111 2222', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `credit_card`
--

CREATE TABLE `credit_card` (
  `credit_ID` int(10) UNSIGNED NOT NULL COMMENT 'Credit Card''s ID',
  `cardholder_name` varchar(100) NOT NULL COMMENT 'Cardholder''s Fullname',
  `card_no` varchar(20) NOT NULL COMMENT 'Card Number',
  `expM` int(2) NOT NULL COMMENT 'Expired Month',
  `expY` int(4) NOT NULL COMMENT 'Expired Year',
  `CVC_no` varchar(255) NOT NULL COMMENT 'CVC Number'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `credit_card`
--

INSERT INTO `credit_card` (`credit_ID`, `cardholder_name`, `card_no`, `expM`, `expY`, `CVC_no`) VALUES
(1, 'fghfghfghf', '2132131231', 22, 1213, '$2y$10$dV9svAhHkAFk8nalKVlp2eBZZCWwguaE0FdsLd9iOzQapHrbl6O02');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `M_id` int(10) UNSIGNED NOT NULL COMMENT 'Manager''s ID',
  `fName` varchar(30) NOT NULL COMMENT 'Manager''s Firstname',
  `lName` varchar(30) NOT NULL COMMENT 'Manager''s Lastname',
  `email` varchar(50) NOT NULL COMMENT 'Manager''s Email',
  `username` varchar(30) NOT NULL COMMENT 'Manager''s Username',
  `password` varchar(255) NOT NULL COMMENT 'Manager''s Password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`M_id`, `fName`, `lName`, `email`, `username`, `password`) VALUES
(1, 'Spongebob', 'Squarepants', 'sponge321@gmail.com', 'spongebob123', '$2y$10$LskudKyI/QxA31h0AP2NYe5bydF.PGujDf6Qky9iH4C8AnCgJJ892');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(10) UNSIGNED NOT NULL COMMENT 'Order''s ID',
  `user_ID` int(10) UNSIGNED NOT NULL COMMENT 'User''s ID',
  `payment_ID` int(10) UNSIGNED DEFAULT NULL COMMENT 'Payment''s ID',
  `deliveryAddress` varchar(100) NOT NULL COMMENT 'Address for Delivery',
  `phone` int(11) NOT NULL COMMENT 'Phone Number',
  `order_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Ordering Date',
  `code_ID` int(10) UNSIGNED DEFAULT NULL COMMENT 'Code''s ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_ID`, `user_ID`, `payment_ID`, `deliveryAddress`, `phone`, `order_date`, `code_ID`) VALUES
(1, 1, 1, 'adasd asdasd 12120 asdasd asdasd', 817802003, '2023-11-23 01:38:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_ID` int(10) UNSIGNED NOT NULL COMMENT 'Payment''s ID',
  `payment_method` varchar(20) NOT NULL COMMENT 'Payment Method',
  `payment_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Payment''s Status',
  `amountPaid` int(11) NOT NULL COMMENT 'Payment''s Amount',
  `credit_ID` int(10) UNSIGNED NOT NULL COMMENT 'Credit''s ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_ID`, `payment_method`, `payment_status`, `amountPaid`, `credit_ID`) VALUES
(1, 'mastercard', 0, 1382, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_ID` int(10) UNSIGNED NOT NULL COMMENT 'Product''s ID',
  `prod_name` varchar(100) NOT NULL COMMENT 'Product''s Name',
  `prod_detail` varchar(300) NOT NULL COMMENT 'Product''s Detail',
  `prod_price` varchar(10) NOT NULL COMMENT 'Product''s Price',
  `amount` int(11) NOT NULL COMMENT 'Amount of Product',
  `image` varchar(200) DEFAULT NULL COMMENT 'Product''s Image',
  `prod_type` varchar(10) NOT NULL COMMENT 'Product''s Type',
  `M_ID` int(11) UNSIGNED NOT NULL COMMENT 'Manager''s ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_ID`, `prod_name`, `prod_detail`, `prod_price`, `amount`, `image`, `prod_type`, `M_ID`) VALUES
(1, '[KUJO] \"Killua\" Vintage Oversized T Shirt', '- Made with high quality heavyweight %100 organic cotton\r\n- Design is embedded into the fabric for a long lasting print\r\n- Relaxed fit and neat seams\r\n- Washed through our unique hand washed staining process for a vintage washed look and frayed feel\r\n- Oversized American fit', '1282', 2, 'prodImage/image 3.png', 'men', 1),
(2, '[KUJO] \"Guts\" Vintage Oversized T Shirt', '- Made with high quality heavyweight %100 organic cotton\r\n- Design is embedded into the fabric for a long lasting print\r\n- Relaxed fit and neat seams\r\n- Washed through our unique hand washed staining process for a vintage washed look and frayed feel\r\n- Oversized American fit', '1262', 1, 'prodImage/image 4.png', 'men', 1),
(3, '70\'s T-shirt, Seventies Shirt,Retro Shirt,Nostalgic Shirt,Music shirt', '- SIZE XL\r\n- COLOR PURPLE', '777', 1, 'prodImage/image 7.png', 'men', 1),
(4, 'Sabaton Crows of War Vintage T-Shirt XXL', 'Unisex\r\nContrasting colors\r\nShort sleeves\r\n100% cotton\r\nVery soft feel touch and nice fitting\r\nPrint Front & Back\r\nRound neck\r\nMachine wash; Low temperature\r\nDo not iron printed area\r\nSIZE XL', '1222', 3, 'prodImage/image 19.png', 'men', 1),
(5, 'Vintage Washed T-Shirt 2022 Streetwear Oversized Graphic', 'High Quality Oversized Vintage Graphic T-Shirt \r\n\r\n\"Blessing, You Never Know Where A Blessing Can Come From \" \r\n\r\nSizes: Small \r\n', '1233', 1, 'prodImage/s-l1600.jpg', 'men', 1),
(6, 'Vintage Tees for Women 2022 Halloween Skeleton Print Shirts', 'SIZE XL', '806', 1, 'prodImage/image 32.png', 'women', 1),
(7, 'Vintage Tees for Women Aesthetic, Women\'s Short Sleeve', 'SIZE L', '1183', 1, 'prodImage/image 33.png', 'women', 1),
(8, 'Peris Gems Purple Rain Vintage Graphic Tees for Women', 'SIZE M', '615', 1, 'prodImage/image 34.png', 'women', 1),
(9, 'Gaphic Tees for Teen Girls Vintage Aesthetic, Women\'s Short Sleeve', 'SIZE XL', '1168', 1, 'prodImage/image 35.png', 'women', 1),
(10, '2pac rap tee tupac shakur t shirt women vintage 90s style', 'SIZE M', '687', 1, 'prodImage/image 41.png', 'women', 1);

-- --------------------------------------------------------

--
-- Table structure for table `promo_code`
--

CREATE TABLE `promo_code` (
  `code_ID` int(11) UNSIGNED NOT NULL COMMENT 'Code''s ID',
  `code` varchar(100) NOT NULL COMMENT 'Code''s Name',
  `amount` int(11) NOT NULL COMMENT 'Amount of Code',
  `start_date` date NOT NULL COMMENT 'Start Date of the Code',
  `end_date` date NOT NULL COMMENT 'End Date of the Code',
  `code_type` varchar(15) NOT NULL COMMENT 'Code Type',
  `discountPercentage` int(11) DEFAULT NULL COMMENT 'Discount Percentage',
  `discountAmount` int(11) DEFAULT NULL COMMENT 'Discount Amount',
  `M_ID` int(11) UNSIGNED NOT NULL COMMENT 'Manager''s ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `promo_code`
--

INSERT INTO `promo_code` (`code_ID`, `code`, `amount`, `start_date`, `end_date`, `code_type`, `discountPercentage`, `discountAmount`, `M_ID`) VALUES
(1, 'HAPPY1111', 3, '2023-11-23', '2023-11-30', 'percentage', 30, NULL, 1),
(2, 'Code1', 3, '2023-11-24', '2023-11-25', 'Amount', NULL, 300, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(10) UNSIGNED NOT NULL COMMENT 'User''s ID',
  `email` varchar(30) NOT NULL COMMENT 'User''s Email',
  `username` varchar(20) NOT NULL COMMENT 'User''s Username',
  `password` varchar(255) NOT NULL COMMENT 'User''s Password',
  `regis_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Registration Date',
  `using_promo` tinyint(1) DEFAULT 0 COMMENT 'Using Promo Code Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `email`, `username`, `password`, `regis_date`, `using_promo`) VALUES
(1, 'pprw.27@gmail.com', 'tar', '$2y$10$Cx1Kz7Mz.ZHG/keu5HxwVON1wDPbTiUJs7G2PfIXEiFRhQcwt25oK', '2023-11-23 01:35:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `info_ID` int(10) UNSIGNED NOT NULL COMMENT 'Info''s ID',
  `fName` varchar(20) NOT NULL COMMENT 'Firstname',
  `lName` varchar(20) NOT NULL COMMENT 'Lastname',
  `DOB` date NOT NULL COMMENT 'Date of Birth',
  `phone` int(11) NOT NULL COMMENT 'Phone Number',
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL COMMENT 'User''s Image',
  `user_ID` int(10) UNSIGNED NOT NULL COMMENT 'User''s ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`info_ID`, `fName`, `lName`, `DOB`, `phone`, `address1`, `address2`, `image`, `user_ID`) VALUES
(1, 'Gui', 'Tar', '2023-11-01', 881234567, 'dwa dwa2 123 dwa4 sdwa5', 'qwe reqwq2 1233 wewq2 sdwa', 'usersImage/snowball.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`billing_ID`),
  ADD KEY `FK1` (`payment_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_ID`),
  ADD KEY `FK2` (`user_ID`),
  ADD KEY `FK1` (`prod_ID`) USING BTREE;

--
-- Indexes for table `container`
--
ALTER TABLE `container`
  ADD PRIMARY KEY (`prod_ID`,`order_ID`),
  ADD KEY `order_ID` (`order_ID`);

--
-- Indexes for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD PRIMARY KEY (`credit_ID`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`M_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `FK3` (`code_ID`),
  ADD KEY `FK1` (`user_ID`),
  ADD KEY `FK2` (`payment_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_ID`),
  ADD KEY `FK1` (`credit_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_ID`),
  ADD KEY `FK1` (`M_ID`);

--
-- Indexes for table `promo_code`
--
ALTER TABLE `promo_code`
  ADD PRIMARY KEY (`code_ID`),
  ADD KEY `FK1` (`M_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`info_ID`),
  ADD KEY `FK1` (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `billing_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Billing''s ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Cart''s ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `credit_card`
--
ALTER TABLE `credit_card`
  MODIFY `credit_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Credit Card''s ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `M_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Manager''s ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Order''s ID', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Payment''s ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Product''s ID', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `promo_code`
--
ALTER TABLE `promo_code`
  MODIFY `code_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Code''s ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User''s ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `info_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Info''s ID', AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`payment_ID`) REFERENCES `payment` (`payment_ID`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`prod_ID`) REFERENCES `product` (`prod_ID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `container`
--
ALTER TABLE `container`
  ADD CONSTRAINT `container_ibfk_1` FOREIGN KEY (`prod_ID`) REFERENCES `product` (`prod_ID`),
  ADD CONSTRAINT `container_ibfk_2` FOREIGN KEY (`order_ID`) REFERENCES `orders` (`order_ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`code_ID`) REFERENCES `promo_code` (`code_ID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`payment_ID`) REFERENCES `payment` (`payment_ID`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`credit_ID`) REFERENCES `credit_card` (`credit_ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`M_ID`) REFERENCES `manager` (`M_id`);

--
-- Constraints for table `promo_code`
--
ALTER TABLE `promo_code`
  ADD CONSTRAINT `promo_code_ibfk_1` FOREIGN KEY (`M_ID`) REFERENCES `manager` (`M_id`);

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

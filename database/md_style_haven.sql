-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 03:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `md_style_haven`
--

-- --------------------------------------------------------

--
-- Table structure for table `cancellation`
--

CREATE TABLE `cancellation` (
  `cancel_id` int(11) NOT NULL,
  `cancel_date` date DEFAULT NULL,
  `cancel_reason` text DEFAULT NULL,
  `fk_order_id` int(11) DEFAULT NULL,
  `fk_staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_id` int(11) NOT NULL,
  `item_qty` int(11) DEFAULT NULL,
  `fk_cust_id` int(11) DEFAULT NULL,
  `fk_item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`cart_id`, `item_qty`, `fk_cust_id`, `fk_item_id`) VALUES
(19, 2, 3001, 24013),
(20, 2, 3001, 24009);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(4001, 'SHIRT'),
(4002, 'T-SHIRT & POLO'),
(4003, 'SHORTS'),
(4008, 'PANTS'),
(4009, 'HOODIES'),
(4010, 'DENIM');

-- --------------------------------------------------------

--
-- Table structure for table `cost_parameter`
--

CREATE TABLE `cost_parameter` (
  `para_id` int(11) NOT NULL,
  `para name` varchar(200) NOT NULL,
  `para_type` varchar(200) NOT NULL,
  `para_cost` decimal(10,2) NOT NULL,
  `fk_staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_fname` varchar(100) DEFAULT NULL,
  `cust_lname` varchar(100) DEFAULT NULL,
  `cust_username` varchar(100) DEFAULT NULL,
  `cust_pwd` varchar(100) DEFAULT NULL,
  `cust_email` varchar(100) DEFAULT NULL,
  `cust_phone` varchar(20) DEFAULT NULL,
  `cust_add_line1` varchar(255) DEFAULT NULL,
  `cust_add_line2` varchar(255) DEFAULT NULL,
  `cust_add_line3` varchar(255) DEFAULT NULL,
  `cust_add_line4` varchar(255) DEFAULT NULL,
  `cust_is_active` tinyint(1) DEFAULT 1,
  `otp` varchar(255) DEFAULT NULL,
  `signup_time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `active_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_fname`, `cust_lname`, `cust_username`, `cust_pwd`, `cust_email`, `cust_phone`, `cust_add_line1`, `cust_add_line2`, `cust_add_line3`, `cust_add_line4`, `cust_is_active`, `otp`, `signup_time`, `active_code`) VALUES
(3001, 'Malindu', 'Dilakshana', 'Dila', 'dila123', 'malindudilak@gmail.com', '0770113944', 'F02', 'Noori road', 'hambanawela ', 'Deraniyagala', 1, '', '2024-12-20 13:35:44', ''),
(3002, 'GABELA', 'RUPASINGHE', 'Mal', 'mal123', 'malindudilak@gmail.com', '0770113944', 'Sinha sewana', 'Noori road', 'hambanawela', 'Deraniyagala', 1, '', '2024-12-20 13:35:44', ''),
(20024, 'kisara ', 'helitha', 'kisara ', 'k2010', 'kisara@gmail.com', '0761046865', 'B09', 'lane 07', 'muhandiram ', 'Dera', 1, '', '2024-12-20 13:35:44', '');

-- --------------------------------------------------------

--
-- Table structure for table `customization`
--

CREATE TABLE `customization` (
  `customization_id` int(11) NOT NULL,
  `measurement` text DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `arm_type` varchar(50) DEFAULT NULL,
  `neck_type` varchar(50) DEFAULT NULL,
  `fabric` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `sample_design` varchar(255) DEFAULT NULL,
  `cust_qty` int(11) DEFAULT NULL,
  `customization_date` date DEFAULT NULL,
  `customization_text` text DEFAULT NULL,
  `manufacture_cost` decimal(10,2) DEFAULT NULL,
  `design_cost` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `advance_pay_amount` decimal(10,2) DEFAULT NULL,
  `dimo_image` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `fk_cust_id` int(11) DEFAULT NULL,
  `fk_staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_area`
--

CREATE TABLE `delivery_area` (
  `deliver_area_id` int(11) NOT NULL,
  `deliver_area_name` date DEFAULT NULL,
  `delivery_status` varchar(100) DEFAULT NULL,
  `fk_staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `disc_id` int(11) NOT NULL,
  `req_point` int(11) DEFAULT NULL,
  `disc_presentage` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `fk_staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_date` date DEFAULT NULL,
  `feedback_msg` text DEFAULT NULL,
  `feedback_status` varchar(100) DEFAULT NULL,
  `fk_cust_id` int(11) DEFAULT NULL,
  `fk_staff_id` int(11) DEFAULT NULL,
  `fk_item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `inquiry_id` int(11) NOT NULL,
  `inquiry_date` date DEFAULT NULL,
  `inquiry_msg` text DEFAULT NULL,
  `inquiry_reply` text DEFAULT NULL,
  `inquiry_reply_date` date DEFAULT NULL,
  `fk_cust_id` int(11) DEFAULT NULL,
  `fk_staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_image1` varchar(255) DEFAULT NULL,
  `item_image2` varchar(255) DEFAULT NULL,
  `item_brand` varchar(100) DEFAULT NULL,
  `item_material` varchar(100) DEFAULT NULL,
  `item_description` text DEFAULT NULL,
  `item_sell_price` decimal(10,2) DEFAULT NULL,
  `item_cost_price` decimal(10,2) DEFAULT NULL,
  `item_stock_qty` int(11) DEFAULT NULL,
  `item_discount` decimal(5,2) DEFAULT NULL,
  `item_date_added` date DEFAULT NULL,
  `fk_category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_image1`, `item_image2`, `item_brand`, `item_material`, `item_description`, `item_sell_price`, `item_cost_price`, `item_stock_qty`, `item_discount`, `item_date_added`, `fk_category_id`) VALUES
(24009, 'JOBBS WAFFLE T – SHIRT', 'JOBBS WAFFLE T – SHIRT 1.0.jpg', 'JOBBS WAFFLE T – SHIRT 1.1.jpg', 'JOBBS', 'Waffle Jersey', '        Waffle oversized T – shirt with short sleeves and round neck.\r\n\r\n                                                                                ', '3290.00', '2500.00', 28, '0.00', '2024-10-11', 4002),
(24010, 'JOBBS LONG SLEEVE T – SHIRT', 'JOBBS LONG SLEEVE T – SHIRT.jpg', '', 'JOBBS', 'Single Jersey', '    Single jersey long sleeves T – shirt with round neck .\r\n\r\n                                        ', '3990.00', '3500.00', 1, '0.00', '2024-10-11', 4002),
(24012, 'Jobbs mens long sleeve jersey flext shirt', 'Jobbs mens long sleeve jersey flext shirt 1.0.jpg', 'Jobbs mens long sleeve jersey flext shirt 1.1.jpg', 'JOBBS', 'Lightweight single jersey', '    Inspired to give smart casual comfort to formal and everyday wear made with soft and cotton spandex blended breathable lightweight single jersey with long sleeves, full front button fastening, and collar detail.\r\n\r\n                                        ', '4290.00', '3900.00', 19, '3.00', '2024-10-11', 4001),
(24013, 'Moose Men’s Chino Pant- Dark May', 'Moose Men’s Chino Pant- Dark May.jpg', '', 'MOOSE', 'Cotton', '            Stylish and comfortable slim fit chino pant to suit any day, any occasion.\r\n,\r\nFabric pattern: Solid,\r\nFit type: Slim ,\r\nLength: Regular\r\n\r\n\r\n                                                                                                                        ', '3490.00', '3000.00', 21, '0.00', '2024-10-11', 4008),
(24015, 'jobbs mens long sleeve hoodie', 'jobbs mens long sleeve hoodie 1.0.jpg', 'jobbs mens long sleeve hoodie 1.1.jpg', 'JOBBS', 'Single Jersey', 'Lightweight zip-through hoodie made with soft jersey with a fixed hood and typo graphic print detail.\r\n\r\n', '3990.99', '3450.00', 10, '10.00', '2024-10-11', 4009),
(24016, 'JOBBS MENS CASUAL SHORT', 'JOBBS MENS CASUAL SHORT 1.0.jpg', 'JOBBS MENS CASUAL SHORT 1.1.jpg', 'MOOSE', 'Cotton', 'COTTON SHORT WITH SINGLE BUTTON FASTENING , TWO SIDES POCKETS AND BELT LOOPS .\r\n\r\n', '1990.00', '1650.00', 14, '0.00', '2024-10-11', 4003),
(24017, 'Bolt Gear Mens Moisture Abdorbant Short', 'Bolt Gear Mens Moisture Abdorbant Short 1.0.jpg', 'Bolt Gear Mens Moisture Abdorbant Short 1.1.jpg', 'MAS', 'Polyester', 'This BOLT GEAR product made from lightweight moisture absorbing fabric to help keep you easy and comfortable during the workout.\r\n\r\n', '3490.00', '3000.00', 11, '15.00', '2024-10-11', 4003),
(24018, 'Jobbs short sleeve polo t-shirt', 'Jobbs short sleeve polo t-shirt.jpg', '', 'JOBBS', 'COTTON BLEND', '    Short sleeve polo t-shirt with signature modify detail\r\n\r\n                                        ', '2290.00', '2500.00', 8, '0.00', '2024-10-13', 4002),
(24019, 'MENS STRETCH DENIM PANT', 'MENS STRETCH DENIM PANT.jpg', '', 'MOOSE', 'DENIM', 'MENS STRETCH DENIM PANT WITH SINGLE BUTTON FASTENING , SIDES POCKETS AND BELT LOOPS .\r\n', '5990.00', '5500.00', 13, '5.00', '2024-10-13', 4010);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `order_total` decimal(10,2) DEFAULT NULL,
  `order_fname` varchar(50) DEFAULT NULL,
  `order_lname` varchar(50) DEFAULT NULL,
  `order_email` varchar(100) DEFAULT NULL,
  `discrict` varchar(100) DEFAULT NULL,
  `order_address_line1` varchar(200) DEFAULT NULL,
  `order_address_line2` varchar(255) DEFAULT NULL,
  `order_address_line3` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(15) DEFAULT NULL,
  `order_contact1` varchar(15) DEFAULT NULL,
  `order_contact2` varchar(15) DEFAULT NULL,
  `order_status` varchar(100) DEFAULT NULL,
  `order_deliver_option` varchar(100) DEFAULT NULL,
  `order_deliver_date` date DEFAULT NULL,
  `fk_cust_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `item_qty` int(11) DEFAULT NULL,
  `order_item_price` decimal(10,2) DEFAULT NULL,
  `fk_order_id` int(11) DEFAULT NULL,
  `fk_item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `payment_status` varchar(100) DEFAULT NULL,
  `fk_order_id` int(11) DEFAULT NULL,
  `fk_customization_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `rating_date` date DEFAULT NULL,
  `rating_value` int(11) DEFAULT NULL,
  `fk_cust_id` int(11) DEFAULT NULL,
  `fk_staff_id` int(11) DEFAULT NULL,
  `fk_order_id` int(11) DEFAULT NULL,
  `fk_item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `report_type` varchar(100) DEFAULT NULL,
  `report_date` date DEFAULT NULL,
  `fk_staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_fname` varchar(100) DEFAULT NULL,
  `staff_lname` varchar(100) DEFAULT NULL,
  `staff_username` varchar(100) DEFAULT NULL,
  `staff_pwd` varchar(100) DEFAULT NULL,
  `staff_email` varchar(100) DEFAULT NULL,
  `staff_phone` varchar(20) DEFAULT NULL,
  `staff_nic` varchar(12) DEFAULT NULL,
  `staff_is_active` tinyint(1) DEFAULT 1,
  `staff_hire_date` date DEFAULT NULL,
  `staff_add_line1` varchar(255) DEFAULT NULL,
  `staff_add_line2` varchar(255) DEFAULT NULL,
  `staff_add_line3` varchar(255) DEFAULT NULL,
  `staff_add_line4` varchar(255) DEFAULT NULL,
  `fk_staff_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_fname`, `staff_lname`, `staff_username`, `staff_pwd`, `staff_email`, `staff_phone`, `staff_nic`, `staff_is_active`, `staff_hire_date`, `staff_add_line1`, `staff_add_line2`, `staff_add_line3`, `staff_add_line4`, `fk_staff_type_id`) VALUES
(1, 'Malindu', 'Dilakshana', 'Dila', '1234', 'malindudilak@gmail.com', '0770113944', '200133303039', 1, '2024-10-01', 'F02', 'sinha sewana ', 'noor road', 'Deraniyagala', 1001),
(2, 'Amesh', 'Darshana', 'amesh', 'amesh123', 'a@gmail.com', '0767868764', '200008182838', 1, '2024-10-07', 'lane3', 'galla road', 'ambalangoda', 'galla', 1004),
(3, 'Thejani', 'Pabasara', 'thejani', 'p123', 't@gmail.com', '0712582652', '200109122849', 1, '2024-10-07', 'B67', 'lane7', 'horana road', 'Piliyandala', 1002),
(4, 'Nipuna', 'Damsara', 'nipuna', 'n123', 'n@gmail.com', '0756680425', '2001111213', 1, '2024-10-07', 'A63', 'na sewana', 'rathnapura road', 'avissawella', 1003),
(5, 'parami', 'prabodha', 'parami', 'pasi123', 'psai@gmail.com', '0773918439', '180820041002', 1, '2024-10-07', 'Sinha sewana', 'Noori road', 'hambanawela', 'Deraniyagala', 1005),
(6, 'Chamod', 'Migara', 'chamod', 'C102030', 'c@gmail.com', '0775858658', '20010824', 0, '2024-10-07', 'B21', 'lane2', 'dehiovita road', 'avissawella', 1006),
(7, 'Shashila', 'Dulanjana', 'sashi', 's123', 's@gmail.com', '0772586721', '1999122150', 1, '2024-10-07', 'E01', 'sumana lane', 'rathnapura ', 'avissawella', 1006),
(8, 'Nethmi', 'Nawodya', 'nethmi', 'n123', 'nethmi@gmail.com', '0772564568', '200112162636', 1, '2024-10-07', 'G03', 'samagi lane', 'rathnapura road', 'avissawella', 1006),
(144, 'randima', 'dinuka', 'dinuka', 'd2024', 'dinuka@gmail.com', '0775858658', '200108258731', 0, '2024-10-13', 'B09', 'lane 07', 'muhandiram', 'Dera', 1001);

-- --------------------------------------------------------

--
-- Table structure for table `staff_type`
--

CREATE TABLE `staff_type` (
  `staff_type_id` int(11) NOT NULL,
  `staff_type_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_type`
--

INSERT INTO `staff_type` (`staff_type_id`, `staff_type_name`) VALUES
(1001, 'Admin'),
(1002, 'inventory manager'),
(1003, 'Delivery person '),
(1004, 'Cashier\r\n'),
(1005, 'Customer care'),
(1006, 'Designer');

-- --------------------------------------------------------

--
-- Table structure for table `user_loyalty`
--

CREATE TABLE `user_loyalty` (
  `loyalty_id` int(11) NOT NULL,
  `points` int(11) DEFAULT NULL,
  `loyalty_tier` varchar(100) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `fk_cust_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cancellation`
--
ALTER TABLE `cancellation`
  ADD PRIMARY KEY (`cancel_id`),
  ADD KEY `fk_order_id` (`fk_order_id`),
  ADD KEY `fk_staff_id` (`fk_staff_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_item_id` (`fk_item_id`),
  ADD KEY `fk_cust_id` (`fk_cust_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cost_parameter`
--
ALTER TABLE `cost_parameter`
  ADD PRIMARY KEY (`para_id`),
  ADD KEY `fk_staff_id` (`fk_staff_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `customization`
--
ALTER TABLE `customization`
  ADD PRIMARY KEY (`customization_id`),
  ADD KEY `fk_cust_id` (`fk_cust_id`),
  ADD KEY `fk_staff_id` (`fk_staff_id`);

--
-- Indexes for table `delivery_area`
--
ALTER TABLE `delivery_area`
  ADD PRIMARY KEY (`deliver_area_id`),
  ADD KEY `fk_staff_id` (`fk_staff_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`disc_id`),
  ADD KEY `fk_staff_id` (`fk_staff_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `fk_item_id` (`fk_item_id`),
  ADD KEY `fk_cust_id` (`fk_cust_id`),
  ADD KEY `fk_staff_id` (`fk_staff_id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`inquiry_id`),
  ADD KEY `fk_cust_id` (`fk_cust_id`),
  ADD KEY `fk_staff_id` (`fk_staff_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `fk_category_id` (`fk_category_id`) USING BTREE;

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_cust_id` (`fk_cust_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `fk_item_id` (`fk_item_id`),
  ADD KEY `fk_order_id` (`fk_order_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_customization_id` (`fk_customization_id`),
  ADD KEY `fk_order_id` (`fk_order_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `fk_item_id` (`fk_item_id`),
  ADD KEY `fk_cust_id` (`fk_cust_id`),
  ADD KEY `fk_staff_id` (`fk_staff_id`),
  ADD KEY `fk_order_id` (`fk_order_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `fk_staff_id` (`fk_staff_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `fk_staff_type_id` (`fk_staff_type_id`);

--
-- Indexes for table `staff_type`
--
ALTER TABLE `staff_type`
  ADD PRIMARY KEY (`staff_type_id`);

--
-- Indexes for table `user_loyalty`
--
ALTER TABLE `user_loyalty`
  ADD PRIMARY KEY (`loyalty_id`),
  ADD KEY `fk_cust_id` (`fk_cust_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cancellation`
--
ALTER TABLE `cancellation`
  MODIFY `cancel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4012;

--
-- AUTO_INCREMENT for table `cost_parameter`
--
ALTER TABLE `cost_parameter`
  MODIFY `para_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20048;

--
-- AUTO_INCREMENT for table `customization`
--
ALTER TABLE `customization`
  MODIFY `customization_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_area`
--
ALTER TABLE `delivery_area`
  MODIFY `deliver_area_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `disc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `inquiry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24020;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `staff_type`
--
ALTER TABLE `staff_type`
  MODIFY `staff_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;

--
-- AUTO_INCREMENT for table `user_loyalty`
--
ALTER TABLE `user_loyalty`
  MODIFY `loyalty_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cancellation`
--
ALTER TABLE `cancellation`
  ADD CONSTRAINT `cancellation_ibfk_1` FOREIGN KEY (`fk_order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cancellation_ibfk_2` FOREIGN KEY (`fk_staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`fk_item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_item_ibfk_3` FOREIGN KEY (`fk_cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cost_parameter`
--
ALTER TABLE `cost_parameter`
  ADD CONSTRAINT `cost_parameter_ibfk_1` FOREIGN KEY (`fk_staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customization`
--
ALTER TABLE `customization`
  ADD CONSTRAINT `customization_ibfk_1` FOREIGN KEY (`fk_cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customization_ibfk_2` FOREIGN KEY (`fk_staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivery_area`
--
ALTER TABLE `delivery_area`
  ADD CONSTRAINT `delivery_area_ibfk_1` FOREIGN KEY (`fk_staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`fk_staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_4` FOREIGN KEY (`fk_item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_5` FOREIGN KEY (`fk_cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_6` FOREIGN KEY (`fk_staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD CONSTRAINT `inquiry_ibfk_1` FOREIGN KEY (`fk_cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inquiry_ibfk_2` FOREIGN KEY (`fk_staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`fk_category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`fk_cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`fk_item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_3` FOREIGN KEY (`fk_order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`fk_customization_id`) REFERENCES `customization` (`customization_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`fk_order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_5` FOREIGN KEY (`fk_item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_6` FOREIGN KEY (`fk_cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_7` FOREIGN KEY (`fk_order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_8` FOREIGN KEY (`fk_staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`fk_staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`fk_staff_type_id`) REFERENCES `staff_type` (`staff_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_loyalty`
--
ALTER TABLE `user_loyalty`
  ADD CONSTRAINT `user_loyalty_ibfk_1` FOREIGN KEY (`fk_cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jul 03, 2024 at 10:00 PM
-- Server version: 8.4.0
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wordpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `department` (
  `id` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `manager` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `department` (`id`, `name`, `description`, `manager`, `date_created`) VALUES
(1, 'Human Resources', 'Handles recruitment, employee relations, and training.', 'Alice Smith', '2024-07-03 21:50:00'),
(2, 'Finance', 'Responsible for financial planning and record-keeping.', 'Bob Johnson', '2024-07-03 21:50:00'),
(3, 'IT', 'Manages technology and systems.', 'Charlie Brown', '2024-07-03 21:50:00'),
(4, 'Marketing', 'Focuses on advertising and promotions.', 'Diana Prince', '2024-07-03 21:50:00'),
(5, 'Operations', 'Ensures smooth business operations.', 'Evan Davis', '2024-07-03 21:50:00'),
(6, 'Sales', 'Drives revenue through customer acquisition.', 'Fiona Hill', '2024-07-03 21:50:00'),
(7, 'Customer Service', 'Handles customer inquiries and support.', 'George King', '2024-07-03 21:50:00'),
(8, 'Research & Development', 'Works on innovative projects and new product development.', 'Hannah Scott', '2024-07-03 21:50:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

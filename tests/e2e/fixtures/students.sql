-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jul 03, 2024 at 09:50 PM
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
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `age`, `sex`, `email_address`, `date_created`) VALUES
(1, 'Alice Smith', '20', 'Female', 'alice.smith@example.com', '2024-07-03 21:45:23'),
(2, 'Bob Johnson', '21', 'Male', 'bob.johnson@example.com', '2024-07-03 21:45:23'),
(3, 'Charlie Brown', '22', 'Male', 'charlie.brown@example.com', '2024-07-03 21:45:23'),
(4, 'Diana Prince', '23', 'Female', 'diana.prince@example.com', '2024-07-03 21:45:23'),
(5, 'Evan Davis', '24', 'Male', 'evan.davis@example.com', '2024-07-03 21:45:23'),
(6, 'Fiona Hill', '25', 'Female', 'fiona.hill@example.com', '2024-07-03 21:45:23'),
(7, 'George King', '26', 'Male', 'george.king@example.com', '2024-07-03 21:45:23'),
(8, 'Hannah Scott', '27', 'Female', 'hannah.scott@example.com', '2024-07-03 21:45:23'),
(9, 'Ian Walker', '28', 'Male', 'ian.walker@example.com', '2024-07-03 21:45:23'),
(10, 'Jenna White', '29', 'Female', 'jenna.white@example.com', '2024-07-03 21:45:23'),
(11, 'Kyle Adams', '30', 'Male', 'kyle.adams@example.com', '2024-07-03 21:45:23'),
(12, 'Laura Clark', '31', 'Female', 'laura.clark@example.com', '2024-07-03 21:45:23'),
(13, 'Mike Evans', '32', 'Male', 'mike.evans@example.com', '2024-07-03 21:45:23'),
(14, 'Nina Harris', '33', 'Female', 'nina.harris@example.com', '2024-07-03 21:45:23'),
(15, 'Oscar Lewis', '34', 'Male', 'oscar.lewis@example.com', '2024-07-03 21:45:23'),
(16, 'Paula Young', '35', 'Female', 'paula.young@example.com', '2024-07-03 21:45:23'),
(17, 'Quinn Allen', '36', 'Male', 'quinn.allen@example.com', '2024-07-03 21:45:23'),
(18, 'Rachel Martinez', '37', 'Female', 'rachel.martinez@example.com', '2024-07-03 21:45:23'),
(19, 'Sam Baker', '38', 'Male', 'sam.baker@example.com', '2024-07-03 21:45:23'),
(20, 'Tina Green', '39', 'Female', 'tina.green@example.com', '2024-07-03 21:45:23'),
(21, 'Umar Nelson', '40', 'Male', 'umar.nelson@example.com', '2024-07-03 21:45:23'),
(22, 'Vera Carter', '41', 'Female', 'vera.carter@example.com', '2024-07-03 21:45:23'),
(23, 'Will Rivera', '42', 'Male', 'will.rivera@example.com', '2024-07-03 21:45:23'),
(24, 'Xena Phillips', '43', 'Female', 'xena.phillips@example.com', '2024-07-03 21:45:23'),
(25, 'Yuri Turner', '44', 'Male', 'yuri.turner@example.com', '2024-07-03 21:45:23'),
(26, 'Zara Collins', '45', 'Female', 'zara.collins@example.com', '2024-07-03 21:45:23'),
(27, 'Alex Morgan', '46', 'Male', 'alex.morgan@example.com', '2024-07-03 21:45:23'),
(28, 'Beth Cooper', '47', 'Female', 'beth.cooper@example.com', '2024-07-03 21:45:23'),
(29, 'Chris Reed', '48', 'Male', 'chris.reed@example.com', '2024-07-03 21:45:23'),
(30, 'Dana Ward', '49', 'Female', 'dana.ward@example.com', '2024-07-03 21:45:23'),
(31, 'Eli Perry', '50', 'Male', 'eli.perry@example.com', '2024-07-03 21:45:23'),
(32, 'Faith Lee', '51', 'Female', 'faith.lee@example.com', '2024-07-03 21:45:23'),
(33, 'Gabe Brooks', '52', 'Male', 'gabe.brooks@example.com', '2024-07-03 21:45:23'),
(34, 'Holly Rogers', '53', 'Female', 'holly.rogers@example.com', '2024-07-03 21:45:23'),
(35, 'Ivan Price', '54', 'Male', 'ivan.price@example.com', '2024-07-03 21:45:23'),
(36, 'Jill Cooper', '55', 'Female', 'jill.cooper@example.com', '2024-07-03 21:45:23'),
(37, 'Kylee Foster', '56', 'Female', 'kylee.foster@example.com', '2024-07-03 21:45:23'),
(38, 'Liam Gray', '57', 'Male', 'liam.gray@example.com', '2024-07-03 21:45:23'),
(39, 'Mona Jenkins', '58', 'Female', 'mona.jenkins@example.com', '2024-07-03 21:45:23'),
(40, 'Nick Lee', '59', 'Male', 'nick.lee@example.com', '2024-07-03 21:45:23'),
(41, 'Olga Romero', '60', 'Female', 'olga.romero@example.com', '2024-07-03 21:45:23'),
(42, 'Paul Steele', '61', 'Male', 'paul.steele@example.com', '2024-07-03 21:45:23'),
(43, 'Quincy Diaz', '62', 'Male', 'quincy.diaz@example.com', '2024-07-03 21:45:23'),
(44, 'Rita Walsh', '63', 'Female', 'rita.walsh@example.com', '2024-07-03 21:45:23'),
(45, 'Steve Hunter', '64', 'Male', 'steve.hunter@example.com', '2024-07-03 21:45:23'),
(46, 'Tara Edwards', '65', 'Female', 'tara.edwards@example.com', '2024-07-03 21:45:23'),
(47, 'Uma Graham', '66', 'Female', 'uma.graham@example.com', '2024-07-03 21:45:23'),
(48, 'Avery Johnson', '22', 'Female', 'avery.johnson@example.com', '2024-07-03 21:47:02'),
(49, 'Blake Roberts', '23', 'Male', 'blake.roberts@example.com', '2024-07-03 21:47:02'),
(50, 'Casey Wright', '24', 'Non-binary', 'casey.wright@example.com', '2024-07-03 21:47:02'),
(51, 'Drew Lewis', '25', 'Male', 'drew.lewis@example.com', '2024-07-03 21:47:02'),
(52, 'Emery Walker', '26', 'Female', 'emery.walker@example.com', '2024-07-03 21:47:02'),
(53, 'Finley Hall', '27', 'Non-binary', 'finley.hall@example.com', '2024-07-03 21:47:02'),
(54, 'Gray Morgan', '28', 'Male', 'gray.morgan@example.com', '2024-07-03 21:47:02'),
(55, 'Harper King', '29', 'Female', 'harper.king@example.com', '2024-07-03 21:47:02'),
(56, 'Jordan Clark', '30', 'Non-binary', 'jordan.clark@example.com', '2024-07-03 21:47:02'),
(57, 'Kai Allen', '31', 'Male', 'kai.allen@example.com', '2024-07-03 21:47:02'),
(58, 'Lane Baker', '32', 'Female', 'lane.baker@example.com', '2024-07-03 21:47:02'),
(59, 'Mason Edwards', '33', 'Male', 'mason.edwards@example.com', '2024-07-03 21:47:02'),
(60, 'Nico Brooks', '34', 'Non-binary', 'nico.brooks@example.com', '2024-07-03 21:47:02'),
(61, 'Oakley Reed', '35', 'Female', 'oakley.reed@example.com', '2024-07-03 21:47:02'),
(62, 'Peyton Young', '36', 'Male', 'peyton.young@example.com', '2024-07-03 21:47:02'),
(63, 'Quinn James', '37', 'Non-binary', 'quinn.james@example.com', '2024-07-03 21:47:02'),
(64, 'Riley Adams', '38', 'Female', 'riley.adams@example.com', '2024-07-03 21:47:02'),
(65, 'Sawyer Parker', '39', 'Male', 'sawyer.parker@example.com', '2024-07-03 21:47:02'),
(66, 'Taylor Harris', '40', 'Non-binary', 'taylor.harris@example.com', '2024-07-03 21:47:02'),
(67, 'Uriah Carter', '41', 'Female', 'uriah.carter@example.com', '2024-07-03 21:47:02'),
(68, 'Vivian Nelson', '42', 'Male', 'vivian.nelson@example.com', '2024-07-03 21:47:02'),
(69, 'Wren Rivera', '43', 'Non-binary', 'wren.rivera@example.com', '2024-07-03 21:47:02'),
(70, 'Xander Phillips', '44', 'Male', 'xander.phillips@example.com', '2024-07-03 21:47:02'),
(71, 'Yael Turner', '45', 'Female', 'yael.turner@example.com', '2024-07-03 21:47:02'),
(72, 'Zion Collins', '46', 'Non-binary', 'zion.collins@example.com', '2024-07-03 21:47:02'),
(73, 'Addison Morgan', '47', 'Female', 'addison.morgan@example.com', '2024-07-03 21:47:02'),
(74, 'Blair Cooper', '48', 'Male', 'blair.cooper@example.com', '2024-07-03 21:47:02'),
(75, 'Cameron Reed', '49', 'Non-binary', 'cameron.reed@example.com', '2024-07-03 21:47:02'),
(76, 'Dakota Ward', '50', 'Female', 'dakota.ward@example.com', '2024-07-03 21:47:02'),
(77, 'Emerson Perry', '51', 'Male', 'emerson.perry@example.com', '2024-07-03 21:47:02'),
(78, 'Frankie Lee', '52', 'Non-binary', 'frankie.lee@example.com', '2024-07-03 21:47:02'),
(79, 'Gray Brooks', '53', 'Female', 'gray.brooks@example.com', '2024-07-03 21:47:02'),
(80, 'Harley Rogers', '54', 'Male', 'harley.rogers@example.com', '2024-07-03 21:47:02'),
(81, 'Indigo Price', '55', 'Non-binary', 'indigo.price@example.com', '2024-07-03 21:47:02'),
(82, 'Jesse Cooper', '56', 'Female', 'jesse.cooper@example.com', '2024-07-03 21:47:02'),
(83, 'Kelly Foster', '57', 'Male', 'kelly.foster@example.com', '2024-07-03 21:47:02'),
(84, 'Linden Gray', '58', 'Non-binary', 'linden.gray@example.com', '2024-07-03 21:47:02'),
(85, 'Morgan Jenkins', '59', 'Female', 'morgan.jenkins@example.com', '2024-07-03 21:47:02'),
(86, 'Nova Lee', '60', 'Male', 'nova.lee@example.com', '2024-07-03 21:47:02'),
(87, 'Oakley Romero', '61', 'Non-binary', 'oakley.romero@example.com', '2024-07-03 21:47:02'),
(88, 'Parker Steele', '62', 'Female', 'parker.steele@example.com', '2024-07-03 21:47:02'),
(89, 'Quinn Diaz', '63', 'Male', 'quinn.diaz@example.com', '2024-07-03 21:47:02'),
(90, 'Reese Walsh', '64', 'Non-binary', 'reese.walsh@example.com', '2024-07-03 21:47:02'),
(91, 'Skylar Hunter', '65', 'Female', 'skylar.hunter@example.com', '2024-07-03 21:47:02'),
(92, 'Tatum Edwards', '66', 'Male', 'tatum.edwards@example.com', '2024-07-03 21:47:02'),
(93, 'Urban Graham', '67', 'Non-binary', 'urban.graham@example.com', '2024-07-03 21:47:02'),
(94, 'Vega Allen', '68', 'Female', 'vega.allen@example.com', '2024-07-03 21:47:02'),
(95, 'Wynn Martinez', '69', 'Male', 'wynn.martinez@example.com', '2024-07-03 21:47:02'),
(96, 'Xan Baker', '70', 'Non-binary', 'xan.baker@example.com', '2024-07-03 21:47:02'),
(97, 'Aiden Brown', '20', 'Male', 'aiden.brown@example.com', '2024-07-03 21:49:05'),
(98, 'Bella Wilson', '21', 'Female', 'bella.wilson@example.com', '2024-07-03 21:49:05'),
(99, 'Carter Jones', '22', 'Male', 'carter.jones@example.com', '2024-07-03 21:49:05'),
(100, 'Daisy Miller', '23', 'Female', 'daisy.miller@example.com', '2024-07-03 21:49:05'),
(101, 'Ethan Davis', '24', 'Male', 'ethan.davis@example.com', '2024-07-03 21:49:05'),
(102, 'Fiona Garcia', '25', 'Female', 'fiona.garcia@example.com', '2024-07-03 21:49:05'),
(103, 'Grayson Martinez', '26', 'Male', 'grayson.martinez@example.com', '2024-07-03 21:49:05'),
(104, 'Hannah Rodriguez', '27', 'Female', 'hannah.rodriguez@example.com', '2024-07-03 21:49:05'),
(105, 'Isaac Hernandez', '28', 'Male', 'isaac.hernandez@example.com', '2024-07-03 21:49:05'),
(106, 'Jasmine Lopez', '29', 'Female', 'jasmine.lopez@example.com', '2024-07-03 21:49:05'),
(107, 'Kayden Gonzalez', '30', 'Male', 'kayden.gonzalez@example.com', '2024-07-03 21:49:05'),
(108, 'Lily Wilson', '31', 'Female', 'lily.wilson@example.com', '2024-07-03 21:49:05'),
(109, 'Mason Moore', '32', 'Male', 'mason.moore@example.com', '2024-07-03 21:49:05'),
(110, 'Nora Taylor', '33', 'Female', 'nora.taylor@example.com', '2024-07-03 21:49:05'),
(111, 'Owen Anderson', '34', 'Male', 'owen.anderson@example.com', '2024-07-03 21:49:05'),
(112, 'Piper Thomas', '35', 'Female', 'piper.thomas@example.com', '2024-07-03 21:49:05'),
(113, 'Quinn Jackson', '36', 'Male', 'quinn.jackson@example.com', '2024-07-03 21:49:05'),
(114, 'Ruby White', '37', 'Female', 'ruby.white@example.com', '2024-07-03 21:49:05'),
(115, 'Sebastian Harris', '38', 'Male', 'sebastian.harris@example.com', '2024-07-03 21:49:05'),
(116, 'Tessa Martin', '39', 'Female', 'tessa.martin@example.com', '2024-07-03 21:49:05'),
(117, 'Ulysses Thompson', '40', 'Male', 'ulysses.thompson@example.com', '2024-07-03 21:49:05'),
(118, 'Violet Martinez', '41', 'Female', 'violet.martinez@example.com', '2024-07-03 21:49:05'),
(119, 'Wyatt Robinson', '42', 'Male', 'wyatt.robinson@example.com', '2024-07-03 21:49:05'),
(120, 'Xenia Clark', '43', 'Female', 'xenia.clark@example.com', '2024-07-03 21:49:05'),
(121, 'Yara Lewis', '44', 'Female', 'yara.lewis@example.com', '2024-07-03 21:49:05'),
(122, 'Zane Lee', '45', 'Male', 'zane.lee@example.com', '2024-07-03 21:49:05'),
(123, 'Amelia Young', '46', 'Female', 'amelia.young@example.com', '2024-07-03 21:49:05'),
(124, 'Benjamin Hall', '47', 'Male', 'benjamin.hall@example.com', '2024-07-03 21:49:05'),
(125, 'Charlotte King', '48', 'Female', 'charlotte.king@example.com', '2024-07-03 21:49:05'),
(126, 'Daniel Wright', '49', 'Male', 'daniel.wright@example.com', '2024-07-03 21:49:05'),
(127, 'Evelyn Scott', '50', 'Female', 'evelyn.scott@example.com', '2024-07-03 21:49:05'),
(128, 'Finn Green', '51', 'Male', 'finn.green@example.com', '2024-07-03 21:49:05'),
(129, 'Grace Baker', '52', 'Female', 'grace.baker@example.com', '2024-07-03 21:49:05'),
(130, 'Henry Adams', '53', 'Male', 'henry.adams@example.com', '2024-07-03 21:49:05'),
(131, 'Isla Nelson', '54', 'Female', 'isla.nelson@example.com', '2024-07-03 21:49:05'),
(132, 'Jack Carter', '55', 'Male', 'jack.carter@example.com', '2024-07-03 21:49:05'),
(133, 'Kennedy Walker', '56', 'Female', 'kennedy.walker@example.com', '2024-07-03 21:49:05'),
(134, 'Liam Rivera', '57', 'Male', 'liam.rivera@example.com', '2024-07-03 21:49:05'),
(135, 'Mia Campbell', '58', 'Female', 'mia.campbell@example.com', '2024-07-03 21:49:05'),
(136, 'Noah Brooks', '59', 'Male', 'noah.brooks@example.com', '2024-07-03 21:49:05'),
(137, 'Olivia Sanders', '60', 'Female', 'olivia.sanders@example.com', '2024-07-03 21:49:05'),
(138, 'Parker Price', '61', 'Male', 'parker.price@example.com', '2024-07-03 21:49:05'),
(139, 'Quincy Reed', '62', 'Male', 'quincy.reed@example.com', '2024-07-03 21:49:05'),
(140, 'Riley Cook', '63', 'Female', 'riley.cook@example.com', '2024-07-03 21:49:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

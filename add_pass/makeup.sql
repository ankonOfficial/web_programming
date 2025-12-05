-- phpMyAdmin SQL Dump
-- version 5.2.1
--
-- Host: 127.0.0.1
-- Database: `makeup`
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `pass` varchar(255) NOT NULL,
  `random_number` varchar(64) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `name`, `date`, `pass`, `random_number`) VALUES
(1, 'Nasir Uddin Ahmed', '2025-08-18', 'password1', '8f494b900ab833220f152db9a8b3a5c3280e2d63021a3ecfa26dcc98ddb2d307'),
(2, 'Web Lab Final', '2025-08-19', 'password2', '597a52ea898efed9c582a9d26c327a42c091388af0cba6897d0f919b23ec24ce'),
(3, 'Web Lab Final', '2025-08-19', 'password3', '597a52ea898efed9c582a9d26c327a42c091388af0cba6897d0f919b23ec24ce');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@OLD_COLLATION_CONNECTION */;

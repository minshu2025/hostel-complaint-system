-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 04, 2026 at 06:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `priority` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `admin_reply` text DEFAULT NULL,
  `is_seen` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `student_id`, `category`, `priority`, `description`, `status`, `admin_reply`, `is_seen`, `created_at`, `remarks`) VALUES
(1, 1, 'Water', 'High', 'Water logging near toilet side', 'Pending', NULL, 0, '2026-05-04 07:45:21', 'I will inform cleaning staff'),
(2, 3, 'WiFi', 'High', 'My internet not proper working', 'In Progress', NULL, 0, '2026-05-04 09:01:07', 'I will inform electrician  they will in within 2 hours'),
(3, 4, 'Room', 'High', 'jhjfhffgh', 'In Progress', NULL, 0, '2026-05-04 09:09:11', 'jcgjd'),
(4, 4, 'Electricity', 'Low', 'hgdhyd', 'Pending', NULL, 0, '2026-05-04 09:13:07', NULL),
(5, 2, 'Water', 'Medium', 'jfjjfjh', 'Pending', NULL, 0, '2026-05-04 09:13:51', NULL),
(6, 2, 'Water', 'Medium', 'jfjjfjh', 'Pending', NULL, 0, '2026-05-04 09:14:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `course` varchar(50) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `room_no` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `contact`, `course`, `year`, `branch`, `room_no`, `created_at`) VALUES
(1, 'Minshu Kumar', 'dubeyminshu4@gmail.com', '$2y$10$TY/8Hf5lsZlVwO1uFGgmWOHxFBQM7scl6M3cx349.4yJ9zVwIN/Wm', 'student', '8210430216', 'mca', '1', 'mca', '204', '2026-05-04 07:44:56'),
(2, 'Virendra Singh', 'singhvirendra@Ipec.com', '$2y$10$zCjSwWWCTcihpNbZZcROceZeOnK.PQBsCQpENEbCRUi6RhdUiKci.', 'admin', '', '', '', '', '', '2026-05-04 07:52:10'),
(3, 'Palak', 'palak@gmail.com', '$2y$10$39kQGdWDJwV4cJ2hlJ0zWOVWl5Ld6woHawC7ZUxgWRxvAltb1c5DS', 'student', '1234567896', 'mca', '1', 'mca', '204', '2026-05-04 08:59:28'),
(4, 'Saurabh Anand', 'saurabh123@gmail.com', '$2y$10$eSBkv12cYgDc02byE6vFHez7UJf1Z1TxJPujuhNi/2YU6pkWjpHqW', 'student', '1234567894', 'MCA', '1', 'MCA', '314', '2026-05-04 09:07:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

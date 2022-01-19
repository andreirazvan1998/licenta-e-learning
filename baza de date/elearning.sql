-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2020 at 12:05 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ad_id` int(3) NOT NULL,
  `ad_username` varchar(255) NOT NULL,
  `ad_password` varchar(255) NOT NULL,
  `ad_date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ad_date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ad_id`, `ad_username`, `ad_password`, `ad_date_add`, `ad_date_modified`) VALUES
(2, 'admin', '7de22f3660dee603cb86c47213c5423961657e4c', '2019-12-28 23:33:21', '2019-12-28 23:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `crs_id` int(8) NOT NULL,
  `crs_title` varchar(255) NOT NULL,
  `crs_description` varchar(255) NOT NULL,
  `crs_order` int(3) NOT NULL,
  `crs_points` int(6) NOT NULL DEFAULT '0',
  `crs_course` varchar(255) NOT NULL,
  `crs_date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `crs_date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`crs_id`, `crs_title`, `crs_description`, `crs_order`, `crs_points`, `crs_course`, `crs_date_add`, `crs_date_modified`) VALUES
(1, 'sql basics', 'SQL (de la numele englez Structured Query Language - limbaj de interogare structurat - care se pronunță [es kiu el]) este un limbaj de programare specific pentru manipularea datelor în sistemele de manipulare a bazelor de date relaționale (RDBMS), iar la ', 1, 100, 'sqlBasics.pdf', '2020-04-24 21:06:52', '2020-07-03 18:36:01'),
(5, 'sql intermediate', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 2, 100, 'ceva.pdf', '2020-06-19 15:19:25', '2020-07-03 18:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `courses_exercises`
--

CREATE TABLE `courses_exercises` (
  `cx_id` int(8) NOT NULL,
  `cx_crs_id` int(8) NOT NULL DEFAULT '0',
  `cx_subject` varchar(255) NOT NULL,
  `cx_solution` mediumtext NOT NULL,
  `cx_path` varchar(255) DEFAULT NULL,
  `cx_date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cx_date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cx_points` int(6) NOT NULL DEFAULT '0',
  `cx_mock_txt` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses_exercises`
--

INSERT INTO `courses_exercises` (`cx_id`, `cx_crs_id`, `cx_subject`, `cx_solution`, `cx_path`, `cx_date_add`, `cx_date_modified`, `cx_points`, `cx_mock_txt`) VALUES
(1, 1, 'Selecteaza angajatul din tabela customers al carui CustomerNumber este 103', '5e3d3142e90799c56400486a9fad398c8573c837', NULL, '2020-06-16 19:29:36', '2020-07-03 18:43:07', 100, 'select ... from ... where ...'),
(2, 1, 'Selecteaza toate informatiile din tabelul customers ceva', '09891952257f310d6eca14315ecf2b9ea15a4b32', NULL, '2020-07-03 19:05:40', '2020-07-04 21:48:10', 10, 'select .. from ..');

-- --------------------------------------------------------

--
-- Table structure for table `courses_items`
--

CREATE TABLE `courses_items` (
  `cit_id` int(8) NOT NULL,
  `cit_crs_id` int(8) NOT NULL DEFAULT '0',
  `cit_title` varchar(255) NOT NULL,
  `cit_content` varchar(255) NOT NULL,
  `cit_path` varchar(255) DEFAULT NULL,
  `cit_date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cit_date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses_quizz`
--

CREATE TABLE `courses_quizz` (
  `cqz_id` int(8) NOT NULL,
  `cqz_cit_id` int(8) NOT NULL DEFAULT '0',
  `cqz_subject` varchar(255) NOT NULL COMMENT 'Titlu intrebare',
  `cqz_solution` mediumtext NOT NULL,
  `cqz_path` varchar(255) DEFAULT NULL,
  `cqz_date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cqz_date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cqz_points` int(6) NOT NULL DEFAULT '0',
  `cqz_mock_txt` mediumtext NOT NULL COMMENT 'Enunt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `docker_containers`
--

CREATE TABLE `docker_containers` (
  `dck_id` int(8) NOT NULL,
  `dck_name` varchar(255) NOT NULL,
  `dck_used` int(1) NOT NULL DEFAULT '0',
  `dck_date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dck_date_edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dck_port` int(5) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `docker_containers`
--

INSERT INTO `docker_containers` (`dck_id`, `dck_name`, `dck_used`, `dck_date_add`, `dck_date_edit`, `dck_port`) VALUES
(1, 'client2', 1, '2020-03-05 19:13:04', '2020-07-02 18:13:37', 8083),
(2, 'client1', 1, '2020-03-05 19:13:04', '2020-06-06 15:40:02', 8080),
(3, 'client3', 1, '2020-06-22 13:12:02', '2020-07-04 21:28:37', 8084),
(4, 'client4', 1, '2020-06-22 13:12:15', '2020-07-04 21:41:47', 8085),
(5, 'client5', 1, '2020-06-22 13:12:42', '2020-07-04 21:45:01', 8082),
(6, 'client6', 1, '2020-06-22 13:12:59', '2020-07-04 21:46:00', 8086),
(7, 'client7', 1, '2020-06-22 13:13:11', '2020-07-04 21:47:37', 8087),
(8, 'client8', 0, '2020-06-22 13:13:22', '2020-06-22 13:13:22', 8088);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usr_id` int(3) NOT NULL,
  `usr_username` varchar(255) NOT NULL,
  `usr_password` varchar(255) NOT NULL,
  `usr_date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usr_date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usr_name` varchar(255) DEFAULT NULL,
  `usr_email` varchar(255) DEFAULT NULL,
  `usr_dck_id` int(8) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `usr_username`, `usr_password`, `usr_date_add`, `usr_date_modified`, `usr_name`, `usr_email`, `usr_dck_id`) VALUES
(37, 'andreirazvan', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '2020-07-01 13:29:56', '2020-07-03 18:57:05', 'andreii', 'andrei.razvan52@yahoo.com', 1),
(40, 'andreirazvan52', '7de22f3660dee603cb86c47213c5423961657e4c', '2020-07-02 18:13:37', '2020-07-03 18:57:00', 'Bolboceanu Andrei', 'andrei.razvan52@yahoo.com', 2),
(41, 'andreirazvan5', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2020-07-04 21:28:37', '2020-07-04 21:28:37', 'Bolboceanu Andrei', 'andrei.razvan52@yahoo.com', 3),
(42, 'zoli', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2020-07-04 21:41:47', '2020-07-04 21:41:47', 'Bolboceanu Andrei', 'andrei.razvan52@yahoo.com', 4),
(43, 'user5', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2020-07-04 21:45:01', '2020-07-04 21:45:01', 'Bolboceanu Andrei', 'andrei.razvan52@yahoo.com', 5),
(44, 'user6', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2020-07-04 21:46:00', '2020-07-04 21:46:00', 'Bolboceanu Andrei', 'andrei.razvan52@yahoo.com', 6),
(45, 'user7', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2020-07-04 21:47:37', '2020-07-04 21:47:37', 'Bolboceanu Andrei', 'andrei.razvan52@yahoo.com', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users_courses`
--

CREATE TABLE `users_courses` (
  `uscr_id` int(8) NOT NULL,
  `uscr_usr_id` int(8) NOT NULL DEFAULT '0',
  `uscr_crs_id` int(8) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_courses`
--

INSERT INTO `users_courses` (`uscr_id`, `uscr_usr_id`, `uscr_crs_id`) VALUES
(6, 3, 1),
(7, 3, 5),
(25, 40, 5),
(26, 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_courses_exercises`
--

CREATE TABLE `users_courses_exercises` (
  `ucx_id` int(8) NOT NULL,
  `ucx_usr_id` int(8) NOT NULL DEFAULT '0',
  `ucx_cx_id` int(8) NOT NULL DEFAULT '0',
  `ucx_date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ucx_date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users_courses_items`
--

CREATE TABLE `users_courses_items` (
  `uct_id` int(8) NOT NULL,
  `uct_usr_id` int(8) NOT NULL DEFAULT '0',
  `uct_crs_id` int(8) NOT NULL DEFAULT '0',
  `uct_date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uct_date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`crs_id`);

--
-- Indexes for table `courses_exercises`
--
ALTER TABLE `courses_exercises`
  ADD PRIMARY KEY (`cx_id`);

--
-- Indexes for table `courses_items`
--
ALTER TABLE `courses_items`
  ADD PRIMARY KEY (`cit_id`);

--
-- Indexes for table `courses_quizz`
--
ALTER TABLE `courses_quizz`
  ADD PRIMARY KEY (`cqz_id`);

--
-- Indexes for table `docker_containers`
--
ALTER TABLE `docker_containers`
  ADD PRIMARY KEY (`dck_id`),
  ADD UNIQUE KEY `dck_port` (`dck_port`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`);

--
-- Indexes for table `users_courses`
--
ALTER TABLE `users_courses`
  ADD PRIMARY KEY (`uscr_id`);

--
-- Indexes for table `users_courses_exercises`
--
ALTER TABLE `users_courses_exercises`
  ADD PRIMARY KEY (`ucx_id`);

--
-- Indexes for table `users_courses_items`
--
ALTER TABLE `users_courses_items`
  ADD PRIMARY KEY (`uct_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ad_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `crs_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses_exercises`
--
ALTER TABLE `courses_exercises`
  MODIFY `cx_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `courses_items`
--
ALTER TABLE `courses_items`
  MODIFY `cit_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses_quizz`
--
ALTER TABLE `courses_quizz`
  MODIFY `cqz_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `docker_containers`
--
ALTER TABLE `docker_containers`
  MODIFY `dck_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users_courses`
--
ALTER TABLE `users_courses`
  MODIFY `uscr_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users_courses_exercises`
--
ALTER TABLE `users_courses_exercises`
  MODIFY `ucx_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_courses_items`
--
ALTER TABLE `users_courses_items`
  MODIFY `uct_id` int(8) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

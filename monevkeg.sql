-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2017 at 05:52 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 5.6.31-6+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monevkeg`
--

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `gender_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `gender_name`) VALUES
(1, 'male'),
(2, 'female');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1436495090),
('m130524_201442_init', 1436495111);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` text,
  `last_name` text,
  `birthdate` date DEFAULT NULL,
  `gender_id` smallint(5) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `first_name`, `last_name`, `birthdate`, `gender_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Yasrul', 'Abdullah', '1974-02-03', 1, '2015-07-30 16:21:39', '2015-07-30 16:21:39'),
(2, 3, 'Abdullah', 'Rawahah', '1979-05-16', 1, '2015-07-30 16:23:56', '2015-07-30 16:23:56'),
(3, 4, 'Fatimah', 'Sholihah', '1978-05-17', 2, '2015-07-30 16:25:15', '2015-07-30 16:25:15'),
(4, 5, 'Hamzah', 'Namira', '1980-08-27', 1, '2015-08-03 09:51:06', '2015-08-03 09:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` smallint(6) NOT NULL,
  `role_name` varchar(45) NOT NULL,
  `role_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`, `role_value`) VALUES
(1, 'User', 10),
(2, 'Operator', 20),
(3, 'AdminSystem', 30);

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `id` smallint(6) NOT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `id_induk` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`id`, `unit_kerja`, `id_induk`) VALUES
(1, 'Provinsi NTB', 0),
(2, 'Sekretariat Daerah', 1),
(3, 'Biro Umum', 2),
(4, 'Biro Organisasi', 2),
(5, 'Dinas Kominfotik', 1),
(6, 'Bagian Keuangan', 3),
(7, 'Bagian Rumah Tangga', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_id` smallint(6) NOT NULL,
  `role_id` smallint(6) NOT NULL,
  `status_id` smallint(6) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `unit_id`, `role_id`, `status_id`, `created_at`, `updated_at`) VALUES
(2, 'yasrul', 'UqzdPXfxR1V_AsgDagf2BGnTjsBGrJDQ', '$2y$13$uh7OXxGwgwHgkicXhO3tfex7IOimuILC2s.WgdfrqwENDjR6n099G', NULL, 'yasrul93@gmail.com', 3, 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'amiruddin', 'IvGFzQ3uvJPi_P3JmqKEXdK0V9YYF7St', '$2y$13$ArWhFm0bGSl9jpZF/xIH1.hqboi..Fi0/oz59JQXnkl4OyArqWzA.', NULL, 'amir@ntbprov.go.id', 3, 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Administrator', 'N5yGLBNsIa7oyk35Eq3wiBfZW9cq0Ynp', '$2y$13$QjgGiHcANDFYU5bURinx0Oj3fLE7mLFp9cVyLkAc5w39Kd72IS.xu', NULL, 'yasrul@gmail.com', 5, 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'abdullah', '6URjxAyu8dR9n9x_5JYnc68Im6eKhMoY', '$2y$13$xx87TaYGKgmA.ZRRSvUDEuhWtyo9Qs1NyHe4WYKl8buRmZ6v1Og3y', NULL, 'abdullah@gmail.com', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gender_id_idx` (`gender_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `gender_id_fk` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

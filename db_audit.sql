-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2023 at 11:07 AM
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
-- Database: `db_audit`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area`
--

CREATE TABLE `tbl_area` (
  `id_area` int(8) NOT NULL,
  `nama_area` varchar(255) NOT NULL,
  `id_category` int(8) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_area`
--

INSERT INTO `tbl_area` (`id_area`, `nama_area`, `id_category`, `created_at`, `updated_at`) VALUES
(1, 'verification', 1, '2023-02-26 00:32:04', '2023-02-26 00:32:04'),
(2, 'Incoming Material', 1, '2023-02-26 00:32:35', '2023-02-26 00:32:35'),
(5, 'Warehouse', 1, '2023-02-26 00:55:45', '2023-02-26 00:55:45'),
(6, 'Chemical', 1, '2023-02-26 00:56:06', '2023-02-26 00:56:06'),
(8, 'Preparation Material', 1, '2023-02-26 00:57:02', '2023-02-26 00:57:02'),
(9, 'Rolling Material', 1, '2023-02-26 00:57:16', '2023-02-26 00:57:16'),
(12, 'Cutting Material', 1, '2023-02-26 00:57:46', '2023-02-26 00:57:46'),
(13, 'Molding Area', 1, '2023-02-26 00:58:33', '2023-02-26 00:58:33'),
(14, 'Second Curing Oven', 1, '2023-02-26 00:59:24', '2023-02-26 00:59:24'),
(15, 'Carbon Printing', 1, '2023-02-26 01:00:23', '2023-02-26 01:00:45'),
(16, 'Oven Carbon/OY Printing', 1, '2023-02-26 01:01:08', '2023-02-26 01:05:23'),
(17, 'Middle Inspection Process', 1, '2023-02-26 01:04:05', '2023-02-26 01:04:05'),
(18, 'Punching', 1, '2023-02-26 01:04:24', '2023-02-26 01:06:45'),
(19, 'Resistance Pill', 1, '2023-02-26 01:06:59', '2023-02-26 01:06:59'),
(20, 'Inspection', 1, '2023-02-26 01:07:39', '2023-02-26 01:07:39'),
(21, 'Guarantee Inspection', 1, '2023-02-26 01:08:18', '2023-02-26 01:08:18'),
(22, 'Packing Area', 1, '2023-02-26 01:08:34', '2023-02-26 01:08:34'),
(23, 'GI Shipping', 1, '2023-02-26 01:08:49', '2023-02-26 01:08:49'),
(24, 'Shipping', 1, '2023-02-26 01:09:02', '2023-02-26 01:09:02'),
(25, 'Dimension & Force', 1, '2023-02-26 01:09:54', '2023-02-26 01:09:54'),
(26, 'Paciking Label Verification', 1, '2023-02-26 01:10:21', '2023-02-26 01:10:21'),
(27, 'system', 2, '2023-02-26 02:26:21', '2023-02-26 02:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit`
--

CREATE TABLE `tbl_audit` (
  `id_audit` int(8) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `id_reporter` int(8) NOT NULL,
  `id_assigne` int(8) NOT NULL,
  `id_category` int(8) NOT NULL,
  `status` enum('backlog','to do','in progress','in review','done') NOT NULL,
  `deadline` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_audit`
--

INSERT INTO `tbl_audit` (`id_audit`, `task_name`, `id_reporter`, `id_assigne`, `id_category`, `status`, `deadline`, `created_at`, `updated_at`) VALUES
(1, 'Tokairika 51125-0011', 2, 3, 1, 'done', '2023-02-28 14:27:00', '2023-02-26 01:27:43', '2023-02-26 02:19:09'),
(2, 'Proses Manufaktur_February\'23', 2, 2, 2, 'done', '2023-02-28 15:31:00', '2023-02-26 02:31:52', '2023-02-26 02:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id_category` int(8) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` enum('system','proses') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id_category`, `title`, `slug`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Tokairika 51125-0011', 'tokairika-51125-0011', 'proses', '2023-02-26 00:32:04', '2023-02-26 00:32:04'),
(2, 'Process Manufacturing', 'process-manufacturing', 'system', '2023-02-26 02:26:21', '2023-02-26 02:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cp`
--

CREATE TABLE `tbl_cp` (
  `id_cp` int(8) NOT NULL,
  `title_cp` text NOT NULL,
  `clausal` varchar(255) DEFAULT NULL,
  `evidence` varchar(255) NOT NULL,
  `id_area` int(8) NOT NULL,
  `description` varchar(255) NOT NULL,
  `tipe` enum('system','proses','verification') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_cp`
--

INSERT INTO `tbl_cp` (`id_cp`, `title_cp`, `clausal`, `evidence`, `id_area`, `description`, `tipe`, `created_at`, `updated_at`) VALUES
(1, 'Apakah tersedia Petunjuk Kerja Incoming Material?', '-', '*Petunjuk Kerja, Prosedur', 2, '-', 'proses', '2023-02-26 01:23:38', '2023-02-26 01:23:38'),
(2, 'Apakah tersedia skill matrix dari operator?', '-', '*Skill Matrix', 2, '-', 'proses', '2023-02-26 01:23:38', '2023-02-26 01:23:38'),
(3, 'COA data dari material ?', '-', '*COA', 2, '-', 'proses', '2023-02-26 01:23:38', '2023-02-26 01:23:38'),
(4, 'Pengecekkan Incoming menggunakan AQL berapa?', '-', '*Tabel AQL', 2, '-', 'proses', '2023-02-26 01:23:38', '2023-02-26 01:23:38'),
(5, 'Apakah tersedia Produk Spesifikasi?', '-', '*Spesifikasi Material / Part', 2, '-', 'proses', '2023-02-26 01:23:38', '2023-02-26 01:23:38'),
(6, 'Retraining operator Molding terhadap Mold Marking', NULL, 'Operator Memahami Mold Marking', 1, '*Tanyakan pemahaman kepada operator mengenai Mold Marking', 'verification', '2023-02-26 01:26:23', '2023-02-26 01:26:23'),
(7, 'Apakah tersedia KPI dari Manufacturing', '5. Planning', '*KPI Data, Objective & Target, Division Plan', 27, '-', 'system', '2023-02-26 02:30:25', '2023-02-26 02:30:25'),
(8, 'Apakah tersedia skill matrix dari operator?', '7.3 Competence', '*Skill Matrix', 27, '-', 'system', '2023-02-26 02:30:25', '2023-02-26 02:30:25'),
(9, 'Apakah tersedia instruksi kerja?', '-', '*PK', 27, '-', 'system', '2023-02-26 02:30:25', '2023-02-26 02:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_audit`
--

CREATE TABLE `tbl_detail_audit` (
  `id_detail_audit` int(8) NOT NULL,
  `id_audit` int(8) NOT NULL,
  `id_cp` int(8) NOT NULL,
  `status` enum('to do','passed','failed') NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `nama_audity` varchar(255) NOT NULL,
  `desc_audit` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_detail_audit`
--

INSERT INTO `tbl_detail_audit` (`id_detail_audit`, `id_audit`, `id_cp`, `status`, `file_path`, `nama_audity`, `desc_audit`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 'passed', '', '-', 'Observasi sampling operator bernama Cecep dengan nomor NIK 20xxxx sudah mengerti mengenai Mold Marking dan detail Claim Short Mold design 581125-0011', '2023-02-26 01:27:43', '2023-02-26 01:35:35'),
(2, 1, 1, 'passed', '', 'Bayu, Sulis', 'Ya tersedia PK Incoming Material dengan doc no PK-998/IQC/PIM', '2023-02-26 01:27:43', '2023-02-26 01:37:03'),
(3, 1, 2, 'passed', '', 'Bayu, Sulis', 'Tersedia Skill Matrix atas nama Bayu S dengan NIK no 20XXXXXX dengan grade A / kompeten', '2023-02-26 01:27:43', '2023-02-26 01:38:29'),
(4, 1, 3, 'passed', '', 'Bayu, Sulis', 'Sampling untuk Material SH9161U, terdapat COA data dengan result Hardness, Elongation, Color, Rheometer hasilnya OK sesuai dengan spesifikasi yang diminta', '2023-02-26 01:27:43', '2023-02-26 01:39:49'),
(5, 1, 4, 'passed', '/audit/1/5.pdf', 'Bayu, Sulis', 'Pengecekkan Incoming dilakukan dengan metode sampling merujuk kepada tabel AQL Level 0.1 ', '2023-02-26 01:27:43', '2023-02-26 01:49:00'),
(6, 1, 5, 'failed', '', 'Bayu, Sulis', 'Tidak tersedia produk spesifikasi material untuk part Carbon Pill diameter 3.0', '2023-02-26 01:27:43', '2023-02-26 02:11:26'),
(7, 2, 7, 'passed', '/audit/2/7.pdf', 'Hadi, Sukardi, Esti', 'Gantt Chart untuk proses manufaktur tersedia, terdapat 5 objektif target dan sudah disampaikan ke operator', '2023-02-26 02:31:52', '2023-02-26 02:35:33'),
(8, 2, 8, 'passed', '', 'Hadi, Sukardi, Esti', 'Tidak tersedia Skill Matrix atas nama Cecep', '2023-02-26 02:31:52', '2023-02-26 02:38:29'),
(9, 2, 9, 'passed', '', 'Hadi, Sukardi, Esti', 'Ya, Tersedia', '2023-02-26 02:31:52', '2023-02-26 02:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_finding`
--

CREATE TABLE `tbl_finding` (
  `id_finding` int(8) NOT NULL,
  `id_detail_audit` int(8) NOT NULL,
  `status_finding` enum('finding','non') NOT NULL,
  `category_finding` enum('none','major','minor','observation') NOT NULL,
  `cause` text NOT NULL,
  `short_term` varchar(255) NOT NULL,
  `long_term` varchar(255) NOT NULL,
  `revised` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_finding`
--

INSERT INTO `tbl_finding` (`id_finding`, `id_detail_audit`, `status_finding`, `category_finding`, `cause`, `short_term`, `long_term`, `revised`, `created_at`, `updated_at`) VALUES
(1, 6, 'finding', 'minor', '1. Spesifikasi sedang tahap revisi\r\n2. Spesifikasi lama dibawa oleh pic document center\r\n3. Tidak meminta second spec', '-', 'Jika sedang progress update Spesifikasi, maka dibuatkan dokumen uncontrol copy sementara', '-', '2023-02-26 01:48:17', '2023-02-26 02:11:26'),
(2, 8, 'non', 'none', '', '', '', '', '2023-02-26 02:36:05', '2023-02-26 02:38:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_users` int(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipe` enum('admin','lead','auditor') NOT NULL,
  `status` enum('active','deactive') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_users`, `nama`, `slug`, `username`, `password`, `tipe`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin', 'super_admin', '$2y$10$s.UEvsRn8S.qs4GBOvDJ1.D/7kx9SW2844QHIgvIrNWX7zXeg5yLC', 'admin', 'active', '2023-02-26 13:16:29', '2023-02-26 13:16:29'),
(2, 'Tegar Hutomo', 'tegar-hutomo', 'tegar_hutomo', '$2y$10$aPVtJqaZmTW.lq9r2qON.etNnHToP9hVdX6fRveCPoMdDrqaSHfau', 'lead', 'active', '2023-02-26 00:29:06', '2023-02-26 00:29:19'),
(3, 'Supra Santoso', 'supra-santoso', 'Supra_Santoso', '$2y$10$chPfA9HMcsIwoGdj2QqY3eVSNCQRAXVcoRT0NrSJJYOnCfUEcW4w2', 'auditor', 'active', '2023-02-26 00:31:00', '2023-02-26 00:31:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD PRIMARY KEY (`id_area`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `tbl_audit`
--
ALTER TABLE `tbl_audit`
  ADD PRIMARY KEY (`id_audit`),
  ADD KEY `id_reporter` (`id_reporter`),
  ADD KEY `id_assigne` (`id_assigne`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `tbl_cp`
--
ALTER TABLE `tbl_cp`
  ADD PRIMARY KEY (`id_cp`),
  ADD KEY `id_area` (`id_area`);

--
-- Indexes for table `tbl_detail_audit`
--
ALTER TABLE `tbl_detail_audit`
  ADD PRIMARY KEY (`id_detail_audit`),
  ADD KEY `id_audit` (`id_audit`),
  ADD KEY `id_cp` (`id_cp`);

--
-- Indexes for table `tbl_finding`
--
ALTER TABLE `tbl_finding`
  ADD PRIMARY KEY (`id_finding`),
  ADD KEY `id_detail_audit` (`id_detail_audit`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `id_area` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_audit`
--
ALTER TABLE `tbl_audit`
  MODIFY `id_audit` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id_category` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_cp`
--
ALTER TABLE `tbl_cp`
  MODIFY `id_cp` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_detail_audit`
--
ALTER TABLE `tbl_detail_audit`
  MODIFY `id_detail_audit` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_finding`
--
ALTER TABLE `tbl_finding`
  MODIFY `id_finding` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_users` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD CONSTRAINT `tbl_area_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `tbl_category` (`id_category`);

--
-- Constraints for table `tbl_audit`
--
ALTER TABLE `tbl_audit`
  ADD CONSTRAINT `tbl_audit_ibfk_2` FOREIGN KEY (`id_assigne`) REFERENCES `tbl_users` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_audit_ibfk_3` FOREIGN KEY (`id_category`) REFERENCES `tbl_category` (`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_audit_ibfk_4` FOREIGN KEY (`id_reporter`) REFERENCES `tbl_users` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_cp`
--
ALTER TABLE `tbl_cp`
  ADD CONSTRAINT `tbl_cp_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `tbl_area` (`id_area`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_detail_audit`
--
ALTER TABLE `tbl_detail_audit`
  ADD CONSTRAINT `tbl_detail_audit_ibfk_1` FOREIGN KEY (`id_audit`) REFERENCES `tbl_audit` (`id_audit`),
  ADD CONSTRAINT `tbl_detail_audit_ibfk_2` FOREIGN KEY (`id_cp`) REFERENCES `tbl_cp` (`id_cp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

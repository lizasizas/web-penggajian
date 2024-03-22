-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2023 at 11:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zenithsalary`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_admin` varchar(20) NOT NULL,
  `id_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_admin`, `id_level`) VALUES
('A001', 'sisisi', '123456', 'Sisi', 'LV001'),
('A002', 'zazaza', '123456', 'Zaza', 'LV002');

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `id_agama` varchar(20) NOT NULL,
  `nama_agama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id_agama`, `nama_agama`) VALUES
('IDAG01', 'Islam'),
('IDAG02', 'Protestan'),
('IDAG03', 'Khatolik'),
('IDAG04', 'Budha'),
('IDAG05', 'Hindu');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` varchar(20) NOT NULL,
  `nama_divisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
('IDDIV01', 'Marketing'),
('IDDIV02', 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `id_golongan` varchar(20) NOT NULL,
  `nama_golongan` varchar(20) NOT NULL,
  `gaji_pokok` int(20) NOT NULL,
  `persen_pajak` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`id_golongan`, `nama_golongan`, `gaji_pokok`, `persen_pajak`) VALUES
('IDG01', '1 A', 7000000, 0.05),
('IDG02', '1 B', 5000000, 0.05),
('IDG03', '1 C', 3000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` varchar(20) NOT NULL,
  `nama_jabatan` varchar(20) NOT NULL,
  `tunjangan_jabatan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `tunjangan_jabatan`) VALUES
('IDJ01', 'Manager', 1000000),
('IDJ02', 'Staff', 500000),
('IDJ03', 'Intern', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(20) NOT NULL,
  `nama_karyawan` varchar(20) NOT NULL,
  `id_divisi` varchar(20) NOT NULL,
  `id_jabatan` varchar(20) NOT NULL,
  `id_golongan` varchar(20) NOT NULL,
  `id_agama` varchar(20) NOT NULL,
  `id_status_nikah` varchar(20) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `jumlah_anak` int(2) NOT NULL,
  `password` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `id_divisi`, `id_jabatan`, `id_golongan`, `id_agama`, `id_status_nikah`, `no_rekening`, `jumlah_anak`, `password`, `username`) VALUES
('IDK001', 'LEONARDO', 'IDDIV01', 'IDJ01', 'IDG01', 'IDAG01', 'IDSN01', '149256', 2, '123456', 'leo'),
('IDK002', 'ALIN', 'IDDIV02', 'IDJ02', 'IDG02', 'IDAG03', 'IDSN02', '816256919', 0, '111', 'aaa'),
('IDK003', 'STEFANI', 'IDDIV01', 'IDJ03', 'IDG03', 'IDAG04', 'IDSN02', '16729197', 0, '123456', 'stef');

-- --------------------------------------------------------

--
-- Table structure for table `level_admin`
--

CREATE TABLE `level_admin` (
  `id_level` varchar(20) NOT NULL,
  `nama_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level_admin`
--

INSERT INTO `level_admin` (`id_level`, `nama_level`) VALUES
('LV001', 'Super Admin'),
('LV002', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `nota_potongan`
--

CREATE TABLE `nota_potongan` (
  `id_nota_potongan` varchar(20) NOT NULL,
  `id_karyawan` varchar(20) NOT NULL,
  `total_potongan` int(20) NOT NULL,
  `lampiran_potongan` varchar(100) NOT NULL,
  `id_verifikasi` varchar(20) DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nota_potongan`
--

INSERT INTO `nota_potongan` (`id_nota_potongan`, `id_karyawan`, `total_potongan`, `lampiran_potongan`, `id_verifikasi`, `tanggal_pengajuan`) VALUES
('NP007', 'IDK001', 800000, '20231226024235Acer_Wallpaper_02_5000x2813.jpg', 'IDV02', '2023-12-26'),
('NP012', 'IDK001', 8, '20231226024717Planet9_Wallpaper_5000x2813.jpg', 'IDV01', '2023-12-26'),
('NP013', 'IDK001', 9, '20231226025838Himastik logo copy.png', 'IDV02', '2023-12-26'),
('NP014', 'IDK002', 1600000, '20231226083926CV Dina Elly Yanti - Ingg.pdf', 'IDV01', '2023-12-26'),
('NP015', 'IDK001', 300000, '20231227030428rapat global.pdf', 'IDV02', '2023-12-27'),
('NP016', 'IDK001', 1000000, '20231227033459253-Article Text-1207-1-10-20220304.pdf', 'IDV01', '2023-12-27'),
('NP017', 'IDK001', 1900000, '202312270336042530-Article Text-4783-1-10-20200604.pdf', 'IDV02', '2023-12-27'),
('NP018', 'IDK001', 800000, '202312270434464525-Article Text-16746-2-10-20220531.pdf', 'IDV01', '2023-12-27'),
('NP019', 'IDK001', 1000000, '202312280657502562-Article Text-7990-2-10-20210213.pdf', 'IDV01', '2023-12-28'),
('NP020', 'IDK001', 2400000, '20231228070607Chap5.pdf', 'IDV02', '2023-12-28'),
('NP021', 'IDK002', 1200000, '20231228071351chapter7.pdf', 'IDV02', '2023-12-28');

-- --------------------------------------------------------

--
-- Table structure for table `nota_tunjangan`
--

CREATE TABLE `nota_tunjangan` (
  `id_nota_tunjangan` varchar(20) NOT NULL,
  `id_karyawan` varchar(20) NOT NULL,
  `total_tunjangan` int(20) NOT NULL,
  `id_verifikasi` varchar(20) NOT NULL,
  `lampiran_tunjangan` varchar(100) NOT NULL,
  `tanggal_pengajuan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nota_tunjangan`
--

INSERT INTO `nota_tunjangan` (`id_nota_tunjangan`, `id_karyawan`, `total_tunjangan`, `id_verifikasi`, `lampiran_tunjangan`, `tanggal_pengajuan`) VALUES
('IDT001', 'IDK001', 250000, 'IDV01', '', '2023-12-06'),
('IDT012', 'IDK002', 100000, 'IDV01', '202312251033295e365669f22eee568fbb2425e25d84b1.jpg', '2023-12-25'),
('IDT013', 'IDK001', 100000, 'IDV02', '20231226030407Himastik logo copy.png', '2023-12-26'),
('IDT014', 'IDK001', 100000, 'IDV02', '20231226131836pesan kos indralaya.pdf', '2023-12-26'),
('IDT018', 'IDK002', 200000, 'IDV02', '2023122720055610416-26698-1-PB.pdf', '2023-12-27'),
('IDT019', 'IDK002', 200000, 'IDV02', '20231227201040jurnal PM.pdf', '2023-12-27'),
('IDT020', 'IDK002', 200000, 'IDV02', '20231228071609homeworkproblems.pdf', '2023-12-28'),
('IDT021', 'IDK003', 200000, 'IDV02', '202312280741421223-103-PB.pdf', '2023-12-28'),
('IDT022', 'IDK001', 200000, 'IDV02', '20231228083124Analysis.pdf', '2023-12-28');

-- --------------------------------------------------------

--
-- Table structure for table `potongan`
--

CREATE TABLE `potongan` (
  `id_potongan` varchar(20) NOT NULL,
  `nama_potongan` varchar(20) NOT NULL,
  `max_potongan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `potongan`
--

INSERT INTO `potongan` (`id_potongan`, `nama_potongan`, `max_potongan`) VALUES
('IDP01', 'Pinjaman Bank', 10000000),
('IDP02', 'Pinjaman Koperasi', 3000000);

-- --------------------------------------------------------

--
-- Table structure for table `slip_gaji`
--

CREATE TABLE `slip_gaji` (
  `id_slip_gaji` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `id_karyawan` varchar(20) NOT NULL,
  `gaji_pokok` int(20) NOT NULL,
  `gaji_bersih` int(20) NOT NULL,
  `tunjangan_jabatan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slip_gaji`
--

INSERT INTO `slip_gaji` (`id_slip_gaji`, `tanggal`, `id_karyawan`, `gaji_pokok`, `gaji_bersih`, `tunjangan_jabatan`) VALUES
('IDSG010', '2030-01-01', 'IDK002', 7000000, 7600000, 500000),
('IDSG011', '2024-08-31', 'IDK002', 7000000, 7600000, 500000),
('IDSG013', '2023-12-01', 'IDK001', 7000000, 8250000, 1000000),
('IDSG014', '2024-01-01', 'IDK002', 5000000, 5238096, 500000),
('IDSG016', '2024-01-31', 'IDK001', 7000000, 7950000, 1000000),
('IDSG017', '2025-01-01', 'IDK001', 7000000, 8250000, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `status_nikah`
--

CREATE TABLE `status_nikah` (
  `id_status_nikah` varchar(20) NOT NULL,
  `nama_status_nikah` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_nikah`
--

INSERT INTO `status_nikah` (`id_status_nikah`, `nama_status_nikah`) VALUES
('IDSN01', 'Sudah Menikah'),
('IDSN02', 'Belum Menikah');

-- --------------------------------------------------------

--
-- Table structure for table `status_potongan`
--

CREATE TABLE `status_potongan` (
  `id_status` varchar(20) NOT NULL,
  `nama_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_potongan`
--

INSERT INTO `status_potongan` (`id_status`, `nama_status`) VALUES
('IDSP01', 'Belum Selesai'),
('IDSP02', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_potongan`
--

CREATE TABLE `transaksi_potongan` (
  `id_nota_potongan` varchar(20) NOT NULL,
  `id_potongan` varchar(20) NOT NULL,
  `sub_total_potongan` int(20) NOT NULL,
  `keterangan_potongan` varchar(20) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `lama_potongan` int(20) NOT NULL,
  `cicilan` int(20) NOT NULL,
  `id_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_potongan`
--

INSERT INTO `transaksi_potongan` (`id_nota_potongan`, `id_potongan`, `sub_total_potongan`, `keterangan_potongan`, `tanggal_mulai`, `tanggal_selesai`, `lama_potongan`, `cicilan`, `id_status`) VALUES
('NP007', 'IDP02', 800000, 'v', '2023-12-26', '2024-02-26', 2, 400000, 'IDSP01'),
('NP013', 'IDP02', 9, 'sumsel babel', '2023-12-26', '2024-02-26', 2, 5, 'IDSP01'),
('NP014', 'IDP01', 900000, 'aaaa', '2023-12-26', '2024-07-26', 7, 128571, 'IDSP01'),
('NP014', 'IDP02', 700000, 'v', '2023-12-26', '2024-03-26', 3, 233333, 'IDSP01'),
('NP015', 'IDP01', 300000, 'BSI', '2023-12-27', '2024-03-27', 3, 100000, 'IDSP01'),
('NP016', 'IDP01', 1000000, 'MANDIRI', '2023-12-27', '2024-10-27', 10, 100000, 'IDSP01'),
('NP017', 'IDP01', 800000, 'BNI', '2023-12-27', '2024-08-27', 8, 100000, 'IDSP01'),
('NP017', 'IDP02', 1100000, 'Koperasi S', '2023-12-27', '2024-11-27', 11, 100000, 'IDSP01'),
('NP018', 'IDP01', 800000, 'BSI', '2023-12-27', '2024-08-27', 8, 100000, 'IDSP01'),
('NP019', 'IDP02', 1000000, 'Koperasi Sejahtera', '2023-12-28', '2024-10-28', 10, 100000, 'IDSP01'),
('NP020', 'IDP01', 2400000, '', '2023-12-28', '2023-12-28', 12, 200000, 'IDSP01'),
('NP021', 'IDP02', 1200000, 'Koperasi Makmur', '2023-12-28', '2023-12-28', 12, 100000, 'IDSP01');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_tunjangan`
--

CREATE TABLE `transaksi_tunjangan` (
  `id_nota_tunjangan` varchar(20) NOT NULL,
  `sub_total_tunjangan` int(20) NOT NULL,
  `id_tunjangan` varchar(20) NOT NULL,
  `keterangan_tunjangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_tunjangan`
--

INSERT INTO `transaksi_tunjangan` (`id_nota_tunjangan`, `sub_total_tunjangan`, `id_tunjangan`, `keterangan_tunjangan`) VALUES
('IDT001', 150000, 'IDT01', 'tunjangan istri'),
('IDT001', 100000, 'IDT02', 'anak ke 1'),
('IDT012', 100000, 'IDT02', '1'),
('IDT013', 100000, 'IDT02', '1'),
('IDT014', 100000, 'IDT02', '1'),
('IDT018', 200000, 'IDT03', '1'),
('IDT019', 200000, 'IDT03', '1'),
('IDT020', 200000, 'IDT03', '1'),
('IDT021', 200000, 'IDT03', '1'),
('IDT022', 200000, 'IDT03', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tunjangan`
--

CREATE TABLE `tunjangan` (
  `id_tunjangan` varchar(20) NOT NULL,
  `nama_tunjangan` varchar(20) NOT NULL,
  `besar_tunjangan` int(11) NOT NULL,
  `syarat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tunjangan`
--

INSERT INTO `tunjangan` (`id_tunjangan`, `nama_tunjangan`, `besar_tunjangan`, `syarat`) VALUES
('IDT01', 'Tunjangan Istri', 150000, ''),
('IDT02', 'Tunjangan Anak', 100000, ''),
('IDT03', 'Tunjangan Beras', 200000, '');

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi`
--

CREATE TABLE `verifikasi` (
  `id_verifikasi` varchar(20) NOT NULL,
  `nama_verifikasi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verifikasi`
--

INSERT INTO `verifikasi` (`id_verifikasi`, `nama_verifikasi`) VALUES
('IDV01', 'Disetujui'),
('IDV02', 'Sedang Diproses'),
('IDV03', 'Ditolak');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `id_level` (`id_level`);

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id_golongan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_agama` (`id_agama`),
  ADD KEY `id_golongan` (`id_golongan`),
  ADD KEY `id_status_nikah` (`id_status_nikah`),
  ADD KEY `id_status_nikah_2` (`id_status_nikah`),
  ADD KEY `id_status_nikah_3` (`id_status_nikah`),
  ADD KEY `id_divisi_2` (`id_divisi`,`id_jabatan`,`id_golongan`,`id_agama`,`id_status_nikah`);

--
-- Indexes for table `level_admin`
--
ALTER TABLE `level_admin`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `nota_potongan`
--
ALTER TABLE `nota_potongan`
  ADD PRIMARY KEY (`id_nota_potongan`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `fk_nota_potongan_verifikasi` (`id_verifikasi`);

--
-- Indexes for table `nota_tunjangan`
--
ALTER TABLE `nota_tunjangan`
  ADD PRIMARY KEY (`id_nota_tunjangan`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_verifikasi` (`id_verifikasi`) USING BTREE;

--
-- Indexes for table `potongan`
--
ALTER TABLE `potongan`
  ADD PRIMARY KEY (`id_potongan`);

--
-- Indexes for table `slip_gaji`
--
ALTER TABLE `slip_gaji`
  ADD PRIMARY KEY (`id_slip_gaji`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `status_nikah`
--
ALTER TABLE `status_nikah`
  ADD PRIMARY KEY (`id_status_nikah`);

--
-- Indexes for table `status_potongan`
--
ALTER TABLE `status_potongan`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `transaksi_potongan`
--
ALTER TABLE `transaksi_potongan`
  ADD KEY `id_potongan` (`id_potongan`),
  ADD KEY `id_nota_potongan` (`id_nota_potongan`),
  ADD KEY `id_status` (`id_status`);

--
-- Indexes for table `transaksi_tunjangan`
--
ALTER TABLE `transaksi_tunjangan`
  ADD KEY `id_tunjangan` (`id_tunjangan`),
  ADD KEY `id_daftar_tunjangan` (`id_nota_tunjangan`);

--
-- Indexes for table `tunjangan`
--
ALTER TABLE `tunjangan`
  ADD PRIMARY KEY (`id_tunjangan`);

--
-- Indexes for table `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD PRIMARY KEY (`id_verifikasi`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level_admin` (`id_level`);

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_10` FOREIGN KEY (`id_golongan`) REFERENCES `golongan` (`id_golongan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `karyawan_ibfk_11` FOREIGN KEY (`id_agama`) REFERENCES `agama` (`id_agama`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `karyawan_ibfk_5` FOREIGN KEY (`id_status_nikah`) REFERENCES `status_nikah` (`id_status_nikah`),
  ADD CONSTRAINT `karyawan_ibfk_8` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `karyawan_ibfk_9` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nota_potongan`
--
ALTER TABLE `nota_potongan`
  ADD CONSTRAINT `fk_nota_potongan_verifikasi` FOREIGN KEY (`id_verifikasi`) REFERENCES `verifikasi` (`id_verifikasi`),
  ADD CONSTRAINT `nota_potongan_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nota_tunjangan`
--
ALTER TABLE `nota_tunjangan`
  ADD CONSTRAINT `nota_tunjangan_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nota_tunjangan_ibfk_2` FOREIGN KEY (`id_verifikasi`) REFERENCES `verifikasi` (`id_verifikasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `slip_gaji`
--
ALTER TABLE `slip_gaji`
  ADD CONSTRAINT `slip_gaji_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_potongan`
--
ALTER TABLE `transaksi_potongan`
  ADD CONSTRAINT `transaksi_potongan_ibfk_1` FOREIGN KEY (`id_nota_potongan`) REFERENCES `nota_potongan` (`id_nota_potongan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_potongan_ibfk_2` FOREIGN KEY (`id_potongan`) REFERENCES `potongan` (`id_potongan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_potongan_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `status_potongan` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_tunjangan`
--
ALTER TABLE `transaksi_tunjangan`
  ADD CONSTRAINT `transaksi_tunjangan_ibfk_1` FOREIGN KEY (`id_tunjangan`) REFERENCES `tunjangan` (`id_tunjangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_tunjangan_ibfk_2` FOREIGN KEY (`id_nota_tunjangan`) REFERENCES `nota_tunjangan` (`id_nota_tunjangan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

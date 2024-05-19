-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2024 at 11:39 AM
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
-- Database: `miniproject_progweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `artis`
--

CREATE TABLE `artis` (
  `id_artis` int(11) NOT NULL,
  `nama_artis` varchar(50) NOT NULL,
  `Negara` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artis`
--

INSERT INTO `artis` (`id_artis`, `nama_artis`, `Negara`) VALUES
(1, 'IVE', 'Korea Selatan'),
(2, 'JKT 48', 'Indonesia'),
(3, 'Tulus', 'Indonesia'),
(4, 'Kunto Aji', 'Indonesia'),
(5, 'Yura Yunita', 'Indonesia'),
(6, 'Nadin Amizah', 'Indonesia'),
(7, 'Cha Eun-Woo', 'Korea Selatan'),
(8, 'YoonA', 'Korea Selatan'),
(9, 'Chanyeol', 'Korea Selatan'),
(10, 'Weird Genius', 'Indonesia'),
(11, 'HIVI', 'Indonesia'),
(12, 'The Boyz', 'Korea Selatan'),
(13, 'Syndrama', 'Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `featuring`
--

CREATE TABLE `featuring` (
  `id_featuring` int(11) NOT NULL,
  `id_konser` int(11) NOT NULL,
  `id_artis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `featuring`
--

INSERT INTO `featuring` (`id_featuring`, `id_konser`, `id_artis`) VALUES
(1, 1, 2),
(2, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `konser`
--

CREATE TABLE `konser` (
  `id_konser` int(11) NOT NULL,
  `judul_konser` varchar(255) NOT NULL,
  `kategori_konser` enum('Festival','Konser','Fan Meet','') NOT NULL,
  `Deskripsi_konser` varchar(1000) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `jam_mulai` varchar(5) NOT NULL,
  `jam_akhir` varchar(5) NOT NULL,
  `batas_umur` int(11) NOT NULL,
  `gambar_tumb` varchar(255) NOT NULL,
  `gambar_header` varchar(255) NOT NULL,
  `gambar_layout` varchar(255) NOT NULL,
  `gambar_tnc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konser`
--

INSERT INTO `konser` (`id_konser`, `judul_konser`, `kategori_konser`, `Deskripsi_konser`, `kota`, `tempat`, `tanggal_awal`, `tanggal_akhir`, `jam_mulai`, `jam_akhir`, `batas_umur`, `gambar_tumb`, `gambar_header`, `gambar_layout`, `gambar_tnc`) VALUES
(1, '#SATUDEKADEBERSAMA PRAMBANAN JAZZ', 'Festival', 'Prambanan Jazz merupakan festival musik internasional tahunan yang diadakan di pelataran Candi Prambanan, Yogyakarta, mengusung konsep gabungan dua mahakarya besar yaitu Candi Prambanan dan mahakarya musik internasional, serta musik nasional. Festival musik diusung sebagai salah satu media diplomasi kebudayaan Indonesia di dunia internasional untuk melengkapi ekosistem pariwisata dengan menjadi salah satu event wisata musik. Sejak pertama kali diselenggarakan pada tahun 2015.', 'Yogyakarta', 'Candi Prambanan', '2024-07-05', '2024-07-07', '14:00', '22:00', 12, '/gambar/tumb/prambananjazz.jpg', '/gambar/header/prambananjazz.jpg', '/gambar/layout/prambananjazz.jpg', '/gambar/tnc/prambananjazz.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pemesan_tiket`
--

CREATE TABLE `pemesan_tiket` (
  `id_pemesanTiket` int(11) NOT NULL,
  `namaDepan_pemesan` varchar(50) NOT NULL,
  `namaBelakang_pemesan` varchar(50) NOT NULL,
  `nomor_pemesan` varchar(20) NOT NULL,
  `email_pemesan` varchar(50) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_tiket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesan_tiket`
--

INSERT INTO `pemesan_tiket` (`id_pemesanTiket`, `namaDepan_pemesan`, `namaBelakang_pemesan`, `nomor_pemesan`, `email_pemesan`, `id_pesanan`, `id_tiket`) VALUES
(1, 'Nicholas', 'Dwinata', '083142320816', 'ndwinata@gmail.com', 1, 5),
(2, 'Stefani', 'Hartanto', '089637540023', 'stefanihar@gmail.com', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `total_harga` decimal(9,2) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `total_harga`, `id_user`) VALUES
(1, 500000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` int(11) NOT NULL,
  `jenis_tiket` varchar(50) NOT NULL,
  `deskripsi_tiket` varchar(255) NOT NULL,
  `harga` decimal(9,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `tanggal_tiket` date NOT NULL,
  `id_konser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `jenis_tiket`, `deskripsi_tiket`, `harga`, `stok`, `tanggal_tiket`, `id_konser`) VALUES
(1, 'Day 1 (Festival)', 'lalala', 250000.00, 200, '2024-07-05', 1),
(2, 'Day 1 (Super Festival)', 'lalala (tapi lebih mahal)', 350000.00, 150, '2024-07-05', 1),
(3, 'Day 2 (Festival)', 'lalala', 250000.00, 200, '2024-07-06', 1),
(4, 'Day 2 (Super Festival)', 'lalala (tapi lebih mahal)', 350000.00, 150, '2024-07-06', 1),
(5, 'Day 3 (Festival)', 'lalala', 250000.00, 200, '2024-07-06', 1),
(6, 'Day 3 (Super Festival)', 'lalala (tapi lebih mahal)', 350000.00, 150, '2024-07-06', 1),
(7, '3 Day Pass (Festival)', 'lalala', 600000.00, 200, '2024-07-05', 1),
(8, '3 Day Pass (Super Festival)', 'lalala (tapi lebih mahal)', 840000.00, 150, '2024-07-05', 1),
(9, 'SPECIAL SHOW (GOLD)', 'GOLD Brok', 450000.00, 50, '2024-07-07', 1),
(10, 'SPECIAL SHOW (DIAMOND)', 'DIAMOND Brok', 750000.00, 50, '2024-07-07', 1),
(11, 'SPECIAL SHOW (VIP)', 'VIP Brok', 1000000.00, 50, '2024-07-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `password_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email_user`, `password_user`) VALUES
(1, 'stefanus', 'stefanus@gmail.com', '123'),
(2, 'milka', 'milkaputri@gmail.com', '123'),
(3, 'nicholas', 'ndwinata@gmail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artis`
--
ALTER TABLE `artis`
  ADD PRIMARY KEY (`id_artis`);

--
-- Indexes for table `featuring`
--
ALTER TABLE `featuring`
  ADD PRIMARY KEY (`id_featuring`),
  ADD KEY `id_konser` (`id_konser`),
  ADD KEY `id_artis` (`id_artis`);

--
-- Indexes for table `konser`
--
ALTER TABLE `konser`
  ADD PRIMARY KEY (`id_konser`);

--
-- Indexes for table `pemesan_tiket`
--
ALTER TABLE `pemesan_tiket`
  ADD PRIMARY KEY (`id_pemesanTiket`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_tiket` (`id_tiket`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `id_konser` (`id_konser`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artis`
--
ALTER TABLE `artis`
  MODIFY `id_artis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `featuring`
--
ALTER TABLE `featuring`
  MODIFY `id_featuring` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `konser`
--
ALTER TABLE `konser`
  MODIFY `id_konser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemesan_tiket`
--
ALTER TABLE `pemesan_tiket`
  MODIFY `id_pemesanTiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `featuring`
--
ALTER TABLE `featuring`
  ADD CONSTRAINT `featuring_ibfk_1` FOREIGN KEY (`id_artis`) REFERENCES `artis` (`id_artis`),
  ADD CONSTRAINT `featuring_ibfk_2` FOREIGN KEY (`id_konser`) REFERENCES `konser` (`id_konser`);

--
-- Constraints for table `pemesan_tiket`
--
ALTER TABLE `pemesan_tiket`
  ADD CONSTRAINT `pemesan_tiket_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `pemesan_tiket_ibfk_2` FOREIGN KEY (`id_tiket`) REFERENCES `tiket` (`id_tiket`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `FKC_tiket` FOREIGN KEY (`id_konser`) REFERENCES `konser` (`id_konser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

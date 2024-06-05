-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 03:00 PM
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
(13, 'Syndrama', 'Indonesia'),
(14, 'Ran', 'Indonesia'),
(15, 'Dere', 'Indonesia'),
(16, 'Gigi Unplugged', 'Indonesia'),
(17, 'Batavia Collective', 'Indonesia'),
(18, 'Ardhito Pramono', 'Indonesia'),
(19, 'Javier Parisi', 'Indonesia'),
(20, 'Indra Lesmana', 'Indonesia'),
(21, 'Niall Horan', 'Irlandia');

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
(2, 1, 4),
(3, 2, 1),
(4, 1, 14),
(5, 1, 5),
(6, 1, 3),
(7, 1, 15),
(8, 1, 17),
(9, 1, 6),
(10, 1, 19),
(11, 1, 20),
(12, 1, 16),
(13, 1, 18),
(14, 3, 21);

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
(1, '#SATUDEKADEBERSAMA PRAMBANAN JAZZ', 'Festival', 'Prambanan Jazz merupakan festival musik internasional tahunan yang diadakan di pelataran Candi Prambanan, Yogyakarta, mengusung konsep gabungan dua mahakarya besar yaitu Candi Prambanan dan mahakarya musik internasional, serta musik nasional. Festival musik diusung sebagai salah satu media diplomasi kebudayaan Indonesia di dunia internasional untuk melengkapi ekosistem pariwisata dengan menjadi salah satu event wisata musik. Sejak pertama kali diselenggarakan pada tahun 2015.', 'Yogyakarta', 'Candi Prambanan', '2024-07-05', '2024-07-07', '14:00', '23:00', 12, 'Konser/PrambananJazz/Banner_Prambanan_Jazz.3.jpg', 'Konser/PrambananJazz/Banner_Prambanan_Jazz.webp', 'Konser/PrambananJazz/Layout1.jpg', 'Konser/PrambananJazz/tnc.png'),
(2, 'IVE The 1st World Tour Show What I Have', 'Konser', 'DIVEs Indonesia! Your beloved K-pop girl group, IVE is coming for their very first concert in Jakarta through “IVE THE 1ST WORLD TOUR SHOW WHAT i HAVE IN JAKARTA”! The sensational girl group, which consists of Gaeul, Yujin, Rei, Wonyoung, Liz, and Leeseo will enchant their fans on August 24th, 2024 through their hit songs, such as Off The Record, Love Dive, After LIKE, Kitsch, and more! Dance along to their songs and have the best time of your life!\r\n\r\nGrab your tickets to see the Baddie now!\r\n\r\nSee you in August DIVEs\r\n\r\nICE BSD Hall 5 (Gate)', 'Jakarta', 'ICE BSD Hall 5', '2024-08-24', NULL, '19:00', '22:00', 8, 'Konser/IVE/Poster.2.jpeg', 'Konser/IVE/header.jpg', 'Konser\\IVE\\Layout.1.jpeg', 'belum'),
(3, '“THE SHOW LIVE ON TOUR\" Niall Horan', 'Konser', 'The chart-topping global superstar Niall Horan has announced the following tour called “THE SHOW LIVE ON TOUR\" – his biggest tour yet and first headline run since 2018’s Flicker World Tour. Niall Horan will be adding new dates in Asia and will be performing in Jakarta on Saturday, 11 May 2024 at Beach City International Stadium. \r\n\r\nTickets will be available starting with an Artist Presale starting Monday, 16 October 2023 from 14:00 to 23:59 Jakarta time. Public On-sale will be available starting Wednesday, 18 October 2023 at 14:00 Jakarta time only at niallhoranjakarta.com \r\n\r\nGet your tickets earlier by subscribing to Niall Horan’s newsletter on niallhoran.com before Sunday, 15 October 2023 at 23:59 Jakarta time to receive the code.', 'Jakarta', 'Beach City International Stadium', '2024-05-11', NULL, '18:30', '22.00', 13, 'Konser/NiallHoran/Poster.1.jpg', 'Konser/NiallHoran/header.webp', 'Konser/NiallHoran/Layout.1.webp', 'Konser/NiallHoran/tnc.png'),
(4, 'THE BOYZ 3RD World Tour: Zeneration Ⅱ', 'Konser', 'THE BOYZ\'s agency IST Entertainment announced on April 8, \"THE BOYZ will hold \'THE BOYZ WORLD TOUR: ZENERATION II\' in July and visit fans around the world.\". THE BOYZ\'s third world, \'THE BOYZ WORLD TOUR: ZENERATION II\' will kick off in Seoul from July 12 to 14.\r\n\r\nThe tour schedule to Jakarta on August 24, 2024, Notably, with the addition of the phrase \'AND MORE\' on the poster, the curiosity and expectation of additional regions that will be revealed in the future in addition to these 13 cities is increasing.', 'Jakarta', 'Tennis Indoor Senayan', '2024-08-24', NULL, '-', '-', 12, 'Konser/TheBoyz/tumb.webp', 'Konser/TheBoyz/header.jpg', '-', '-');

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
(11, 'SPECIAL SHOW (VIP)', 'VIP Brok', 1000000.00, 50, '2024-07-07', 1),
(12, 'Gray A ', 'This product is for the purchase of IVE THE 1ST WORLD TOUR <SHOW WHAT I HAVE> IN JAKARTA – GRAY A ticket.', 1225000.00, 150, '2024-08-24', 2),
(13, 'Gray B', 'This product is for the purchase of IVE THE 1ST WORLD TOUR <SHOW WHAT I HAVE> IN JAKARTA – GRAY B ticket.', 1226000.00, 150, '2024-08-24', 2),
(14, 'Orange', 'This product is for the purchase of IVE THE 1ST WORLD TOUR <SHOW WHAT I HAVE> IN JAKARTA – ORANGE ticket.', 1825000.00, 150, '2024-08-24', 2),
(15, 'Yellow', 'This product is for the purchase of IVE THE 1ST WORLD TOUR <SHOW WHAT I HAVE> IN JAKARTA – YELLOW ticket.', 2225000.00, 150, '2024-08-24', 2),
(16, 'Green B', 'This product is for the purchase of IVE THE 1ST WORLD TOUR <SHOW WHAT I HAVE> IN JAKARTA – GREEN B ticket.', 2426000.00, 150, '2024-08-24', 2),
(17, 'Green A', 'This product is for the purchase of IVE THE 1ST WORLD TOUR <SHOW WHAT I HAVE> IN JAKARTA – GREEN A ticket.', 2425000.00, 150, '2024-08-24', 2),
(18, 'Pink B', 'This product is for the purchase of IVE THE 1ST WORLD TOUR <SHOW WHAT I HAVE> IN JAKARTA – PINK B ticket.', 2726000.00, 150, '2024-08-24', 2),
(19, 'Pink A', 'This product is for the purchase of IVE THE 1ST WORLD TOUR <SHOW WHAT I HAVE> IN JAKARTA – PINK A ticket.', 2725000.00, 150, '2024-08-24', 2),
(20, 'Blue B', 'This product is for the purchase of IVE THE 1ST WORLD TOUR <SHOW WHAT I HAVE> IN JAKARTA – BLUE B ticket.', 2926000.00, 150, '2024-08-24', 2),
(21, 'Blue A', 'This product is for the purchase of IVE THE 1ST WORLD TOUR <SHOW WHAT I HAVE> IN JAKARTA – BLUE A ticket.', 2925000.00, 150, '2024-08-24', 2),
(22, 'Blue SOUNDCHECK PACKAGE B', 'This product is for the purchase of IVE THE 1ST WORLD TOUR <SHOW WHAT I HAVE> IN JAKARTA – BLUE SOUNDCHECK PACKAGE B ticket.', 3226000.00, 50, '2024-08-24', 2),
(23, 'Blue SOUNDCHECK PACKAGE A', 'This product is for the purchase of IVE THE 1ST WORLD TOUR <SHOW WHAT I HAVE> IN JAKARTA – BLUE SOUNDCHECK PACKAGE A ticket.', 3225000.00, 0, '2024-08-24', 2),
(24, 'CAT 3', 'Cat 3 seatting', 1200000.00, 0, '2024-05-11', 3);

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
  MODIFY `id_artis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `featuring`
--
ALTER TABLE `featuring`
  MODIFY `id_featuring` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `konser`
--
ALTER TABLE `konser`
  MODIFY `id_konser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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

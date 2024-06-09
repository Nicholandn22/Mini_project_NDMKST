-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 12:45 PM
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
(21, 'Niall Horan', 'Irlandia'),
(22, 'Vierratale', 'Indonesia'),
(23, 'Ngatmombilung', 'Indonesia'),
(24, 'Lomba Sihir', 'Indonesia'),
(25, 'Guyonwaton', 'Indonesia'),
(26, 'Coldiac', 'Indonesia'),
(27, 'Good Morning Everyone', 'Indonesia'),
(28, 'Nidji', 'Indonesia'),
(29, 'IU', 'Korea Selatan'),
(31, 'Maliq & D\'essentials', 'Indonesia'),
(32, 'Hindia', 'Indonesia'),
(33, 'Tiara Andini', 'Indonesia'),
(34, 'Mahalini', 'Indonesia'),
(35, 'Reality Club', 'Indonesia'),
(36, '.FEAST', 'Indonesia'),
(38, 'THE ADAMS', 'Indonesia'),
(39, 'THE PANTURAS', 'Indonesia'),
(40, 'TIPE X', 'Indonesia'),
(41, 'NDX AKA', 'Indonesia'),
(42, 'Chanyeol', 'Korea Selatan'),
(46, 'Cabik', 'Korea Selatan'),
(47, 'Las!', 'Korea Selatan'),
(48, 'Riize', 'Korea Selatan');

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
(14, 3, 21),
(15, 1, 31),
(16, 4, 12),
(17, 5, 22),
(18, 5, 23),
(19, 5, 24),
(20, 5, 25),
(21, 5, 26),
(22, 5, 27),
(23, 6, 7),
(24, 7, 29),
(25, 8, 31),
(26, 8, 6),
(27, 8, 32),
(28, 8, 33),
(29, 8, 34),
(30, 8, 35),
(31, 8, 26),
(32, 8, 36),
(33, 8, 24),
(34, 8, 12),
(35, 8, 38),
(36, 8, 39),
(37, 8, 40),
(38, 8, 35),
(39, 8, 41),
(40, 9, 9),
(41, 10, 8),
(42, 11, 6),
(43, 11, 11),
(44, 11, 13),
(110, 11, 46),
(112, 11, 47),
(113, 12, 48);

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
(1, '#SATUDEKADEBERSAMA PRAMBANAN JAZZ', 'Festival', 'Prambanan Jazz merupakan festival musik internasional tahunan yang diadakan di pelataran Candi Prambanan, Yogyakarta, mengusung konsep gabungan dua mahakarya besar yaitu Candi Prambanan dan mahakarya musik internasional, serta musik nasional. Festival musik diusung sebagai salah satu media diplomasi kebudayaan Indonesia di dunia internasional untuk melengkapi ekosistem pariwisata dengan menjadi salah satu event wisata musik. Sejak pertama kali diselenggarakan pada tahun 2015.', 'Yogyakarta', 'Candi Prambanan', '2024-07-05', '2024-07-07', '14:00', '23:00', 12, 'Konser/PrambananJazz/Banner_Prambanan_Jazz.3.jpg', 'Konser/PrambananJazz/Banner_Prambanan_Jazz.webp', 'Konser/PrambananJazz/Layout.1.jpg', 'Konser/PrambananJazz/tnc.png'),
(2, 'IVE The 1st World Tour Show What I Have', 'Konser', 'DIVEs Indonesia! Your beloved K-pop girl group, IVE is coming for their very first concert in Jakarta through “IVE THE 1ST WORLD TOUR SHOW WHAT i HAVE IN JAKARTA”! The sensational girl group, which consists of Gaeul, Yujin, Rei, Wonyoung, Liz, and Leeseo will enchant their fans on August 24th, 2024 through their hit songs, such as Off The Record, Love Dive, After LIKE, Kitsch, and more! Dance along to their songs and have the best time of your life!\r\n\r\nGrab your tickets to see the Baddie now!\r\n\r\nSee you in August DIVEs\r\n\r\nICE BSD Hall 5 (Gate)', 'Jakarta', 'ICE BSD Hall 5', '2024-08-24', NULL, '19:00', '22:00', 8, 'Konser/IVE/Poster.2.jpeg', 'Konser/IVE/header.jpg', 'Konser\\IVE\\Layout.1.jpeg', 'belum'),
(3, '“THE SHOW LIVE ON TOUR\" Niall Horan', 'Konser', 'The chart-topping global superstar Niall Horan has announced the following tour called “THE SHOW LIVE ON TOUR\" – his biggest tour yet and first headline run since 2018’s Flicker World Tour. Niall Horan will be adding new dates in Asia and will be performing in Jakarta on Saturday, 11 May 2024 at Beach City International Stadium. \r\n\r\nTickets will be available starting with an Artist Presale starting Monday, 16 October 2023 from 14:00 to 23:59 Jakarta time. Public On-sale will be available starting Wednesday, 18 October 2023 at 14:00 Jakarta time only at niallhoranjakarta.com \r\n\r\nGet your tickets earlier by subscribing to Niall Horan’s newsletter on niallhoran.com before Sunday, 15 October 2023 at 23:59 Jakarta time to receive the code.', 'Jakarta', 'Beach City International Stadium', '2024-05-11', NULL, '18:30', '22.00', 13, 'Konser/NiallHoran/Poster.1.jpg', 'Konser/NiallHoran/header.webp', 'Konser/NiallHoran/Layout.1.webp', 'Konser/NiallHoran/tnc.png'),
(4, 'THE BOYZ 3RD World Tour: Zeneration Ⅱ', 'Konser', 'THE BOYZ\'s agency IST Entertainment announced on April 8, \"THE BOYZ will hold \'THE BOYZ WORLD TOUR: ZENERATION II\' in July and visit fans around the world.\". THE BOYZ\'s third world, \'THE BOYZ WORLD TOUR: ZENERATION II\' will kick off in Seoul from July 12 to 14.\r\n\r\nThe tour schedule to Jakarta on August 24, 2024, Notably, with the addition of the phrase \'AND MORE\' on the poster, the curiosity and expectation of additional regions that will be revealed in the future in addition to these 13 cities is increasing.', 'Jakarta', 'Tennis Indoor Senayan', '2024-08-24', NULL, '-', '-', 12, 'Konser/TheBoyz/tumb.webp', 'Konser/TheBoyz/header.jpg', '-', '-'),
(5, 'BERSUA FESTIVAL', 'Festival', 'BERSUA, bersenandung, dan bergembira bersama kami. Menyajikan pengalaman festival musik di kota kesayanganmu. Jangan lewatkan keseruan BERSUA DI JOGJA yang akan menghadirkan lineup musisi idola kalian.', 'Yogyakarta', 'Stadion Kridosono', '2024-04-28', '2024-04-28', '20:00', '24:00', 12, 'Konser/BersuaFestival/Poster.3.png', 'Konser/BersuaFestival/Poster.2.png', 'Konser/BersuaFestival/Layout.2.png', 'Konser/BersuaFestival/tnc(bersua).png'),
(6, 'CHA EUN-WOO 2024 Just One 10 Minute [Mystery Elevator]', 'Konser', 'Viu Scream Dates is Viu’s fan meet offering across its markets. Viu Scream Dates aims to extend the Viu experience beyond the screens by bringing the stars closer to their fans via live events and experiences.\r\n\r\nOur next event is CHA EUN-WOO 2024 Just One 10 Minute [Mystery Elevator] in Jakarta on 20 April 2024, 7pm at Tennis Indoor Senayan. Fans are invited to embark on a unique journey by riding the “Mystery Elevator” to an unexplored space, where they can fully indulge in and appreciate the multifaceted charms of CHA EUN-WOO. This year’s fan concert tour will see him performing in Jakarta for the second time as a solo artiste.', 'Jakarta', 'Tennis Indoor Senayan', '2024-04-20', '2024-04-20', '18:00', '22:00', 12, 'Konser/ChaEunWoo/Poster.2.jpg', 'Konser/ChaEunWoo/Poster.1.jpeg', 'Konser/ChaEunWoo/Layout.1.jpg', 'Konser/ChaEunWoo/tnc(ChaEunWoo).png'),
(7, '2024 IU H.E.R. WORLD TOUR CONCERT', 'Konser', 'UAENA, mark your calendars, because IU is back for【2024 IU H.E.R. WORLD TOUR CONCERT】IN JAKARTA on 27-28 April 2024 at Indonesia Convention Exhibition (ICE) BSD City.\r\n\r\nLee Ji-eun, also known by her stage name IU, is a South Korean singer, songwriter, philanthropist, and actress. Her stage name IU, mean \"I and You become one through music.” IU is also loved by fans worldwide for her performance as an actress in dramas such as \"Moon Lovers: Scarlet Heart Ryeo,\" \"Hotel Del Luna,\" and \"My Mister.”\r\n\r\nShe debuted as a singer at the age of fifteen with Lost and Found (2008). She achieved national stardom after the release of \"Good Day\", the lead single from her 2010 album “Real”. After releasing five studio albums, ten extended plays (EPs), 47 singles (including 19 as featured artist), five single albums, two remake albums and two compilation albums, IU successful in maintaining her dominance in Korean music charts and further brace her nickname as Koreas little sister. She is now known as', 'Jakarta', 'Indonesia Convention Exhibition (ICE) BSD City', '2024-04-27', '2024-04-28', '17:00', '22:00', 12, 'Konser/IU/Poster.3.jpg', 'Konser/IU/Poster.2.png', 'Konser/IU/Layout.1.png', 'belum'),
(8, 'Sounds of Downtown Vol.6', 'Festival', 'THE BIGGEST MUSIC FESTIVAL IN EAST JAVA!\r\nSounds of Downtown (SoD) is a collaborative music festival organized by PT. Serikat Orang Dalam is a company focused on music, entertainment, and other creative industries.\r\nThis event will be held on August 2024 at Lapangan Bhumi Marinir Sutedi SenaPutra Karang Pilang, Surabaya.\r\nPurchase your ticket exclusively at tiket.com!', 'Surabaya', 'Lapangan Bhumi Marinir Karang Pilang', '2024-08-03', '2024-08-04', '18:00', '24:00', 12, 'Konser/SoundOfDowntown/Poster.jpg', 'Konser/SoundOfDowntown/Poster.png', 'Tidak ada layout', 'Konser/SoundOfDowntown/TnC.png'),
(9, 'CHANYEOL FANCON TOUR “THE ETERNITY” in JAKARTA', 'Fan Meet', 'Fancon Chanyeol EXO di Jakarta akan diboyong oleh iMe Indonesia selaku promotor. Namun, hingga kini belum ada keterangan resmi dari promotor mengenai lokasi, harga, dan jadwal penjualan tiket fancon tersebut.\r\nChanyeol akan datang seorang diri setelah beberapa kali tercatat menyambangi Indonesia bersama rekan sesama member EXO. Beberapa waktu lalu, Chanyeol bergabung dengan member EXO lainnya ketika menghadiri Meet and Greet Glow to You pada 27 Agustus 2023.', 'Jakarta', 'Indonesia Convention Exhibition (ICE),BSD City', '2024-03-09', '2024-03-09', '15:00', '19:00', 12, 'Konser/TheEternity/Poster.jpg', 'Konser/TheEternity/Poster.2.png', 'Konser/TheEternity/Layout.jpg', 'belum'),
(10, 'YOONA FAN MEETING TOUR : YOONITE in JAKARTA', 'Fan Meet', 'Kedatangan YoonA ke Jakarta merupakan bagian dari fanmeeting tour-nya di Asia yang sudah dilaksanakan sejak Januari 2024 lalu. Menjadi destinasi akhir dari rangkaian fanmeeting tour, YoonA akan mampir ke Jakarta pada bulan Maret mendatang. Sebelumnya acara jumpa penggemar ini dijadwalkan pada 29 Maret 2024, namun dimajukan jadi lebih cepat pada tanggal 3 Maret 2024.\r\n\r\nAcara bertajuk “YOONITE: YoonA Fan Meeting Tour In Jakarta” ini akan diselenggarakan di Beach City International Stadium, Ancol, pukul 15.00 WIB. Bestie Entertainment bekerja sama dengan Amprovise Group selaku promotor acara ini juga sudah merilis harga tiket dan seat plan, lho!', 'Jakarta', 'Tennis Indoor Senayan', '2024-03-03', '2024-03-03', '15:00', '19:00', 12, 'Konser/YOONITE/Poster.2.jpg', 'Konser/YOONITE/Poster.1.jpg', 'Konser/YOONITE/Layout.1.jpg', 'belum'),
(11, 'Bless This Concert in JAKARTA', 'Konser', 'Celebration of Love, Dreams & Friend.', 'Pontianak', 'Halaman Grand Mahkota Hotel', '2024-04-30', '2024-04-30', '14:00', '19:00', 11, 'Konser/BlessThisConcert/Poster.jpg', 'Konser/BlessThisConcert/Poster.2.png', 'Tidak ada layout', 'belum'),
(12, '2024 RIIZE FAN-CON ‘RIIZING DAY’ in JAKARTA', 'Fan Meet', 'Boy group RIIZE, yang berada di bawah naungan SM Entertainment, resmi debut pada tanggal 4 September 2023. \r\n \r\nUsai comeback dengan lagu “Impossible”, RIIZE rilis 3 lagu baru dan mini al\r\nbum pada 29 April 2024. Mereka merilis mini album bertajuk RIIZING, yang terdiri dari 5 lagu termasuk title track, “Siren”. Selain lagu tersebut, RIIZE juga merilis lagu-lagu lain seperti “9 Days”, “Honestly”, dan “One Kiss”. ', 'Jakarta', 'Indonesia Convention Exhibition (ICE) BSD', '2024-08-31', '2024-08-31', '15:00', '23:00', 12, 'Konser/Riize/Poster.webp', 'Konser/Riize/Header.jpg', 'Konser/Riize/Layout.png', 'Konser/Riize/tnc(RIIZZE).png');

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
  `pembayaran` enum('BCA','BNI','Mandiri','OVO','GoPay','ShopeePay') NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `total_harga`, `pembayaran`, `tanggal_pesan`, `id_user`) VALUES
(1, 500000.00, 'BCA', '2024-06-06', 1),
(2, 4275000.00, 'OVO', '2024-06-09', 1);

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
(24, 'CAT 3', 'Cat 3 seatting', 1200000.00, 0, '2024-05-11', 3),
(25, 'CAT 2', 'CAT 2 Numbered Seating', 1400000.00, 20, '2024-05-11', 3),
(26, 'CAT 1', 'CAT 1 Numbered Seating', 1600000.00, 15, '2024-05-11', 3),
(27, 'FESTIVAL 2', 'FESTIVAL 2 Numbered Seating', 1800000.00, 0, '2024-05-11', 3),
(28, 'FESTIVAL 1', 'FESTIVAL 1 Numbered Seating', 2000000.00, 0, '2024-05-11', 3),
(33, 'PURPLE B', 'PURPLE B (Seating)', 1200000.00, 0, '2022-07-11', 4),
(34, 'PINK', 'PINK (Seating)', 1700000.00, 0, '2022-07-11', 4),
(35, 'GREEN B', 'GREEN B (Seating)', 2200000.00, 0, '2022-07-11', 4),
(36, 'YELLOW', 'YELLOW (Seating)', 2400000.00, 0, '2022-07-11', 4),
(37, 'BLUE A', 'PURPLE B (Festival)', 2800000.00, 0, '2022-07-11', 4),
(38, 'PREMIUM DAY 2 ', 'NORMAL PRICE | PREMIUM DAY 2', 225000.00, 35, '2024-04-28', 5),
(39, 'FESTIVAL DAY 2 ', 'NORMAL PRICE | FESTIVAL DAY 2', 165000.00, 12, '2024-04-28', 5),
(40, ' FESTIVAL DAY 1 ', 'PRESALE 2 | FESTIVAL DAY 1 ', 150000.00, 15, '2024-04-27', 5),
(41, 'FESTIVAL 2 DAYS PASS', 'PRESALE 2 | FESTIVAL 2 DAYS PASS', 270000.00, 0, '2024-04-27', 5),
(42, 'PREMIUM DAY 1', 'PRESALE 2 | PREMIUM DAY 1 ', 210000.00, 21, '2024-04-27', 5),
(43, 'PREMIUM 2 DAYS PASS', 'PRESALE 2 | PREMIUM 2 DAYS PAS', 370000.00, 19, '2024-04-27', 5),
(44, 'CAT 2', 'CAT 2 Numbered Seating', 1000000.00, 4, '2024-04-20', 6),
(45, 'CAT 1', 'CAT 1 Numbered Seating', 1700000.00, 4, '2024-04-20', 6),
(46, 'VIP', 'VIP Numbered Seating', 2800000.00, 0, '2024-04-20', 6),
(47, 'VVIP', 'VIP Numbered Seating', 3200000.00, 0, '2024-04-20', 6),
(48, 'CAT 1A, 1B', 'SEATED', 2900000.00, 0, '2024-04-27', 7),
(49, 'CAT 2A, 2B, 2C', 'SEATED', 2700000.00, 0, '2024-04-27', 7),
(50, 'CAT 3A, 3B, 3C', 'SEATED', 1900000.00, 0, '2024-04-27', 7),
(51, 'CAT 4A, 4B', 'SEATED', 1500000.00, 0, '2024-04-27', 7),
(52, 'CAT 5A, 5B', 'SEATED', 1100000.00, 0, '2024-04-27', 7),
(53, 'TOD - DAY 1', 'FESTIVAL', 167900.00, 20, '2024-08-03', 8),
(54, 'TOD - DAY 2', 'FESTIVAL', 167900.00, 62, '2024-08-04', 8),
(55, 'TOD - 2 DAY PASS', 'FESTIVAL', 283900.00, 25, '2024-08-03', 8),
(56, 'SOD - DAY 1', 'FESTIVAL', 293900.00, 0, '2024-08-03', 8),
(57, 'SOD - DAY 2', 'FESTIVAL', 293900.00, 68, '2024-08-04', 8),
(58, 'SOD - 2 DAY PASS', 'FESTIVAL', 503900.00, 8, '2024-08-03', 8),
(59, 'CAT 3', 'FESTIVAL', 1400000.00, 0, '2024-03-09', 9),
(60, 'CAT 2', 'FESTIVAL', 1850000.00, 0, '2024-03-09', 9),
(61, 'CAT 1', 'FESTIVAL', 2350000.00, 0, '2024-03-09', 9),
(62, 'VIP', 'FESTIVAL', 2700000.00, 0, '2024-03-09', 9),
(63, 'CAT 3', 'FESTIVAL', 1800000.00, 0, '2024-03-03', 10),
(64, 'CAT 2', 'FESTIVAL', 2100000.00, 0, '2024-03-03', 10),
(65, 'CAT 1', 'FESTIVAL', 2500000.00, 0, '2024-03-03', 10),
(66, 'VIP', 'FESTIVAL', 2900000.00, 0, '2024-03-03', 10),
(67, 'Reguler', 'FESTIVAL', 200000.00, 0, '2024-03-08', 11),
(68, 'Couple Ticket', 'FESTIVAL', 350000.00, 0, '2024-03-08', 11),
(69, 'Presale', 'FESTIVAL', 175000.00, 0, '2024-03-08', 11),
(70, 'Early Bird', 'FESTIVAL', 150000.00, 0, '2024-03-08', 11),
(71, 'Eid Al Fitr Ticket (Promo 5 Ticket)', 'FESTIVAL', 8750000.00, 0, '2024-03-08', 11),
(72, 'CAT 1A, B SOUNDCHECK', 'Standing', 2700000.00, 40, '2024-08-31', 12),
(73, 'CAT 1', 'Standing', 2300000.00, 40, '2024-08-31', 12),
(74, 'CAT 2', 'Seating', 2200000.00, 20, '2024-08-31', 12),
(75, 'CAT 3', 'Standing', 1700000.00, 5, '2024-08-31', 12),
(76, 'CAT 4', 'Standing', 1250000.00, 0, '2024-08-31', 12);

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
  MODIFY `id_artis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `featuring`
--
ALTER TABLE `featuring`
  MODIFY `id_featuring` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `konser`
--
ALTER TABLE `konser`
  MODIFY `id_konser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pemesan_tiket`
--
ALTER TABLE `pemesan_tiket`
  MODIFY `id_pemesanTiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

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

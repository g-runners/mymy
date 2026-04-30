-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 07:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grady_ukom`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `penulis` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `tahun_terbit` int(5) DEFAULT NULL,
  `deskripsi` longtext DEFAULT NULL,
  `isi` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `id_kategori`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `deskripsi`, `isi`) VALUES
(1111, 0, 'Bumi', 'Tere Liye', 'Gramedia', 2014, 'Menceritakan petualangin Raib di dunia pararel.', NULL),
(1112, 0, 'Bulan', 'Tere Liye', 'Gramedia', 2015, 'Menceritakan petualangin Raib di dunia pararel.\r\nBuku ke-2 dari series \"Bumi\"', NULL),
(1113, 0, 'Matahari', 'Tere Liye', 'Gramedia', 2016, 'Menceritakan petualangin Raib di dunia pararel.\r\nBuku ke-3 dari series \"Bumi\"', NULL),
(1114, 0, 'Bintang', 'Tere Liye', 'Gramedia', 2017, 'Menceritakan petualangin Raib di dunia pararel.\r\nBuku ke-4 dari series \"Bumi\"', NULL),
(1115, 0, 'Ceros dan Batozar', 'Tere Liye', 'Gramedia', 2018, 'Menceritakan petualangin Raib di dunia pararel.\r\nBuku ke-4.5 dari series \"Bumi\"', NULL),
(1116, 0, 'Komet', 'Tere Liye', 'Gramedia', 2019, 'Menceritakan petualangin Raib di dunia pararel.\r\nBuku ke-5 dari series \"Bumi\"', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku`
--

CREATE TABLE `kategoribuku` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoribuku`
--

INSERT INTO `kategoribuku` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Fantasi'),
(2, 'Aksi'),
(3, 'Komedi'),
(4, 'Horor');

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku_relasi`
--

CREATE TABLE `kategoribuku_relasi` (
  `id_kategoribuku` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `koleksipribadi`
--

CREATE TABLE `koleksipribadi` (
  `id_koleksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `tenggat` date DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `status_peminjaman` enum('Dipinjam','Dikembalikan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `ulasan` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(8) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telepon` int(15) DEFAULT NULL,
  `level` enum('admin','petugas','anggota','dumb') DEFAULT 'anggota'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `no_telepon`, `level`) VALUES
(20259870, '***', '***', '***', '***', 'Untuk melongkap auto increment sehingga regis user baru tidak menghasilkan id_user dengan angka kecil (BIAR CAKEP AJA)', 0, 'dumb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `kategoriID` (`id_kategori`);

--
-- Indexes for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD PRIMARY KEY (`id_kategoribuku`,`id_buku`,`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD PRIMARY KEY (`id_koleksi`,`id_user`,`id_buku`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD UNIQUE KEY `id_user` (`id_user`,`id_buku`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`,`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  MODIFY `id_kategoribuku` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  MODIFY `id_koleksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20259871;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategoribuku` (`id_kategori`),
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Constraints for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD CONSTRAINT `koleksipribadi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `koleksipribadi_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

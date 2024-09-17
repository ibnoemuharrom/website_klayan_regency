-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Sep 2024 pada 09.35
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perumahan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about`
--

CREATE TABLE `about` (
  `id` int(10) NOT NULL,
  `deskripsi` text NOT NULL,
  `image_about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `about`
--

INSERT INTO `about` (`id`, `deskripsi`, `image_about`) VALUES
(1, 'Perumahan Klayan Regency merupakan pengembang perumahan mitra keluarga dengan sistem pembayaran syariah di wilayah Jl. Raya Klayan Desa Klayan Kecamatan Gunung Jati Kabupaten Cirebon.', '20220727043311about.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `brosur`
--

CREATE TABLE `brosur` (
  `id` int(10) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `brosur`
--

INSERT INTO `brosur` (`id`, `file`) VALUES
(2, '20220727_063039_8456.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact`
--

CREATE TABLE `contact` (
  `id` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `contact`
--

INSERT INTO `contact` (`id`, `nama`, `email`, `no_hp`, `pesan`) VALUES
(1, 'Dino Anka Pratama', 'dinoanka@gmail.com', '081882991882', 'Saya tertarik dengan rumah yang anda jual dengan type 45/70'),
(2, 'Rizky Cahyana Saputra', 'rizkycahyana@gmail.com', '089291881991', 'Saya tertarik dengan rumah yang anda jual dengan type 45/70');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_harga`
--

CREATE TABLE `daftar_harga` (
  `id` int(10) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `daftar_harga`
--

INSERT INTO `daftar_harga` (`id`, `file`) VALUES
(2, '20220727_063102_7313.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_rumah`
--

CREATE TABLE `data_rumah` (
  `id_rumah` int(10) NOT NULL,
  `no_rumah` varchar(50) NOT NULL,
  `type_rumah` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_rumah`
--

INSERT INTO `data_rumah` (`id_rumah`, `no_rumah`, `type_rumah`, `status`) VALUES
(6, 'A1', '1', 'terjual'),
(7, 'A2', '1', 'terjual'),
(8, 'A3', '2', 'belum_terjual');

-- --------------------------------------------------------

--
-- Struktur dari tabel `header`
--

CREATE TABLE `header` (
  `id` int(10) NOT NULL,
  `deskripsi` text NOT NULL,
  `image_header` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `header`
--

INSERT INTO `header` (`id`, `deskripsi`, `image_header`) VALUES
(1, 'Perumahan Klayan Regency merupakan pengembang perumahan mitra keluarga dengan sistem pembayaran syariah di wilayah Jl. Raya Klayan Desa Klayan Kecamatan Gunung Jati Kabupaten Cirebon. Semenjak di dirikan sudah banyak yang membeli unit rumah di karenakan wilayahnya yang sangat strategis.', '20220727043256banner.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(10) NOT NULL,
  `id_pembeli` int(10) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `pembayaran` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembeli`, `keterangan`, `tanggal`, `pembayaran`) VALUES
(1, 1, 'Angsuran Pembayaran Ke-1', '2022-08-05', '1000000'),
(2, 1, 'Angsuran Pembayaran Ke-2', '2022-08-06', '1500000'),
(3, 2, 'Angsuran Pembayaran Ke-1', '2022-08-05', '1000000'),
(4, 2, 'Angsuran Pembayaran Ke-2', '2022-08-06', '1500000'),
(5, 1, 'Angsuran Pembayaran Ke-3', '2022-08-07', '1000000'),
(6, 1, 'Angsuran Pembayaran Ke-4', '2022-08-08', '1000000'),
(7, 2, 'Angsuran Pembayaran Ke-3', '2022-08-07', '1000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `jumlah_pembayaran` int(30) NOT NULL,
  `type_rumah` int(30) NOT NULL,
  `no_rumah` varchar(30) NOT NULL,
  `foto_ktp` varchar(100) NOT NULL,
  `foto_kk` varchar(100) NOT NULL,
  `foto_suratnikah` varchar(100) NOT NULL,
  `foto_npwp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama`, `alamat`, `no_hp`, `jumlah_pembayaran`, `type_rumah`, `no_rumah`, `foto_ktp`, `foto_kk`, `foto_suratnikah`, `foto_npwp`) VALUES
(1, 'Nurul Ibnu Al Muharom', 'Desa Wanasabalor Blok Kuang Kec. Talun Kab. Cirebon', '081993820719', 290000000, 3, 'A3', '20220801_193938_icon_ktp.png', '20220801_193938_icon_kk.png', '20220801_193938_icon_snikah.png', '20220801_193938_icon_npwp.png'),
(2, 'Dino Anka Pratama', 'Jl. Jendral Ahma Yani Pegambiran Kec. Lemahwungkuk', '089920012002', 200000000, 1, 'A2', '20220801_191130_icon_ktp.png', '20220801_191130_icon_kk.png', '20220801_191130_icon_snikah.png', '20220801_191130_icon_npwp.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(10) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `type_rumah` int(10) NOT NULL,
  `harga` varchar(30) NOT NULL,
  `lb` int(10) NOT NULL,
  `lt` int(10) NOT NULL,
  `jumlah_kt` int(10) NOT NULL,
  `jumlah_km` int(10) NOT NULL,
  `carport` int(10) NOT NULL,
  `foto` text NOT NULL,
  `foto_denah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `judul`, `deskripsi`, `type_rumah`, `harga`, `lb`, `lt`, `jumlah_kt`, `jumlah_km`, `carport`, `foto`, `foto_denah`) VALUES
(1, 'Rumah Type 45/70', 'Dapatkan rumah type 36/60 perumahan klayan regency mulai harga 250.000.000', 2, '250000000', 70, 140, 3, 2, 1, '20220728_160453_rumah.png', '20220728_160821_denah-rumah.png'),
(2, 'Rumah Type 36/60', 'Dapatkan rumah type 36/60 perumahan klayan regency mulai harga 190.000.000', 1, '190000000', 60, 120, 2, 1, 1, '20220728_161209_rumah.png', '20220728_161209_denah-rumah.png'),
(3, 'Rumah Type 50/70', 'Dapatkan rumah type 36/60 perumahan klayan regency mulai harga 290.000.000', 4, '290000000', 90, 180, 3, 2, 1, '20220728_161350_rumah.png', '20220728_161350_denah-rumah.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `type`
--

CREATE TABLE `type` (
  `id` int(10) NOT NULL,
  `type_rumah` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `type`
--

INSERT INTO `type` (`id`, `type_rumah`) VALUES
(1, '36/60'),
(2, '45/70'),
(3, '55/70'),
(4, '50/70');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `nama`) VALUES
(4, 'nrlibnuam@gmail.com', '$2y$10$wuzTdShnQDFGCUlIUw1dJOQxOCRUvg9O9x0N36PPMNAcBZzKCyTam', 'Nurul Ibnu Al Muharom'),
(5, 'admin@demo.com', '$2y$10$QeCaH3iVOP9gK4O8JdbJ5OtXfDXmEDIKFKHEccmfathR8aaSJT9Mm', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `brosur`
--
ALTER TABLE `brosur`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `daftar_harga`
--
ALTER TABLE `daftar_harga`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_rumah`
--
ALTER TABLE `data_rumah`
  ADD PRIMARY KEY (`id_rumah`);

--
-- Indeks untuk tabel `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about`
--
ALTER TABLE `about`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `brosur`
--
ALTER TABLE `brosur`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `daftar_harga`
--
ALTER TABLE `daftar_harga`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_rumah`
--
ALTER TABLE `data_rumah`
  MODIFY `id_rumah` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `header`
--
ALTER TABLE `header`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `type`
--
ALTER TABLE `type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

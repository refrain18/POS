-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jan 2021 pada 08.46
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mumq3842_keu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(10) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` enum('masuk','izin','sakit','absen') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `gaji_id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `gaji_pokok` int(10) NOT NULL,
  `tunjangan` int(10) NOT NULL,
  `loyalitas` int(10) NOT NULL,
  `kedisiplinan` int(10) NOT NULL,
  `transport_umakan` int(10) NOT NULL,
  `total_gaji` int(10) NOT NULL,
  `tpi_tel` int(10) NOT NULL,
  `total_terima` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`gaji_id`, `pegawai_id`, `periode_awal`, `periode_akhir`, `gaji_pokok`, `tunjangan`, `loyalitas`, `kedisiplinan`, `transport_umakan`, `total_gaji`, `tpi_tel`, `total_terima`) VALUES
(4, 6, '2021-01-01', '2021-01-31', 2000000, 100000, 20000, 10000, 50000, 2180000, 50000, 2130000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_perawatan`
--

CREATE TABLE `jenis_perawatan` (
  `jp_id` int(11) NOT NULL,
  `nama_perawatan` varchar(30) NOT NULL,
  `harga` int(10) NOT NULL,
  `waktu` time NOT NULL,
  `komisi` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_perawatan`
--

INSERT INTO `jenis_perawatan` (`jp_id`, `nama_perawatan`, `harga`, `waktu`, `komisi`) VALUES
(2, 'Lulur Spa', 225000, '02:30:00', 3500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kinerja`
--

CREATE TABLE `kinerja` (
  `kinerja_id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `telponan` enum('ya','tidak') NOT NULL,
  `piket_bersih` enum('piket','tidak') NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(10) NOT NULL,
  `waktu` date NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` int(12) NOT NULL,
  `diskon` int(3) NOT NULL DEFAULT 0,
  `jenis_transaksi` varchar(10) NOT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `qty` int(4) NOT NULL,
  `sub_total` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`payment_id`, `waktu`, `nama_produk`, `harga`, `diskon`, `jenis_transaksi`, `gambar`, `qty`, `sub_total`) VALUES
(27, '2021-01-04', 'Matrai', 45000, 0, 'kredit', '16097327218694260073105750722021.jpg', 1, 45000),
(28, '2021-01-06', 'Token Listrik (04-01-2021)', 202500, 0, 'kredit', '16097424587306707361928487870105.jpg', 1, 202500),
(30, '2021-01-05', 'Closing salon ( senin, 04-01-2021 )', 1784000, 0, 'debet', '1609813280535-1694140371.jpg', 1, 1784000),
(31, '2021-01-05', 'Toko dunia cantik', 1776500, 0, 'kredit', '16098415135192986277780834975691.jpg', 1, 1776500),
(32, '2021-01-05', 'Closing salon ( selasa, 05-01-2021 )', 499250, 0, 'debet', 'IMG20210105172548-min.jpg', 1, 499250),
(33, '2021-01-06', 'Minuman jahe 3 pcs (06-01-2021)', 30000, 0, 'kredit', '16099054901131269388115898151244.jpg', 1, 30000),
(34, '2021-01-06', 'Kunci lemari + upah pemasangan (06-01-2021)', 40000, 0, 'kredit', '16099059298935652167939823362201.jpg', 1, 40000),
(35, '2021-01-06', 'Minuman jahe  (31-12-2020)', 7500, 0, 'kredit', '16099093497322141046180777547047.jpg', 1, 7500),
(36, '2021-01-06', 'Kamper ( 31-12-2020)', 18000, 0, 'kredit', '16099095681329180393091001725588.jpg', 1, 18000),
(37, '2021-01-06', 'Steker (31-12-2020)', 6000, 0, 'kredit', '16099097456421576890857856030182.jpg', 1, 6000),
(38, '2021-01-06', 'Coffe kojie u/tamu (31-12-2020)', 20000, 0, 'kredit', '16099099079355510123567293915693.jpg', 1, 20000),
(39, '2021-01-06', 'Kabel + upah ( 31-12-2020)', 50000, 0, 'kredit', '16099100372346024523100941394269.jpg', 1, 50000),
(40, '2021-01-06', 'Laundry luar (31-12-2020)', 120000, 0, 'kredit', '16099101255721363611806816567254.jpg', 1, 120000),
(41, '2021-01-06', 'Laundry luar (31-12-2020)', 71000, 0, 'kredit', '16099102005196935456266544922116.jpg', 1, 71000),
(42, '2021-01-06', 'Minuman jahe (01-01-2021)', 8900, 0, 'kredit', '16099105075182522984872201678821.jpg', 1, 8900),
(43, '2021-01-06', 'Oikos gas (01-01-2021)', 21000, 0, 'kredit', '16099106100438935351853460397481.jpg', 1, 21000),
(44, '2021-01-06', 'Produk salon oxidant (04-01-2021)', 630000, 0, 'kredit', '16099111012493948584536674933153.jpg', 1, 630000),
(45, '2021-01-06', 'Air minum (04-01-2021)', 150000, 0, 'kredit', '16099112277142892165505999947304.jpg', 1, 150000),
(46, '2021-01-06', 'Pulsa hp salon (04-01-2021)', 27000, 0, 'kredit', '16099114741872262996761852843746.jpg', 1, 27000),
(47, '2021-01-06', 'Intertaint manajement (04-01-2021)', 107000, 0, 'kredit', '16099120088102108035434536978588.jpg', 1, 107000),
(48, '2021-01-06', 'Alfa straw (sabun) ( 06-01-2021)', 10500, 0, 'kredit', '1609921278856928219246372472741.jpg', 1, 10500),
(49, '2021-01-06', 'Laundry (06-01-2021)', 60000, 0, 'kredit', '16099261725182066931259813157134.jpg', 1, 60000),
(51, '2021-01-26', 'Closing salon (06-01-2021)', 1834000, 0, 'debet', '16099298237247979359469940219456.jpg', 1, 1834000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `pegawai_id` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tmpt_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `no_hp` int(13) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_bergabung` date NOT NULL,
  `status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`pegawai_id`, `nama`, `tmpt_lahir`, `tgl_lahir`, `jabatan`, `no_hp`, `alamat`, `tanggal_bergabung`, `status`) VALUES
(6, 'Asniah Haniyah', 'Jakarta', '1997-11-05', 'staf', 2147483647, 'jhghfytdrgf', '2021-01-01', 'on');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_salon`
--

CREATE TABLE `produk_salon` (
  `produk_id` int(10) NOT NULL,
  `waktu` date NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `stok` int(3) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk_salon`
--

INSERT INTO `produk_salon` (`produk_id`, `waktu`, `nama_produk`, `stok`, `harga`) VALUES
(1, '2021-01-25', 'Coloring Hair Dove', 10, 99000),
(4, '2021-01-26', 'super cream pantene', 9, 1700000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sop`
--

CREATE TABLE `sop` (
  `id_sop` int(10) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `jp_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `foto_pegawai` varchar(50) NOT NULL,
  `foto_customer` varchar(50) NOT NULL,
  `waktu` time NOT NULL,
  `hasil_rundown` varchar(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_keluar`
--

CREATE TABLE `stok_keluar` (
  `sk_id` int(11) NOT NULL,
  `produk_id` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `stok` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stok_keluar`
--

INSERT INTO `stok_keluar` (`sk_id`, `produk_id`, `tanggal`, `stok`) VALUES
(1, 4, '2021-01-26', 14),
(2, 1, '2021-01-26', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `stok_masuk_id` int(11) NOT NULL,
  `produk_id` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `stok` int(10) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stok_masuk`
--

INSERT INTO `stok_masuk` (`stok_masuk_id`, `produk_id`, `tanggal`, `stok`, `harga`) VALUES
(4, 4, '2021-01-26', 9, 108000),
(5, 4, '2021-01-26', 10, 90700),
(6, 1, '2021-01-26', 6, 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `level` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `phone` varchar(16) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `level`, `username`, `email`, `alamat`, `phone`, `password`) VALUES
(1, 'owner', 'umi', 'abka@mumtaza.com', 'j;n.lio hek depok', '081211288172', '38bcbfc45c757bef891fbc4fcbbe9674'),
(2, 'kasir', 'kasir', 'kasir@mumtaza.com', 'Pamulang', '081211208982', 'c7911af3adbd12a035b289556d96470a');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `pegawai_id` (`pegawai_id`);

--
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`gaji_id`),
  ADD KEY `pegawai_id` (`pegawai_id`);

--
-- Indeks untuk tabel `jenis_perawatan`
--
ALTER TABLE `jenis_perawatan`
  ADD PRIMARY KEY (`jp_id`);

--
-- Indeks untuk tabel `kinerja`
--
ALTER TABLE `kinerja`
  ADD PRIMARY KEY (`kinerja_id`),
  ADD KEY `pegawai_id` (`pegawai_id`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`pegawai_id`);

--
-- Indeks untuk tabel `produk_salon`
--
ALTER TABLE `produk_salon`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indeks untuk tabel `sop`
--
ALTER TABLE `sop`
  ADD PRIMARY KEY (`id_sop`),
  ADD KEY `pegawai_id` (`pegawai_id`),
  ADD KEY `jp_id` (`jp_id`);

--
-- Indeks untuk tabel `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD PRIMARY KEY (`sk_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indeks untuk tabel `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`stok_masuk_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gaji`
--
ALTER TABLE `gaji`
  MODIFY `gaji_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jenis_perawatan`
--
ALTER TABLE `jenis_perawatan`
  MODIFY `jp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kinerja`
--
ALTER TABLE `kinerja`
  MODIFY `kinerja_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `pegawai_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `produk_salon`
--
ALTER TABLE `produk_salon`
  MODIFY `produk_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `sk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `stok_masuk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `absen_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`pegawai_id`);

--
-- Ketidakleluasaan untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`pegawai_id`);

--
-- Ketidakleluasaan untuk tabel `kinerja`
--
ALTER TABLE `kinerja`
  ADD CONSTRAINT `kinerja_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`pegawai_id`);

--
-- Ketidakleluasaan untuk tabel `sop`
--
ALTER TABLE `sop`
  ADD CONSTRAINT `sop_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`pegawai_id`),
  ADD CONSTRAINT `sop_ibfk_2` FOREIGN KEY (`jp_id`) REFERENCES `jenis_perawatan` (`jp_id`);

--
-- Ketidakleluasaan untuk tabel `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD CONSTRAINT `stok_keluar_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk_salon` (`produk_id`);

--
-- Ketidakleluasaan untuk tabel `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD CONSTRAINT `stok_masuk_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk_salon` (`produk_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

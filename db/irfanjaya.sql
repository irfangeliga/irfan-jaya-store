-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Feb 2023 pada 16.06
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `irfanjaya`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukti`
--

CREATE TABLE `bukti` (
  `id_bukti` int(11) NOT NULL,
  `id_pesan` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `email_customer` varchar(50) NOT NULL,
  `total_pembayaran` int(200) NOT NULL,
  `image` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(10) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `jumlah` int(20) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `harga` int(255) NOT NULL,
  `foto` varchar(250) NOT NULL,
  `warna` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_jual` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pesan` int(11) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `email_customer` varchar(200) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `warna` varchar(400) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `nama_pesan` varchar(255) NOT NULL,
  `ukuran_pesan` varchar(50) NOT NULL,
  `warna_pesan` varchar(100) NOT NULL,
  `jumlah_pesan` int(11) NOT NULL,
  `harga` int(200) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `waktu` time NOT NULL,
  `metode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(64) NOT NULL,
  `ukuran_produk` varchar(255) NOT NULL,
  `warna_produk` varchar(64) NOT NULL,
  `stok_produk` int(255) NOT NULL,
  `harga_produk` int(255) NOT NULL,
  `foto_produk` varchar(500) NOT NULL,
  `deskripsi_produk` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `waktu` time NOT NULL,
  `target_produk` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `ukuran_produk`, `warna_produk`, `stok_produk`, `harga_produk`, `foto_produk`, `deskripsi_produk`, `tanggal`, `waktu`, `target_produk`) VALUES
(70, 'kaos batman', 'M,L,XL,XXL', 'Hitam,Putih,Merah,Abu-abu,biru', 30, 85, 'k4.png,k5.png,k6.png,k7.png', 'kaos bercorak abstrak dengan gambar indahnya burung langka dari Pulau Papua yaitu cendrawasi. bahan halus, tidak panas dibadan, tidak luntur dicuci asal saat disetrika dibalik untuk menjaga cat sablon tetap awet.', '2023-01-01', '16:51:57', 'anak-anak'),
(71, 'baju srigala', 'M,L,XL', 'Merah,Orange,Kuning', 30, 75, 'k11.png,k12.png,ka1.png', 'perempuan terkuat dalam hidupku,suluruh hatiku untukmu liliana . kau pantas dapatkan yang baik didunia semoga kita bertahan lama', '2023-01-01', '16:51:57', 'anak-anak'),
(72, 'baju srigala', 'M,L,XL', 'Merah,Orange,Kuning', 30, 75, 'k11.png,k12.png,ka1.png', 'perempuan terkuat dalam hidupku,suluruh hatiku untukmu liliana . kau pantas dapatkan yang baik didunia semoga kita bertahan lama', '2023-01-01', '16:51:57', 'anak-anak'),
(74, 'kaos batman', 'M,L,XL,XXL', 'Hitam,Putih,Merah,Abu-abu,biru', 30, 85, 'black hat.jpg,breadboard.jpg,cc.jpg', 'kaos bercorak abstrak dengan gambar indahnya burung langka dari Pulau Papua yaitu cendrawasi. bahan halus, tidak panas dibadan, tidak luntur dicuci asal saat disetrika dibalik untuk menjaga cat sablon tetap awet.', '08-01-23', '16:36:55', 'anak-anak'),
(77, 'kaos pantai papua', 's,m,xl', 'meRah,BiRU,OrAGE', 23, 90, 'Album_Musik_Pop.jpg,arduino.jpg,bandun.jpg', 'BAJU HANGAT DENGAN BAHAN PANTAI', '08-01-23', '16:36:31', 'pria,wanita');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `produk_riwayat` varchar(200) NOT NULL,
  `ukuran_riwayat` varchar(50) NOT NULL,
  `warna_riwayat` varchar(100) NOT NULL,
  `jumlah_riwayat` int(100) NOT NULL,
  `ongkir_riwayat` int(100) NOT NULL,
  `harga_riwayat` int(100) NOT NULL,
  `metode_pembayaran` varchar(100) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'default.svg',
  `alamat` varchar(300) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `photo`, `alamat`, `nomor`, `status`) VALUES
(28, 'gofur', 'irfan@gmail.com', '$2y$10$tCtM7OScHBSmcsM4YlkUnuwGrkroLNr2fwad.V8ZZShvnzzOmY12K', 'gofur', '3fc2caf6-118c-457d-8a28-8868c1753fda.jpeg', 'jl. merpati no. 2, kecamatan riau, kabupaten sunsun, provinsi papua', '081224456785', 'Customer'),
(32, 'admin', 'admin@gmail.com', '$2y$10$T1WkhQXohWaddPcV5.iiauSCuvn39kHoPsTc.Y4c7Xzg2XPIKB3ae', 'admin', '42393387-9c5c-4be4-97b8-49260708719e.jpeg', 'jl. kelapa no. 2, kecamatan riau, kabupaten sunsun, provinsi papua', '088131253676', 'Admin'),
(33, 'rasnan', 'rasnansyah@gmail.com', '$2y$10$CXzTmfwoln4HfoDuIaPVUuNNgY3bSpjEKbgd/NR9j0hqFlhbKxEfS', 'irfan rasnan', 'IMG_20200804_143141_543.jpg', 'jl. manggis no. 2, kecamatan riau, kabupaten sunsun, provinsi papua', '081344055653', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bukti`
--
ALTER TABLE `bukti`
  ADD PRIMARY KEY (`id_bukti`),
  ADD KEY `id_order` (`id_pesan`),
  ADD KEY `id_pengguna` (`id_customer`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_jual`),
  ADD KEY `id_pesanan` (`id_pesan`),
  ADD KEY `id_customer` (`id_user`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `id_barang` (`id_produk`),
  ADD KEY `id_orang` (`id_customer`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_pembeli` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bukti`
--
ALTER TABLE `bukti`
  MODIFY `id_bukti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=662;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_jual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bukti`
--
ALTER TABLE `bukti`
  ADD CONSTRAINT `id_order` FOREIGN KEY (`id_pesan`) REFERENCES `pesanan` (`id_pesan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_pengguna` FOREIGN KEY (`id_customer`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `id_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `id_customer` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `id_pesanan` FOREIGN KEY (`id_pesan`) REFERENCES `pesanan` (`id_pesan`);

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `id_barang` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_orang` FOREIGN KEY (`id_customer`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD CONSTRAINT `id_pembeli` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- Database: `db_salesorder`
-- Sistem Sales Order - PT Maju Jaya
-- Adaptasi dari template rental mobil

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_salesorder`
--
CREATE DATABASE IF NOT EXISTS `db_salesorder` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_salesorder`;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
-- (Pengganti tabel `mobil` pada template lama)
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(20) DEFAULT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama_produk`, `harga`, `stok`) VALUES
(1, 'TV-001', 'TV LED 32 Inch', 1800000, 25),
(2, 'TV-002', 'TV LED 43 Inch Smart TV', 3200000, 15),
(3, 'AC-001', 'AC Split 1 PK', 2900000, 20),
(4, 'AC-002', 'AC Split 1.5 PK', 3500000, 12),
(5, 'KP-001', 'Kipas Angin Berdiri', 350000, 50),
(6, 'KP-002', 'Kipas Angin Dinding', 250000, 40),
(7, 'KL-001', 'Kulkas 1 Pintu 150L', 2100000, 18),
(8, 'KL-002', 'Kulkas 2 Pintu 300L', 4500000, 10),
(9, 'MC-001', 'Mesin Cuci 1 Tabung 7Kg', 2400000, 14),
(10, 'MC-002', 'Mesin Cuci 2 Tabung 10Kg', 3100000, 8),
(11, 'RC-001', 'Rice Cooker 1.8L', 450000, 35),
(12, 'BL-001', 'Blender 2 in 1', 380000, 30);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat`, `telepon`) VALUES
(1, 'Toko Elektronik Sumber Jaya', 'Jl. Veteran No. 12, Tangerang', '08123456789'),
(2, 'CV Mitra Elektronik', 'Jl. Sudirman No. 45, Jakarta', '08111111111'),
(3, 'Toko Berkah Elektronik', 'Jl. Pajajaran No. 8, Bogor', '085714079912'),
(4, 'UD Sinar Terang', 'Jl. Asia Afrika No. 21, Bandung', '083467142514'),
(5, 'Toko Maju Bersama', 'Jl. Diponegoro No. 5, Depok', '081298765432');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
-- (Pengganti tabel `supir` pada template lama)
--

CREATE TABLE `sales` (
  `id_sales` int(11) NOT NULL,
  `kode_sales` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `status` enum('Aktif','Nonaktif') DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id_sales`, `kode_sales`, `nama`, `telepon`, `status`) VALUES
(1, 'SLS-001', 'Andi Pratama', '081234567001', 'Aktif'),
(2, 'SLS-002', 'Siti Rahmawati', '081234567002', 'Aktif'),
(3, 'SLS-003', 'Budi Hermawan', '081234567003', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','sales','manager') DEFAULT 'sales',
  `id_sales` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
-- Password default semua akun di bawah: "password123"
-- (md5 sementara, sesuaikan dengan library hashing template aslinya)
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `id_sales`, `nama`, `created_at`, `last_login`) VALUES
(1, 'admin', '482c811da5d5b4bc6d497ffa98491e38', 'admin', NULL, 'Administrator', '2026-06-02 13:47:28', NULL),
(2, 'manager', '482c811da5d5b4bc6d497ffa98491e38', 'manager', NULL, 'Bambang Manager', '2026-06-02 13:47:28', NULL),
(3, 'andi', '482c811da5d5b4bc6d497ffa98491e38', 'sales', 1, 'Andi Pratama', '2026-06-02 13:47:28', NULL),
(4, 'siti', '482c811da5d5b4bc6d497ffa98491e38', 'sales', 2, 'Siti Rahmawati', '2026-06-02 13:47:28', NULL),
(5, 'budi', '482c811da5d5b4bc6d497ffa98491e38', 'sales', 3, 'Budi Hermawan', '2026-06-02 13:47:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
-- (Header transaksi, pengganti tabel `pemesanan` pada template lama)
--

CREATE TABLE `sales_order` (
  `id_order` int(11) NOT NULL,
  `no_order` varchar(20) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_sales` int(11) DEFAULT NULL,
  `tanggal_order` date DEFAULT NULL,
  `status` enum('draft','dikirim','selesai','dibatalkan') DEFAULT 'draft',
  `total_harga` decimal(15,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`id_order`, `no_order`, `id_pelanggan`, `id_sales`, `tanggal_order`, `status`, `total_harga`) VALUES
(1, 'SO-2026-0001', 1, 1, '2026-06-10', 'selesai', 5400000.00),
(2, 'SO-2026-0002', 2, 1, '2026-06-12', 'dikirim', 3780000.00),
(3, 'SO-2026-0003', 3, 2, '2026-06-14', 'draft', 2900000.00),
(4, 'SO-2026-0004', 4, 3, '2026-06-15', 'dibatalkan', 950000.00),
(5, 'SO-2026-0005', 1, 2, '2026-06-18', 'selesai', 5600000.00),
(6, 'SO-2026-0006', 5, 1, '2026-06-20', 'draft', 830000.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_detail`
-- (Tabel baru - detail item per order, tidak ada di template lama)
--

CREATE TABLE `sales_order_detail` (
  `id_detail` int(11) NOT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga_satuan` bigint(20) DEFAULT NULL,
  `subtotal` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_order_detail`
--

INSERT INTO `sales_order_detail` (`id_detail`, `id_order`, `id_produk`, `jumlah`, `harga_satuan`, `subtotal`) VALUES
-- Order 1 (SO-2026-0001): 1 TV LED 32" + 1 AC 1PK + 2 Kipas Angin Berdiri = 5.400.000
(1, 1, 1, 1, 1800000, 1800000.00),
(2, 1, 3, 1, 2900000, 2900000.00),
(3, 1, 5, 2, 350000, 700000.00),
-- Order 2 (SO-2026-0002): Kulkas + Rice Cooker + Blender + 2 Kipas Dinding + Kipas Berdiri = 3.780.000
(4, 2, 7, 1, 2100000, 2100000.00),
(5, 2, 11, 1, 450000, 450000.00),
(6, 2, 12, 1, 380000, 380000.00),
(7, 2, 6, 2, 250000, 500000.00),
(8, 2, 5, 1, 350000, 350000.00),
-- Order 3 (SO-2026-0003): 1 AC 1PK = 2.900.000
(9, 3, 3, 1, 2900000, 2900000.00),
-- Order 4 (SO-2026-0004): 2 Kipas Angin Berdiri + 1 Kipas Dinding (dibatalkan) = 950.000
(10, 4, 5, 2, 350000, 700000.00),
(11, 4, 6, 1, 250000, 250000.00),
-- Order 5 (SO-2026-0005): 1 Mesin Cuci 1 Tabung + 1 TV LED 43" = 5.600.000
(12, 5, 9, 1, 2400000, 2400000.00),
(13, 5, 2, 1, 3200000, 3200000.00),
-- Order 6 (SO-2026-0006): 1 Blender + 1 Rice Cooker = 830.000
(14, 6, 12, 1, 380000, 380000.00),
(15, 6, 11, 1, 450000, 450000.00);

--
-- Indexes for dumped tables
--

ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sales`),
  ADD UNIQUE KEY `kode_sales` (`kode_sales`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_sales` (`id_sales`);

ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`id_order`),
  ADD UNIQUE KEY `no_order` (`no_order`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_sales` (`id_sales`);

ALTER TABLE `sales_order_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_produk` (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `sales`
  MODIFY `id_sales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `sales_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `sales_order_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id_sales`) ON DELETE SET NULL;

ALTER TABLE `sales_order`
  ADD CONSTRAINT `sales_order_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `sales_order_ibfk_2` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id_sales`);

ALTER TABLE `sales_order_detail`
  ADD CONSTRAINT `sales_order_detail_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `sales_order` (`id_order`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_order_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

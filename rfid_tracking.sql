-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Okt 2019 pada 04.40
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rfid_tracking`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE `devices` (
  `device_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `rfid` varchar(50) DEFAULT '',
  `name` varchar(50) DEFAULT '',
  `balance` double DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `devices`
--

INSERT INTO `devices` (`device_id`, `location_id`, `rfid`, `name`, `balance`, `created_at`, `updated_at`) VALUES
(1, 3, '0008166538', 'BH1234BD', 5000, '2019-10-17 10:59:16', '2019-10-26 14:06:01'),
(2, 1, '0005397421', 'BH4567BC', 1000000, '2019-10-26 05:02:00', '2019-10-26 14:05:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `device_log`
--

DROP TABLE IF EXISTS `device_log`;
CREATE TABLE `device_log` (
  `device_log_id` int(11) NOT NULL,
  `device_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `distance` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `datetime` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `device_log`
--

INSERT INTO `device_log` (`device_log_id`, `device_id`, `location_id`, `distance`, `price`, `balance`, `datetime`) VALUES
(271, 1, 1, 10.5, 8900, 100000, '2019-10-28 02:49:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `unique_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `latitude` double NOT NULL DEFAULT '0',
  `longitude` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `locations`
--

INSERT INTO `locations` (`location_id`, `unique_id`, `name`, `latitude`, `longitude`) VALUES
(1, '950726089', 'Watch Tower  1', 0.474736, 101.4405126),
(2, '966483842', 'Watch Tower  2', 0.463417, 101.393482),
(3, '935482823', 'Watch Tower  3', 0.50128, 101.509621),
(4, '993481283', 'Watch Tower  4', 0.415278, 101.43357);

-- --------------------------------------------------------

--
-- Struktur dari tabel `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes` (
  `route_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL DEFAULT '0',
  `location_from_id` int(11) DEFAULT NULL,
  `location_to_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `routes`
--

INSERT INTO `routes` (`route_id`, `device_id`, `location_from_id`, `location_to_id`) VALUES
(7, 1, 1, 3),
(8, 2, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`device_id`);

--
-- Indeks untuk tabel `device_log`
--
ALTER TABLE `device_log`
  ADD PRIMARY KEY (`device_log_id`);

--
-- Indeks untuk tabel `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indeks untuk tabel `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `devices`
--
ALTER TABLE `devices`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `device_log`
--
ALTER TABLE `device_log`
  MODIFY `device_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT untuk tabel `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

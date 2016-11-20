-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19 Nov 2016 pada 13.24
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sso`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `access_privileges`
--

CREATE TABLE `access_privileges` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL,
  `access_token` varchar(32) NOT NULL,
  `redirect_uri` text NOT NULL,
  `expires` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `access_privileges`
--

INSERT INTO `access_privileges` (`id`, `user_id`, `client_id`, `code`, `access_token`, `redirect_uri`, `expires`) VALUES
(73, 2, '1234567890', '24843', '23528', 'http://localhost/oauthClient_2/?callback', 1478708907),
(80, 2, 'c4ca4238a0b923820dcc509a6f75849b', '896', '11705', 'http://localhost/oauthClient/?callback', 1478748832),
(81, 2, '', '1534', '8543', '', 1478748914),
(83, 1, 'c4ca4238a0b923820dcc509a6f75849b', '1034', '29819', 'http://localhost/oauthClient/?callback', 1478749073),
(87, 1, '1234567890', '30868', '7997', 'http://localhost/oauthClient_2/?callback', 1478749420);

-- --------------------------------------------------------

--
-- Struktur dari tabel `apps_clients`
--

CREATE TABLE `apps_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `client_secret` varchar(32) NOT NULL,
  `logout_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `apps_clients`
--

INSERT INTO `apps_clients` (`id`, `client_id`, `client_secret`, `logout_url`) VALUES
(1, 'c4ca4238a0b923820dcc509a6f75849b', '4fc9b72a83a99a594d40b3971874a9be', 'http://localhost/oauthClient/?self_logout'),
(2, '1234567890', '0987654321', 'http://localhost/oauthClient_2/?self_logout');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`) VALUES
(1, 'user', '123456', 'Ahmad Lucky'),
(2, 'vendetta', 'v3nd3tt4', 'Okta Pilopa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_privileges`
--
ALTER TABLE `access_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apps_clients`
--
ALTER TABLE `apps_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_privileges`
--
ALTER TABLE `access_privileges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `apps_clients`
--
ALTER TABLE `apps_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

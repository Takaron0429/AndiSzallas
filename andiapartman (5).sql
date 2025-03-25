-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Már 24. 17:48
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `andiapartman`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `felhasznalonev` varchar(255) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `utolso_bejelentkezes` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `admin`
--

INSERT INTO `admin` (`admin_id`, `felhasznalonev`, `jelszo`, `email`, `utolso_bejelentkezes`, `created_at`, `updated_at`) VALUES
(1, 'Takács Áron', 'aron0429', 'takaron0429@gmail.com', '2025-03-24 15:46:35', NULL, NULL),
(2, 'Kelemen Andrea', 'andi68andi', 'andi68andi@gmail.com', '2025-01-31 09:32:03', NULL, NULL),
(3, 'Takács Zsolt', 'woker72', 'woker72@gmail.com', '2025-01-31 09:32:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `akciok`
--

CREATE TABLE `akciok` (
  `akcio_id` bigint(20) UNSIGNED NOT NULL,
  `cim` varchar(255) NOT NULL,
  `leiras` text DEFAULT NULL,
  `kedvezmeny_szazalek` decimal(8,2) NOT NULL,
  `kezdete` date NOT NULL,
  `vege` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `akciok`
--

INSERT INTO `akciok` (`akcio_id`, `cim`, `leiras`, `kedvezmeny_szazalek`, `kezdete`, `vege`, `created_at`, `updated_at`) VALUES
(1, 'Hosszú távú nyári tartózkodás', 'Akció, amely kedvezményt kínál, ha valaki több mint 7 nap és minimum 3 fő akkor minden további nap árából 10% kedvezmény', 10.00, '2025-01-01', '2025-08-31', NULL, '2025-03-06 09:37:13'),
(2, 'Kultúrális hét', 'Ha a környéken van kultúrális esemény/program (Szemes napok, Augusztus 20 környékén), akkor kedvezményt adhatunk azoknak, akik ezeken a napokon vannak.', 12.00, '2025-01-01', '2025-08-31', NULL, NULL),
(3, 'Foglalj előre, és spórolj!', 'Akció, amely kedvezményt biztosít azoknak, akik legalább 30 vagy 60 nappal előre foglalnak. 8%-os kedvezmény.', 8.00, '2025-01-01', '2025-08-31', NULL, NULL),
(4, 'Hűségprogram', 'Hűségpontok gyűjtése minden foglalás után, amit későbbi tartózkodáskor beválthatnak kedvezményre. 5% kedvezmény.', 5.00, '2025-01-01', '2025-08-31', NULL, NULL),
(5, 'Első foglalás Kedvezmény', 'Első foglalás esetén 15%-os kedvezmény.', 15.00, '2025-01-01', '2025-08-31', NULL, NULL),
(6, 'Nagy Családi kedvezmény', 'Ha egy család legalább 2+ felnőtt és 3+ gyermek foglalást helyez el, biztosítson egy 15-20%-os kedvezményt.', 15.00, '2025-01-01', '2025-08-31', NULL, NULL),
(7, 'Last minute akciók', 'Ha van még szabad hely (10 nap), akkor 15% kedvezmény az első 3 nappól.', 15.00, '2025-01-01', '2025-08-31', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `akcio_foglalas`
--

CREATE TABLE `akcio_foglalas` (
  `akcio_id` bigint(20) UNSIGNED NOT NULL,
  `foglalas_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `akcio_foglalas`
--

INSERT INTO `akcio_foglalas` (`akcio_id`, `foglalas_id`) VALUES
(1, 1),
(1, 5),
(1, 9),
(1, 13),
(1, 17),
(1, 21),
(1, 25),
(1, 29),
(1, 33),
(1, 37),
(1, 41),
(1, 45),
(1, 49),
(2, 2),
(2, 6),
(2, 10),
(2, 14),
(2, 18),
(2, 22),
(2, 26),
(2, 30),
(2, 34),
(2, 38),
(2, 42),
(2, 46),
(2, 50),
(3, 3),
(3, 7),
(3, 11),
(3, 15),
(3, 19),
(3, 23),
(3, 27),
(3, 31),
(3, 35),
(3, 39),
(3, 43),
(3, 47),
(3, 51),
(4, 4),
(4, 8),
(4, 12),
(4, 16),
(4, 20),
(4, 24),
(4, 28),
(4, 32),
(4, 36),
(4, 40),
(4, 44),
(4, 48),
(4, 52);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `chat_uzenetek`
--

CREATE TABLE `chat_uzenetek` (
  `chat_id` bigint(20) UNSIGNED NOT NULL,
  `vendeg_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `uzenet` text NOT NULL,
  `kuldes_datuma` timestamp NOT NULL DEFAULT current_timestamp(),
  `kuldo` enum('vendeg','admin') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `csomag_foglalas`
--

CREATE TABLE `csomag_foglalas` (
  `csomag_id` bigint(20) UNSIGNED NOT NULL,
  `foglalas_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `csomag_foglalas`
--

INSERT INTO `csomag_foglalas` (`csomag_id`, `foglalas_id`) VALUES
(1, 1),
(1, 3),
(1, 6),
(1, 9),
(1, 12),
(1, 15),
(1, 18),
(1, 21),
(1, 24),
(1, 27),
(1, 30),
(1, 33),
(1, 36),
(1, 39),
(1, 42),
(1, 45),
(1, 48),
(1, 51),
(2, 2),
(2, 4),
(2, 7),
(2, 10),
(2, 13),
(2, 16),
(2, 19),
(2, 22),
(2, 25),
(2, 28),
(2, 31),
(2, 34),
(2, 37),
(2, 40),
(2, 43),
(2, 46),
(2, 49),
(2, 52),
(3, 5),
(3, 8),
(3, 11),
(3, 14),
(3, 17),
(3, 20),
(3, 23),
(3, 26),
(3, 29),
(3, 32),
(3, 35),
(3, 38),
(3, 41),
(3, 44),
(3, 47),
(3, 50);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `erkezesi_csomagok`
--

CREATE TABLE `erkezesi_csomagok` (
  `csomag_id` bigint(20) UNSIGNED NOT NULL,
  `nev` varchar(255) NOT NULL,
  `leiras` text DEFAULT NULL,
  `ar` decimal(8,2) NOT NULL,
  `elerheto` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `erkezesi_csomagok`
--

INSERT INTO `erkezesi_csomagok` (`csomag_id`, `nev`, `leiras`, `ar`, `elerheto`, `created_at`, `updated_at`) VALUES
(1, 'Romantikus csomag', 'Romantikus élmény borral, csokoládéval, virággal, dekorációval a szobában.', 2500.00, 1, NULL, NULL),
(2, 'Reggeli csomag', 'Friss helyi alapanyagokból készült reggeli minden nap.', 2000.00, 1, NULL, NULL),
(3, 'Mini bár feltöltés', 'Mini bár feltöltés, italok és snackek a kényelmes pihenéshez', 2000.00, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `fizetesek`
--

CREATE TABLE `fizetesek` (
  `fizetes_id` bigint(20) UNSIGNED NOT NULL,
  `foglalas_id` bigint(20) UNSIGNED NOT NULL,
  `osszeg` decimal(8,2) NOT NULL,
  `fizetesi_mod` varchar(255) NOT NULL,
  `fizetesi_allapot` varchar(255) NOT NULL DEFAULT 'függőben',
  `tranzakcio_datuma` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `fizetesek`
--

INSERT INTO `fizetesek` (`fizetes_id`, `foglalas_id`, `osszeg`, `fizetesi_mod`, `fizetesi_allapot`, `tranzakcio_datuma`, `created_at`, `updated_at`) VALUES
(1, 1, 21600.00, 'utalás', 'fizetve', '2025-05-01 08:00:00', '2025-05-01 08:00:00', '2025-03-13 08:33:27'),
(2, 2, 51000.00, 'utalás', 'fizetve', '2025-05-05 08:00:00', '2025-05-05 08:00:00', '2025-05-05 08:00:00'),
(3, 3, 35000.00, 'utalás', 'fizetve', '2025-05-10 08:00:00', '2025-05-10 08:00:00', '2025-03-14 08:15:10'),
(4, 4, 46000.00, 'utalás', 'fizetve', '2025-05-15 08:00:00', '2025-05-15 08:00:00', '2025-03-15 10:22:12'),
(5, 5, 41000.00, 'utalás', 'fizetve', '2025-05-20 08:00:00', '2025-05-20 08:00:00', '2025-03-16 11:33:45'),
(6, 6, 49000.00, 'utalás', 'fizetve', '2025-05-25 08:00:00', '2025-05-25 08:00:00', '2025-03-17 08:11:13'),
(7, 7, 45000.00, 'utalás', 'fizetve', '2025-06-01 08:00:00', '2025-06-01 08:00:00', '2025-03-18 11:22:33'),
(8, 8, 53000.00, 'bankkártya', 'fizetve', '2025-06-05 08:00:00', '2025-06-05 08:00:00', '2025-03-19 08:00:11'),
(9, 9, 37000.00, 'bankkártya', 'fizetve', '2025-06-10 08:00:00', '2025-06-10 08:00:00', '2025-03-20 11:33:33'),
(10, 10, 42000.00, 'utalás', 'fizetve', '2025-06-15 08:00:00', '2025-06-15 08:00:00', '2025-03-21 09:33:19'),
(11, 11, 46000.00, 'bankkártya', 'fizetve', '2025-06-20 08:00:00', '2025-06-20 08:00:00', '2025-03-22 11:23:45'),
(12, 12, 52000.00, 'utalás', 'fizetve', '2025-06-25 08:00:00', '2025-06-25 08:00:00', '2025-03-23 12:33:12'),
(13, 13, 54000.00, 'utalás', 'fizetve', '2025-07-01 08:00:00', '2025-07-01 08:00:00', '2025-03-24 10:12:05'),
(14, 14, 47000.00, 'utalás', 'fizetve', '2025-07-05 08:00:00', '2025-07-05 08:00:00', '2025-03-25 13:22:22'),
(15, 15, 60000.00, 'utalás', 'fizetve', '2025-07-10 08:00:00', '2025-07-10 08:00:00', '2025-03-26 14:33:11'),
(16, 16, 53000.00, 'bankkártya', 'fizetve', '2025-07-15 08:00:00', '2025-07-15 08:00:00', '2025-03-27 15:00:22'),
(17, 17, 44000.00, 'bankkártya', 'fizetve', '2025-07-20 08:00:00', '2025-07-20 08:00:00', '2025-03-28 12:22:43'),
(18, 18, 57000.00, 'utalás', 'fizetve', '2025-07-25 08:00:00', '2025-07-25 08:00:00', '2025-03-29 16:15:34'),
(19, 19, 49000.00, 'utalás', 'fizetve', '2025-07-30 08:00:00', '2025-07-30 08:00:00', '2025-03-30 16:00:55'),
(20, 20, 51000.00, 'utalás', 'fizetve', '2025-08-04 08:00:00', '2025-08-04 08:00:00', '2025-03-31 17:22:14'),
(21, 21, 43000.00, 'bankkártya', 'fizetve', '2025-08-10 08:00:00', '2025-08-10 08:00:00', '2025-04-01 08:30:12'),
(22, 22, 60000.00, 'utalás', 'fizetve', '2025-08-15 08:00:00', '2025-08-15 08:00:00', '2025-04-02 09:10:32'),
(23, 23, 45000.00, 'utalás', 'fizetve', '2025-08-20 08:00:00', '2025-08-20 08:00:00', '2025-04-03 12:11:10'),
(24, 24, 57000.00, 'utalás', 'fizetve', '2025-08-25 08:00:00', '2025-08-25 08:00:00', '2025-04-04 14:00:21'),
(25, 25, 50000.00, 'bankkártya', 'fizetve', '2025-09-01 08:00:00', '2025-09-01 08:00:00', '2025-04-05 15:22:55'),
(26, 26, 58000.00, 'utalás', 'fizetve', '2025-09-05 08:00:00', '2025-09-05 08:00:00', '2025-04-06 16:33:45'),
(27, 27, 49000.00, 'utalás', 'fizetve', '2025-09-10 08:00:00', '2025-09-10 08:00:00', '2025-04-07 17:22:11'),
(28, 28, 47000.00, 'utalás', 'fizetve', '2025-09-15 08:00:00', '2025-09-15 08:00:00', '2025-04-08 18:00:12'),
(29, 29, 46000.00, 'utalás', 'fizetve', '2025-09-20 08:00:00', '2025-09-20 08:00:00', '2025-04-09 09:11:12'),
(30, 30, 51000.00, 'bankkártya', 'fizetve', '2025-09-25 08:00:00', '2025-09-25 08:00:00', '2025-04-10 10:12:21'),
(31, 31, 53000.00, 'utalás', 'fizetve', '2025-10-01 08:00:00', '2025-10-01 08:00:00', '2025-04-11 11:00:44'),
(32, 32, 54000.00, 'bankkártya', 'fizetve', '2025-10-05 08:00:00', '2025-10-05 08:00:00', '2025-04-12 12:22:33'),
(33, 33, 59000.00, 'utalás', 'fizetve', '2025-10-10 08:00:00', '2025-10-10 08:00:00', '2025-04-13 13:33:01'),
(34, 34, 46000.00, 'utalás', 'fizetve', '2025-10-15 08:00:00', '2025-10-15 08:00:00', '2025-04-14 14:22:11'),
(35, 35, 48000.00, 'utalás', 'fizetve', '2025-10-20 08:00:00', '2025-10-20 08:00:00', '2025-04-15 15:11:33'),
(36, 36, 50000.00, 'utalás', 'fizetve', '2025-10-25 08:00:00', '2025-10-25 08:00:00', '2025-04-16 16:00:22'),
(37, 37, 55000.00, 'bankkártya', 'fizetve', '2025-11-01 09:00:00', '2025-11-01 09:00:00', '2025-04-17 17:00:11'),
(38, 38, 51000.00, 'utalás', 'fizetve', '2025-11-05 09:00:00', '2025-11-05 09:00:00', '2025-04-18 18:00:01'),
(39, 39, 58000.00, 'utalás', 'fizetve', '2025-11-10 09:00:00', '2025-11-10 09:00:00', '2025-04-19 09:33:55'),
(40, 40, 55000.00, 'bankkártya', 'fizetve', '2025-11-15 09:00:00', '2025-11-15 09:00:00', '2025-04-20 10:33:12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foglalasi_modositasok`
--

CREATE TABLE `foglalasi_modositasok` (
  `modositas_id` bigint(20) UNSIGNED NOT NULL,
  `foglalas_id` bigint(20) UNSIGNED NOT NULL,
  `modositas_tipusa` varchar(50) NOT NULL,
  `kerestet_datuma` timestamp NOT NULL DEFAULT current_timestamp(),
  `allapot` varchar(50) NOT NULL DEFAULT 'függőben',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `foglalasi_modositasok`
--

INSERT INTO `foglalasi_modositasok` (`modositas_id`, `foglalas_id`, `modositas_tipusa`, `kerestet_datuma`, `allapot`, `created_at`, `updated_at`) VALUES
(1, 15, 'Felnőttek száma módosítás', '2020-04-18 20:00:00', 'elfogadva', '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(2, 24, 'Érkezés módosítás', '2021-03-12 21:00:00', 'elfogadva', '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(3, 31, 'Fizetés módosítás', '2021-06-25 20:00:00', 'elfogadva', '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(4, 40, 'Távozás módosítás', '2022-02-15 21:00:00', 'elfogadva', '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(5, 10, 'Felnőttek és gyerekek száma módosítás', '2022-07-03 20:00:00', 'elfogadva', '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(7, 9, 'Távozás módosítás', '2023-08-02 20:00:00', 'elfogadva', '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(8, 12, 'Felnőttek száma módosítás', '2024-01-19 21:00:00', 'elfogadva', '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(9, 22, 'Fizetés módosítás', '2024-04-06 20:00:00', 'elfogadva', '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(10, 30, 'Érkezés módosítás', '2024-09-09 20:00:00', 'elfogadva', '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(11, 43, 'Felnőttek és gyerekek száma módosítás', '2025-01-20 21:00:00', 'elfogadva', '2025-03-02 11:59:30', '2025-03-02 11:59:30');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foglalasok`
--

CREATE TABLE `foglalasok` (
  `foglalas_id` bigint(20) UNSIGNED NOT NULL,
  `vendeg_id` bigint(20) UNSIGNED DEFAULT NULL,
  `erkezes` date NOT NULL,
  `tavozas` date NOT NULL,
  `felnott` int(11) NOT NULL,
  `gyerek` int(11) NOT NULL,
  `osszeg` decimal(8,2) NOT NULL,
  `foglalas_allapot` varchar(255) NOT NULL DEFAULT 'függőben',
  `fizetes_allapot` varchar(255) NOT NULL DEFAULT 'függőben',
  `specialis_keresek` text DEFAULT NULL,
  `csomag_id` bigint(20) UNSIGNED DEFAULT NULL,
  `akcio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `foglalasok`
--

INSERT INTO `foglalasok` (`foglalas_id`, `vendeg_id`, `erkezes`, `tavozas`, `felnott`, `gyerek`, `osszeg`, `foglalas_allapot`, `fizetes_allapot`, `specialis_keresek`, `csomag_id`, `akcio_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-05-01', '2025-05-10', 2, 2, 90000.00, 'elfogadva', 'kifizetett', NULL, 1, 2, '2025-05-01 08:00:00', '2025-03-24 06:19:40'),
(2, 2, '2025-05-05', '2025-05-15', 3, 1, 51000.00, 'függőben', 'függőben', NULL, 2, 2, '2025-05-05 08:00:00', '2025-03-22 11:28:59'),
(3, 3, '2025-05-10', '2025-05-17', 3, 2, 87500.00, 'elfogadva', 'fizetve', NULL, 3, 6, '2025-05-10 08:00:00', '2025-03-22 14:25:55'),
(4, 4, '2025-05-15', '2025-05-22', 3, 1, 46000.00, 'elfogadva', 'fizetve', NULL, 2, 4, '2025-05-15 08:00:00', '2025-03-15 10:22:12'),
(5, 5, '2025-05-20', '2025-05-27', 2, 0, 41000.00, 'elfogadva', 'fizetve', NULL, 3, 1, '2025-05-20 08:00:00', '2025-03-16 11:33:45'),
(6, 6, '2025-05-25', '2025-06-01', 2, 1, 49000.00, 'elfogadva', 'fizetve', NULL, 1, 2, '2025-05-25 08:00:00', '2025-03-17 08:11:13'),
(7, 7, '2025-06-01', '2025-06-07', 2, 0, 145000.00, 'függőben', 'függőben', NULL, 2, 3, '2025-06-01 08:00:00', '2025-03-18 11:22:33'),
(8, 8, '2025-06-05', '2025-06-12', 3, 0, 53000.00, 'elfogadva', 'fizetve', NULL, 1, 1, '2025-06-05 08:00:00', '2025-03-19 08:00:11'),
(9, 9, '2025-06-10', '2025-06-17', 2, 1, 37000.00, 'elfogadva', 'fizetve', NULL, 2, 2, '2025-06-10 08:00:00', '2025-03-20 11:33:33'),
(10, 10, '2025-06-15', '2025-06-22', 2, 0, 42000.00, 'elfogadva', 'fizetve', NULL, 3, 1, '2025-06-15 08:00:00', '2025-03-21 09:33:19'),
(11, 11, '2025-06-20', '2025-06-27', 2, 1, 146000.00, 'elfogadva', 'fizetve', NULL, 1, 4, '2025-06-20 08:00:00', '2025-03-22 11:23:45'),
(12, 12, '2025-06-25', '2025-07-02', 3, 0, 52000.00, 'elfogadva', 'fizetve', NULL, 2, 3, '2025-06-25 08:00:00', '2025-03-23 12:33:12'),
(13, 13, '2025-07-01', '2025-07-08', 2, 1, 54000.00, 'elfogadva', 'fizetve', NULL, 1, 2, '2025-07-01 08:00:00', '2025-03-24 10:12:05'),
(14, 14, '2025-07-05', '2025-07-12', 2, 0, 47000.00, 'elfogadva', 'fizetve', NULL, 3, 4, '2025-07-05 08:00:00', '2025-03-25 11:24:18'),
(15, 15, '2025-07-10', '2025-07-17', 1, 1, 32000.00, 'elfogadva', 'fizetve', NULL, 2, 3, '2025-07-10 08:00:00', '2025-03-26 09:33:44'),
(16, 16, '2025-07-15', '2025-07-22', 2, 1, 49000.00, 'elfogadva', 'fizetve', NULL, 1, 2, '2025-07-15 08:00:00', '2025-03-27 08:11:27'),
(17, 17, '2025-07-20', '2025-07-27', 2, 0, 143000.00, 'elfogadva', 'fizetve', NULL, 2, 4, '2025-07-20 08:00:00', '2025-03-28 11:22:22'),
(18, 18, '2025-07-25', '2025-08-01', 3, 1, 54000.00, 'elfogadva', 'fizetve', NULL, 1, 1, '2025-07-25 08:00:00', '2025-03-29 10:00:00'),
(19, 19, '2025-08-01', '2025-08-08', 2, 0, 48000.00, 'elfogadva', 'fizetve', NULL, 2, 3, '2025-08-01 08:00:00', '2025-03-30 10:30:00'),
(20, 20, '2025-08-05', '2025-08-12', 3, 0, 53000.00, 'elfogadva', 'fizetve', NULL, 1, 4, '2025-08-05 08:00:00', '2025-03-31 08:00:00'),
(21, 21, '2025-08-10', '2025-08-17', 2, 1, 49000.00, 'elfogadva', 'fizetve', NULL, 3, 2, '2025-08-10 08:00:00', '2025-04-01 10:33:44'),
(22, 22, '2025-08-15', '2025-08-22', 1, 1, 137000.00, 'elfogadva', 'fizetve', NULL, 2, 4, '2025-08-15 08:00:00', '2025-04-02 07:22:11'),
(23, 23, '2025-08-20', '2025-08-27', 2, 0, 50000.00, 'elfogadva', 'fizetve', NULL, 1, 3, '2025-08-20 08:00:00', '2025-04-03 09:11:55'),
(24, 1, '2020-06-01', '2020-06-05', 2, 1, 22000.00, 'elfogadva', 'fizetve', NULL, 1, 2, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(25, 2, '2020-06-08', '2020-06-12', 3, 0, 32000.00, 'elfogadva', 'fizetve', NULL, 2, 1, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(26, 3, '2020-06-15', '2020-06-20', 1, 1, 17000.00, 'elfogadva', 'fizetve', NULL, 3, NULL, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(27, 4, '2020-06-22', '2020-06-27', 2, 2, 25000.00, 'elfogadva', 'fizetve', NULL, 1, 2, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(28, 5, '2020-06-25', '2020-06-30', 1, 0, 19000.00, 'elfogadva', 'fizetve', NULL, 2, 1, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(29, 6, '2020-07-01', '2020-07-06', 2, 1, 21000.00, 'elfogadva', 'fizetve', NULL, 1, NULL, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(30, 7, '2020-07-10', '2020-07-15', 3, 0, 33000.00, 'elfogadva', 'fizetve', NULL, 3, NULL, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(31, 8, '2020-07-15', '2020-07-20', 2, 2, 26000.00, 'elfogadva', 'fizetve', NULL, 1, 2, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(32, 9, '2020-07-22', '2020-07-27', 2, 1, 23000.00, 'elfogadva', 'fizetve', NULL, 2, 1, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(33, 10, '2020-07-30', '2020-08-04', 1, 1, 21000.00, 'elfogadva', 'fizetve', NULL, 3, NULL, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(34, 11, '2021-06-01', '2021-06-05', 2, 1, 22000.00, 'elfogadva', 'fizetve', NULL, 1, 2, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(35, 12, '2021-06-08', '2021-06-12', 3, 0, 32000.00, 'elfogadva', 'fizetve', NULL, 2, 1, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(36, 13, '2021-06-15', '2021-06-20', 1, 1, 17000.00, 'elfogadva', 'fizetve', NULL, 3, NULL, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(37, 14, '2021-06-22', '2021-06-27', 2, 2, 25000.00, 'elfogadva', 'fizetve', NULL, 1, 2, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(38, 15, '2021-06-25', '2021-06-30', 1, 0, 19000.00, 'elfogadva', 'fizetve', NULL, 2, 1, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(39, 16, '2021-07-01', '2021-07-06', 2, 1, 21000.00, 'elfogadva', 'fizetve', NULL, 1, NULL, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(40, 17, '2021-07-10', '2021-07-15', 3, 0, 33000.00, 'elfogadva', 'fizetve', NULL, 3, NULL, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(41, 18, '2021-07-15', '2021-07-20', 2, 2, 26000.00, 'elfogadva', 'fizetve', NULL, 1, 2, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(42, 19, '2021-07-22', '2021-07-27', 2, 1, 23000.00, 'elfogadva', 'fizetve', NULL, 2, 1, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(43, 20, '2021-07-30', '2021-08-04', 1, 1, 21000.00, 'elfogadva', 'fizetve', NULL, 3, NULL, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(44, 21, '2022-06-01', '2022-06-05', 2, 1, 22000.00, 'elfogadva', 'fizetve', NULL, 1, 2, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(45, 22, '2022-06-08', '2022-06-12', 3, 0, 32000.00, 'elfogadva', 'fizetve', NULL, 2, 1, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(46, 23, '2022-06-15', '2022-06-20', 1, 1, 17000.00, 'elfogadva', 'fizetve', NULL, 3, NULL, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(47, 24, '2022-06-22', '2022-06-27', 2, 2, 25000.00, 'elfogadva', 'fizetve', NULL, 1, 2, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(48, 25, '2022-06-25', '2022-06-30', 1, 0, 19000.00, 'elfogadva', 'fizetve', NULL, 2, 1, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(49, 26, '2022-07-01', '2022-07-06', 2, 1, 21000.00, 'elfogadva', 'fizetve', NULL, 1, NULL, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(50, 27, '2022-07-10', '2022-07-15', 3, 0, 33000.00, 'elfogadva', 'fizetve', NULL, 3, NULL, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(51, 28, '2022-07-15', '2022-07-20', 2, 2, 26000.00, 'elfogadva', 'fizetve', NULL, 1, 2, '2025-03-02 11:59:30', '2025-03-02 11:59:30'),
(52, 29, '2022-07-22', '2022-07-27', 2, 1, 23000.00, 'elfogadva', 'fizetve', NULL, 2, 1, '2025-03-02 11:59:30', '2025-03-02 11:59:30');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `helyi_programajanlok`
--

CREATE TABLE `helyi_programajanlok` (
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `cim` varchar(255) NOT NULL,
  `kep` varchar(255) NOT NULL,
  `leiras` text DEFAULT NULL,
  `helyszin` varchar(255) NOT NULL,
  `kezdet` varchar(255) NOT NULL,
  `vege` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `helyi_programajanlok`
--

INSERT INTO `helyi_programajanlok` (`program_id`, `cim`, `kep`, `leiras`, `helyszin`, `kezdet`, `vege`, `link`, `created_at`, `updated_at`) VALUES
(1, 'Balaton Sound Festival', 'http://balatonsound.hu/logo.png', 'Az egyik legismertebb elektronikus zenei fesztivál, Siófok mellett Zamárdiban. A legnagyobb nemzetközi DJ-k és előadók lépnek fel.', 'Zamárdi, Balaton-part', '2023-07-06', '2023-07-09', NULL, NULL, '2025-03-06 09:53:31'),
(2, 'Kövesdi Kézműves Fesztivál', 'http://kovesdikezmufesztival.hu/logo.png', 'A Balaton déli partján, a kis falu, Kövesd rendezvényén a látogatók helyi kézművesek portékáit vásárolhatják meg.', 'Kövesd, Fő tér', '2023-06-10', '2023-06-12', 'http://kovesdikezmufesztival.hu', NULL, NULL),
(3, 'Siófoki Jótékonysági Vásár', 'http://siofok.hu/logo.png', 'A helyi közösség szervezésében jótékonysági vásár, ahol használt ruhák, könyvek és egyéb termékek kaphatók a Balatonparton.', 'Siófok, Fő tér', '2023-05-20', '2023-05-20', 'http://siofok.hu', NULL, '2025-03-06 09:43:41'),
(4, 'Balaton Maraton', 'http://balatonmaraton.hu/logo.png', 'Év végi sportesemény, amely egyben a Balaton körüli maratoni futóverseny. A rendezvény mindenki számára elérhető, amatőröktől a profi sportolókig.', 'Balaton, környék', '2023-10-01', '2023-10-01', 'http://balatonmaraton.hu', NULL, '2025-03-06 09:42:16'),
(5, 'Tihanyi Levendula Fesztivál', 'http://tihanyilevendulafesztival.hu/logo.png', 'A levendula szüret idején megrendezett fesztivál Tihanyban, ahol a látogatók élvezhetik a levendula illatát, levendula alapú ételeket és italokat kóstolhatnak.', 'Tihany, Levendula-ház', '2023-06-25', '2023-07-05', 'http://tihanyilevendulafesztival.hu', NULL, NULL),
(6, 'Balaton Sound Festival', 'https://example.com/balaton_sound.jpg', 'Az egyik legismertebb elektronikus zenei fesztivál, Siófok mellett Zamárdiban. A legnagyobb nemzetközi DJ-k és előadók lépnek fel.', 'Zamárdi, Balaton-part', '2023-07-06', '2023-07-09', 'http://balatonsound.hu', NULL, NULL),
(7, 'Kövesdi Kézműves Fesztivál', 'https://example.com/kezmuves_fesztival.jpg', 'A Balaton déli partján, a kis falu, Kövesd rendezvényén a látogatók helyi kézművesek portékáit vásárolhatják meg.', 'Kövesd, Fő tér', '2023-06-10', '2023-06-12', 'http://kovesdikezmufesztival.hu', NULL, NULL),
(8, 'Siófoki Jótékonysági Vásár', 'https://example.com/jotekonysagi_vasar.jpg', 'A helyi közösség szervezésében jótékonysági vásár, ahol használt ruhák, könyvek és egyéb termékek kaphatók a Balatonparton.', 'Siófok, Fő tér', '2023-05-20', '2023-05-20', 'http://siofok.hu', NULL, NULL),
(9, 'Balaton Maraton', 'https://example.com/balaton_maraton.jpg', 'Év végi sportesemény, amely egyben a Balaton körüli maratoni futóverseny. A rendezvény mindenki számára elérhető, amatőröktől a profi sportolókig.', 'Balaton, környék', '2023-10-01', '2023-10-01', 'http://balatonmaraton.hu', NULL, NULL),
(10, 'Tihanyi Levendula Fesztivál', 'https://example.com/tihanyi_levendula_fesztival.jpg', 'A levendula szüret idején megrendezett fesztivál Tihanyban, ahol a látogatók élvezhetik a levendula illatát, levendula alapú ételeket és italokat kóstolhatnak.', 'Tihany, Levendula-ház', '2023-06-25', '2023-07-05', 'http://tihanyilevendulafesztival.hu', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(46, '0001_01_01_000000_create_users_table', 1),
(47, '0001_01_01_000001_create_cache_table', 1),
(48, '0001_01_01_000002_create_jobs_table', 1),
(49, '2025_01_26_130732_create_vendeg_table', 1),
(50, '2025_01_26_130733_create_admin_table', 1),
(51, '2025_01_26_130733_create_erkezesi_csomagok_table', 1),
(52, '2025_01_26_130734_create_akciok_table', 1),
(53, '2025_01_26_130734_create_foglalasok_table', 1),
(54, '2025_01_26_130735_create_fizetesek_table', 1),
(55, '2025_01_26_130735_create_velemenyek_table', 1),
(56, '2025_01_26_130736_create_chat_uzenetek_table', 1),
(57, '2025_01_26_130736_create_foglalasi_modositasok_table', 1),
(58, '2025_01_26_130737_create_akcio_foglalas_table', 1),
(59, '2025_01_26_130737_create_helyi_programajanlok_table', 1),
(60, '2025_01_26_130738_create_csomag_foglalas_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('v4uJYxom53c0800mcFJr41XQv798TSR1RBEEAmco', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM2tKVjZhVFBsRmQzYWpJUmEwdk1vWDdRZ1piZDlhM21VYmplTHhEcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9mb2dsYWx0LW5hcG9rIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1OiJhZG1pbiI7YTozOntzOjE0OiJmZWxoYXN6bmFsb25ldiI7czoxMzoiVGFrw6FjcyDDgXJvbiI7czo1OiJlbWFpbCI7czoyMToidGFrYXJvbjA0MjlAZ21haWwuY29tIjtzOjIwOiJ1dG9sc29fYmVqZWxlbnRrZXplcyI7czoxOToiMjAyNS0wMy0yNCAxNjo0NjozNSI7fX0=', 1742834811);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `velemenyek`
--

CREATE TABLE `velemenyek` (
  `velemeny_id` bigint(20) UNSIGNED NOT NULL,
  `nev` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ertekeles` int(11) NOT NULL,
  `komment` text DEFAULT NULL,
  `approved` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `velemenyek`
--

INSERT INTO `velemenyek` (`velemeny_id`, `nev`, `email`, `ertekeles`, `komment`, `approved`, `created_at`, `updated_at`) VALUES
(1, 'Horváth Gábor', 'gabor.horvath@example.com', 8, 'A szállás tiszta, kényelmes és modern volt.', 1, '2025-03-02 10:59:30', '2025-03-19 12:44:45'),
(4, 'Kiss Zsuzsa', 'zsuzsa.kiss@example.com', 9, 'Nagyszerű hely a pihenéshez, biztosan visszatérünk!', 1, '2025-03-02 10:59:30', '2025-03-19 12:51:45'),
(5, 'Varga Tamás', 'tamas.varga@example.com', 8, 'A reggeli fantasztikus volt, rengeteg választási lehetőség.', 1, '2025-03-02 10:59:30', '2025-03-19 12:44:45'),
(6, 'Tóth Balázs', 'balazs.toth@example.com', 9, 'Minden a várakozásaimon felül teljesített!', 0, '2025-03-02 10:59:30', '2025-03-02 10:59:30'),
(7, 'Farkas Katalin', 'katalin.farkas@example.com', 10, 'A wellness részleg kiváló, nagyon pihentető volt.', 0, '2025-03-02 10:59:30', '2025-03-02 10:59:30'),
(8, 'Molnár László', 'laszlo.molnar@example.com', 8, 'A gyerekek is imádták, remek családi programok voltak.', 1, '2025-03-02 10:59:30', '2025-03-19 13:03:34');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vendeg`
--

CREATE TABLE `vendeg` (
  `vendeg_id` bigint(20) UNSIGNED NOT NULL,
  `nev` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(255) DEFAULT NULL,
  `iranyitoszam` varchar(255) DEFAULT NULL,
  `lakcim` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `vendeg`
--

INSERT INTO `vendeg` (`vendeg_id`, `nev`, `email`, `telefon`, `iranyitoszam`, `lakcim`, `created_at`, `updated_at`) VALUES
(1, 'Kovács Péter', 'kovacs.peter@example.com', '06301234567', '1111', 'Budapest, Rózsa utca 1', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(2, 'Nagy Mária', 'nagy.maria@example.com', '06201234567', '2222', 'Debrecen, Zöldfa utca 2', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(3, 'Szabó Gábor', 'szabo.gabor@example.com', '06501234567', '3333', 'Pécs, Hősök tere 3', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(4, 'Tóth Eszter', 'tooth.eszter@example.com', '06401234567', '4444', 'Szeged, Kossuth Lajos utca 4', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(5, 'Kiss János', 'kiss.janos@example.com', '06701234567', '5555', 'Győr, Arany János utca 5', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(6, 'Farkas Tamás', 'farkas.tamas@example.com', '06501234567', '1010', 'Debrecen, Zöldfa utca 10', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(7, 'Molnár Ádám', 'molnar.adam@example.com', '06801234567', '6666', 'Nyíregyháza, Hársfa utca 6', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(8, 'Varga Anita', 'varga.anita@example.com', '06901234567', '7777', 'Miskolc, Kossuth Lajos utca 7', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(9, 'Juhász László', 'juhasz.laszlo@example.com', '06301234567', '8888', 'Eger, Petőfi utca 8', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(10, 'Bognár Júlia', 'bognar.julia@example.com', '06701234567', '9999', 'Zalaegerszeg, Béke utca 9', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(11, 'Farkas Sára', 'farkas.sara@example.com', '06501234567', '1010', 'Békéscsaba, Zöldfa utca 1', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(12, 'Kovács Gábor', 'kovacs.gabor@example.com', '06201234567', '1111', 'Budapest, Kossuth utca 2', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(13, 'Szilágyi Zoltán', 'szilagyi.zoltan@example.com', '06401234567', '3333', 'Székesfehérvár, Táncsics utca 3', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(14, 'Sipos Kinga', 'sipos.kinga@example.com', '06501234567', '4444', 'Pécs, Jókai utca 4', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(15, 'Horváth Róbert', 'horvath.robert@example.com', '06701234567', '5555', 'Győr, Kossuth utca 5', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(16, 'Varga Béla', 'varga.bela@example.com', '06801234567', '6666', 'Szeged, Kossuth Lajos utca 16', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(17, 'Tóth Mária', 'tooth.maria@example.com', '06701234567', '7777', 'Nyíregyháza, Táncsics utca 17', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(18, 'Molnár Zsolt', 'molnar.zsolt@example.com', '06901234567', '8888', 'Pécs, Jókai utca 18', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(19, 'Farkas Erika', 'farkas.erika@example.com', '06501234567', '9999', 'Debrecen, Kossuth Lajos utca 19', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(20, 'Juhász Andrea', 'juhasz.andrea@example.com', '06401234567', '1010', 'Szeged, Zöldfa utca 20', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(21, 'Nagy László', 'nagy.laszlo@example.com', '06801234567', '1111', 'Miskolc, Rákóczi utca 21', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(22, 'Kiss Bea', 'kiss.bea@example.com', '06701234567', '2222', 'Pécs, Zrínyi utca 22', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(23, 'Szabó Andrea', 'szabo.andrea@example.com', '06501234567', '3333', 'Debrecen, Petőfi utca 23', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(24, 'Farkas Péter', 'farkas.peter@example.com', '06401234567', '4444', 'Győr, Táncsics utca 24', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(25, 'Tóth László', 'tooth.laszlo@example.com', '06901234567', '5555', 'Zalaegerszeg, Kossuth utca 25', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(26, 'Juhász László', 'juhasz.laszlo@example.com', '06201234567', '6666', 'Nyíregyháza, Zöldfa utca 26', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(27, 'Kovács Tamás', 'kovacs.tamas@example.com', '06501234567', '7777', 'Miskolc, Jókai utca 27', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(28, 'Nagy Katalin', 'nagy.katalin@example.com', '06301234567', '8888', 'Székesfehérvár, Béke utca 28', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(29, 'Molnár Gábor', 'molnar.gabor@example.com', '06801234567', '9999', 'Pécs, Arany János utca 29', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(30, 'Szabó Béla', 'szabo.bela@example.com', '06701234567', '1010', 'Eger, Kossuth utca 30', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(31, 'Kovács Petra', 'kovacs.petra@example.com', '06201234567', '1111', 'Győr, Táncsics utca 31', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(32, 'Varga István', 'varga.istvan@example.com', '06501234567', '2222', 'Miskolc, Rákóczi utca 32', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(33, 'Tóth Gábor', 'tooth.gabor@example.com', '06801234567', '3333', 'Zalaegerszeg, Kossuth utca 33', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(34, 'Juhász Péter', 'juhasz.peter@example.com', '06701234567', '4444', 'Pécs, Zöldfa utca 34', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(35, 'Nagy Zoltán', 'nagy.zoltan@example.com', '06901234567', '5555', 'Debrecen, Hősök tere 35', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(36, 'Kiss László', 'kiss.laszlo@example.com', '06501234567', '6666', 'Szeged, Béke utca 36', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(37, 'Szabó Zsolt', 'szabo.zsolt@example.com', '06201234567', '7777', 'Pécs, Kossuth utca 37', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(38, 'Farkas Andrea', 'farkas.andrea@example.com', '06701234567', '8888', 'Zalaegerszeg, Rákóczi utca 38', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(39, 'Molnár Tamás', 'molnar.tamas@example.com', '06501234567', '9999', 'Debrecen, Zöldfa utca 39', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(40, 'Tóth László', 'tooth.laszlo@example.com', '06801234567', '1010', 'Szeged, Hősök tere 40', '2025-03-20 11:29:54', '2025-03-20 11:29:54'),
(41, 'Takács Áron', 'takdomi0429@gmail.com', '06306705205', '4324', 'adasdsa', '2025-03-20 14:56:31', '2025-03-20 14:56:31'),
(42, 'Takács Áron', 'takdomi0429@gmail.com', '06306705205', '2313', 'sdasda', '2025-03-20 15:02:30', '2025-03-20 15:02:30'),
(43, 'Dorian Gray', 'takdomi0429@gmail.com', '06306705205', '1312', 'Kaposvár', '2025-03-21 08:09:48', '2025-03-21 08:09:48'),
(44, 'sdad', 'takdomi0429@gmail.com', '02102', '2313', 'sdsad', '2025-03-21 08:12:10', '2025-03-21 08:12:10'),
(45, 'Dorian Gray', 'takdomi0429@gmail.com', '06306705205', '2312', 'Balatonszemes', '2025-03-21 08:19:10', '2025-03-21 08:19:10'),
(46, 'fdsf', 'takdomi0429@gmail.com', '06306705205', '4323', 'rsafsf', '2025-03-21 08:20:18', '2025-03-21 08:20:18'),
(47, 'dsd', 'takdomi0429@gmail.com', '06306705205', '2321', 'dsadsa', '2025-03-21 08:23:03', '2025-03-21 08:23:03'),
(48, 'FASZ', 'takdomi0429@gmail.com', '06306705205', '4324', 'TATAGSRG', '2025-03-22 08:52:46', '2025-03-22 08:52:46'),
(49, 'Takács Áron', 'takdomi0429@gmail.com', '06306705205', '3344', 'BAASB', '2025-03-23 13:12:01', '2025-03-23 13:12:01'),
(51, 'Takács Áron', 'takdomi0429@gmail.com', '06306705205', '3344', 'adsadad', '2025-03-23 13:35:00', '2025-03-23 13:35:00');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- A tábla indexei `akciok`
--
ALTER TABLE `akciok`
  ADD PRIMARY KEY (`akcio_id`);

--
-- A tábla indexei `akcio_foglalas`
--
ALTER TABLE `akcio_foglalas`
  ADD PRIMARY KEY (`akcio_id`,`foglalas_id`),
  ADD KEY `akcio_foglalas_foglalas_id_foreign` (`foglalas_id`);

--
-- A tábla indexei `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `chat_uzenetek`
--
ALTER TABLE `chat_uzenetek`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `chat_uzenetek_vendeg_id_foreign` (`vendeg_id`),
  ADD KEY `chat_uzenetek_admin_id_foreign` (`admin_id`);

--
-- A tábla indexei `csomag_foglalas`
--
ALTER TABLE `csomag_foglalas`
  ADD PRIMARY KEY (`csomag_id`,`foglalas_id`),
  ADD KEY `csomag_foglalas_foglalas_id_foreign` (`foglalas_id`);

--
-- A tábla indexei `erkezesi_csomagok`
--
ALTER TABLE `erkezesi_csomagok`
  ADD PRIMARY KEY (`csomag_id`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `fizetesek`
--
ALTER TABLE `fizetesek`
  ADD PRIMARY KEY (`fizetes_id`),
  ADD KEY `fizetesek_foglalas_id_foreign` (`foglalas_id`);

--
-- A tábla indexei `foglalasi_modositasok`
--
ALTER TABLE `foglalasi_modositasok`
  ADD PRIMARY KEY (`modositas_id`),
  ADD KEY `foglalasi_modositasok_foglalas_id_foreign` (`foglalas_id`);

--
-- A tábla indexei `foglalasok`
--
ALTER TABLE `foglalasok`
  ADD PRIMARY KEY (`foglalas_id`),
  ADD KEY `foglalasok_vendeg_id_foreign` (`vendeg_id`);

--
-- A tábla indexei `helyi_programajanlok`
--
ALTER TABLE `helyi_programajanlok`
  ADD PRIMARY KEY (`program_id`);

--
-- A tábla indexei `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- A tábla indexei `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A tábla indexei `velemenyek`
--
ALTER TABLE `velemenyek`
  ADD PRIMARY KEY (`velemeny_id`);

--
-- A tábla indexei `vendeg`
--
ALTER TABLE `vendeg`
  ADD PRIMARY KEY (`vendeg_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `akciok`
--
ALTER TABLE `akciok`
  MODIFY `akcio_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `chat_uzenetek`
--
ALTER TABLE `chat_uzenetek`
  MODIFY `chat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `erkezesi_csomagok`
--
ALTER TABLE `erkezesi_csomagok`
  MODIFY `csomag_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `fizetesek`
--
ALTER TABLE `fizetesek`
  MODIFY `fizetes_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT a táblához `foglalasi_modositasok`
--
ALTER TABLE `foglalasi_modositasok`
  MODIFY `modositas_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `foglalasok`
--
ALTER TABLE `foglalasok`
  MODIFY `foglalas_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT a táblához `helyi_programajanlok`
--
ALTER TABLE `helyi_programajanlok`
  MODIFY `program_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `velemenyek`
--
ALTER TABLE `velemenyek`
  MODIFY `velemeny_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `vendeg`
--
ALTER TABLE `vendeg`
  MODIFY `vendeg_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `akcio_foglalas`
--
ALTER TABLE `akcio_foglalas`
  ADD CONSTRAINT `akcio_foglalas_akcio_id_foreign` FOREIGN KEY (`akcio_id`) REFERENCES `akciok` (`akcio_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `akcio_foglalas_foglalas_id_foreign` FOREIGN KEY (`foglalas_id`) REFERENCES `foglalasok` (`foglalas_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `chat_uzenetek`
--
ALTER TABLE `chat_uzenetek`
  ADD CONSTRAINT `chat_uzenetek_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `chat_uzenetek_vendeg_id_foreign` FOREIGN KEY (`vendeg_id`) REFERENCES `vendeg` (`vendeg_id`) ON DELETE SET NULL;

--
-- Megkötések a táblához `csomag_foglalas`
--
ALTER TABLE `csomag_foglalas`
  ADD CONSTRAINT `csomag_foglalas_csomag_id_foreign` FOREIGN KEY (`csomag_id`) REFERENCES `erkezesi_csomagok` (`csomag_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `csomag_foglalas_foglalas_id_foreign` FOREIGN KEY (`foglalas_id`) REFERENCES `foglalasok` (`foglalas_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `fizetesek`
--
ALTER TABLE `fizetesek`
  ADD CONSTRAINT `fizetesek_foglalas_id_foreign` FOREIGN KEY (`foglalas_id`) REFERENCES `foglalasok` (`foglalas_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `foglalasi_modositasok`
--
ALTER TABLE `foglalasi_modositasok`
  ADD CONSTRAINT `foglalasi_modositasok_foglalas_id_foreign` FOREIGN KEY (`foglalas_id`) REFERENCES `foglalasok` (`foglalas_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `foglalasok`
--
ALTER TABLE `foglalasok`
  ADD CONSTRAINT `foglalasok_vendeg_id_foreign` FOREIGN KEY (`vendeg_id`) REFERENCES `vendeg` (`vendeg_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

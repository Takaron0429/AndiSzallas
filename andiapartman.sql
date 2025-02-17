-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Feb 17. 11:29
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
(1, 'Takács Áron', 'aron0429', 'takaron0429@gmail.com', '2025-01-31 10:32:03', NULL, NULL),
(2, 'Kelemen Andrea', 'andi68andi', 'andi68andi@gmail.com', '2025-01-31 10:32:03', NULL, NULL),
(3, 'Takács Zsolt', 'woker72', 'woker72@gmail.com', '2025-01-31 10:32:03', NULL, NULL);

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
(1, 'Hosszú távú nyári tartózkodás', 'Akció, amely kedvezményt kínál, ha valaki több mint 7 nap és minimum 3 fő akkor minden további nap árából 10% kedvezmény', 10.00, '2025-01-01', '2025-08-31', NULL, NULL),
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

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foglalasok`
--

CREATE TABLE `foglalasok` (
  `foglalas_id` bigint(20) UNSIGNED NOT NULL,
  `vendeg_id` bigint(20) UNSIGNED NOT NULL,
  `erkezes` date NOT NULL,
  `tavozas` date NOT NULL,
  `felnott` int(11) NOT NULL,
  `gyerek` int(11) NOT NULL,
  `osszeg` decimal(8,2) NOT NULL,
  `foglalas_allapot` varchar(255) NOT NULL DEFAULT 'függőben',
  `fizetes_allapot` varchar(255) NOT NULL DEFAULT 'függőben',
  `speciális_keresek` text DEFAULT NULL,
  `csomag_id` bigint(20) UNSIGNED DEFAULT NULL,
  `akcio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Balaton Sound Festival', 'http://balatonsound.hu/logo.png', 'Az egyik legismertebb elektronikus zenei fesztivál, Siófok mellett Zamárdiban. A legnagyobb nemzetközi DJ-k és előadók lépnek fel.', 'Zamárdi, Balaton-part', '2023-07-06', '2023-07-09', 'http://balatonsound.hu', NULL, NULL),
(2, 'Kövesdi Kézműves Fesztivál', 'http://kovesdikezmufesztival.hu/logo.png', 'A Balaton déli partján, a kis falu, Kövesd rendezvényén a látogatók helyi kézművesek portékáit vásárolhatják meg.', 'Kövesd, Fő tér', '2023-06-10', '2023-06-12', 'http://kovesdikezmufesztival.hu', NULL, NULL),
(3, 'Siófoki Jótékonysági Vásár', 'http://siofok.hu/logo.png', 'A helyi közösség szervezésében jótékonysági vásár, ahol használt ruhák, könyvek és egyéb termékek kaphatók a Balatonparton.', 'Siófok, Fő tér', '2023-05-20', '2023-05-20', 'http://siofok.hu', NULL, NULL),
(4, 'Balaton Maraton', 'http://balatonmaraton.hu/logo.png', 'Év végi sportesemény, amely egyben a Balaton körüli maratoni futóverseny. A rendezvény mindenki számára elérhető, amatőröktől a profi sportolókig.', 'Balaton, környék', '2023-10-01', '2023-10-01', 'http://balatonmaraton.hu', NULL, NULL),
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
(31, '0001_01_01_000000_create_users_table', 1),
(32, '0001_01_01_000001_create_cache_table', 1),
(33, '0001_01_01_000002_create_jobs_table', 1),
(34, '2025_01_26_130732_create_vendeg_table', 1),
(35, '2025_01_26_130733_create_admin_table', 1),
(36, '2025_01_26_130733_create_erkezesi_csomagok_table', 1),
(37, '2025_01_26_130734_create_akciok_table', 1),
(38, '2025_01_26_130734_create_foglalasok_table', 1),
(39, '2025_01_26_130735_create_fizetesek_table', 1),
(40, '2025_01_26_130735_create_velemenyek_table', 1),
(41, '2025_01_26_130736_create_chat_uzenetek_table', 1),
(42, '2025_01_26_130736_create_foglalasi_modositasok_table', 1),
(43, '2025_01_26_130737_create_akcio_foglalas_table', 1),
(44, '2025_01_26_130737_create_helyi_programajanlok_table', 1),
(45, '2025_01_26_130738_create_csomag_foglalas_table', 1);

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
('0G1lCdSUXUS6hxZhG1d4hQDpB9CMUl8RaFN1LXOa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMVEzWkhiMXhkYnFqWTFVUnpJcUdZOVBJNzJzdlFESXNoTDRRbm9BeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9BZG1pbkZlbHVsZXQvQWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU6ImFkbWluIjthOjI6e3M6MTQ6ImZlbGhhc3puYWxvbmV2IjtzOjEzOiJUYWvDoWNzIFpzb2x0IjtzOjU6ImVtYWlsIjtzOjE3OiJ3b2tlcjcyQGdtYWlsLmNvbSI7fX0=', 1738508982),
('sWbXrWKb0XQq3RcsCWvmHbepUeK6EqMeWhFDJHH4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidk9zSHp6NGg1OEdTanZaamExY0ZlV25DNjM3WWZhQmtBM0E2UlRXbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9BZG1pbkZlbHVsZXQvQWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU6ImFkbWluIjthOjI6e3M6MTQ6ImZlbGhhc3puYWxvbmV2IjtzOjEzOiJUYWvDoWNzIMOBcm9uIjtzOjU6ImVtYWlsIjtzOjIxOiJ0YWthcm9uMDQyOUBnbWFpbC5jb20iO319', 1738756907);

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
  `vendeg_id` bigint(20) UNSIGNED NOT NULL,
  `ertekeles` int(11) NOT NULL,
  `komment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  ADD KEY `foglalasok_vendeg_id_foreign` (`vendeg_id`),
  ADD KEY `foglalasok_csomag_id_foreign` (`csomag_id`),
  ADD KEY `foglalasok_akcio_id_foreign` (`akcio_id`);

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
  ADD PRIMARY KEY (`velemeny_id`),
  ADD KEY `velemenyek_vendeg_id_foreign` (`vendeg_id`);

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
  MODIFY `admin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `akciok`
--
ALTER TABLE `akciok`
  MODIFY `akcio_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `fizetes_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `foglalasi_modositasok`
--
ALTER TABLE `foglalasi_modositasok`
  MODIFY `modositas_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `foglalasok`
--
ALTER TABLE `foglalasok`
  MODIFY `foglalas_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `velemenyek`
--
ALTER TABLE `velemenyek`
  MODIFY `velemeny_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `vendeg`
--
ALTER TABLE `vendeg`
  MODIFY `vendeg_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `foglalasok_akcio_id_foreign` FOREIGN KEY (`akcio_id`) REFERENCES `akciok` (`akcio_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `foglalasok_csomag_id_foreign` FOREIGN KEY (`csomag_id`) REFERENCES `erkezesi_csomagok` (`csomag_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `foglalasok_vendeg_id_foreign` FOREIGN KEY (`vendeg_id`) REFERENCES `vendeg` (`vendeg_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `velemenyek`
--
ALTER TABLE `velemenyek`
  ADD CONSTRAINT `velemenyek_vendeg_id_foreign` FOREIGN KEY (`vendeg_id`) REFERENCES `vendeg` (`vendeg_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

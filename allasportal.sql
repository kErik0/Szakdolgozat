-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2025 at 07:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `allasportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','accepted','rejected','archived') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('allasportal-cache-12c6fc06c99a462375eeb3f43dfd832b08ca9e17', 'i:1;', 1760791553),
('allasportal-cache-12c6fc06c99a462375eeb3f43dfd832b08ca9e17:timer', 'i:1760791553;', 1760791553),
('allasportal-cache-14bb99f81147d2705f53a1d75337b2ec3e10d23a', 'i:1;', 1762154051),
('allasportal-cache-14bb99f81147d2705f53a1d75337b2ec3e10d23a:timer', 'i:1762154051;', 1762154051),
('allasportal-cache-2952aeca0fe15cf310ede96c437acb94b2b208f1', 'i:2;', 1762513149),
('allasportal-cache-2952aeca0fe15cf310ede96c437acb94b2b208f1:timer', 'i:1762513149;', 1762513149),
('allasportal-cache-2a79f14120945873482b7823caabe2fcde848722', 'i:2;', 1762184544),
('allasportal-cache-2a79f14120945873482b7823caabe2fcde848722:timer', 'i:1762184544;', 1762184544),
('allasportal-cache-3a2dc677d8e85ac856541744e288d504882feb36', 'i:1;', 1762149808),
('allasportal-cache-3a2dc677d8e85ac856541744e288d504882feb36:timer', 'i:1762149808;', 1762149808),
('allasportal-cache-4af7f9edc0f545f4de769f2e9e763df919915cab', 'i:1;', 1763219896),
('allasportal-cache-4af7f9edc0f545f4de769f2e9e763df919915cab:timer', 'i:1763219896;', 1763219896),
('allasportal-cache-61188f24396807ba7ca38919a158766de935852e', 'i:2;', 1762508266),
('allasportal-cache-61188f24396807ba7ca38919a158766de935852e:timer', 'i:1762508266;', 1762508266),
('allasportal-cache-752ae7bdbb96bf25280b55990570beabf2048ce0', 'i:2;', 1762450735),
('allasportal-cache-752ae7bdbb96bf25280b55990570beabf2048ce0:timer', 'i:1762450735;', 1762450735),
('allasportal-cache-7f03f3f2febc46f3fa832d98251b0c98f64bc19b', 'i:1;', 1762695280),
('allasportal-cache-7f03f3f2febc46f3fa832d98251b0c98f64bc19b:timer', 'i:1762695280;', 1762695280),
('allasportal-cache-851cd04fbcac9538616f1d147d7930db87b8750d', 'i:1;', 1762926815),
('allasportal-cache-851cd04fbcac9538616f1d147d7930db87b8750d:timer', 'i:1762926815;', 1762926815),
('allasportal-cache-87d538ef1c1db71603e60f278446c86470162380', 'i:1;', 1762149044),
('allasportal-cache-87d538ef1c1db71603e60f278446c86470162380:timer', 'i:1762149044;', 1762149044),
('allasportal-cache-972a67c48192728a34979d9a35164c1295401b71', 'i:2;', 1760791508),
('allasportal-cache-972a67c48192728a34979d9a35164c1295401b71:timer', 'i:1760791508;', 1760791508),
('allasportal-cache-9f9af029585ba014e07cd3910ca976cf56160616', 'i:1;', 1762515325),
('allasportal-cache-9f9af029585ba014e07cd3910ca976cf56160616:timer', 'i:1762515325;', 1762515325),
('allasportal-cache-acf1fffc01dc0193aa07d0b1de723c292a2c826d', 'i:1;', 1762149246),
('allasportal-cache-acf1fffc01dc0193aa07d0b1de723c292a2c826d:timer', 'i:1762149246;', 1762149246),
('allasportal-cache-b6692ea5df920cad691c20319a6fffd7a4a766b8', 'i:1;', 1760789401),
('allasportal-cache-b6692ea5df920cad691c20319a6fffd7a4a766b8:timer', 'i:1760789401;', 1760789401),
('allasportal-cache-c837307a9a2ad4d08ca61a4f1bd848ba3d6890fc', 'i:2;', 1762510867),
('allasportal-cache-c837307a9a2ad4d08ca61a4f1bd848ba3d6890fc:timer', 'i:1762510867;', 1762510867),
('allasportal-cache-cb4e5208b4cd87268b208e49452ed6e89a68e0b8', 'i:1;', 1760788213),
('allasportal-cache-cb4e5208b4cd87268b208e49452ed6e89a68e0b8:timer', 'i:1760788213;', 1760788213),
('allasportal-cache-e54183e2a040e6c09e61eb22d542e3d57074b351', 'i:1;', 1762149697),
('allasportal-cache-e54183e2a040e6c09e61eb22d542e3d57074b351:timer', 'i:1762149697;', 1762149697),
('allasportal-cache-f1f836cb4ea6efb2a0b1b99f41ad8b103eff4b59', 'i:1;', 1760790252),
('allasportal-cache-f1f836cb4ea6efb2a0b1b99f41ad8b103eff4b59:timer', 'i:1760790252;', 1760790252),
('allasportal-cache-f67462663a512121ffada791890b558ee8b38773', 'i:1;', 1762149189),
('allasportal-cache-f67462663a512121ffada791890b558ee8b38773:timer', 'i:1762149189;', 1762149189);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Informatika', 'it', '2025-11-13 11:55:46', '2025-11-13 11:55:46'),
(2, 'Pénzügy', 'penzugy', '2025-11-13 11:55:46', '2025-11-13 11:55:46'),
(3, 'Építőipar', 'epitoipar', '2025-11-13 11:55:46', '2025-11-13 11:55:46'),
(4, 'Ügyfélszolgálat', 'ugyfelszolgalat', '2025-11-13 11:55:46', '2025-11-13 11:55:46'),
(5, 'Vendéglátás', 'vendeglatas', '2025-11-13 11:55:46', '2025-11-13 11:55:46'),
(6, 'Logisztika', 'logisztika', '2025-11-13 11:55:46', '2025-11-13 11:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'company',
  `logo` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tax_number` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `email_verified_at`, `password`, `description`, `website`, `created_at`, `updated_at`, `role`, `logo`, `remember_token`, `address`, `tax_number`, `phone`) VALUES
(1, 'Alfatech Solutions Kft.', 'contact@alfatech-solutions.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'IT szolgáltatások és szoftverfejlesztés', 'https://alfatech-solutions.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/alfatech-solutions.hu', NULL, 'Budapest, Váci út 43.', '11111111-1-11', '+36 1 200 3344'),
(2, 'NovaTech Systems Zrt.', 'contact@novatech-systems.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Innovációs technológiai vállalat', 'https://novatech-systems.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/novatech-systems.com', NULL, 'Budapest, Infopark sétány 5.', '22222222-2-22', '+36 30 555 1122'),
(3, 'Silverline Logistics Kft.', 'info@silverline-logistics.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Logisztikai és szállítmányozási szolgáltató', 'https://silverline-logistics.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/silverline-logistics.hu', NULL, 'Győr, Ipari park 8.', '33333333-1-33', '+36 96 444 7788'),
(4, 'Globex International Ltd.', 'global@globexinternational.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Nemzetközi kereskedelmi vállalat', 'https://globexinternational.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/globexinternational.com', NULL, 'London, 12 Baker Street', '44444444-1-44', '+44 20 1234 5678'),
(5, 'Kiss és Társa Bt.', 'office@kiss-tarsa-bt.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Építőipari kivitelezés', 'https://kiss-tarsa-bt.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/kiss-tarsa-bt.hu', NULL, 'Szeged, Kálvária sugárút 31.', '55555555-1-55', '+36 62 322 445'),
(6, 'DigitalCore Labs Kft.', 'hello@digitalcorelabs.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Mesterséges intelligencia és szoftverkutatás', 'https://digitalcorelabs.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/digitalcorelabs.hu', NULL, 'Debrecen, Kassai út 129.', '66666666-2-66', '+36 20 455 8822'),
(7, 'Helix Robotics Inc.', 'contact@helix-robotics.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Ipari robotikai fejlesztések', 'https://helix-robotics.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/helix-robotics.com', NULL, 'New York, 5th Avenue 1200.', '77777777-1-77', '+1 212 334 8899'),
(8, 'PannonTech Informatika Kft.', 'it@pannontech-informatika.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'IT szolgáltatások és üzemeltetés', 'https://pannontech-informatika.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/pannontech-informatika.hu', NULL, 'Pécs, Árpád út 7.', '88888888-1-88', '+36 72 555 123'),
(9, 'BlueStar Media Group', 'contact@bluestar-media-group.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Marketing és médiaügynökség', 'https://bluestar-media-group.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/bluestar-media-group.com', NULL, 'Berlin, Alexanderplatz 3.', '99999999-2-99', '+49 30 5566 7788'),
(10, 'HungaroSteel Kft.', 'info@hungarosteel-industries.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Acélipari gyártó cég', 'https://hungarosteel-industries.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/hungarosteel-industries.hu', NULL, 'Dunaújváros, Vasmű tér 1.', '12121212-1-12', '+36 25 445 990'),
(11, 'Matrix Innovations Kft.', 'hello@matrix-innovations.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Digitalizáció és szoftverfejlesztés', 'https://matrix-innovations.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/matrix-innovations.hu', NULL, 'Budapest, Üllői út 22.', '13131313-1-13', '+36 1 330 2200'),
(12, 'EuroFleet Transport Zrt.', 'contact@eurofleet-transport.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Közúti és légi fuvarozás', 'https://eurofleet-transport.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/eurofleet-transport.com', NULL, 'Hamburg, Portstrasse 12.', '14141414-2-14', '+49 40 5566 1122'),
(13, 'FutureWare Development Inc.', 'office@futureware-dev.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Szoftverfejlesztő startup', 'https://futureware-dev.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/futureware-dev.com', NULL, 'San Francisco, Market Street 80.', '15151515-1-15', '+1 415 990 2244'),
(14, 'GreenLeaf Foods Kft.', 'info@greenleaf-foods.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Élelmiszeripari gyártás', 'https://greenleaf-foods.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/greenleaf-foods.hu', NULL, 'Győr, Révész utca 8.', '16161616-1-16', '+36 96 555 887'),
(15, 'SkyNet Drone Services', 'support@skynet-drone-services.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Drónos térképészet és szállítás', 'https://skynet-drone-services.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/skynet-drone-services.com', NULL, 'Vienna, Prater Str. 17.', '17171717-1-17', '+43 660 334 9900'),
(16, 'AlphaTrade Markets', 'trade@alphatrade-markets.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Befektetési és pénzügyi tanácsadás', 'https://alfatrade-markets.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/alphatrade-markets.com', NULL, 'Budapest, Bécsi út 3-5.', '18181818-1-18', '+36 1 700 2255'),
(17, 'NordMetal Zrt.', 'info@nordmetal-industries.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Fémipari gyártás', 'https://nordmetal-industries.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/nordmetal-industries.hu', NULL, 'Miskolc, Szervezet utca 14.', '19191919-2-19', '+36 46 550 332'),
(18, 'BrightWave Studio', 'studio@brightwave-creatives.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Webdesign és kreatív ügynökség', 'https://brightwave-creatives.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/brightwave-creatives.hu', NULL, 'Prága, Vodičkova 42.', '20202020-1-20', '+420 606 889 221'),
(19, 'DeltaSoft Technologies Kft.', 'hello@deltasoft-technologies.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Nagyvállalati szoftverfejlesztés', 'https://deltasoft-technologies.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/deltasoft-technologies.hu', NULL, 'Szeged, József Attila sugárút 112.', '21212121-1-21', '+36 62 330 778'),
(20, 'UrbanBuild Construction Kft.', 'contact@urbanbuild-construction.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Építőipari kivitelezés', 'https://urbanbuild-construction.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/urbanbuild-construction.hu', NULL, 'Kecskemét, Izsáki út 14.', '22222221-1-22', '+36 76 550 221'),
(21, 'Quantum AI Labs', 'research@quantum-ai-labs.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Mesterséges intelligencia kutatóintézet', 'https://quantum-ai-labs.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/quantum-ai-labs.com', NULL, 'Oslo, Grensen 10.', '23232323-1-23', '+47 22 993 115'),
(22, 'Solaris Power Group', 'office@solarispower-group.eu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Megújuló energia megoldások', 'https://solarispower-group.eu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/solarispower-group.eu', NULL, 'Vienna, Sonnengasse 9.', '24242424-1-24', '+43 660 555 7788'),
(23, 'PrimeLog Delivery Kft.', 'info@primelog-delivery.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Futárszolgálat és logisztika', 'https://primelog-delivery.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/primelog-delivery.hu', NULL, 'Nyíregyháza, Tünde utca 64.', '25252525-1-25', '+36 42 333 112'),
(24, 'RedLine Automotive', 'contact@redline-automotive.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Autóipari alkatrészgyártás', 'https://redline-automotive.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/redline-automotive.com', NULL, 'Detroit, Jefferson Ave. 55.', '26262626-1-26', '+1 313 889 2211'),
(25, 'Zenith Health Care', 'hello@zenith-healthcare.org', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Egészségügyi szolgáltató cég', 'https://zenith-healthcare.org', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/zenith-healthcare.org', NULL, 'Dublin, O’Connell Street 9.', '27272727-1-27', '+353 1 776 2210'),
(26, 'OptiHome Design Kft.', 'design@optihome-design.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Lakberendezési és dizájn megoldások', 'https://optihome-design.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/optihome-design.hu', NULL, 'Sopron, Várkerület 33.', '28282828-1-28', '+36 99 333 778'),
(27, 'EuroShop Retail Group', 'info@euroshop-retail.eu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Európai kiskereskedelmi hálózat', 'https://euroshop-retail.eu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/euroshop-retail.eu', NULL, 'Brno, Husova 17.', '29292929-1-29', '+420 777 221 334'),
(28, 'Skyward Airlines', 'contact@skyward-airlines.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Regionális légitársaság', 'https://skyward-airlines.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/skyward-airlines.com', NULL, 'Amsterdam, Airport Blvd 10.', '30303030-2-30', '+31 20 445 7788'),
(29, 'BrightCom Telecom', 'office@brightcom-telecom.net', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Telekommunikációs vállalat', 'https://brightcom-telecom.net', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/brightcom-telecom.net', NULL, 'Haarlem, Grote Markt 21.', '31313131-1-31', '+31 23 998 2211'),
(30, 'PhotonEdge Research', 'hello@photonedge-research.org', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Lézertechnológiai fejlesztőközpont', 'https://photonedge-research.org', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/photonedge-research.org', NULL, 'Zurich, Bahnhofstrasse 88.', '32323232-1-32', '+41 44 567 8877'),
(31, 'Horizon IT Services Kft.', 'support@horizon-it-services.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'IT üzemeltetés és rendszergazdai szolgáltatások', 'https://horizon-it-services.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/horizon-it-services.hu', NULL, 'Zalaegerszeg, Gasparich út 22.', '33333334-1-33', '+36 92 221 335'),
(32, 'NextGen Mobility', 'info@nextgen-mobility.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'E-mobilitási megoldások', 'https://nextgen-mobility.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/nextgen-mobility.com', NULL, 'Osaka, Namba St. 18.', '34343434-1-34', '+81 6 440 2211'),
(33, 'AirFlow Vent Systems', 'office@airflow-vent-systems.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Ipari szellőztetőrendszerek', 'https://airflow-vent-systems.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/airflow-vent-systems.com', NULL, 'Frankfurt, Mainzer Landstr. 100.', '35353535-2-35', '+49 69 889 2211'),
(34, 'FarmFresh Agro Kft.', 'contact@farmfresh-agro.hu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Mezőgazdasági élelmiszertermelés', 'https://farmfresh-agro.hu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/farmfresh-agro.hu', NULL, 'Kaposvár, Füredi út 77.', '36363636-1-36', '+36 82 330 889'),
(35, 'CloudWave Hosting', 'hello@cloudwave-hosting.host', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Felhő alapú szerver- és tárhelyszolgáltatás', 'https://cloudwave-hosting.host', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/cloudwave-hosting.host', NULL, 'Reykjavik, Hafnarstræti 12.', '37373737-1-37', '+354 558 1144'),
(36, 'BlackRock Machinery', 'info@blackrock-machinery.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Nehézgépek gyártása és tervezése', 'https://blackrock-machinery.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/blackrock-machinery.com', NULL, 'Warsaw, Jana Pawla II 10.', '38383838-2-38', '+48 22 556 3344'),
(37, 'SilverOak Finance', 'contact@silveroak-finance.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GjVZt0Bp8x.', 'Pénzügyi tanácsadás és befektetés', 'https://silveroak-finance.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/silveroak-finance.com', NULL, 'London, Canary Wharf 15.', '39393939-1-39', '+44 20 889 2244'),
(38, 'RiverBank Holding', 'office@riverbank-holding.eu', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Nemzetközi befektetési holding', 'https://riverbank-holding.eu', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/riverbank-holding.eu', NULL, 'Budapest, Dunapart 4.', '40404040-1-40', '+36 1 778 3344'),
(39, 'UrbanGreen CityCare', 'contact@urbangreen-citycare.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Városfejlesztési és környezetvédelmi szolgáltatások', 'https://urbangreen-citycare.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/urbangreen-citycare.com', NULL, 'Stockholm, Sveavägen 22.', '41414141-1-41', '+46 8 990 2211'),
(40, 'SolarCube Energy', 'hello@solarcube-energy.tech', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Naperőmű- és energiatechnológiai vállalat', 'https://solarcube-energy.tech', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/solarcube-energy.tech', NULL, 'Barcelona, Av. Diagonal 55.', '42424242-1-42', '+34 933 441 221'),
(41, 'CoreStack Compute', 'info@corestack-compute.com', '2025-11-10 05:54:47', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', 'Nagyvállalati szervermegoldások', 'https://corestack-compute.com', '2025-11-10 05:54:47', '2025-11-10 05:54:47', 'company', 'https://logo.clearbit.com/corestack-compute.com', NULL, 'Paris, Rue de Lyon 77.', '43434343-1-43', '+33 1 558 9900'),
(51, 'ApexByte Technologies Kft.', 'kapcsolat@apexbyte.hu', '2025-11-10 06:00:06', '$2y$12$abcdefghijklmnopqrstuv', 'Egyedi vállalati szoftverek fejlesztése', 'https://apexbyte.hu', '2025-11-10 06:00:06', '2025-11-10 06:00:06', 'company', 'https://logo.clearbit.com/apexbyte.hu', NULL, 'Budapest, Futó utca 41.', '44112233-1-42', '+36 1 445 9021'),
(52, 'NordicWave Solutions', 'info@nordicwave.io', '2025-11-10 06:00:06', '$2y$12$abcdefghijklmnopqrstuv', 'Felhő alapú adatfeldolgozási rendszerek', 'https://nordicwave.io', '2025-11-10 06:00:06', '2025-11-10 06:00:06', 'company', 'https://logo.clearbit.com/nordicwave.io', NULL, 'Copenhagen, Østerbro 12.', '55667788-2-43', '+45 88 221 445'),
(53, 'GreenPeak Energy Systems', 'hello@greenpeakenergy.eu', '2025-11-10 06:00:06', '$2y$12$abcdefghijklmnopqrstuv', 'Zöldenergetikai infrastruktúra fejlesztése', 'https://greenpeakenergy.eu', '2025-11-10 06:00:06', '2025-11-10 06:00:06', 'company', 'https://logo.clearbit.com/greenpeakenergy.eu', NULL, 'Graz, Herrengasse 27.', '66778899-1-44', '+43 660 445 7788'),
(54, 'BlueNova Cybersecurity', 'support@bluenova-sec.com', '2025-11-10 06:00:06', '$2y$12$abcdefghijklmnopqrstuv', 'Kiberbiztonsági megoldások vállalatoknak', 'https://bluenova-sec.com', '2025-11-10 06:00:06', '2025-11-10 06:00:06', 'company', 'https://logo.clearbit.com/bluenova-sec.com', NULL, 'Berlin, Köpenicker Straße 101.', '77889900-1-45', '+49 152 889 4471'),
(55, 'InnoTrain Robotics Kft.', 'contact@innotrainrobotics.hu', '2025-11-10 06:00:06', '$2y$12$abcdefghijklmnopqrstuv', 'Robotikai oktatóplatform és automatizáció', 'https://innotrainrobotics.hu', '2025-11-10 06:00:06', '2025-11-10 06:00:06', 'company', 'https://logo.clearbit.com/innotrainrobotics.hu', NULL, 'Győr, Nagy Imre út 14.', '88990011-1-46', '+36 96 444 901'),
(56, 'SkyLab Aero Technologies', 'info@skylab-aero.com', '2025-11-10 06:00:06', '$2y$12$abcdefghijklmnopqrstuv', 'Ipari drónok fejlesztése és gyártása', 'https://skylab-aero.com', '2025-11-10 06:00:06', '2025-11-10 06:00:06', 'company', 'https://logo.clearbit.com/skylab-aero.com', NULL, 'Amsterdam, Pier 6.', '99001122-1-47', '+31 20 778 2299'),
(57, 'MetaForge Industrial Controls', 'office@metaforge-controls.com', '2025-11-10 06:00:06', '$2y$12$abcdefghijklmnopqrstuv', 'Ipari automatizálási rendszerek gyártása', 'https://metaforge-controls.com', '2025-11-10 06:00:06', '2025-11-10 06:00:06', 'company', 'https://logo.clearbit.com/metaforge-controls.com', NULL, 'Poznań, Polwiejska 17.', '11220033-1-48', '+48 61 998 4400'),
(58, 'UrbanShift Smart Cities', 'info@urbanshift.city', '2025-11-10 06:00:06', '$2y$12$abcdefghijklmnopqrstuv', 'Okosváros technológiák fejlesztése', 'https://urbanshift.city', '2025-11-10 06:00:06', '2025-11-10 06:00:06', 'company', 'https://logo.clearbit.com/urbanshift.city', NULL, 'Stockholm, Sveavägen 144.', '22331144-1-49', '+46 8 771 9923'),
(59, 'DeepAtlas Analytics', 'team@deepatlas.ai', '2025-11-10 06:00:06', '$2y$12$abcdefghijklmnopqrstuv', 'Mélytanulási adatfeldolgozó rendszerek', 'https://deepatlas.ai', '2025-11-10 06:00:06', '2025-11-10 06:00:06', 'company', 'https://logo.clearbit.com/deepatlas.ai', NULL, 'Paris, Rue Saint-Antoine 88.', '33442255-1-50', '+33 1 778 3322'),
(60, 'Kovács Erik', 'kovacs.erik626@gmail.com', NULL, '$2y$12$dz.Srm2t3/S/RcISV6oy4OE.Mt2UNbuMA5DefuWMn4oPQkcn57MVm', NULL, NULL, '2025-11-13 10:52:28', '2025-11-13 10:52:28', 'company', NULL, NULL, NULL, NULL, '+36303849766'),
(61, 'Kovács Erik', 'kovacs.erik30@gmail.com', NULL, '$2y$12$n3LRbNlKDYqF2EuGNhwgPeEKz7vZ2dNdFyCs43GnL7y3J61aztIlK', NULL, NULL, '2025-11-13 10:53:15', '2025-11-13 10:53:15', 'company', NULL, NULL, NULL, NULL, '06303849766'),
(62, 'Mihi és társai kft', 'vivienmihalka@gmail.com', NULL, '$2y$12$4MM0uLfMbJr4twQPsxvdF.fUa7r9V2LkZzspvozD/NbGj9Miulahm', NULL, NULL, '2025-11-15 14:26:42', '2025-11-15 14:32:00', 'company', 'storage/profile_pictures/1763220720_62.jpeg', NULL, NULL, NULL, '06704200628');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `salary` int(10) DEFAULT NULL,
  `salary_type` enum('órabér','fix') NOT NULL DEFAULT 'fix',
  `type` enum('Teljes munkaidő','Rész munkaidő','Gyakornok','Hibrid') NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `created_at`, `company_id`, `title`, `position`, `description`, `location`, `salary`, `salary_type`, `type`, `updated_at`, `category_id`) VALUES
(1, '2025-11-13 12:09:45', 1, 'Junior Backend fejlesztő', 'Backend fejlesztő', 'PHP és Laravel alapú fejlesztés.', 'Budapest', 550000, 'fix', 'Teljes munkaidő', '2025-11-13 12:09:45', 1),
(2, '2025-11-13 12:09:45', 2, 'Senior Backend fejlesztő', 'Backend fejlesztő', 'Komplex rendszerek fejlesztése.', 'Budapest', 900000, 'fix', 'Hibrid', '2025-11-13 12:09:45', 1),
(3, '2025-11-13 12:09:45', 3, 'Frontend fejlesztő', 'Frontend fejlesztő', 'React alapú webfejlesztés.', 'Szeged', 600000, 'fix', 'Teljes munkaidő', '2025-11-13 12:09:45', 1),
(4, '2025-11-13 12:09:45', 4, 'React fejlesztő', 'Frontend fejlesztő', 'Modern UI-k fejlesztése.', 'Debrecen', 480000, 'fix', 'Hibrid', '2025-11-13 12:09:45', 1),
(5, '2025-11-13 12:09:45', 5, 'Szoftvertesztelő', 'Tesztelő', 'Szoftverek manuális tesztelése.', 'Győr', 3500, 'órabér', 'Rész munkaidő', '2025-11-13 12:09:45', 1),
(6, '2025-11-13 12:09:45', 6, 'Rendszergazda', 'Rendszergazda', 'Hálózatok és szerverek kezelése.', 'Miskolc', 530000, 'fix', 'Teljes munkaidő', '2025-11-13 12:09:45', 1),
(7, '2025-11-13 12:09:45', 7, 'Junior Flutter fejlesztő', 'Mobilfejlesztő', 'Mobilalkalmazások fejlesztése.', 'Pécs', 450000, 'fix', 'Gyakornok', '2025-11-13 12:09:45', 1),
(8, '2025-11-13 12:09:45', 8, 'IT Helpdesk munkatárs', 'Helpdesk', 'Felhasználók támogatása.', 'Budapest', 3000, 'órabér', 'Rész munkaidő', '2025-11-13 12:09:45', 1),
(9, '2025-11-13 12:09:45', 9, 'DevOps mérnök', 'DevOps mérnök', 'CI/CD rendszerek kezelése.', 'Budapest', 780000, 'fix', 'Hibrid', '2025-11-13 12:09:45', 1),
(10, '2025-11-13 12:09:45', 10, 'Full Stack fejlesztő', 'Full Stack', 'Frontend és backend feladatok.', 'Debrecen', 650000, 'fix', 'Teljes munkaidő', '2025-11-13 12:09:45', 1),
(11, '2025-11-13 12:12:46', 11, 'Könyvelő', 'Könyvelő', 'Könyvelési feladatok ellátása.', 'Budapest', 480000, 'fix', 'Teljes munkaidő', '2025-11-13 12:12:46', 2),
(12, '2025-11-13 12:12:46', 12, 'Pénzügyi asszisztens', 'Pénzügyi asszisztens', 'Számlák és adminisztráció kezelése.', 'Szeged', 3500, 'órabér', 'Rész munkaidő', '2025-11-13 12:12:46', 2),
(13, '2025-11-13 12:12:46', 13, 'Bérszámfejtő', 'Bérszámfejtő', 'Munkavállalók bérszámfejtése.', 'Győr', 450000, 'fix', 'Teljes munkaidő', '2025-11-13 12:12:46', 2),
(14, '2025-11-13 12:12:46', 14, 'Junior könyvelő', 'Könyvelő', 'Könyvelői csapat támogatása.', 'Debrecen', 390000, 'fix', 'Gyakornok', '2025-11-13 12:12:46', 2),
(15, '2025-11-13 12:12:46', 15, 'Pénzügyi elemző', 'Elemző', 'Pénzügyi riportok és elemzések készítése.', 'Budapest', 620000, 'fix', 'Hibrid', '2025-11-13 12:12:46', 2),
(16, '2025-11-13 12:12:46', 16, 'Admin munkatárs', 'Adminisztrátor', 'Pénzügyi adminisztrációs feladatok.', 'Miskolc', 2800, 'órabér', 'Rész munkaidő', '2025-11-13 12:12:46', 2),
(17, '2025-11-13 12:12:46', 17, 'Senior könyvelő', 'Könyvelő', 'Nagyvállalati könyvelés teljes körűen.', 'Győr', 540000, 'fix', 'Teljes munkaidő', '2025-11-13 12:12:46', 2),
(18, '2025-11-13 12:12:46', 18, 'Főkönyvelő', 'Főkönyvelő', 'Főkönyvi folyamatok irányítása.', 'Budapest', 750000, 'fix', 'Hibrid', '2025-11-13 12:12:46', 2),
(19, '2025-11-13 12:12:46', 19, 'Junior elemző', 'Elemző', 'Adatelemzés és riportkészítés támogatása.', 'Pécs', 360000, 'fix', 'Gyakornok', '2025-11-13 12:12:46', 2),
(20, '2025-11-13 12:12:46', 20, 'Pénzügyi ügyintéző', 'Ügyintéző', 'Pénzügyi ügyek és számlák kezelése.', 'Szeged', 420000, 'fix', 'Teljes munkaidő', '2025-11-13 12:12:46', 2),
(21, '2025-11-13 12:12:55', 21, 'Kőműves', 'Kőműves', 'Építési és felújítási munkák végzése.', 'Budapest', 4200, 'órabér', 'Teljes munkaidő', '2025-11-13 12:12:55', 3),
(22, '2025-11-13 12:12:55', 22, 'Ács', 'Ács', 'Tetőszerkezetek készítése és javítása.', 'Győr', 4500, 'órabér', 'Teljes munkaidő', '2025-11-13 12:12:55', 3),
(23, '2025-11-13 12:12:55', 23, 'Burkoló', 'Burkoló', 'Hideg- és melegburkolási munkák.', 'Szeged', 4300, 'órabér', 'Teljes munkaidő', '2025-11-13 12:12:55', 3),
(24, '2025-11-13 12:12:55', 24, 'Villanyszerelő', 'Villanyszerelő', 'Villamos hálózatok kiépítése.', 'Pécs', 4600, 'órabér', 'Teljes munkaidő', '2025-11-13 12:12:55', 3),
(25, '2025-11-13 12:12:55', 25, 'Segédmunkás', 'Segédmunkás', 'Általános építőipari segédmunka.', 'Debrecen', 2800, 'órabér', 'Rész munkaidő', '2025-11-13 12:12:55', 3),
(26, '2025-11-13 12:12:55', 26, 'Kőműves segéd', 'Segédmunkás', 'Kőműves szakemberek munkájának segítése.', 'Budapest', 3000, 'órabér', 'Rész munkaidő', '2025-11-13 12:12:55', 3),
(27, '2025-11-13 12:12:55', 27, 'Gépi földmunkás', 'Gépi földmunkás', 'Építőipari munkagépek kezelése.', 'Győr', 520000, 'fix', 'Teljes munkaidő', '2025-11-13 12:12:55', 3),
(28, '2025-11-13 12:12:55', 28, 'Bádogos', 'Bádogos', 'Tetőfedési és bádogos feladatok.', 'Miskolc', 4700, 'órabér', 'Teljes munkaidő', '2025-11-13 12:12:55', 3),
(29, '2025-11-13 12:12:55', 29, 'Karbantartó', 'Karbantartó', 'Épületek karbantartása.', 'Szeged', 390000, 'fix', 'Teljes munkaidő', '2025-11-13 12:12:55', 3),
(30, '2025-11-13 12:12:55', 30, 'Kőműves', 'Kőműves', 'Falazási és betonozási munkák.', 'Budapest', 4400, 'órabér', 'Teljes munkaidő', '2025-11-13 12:12:55', 3),
(31, '2025-11-13 12:13:20', 31, 'Call Center operátor', 'Call Center operátor', 'Telefonos ügyfelek kezelése.', 'Budapest', 3000, 'órabér', 'Rész munkaidő', '2025-11-13 12:13:20', 4),
(32, '2025-11-13 12:13:20', 32, 'Ügyfélszolgálati munkatárs', 'Ügyfélszolgálati munkatárs', 'Személyes és telefonos ügyfélkezelés.', 'Győr', 350000, 'fix', 'Teljes munkaidő', '2025-11-13 12:13:20', 4),
(33, '2025-11-13 12:13:20', 33, 'Adminisztrátor', 'Adminisztrátor', 'Irodai adminisztrációs feladatok.', 'Szeged', 320000, 'fix', 'Hibrid', '2025-11-13 12:13:20', 4),
(34, '2025-11-13 12:13:20', 34, 'Recepciós', 'Recepciós', 'Vendégek fogadása és irányítása.', 'Pécs', 310000, 'fix', 'Teljes munkaidő', '2025-11-13 12:13:20', 4),
(35, '2025-11-13 12:13:20', 35, 'Telefonos ügyintéző', 'Ügyintéző', 'Telefonos ügyintézés és tájékoztatás.', 'Debrecen', 2900, 'órabér', 'Rész munkaidő', '2025-11-13 12:13:20', 4),
(36, '2025-11-13 12:13:20', 36, 'Back office munkatárs', 'Back office', 'Háttéradminisztráció és adatkezelés.', 'Budapest', 340000, 'fix', 'Teljes munkaidő', '2025-11-13 12:13:20', 4),
(37, '2025-11-13 12:13:20', 37, 'Helpdesk admin', 'Helpdesk', 'Felhasználók támogatása.', 'Miskolc', 310000, 'fix', 'Hibrid', '2025-11-13 12:13:20', 4),
(38, '2025-11-13 12:13:20', 38, 'Recepciós', 'Recepciós', 'Recepciós feladatok ellátása.', 'Győr', 300000, 'fix', 'Teljes munkaidő', '2025-11-13 12:13:20', 4),
(39, '2025-11-13 12:13:20', 39, 'Admin munkatárs', 'Adminisztrátor', 'Dokumentumok kezelése és iktatása.', 'Pécs', 2800, 'órabér', 'Rész munkaidő', '2025-11-13 12:13:20', 4),
(40, '2025-11-13 12:13:20', 40, 'Ügyintéző', 'Ügyintéző', 'Ügyfélkapcsolatok kezelése.', 'Budapest', 360000, 'fix', 'Hibrid', '2025-11-13 12:13:20', 4),
(41, '2025-11-13 12:13:29', 51, 'Pincér', 'Pincér', 'Vendégek kiszolgálása éttermi környezetben.', 'Budapest', 2400, 'órabér', 'Rész munkaidő', '2025-11-13 12:13:29', 5),
(42, '2025-11-13 12:13:29', 52, 'Felszolgáló', 'Felszolgáló', 'Asztalok kezelése és rendben tartása.', 'Balaton', 2600, 'órabér', 'Teljes munkaidő', '2025-11-13 12:13:29', 5),
(43, '2025-11-13 12:13:29', 53, 'Szakács', 'Szakács', 'Ételek önálló elkészítése.', 'Győr', 420000, 'fix', 'Teljes munkaidő', '2025-11-13 12:13:29', 5),
(44, '2025-11-13 12:13:29', 54, 'Konyhai kisegítő', 'Konyhai kisegítő', 'Alapanyagok előkészítése, mosogatás.', 'Szeged', 2200, 'órabér', 'Gyakornok', '2025-11-13 12:13:29', 5),
(45, '2025-11-13 12:13:29', 55, 'Pultos', 'Pultos', 'Italok készítése és felszolgálása.', 'Debrecen', 2500, 'órabér', 'Rész munkaidő', '2025-11-13 12:13:29', 5),
(46, '2025-11-13 12:13:29', 51, 'Szakács', 'Szakács', 'Melegkonyhai feladatok ellátása.', 'Budapest', 430000, 'fix', 'Teljes munkaidő', '2025-11-13 12:13:29', 5),
(47, '2025-11-13 12:13:29', 52, 'Pincér', 'Pincér', 'Vendéglátó munka étteremben.', 'Szeged', 2700, 'órabér', 'Rész munkaidő', '2025-11-13 12:13:29', 5),
(48, '2025-11-13 12:13:29', 53, 'Felszolgáló', 'Felszolgáló', 'Vendégek kiszolgálása, rendelésfelvétel.', 'Pécs', 2800, 'órabér', 'Teljes munkaidő', '2025-11-13 12:13:29', 5),
(49, '2025-11-13 12:13:29', 54, 'Kávépultos', 'Pultos', 'Kávék és könnyű italok készítése.', 'Győr', 2600, 'órabér', 'Rész munkaidő', '2025-11-13 12:13:29', 5),
(50, '2025-11-13 12:13:29', 55, 'Szakács', 'Szakács', 'Konyhai műveletek elvégzése.', 'Budapest', 410000, 'fix', 'Hibrid', '2025-11-13 12:13:29', 5),
(51, '2025-11-13 12:13:36', 56, 'Raktáros', 'Raktáros', 'Áruk bevételezése és kiadása.', 'Budapest', 2800, 'órabér', 'Teljes munkaidő', '2025-11-13 12:13:36', 6),
(52, '2025-11-13 12:13:36', 57, 'Csomagoló', 'Csomagoló', 'Termékek csomagolása.', 'Győr', 2600, 'órabér', 'Rész munkaidő', '2025-11-13 12:13:36', 6),
(53, '2025-11-13 12:13:36', 58, 'Tehergépkocsi sofőr', 'Sofőr', 'Belföldi áruszállítás.', 'Szeged', 480000, 'fix', 'Teljes munkaidő', '2025-11-13 12:13:36', 6),
(54, '2025-11-13 12:13:36', 59, 'Raktári kisegítő', 'Raktári kisegítő', 'Pakolás és dobozolás.', 'Debrecen', 2400, 'órabér', 'Rész munkaidő', '2025-11-13 12:13:36', 6),
(55, '2025-11-13 12:13:36', 60, 'Fuvarszervező', 'Fuvarszervező', 'Fuvarok szervezése és útvonaltervezés.', 'Pécs', 450000, 'fix', 'Hibrid', '2025-11-13 12:13:36', 6),
(56, '2025-11-13 12:13:36', 61, 'Sofőr', 'Sofőr', 'Szállítmányok fuvarozása.', 'Budapest', 470000, 'fix', 'Teljes munkaidő', '2025-11-13 12:13:36', 6),
(57, '2025-11-13 12:13:36', 56, 'Raktáros', 'Raktáros', 'Áruátvétel és raktári rend fenntartása.', 'Miskolc', 3000, 'órabér', 'Teljes munkaidő', '2025-11-13 12:13:36', 6),
(58, '2025-11-13 12:13:36', 57, 'Csomagoló', 'Csomagoló', 'Csomagküldemények előkészítése.', 'Győr', 2500, 'órabér', 'Rész munkaidő', '2025-11-13 12:13:36', 6),
(59, '2025-11-13 12:13:36', 58, 'Sofőr', 'Sofőr', 'Fuvarozási feladatok ellátása.', 'Budapest', 460000, 'fix', 'Teljes munkaidő', '2025-11-13 12:13:36', 6),
(60, '2025-11-13 12:13:36', 59, 'Raktári dolgozó', 'Raktáros', 'Raktári készletek kezelése.', 'Szeged', 2900, 'órabér', 'Teljes munkaidő', '2025-11-13 12:13:36', 6),
(61, '2025-11-15 14:31:26', 62, 'Elektronikus képfejlesztés', 'képi ábrázoló', 'Legyen tapasztalatod online képek szerkesztésében és legyen grafikai végzettséged.', 'Orosháza', 1000, 'órabér', 'Teljes munkaidő', '2025-11-15 14:31:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
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
-- Table structure for table `job_views`
--

CREATE TABLE `job_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_27_203602_add_profile_resume_to_users_table', 2),
(5, '2025_09_27_204258_create_companies_table', 3),
(6, '2025_09_27_204631_add_fields_to_jobs_table', 4),
(7, '2025_09_27_204844_create_applications_table', 5),
(8, '2025_09_28_085613_add_role_to_users_table', 6),
(9, '2025_09_29_042630_add_role_password_logo_to_companies_table', 7),
(10, '2025_09_29_042933_add_remember_token_to_companies_table', 8),
(11, '2025_09_29_051030_make_description_nullable_in_companies_table', 9),
(12, '2025_09_30_035225_clean_up_jobs_table', 10),
(13, '2025_10_01_041123_add_archived_to_applications_table', 11),
(14, '2025_10_01_041512_update_applications_status_and_remove_archived', 12),
(15, '2025_10_01_043439_20251001_add_previous_status_to_applications_table', 13),
(16, '2025_10_01_045455_set_default_previous_status_on_applications_table', 14),
(17, '2025_10_10_085540_add_email_verified_at_to_companies_table', 15),
(18, '2025_10_10_085903_add_email_verified_at_to_companies_table', 16),
(19, '2025_10_21_055350_add_company_details_to_companies_table', 17),
(20, '2025_11_07_092114_add_phone_to_users_table', 18),
(21, '2025_11_07_102613_add_position_to_jobs_table', 19),
(22, '2025_11_07_103835_add_salary_type_to_jobs_table', 20),
(23, '2025_11_10_051930_create_job_views_table', 21),
(24, '2025_11_13_114621_create_categories_table', 22),
(25, '2025_11_13_114819_add_category_id_to_jobs_table', 23);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('f0j4FE9ss535eCxqz5T6WxCTLLnZ3wCa4OmOn3dU', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVhyMVMyVDdXd1NObHlpTWpLQVpFWDJNdmhMb3pnbmFUUkJOT0RrViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1763220326),
('NgrpEUn4xredwWRTdAwZzechEMZO2P2dmdMASPDi', NULL, '192.168.0.174', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_1_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/142.0.7444.148 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVTJkQnQzT1JrazZTRGxFVkc5ejQxejZLS0k2aUJ6NGNINDJYYlYxTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly8xOTIuMTY4LjAuMjE6ODAwMCI7fX0=', 1763220775),
('qiuHPM7J2llObpWMmLYK6IMn3r6K71JfDa2lxVDx', NULL, '192.168.0.174', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_1_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/142.0.7444.148 Mobile/15E148 Safari/604.1', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiY3RRWUlVeERIT3hkZ3F0UlNhbmNQeldVSmJCZDRXckhZckc5OTdKNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xOTIuMTY4LjAuMjE6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjE6e2k6MDtzOjc6InN1Y2Nlc3MiO31zOjM6Im5ldyI7YTowOnt9fXM6NTQ6ImxvZ2luX2NvbXBhbnlfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2MjtzOjc6InN1Y2Nlc3MiO3M6MjY6IlNpa2VyZXNlbiByZWdpc3p0csOhbHTDoWwhIjt9', 1763220404);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `profile_picture`, `resume`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(202, 'Kovács Bálint', 'balint.kovacs@example.com', '+36 30 111 1111', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(203, 'Szabó Lili', 'lili.szabo@example.com', '+36 30 111 1112', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(204, 'Tóth Ádám', 'adam.toth@example.com', '+36 30 111 1113', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(205, 'Nagy Anna', 'anna.nagy@example.com', '+36 30 111 1114', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(206, 'Kiss Máté', 'mate.kiss@example.com', '+36 30 111 1115', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(207, 'Varga Emese', 'emese.varga@example.com', '+36 30 111 1116', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(208, 'Farkas Dániel', 'daniel.farkas@example.com', '+36 30 111 1117', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(209, 'Horváth Petra', 'petra.horvath@example.com', '+36 30 111 1118', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(210, 'Balogh Gergő', 'gergo.balogh@example.com', '+36 30 111 1119', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(211, 'Jakab Fanni', 'fanni.jakab@example.com', '+36 30 111 1120', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(212, 'Simon László', 'laszlo.simon@example.com', '+36 30 111 1121', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(213, 'Szűcs Dóra', 'dora.szucs@example.com', '+36 30 111 1122', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(214, 'Takács Norbert', 'norbert.takacs@example.com', '+36 30 111 1123', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(215, 'Molnár Zsófia', 'zsofia.molnar@example.com', '+36 30 111 1124', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(216, 'Gulyás Kristóf', 'kristof.gulyas@example.com', '+36 30 111 1125', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(217, 'Illés Kitti', 'kitti.illes@example.com', '+36 30 111 1126', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(218, 'Pintér Roland', 'roland.pinter@example.com', '+36 30 111 1127', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(219, 'Orosz Nóra', 'nora.orosz@example.com', '+36 30 111 1128', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(220, 'Fülöp Barna', 'barna.fulop@example.com', '+36 30 111 1129', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(221, 'Boros Csenge', 'csenge.boros@example.com', '+36 30 111 1130', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(222, 'Veres Márton', 'marton.veres@example.com', '+36 30 111 1131', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(223, 'Somogyi Léna', 'lena.somogyi@example.com', '+36 30 111 1132', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(224, 'Kelemen Patrik', 'patrik.kelemen@example.com', '+36 30 111 1133', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(225, 'Barta Liza', 'liza.barta@example.com', '+36 30 111 1134', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(226, 'Fehér Misi', 'misi.feher@example.com', '+36 30 111 1135', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(227, 'Pap Virág', 'virag.pap@example.com', '+36 30 111 1136', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(228, 'Antal Gábor', 'gabor.antal@example.com', '+36 30 111 1137', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(229, 'Lengyel Mira', 'mira.lengyel@example.com', '+36 30 111 1138', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(230, 'Bognár Áron', 'aron.bognar@example.com', '+36 30 111 1139', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(231, 'Borbély Zita', 'zita.borbely@example.com', '+36 30 111 1140', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(232, 'Major Balázs', 'balazs.major@example.com', '+36 30 111 1141', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(233, 'Bácsi Dóra', 'dora.bacsi@example.com', '+36 30 111 1142', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(234, 'Benedek Olivér', 'oliver.benedek@example.com', '+36 30 111 1143', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(235, 'Rácz Hanga', 'hanga.racz@example.com', '+36 30 111 1144', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(236, 'Dudás Mirkó', 'mirko.dudas@example.com', '+36 30 111 1145', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(237, 'Vass Gréta', 'greta.vass@example.com', '+36 30 111 1146', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(238, 'Orbán Soma', 'soma.orban@example.com', '+36 30 111 1147', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(239, 'Török Blanka', 'blanka.torok@example.com', '+36 30 111 1148', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(240, 'Katona Noel', 'noel.katona@example.com', '+36 30 111 1149', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(241, 'Mészáros Léna', 'lena.meszaros@example.com', '+36 30 111 1150', '2025-11-10 05:34:54', '$2y$12$wNQJzN8Ny0j5EKeosFVJeuGp5Ffqj7jt5Jt7diZ5GhVwVZt0Bp8x.', NULL, NULL, NULL, '2025-11-10 05:34:54', '2025-11-10 05:34:54', 'user'),
(242, 'Kovács Erik', 'kovacs.erik626@gmail.com', '06303849766', '2025-11-12 04:52:35', '$2y$12$SU0bhqQCrr9InfFHpshIwu2JWUHi4izfYY2H8BxFJyaHScrARKNUS', NULL, NULL, NULL, '2025-11-12 04:52:14', '2025-11-12 04:52:35', 'user'),
(244, 'Mihálka Vivien', 'vivienmihalka@gmail.com', '06704200628', NULL, '$2y$12$cSoqgR50ApcN0ds/6NQ9bukLHvMjP0VgC/dl/hZ0rnytKAX.hVVnO', NULL, NULL, NULL, '2025-11-15 14:27:53', '2025-11-15 14:27:53', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_job_id_foreign` (`job_id`),
  ADD KEY `applications_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_company_id_foreign` (`company_id`),
  ADD KEY `jobs_category_id_foreign` (`category_id`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_views`
--
ALTER TABLE `job_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_views_user_id_foreign` (`user_id`),
  ADD KEY `job_views_job_id_foreign` (`job_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `job_views`
--
ALTER TABLE `job_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `jobs_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_views`
--
ALTER TABLE `job_views`
  ADD CONSTRAINT `job_views_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

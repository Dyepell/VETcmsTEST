-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 06 2023 г., 06:44
-- Версия сервера: 5.6.51-log
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `vet_cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `analys_blood`
--

CREATE TABLE `analys_blood` (
  `ID_BLOOD` int(11) NOT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `ERIT` text,
  `GEMOG` text,
  `COLOR` text,
  `LEIC` text,
  `BAZ` text,
  `EOZ` text,
  `MIEL` text,
  `NUN` text,
  `NPAL` text,
  `NSEG` text,
  `LIMF` text,
  `MONO` text,
  `PLAZM` text,
  `SOE` text,
  `OSOTM` text,
  `GEMAT` text,
  `TROMBOCIT` text,
  `TROMBOKRIT` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `biohim`
--

CREATE TABLE `biohim` (
  `ID_BIOHIM` int(11) NOT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `BELOK` text,
  `BILIRUB_OBSH` text,
  `BILIRUB_PR` text,
  `BILIRUB_NEPR` text,
  `AC_AT` text,
  `AL_AT` text,
  `SUGAR` text,
  `MOCH` text,
  `KREATIN` text,
  `LDG` text,
  `GAMMA_GTP` text,
  `AMILAZA` text,
  `KALIY` text,
  `KALCIY` text,
  `SHELOCH` text,
  `FOSFOR` text,
  `HOL` text,
  `ALB` text,
  `P` text,
  `K` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `brand_images`
--

CREATE TABLE `brand_images` (
  `id` int(11) NOT NULL,
  `clinicId` int(11) DEFAULT '1',
  `imageName` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageDescription` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageType` int(11) NOT NULL DEFAULT '1',
  `imagePath` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `brand_images_types`
--

CREATE TABLE `brand_images_types` (
  `id` int(11) NOT NULL,
  `typeName` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `typeDescription` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `ID_CL` int(11) NOT NULL,
  `FAM` text,
  `NAME` text,
  `OTCH` text,
  `BDAY` text,
  `REGION` text,
  `CITY` text,
  `STREET` text,
  `HOUSE` int(11) DEFAULT NULL,
  `CORPS` text,
  `FLAT` int(11) DEFAULT NULL,
  `INDX` text,
  `ADRESS` text,
  `PHONED` double DEFAULT NULL,
  `PHONER` text,
  `PHONES` double DEFAULT NULL,
  `MESTOR` text,
  `FIRSTDATE` text,
  `POL` text,
  `INF` text,
  `EMAIL` text,
  `FIRST_DATE_N` date DEFAULT NULL,
  `DATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `clinic`
--

CREATE TABLE `clinic` (
  `id` int(11) NOT NULL,
  `clinicName` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Название клиники',
  `entrepreneurName` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ИП Иванов И.И.',
  `entrepreneurINN` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1234567890',
  `address` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'myClinic@domain.ru'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Таблица с данными клиники';

-- --------------------------------------------------------

--
-- Структура таблицы `diagnoz`
--

CREATE TABLE `diagnoz` (
  `ID_D` int(11) NOT NULL,
  `ID_VID` int(11) DEFAULT NULL,
  `KOD_DIAG` int(11) DEFAULT NULL,
  `DIAGNOZ` text,
  `ETIO` text,
  `LECH` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `doctor`
--

CREATE TABLE `doctor` (
  `ID_DOC` int(11) NOT NULL,
  `ID_SPDOC` tinytext,
  `SPEZ` text,
  `NAME` varchar(256) DEFAULT NULL,
  `STATUS_R` int(11) DEFAULT NULL,
  `OKLAD` tinytext,
  `THERAPY` double DEFAULT NULL,
  `SURGERY` double DEFAULT NULL,
  `UZI` double DEFAULT NULL,
  `VAKC` double DEFAULT NULL,
  `MED` double DEFAULT NULL,
  `DEG` double DEFAULT NULL,
  `ANALYZ` double DEFAULT NULL,
  `KORM` double DEFAULT NULL,
  `PHONE` mediumtext,
  `CITY` mediumtext,
  `STREET` mediumtext,
  `HOUSE` mediumtext,
  `FLAT` mediumtext,
  `BDAY` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `expense_catalog`
--

CREATE TABLE `expense_catalog` (
  `ID_EX` int(11) NOT NULL,
  `ID_PR` int(11) DEFAULT NULL,
  `IZM` mediumtext,
  `KOL` double DEFAULT NULL,
  `PRICE` double DEFAULT NULL,
  `SUMM` double DEFAULT NULL,
  `DATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `expense_prihod`
--

CREATE TABLE `expense_prihod` (
  `ID_EXPR` int(11) NOT NULL,
  `ID_PR` int(11) DEFAULT NULL,
  `PRICE` double DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `KOL` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `facility`
--

CREATE TABLE `facility` (
  `ID_FAC` int(11) NOT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `ID_CL` int(11) DEFAULT NULL,
  `ID_DOC` int(11) DEFAULT NULL,
  `ID_PR` int(11) DEFAULT NULL,
  `PRICE` double DEFAULT NULL,
  `KOL` double DEFAULT NULL,
  `SUMMA` double DEFAULT NULL,
  `DATA` date DEFAULT NULL,
  `PRSKID` int(11) DEFAULT NULL,
  `SKIDKA` double DEFAULT NULL,
  `DATASL` date DEFAULT NULL,
  `ID_VISIT` int(11) DEFAULT NULL,
  `NPOS` int(11) DEFAULT NULL,
  `DISCOUNT_SUMM` double DEFAULT NULL,
  `DISCOUNT_PROCENT` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `goods_barcodes`
--

CREATE TABLE `goods_barcodes` (
  `id` int(11) NOT NULL,
  `goodId` int(11) NOT NULL,
  `barcode` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcodeFormat` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `goods_codes`
--

CREATE TABLE `goods_codes` (
  `id` int(11) NOT NULL,
  `sourceId` int(11) NOT NULL,
  `goodId` int(11) NOT NULL,
  `code` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `goods_images`
--

CREATE TABLE `goods_images` (
  `id` int(11) NOT NULL,
  `goodId` int(11) NOT NULL,
  `imageName` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagePath` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `goods_source`
--

CREATE TABLE `goods_source` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codeFormat` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `istbol`
--

CREATE TABLE `istbol` (
  `ID_IST` int(11) NOT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `DIST` text,
  `NIST` int(11) DEFAULT NULL,
  `ZHALOB` text,
  `OSNDIAG` text,
  `A_VITAE` text,
  `A_MORBI` text,
  `ALLERG` text,
  `SSS` text,
  `D` text,
  `PS` text,
  `L` text,
  `K` text,
  `V` text,
  `POLS` text,
  `CNS` text,
  `G` text,
  `Y` text,
  `OP` text,
  `EN` text,
  `SOST` text,
  `T` text,
  `P` text,
  `DYH` text,
  `CNK` text,
  `PULS` text,
  `COLOR` text,
  `TYRGOR` text,
  `SHERST` text,
  `YPIT` text,
  `TRAXEAL` text,
  `OBSL` text,
  `PRDIAG` int(11) DEFAULT NULL,
  `DIFDIAG` text,
  `OKDIAG` text,
  `VAK` text,
  `GLIST` text,
  `BLOH` text,
  `BEFORE_SICK` text,
  `BEFORE_HEAL` text,
  `ALLERGY` text,
  `COMPLAINTS` text,
  `START` text,
  `BEFORE` text,
  `ABOUT_HEAL` text,
  `STATE` text,
  `SLIZ_STATE` text,
  `SHERST_STATE` text,
  `UHO` text,
  `POLOST` text,
  `CHSS` text,
  `CHDD` text,
  `UPIT` text,
  `SKIN_STATE` text,
  `LU_STATE` text,
  `ODA` text,
  `IGD` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `kattov`
--

CREATE TABLE `kattov` (
  `ID_TOV` int(11) NOT NULL,
  `NAME` text,
  `ID_PR` text,
  `country` varchar(128) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `mocha`
--

CREATE TABLE `mocha` (
  `ID_MOCHA` int(11) NOT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `KOL` text,
  `BELOK` text,
  `SUGAR` text,
  `ACETONE` text,
  `UROB` text,
  `REACT` text,
  `LEIC` text,
  `ERIT` text,
  `CIL_GAL` text,
  `CIL_ZERN` text,
  `CIL_VOSK` text,
  `CILINDROID` text,
  `EPIT` text,
  `EPIT_POCH` text,
  `EPIT_PLOSK` text,
  `SLIZ` text,
  `SULT` text,
  `BAKT` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `old_postup`
--

CREATE TABLE `old_postup` (
  `ID_POST` int(11) DEFAULT NULL,
  `ID_TOV` int(11) DEFAULT NULL,
  `DPOSTUP` text,
  `PRICE_Z` int(11) DEFAULT NULL,
  `PRICE_P` int(11) DEFAULT NULL,
  `KOL` int(11) DEFAULT NULL,
  `OSTATOK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `oplata`
--

CREATE TABLE `oplata` (
  `ID_OPL` int(11) NOT NULL,
  `ID_CL` int(11) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `VID_OPL` int(11) DEFAULT NULL,
  `SUMM` int(11) DEFAULT NULL,
  `ID_VIZIT` int(11) DEFAULT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `IsDolg` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `other_isl`
--

CREATE TABLE `other_isl` (
  `ID_OTHER` int(11) NOT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `OP` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pacient`
--

CREATE TABLE `pacient` (
  `ID_PAC` int(11) NOT NULL,
  `KLICHKA` text,
  `ID_VID` int(11) DEFAULT NULL,
  `ID_POR` int(11) DEFAULT NULL,
  `ID_CL` int(11) DEFAULT NULL,
  `BDAY` text,
  `POL` text,
  `VOZR` text,
  `ID_LDOC` int(11) DEFAULT NULL,
  `EXITL` int(11) DEFAULT NULL,
  `DATAEX` text,
  `PRIMECH` text,
  `DATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pay_types`
--

CREATE TABLE `pay_types` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `poroda`
--

CREATE TABLE `poroda` (
  `ID_POR` int(11) NOT NULL,
  `ID_VID` int(11) DEFAULT NULL,
  `NAMEPOR` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `price`
--

CREATE TABLE `price` (
  `ID_PR` int(11) NOT NULL,
  `DATA` text,
  `PRICE` int(11) DEFAULT NULL,
  `ID_SPDOC` int(11) DEFAULT NULL,
  `NAME` text,
  `EDIZ` text,
  `IsCount` tinyint(1) NOT NULL DEFAULT '0',
  `KOL` float NOT NULL,
  `IZM` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `prihod_tovara`
--

CREATE TABLE `prihod_tovara` (
  `ID_PRIHOD` int(11) NOT NULL,
  `ID_TOV` int(11) DEFAULT NULL,
  `EXPIRATION_DATE` date DEFAULT NULL,
  `SUMM` double DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `KOL` double DEFAULT NULL,
  `SELL_PRICE` double DEFAULT NULL,
  `PRICE` double DEFAULT NULL,
  `PRIM` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sale`
--

CREATE TABLE `sale` (
  `ID_SALE` int(11) NOT NULL,
  `ID_PRIHOD` int(11) DEFAULT NULL,
  `ID_VISIT` int(11) DEFAULT NULL,
  `SOTRUDNIK` int(11) DEFAULT NULL,
  `NAME` int(11) DEFAULT NULL,
  `KOL` int(11) DEFAULT NULL,
  `SKIDKA` int(11) DEFAULT NULL,
  `VID_OPL` mediumtext,
  `DATE` date DEFAULT NULL,
  `SUMM` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sale_checks`
--

CREATE TABLE `sale_checks` (
  `id` int(11) NOT NULL,
  `saleId` int(11) NOT NULL,
  `visitId` int(11) DEFAULT '0',
  `shiftNum` int(11) NOT NULL,
  `checkNum` int(11) NOT NULL,
  `fiscalDocNum` int(11) NOT NULL,
  `fiscalSign` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `sale_items`
--

CREATE TABLE `sale_items` (
  `id` int(11) NOT NULL,
  `saleId` int(11) NOT NULL,
  `ID_PRIHOD` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `sale_new`
--

CREATE TABLE `sale_new` (
  `id` int(11) NOT NULL,
  `visitId` int(11) DEFAULT NULL,
  `employeeId` int(11) NOT NULL,
  `payType` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `simplechat_message`
--

CREATE TABLE `simplechat_message` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `text` varchar(1020) COLLATE utf8_unicode_ci NOT NULL,
  `is_new` tinyint(1) DEFAULT '1',
  `is_deleted_by_sender` tinyint(1) DEFAULT '0',
  `is_deleted_by_receiver` tinyint(1) DEFAULT '0',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `simplechat_migration`
--

CREATE TABLE `simplechat_migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `simplechat_user`
--

CREATE TABLE `simplechat_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `simplechat_user_profile`
--

CREATE TABLE `simplechat_user_profile` (
  `id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `first_name` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(63) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `sl_vakc`
--

CREATE TABLE `sl_vakc` (
  `ID_SLV` int(11) NOT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `DATA` date DEFAULT NULL,
  `ID_PR` int(11) DEFAULT NULL,
  `NAME` text,
  `DATASL` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `spdoc`
--

CREATE TABLE `spdoc` (
  `ID_SPDOC` text,
  `SP_DOC` text,
  `PRIZ` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `uzi`
--

CREATE TABLE `uzi` (
  `ID_UZI` int(11) NOT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `OP` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vid`
--

CREATE TABLE `vid` (
  `ID_VID` int(11) NOT NULL,
  `NAMEVID` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vizit`
--

CREATE TABLE `vizit` (
  `ID_VISIT` int(11) NOT NULL,
  `ID_PAC` int(11) DEFAULT NULL,
  `ID_CL` int(11) DEFAULT NULL,
  `DATA` mediumtext,
  `DATE` date DEFAULT NULL,
  `VIDOPL` mediumtext,
  `SUMMAV` double DEFAULT NULL,
  `SUMMAO` double DEFAULT NULL,
  `DATA_OPL` mediumtext,
  `DATE_OPL` date DEFAULT NULL,
  `PROZSKID` int(11) DEFAULT NULL,
  `PRIMECH` mediumtext,
  `ID_DIAG` mediumtext,
  `ID_DOC` mediumtext,
  `DOLG` double DEFAULT NULL,
  `NPOS` int(11) DEFAULT NULL,
  `SUMM_BEFORE_DISCOUNT` double DEFAULT NULL,
  `IsDolg` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `webhook`
--

CREATE TABLE `webhook` (
  `id` int(11) NOT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(2083) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `webhook_log`
--

CREATE TABLE `webhook_log` (
  `id` bigint(20) NOT NULL,
  `log_time` int(11) DEFAULT NULL,
  `webhook_event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webhook_method` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webhook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_headers` text COLLATE utf8mb4_unicode_ci,
  `request_payload` text COLLATE utf8mb4_unicode_ci,
  `response_headers` text COLLATE utf8mb4_unicode_ci,
  `response_status_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `writeoff`
--

CREATE TABLE `writeoff` (
  `Writeoff_ID` int(11) NOT NULL,
  `ID_PRIHOD` int(11) NOT NULL,
  `SOTRUDNIK` int(11) NOT NULL,
  `SUMM` float NOT NULL,
  `DATE` date NOT NULL,
  `KOL` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `analys_blood`
--
ALTER TABLE `analys_blood`
  ADD PRIMARY KEY (`ID_BLOOD`);

--
-- Индексы таблицы `biohim`
--
ALTER TABLE `biohim`
  ADD PRIMARY KEY (`ID_BIOHIM`);

--
-- Индексы таблицы `brand_images`
--
ALTER TABLE `brand_images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `brand_images_types`
--
ALTER TABLE `brand_images_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_CL`);

--
-- Индексы таблицы `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `diagnoz`
--
ALTER TABLE `diagnoz`
  ADD PRIMARY KEY (`ID_D`);

--
-- Индексы таблицы `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`ID_DOC`);

--
-- Индексы таблицы `expense_catalog`
--
ALTER TABLE `expense_catalog`
  ADD PRIMARY KEY (`ID_EX`);

--
-- Индексы таблицы `expense_prihod`
--
ALTER TABLE `expense_prihod`
  ADD PRIMARY KEY (`ID_EXPR`);

--
-- Индексы таблицы `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`ID_FAC`);

--
-- Индексы таблицы `goods_barcodes`
--
ALTER TABLE `goods_barcodes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods_codes`
--
ALTER TABLE `goods_codes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods_images`
--
ALTER TABLE `goods_images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods_source`
--
ALTER TABLE `goods_source`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `istbol`
--
ALTER TABLE `istbol`
  ADD PRIMARY KEY (`ID_IST`);

--
-- Индексы таблицы `kattov`
--
ALTER TABLE `kattov`
  ADD PRIMARY KEY (`ID_TOV`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `mocha`
--
ALTER TABLE `mocha`
  ADD PRIMARY KEY (`ID_MOCHA`);

--
-- Индексы таблицы `oplata`
--
ALTER TABLE `oplata`
  ADD PRIMARY KEY (`ID_OPL`);

--
-- Индексы таблицы `other_isl`
--
ALTER TABLE `other_isl`
  ADD PRIMARY KEY (`ID_OTHER`);

--
-- Индексы таблицы `pacient`
--
ALTER TABLE `pacient`
  ADD PRIMARY KEY (`ID_PAC`);

--
-- Индексы таблицы `pay_types`
--
ALTER TABLE `pay_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `poroda`
--
ALTER TABLE `poroda`
  ADD PRIMARY KEY (`ID_POR`);

--
-- Индексы таблицы `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`ID_PR`);

--
-- Индексы таблицы `prihod_tovara`
--
ALTER TABLE `prihod_tovara`
  ADD PRIMARY KEY (`ID_PRIHOD`);

--
-- Индексы таблицы `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`ID_SALE`);

--
-- Индексы таблицы `sale_checks`
--
ALTER TABLE `sale_checks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sale_new`
--
ALTER TABLE `sale_new`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `simplechat_message`
--
ALTER TABLE `simplechat_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-simplechat_message-sender_id` (`sender_id`),
  ADD KEY `fk-simplechat_message-receiver_id` (`receiver_id`);

--
-- Индексы таблицы `simplechat_migration`
--
ALTER TABLE `simplechat_migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `simplechat_user`
--
ALTER TABLE `simplechat_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `simplechat_user_profile`
--
ALTER TABLE `simplechat_user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sl_vakc`
--
ALTER TABLE `sl_vakc`
  ADD PRIMARY KEY (`ID_SLV`);

--
-- Индексы таблицы `uzi`
--
ALTER TABLE `uzi`
  ADD PRIMARY KEY (`ID_UZI`);

--
-- Индексы таблицы `vid`
--
ALTER TABLE `vid`
  ADD PRIMARY KEY (`ID_VID`);

--
-- Индексы таблицы `vizit`
--
ALTER TABLE `vizit`
  ADD PRIMARY KEY (`ID_VISIT`);

--
-- Индексы таблицы `webhook`
--
ALTER TABLE `webhook`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `webhook_log`
--
ALTER TABLE `webhook_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `writeoff`
--
ALTER TABLE `writeoff`
  ADD PRIMARY KEY (`Writeoff_ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `analys_blood`
--
ALTER TABLE `analys_blood`
  MODIFY `ID_BLOOD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2836;

--
-- AUTO_INCREMENT для таблицы `biohim`
--
ALTER TABLE `biohim`
  MODIFY `ID_BIOHIM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2712;

--
-- AUTO_INCREMENT для таблицы `brand_images`
--
ALTER TABLE `brand_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `brand_images_types`
--
ALTER TABLE `brand_images_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `ID_CL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21697;

--
-- AUTO_INCREMENT для таблицы `clinic`
--
ALTER TABLE `clinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `diagnoz`
--
ALTER TABLE `diagnoz`
  MODIFY `ID_D` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=622;

--
-- AUTO_INCREMENT для таблицы `doctor`
--
ALTER TABLE `doctor`
  MODIFY `ID_DOC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `expense_catalog`
--
ALTER TABLE `expense_catalog`
  MODIFY `ID_EX` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1288;

--
-- AUTO_INCREMENT для таблицы `expense_prihod`
--
ALTER TABLE `expense_prihod`
  MODIFY `ID_EXPR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `facility`
--
ALTER TABLE `facility`
  MODIFY `ID_FAC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299122;

--
-- AUTO_INCREMENT для таблицы `goods_barcodes`
--
ALTER TABLE `goods_barcodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=875;

--
-- AUTO_INCREMENT для таблицы `goods_codes`
--
ALTER TABLE `goods_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=816;

--
-- AUTO_INCREMENT для таблицы `goods_images`
--
ALTER TABLE `goods_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `goods_source`
--
ALTER TABLE `goods_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `istbol`
--
ALTER TABLE `istbol`
  MODIFY `ID_IST` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22726;

--
-- AUTO_INCREMENT для таблицы `kattov`
--
ALTER TABLE `kattov`
  MODIFY `ID_TOV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=816;

--
-- AUTO_INCREMENT для таблицы `mocha`
--
ALTER TABLE `mocha`
  MODIFY `ID_MOCHA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=969;

--
-- AUTO_INCREMENT для таблицы `oplata`
--
ALTER TABLE `oplata`
  MODIFY `ID_OPL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58779;

--
-- AUTO_INCREMENT для таблицы `other_isl`
--
ALTER TABLE `other_isl`
  MODIFY `ID_OTHER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2705;

--
-- AUTO_INCREMENT для таблицы `pacient`
--
ALTER TABLE `pacient`
  MODIFY `ID_PAC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34301;

--
-- AUTO_INCREMENT для таблицы `pay_types`
--
ALTER TABLE `pay_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `poroda`
--
ALTER TABLE `poroda`
  MODIFY `ID_POR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=494;

--
-- AUTO_INCREMENT для таблицы `price`
--
ALTER TABLE `price`
  MODIFY `ID_PR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=676;

--
-- AUTO_INCREMENT для таблицы `prihod_tovara`
--
ALTER TABLE `prihod_tovara`
  MODIFY `ID_PRIHOD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=410;

--
-- AUTO_INCREMENT для таблицы `sale`
--
ALTER TABLE `sale`
  MODIFY `ID_SALE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24653;

--
-- AUTO_INCREMENT для таблицы `sale_checks`
--
ALTER TABLE `sale_checks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sale_new`
--
ALTER TABLE `sale_new`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `simplechat_message`
--
ALTER TABLE `simplechat_message`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT для таблицы `simplechat_user`
--
ALTER TABLE `simplechat_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `sl_vakc`
--
ALTER TABLE `sl_vakc`
  MODIFY `ID_SLV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18760;

--
-- AUTO_INCREMENT для таблицы `uzi`
--
ALTER TABLE `uzi`
  MODIFY `ID_UZI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3381;

--
-- AUTO_INCREMENT для таблицы `vid`
--
ALTER TABLE `vid`
  MODIFY `ID_VID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `vizit`
--
ALTER TABLE `vizit`
  MODIFY `ID_VISIT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169990;

--
-- AUTO_INCREMENT для таблицы `webhook`
--
ALTER TABLE `webhook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `webhook_log`
--
ALTER TABLE `webhook_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `writeoff`
--
ALTER TABLE `writeoff`
  MODIFY `Writeoff_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1548;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `simplechat_message`
--
ALTER TABLE `simplechat_message`
  ADD CONSTRAINT `fk-simplechat_message-receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `simplechat_user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-simplechat_message-sender_id` FOREIGN KEY (`sender_id`) REFERENCES `simplechat_user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `simplechat_user_profile`
--
ALTER TABLE `simplechat_user_profile`
  ADD CONSTRAINT `fk-simplechat_user_profile-id` FOREIGN KEY (`id`) REFERENCES `simplechat_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

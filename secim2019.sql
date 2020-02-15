-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:8889
-- Üretim Zamanı: 03 Ağu 2019, 21:31:58
-- Sunucu sürümü: 5.7.23
-- PHP Sürümü: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Veritabanı: `secim2019`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cities`
--

CREATE TABLE `cities` (
  `id` int(5) NOT NULL,
  `cid` int(11) NOT NULL,
  `cname` varchar(15) COLLATE utf8mb4_turkish_ci NOT NULL,
  `cpop` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `cities`
--

INSERT INTO `cities` (`id`, `cid`, `cname`, `cpop`) VALUES
(1, 601, 'Akyurt', 18989),
(2, 602, 'Altındağ', 249010),
(3, 603, 'Ayaş', 11451),
(4, 604, 'Beypazarı', 35475),
(5, 605, 'Çankaya', 683071),
(6, 606, 'Etimesgut', 327211),
(7, 607, 'Gölbaşı', 77097),
(8, 608, 'Haymana', 29528),
(9, 609, 'Keçiören', 609900),
(10, 610, 'Mamak', 402281),
(11, 611, 'Yenimahalle', 435635);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_pass` varchar(60) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_fullname` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `type` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `login`
--

INSERT INTO `login` (`user_id`, `user_email`, `user_pass`, `user_fullname`, `type`) VALUES
(5, 'Ysk@gmail.com', '1234', 'YSK', 1),
(7, 'Akp@gmail.com', '1234', 'AKP', 2),
(6, 'Chp@gmail.com', '1234', 'CHP', 2),
(8, 'İyi@gmail.com', '1234', 'İYİ', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oylar`
--

CREATE TABLE `oylar` (
  `id` int(5) NOT NULL,
  `vid` int(10) NOT NULL,
  `vittifak` varchar(10) COLLATE utf8mb4_turkish_ci NOT NULL,
  `voy` int(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `oylar`
--

INSERT INTO `oylar` (`id`, `vid`, `vittifak`, `voy`) VALUES
(1, 601, 'millet', 1733),
(2, 601, 'cumhur', 17256),
(3, 602, 'millet', 112352),
(4, 602, 'cumhur', 136658),
(5, 603, 'millet', 9231),
(6, 603, 'cumhur', 2220),
(7, 604, 'millet', 29936),
(8, 604, 'cumhur', 5539),
(9, 605, 'millet', 450921),
(10, 605, 'cumhur', 232150),
(11, 606, 'millet', 235604),
(12, 606, 'cumhur', 91607),
(13, 607, 'millet', 40900),
(14, 607, 'cumhur', 36197),
(15, 608, 'millet', 2900),
(16, 608, 'cumhur', 26628),
(17, 609, 'millet', 303664),
(18, 609, 'cumhur', 306236),
(19, 610, 'millet', 237884),
(20, 610, 'cumhur', 164397),
(21, 611, 'millet', 310900),
(22, 611, 'cumhur', 124735);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Tablo için indeksler `oylar`
--
ALTER TABLE `oylar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `oylar`
--
ALTER TABLE `oylar`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 dec 2016 om 14:07
-- Serverversie: 5.7.14
-- PHP-versie: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monteur`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `aanvraag`
--

CREATE TABLE `aanvraag` (
  `id` int(11) NOT NULL,
  `aanvraag` text NOT NULL,
  `datum` date NOT NULL,
  `tijdseenheid` varchar(45) NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `aanvraag`
--

INSERT INTO `aanvraag` (`id`, `aanvraag`, `datum`, `tijdseenheid`, `status`) VALUES
(25, '<p>Geachte heer/mevrouw,</p>\n<p>&nbsp;</p>\n<p>Mijn naam is Christiaan, ik heb een monteur nodig om bepaalde storingen te verhelpen van mijn huis.</p>\n<p>&nbsp;</p>\n<p>Met vriendelijke groeten,</p>\n<p>C. de Haan</p>', '2014-05-03', '09:00 - 12:00', NULL),
(26, '<p>Geachte heer/mevrouw,</p>\n<p>&nbsp;</p>\n<p>Mijn naam is Chris, ik heb een monteur nodig om bepaalde storingen te verhelpen van mijn huis.</p>\n<p>&nbsp;</p>\n<p>Met vriendelijke groeten,</p>\n<p>C.&nbsp;Nicolaas</p>', '2014-05-04', '12:00 - 15:00', NULL),
(27, '<p>Geachte heer/mevrouw,</p>\r\n<p>&nbsp;</p>\r\n<p>Mijn naam is Hannah, ik heb een monteur nodig om bepaalde storingen te verhelpen van mijn huis.</p>\r\n<p>&nbsp;</p>\r\n<p>Met vriendelijke groeten,</p>\r\n<p>H. van der Drika</p>', '2014-05-03', '09:00 - 12:00', NULL),
(28, '<p>Geachte heer/mevrouw,</p>\r\n<p>&nbsp;</p>\r\n<p>Mijn naam is Fred, ik heb een monteur nodig om bepaalde storingen te verhelpen van mijn huis.</p>\r\n<p>&nbsp;</p>\r\n<p>Met vriendelijke groeten,</p>\r\n<p>F. Jochem</p>', '2014-05-04', '12:00 - 15:00', NULL),
(29, '<p>Geachte heermevrouw,</p>\n<p>&nbsp;</p>\n<p>Mijn naam is Cilla, ik heb een monteur nodig om bepaalde storingen te verhelpen van mijn huis.</p>\n<p>&nbsp;</p>\n<p>Met vriendelijke groeten,</p>\n<p>C. de Jette</p>', '2014-05-04', '12:00 - 15:00', NULL),
(30, '<p>Geachte heermevrouw,</p>\r\n<p>&nbsp;</p>\r\n<p>Mijn naam is Anne,&nbsp;ik heb een monteur nodig om bepaalde storingen te verhelpen van mijn huis.</p>\r\n<p>&nbsp;</p>\r\n<p>Met vriendelijke groeten,</p>\r\n<p>A. Constantijn</p>', '2014-05-03', '09:00 - 12:00', NULL),
(31, '<p>Geachte heermevrouw,</p>\r\n<p>&nbsp;</p>\r\n<p>Mijn naam is Arie, ik heb een monteur nodig om bepaalde storingen te verhelpen van mijn huis.</p>\r\n<p>&nbsp;</p>\r\n<p>Met vriendelijke groeten,</p>\r\n<p>A. Hugo</p>', '2014-05-04', '12:00 - 15:00', NULL),
(32, '<p>adg</p>', '2014-05-08', '09:00 - 12:00', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `afgeronde_afspraken`
--

CREATE TABLE `afgeronde_afspraken` (
  `afspraak_id` int(11) NOT NULL,
  `omschrijving` text NOT NULL,
  `werkzaamheden` text NOT NULL,
  `materialen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `afgeronde_afspraken`
--

INSERT INTO `afgeronde_afspraken` (`afspraak_id`, `omschrijving`, `werkzaamheden`, `materialen`) VALUES
(29, '<p>Ik heb de klachten verholpen van de klant.</p>', '<p>&nbsp;</p>\r\n<ul style="box-sizing: border-box; border-collapse: collapse; margin-left: 5px; padding-left: 15px; font-family: \'Segoe UI_\', \'Open Sans\', Verdana, Arial, Helvetica, sans-serif; font-weight: normal; font-style: normal; color: #000000; font-size: 11pt; line-height: 15pt; letter-spacing: 0.02em;">\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">WC ontstopt</li>\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">Leiding aangelegt</li>\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">Lekkage verholpen</li>\r\n</ul>', '<p>&nbsp;</p>\r\n<ul style="box-sizing: border-box; border-collapse: collapse; margin-left: 5px; padding-left: 15px; font-family: \'Segoe UI_\', \'Open Sans\', Verdana, Arial, Helvetica, sans-serif; font-weight: normal; font-style: normal; color: #000000; font-size: 11pt; line-height: 15pt; letter-spacing: 0.02em;">\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">Ontstopper</li>\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">PVC-buis (1m)</li>\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">Kit</li>\r\n</ul>'),
(30, '<p>Ik heb de klachten verholpen van de klant.</p>', '<ul>\n<li>WC ontstopt</li>\n<li>Leiding aangelegt</li>\n<li>Lekkage verholpen</li>\n</ul>', '<ul>\r\n<li>Ontstopper</li>\r\n<li>PVC-buis (1m)</li>\r\n<li>Kit</li>\r\n</ul>'),
(31, '<p>&nbsp;</p>\r\n<p style="box-sizing: border-box; border-collapse: collapse; font-family: \'Segoe UI_\', \'Open Sans\', Verdana, Arial, Helvetica, sans-serif; font-weight: normal; font-style: normal; margin: 0px 0px 7pt; color: #000000; font-size: 11pt; line-height: 15pt; letter-spacing: 0.02em;">Ik heb de klachten verholpen van de klant.</p>', '<p>&nbsp;</p>\r\n<ul style="box-sizing: border-box; border-collapse: collapse; margin-left: 5px; padding-left: 15px; font-family: \'Segoe UI_\', \'Open Sans\', Verdana, Arial, Helvetica, sans-serif; font-weight: normal; font-style: normal; color: #000000; font-size: 11pt; line-height: 15pt; letter-spacing: 0.02em;">\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">WC ontstopt</li>\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">Leiding aangelegt</li>\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">Lekkage verholpen</li>\r\n</ul>', '<p>&nbsp;</p>\r\n<ul style="box-sizing: border-box; border-collapse: collapse; margin-left: 5px; padding-left: 15px; font-family: \'Segoe UI_\', \'Open Sans\', Verdana, Arial, Helvetica, sans-serif; font-weight: normal; font-style: normal; color: #000000; font-size: 11pt; line-height: 15pt; letter-spacing: 0.02em;">\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">Ontstopper</li>\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">PVC-buis (1m)</li>\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">Kit</li>\r\n</ul>'),
(32, '<p>&nbsp;</p>\r\n<p style="box-sizing: border-box; border-collapse: collapse; font-family: \'Segoe UI_\', \'Open Sans\', Verdana, Arial, Helvetica, sans-serif; font-weight: normal; font-style: normal; margin: 0px 0px 7pt; color: #000000; font-size: 11pt; line-height: 15pt; letter-spacing: 0.02em;">Ik heb de klachten verholpen van de klant.</p>', '<p>&nbsp;</p>\r\n<ul style="box-sizing: border-box; border-collapse: collapse; margin-left: 5px; padding-left: 15px; font-family: \'Segoe UI_\', \'Open Sans\', Verdana, Arial, Helvetica, sans-serif; font-weight: normal; font-style: normal; color: #000000; font-size: 11pt; line-height: 15pt; letter-spacing: 0.02em;">\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">WC ontstopt</li>\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">Leiding aangelegt</li>\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">Lekkage verholpen</li>\r\n</ul>', '<p>&nbsp;</p>\r\n<ul style="box-sizing: border-box; border-collapse: collapse; margin-left: 5px; padding-left: 15px; font-family: \'Segoe UI_\', \'Open Sans\', Verdana, Arial, Helvetica, sans-serif; font-weight: normal; font-style: normal; color: #000000; font-size: 11pt; line-height: 15pt; letter-spacing: 0.02em;">\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">Ontstopper</li>\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">PVC-buis (1m)</li>\r\n<li style="box-sizing: border-box; border-collapse: collapse; line-height: 20px;">Kit</li>\r\n</ul>');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `afspraak`
--

CREATE TABLE `afspraak` (
  `id` int(11) NOT NULL,
  `opmerking` text,
  `datum` date NOT NULL,
  `tijd` time NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `aanvraag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `afspraak`
--

INSERT INTO `afspraak` (`id`, `opmerking`, `datum`, `tijd`, `status`, `aanvraag_id`) VALUES
(29, '<p>Wees op tijd!</p>', '2014-05-04', '09:15:00', NULL, 26),
(30, '<p>Wees op tijd!</p>', '2014-05-03', '10:00:00', NULL, 25),
(31, '<p>Wees op tijd!</p>', '2014-05-03', '12:00:00', NULL, 27),
(32, '<p>Vergeet niet op tijd te komen!</p>', '2014-05-04', '12:15:00', NULL, 28),
(33, '<p>Kom niet te laat!</p>', '2014-05-04', '15:00:00', NULL, 29),
(34, '<p>Kom niet te laat!</p>', '2014-05-03', '10:30:00', NULL, 30);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bericht`
--

CREATE TABLE `bericht` (
  `id` int(11) NOT NULL,
  `gebruiker_id` int(11) DEFAULT NULL,
  `naam` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telnr` varchar(45) NOT NULL,
  `bericht` text NOT NULL,
  `tijd` time NOT NULL,
  `datum` date NOT NULL,
  `antwoord` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `bericht`
--

INSERT INTO `bericht` (`id`, `gebruiker_id`, `naam`, `email`, `telnr`, `bericht`, `tijd`, `datum`, `antwoord`) VALUES
(1, NULL, 'Halil', 'test@live.nl', '0651629548', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac malesuada orci. Praesent euismod sit amet metus non suscipit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac malesuada orci. Praesent euismod sit amet metus non suscipit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac malesuada orci. Praesent euismod sit amet metus non suscipit.', '14:33:14', '2014-04-15', 0),
(2, NULL, 'sd', 'h.teker@live.nl', '0615628495', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac malesuada orci. Praesent euismod sit amet metus non suscipit.', '14:38:59', '2014-04-15', 0),
(3, 10, 'Lorem', 'teker070@live.nl', '0635454820', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac malesuada orci. Praesent euismod sit amet metus non suscipit.', '15:31:57', '2014-04-15', 0),
(4, 10, 'Lorem', 'teker070@live.nl', '0635454820', 'Dit is een test email', '15:32:29', '2014-04-15', 1),
(5, 10, 'Lorem', 'teker070@live.nl', '0635454820', 'Dit is een test-email', '16:23:50', '2014-04-15', 1),
(6, NULL, 'Lorem Ipsum', 'loremipsum@live.nl', '0612345678', 'Lorem Ipsum fasndjfnv dsfasdf', '07:59:16', '2014-04-17', 0),
(7, 6, 'Halil', 'h.teker@live.nl', '0615268495', 'test', '18:50:04', '2014-04-20', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `factuur`
--

CREATE TABLE `factuur` (
  `id` int(11) NOT NULL,
  `prijs` decimal(6,2) NOT NULL,
  `korting` decimal(6,2) DEFAULT NULL,
  `totaalprijs` decimal(6,2) NOT NULL,
  `voldaan` tinyint(1) NOT NULL DEFAULT '0',
  `afgeronde_afspraken_afspraak_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `tijd` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `factuur`
--

INSERT INTO `factuur` (`id`, `prijs`, `korting`, `totaalprijs`, `voldaan`, `afgeronde_afspraken_afspraak_id`, `datum`, `tijd`) VALUES
(9, '485.95', '23.45', '462.50', 0, 29, '2014-05-04', '17:43:00'),
(10, '325.45', '12.95', '312.50', 0, 30, '2014-05-04', '17:44:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker`
--

CREATE TABLE `gebruiker` (
  `id` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL,
  `tussenvoegsel` varchar(45) DEFAULT NULL,
  `achternaam` varchar(45) NOT NULL,
  `adres` varchar(45) NOT NULL,
  `postcode` varchar(45) NOT NULL,
  `plaats` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `wachtwoord` varchar(130) NOT NULL,
  `salt` varchar(50) NOT NULL,
  `telnr` varchar(45) NOT NULL,
  `account_type` varchar(45) NOT NULL,
  `actief` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `gebruiker`
--

INSERT INTO `gebruiker` (`id`, `naam`, `tussenvoegsel`, `achternaam`, `adres`, `postcode`, `plaats`, `email`, `wachtwoord`, `salt`, `telnr`, `account_type`, `actief`) VALUES
(12, 'Muhlis', '', 'Teker', 'Morgenzonlaan 21', '1562FD', 'Den Haag', 'm.teker@live.nl', 'c0e3e82c24e98a82f650d231d67b394c04f239dddbef2070f514ecc4b54d3d731acb732ef3edd401bea4af1606cb28838c8e11e18c72982387db09373adead8c', '18lYKA3wvN', '0632568945', 'monteur', 1),
(13, 'Huub', '', 'Jochem', 'Hobbemastraat 156', '8495HG', 'Den Haag', 'h.jochem@live.nl', '2a8c294d3a6d737958f30db41ef6696a5a4b28c4b46f655c0f3f99b04fde185501d8f65e53ec916cd2ea6adce2406fc7a9f129b130a3c780ea57d4db908121de', '2aXyv9duu', '0632489645', 'monteur', 1),
(14, 'Heiko', 'de', 'Klaas', 'Honthorstraat 178', '8496AS', 'Den Haag', 'h.de.klaas@live.nl', '211eb982281aa7124c18564de25de4726a92e338eb90ffe1f52d18cffec9c3f222834fc788e6ddea648f34fc5bade55af191b64134b677d36c041d92f438b568', 'fPQDDgTyr1', '0632489562', 'monteur', 1),
(15, 'Joost', 'de', 'Meer', 'Kaapstraat 326', '3298VC', 'Den Haag', 'j.de.meer@live.nl', '3eff3d7e44f557e547c49c47a5db5e9bfc4377565e24288a9275cb02748fb0a8d30878cc544869e95cfdd26168e669b38c21d9a1e4575c1a17c187e6e4892605', 'kIIs1AtPYc', '0632485162', 'monteur', 1),
(16, 'Thijs', '', 'Janssen', 'Spuiweg 120', '3245VC', 'Den Haag', 't.janssen@live.nl', '71b198436bb69d15350c18ce1cf002678f9bad75668a5f8e709c5bf0f267f5c9c9199e82d308fd5bf9eb77938f506f91e8de187ebe38190917ed09f5e23dfd5b', 'uIiQBiVfa', '0695214765', 'monteur', 1),
(17, 'Christiaan', 'de', 'Haan', 'Kempstraat 13', '2572GF', 'Den Haag', 'c.de.haan@live.nl', 'c7b2dd5247ec4a9a744b4c7c7920695f2f3e443561d59089e34fb17ee263f75629497f514e9349003bb570507ddcf9fed4c8b2833e6ca4bb8379f7b193a14c67', '7XbPSRIRqp', '0684129584', 'klant', 1),
(18, 'Chris', '', 'Nicolaas', 'Vaillantlaan 320', '5162FD', 'Den Haag', 'c.nicolaas@live.nl', '2ec7d81014b66a1cc06727b62113b6da8615b682146354a375df29bad17602e19db6214f4f797d466e53edc626f9d273d0df37ea386bc4ddd350a0bb89447464', 'VqmtGoVgTy', '0612516295', 'klant', 1),
(19, 'Hannah', 'van der', 'Drika', 'Zuiderparklaan 1532', '6295BF', 'Den Haag', 'h.van.der.drika@live.nl', 'c42e838057555c4af501024117d2725b0bcb14f753fcdf2f0a19d6a6f5309b8190ce5047f2cb1a4a02f3269728a1f16faf02cd6270ec9c21cf23d80fd95664fa', 'L0MYeWo1rZ', '0632459865', 'klant', 1),
(20, 'Fred', '', 'Jochem', 'Harderwijkstraat 323', '6295VC', 'Den Haag', 'f.jochem@live.nl', '0aa487c3502b3cba30a2fab43409ed023e59444b7c19972f03c7f76220061687655473c1c52d43bc5fa30d048fc285409343de10cd7eb3074f13ef7ee9219ebb', 'hQjL9Kmmdy', '0621489562', 'klant', 1),
(21, 'Cilla', 'de', 'Jette', 'Morgenzonlaan 356', '1562FD', 'Den Haag', 'c.de.jette@live.nl', '2bfa9a725a8c913d14834d922d072c8227eaf2e2e6a1e3c46bd9c144f6633020eb62944e30a32d1f1a9aa99a87e69e3951d8ec0021453b41b71ed0e9eeec0e5a', 'wmdEgSlRAu', '0632659845', 'klant', 1),
(22, 'Anne', '', 'Constantijn', 'Schalkburgerstraat 265', '1532FD', 'Den Haag', 'a.constantijn@live.nl', 'f17b486f990e2d2889daa88a1ec4b369a5d21a7f320e1a1b450458efcde21f722e918a34270f0b262e8f350b08be37cfd8d561ec7f258a1ada8cd1429c278645', 'kwViougTf6', '0645623215', 'klant', 1),
(23, 'Arie', '', 'Hugo', 'Marktweg 265', '8485SD', 'Den Haag', 'a.hugo@live.nl', 'e281b15f38f3e112da96be824a9d7374abbd0afe6dc284a64f274723540e979dfe35f699e0c7648351ab350c2e6f04d93772e5ddfcf506ba39a6c3374d97fc60', '3m7cjiJ8sP', '0665128495', 'klant', 1),
(24, 'Halil', '', 'Teker', 'Morgenzonlaan 21', '1595SA', 'Den Haag', 'h.teker@live.nl', '05f54b0ac72f64204675c77bff0c85ca3a4f1304067f3bf63de42782622516d865caa826866d7f25188bc87a901d844651058e27d81d569bfb8a2c81345f13eb', 'B04PKNmCy1', '0648953248', 'admin', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker_aanvraag`
--

CREATE TABLE `gebruiker_aanvraag` (
  `id` int(11) NOT NULL,
  `gebruiker_id` int(11) NOT NULL,
  `aanvraag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `gebruiker_aanvraag`
--

INSERT INTO `gebruiker_aanvraag` (`id`, `gebruiker_id`, `aanvraag_id`) VALUES
(24, 17, 25),
(25, 18, 26),
(26, 19, 27),
(27, 20, 28),
(28, 21, 29),
(29, 22, 30),
(30, 23, 31);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker_afspraak`
--

CREATE TABLE `gebruiker_afspraak` (
  `id` int(11) NOT NULL,
  `gebruiker_id` int(11) NOT NULL,
  `afspraak_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `gebruiker_afspraak`
--

INSERT INTO `gebruiker_afspraak` (`id`, `gebruiker_id`, `afspraak_id`) VALUES
(19, 18, 29),
(20, 12, 29),
(21, 17, 30),
(22, 13, 30),
(23, 19, 31),
(24, 13, 31),
(25, 20, 32),
(26, 12, 32),
(27, 21, 33),
(28, 12, 33),
(29, 22, 34),
(30, 13, 34);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker_factuur`
--

CREATE TABLE `gebruiker_factuur` (
  `id` int(11) NOT NULL,
  `gebruiker_id` int(11) NOT NULL,
  `factuur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `gebruiker_factuur`
--

INSERT INTO `gebruiker_factuur` (`id`, `gebruiker_id`, `factuur_id`) VALUES
(1, 12, 9),
(2, 18, 9),
(3, 13, 10),
(4, 17, 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pagina`
--

CREATE TABLE `pagina` (
  `id` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL,
  `bestand` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `pagina`
--

INSERT INTO `pagina` (`id`, `naam`, `bestand`) VALUES
(1, 'startpagina', 'index.php'),
(2, 'contactformulier voor bezoeker', 'bezoeker_contact.php'),
(3, 'overzicht van de prijzen', 'prijzen.php'),
(4, 'registratieformulier voor bezoeker', 'bezoeker_registreren.php'),
(5, 'log in', 'log_in.php'),
(6, 'algemene voorwaarden', 'algemene_voorwaarden.php'),
(7, 'log uit', 'log_uit.php'),
(8, 'formulier accountgegevens wijzigen', 'gebruiker_account_gegevens_wijzigen.php'),
(9, 'contactformulier voor de gebruiker', 'gebruiker_contact.php'),
(10, 'overzicht facturen voor de klant', 'klant_facturen_bekijken.php'),
(11, 'overzicht aanvragen voor klant', 'klant_aanvragen_bekijken.php'),
(12, 'overzicht afspraken voor klant', 'klant_afspraken_bekijken.php'),
(13, 'aanvraagformulier voor klant', 'klant_vraag_aan.php'),
(14, 'overzicht facturen voor monteur', 'monteur_facturen_bekijken.php'),
(15, 'formulier factuur maken voor monteur', 'monteur_factuur_maken.php'),
(16, 'overzicht afspraken voor monteur', 'monteur_afspraken_bekijken.php'),
(17, 'overzicht afgeronde afspraken voor monteur', 'monteur_afgeronde_afspraken_bekijken.php'),
(18, 'overzicht facturen voor admin', 'admin_facturen_bekijken.php'),
(19, 'overzicht monteurs voor admin', 'admin_monteurs_bekijken.php'),
(20, 'formulier monteur toevoegen voor admin', 'admin_monteur_toevoegen.php'),
(21, 'overzicht aanvragen voor admin', 'admin_aanvragen_bekijken.php'),
(22, 'overzicht afspraken voor admin', 'admin_afspraken_bekijken.php'),
(23, 'overzicht afgeronde afspraken voor admin', 'admin_afgeronde_afspraken_bekijken.php'),
(24, 'berichtencentrum voor admin', 'admin_berichten.php'),
(25, 'klant-zoekmachine voor admin', 'admin_klant_zoeken.php'),
(26, 'Inloggegevens opvragen via de mail', 'wachtwoord_vergeten.php');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `aanvraag`
--
ALTER TABLE `aanvraag`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `afgeronde_afspraken`
--
ALTER TABLE `afgeronde_afspraken`
  ADD PRIMARY KEY (`afspraak_id`),
  ADD KEY `fk_afgeronde_afspraken_afspraak1_idx` (`afspraak_id`);

--
-- Indexen voor tabel `afspraak`
--
ALTER TABLE `afspraak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_afspraak_aanvraag1_idx` (`aanvraag_id`),
  ADD KEY `aanvraag_id` (`aanvraag_id`);

--
-- Indexen voor tabel `bericht`
--
ALTER TABLE `bericht`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `factuur`
--
ALTER TABLE `factuur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_factuur_afgeronde_afspraken1_idx` (`afgeronde_afspraken_afspraak_id`);

--
-- Indexen voor tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gebruiker_aanvraag`
--
ALTER TABLE `gebruiker_aanvraag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_gebruiker_aanvraag_gebruiker_idx` (`gebruiker_id`),
  ADD KEY `fk_gebruiker_aanvraag_aanvraag1_idx` (`aanvraag_id`);

--
-- Indexen voor tabel `gebruiker_afspraak`
--
ALTER TABLE `gebruiker_afspraak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_gebruiker_afspraak_gebruiker1_idx` (`gebruiker_id`),
  ADD KEY `fk_gebruiker_afspraak_afspraak1_idx` (`afspraak_id`);

--
-- Indexen voor tabel `gebruiker_factuur`
--
ALTER TABLE `gebruiker_factuur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_gebruiker_factuur_gebruiker1_idx` (`gebruiker_id`),
  ADD KEY `fk_gebruiker_factuur_factuur1_idx` (`factuur_id`);

--
-- Indexen voor tabel `pagina`
--
ALTER TABLE `pagina`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `aanvraag`
--
ALTER TABLE `aanvraag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT voor een tabel `afspraak`
--
ALTER TABLE `afspraak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT voor een tabel `bericht`
--
ALTER TABLE `bericht`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `factuur`
--
ALTER TABLE `factuur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT voor een tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT voor een tabel `gebruiker_aanvraag`
--
ALTER TABLE `gebruiker_aanvraag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT voor een tabel `gebruiker_afspraak`
--
ALTER TABLE `gebruiker_afspraak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT voor een tabel `gebruiker_factuur`
--
ALTER TABLE `gebruiker_factuur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `pagina`
--
ALTER TABLE `pagina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `afgeronde_afspraken`
--
ALTER TABLE `afgeronde_afspraken`
  ADD CONSTRAINT `fk_afgeronde_afspraken_afspraak1` FOREIGN KEY (`afspraak_id`) REFERENCES `afspraak` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `afspraak`
--
ALTER TABLE `afspraak`
  ADD CONSTRAINT `fk_afspraak_aanvraag1` FOREIGN KEY (`aanvraag_id`) REFERENCES `aanvraag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `factuur`
--
ALTER TABLE `factuur`
  ADD CONSTRAINT `fk_factuur_afgeronde_afspraken1` FOREIGN KEY (`afgeronde_afspraken_afspraak_id`) REFERENCES `afgeronde_afspraken` (`afspraak_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `gebruiker_aanvraag`
--
ALTER TABLE `gebruiker_aanvraag`
  ADD CONSTRAINT `fk_gebruiker_aanvraag_aanvraag1` FOREIGN KEY (`aanvraag_id`) REFERENCES `aanvraag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gebruiker_aanvraag_gebruiker` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `gebruiker_afspraak`
--
ALTER TABLE `gebruiker_afspraak`
  ADD CONSTRAINT `fk_gebruiker_afspraak_afspraak1` FOREIGN KEY (`afspraak_id`) REFERENCES `afspraak` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gebruiker_afspraak_gebruiker1` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `gebruiker_factuur`
--
ALTER TABLE `gebruiker_factuur`
  ADD CONSTRAINT `fk_gebruiker_factuur_factuur1` FOREIGN KEY (`factuur_id`) REFERENCES `factuur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gebruiker_factuur_gebruiker1` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

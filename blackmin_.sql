
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `blackmin`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bm_data_posty`
--

CREATE TABLE `bm_data_posty` (
  `id` int(11) NOT NULL,
  `dodajacy` text COLLATE utf8_unicode_ci NOT NULL,
  `tytul` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `kategoria` text COLLATE utf8_unicode_ci NOT NULL,
  `kategoria_post` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password_post` text COLLATE utf8_unicode_ci NOT NULL,
  `tagi` text COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `datetime_zmiany` datetime NOT NULL,
  `kto_edit` text COLLATE utf8_unicode_ci NOT NULL,
  `visit` bigint(20) NOT NULL,
  `bm_komentarze` varchar(5) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `bm_miniaturka` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `tresc` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `bm_data_posty`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bm_filemeta`
--

CREATE TABLE `bm_filemeta` (
  `id` int(11) NOT NULL,
  `bm_autor` int(11) NOT NULL,
  `bm_nazwa` text COLLATE utf8_unicode_ci NOT NULL,
  `bm_nazwa_zmiany` text COLLATE utf8_unicode_ci NOT NULL,
  `bm_datetime_wgrania` datetime NOT NULL,
  `bm_datetime_zmiany` datetime NOT NULL,
  `bm_opis` text COLLATE utf8_unicode_ci NOT NULL,
  `bm_typ_pliku` text COLLATE utf8_unicode_ci NOT NULL,
  `bm_miniaturka` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `bm_folder` text COLLATE utf8_unicode_ci NOT NULL,
  `bm_sciezka` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bm_komentarze`
--

CREATE TABLE `bm_komentarze` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_dodajacego` int(11) NOT NULL,
  `id_odp_komentarz` int(11) NOT NULL,
  `tresc_komentarza` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bm_metaposty`
--

CREATE TABLE `bm_metaposty` (
  `id` int(11) NOT NULL,
  `bm_nazwa` text COLLATE utf8_unicode_ci NOT NULL,
  `bm_skr_nazwa` text COLLATE utf8_unicode_ci NOT NULL,
  `bm_opis` text COLLATE utf8_unicode_ci NOT NULL,
  `bm_KT` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `bm_metaposty`
--

INSERT INTO `bm_metaposty` (`id`, `bm_nazwa`, `bm_skr_nazwa`, `bm_opis`, `bm_KT`) VALUES
(1, 'blackmin', 'blackmin', 'blackmin', 'kategoria'),
(2, 'blackmin', 'blackmin', 'blackmin', 'tag'),
(3, 'asca', 'scascasc', 'ascasc', 'kategoria'),
(4, 'fewef', 'scascasc', 'ascasc', 'kategoria');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bm_postmeta`
--

CREATE TABLE `bm_postmeta` (
  `id` int(11) NOT NULL,
  `bm_kontent` text COLLATE utf8_unicode_ci NOT NULL,
  `bm_nazwa` text COLLATE utf8_unicode_ci NOT NULL,
  `bm_wartosc` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `bm_postmeta`
--

INSERT INTO `bm_postmeta` (`id`, `bm_kontent`, `bm_nazwa`, `bm_wartosc`) VALUES
(7, 'menu', 'menu_item', '[\"ewf\",\"http://localhost/bm/\",\"link\"]'),
(8, 'menu', 'menu_item', '[\"bm\",\"http://localhost/bm/\",\"link\"]'),
(9, 'menu', 'menu_item', '[\"b\",\"http://localhost/bm/\",\"link\"]'),
(10, 'menu', 'menu_item', '[\"bb\",\"http://localhost/bm/\",\"link\"]'),
(11, 'menu', 'menu_item', '[\"bb\",\"http://localhost/bm/\",\"link\"]'),
(12, 'menu', 'menu_item', '[\"bb\",\"http://localhost/bm/\",\"link\"]'),
(13, 'menu', 'menu_item', '[\"bm\",\"http://localhost/bm/\",\"link\"]'),
(14, 'menu', 'menu_item', '[\"test1\",\"http://localhost/bm/1/\",\"link\"]'),
(15, 'menu', 'menu_item', '[\"test2\",\"http://localhost/bm/\",\"link\"]'),
(16, 'menu', 'menu_item', '[\"s\",\"http://localhost/bm/\",\"link\"]'),
(17, 'menu', 'menu_item', '[\"d\",\"http://localhost/bm/\",\"link\"]'),
(22, 'menu', 'menu_item', '[\"http://localhost/bm/\",\"http://localhost/bm/\",\"link\"]'),
(58, 'menu', 'new_menu_item', '[\"home\",\"https://localhost/bm-test\",\"link\"]');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bm_status`
--

CREATE TABLE `bm_status` (
  `id` int(11) NOT NULL,
  `bm_nazwa` text COLLATE utf8_unicode_ci NOT NULL,
  `bm_wartosc` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `bm_status`
--

INSERT INTO `bm_status` (`id`, `bm_nazwa`, `bm_wartosc`) VALUES
(1, 'bm_installation_admin', 'timo'),
(2, 'bm_admin_mail', 'nd2@nd.pl'),
(3, 'bm_version_db', '2.0'),
(4, 'bm_aupt_public', ''),
(5, 'bm_aupt_private', ''),
(6, 'bm_aupt_acces', 'true'),
(7, 'bm_date_installation', '27.02.2021'),
(8, 'bm_version', '2.0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bm_ustawienia_bm`
--

CREATE TABLE `bm_ustawienia_bm` (
  `id` int(11) NOT NULL,
  `bm_nazwa` text COLLATE utf8_unicode_ci NOT NULL,
  `bm_wartosc` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `bm_ustawienia_bm`
--

INSERT INTO `bm_ustawienia_bm` (`id`, `bm_nazwa`, `bm_wartosc`) VALUES
(1, 'url_server', 'https://localhost/bm/'),
(2, 'url_site', 'https://localhost/bm/ac/'),
(3, 'bm_name_site', 'Black Min'),
(4, 'bm_description_site', 'dfs'),
(5, 'bm_icon_site', 'https://localhost/bm/pliki/logo/logo_bm_white_2_100_100.png'),
(6, 'bm_icon_png_site', 'https://localhost/bm/pliki/logo/logo_bm_white_2_100_100.png'),
(7, 'bm_register', 'false'),
(8, 'bm_login', 'false'),
(9, 'bm_comment', 'false'),
(10, 'bm_keywords', 'asdasd,ffghfgh,fgfghfg,ddgd'),
(11, 'bm_logo', 'https://localhost/bm/pliki/logo/logo_bm_white_2_100_100.png'),
(12, 'bm_banner', 'https://localhost/bm/pliki/logo/logo_bm_white_2_100_100.png'),
(13, 'bm_menu_structur', '[{\"id\":\"10\",\"children\":[{\"id\":\"7\",\"children\":[{\"id\":\"8\"}]}]},{\"id\":\"9\",\"children\":[{\"id\":\"11\"},{\"id\":\"12\"}]},{\"id\":\"13\"},{\"id\":\"14\"},{\"id\":\"15\"},{\"id\":\"16\"},{\"id\":\"17\"},{\"id\":\"22\"}]'),
(14, 'bm_mail_site', 'nd@nd.pl'),
(15, 'bm_new_user', 'właśćiciel'),
(16, 'bm_lang_site', 'PL_pl'),
(17, 'bm_timezone', 'Europe/Warsaw'),
(18, 'bm_date', 'm.d.Y'),
(19, 'bm_time', 'H:i'),
(20, 'bm_server_mail', ''),
(21, 'bm_server_mail_login', ''),
(22, 'bm_server_mail_password', ''),
(23, 'bm_server_mail_port', ''),
(24, 'bm_default_format_post', 'szkic'),
(25, 'bm_default_status_post', 'post'),
(26, 'bm_default_load_post', '25'),
(27, 'bm_default_load_comment', '14'),
(34, 'bm_cookie_description', ''),
(35, 'bm_cookie_link', ''),
(36, 'bm_cookie_privacy_policy_link', ''),
(37, 'bm_cookie_accept', 'Akceptuję'),
(38, 'bm_panel_powitanie', 'true'),
(39, 'bm_theme_active', 'braund'),
(40, 'bm_robots', 'noindex, nofollow'),
(41, 'bm_maintenance_mode', 'false'),
(42, 'bm_maintenance_mode_title', 'Konserwacja!'),
(43, 'bm_maintenance_mode_description', 'przeprowadzana jest konserwacja witryny'),
(44, 'bm_maintenance_mode_datetime', '2021-10-31T23:59'),
(45, 'bm_top_widget', '\"NULL\"'),
(46, 'bm_left_widget', '\"NULL\"'),
(47, 'bm_right_widget', '[{\"plugin_full\":\"blackmin\",\"plugin\":\"Wyszukiwarka\"},{\"plugin_full\":\"blackmin\",\"plugin\":\"Logowanie\"}]'),
(48, 'bm_bottom_widget', '\"NULL\"'),
(49, 'bm_footer_widget', '\"NULL\"'),
(50, 'bm_ssl', '1'),
(51, 'bm_plugin', '[]'),
(52, 'bm_default_load_upload_file', '25');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bm_uzytkownicy`
--

CREATE TABLE `bm_uzytkownicy` (
  `id` int(11) NOT NULL,
  `nick` text COLLATE utf8_unicode_ci NOT NULL,
  `imie` text COLLATE utf8_unicode_ci NOT NULL,
  `nazwisko` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `plec` text COLLATE utf8_unicode_ci NOT NULL,
  `date_dolonczenia` datetime NOT NULL,
  `avatar` text COLLATE utf8_unicode_ci NOT NULL,
  `haslo` text COLLATE utf8_unicode_ci NOT NULL,
  `token` text COLLATE utf8_unicode_ci NOT NULL,
  `dostep` text COLLATE utf8_unicode_ci NOT NULL,
  `ranga` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `flaga` int(2) NOT NULL,
  `online` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `ostatnio_aktywny` datetime NOT NULL,
  `texte_black_min_cms` mediumtext CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `bm_uzytkownicy`
--

INSERT INTO `bm_uzytkownicy` (`id`, `nick`, `imie`, `nazwisko`, `email`, `plec`, `date_dolonczenia`, `avatar`, `haslo`, `token`, `dostep`, `ranga`, `flaga`, `online`, `ostatnio_aktywny`, `texte_black_min_cms`) VALUES
(1, 'blackmin', 'blackmin', 'blackmin', 'scscs@ssf.pl', 'Mężczyzna', '2020-02-22 18:05:00', 'http://localhost/bm/pliki/logo/logo_bm_white_2_100_100.png', '$2y$10$bV0Zri3sYLQBK5W.zGz16egJBZcFQxj4M95S1adkwixF7RxQoze5G', '$2y$10$sbBdBKvB44vwE2xE5ww1NOnRS5eq85UgnlG5D7HiMDfO.KwLqnyGm', 'dostęp', 'właśćiciel', 30, 'online', '2022-02-24 10:13:35', '[test_system_users],[test_mesages]');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `bm_data_posty`
--
ALTER TABLE `bm_data_posty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `bm_filemeta`
--
ALTER TABLE `bm_filemeta`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `bm_komentarze`
--
ALTER TABLE `bm_komentarze`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `bm_metaposty`
--
ALTER TABLE `bm_metaposty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `bm_postmeta`
--
ALTER TABLE `bm_postmeta`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `bm_status`
--
ALTER TABLE `bm_status`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `bm_ustawienia_bm`
--
ALTER TABLE `bm_ustawienia_bm`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `bm_uzytkownicy`
--
ALTER TABLE `bm_uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `bm_data_posty`
--
ALTER TABLE `bm_data_posty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `bm_filemeta`
--
ALTER TABLE `bm_filemeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT dla tabeli `bm_komentarze`
--
ALTER TABLE `bm_komentarze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `bm_metaposty`
--
ALTER TABLE `bm_metaposty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `bm_postmeta`
--
ALTER TABLE `bm_postmeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT dla tabeli `bm_status`
--
ALTER TABLE `bm_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `bm_ustawienia_bm`
--
ALTER TABLE `bm_ustawienia_bm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT dla tabeli `bm_uzytkownicy`
--
ALTER TABLE `bm_uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

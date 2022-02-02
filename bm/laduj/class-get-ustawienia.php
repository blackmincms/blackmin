<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do ładowanie posdtawowych ustawienia Black Mina
	
	Black Min cms,
	
	#plik: 1.2
*/

	// depraced class codes
	// przejść na nowszy standart z class_db i wszystkimi jego funkcjami


	class get_ustawienia_bm {
		
		// ustawienie przechowywuje ankielskie nazwy ustawień (tchnp)
		protected $en_ustawienia = [
			"bm_url_server",
			"bm_url_site",
			"bm_name_site",
			"bm_description_site",
			"bm_icon_site",
			"bm_icon_ico_site",
			"bm_icon_png_site",
			"bm_register",
			"bm_login",
			"bm_comment",
			"bm_keywords",
			"bm_logo",
			"bm_banner",
			"bm_get_menu_structur",
			"bm_mail_site",
			"bm_lang_site",
			"bm_timezone",
			"bm_date",
			"bm_time",
			"bm_default_load_posts",
			"bm_default_load_comments",
			"bm_cookie_description",
			"bm_cookie_link",
			"bm_cookie_privacy_policy_link",
			"bm_cookie_accept",
			"bm_theme_active",
			"bm_robots",
			"bm_maintenance_mode",
			"bm_maintenance_mode_title",
			"bm_maintenance_mode_description",
			"bm_maintenance_mode_datetime",
			"bm_top_widget",
			"bm_left_widget",
			"bm_right_widget",
			"bm_bottom_widget",
			"bm_footer_widget",
			"bm_ssl",
			"bm_plugin",
			"bm_default_load_upload_file",
		];
		// zmienna przechowywuje dane z ustawieniami bm do sprawdzenia
		protected $sp_ustawienia = [
			"url_serwera",
			"url_witryny",
			"bm_nazwa_strony",
			"bm_opis_strony",
			"icon_site_bm",
			"bm_icon_ico",
			"bm_icon_png",
			"bm_rejestracja",
			"bm_logowanie",
			"bm_komentarze",
			"bm_slowa_kluczowe",
			"bm_logo",
			"bm_banner",
			"bm_menu_structur",
			"bm_email_witryny",
			"bm_jezyk_witryny",
			"bm_strefa_czasowa",
			"bm_date",
			"bm_time",
			"bm_domysne_laduj_posty",
			"bm_domysnie_laduj_komentarze",
			"bm_spolecznosc_opis",
			"bm_spolecznosc_link",
			"bm_spolecznosc_link_info_cookies",
			"bm_spolecznosc_text_akcept",
			"bm_motyw_aktywny",
			"bm_robots",
			"bm_tryb_konserwacji",
			"bm_tryb_konserwacji_tytul",
			"bm_tryb_konserwacji_opis",
			"bm_tryb_konserwacji_datetime",
			"bm_top_box",
			"bm_left_box",
			"bm_right_box",
			"bm_bottom_box",
			"bm_footer_box",
			"bm_ssl",
			"bm_wtyczka",
			"bm_domysne_laduj_wgrane_pliki",
		];

		public function get_ustawienia() {
			global $host, $db_user, $db_password, $db_name, $prefix_table, $polaczenie, $rezultat, $date, $date2, $date3, $date4, $time, $time2;
			
			mysqli_report(MYSQLI_REPORT_STRICT);
			
			try 
			{
				$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
				if ($polaczenie->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_errno());
				}
				else
				{		
					mysqli_query($polaczenie, "SET CHARSET utf8");
					mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");		

					if ($rezultat = $polaczenie->query(
					sprintf("SELECT * FROM `".$prefix_table."bm_ustawienia_bm` WHERE `bm_nazwa` LIKE 'url_serwera' OR `bm_nazwa` LIKE 'url_witryny' OR `bm_nazwa` LIKE 'bm_nazwa_strony' OR `bm_nazwa` LIKE 'bm_opis_strony' OR `bm_nazwa` LIKE 'bm_icon_ico' OR `bm_nazwa` LIKE 'bm_icon_png' OR `bm_nazwa` LIKE 'bm_rejestracja' OR `bm_nazwa` LIKE 'bm_logowanie' OR `bm_nazwa` LIKE 'bm_komentarze' OR `bm_nazwa` LIKE 'bm_slowa_kluczowe' OR `bm_nazwa` LIKE 'bm_logo' OR `bm_nazwa` LIKE 'bm_banner' OR `bm_nazwa` LIKE 'bm_menu_structur' OR `bm_nazwa` LIKE 'bm_email_witryny' OR `bm_nazwa` LIKE 'bm_jezyk_witryny' OR `bm_nazwa` LIKE 'bm_strefa_czasowa' OR `bm_nazwa` LIKE 'bm_date' OR `bm_nazwa` LIKE 'bm_time' OR `bm_nazwa` LIKE 'bm_domysne_laduj_posty' OR `bm_nazwa` LIKE 'bm_domysnie_laduj_komentarze' OR `bm_nazwa` LIKE 'bm_spolecznosc_opis' OR `bm_nazwa` LIKE 'bm_spolecznosc_link' OR `bm_nazwa` LIKE 'bm_spolecznosc_link_info_cookies' OR `bm_nazwa` LIKE 'bm_spolecznosc_text_akcept' OR `bm_nazwa` LIKE 'bm_robots' OR `bm_nazwa` LIKE 'bm_motyw_aktywny' OR `bm_nazwa` LIKE 'bm_tryb_konserwacji' OR `bm_nazwa` LIKE 'bm_tryb_konserwacji_tytul' OR `bm_nazwa` LIKE 'bm_tryb_konserwacji_opis' OR `bm_nazwa` LIKE 'bm_tryb_konserwacji_datetime' OR `bm_nazwa` LIKE 'bm_top_box' OR `bm_nazwa` LIKE 'bm_left_box' OR `bm_nazwa` LIKE 'bm_right_box' OR `bm_nazwa` LIKE 'bm_bottom_box' OR `bm_nazwa` LIKE 'bm_footer_box' OR `bm_nazwa` LIKE 'bm_ssl' OR `bm_nazwa` LIKE 'bm_wtyczka' OR `bm_nazwa` LIKE 'bm_domysne_laduj_wgrane_pliki'"))) {
						
						$ile = mysqli_num_rows($rezultat);

						// zmienna do przechowywania ustawień
						$get_ustawienia = [];
						
						for($i = 0; $i < $ile; $i++){
						
							$row = mysqli_fetch_assoc($rezultat);
							$id = $row['id'];
							$bm_nazwa = $row['bm_nazwa'];
							$bm_wartosc = $row['bm_wartosc'];
							
							// szukanie pobranych danych z db i posegregowanie udpowiednio nazw
							$id_sp = array_search($bm_nazwa, $this->sp_ustawienia);
							// dodawanie ustawień bm do zmiennej końcowej
							$get_ustawienia += [$this->en_ustawienia[$id_sp] => $row['bm_wartosc']];
								
						}
						
					};	
					
					$polaczenie->close();
				}
				
			}
			catch(Exception $e)
			{
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań póżniej!</span>';
				//echo '<br />Informacja developerska: '.$e;
			}
			
			return $get_ustawienia;
		}

	}

?>
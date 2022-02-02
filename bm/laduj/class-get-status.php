<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do ładowanie posdtawowych ustawienia Black Mina
	
	Black Min cms,
	
	#plik: 1.2
*/

	// depraced class codes
	// przejść na nowszy standart z class_db i wszystkimi jego funkcjami

	class get_status_bm {

		// ustawienie przechowywuje ankielskie nazwy ustawień (tchnp)
		protected $en_status = [
			"bm_installation_admin",
			"bm_admin_mail",
			"bm_version_db",
			"bm_public_aupt",
			"bm_private_aupt",
			"bm_aupt_acces",
			"bm_date_installation",
			"bm_version"
		];
		// zmienna przechowywuje dane z ustawieniami bm do sprawdzenia
		protected $sp_status = [
			"bm_nick_admin_bm",
			"bm_mail_admin_bm",
			"bm_wersja_db",
			"bm_aupt_public",
			"bm_aupt_private",
			"bm_aupt_acces",
			"bm_data_instalacji",
			"bm_wersja_black_min"
		];
	
		public function get_status() {
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
					sprintf("SELECT * FROM `".$prefix_table."bm_status` WHERE `bm_nazwa` LIKE 'bm_nick_admin_bm' OR `bm_nazwa` LIKE 'bm_mail_admin_bm' OR `bm_nazwa` LIKE 'bm_wersja_db' OR `bm_nazwa` LIKE 'bm_aupt_public' OR `bm_nazwa` LIKE 'bm_aupt_private' OR `bm_nazwa` LIKE 'bm_aupt_acces' OR `bm_nazwa` LIKE 'bm_data_instalacji' OR `bm_nazwa` LIKE 'bm_wersja_black_min'"))) {
						
						$ile = mysqli_num_rows($rezultat);
						
						$get_status = array(
							"bm_nazwa" => array(),
							"bm_wartosc" => array()
						);
						
						for($i = 0; $i < $ile; $i++){
						
							$row = mysqli_fetch_assoc($rezultat);
							$id = $row['id'];
							$bm_nazwa = $row['bm_nazwa'];
							$bm_wartosc = $row['bm_wartosc'];
							
							// szukanie pobranych danych z db i posegregowanie udpowiednio nazw
							$id_sp = array_search($bm_nazwa, $this->sp_status);
							// dodawanie ustawień bm do zmiennej końcowej
							$get_status += [$this->en_status[$id_sp] => $row['bm_wartosc']];
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
			
			return $get_status;
		}

	}

?>
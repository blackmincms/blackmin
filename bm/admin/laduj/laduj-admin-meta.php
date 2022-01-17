<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy opsługi połączeń cms'a ładuje dane o stronie i je segreguje
	
	Black Min cms,
	
	#plik: 1.1
*/

	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
	
		mysqli_query($polaczenie, "SET CHARSET utf8");
		mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");		
			
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM `".$prefix_table."bm_metakontent_bm`")
		 ));
		{
		
			$ile = mysqli_num_rows($rezultat);

			for ($i = 1; $i <= $ile; $i++) 
			{
				$row = mysqli_fetch_assoc($rezultat);
				$id_usta = $row['id'];
				$nazwa_usta = $row['bm_nazwa'];
				$wartosc_usta = $row['bm_wartosc'];
				
				if($id_usta == "1"){
					$nick_admin_bm_nazwa = $nazwa_usta;
					$nick_admin_bm = $wartosc_usta ;
				}
				if($id_usta == "2"){
					$imie_admin_bm_nazwa = $nazwa_usta;
					$imie_admin_bm = $wartosc_usta ;
				}
				if($id_usta == "3"){
					$nazwisko_admin_bm_nazwa = $nazwa_usta;
					$nazwisko_admin_bm = $wartosc_usta ;
				}
				if($id_usta == "4"){
					$meta_bm_nazwa = $nazwa_usta;
					$meta_bm = $wartosc_usta ;
				}
				if($id_usta == "5"){
					$meta_kontakt_bm_nazwa = $nazwa_usta;
					$meta_kontakt_bm = $wartosc_usta ;
				}
				if($id_usta == "6"){
					$meil_admin_bm_nazwa = $nazwa_usta;
					$meil_admin_bm = $wartosc_usta ;
				}
				if($id_usta == "7"){
					$bm_strona_domomwa_nazwa = $nazwa_usta;
					$bm_strona_domomwa = $wartosc_usta ;
				}
				if($id_usta == "8"){
					$bm_dzienik_nazwa = $nazwa_usta;
					$bm_dzienik = $wartosc_usta ;
				}

				if($id_usta == "10"){
					$mail_admin_nazwa = $nazwa_usta;
					$mail_admin = $wartosc_usta ;
				}
			}			
			
		};				
		$polaczenie->close();
	}		
		
?>
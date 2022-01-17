<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy opsługi połączeń cms'a - ładuje dane o stronie i je segreguje
	
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
		sprintf("SELECT * FROM `".$prefix_table."bm_ustawienia_bm`")
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
					$url_serwera_bm_nazwa = $nazwa_usta;
					$url_serwera_bm =  $wartosc_usta ;
					$_SESSION['url_serwera_bm'] = $url_serwera_bm;
				}
				if($id_usta == "2"){
					$url_katologu_bm_nazwa = $nazwa_usta;
					$url_katologu_bm = $wartosc_usta ;
				}
				if($id_usta == "3"){
					$nazwa_strony_nazwa = $nazwa_usta;
					$nazwa_strony = $wartosc_usta ;
				}
				if($id_usta == "4"){
					$opis_strony_nazwa = $nazwa_usta;
					$opis_strony = $wartosc_usta ;
				}
				if($id_usta == "5"){
					$icon_ico_nazwa = $nazwa_usta;
					$icon_ico = $url_serwera_bm . $wartosc_usta ;
				}
				if($id_usta == "6"){
					$icon_png_nazwa = $nazwa_usta;
					$icon_png = $url_serwera_bm . $wartosc_usta ;
				}
				if($id_usta == "7"){
					$rejestracja_bm_nazwa = $nazwa_usta;
					$rejestracja_bm = $wartosc_usta ;
				}
				if($id_usta == "8"){
					$logowanie_bm_nazwa = $nazwa_usta;
					$logowanie_bm = $wartosc_usta ;
				}
				if($id_usta == "9"){
					$komentarze_bm_nazwa =$nazwa_usta;
					$komentarze_bm = $wartosc_usta ;
				}
				if($id_usta == "10"){
					$slowa_kluczowe_nazwa = $nazwa_usta;
					$slowa_kluczowe = $wartosc_usta ;
				}
				if($id_usta == "11"){
					$bm_loga_nazwa = $nazwa_usta;
					$bm_logo = $wartosc_usta ;
				}
				if($id_usta == "12"){
					$bm_banner_nazwa = $nazwa_usta;
					$bm_banner = $wartosc_usta ;
				}
			}			
			
		};				
		$polaczenie->close();
	}		
		
?>
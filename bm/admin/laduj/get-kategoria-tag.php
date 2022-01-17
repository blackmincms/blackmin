<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyciągania z bazy kategori i tagów 
	
	Black Min cms,
	
	#plik: 1.0
*/

	function get_KT($_KT){
		
		global $host, $db_user, $db_password, $db_name, $polaczenie, $rezultat, $date, $date2, $date3, $date4, $time, $time2,$prefix_table;
		
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
				sprintf("SELECT * FROM `".$prefix_table."bm_metaposty` WHERE `bm_KT` LIKE '".$_KT."'"))) {
					
					$ile = mysqli_num_rows($rezultat);
				
					for ($i = 1; $i <= $ile; $i++) 
					{
						
						
						$row = mysqli_fetch_assoc($rezultat);
						$id_KT = $row['id'];
						$nazwa_KT = $row['bm_nazwa'];
						$skr_nazwa_KT = $row['bm_skr_nazwa'];
						$opis_KT = $row['bm_opis'];
						$KT_KT = $row['bm_KT'];	
						
						if ($_KT == "kategoria"){
							echo '
								<option value="'.$skr_nazwa_KT.'">'.$nazwa_KT .' > '. $skr_nazwa_KT.'</option>
							';
						}
						
						if ($_KT == "tag"){
							echo "' $nazwa_KT ',";
						}	
				};			
					
				};	
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań póżniej!</span>';
		}		
		
	}

?>
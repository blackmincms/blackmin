<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy opsługi połączeń cms'a
	
	Black Min cms,
	
	#plik: 1.1
*/

	// depracet_file
	// przeiść na nowszą wersjię pliku
	// zaktulizować funkcję cookies

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
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
			echo $ile;

			for ($i = 1; $i <= $ile; $i++) 
			{
				
				
				$row = mysqli_fetch_assoc($rezultat);
				$id_usta = $row['id'];
				$nazwa_usta = $row['bm_nazwa'];
				$wartosc_usta = $row['bm_wartosc'];
				echo $id_usta;
				echo $nazwa_usta;
				echo $wartosc_usta;
				
				if($id_usta == "1"){
					$nazwa_usta = $row['bm_nazwa'];
				$wartosc_usta = $row['bm_wartosc'];
				}
			}			
			
		};				
		$polaczenie->close();
	}		
		
?>
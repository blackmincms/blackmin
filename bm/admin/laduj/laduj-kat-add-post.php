<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy opsługi połączeń cms'a - pobiera dane o kategoriach
	
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
		sprintf("SELECT * FROM `".$prefix_table."bm_metaposty` WHERE `bm_KT` LIKE 'kategoria' ORDER BY `id`ASC")
		 ))
		{
		
			$ile = mysqli_num_rows($rezultat);
			
			for ($i = 1; $i <= $ile; $i++) 
			{
				
				
				$row = mysqli_fetch_assoc($rezultat);
				$id_KT = $row['id'];
				$nazwa_KT = $row['bm_nazwa'];
				$skr_nazwa_KT = $row['bm_skr_nazwa'];
				$opis_KT = $row['bm_opis'];
				$KT_KT = $row['bm_KT'];	
				
				
	
				echo '
					<option value="'.$skr_nazwa_KT.'">'.$nazwa_KT .' > '. $skr_nazwa_KT.'</option>
				';
				
			};		
		};

		$polaczenie->close();
	}

?>
<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do aktulizacji statusu online użytkownika
	
	Black Min cms,
	
	#plik: 1.0
*/
				
	// wykonywanie akulizacji statusu użytkownika
	$id	= $_SESSION['id'];	
	// pobieranie aktualnej daty i godziny
	$datetime = date('Y.m.d H:i:s');
	$date = date('Y.m.d');
	$time = date('H:i:s');
			
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
				sprintf("UPDATE `".$prefix_table."bm_uzytkownicy` SET `online`='online', `ostatnio_aktywny`='$datetime' WHERE `id` = '$id'")
				 ))
				{
					//echo '<section class="tsr-alert tsr-alert-success"> Status został zmieniony poprawnie! </section>';
				};	

				if ($rezultat2 = $polaczenie->query(
				sprintf("SELECT * FROM `".$prefix_table."bm_uzytkownicy` WHERE `online` LIKE 'online'")
				 ))
				{
				
					$ile_online = mysqli_num_rows($rezultat2);
					
					for ($i = 0; $i < $ile_online; $i++) {
					
						$row2 = mysqli_fetch_assoc($rezultat2);
						$id_user_online = $row2['id'];
						$online = $row2['online'];
						$ostatnio_aktywny = $row2['ostatnio_aktywny'];
						
						$date_last = data_format($ostatnio_aktywny, "Y.m.d");
						$time_last = data_format($ostatnio_aktywny, "H:i:s");

						$sort_time = ( strtotime( $time )-600);
						$sort_time_user_online = ( strtotime( $time_last ));
						
						if($online === "online"){
							if($date_last == $date ){
								if($sort_time >= $sort_time_user_online){
									if ($rezultat3 = $polaczenie->query(
									sprintf("UPDATE `".$prefix_table."bm_uzytkownicy` SET `online`='ofline' WHERE `id` = '$id_user_online'")
									 ))
									{
										//echo '<section class="tsr-alert tsr-alert-success"> Status został zmieniony poprawnie! </section>';
									};										
								}
							}else{
								if ($rezultat4 = $polaczenie->query(
								sprintf("UPDATE `".$prefix_table."bm_uzytkownicy` SET `online`='ofline' WHERE `id` = '$id_user_online'")
								 ))
								{
									//echo '<section class="tsr-alert tsr-alert-success"> Status został zmieniony poprawnie! </section>';
								};									
							}
						}
						
					}
	
				};	
				
			$polaczenie->close();
		}
		
	}
	
	  
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań w innym terminie!</span>';
	}			
	
?>
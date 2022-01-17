<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do usuwania kategori tagu black mina
	
	Black Min cms,
	
	#plik: 1.1
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// sprawdzenia czy coś przyszło do pliku 
	// usuwanie wybranych postów po id posta
	// tworzenie odpowiedniego skryptu który schowa post żeby użytkownik wiedział że usunięcie się powiodło
	
	if(isset($_POST['delte_KT']))
	{
		$id_KT = $_POST['delte_KT'];
		
		$ile_deelete = count($id_KT);
		
		$d_delete_KT = $_POST['d_delete_KT'];
			
		
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
		
				for($i=0; $i < $ile_deelete; $i++)	{
		
					if ($polaczenie->query("DELETE FROM `".$prefix_table."bm_metaposty` WHERE `id` = '".htmlspecialchars($id_KT[$i])."'"))
					{
						if ($d_delete_KT == 1) {
							echo '
							<section class="tsr tsr-alert tsr-alert-success">
								Post został usunięty poprawnie!
							</section>
							';
						}
						
						echo '
						<script type="text/javascript">
							var delete_KT = [];
							var hiden_post = $("[data-id-post='."'".$id_KT[$i]."'".']");
								
							$(hiden_post).delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500);
						</script>
						';
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
				
				}

				
				$polaczenie->close();
			}
			
		}
		
          
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań w innym terminie!</span>';
		}		
		
	}	
	
?>
<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do usuwania użytkowników black min'a
	
	Black Min cms,
	
	#plik: 1.2
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";	
	
	require_once "../../../connect.php";
	
	// sprawdzenia czy coś przyszło do pliku 
	// usuwanie wybranych postów po id posta
	// tworzenie odpowiedniego skryptu który schowa post żeby użytkownik wiedział że usunięcie się powiodło
	
	if(isset($_POST['delte_post']))
	{
		$id_post = $_POST['delte_post'];
		
		$ile_deelete = count($id_post);
		
		$d_delete_post = $_POST['d_delete_post'];	
		
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
		
					if ($polaczenie->query("DELETE FROM `".$prefix_table."bm_uzytkownicy` WHERE `id` = '$id_post[$i]'"))
					{
						echo '
						<section class="tsr tsr-alert tsr-alert-success">
							Użytkownik został usunięty poprawnie!
						</section>
						';
							
						echo '
						<script type="text/javascript">
							var delete_post = [];
							var hiden_post = $("[data-id-post='."'".$id_post[$i]."'".']");
								
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
<?php

	if(!defined("bm_register_session")) {
		define("bm_register_session", true);
	}
	
	require_once("admin/black-min-sm.php");
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: logowanie.php');
		exit();
	}
	
	require_once "../connect.php";

	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		mysqli_query($polaczenie, "SET CHARSET utf8");
		mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM `".$prefix_table."bm_uzytkownicy` WHERE nick='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				
				if (password_verify($haslo, $wiersz['haslo']))
				{
					$_SESSION['zalogowany'] = true;
					$_SESSION['id'] = $wiersz['id'];
					$_SESSION['nick'] = $wiersz['nick'];
					$_SESSION['imie'] = $wiersz['imie'];
					$_SESSION['nazwisko'] = $wiersz['nazwisko'];
					$_SESSION['email'] = $wiersz['email'];
					$_SESSION['plec'] = $wiersz['plec'];
					$_SESSION['date_dolonczenia'] = $wiersz['date_dolonczenia'];
					$_SESSION['avatar'] = $wiersz['avatar'];
					$_SESSION['token'] = $wiersz['token'];
					$_SESSION['dostep'] = $wiersz['dostep'];
					$_SESSION['ranga'] = $wiersz['ranga'];
					$_SESSION['flaga'] = $wiersz['flaga'];
					$_SESSION['online'] = $wiersz['online'];
					$_SESSION['ostatnio_aktywny'] = $wiersz['ostatnio_aktywny'];
					$flaga = $wiersz['flaga'];
					
					$_SESSION['session_flag'] = $flaga;
					
					$user_t = "";
					
					unset($_SESSION['blad']);
					$rezultat->free_result();
					
					if($flaga >= 6){
						$user_t = "admin/admin-";
					}else{
						$user_t = "user/user-";
					}
					
					header('Location: '.$user_t.'panel.php');
					exit();
				}
				else 
				{
					$_SESSION['blad'] = '<span style="color:red" class="error" >Nieprawidłowy login lub hasło!</span>';
					header('Location: logowanie.php?blad');
				}
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red"  class="error" >Nieprawidłowy login lub hasło!</span>';
				header('Location: logowanie.php?blad');
				
			}
			
		}
		
		$polaczenie->close();
	}
	
?>
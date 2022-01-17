<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do opsługi sesii black mina
	
	#Black Min > Session Manager
	
	Black Min cms,
	
	#plik: 1.1
*/
	
	// tworzenie sesii bm o odpowiednjiej nazwie
	session_name("bm_sid");
	// otwieranie sesii black mina
	session_start();
	// pobieranie zmiennej globalnej
	global $ustawienia_bm;	
	// sprawdzanie czy użyć certyfikatu ssl przy generowaniu sesji blackmin'a
	if(isset($_SESSION['bm_ssl']) OR isset($ustawienia_bm) == 1){
		// ustawienie czasu trwania sesji i uprawnień do sesji bm
		setcookie(session_name(),session_id(),0, "/", "", true, true);	
	}else{
		// ustawienie czasu trwania sesji i uprawnień do sesji bm
		setcookie(session_name(),session_id(),0, "/", "");
	}
	
	// sprawdzanie czy sessia istnieje
	if (isset($_SESSION['zalogowany'])) {
		// ustawnienie aliasów do danych użytkownika
		$bm_user["id"] = $_SESSION['id'];
		$bm_user["nick"] = $_SESSION['nick'];
		$bm_user["name"] = $_SESSION['imie'];
		$bm_user["firstname"] = $_SESSION['imie'];
		$bm_user["first_name"] = $_SESSION['imie'];
		$bm_user["surname"] = $_SESSION['nazwisko'];
		$bm_user["lastname"] = $_SESSION['nazwisko'];
		$bm_user["last_name"] = $_SESSION['nazwisko'];
		$bm_user["sex"] = $_SESSION['plec'];
		$bm_user["date_of_joining"] = $_SESSION['date_dolonczenia'];
		$bm_user["joined"] = $_SESSION['date_dolonczenia'];
		$bm_user["avatar"] = $_SESSION['avatar'];
		$bm_user["access"] = $_SESSION['dostep'];
		$bm_user["flag"] = $_SESSION['flaga'];
		$bm_user["online"] = $_SESSION['online'];
		$bm_user["email"] = $_SESSION['email'];
		
		if($_SESSION['ranga'] == "właśćiciel"){
			$bm_user["rank"] = "owner";
		}else if($_SESSION['ranga'] == "administrator"){
			$bm_user["rank"] = "administrator";
		}else if($_SESSION['ranga'] == "moderator"){
			$bm_user["rank"] = "moderator";
		}else if($_SESSION['ranga'] == "redaktor"){
			$bm_user["rank"] = "editor";
		}else if($_SESSION['ranga'] == "współpracownik"){
			$bm_user["rank"] = "associate";
		}else if($_SESSION['ranga'] == "użytkownik"){
			$bm_user["rank"] = "user";
		}else{
			$bm_user["rank"] = "user";
		}
	}
	
?>
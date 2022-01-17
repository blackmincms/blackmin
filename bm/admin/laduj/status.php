<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do opsługi statusu  serwera back min i wyświetlanie ich
	
	Black Min cms,
	
	#plik: 1.2
*/
		
	function installation_admin_bm(){
		global $status_bm;
		return $status_bm["bm_installation_admin"];
	}

	function admin_mail_bm(){
		global $status_bm;
		return $status_bm["bm_admin_mail"];
	}

	function version_db_bm(){
		global $status_bm;
		return $status_bm["bm_version_db"];
	}
	
	function public_aupt_bm(){
		global $status_bm;
		return $status_bm["bm_public_aupt"];
	}
	
	function private_aupt_bm(){
		global $status_bm;
		return $status_bm["bm_private_aupt"];
	}
	
	function aupt_acces_bm(){
		global $status_bm;
		return $status_bm["bm_aupt_acces"];
	}

	function date_installation_bm(){
		global $status_bm;
		return $status_bm["bm_date_installation"];
	}

	function date_installation_blackmin(){
		global $status_bm;
		return $status_bm["bm_date_installation"];
	}

	function version_bm(){
		global $status_bm;
		return $status_bm["bm_version"];
	}

	function version_blackmin(){
		global $status_bm;
		return $status_bm["bm_version"];
	}

?>


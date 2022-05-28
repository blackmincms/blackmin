<?php	
/**
*	"Black Min" 
*	
*	For the full copyright and license information, please view the LICENSE
*	file that was distributed with this source code.
*
*	@package BlackMin
*	
*	#file: 2.0
*
*	This file is session user | admin panel
*/

	namespace BlackMin\Session;

	use BlackMin\Router\Url as URL;
	
	final class SM extends URL {

		public function start () {
			// tworzenie sesii bm o odpowiednjiej nazwie
			session_name("bm_sid");
			// otwieranie sesii black mina
			session_start();	
			// sprawdzanie czy użyć certyfikatu ssl przy generowaniu sesji blackmin'a
			if(URL::check_ssl()){
				// ustawienie czasu trwania sesji i uprawnień do sesji bm
				setcookie(session_name(),session_id(),0, "/", "", true, true);	
			}else{
				// ustawienie czasu trwania sesji i uprawnień do sesji bm
				setcookie(session_name(),session_id(),0, "/", "");
			}
		}

		public function stop ():bool {
			if (session_unset()) {
				return true;
			} else {
				return false;
			}
			
		}

		public function register () {
			if ((!$this->user_login()) && ($this->checkSession())) {
				if ($this->checkSession()) {
					if ($this->checkTimeOut() === false) {
						if ($this->stop()) {
							URL::goToLogin();
							exit();
						}else {
							URL::goToStart();
							exit();
						}
					}
				} else {
					URL::goToLogin();
					exit();
				}
			}
			
			// owner administrator moderator editor associate user
		}

		public function checkSession():bool {
			if (isset($_SESSION['zalogowany'])) {
				return true;
			}else{
				return false;
			}
		}

		protected function checkTimeOut ():bool {
			$time_now = time();
			$time_plus = $time_now - 900;
			if (isset($_SESSION["bm_user_active"])) {
				if ((is_int($_SESSION["bm_user_active"])) && ($_SESSION["bm_user_active"] <= $time_plus)) {
					return false;
				}else {
					$_SESSION["bm_user_active"] = $time_now;
					return true;
				}			
			}else{
				$_SESSION["bm_user_active"] = $time_now;
				return true;
			}
		}

		public function user_login():bool {
			if (($this->checkSession()) && (!isset($_SESSION["BM_USER_LOGIN"]))) {
				if (isset($_SESSION["BM_USER_LOGIN"])) {
					unset($_SESSION["BM_USER_LOGIN"]);
				}
				return false;
			} else {
				if (!isset($_SESSION["BM_USER_LOGIN"])) {
					$_SESSION["BM_USER_LOGIN"] = true;
				}
				return true;
			}
			
		}

	}
	
?>
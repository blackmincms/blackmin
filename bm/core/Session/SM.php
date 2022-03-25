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
			if (SM::checkSession()) {
				if (SM::checkTimeOut() === false) {

				}
			} else {
				return false;
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

		protected function checkTimeOut ():bool|null {
			$t = time();
			if (isset($_SESSION["bm_user_active"])) {
				if ((is_int($_SESSION["bm_user_active"])) && ($_SESSION["bm_user_active"] >= $t)) {
					return false;
				}else if ((is_int($_SESSION["bm_user_active"])) && ($_SESSION["bm_user_active"] <=  $t)) {
					$_SESSION["bm_user_active"] = $t;
					return true;
				} else {
					return null;
				}
				
			}else{
				$_SESSION["bm_user_active"] = $t;
				return true;
			}
		}

	}
	
?>
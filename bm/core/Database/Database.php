<?php	
/**
*	"Black Min" 
*	
*	For the full copyright and license information, please view the LICENSE
*	file that was distributed with this source code.
*
*	@package BlackMin
*	
*	#plik: 2.0
*
*	This file is database functionalitys
*/

	declare(strict_types=1);

	namespace BlackMin\Database;

	use Exception;
	use Mysqli;

	// główna nazwa klasy
	class Database {
		// zmienne przechowywujące konfiguraje db-g
		
		/**
		 * 	@var boolen
		 */
		protected $db_error_developers = false; // zmienna pokazujące dokładne błędy mysql
		/**
		 * 	@var boolen
		 */		
		protected $db_error = true; // zmienna pokazująca podstawowe błędy 
		/**
		 * 	@var boolen
		 */		
		protected $db_save_query = false; // zmienna zapamiętująca sql
		/**
		 * 	@var boolen
		 */		
		protected $set_valid = false;
		
		// zmienne przechowywujące konfiguraje db MySql
		/**
		 * 	@var string
		 */
		protected $host = "localhost";
		/**
		 * 	@var string
		 */
		protected $db_user = "root";
		/**
		 * 	@var string
		 */
		protected $db_password = "";
		/**
		 * 	@var string
		 */		
		protected $db_name = "blackmin";
		/**
		 * 	@var string
		 */		
		protected $db_prefix = null;
		
		protected $dbbm_mysql = null;
		
		function __construct($host = null, $db_user = null, $db_password = null, $db_name = null, $db_prefix = null){
			// sprawdzanie czy nie zmieniono ustawień do db
			if($host == null){
				// sprawdzanie czy istnieje istnieje już zajncludowany plik konfiguracyiny
				// jeżeli zmienna jest pusta pobieranie zmiennych z pliku
				if( defined("HOST")){
					$this->host = HOST;
					$this->db_user =  DB_USER;
					$this->db_password =  DB_PASSWORD;
					$this->db_name =  DB_NAME;	
					$this->db_prefix =  PREFIX_TABLE;	
				}
			}else{
				// ustawienie parametrów db podanych przez dev
				$this->host = $host;
				$this->db_user = $db_user;
				$this->db_password = $db_password;			
				$this->db_name = $db_name;
				$this->db_prefix = $db_prefix;	
			}	

			// sprawdzanie czy został już otwarte połączenie
			if($this->dbbm_mysql === null){ 
			// otwieranie nowego połączenia z bazą blackmin
				$this->dbbm_mysql = new mysqli($this->host, $this->db_user, $this->db_password, $this->db_name);
			}
		}
		
		// zmiana danych do bazy danych mysql (w locie)
		public function db_change($host, $db_user, $db_password, $db_name, $db_prefix){
			$this->host = $host;
			$this->db_user = $db_user;
			$this->db_password = $db_password;
			$this->db_name = $db_name;
			$this->db_prefix = $db_prefix;
		} 
		// funckcja pokazująca zmienne do połączenia z bazą danych
		public function info() {
			// tablica przechowywuję dane do pokazania
			$t = [
				"host" => $this->host,
				"user" => $this->db_user,
				"password" => $this->db_password,
				"name" => $this->db_name,
				"prefix" => $this->db_prefix,
			];
			
			return $t;
		} 
		// funckcja pokazująca inforamacjie o bazie danych
		public static function db_info(){
			// SHOW VARIABLES;
		}
		// funkcja pokazująca wszystko bazydanych
		public static function show_databases(){
			// SHOW DATABASES;
		}
		
		// funkcja odpowiada za wyświetlanie błędów
		public function db_error(bool $t = false):bool {
			// sprawdzanie czy dane są typu bool
			if(is_bool($t)){			
				$this->db_error = $t;
				return true;
			}else{
				return false;
			}
		}
		// funkcja odpowiedzialna za pokazywanie błędów deweloperskich
		public function db_error_developers(bool $t = false):bool {
			// sprawdzanie czy dane są typu bool
			if(is_bool($t)){
				$this->db_error_developers = $t;
				return true;
			}else{
				return false;
			}
		}
		
		// funkcjia zamieniająca prefix dev na prefix blackmin db
		private function prefix_db(string $t):string {
			// tablica przechowywująca dane o prefixach dev
			$d = [
				"_prefix_",
				"__prefix__",
				"__prefix",
				"prefix__",
				"|prefix|",
				"\\prefix\\"
			];
			// zastępienie prefixów dev na prefix db bm i zwracanie wyniku
			return str_replace($d, $this->db_prefix, $t);
		}
		
		// funckcjia zmieniająca automatyczne parsowanie danych
		public function set_valid(bool $t):bool {
			// sprawdzanie czy dane są typu bool
			if(is_bool($t)){
				// aktulizowanie danych
				$this->set_valid = $t;
			}else{
				return false;
			}
		}
		
		// funkcja zamieniająca enjie tagów na bespieczne odpowiedniki
		public function valid(string $string):string {
			// parsowanie danych
			$data = htmlentities($string, ENT_QUOTES, "UTF-8");
			$out = htmlspecialchars($data, ENT_QUOTES, "UTF-8");
			// zwracanie danych
			return $out;
		}
		
		// funkcja zamieniająca encjie tagów na na normalny tekst
		public function unvalid(string $string):string {
			// parsowanie danych
			$data = htmlspecialchars_decode($string, ENT_QUOTES);
			$out = html_entity_decode($data, ENT_QUOTES, "UTF-8");
			// zwracanie danych
			return $out;
		}

		// funkcja usuwająca array według merge
		public function array_flatten(array $array):array {

		   $return = [];
		   foreach ($array as $key => $value) {
			   if (is_array($value)){
				   $return = array_merge($return, Database::array_flatten($value));
			   }else{
				   $return[$key] = $value;
				}
		   }
		   return $return;

		}
		// funkcja super unique redukująca dane według głownego klucza
		public function super_unique($array,$key, $s = false)
		{
			// zmienna przechowywująca przetworzone dane
			$r = null;
			// pobieranie głownego klucza z tablicy
			$k = array_column($array, $key);
			// filtrowanie danych
			$k = array_unique($k);
			// sprawdzanie czy dane zwrucić w tablicy czy w stringu
			if($s === false){
				return $k;
			}elseif($s === true){
				for($i = 0; $i < count($k); $i++){
					if($i === 0){
						$r .= $k[$i];
					}else{
						$r .= "," . $k[$i];
					}
				} 
				// zwracanie wyniku
				return $r;
			}else{
				return false;
			}
		}

		
		// funkcja parsująca dane z podanego wzorca przeprowadzająca działania po tablicy
		public function parse($q, $k = null){
			// $q = kwerenda, $k = klucz w tablicy
			
			// zmienna przehowywująca gotowy wynik
			$r = null;
			// sprawdzanie czy istnieje klucz zawierający liczbę rekordów tablicy
			(array_key_exists("num_rows", $q) ? array_shift($q) : "");
			// sprawdzanie czy dane są poprawne typy danych
			if(is_array($q)){
				for($i = 0; $i < count($q); $i++){
					if ($k === null) {
						// sprawdzanie czy dany klucz istnieje
						if (is_string($q[$i])){
							// sprawdzanie czy element jest ostani
							if(0 == $i){
								$r .= $q[$i];
							}else{
								$r .= "," . $q[$i];
							}
						}else{
							$r = false;
							break;
						}
					}else{
						if (is_string($k)) {
							// sprawdzanie czy dany klucz istnieje
							if(array_key_exists($k, $q[$i])){
								// sprawdzanie czy element jest ostani
								if(0 == $i){
									$r .= $q[$i][$k];
								}else{
									$r .= "," . $q[$i][$k];
								}
							}else{
								$r = false;
								break;
							}
						} else {
							$r = false;
							break;
						}
					}
				}
			}else{
				return false;
			}
			// zwracanie wyniku
			return $r;
		}
		
		public function replace_collumn($q, $k, $rep, $id = "id", $sz = "name", $e = false){
			// przechowywanie zmiennych
			$r = null;
			// sprawdzanie typów
			if(is_array($q) && is_string($k) && is_array($rep)){
				$r = $q;
				// przechowywanie wyniku
				for($i = 0; $i < count($q); $i++){
					// sprawdzanie czy klucz isntnieje
					if(array_key_exists($k, $q[$i])){
						$s = array_search($q[$i][$k], array_column($rep, $id));
						if(is_int($s)){
							$r[$i][$k] = $rep[$s][$sz];
						}else{
							// sprawdzenie czy zgłosić błąd 
							if($e === true){
								return false;
								break;
							}
						}
					}else{
						$r = false;
						break;
					}
				}
			}else{
				return false;
			}
			// zwracanie wyniku
			return  $r;			
		}

		public function super_array_sort($array, $on, $order=SORT_ASC){

		$new_array = [];
		$sortable_array = [];

			if (count($array) > 0) {
				foreach ($array as $k => $v) {
					if (is_array($v)) {
						foreach ($v as $k2 => $v2) {
							if ($k2 == $on) {
								$sortable_array[$k] = $v2;
							}
						}
					} else {
						$sortable_array[$k] = $v;
					}
				}

				switch ($order) {
					case SORT_ASC:
						asort($sortable_array);
						break;
					case SORT_DESC:
						arsort($sortable_array);
						break;
				}

				foreach ($sortable_array as $k => $v) {
					$new_array[$k] = $array[$k];
				}
			}

			return $new_array;
		}
		
		// this function is serialize data
		public function serialize(mixed $data):string|bool {
			// sprawdzanie typów
			if(is_array($data)){
				// zwracanie wyniku
				return serialize($data);
			}else{
				return false;
			}
		}

		// this function is unserialize data
		public function unserialize($data):array|string|bool {
			// sprawdzanie typów
			if(is_string($data)){
				// zwracanie wyniku
				return unserialize($data);
			}else{
				return false;
			}
		}
		
		// pierwsza nazwa zapytania query(kwerenda) mysql
		public function query($query, $isjson = false, $data_output = null){
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			
			try 
			{
				if ($this->dbbm_mysql->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_error());
				}
				else
				{		
					mysqli_query($this->dbbm_mysql, "SET CHARSET utf8");
					mysqli_query($this->dbbm_mysql, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");		

					// sprawdzanie czy dane trzeba sparsować 
					if($this->set_valid == true){
						// parsowanie danych
						$t = htmlentities(Database::prefix_db($query), ENT_QUOTES, "UTF-8");
						$t = htmlspecialchars($t, ENT_QUOTES, "UTF-8");
					}else{
						$t = Database::prefix_db($query);
					}				
					
					if ($rezultat = $this->dbbm_mysql->query(sprintf($t))) {
						
						$ile = mysqli_num_rows($rezultat);
						
						// zmienna zawiera dane do zwrócenia
						$tablica_z_danymi = [];
						$tablica_z_danymi_temp = [];
						
						// dodawanie do tablicy ilośći załadowanych rekordów
						$tablica_z_danymi["num_rows"] = $ile;
						
						// sprawdzanie czy dane nie są puste
						if($ile != 0){
							for($i = 0; $i < $ile; $i++){
							
								$row = mysqli_fetch_assoc($rezultat);
								
								// sprawdzanie czy czeba zamienić tablice (asosiacyinom) innymi nazwami
								if($data_output == null){
									// dodawanie danych do głównej tablicy zwrotnej
									array_push($tablica_z_danymi, $row);							
								}else{							
									// pozyskiwanie kluczy z tablicy(asosiacyinej)
									$tablica_klucze = array_keys($row);
									// pętla
									for($ii = 0; $ii < count($tablica_klucze); $ii++){

										// dodawanie danych do bufora
										$tablica_z_danymi_temp[$data_output[$ii]] = $row[$tablica_klucze[$ii]];
									}
									
									// dodawanie danych do głównej tablicy zwrotnej
									// dane pochodzą z bufora
									array_push($tablica_z_danymi, $tablica_z_danymi_temp);
								}
							}
							
							//var_dump($tablica_z_danymi);
							if($isjson == true){
								return json_encode($tablica_z_danymi);
							}else{
								return $tablica_z_danymi;
							}
						}else{
							if($isjson == true){
								return json_encode($tablica_z_danymi);
							}else{
								return $tablica_z_danymi;
							}
						}
						
					};	
				}
				
			}
			catch(Exception $e)
			{
				// sprawdzanie czy pokazywanie błędów jest włączone
				if($this->db_error == true){
					echo '<section class="tsr tsr-alert tsr-alert-error"> Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań później! </section>';
				}else{
					// zwracanie udanego wyniku
					// sprawdzanie czy wynik odesłać w json
					if($isjson == true){
						return json_encode(false);
					}else{
						return false;
					}
				}
				// sprawdzanie czy pokazywanie błędów developerskich jest włączone
				if($this->db_error_developers == true){
					echo '<br />Informacja developerska: '.$e;
				}
			}
		}

		// druga nazwa zapytania query(kwerenda) mysql
		public function query2($query, $isjson = false, $data_output = null){
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			
			try 
			{
				if ($this->dbbm_mysql->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_error());
				}
				else
				{		
					mysqli_query($this->dbbm_mysql, "SET CHARSET utf8");
					mysqli_query($this->dbbm_mysql, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");		

					// sprawdzanie czy dane trzeba sparsować 
					if($this->set_valid == true){
						// parsowanie danych
						$t = htmlentities(Database::prefix_db($query), ENT_QUOTES, "UTF-8");
						$t = htmlspecialchars($t, ENT_QUOTES, "UTF-8");
					}else{
						$t = Database::prefix_db($query);
					}						
					
					if ($rezultat = $this->dbbm_mysql->query($t)) {
						
						$ile = mysqli_num_rows($rezultat);
						
						// zmienna zawiera dane do zwrócenia
						$tablica_z_danymi = [];
						$tablica_z_danymi_temp = [];
						
						// dodawanie do tablicy ilośći załadowanych rekordów
						$tablica_z_danymi["num_rows"] = $ile;
						
						// sprawdzanie czy dane nie są puste
						if($ile != 0){
							for($i = 0; $i < $ile; $i++){
							
								$row = mysqli_fetch_assoc($rezultat);
								
								// sprawdzanie czy czeba zamienić tablice (asosiacyinom) innymi nazwami
								if($data_output == null){
									// dodawanie danych do głównej tablicy zwrotnej
									array_push($tablica_z_danymi, $row);							
								}else{							
									// pozyskiwanie kluczy z tablicy(asosiacyinej)
									$tablica_klucze = array_keys($row);
									// pętla
									for($ii = 0; $ii < count($tablica_klucze); $ii++){

										// dodawanie danych do bufora
										$tablica_z_danymi_temp[$data_output[$ii]] = $row[$tablica_klucze[$ii]];
									}
									
									// dodawanie danych do głównej tablicy zwrotnej
									// dane pochodzą z bufora
									array_push($tablica_z_danymi, $tablica_z_danymi_temp);
								}
							}
							
							//var_dump($tablica_z_danymi);
							if($isjson == true){
								return json_encode($tablica_z_danymi);
							}else{
								return $tablica_z_danymi;
							}
						}else{
							if($isjson == true){
								return json_encode($tablica_z_danymi);
							}else{
								return $tablica_z_danymi;
							}
						}
						
					};	
				}
				
			}
			catch(\Exception $e)
			{
				// sprawdzanie czy pokazywanie błędów jest włączone
				if($this->db_error == true){
					echo '<section class="tsr tsr-alert tsr-alert-error"> Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań później! </section>';
				}else{
					// zwracanie udanego wyniku
					// sprawdzanie czy wynik odesłać w json
					if($isjson == true){
						return json_encode(false);
					}else{
						return false;
					}
				}
				// sprawdzanie czy pokazywanie błędów developerskich jest włączone
				if($this->db_error_developers == true){
					echo '<br />Informacja developerska: '.$e;
				}
			}
		}
		
		// pierwsza nazwa zapytania query(kwerenda) mysql
		// funkcja dodajaca rekordy do bazy danych
		public function insert($query, $isjson = false, $message = null){
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			
			try 
			{
				if ($this->dbbm_mysql->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_error());
				}
				else
				{		
					mysqli_query($this->dbbm_mysql, "SET CHARSET utf8");
					mysqli_query($this->dbbm_mysql, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");	

					// sprawdzanie czy dane trzeba sparsować 
					if($this->set_valid == true){
						// parsowanie danych
						$t = htmlentities(Database::prefix_db($query), ENT_QUOTES, "UTF-8");
						$t = htmlspecialchars($t, ENT_QUOTES, "UTF-8");
					}else{
						$t = Database::prefix_db($query);
					}
					
					if ($this->dbbm_mysql->query(sprintf($t))) {
						
						// zwracanie udanego wyniku
						if($isjson == true){
							// sprawdzanie czy zwrucić wiadomość po sukcesie
							if($message != null AND is_string($message)){
								return json_encode($message);
							}else{
								return json_encode(true);
							}							
						}else{
							// sprawdzanie czy zwrucić wiadomość po sukcesie
							if($message != null AND is_string($message)){
								return $message;
							}else{
								return true;
							}
						}
					}else{
						throw new Exception($this->dbbm_mysql->error);
					}
				}
				
			}
			catch(Exception $e){
				// sprawdzanie czy pokazywanie błędów jest włączone
				if($this->db_error == true){
					echo '<section class="tsr tsr-alert tsr-alert-error"> Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań później! </section>';
				}else{
					// zwracanie udanego wyniku
					// sprawdzanie czy wynik odesłać w json
					if($isjson == true){
						return json_encode(false);
					}else{
						return false;
					}
				}
				// sprawdzanie czy pokazywanie błędów developerskich jest włączone
				if($this->db_error_developers == true){
					echo '<br />Informacja developerska: '.$e;
				}
			}
		}		

		// pierwsza nazwa zapytania query(kwerenda) mysql
		// funkcja aktualizuje rekordy bazy danych
		public function update($query, $isjson = false, $message = null){
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			
			try 
			{
				if ($this->dbbm_mysql->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_error());
				}
				else
				{		
					mysqli_query($this->dbbm_mysql, "SET CHARSET utf8");
					mysqli_query($this->dbbm_mysql, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");		
					
					// sprawdzanie czy dane trzeba sparsować 
					if($this->set_valid == true){
						// parsowanie danych
						$t = htmlentities(Database::prefix_db($query), ENT_QUOTES, "UTF-8");
						$t = htmlspecialchars($t, ENT_QUOTES, "UTF-8");
					}else{
						$t = Database::prefix_db($query);
					}
					
					if ($this->dbbm_mysql->query(sprintf($t))) {
						
						// zwracanie udanego wyniku
						if($isjson == true){
							// sprawdzanie czy zwrucić wiadomość po sukcesie
							if($message != null AND is_string($message)){
								return json_encode($message);
							}else{
								return json_encode(true);
							}							
						}else{
							// sprawdzanie czy zwrucić wiadomość po sukcesie
							if($message != null AND is_string($message)){
								return $message;
							}else{
								return true;
							}
						}
					}else{
						throw new Exception($this->dbbm_mysql->error);
					}
				}
				
			}
			catch(Exception $e){
				// sprawdzanie czy pokazywanie błędów jest włączone
				if($this->db_error == true){
					echo '<section class="tsr tsr-alert tsr-alert-error"> Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań później! </section>';
				}else{
					// zwracanie udanego wyniku
					// sprawdzanie czy wynik odesłać w json
					if($isjson == true){
						return json_encode(false);
					}else{
						return false;
					}
				}
				// sprawdzanie czy pokazywanie błędów developerskich jest włączone
				if($this->db_error_developers == true){
					echo '<br />Informacja developerska: '.$e;
				}
			}
		}

		// pierwsza nazwa zapytania query(kwerenda) mysql
		// funkcja usuwająca rekordy z bazy danych
		public function delete($query, $isjson = false, $message = null){
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			
			try 
			{
				if ($this->dbbm_mysql->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_error());
				}
				else
				{		
					mysqli_query($this->dbbm_mysql, "SET CHARSET utf8");
					mysqli_query($this->dbbm_mysql, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");		
					
					// sprawdzanie czy dane trzeba sparsować 
					if($this->set_valid == true){
						// parsowanie danych
						$t = htmlentities(Database::prefix_db($query), ENT_QUOTES, "UTF-8");
						$t = htmlspecialchars($t, ENT_QUOTES, "UTF-8");
					}else{
						$t = Database::prefix_db($query);
					}
					
					if ($this->dbbm_mysql->query(sprintf($t))) {
						
						// zwracanie udanego wyniku
						if($isjson == true){
							// sprawdzanie czy zwrucić wiadomość po sukcesie
							if($message != null AND is_string($message)){
								return json_encode($message);
							}else{
								return json_encode(true);
							}							
						}else{
							// sprawdzanie czy zwrucić wiadomość po sukcesie
							if($message != null AND is_string($message)){
								return $message;
							}else{
								return true;
							}
						}
					}else{
						throw new Exception($this->dbbm_mysql->error);
					}
				}
				
			}
			catch(Exception $e){
				// sprawdzanie czy pokazywanie błędów jest włączone
				if($this->db_error == true){
					echo '<section class="tsr tsr-alert tsr-alert-error"> Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań później! </section>';
				}else{
					// zwracanie udanego wyniku
					// sprawdzanie czy wynik odesłać w json
					if($isjson == true){
						return json_encode(false);
					}else{
						return false;
					}
				}
				// sprawdzanie czy pokazywanie błędów developerskich jest włączone
				if($this->db_error_developers == true){
					echo '<br />Informacja developerska: '.$e;
				}
			}
		}	
		
		// funckcja zamykająca połączenie z bazą danych
		function __destruct(){
			// sprawdzanie czy został już otwarte połączenie
			if($this->dbbm_mysql !== null){ 
			// otwieranie nowego połączenia z bazą blackmin
				$this->dbbm_mysql->close();
			}			
		}
	}
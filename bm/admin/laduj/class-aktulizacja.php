<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do pobrania informacji o dostęnych aktulizacjach
	
	load informacji o aktulizacjach
	
	Black Min cms,
	
	#plik: 1.1
*/

	class blackmin_aktulizacja{
		
		// ustawianie zmienych o pobranych danych o aktulizacji
		// black min
		private $blackmin = [];
		
		// zmiena przechowywująca dane o plikach do aktulizacji black min'a/aktulizacja/
		private $wszystkie_pliki = [];
		
		public function get_info_blackmin($host, $blackmin, $db, $aupt_private){
			$blackmin_shem = [
				"host"         => $host,
				"blackmin"     => $blackmin,
				"db"           => $db,
				"aupt_private" => $aupt_private,
			];			
			
			array_push($this->blackmin, $blackmin_shem);
		}
		
		// potwierdzanie dostępnej aktulizacji black mina
		private function check_aktulizacje_rdzenia_bm(){
			
			// informacjia o hośćie
			$host_bm = $_SERVER['HTTP_HOST'];

			// kodowanie informacji do wysłania
			$check = json_encode($this->blackmin);
			$check = urlencode($check); 
			// wysyłanie kluczy do sprawdzenia
			$rezult = @file_get_contents("https://blackmin.timonix.pl/blackmin/sprawdz/sprawdz_aktulizacjie_bm.php?h=$host_bm&a=$check");
			// sprawdzanie czy połączenie z serwerem zostało zrealizowane
			if($rezult == true){
				$rezult = urldecode($rezult);
				return json_decode($rezult, true);
			}else{
				return "false";
			}
			
		}
		
		// zmiena potwierdzająca poprawność aktulizacji db
		protected $spr_pop_query = "0";

		// funkcjia aktulizująca bazę danych mysql
		private function aktulizuj_baze_danych_black_min($sql){
			
			// inicowanie klasy do aktulizacji bazy danych
			$db_bm = new db_bm;
			
			// pobieranie dancyh do tablicy po ( ; )
			$aktulizacja_db = explode(";", $sql);
			
			// zliczanie tabel do zaktulizowania db
			$aktulizacja_db_zlicz = count($aktulizacja_db);
			$aktulizacja_db_zlicz = $aktulizacja_db_zlicz-1;
		
			// pętla powtarzająca aktulizacjie poszczególnych tabel #noob_gas
			for($i = 1; $i < $aktulizacja_db_zlicz; $i++){									
					
				$db_bm->db_error_developers(true);
				// aktulizowanie bazy danych black min'a
				if($db_bm->update($aktulizacja_db[$i], false, "success") === "success"){
					
					// dodawanie jednego punktu do walidacji
					$this->spr_pop_query++; 
					
				}						
			}
			
			// sprawdzanie poprawnośći aktulizowanych danych
			if($this->spr_pop_query != $aktulizacja_db_zlicz-1){
				return false;
			}else{
				return true;
			}
		}

		// funkcjia na aktulizowanie bazy danych MySql (blackmin)
		public function aktulizacja_db_bm($dv){
			
			if (blackmin_aktulizacja::aktulizuj_baze_danych_black_min($dv) !== TRUE) {
				// zwracanie błędu aktulizacjią black mina
				return "error";
				exit();
			}else{
				// zwracanie potwierdzenia zaktulizowanie bazy danych mysql 
				return "success";
			}
		}		
		
		// pobieranie informacji o aktulizacji blackmin 
		// get update blackmin
		public function get_aktulizacjia_blackmin_info(){
			$blackmin_return = blackmin_aktulizacja::check_aktulizacje_rdzenia_bm();
			
			$blackmin_return_zlciz = count($blackmin_return);
			
			if($blackmin_return != "false"){
				if($blackmin_return_zlciz == 0){
					echo '
					<section class="tsr-alert tsr-alert-error">
						Błąd połączenia z serwerem!
					</section>
					';	
				}else{
					for($i=0;$i < $blackmin_return_zlciz; $i++){
						
						// sprawdzanie czy jest błąd krytyczny i wyświetlanie go
						if($blackmin_return[$i]['update_info'] == "ERROR_UPDATE_NONE"){
							echo '
							<section class="tsr-alert tsr-alert-error">
								ERROR_UPDATE_NONE - Error! błąd połączenia z serwerem aktualizacyjnym!
							</section>
							';								
						}else{
							// sprawdzanie czy jest błąd krytyczny i wyświetlanie go
							if($blackmin_return[$i]['update_info'] == "ERROR_UPDATE_BRAK_DOSTEPU"){
								echo '
								<section class="tsr-alert tsr-alert-error">
									ERROR_UPDATE_BRAK_DOSTEPU - Wygląda na to że nie masz dostępu do usługi aktulizacyjnej black mina!
								</section>
								';								
							}else{
								// sprawdzanie czy jest błąd krytyczny i wyświetlanie go
								if($blackmin_return[$i]['update_info'] == "ERROR_BLACKMIN_UPDATE_INFO_NIE_ZNANA_WERSJA_BLACKMINA"){
									echo '
									<section class="tsr-alert tsr-alert-error">
										ERROR_BLACKMIN_UPDATE_INFO_NIE_ZNANA_WERSJA_BLACKMINA - Error Nie znana wersjia black mina!
									</section>
									';								
									exit();
								}else{
									// sprawdzanie czy jest błąd krytyczny i wyświetlanie go
									if($blackmin_return[$i]['update_info'] == "BLACKMIN_UPDATE_INFO_TO_SAMO"){
										echo '
										<section class="tsr-alert tsr-alert-info">
											Masz aktualną wersję black mina!
										</section>
										';								

									}else{
										// sprawdzanie czy jest błąd krytyczny i wyświetlanie go
										if($blackmin_return[$i]['update_info'] == "BLACKMIN_UPDATE_INFO_SUCCESS"){
											
											echo '
											<section class="tsr-alert tsr-alert-success">
												Jest dostępna nowa wersjia black mina: V.'. $blackmin_return[$i]['blackmin'] .' i wersja bazy danych V.'. $blackmin_return[$i]['db'] .' wydana: '. $blackmin_return[$i]['data_opublikowania'].'
											</section>
											';	
											echo'

												<script type="text/javascript">
													
													$(".sprawdz-update-blackmin").find("a").text("Pobierz Nową wersję!").attr("href", "admin-aktulizacja.php?sp=aktulizacja_blackmina");
													
												</script>

											';
											
											// tworzenie zmienej sesyinej do przechowyania danych o nowej wesji do pobrania
											$_SESSION['black_min_update'] = $blackmin_return[$i]['url_pobrania'];
											$bm_http_title = explode("/", $blackmin_return[$i]['url_pobrania']);
											$_SESSION['black_min_update_tile'] = $bm_http_title[6];	
											$_SESSION['black_min_update_title_folder'] = $blackmin_return[$i]['blackmin'];											
											
										}									
									}							
								}																	
							}							
						}
					}
				}			
						
			}else{
				// jeżeli jest napotkany jakiś błąd z przesyłem lub serwerem wysyłamy komunikat   
				echo '
				<section class="tsr-alert tsr-alert-error">
					Błąd połączenia z serwerem!
				</section>
				';				
			} 
			
		}

		private function update_blackmin_db(){
			// funkcjia do aktulizowania bazy danych sql
		}
		
		public function update_blackmin(){
			// tworzenie folderu aktulizacji black min'a
			@mkdir("../../a/aktulizacja/aktulizowanie_black_mina", 0777);
			@chmod("./../a/aktulizacja/aktulizowanie_black_mina", 0777);			
			
			// pobieranie nowej wesji blackmina na serwer
			if(copy($_SESSION['black_min_update'], "../../a/aktulizacja/".$_SESSION['black_min_update_tile'])){
				// ustawianie poprawnośći przesłania pliku
				echo'

					<script type="text/javascript">
						
						$(".blackmin-pobierz-nowa-wersjie").text("Pobieranie Zostało Zakończone!").removeClass("tsr-alert-info").addClass("tsr-alert-success");
						
					</script>

				';	

				// ustawianie zmienych do nowego path'a black min'a (nowej wersji)
				$aktulizacja_path = realpath('../../a/aktulizacja/'.$_SESSION['black_min_update_tile']);
				// ustawianie zmienej do ścieżki zapisu zdekompresowanego pliku
				$aktulizacja_path_info = realpath("../../a/aktulizacja/aktulizowanie_black_mina");
				// ustawianie zmienej do ścieżki zdekompresowanego pliku
				$aktulizacja_path_info_sciezka = realpath("../../a/aktulizacja/aktulizowanie_black_mina/V.".$_SESSION['black_min_update_title_folder']);
				// ustawianie zmienej do głównej ścieżki black mina do zaktulizowania 
				$aktulizacja_sciezka = realpath("../../");
				
				// inicowanie klasy do wypakowywaniu plików zip
				$zip_decompresed = new xray_zip_bm;
				// rozpakowanie pliku
				if($zip_decompresed->unzip($aktulizacja_path, $aktulizacja_path_info) === "success"){
					// pokazwyanie komunikatu o poprawnośći rozpakowania danych
					echo '
					<section class="tsr-alert tsr-alert-success">
						Rozpakowano Pliki bm Poprawnie!
					</section>
					';	
					
					usleep(250);
					
					// pobieranie pliku z danymi sql do zaktulizowania bazt danych black min'a // global security information data 
					$pobierz_bm_blacmin = @file_get_contents("../../a/aktulizacja/aktulizowanie_black_mina/V.".$_SESSION['black_min_update_title_folder']."/db/aktulizacja_blacmin_db.sql");
					
					// sprawdzanie czy plik sql istnieje
					if ($pobierz_bm_blacmin === false) {
						// pokazywanbie komunikatu o błędzie w aktulizowanie bazy danych black min'a
						echo '
						<section class="tsr-alert tsr-alert-error">
							Błąd pod czas aktulizowania bazy danych bm!.
						</section>
						';	
						exit();
					}
					
					// aktulizowanie bazy danych black min'a
					if(blackmin_aktulizacja::aktulizacja_db_bm($pobierz_bm_blacmin) === "success"){
						// pokazwyanie komunikatu o poprawnośći rozpakowania danych
						echo '
						<section class="tsr-alert tsr-alert-success">
							Aktulizacja Bazy Danych Black Mina Powiodła Się!
						</section>
						';	
						
						// aktulizowanie black min'a
						if($zip_decompresed->unzip($aktulizacja_path, $aktulizacja_sciezka) === "success"){
							// pokazwyanie komunikatu o poprawnośći rozpakowania danych
							echo '
							<section class="tsr-alert tsr-alert-success">
								Aktulizacja Black Mina Powiodła Się!
							</section>
							';	
							
							// funkcjia do usuwania plików i folderów w danej lokalizacji
							function removeDir($path) {
								$dir = new DirectoryIterator($path);
								foreach ($dir as $fileinfo) {
									if ($fileinfo->isFile() || $fileinfo->isLink()) {
										unlink($fileinfo->getPathName());
									}elseif(!$fileinfo->isDot() && $fileinfo->isDir()) {
										removeDir($fileinfo->getPathName());
									}
								}
								rmdir($path);
							}
							
							// usuwanie folderu db z aktulizacji plików bm
							@removeDir("../../V.".$_SESSION['black_min_update_title_folder'] . "/db");
							
							if (is_Dir("../../V.".$_SESSION['black_min_update_title_folder'] . "/db")) {
								echo '
									<section class="tsr-alert tsr-alert-error">
										Błąd pod czas aktulizowania bm i usuwaniu pliku db!
									</section>
								';	
								exit();
							}
							
							// funkcja kopiująca cały zawartość folderu
							function custom_copy($src, $dst) { 
							  
								// open the source directory
								$dir = opendir($src); 
							  
								if(!is_dir($dst)) {
									// Make the destination directory if not exist
									@mkdir($dst); 
								}
							  
								// Loop through the files in source directory
								while( $file = readdir($dir) ) { 
							  
									if (( $file != '.' ) && ( $file != '..' )) { 
										if ( is_dir($src . '/' . $file) ) 
										{ 
							  
											// Recursively calling custom copy function
											// for sub directory 
											custom_copy($src . '/' . $file, $dst . '/' . $file); 
							  
										} 
										else { 
											copy($src . '/' . $file, $dst . '/' . $file); 
										} 
									} 
								} 
							  
								closedir($dir);
								
								return true;
							} 
							
							if (!custom_copy("../../V.".$_SESSION['black_min_update_title_folder'], "../../")) {
								echo '
									<section class="tsr-alert tsr-alert-error">
										Błąd pod czas aktulizowania bm!!
									</section>
								';	
								exit();
							}
							
							// usuwanie plików aktulizacyinych w głównym katologo black min'a
							
							removeDir("../../V.".$_SESSION['black_min_update_title_folder']);
							
							if(!removeDir("../../a/aktulizacja/aktulizowanie_black_mina/")){
								// pokazywanbie komunikatu o poprawnym zaktulizowaniu black min'a
								if(unlink("../../a/aktulizacja/".$_SESSION['black_min_update_tile'])){
									// pokazywanbie komunikatu o poprawnym zaktulizowaniu black min'a
									echo '
										<section class="tsr-alert tsr-alert-success">
											Nastąpi przekierowanie!
										</section>
									';							
									
									// przekierowanie
									$connect = url_serwer_bm()."bm/admin/admin-aktulizacja.php?sp=aktulizacja_blackmina_nowa_wersja";
									echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL='.$connect.'">';

									
								}else{
									// pokazywanbie komunikatu o błędzie w rozpakowaniu pliku
									echo '
										<section class="tsr-alert tsr-alert-error">
											Błąd pod czas usuwania plików aktualizacyjnych!!
										</section>
									';									
								}								
							}else{
								// pokazywanbie komunikatu o błędzie w rozpakowaniu pliku
								echo '
									<section class="tsr-alert tsr-alert-error">
										Błąd pod czas usuwania plików aktualizacyjnych!
									</section>
								';									
							}
							
						}else{
							// pokazywanbie komunikatu o błędzie w rozpakowaniu pliku
							echo '
							<section class="tsr-alert tsr-alert-error">
								Błąd pod czas aktulizowania bm!
							</section>
							';											
						}	
						
					}else{
						// pokazywanbie komunikatu o błędzie w aktulizowanie bazy danych black min'a
						echo '
						<section class="tsr-alert tsr-alert-error">
							Błąd pod czas aktulizowania bazy danych bm!
						</section>
						';											
					}
					
				}else{
					// pokazywanbie komunikatu o błędzie w rozpakowaniu pliku
					echo '
					<section class="tsr-alert tsr-alert-error">
						Błąd pod czas wypakowaywania pliku bm!
					</section>
					';					

				}
			
			}else{
				// ustawianie błędu o błędzie z przesłaniem pliku
				echo'

					<script type="text/javascript">
						
						$(".blackmin-pobierz-nowa-wersjie").text("Błąd połączenia z serwerem!").removeClass("tsr-alert-info").removeClass("tsr-alert-success").addClass("tsr-alert-error");
						
					</script>

				';		
				exit();
			}
			
		}
		
	}
		
?>
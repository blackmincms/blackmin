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
*	This file has load file of directory
*/
	
	namespace BlackMin\Load;

	final Class SFL {
		// zmiene odpwiedzialne za przechowywanie danych do ładowania
		/**
		* 	@var array|obiect;
		*/	
		protected $pliki_php = [];
		/**
		* 	@var array|obiect;
		*/		
		protected $pliki_css = [];
		/**
		* 	@var array|obiect;
		*/			
		protected $pliki_js = [];
		// ostatni błąd parsowania
		protected $error = null;
		
		
		// src = ścieżka, lvl = stopień ważnośći pliku
		public function add_php($src, $lvl = 0, $path = null){
			return SFL::add ($src, $lvl, $path, "php");
		}
		public function add_css($src, $lvl = 0, $path = null){
			return SFL::add ($src, $lvl, $path, "css");
		}
		public function add_js($src, $lvl = 0, $path = null){
			return SFL::add ($src, $lvl, $path, "js");
		}

		public function add ($src, $lvl = 0, $path = null, $f = null) {
			if($lvl > 10){
				return "Maksymalny priorytet pliku wynosi 10, dla pliku '".$src."'.";
			}elseif($lvl < 0){
				return "Minimalny priorytet pliku wynosi 0, dla pliku '".$src."'.";
			}elseif(!is_string($src)){
				$this->error = "file_path_wrong";
				return false;
			}else{
				$plik = [
					'src' => $src,
					'lvl' => $lvl,
					'path' => null
				];

				if (!is_null($path)) {
					if (is_string($path)) {
						$plik["path"] = $path;
					}else{
						$this->error = "wrong_path";
						return false;
					}
				}

				if (is_null($f)) {
					$expl = explode(".", $src);
					$expl_ile = count($expl);
					if ($expl_ile >= 1) {
						if (strtolower($expl[$expl_ile-1]) === "php") {
							$f = "php";
						}elseif (strtolower($expl[$expl_ile-1]) === "js") {
							$f = "js";
						}elseif (strtolower($expl[$expl_ile-1]) === "css") {
							$f = "css";
						}else{
							$this->error = "file_path_wrong";
							return false;							
						}
					}else{
						$this->error = "file_path_wrong";
						return false;
					}
				}

				if (strtolower($f) === "php") {
					array_push($this->pliki_php, $plik);
					return true;
				}elseif (strtolower($f) === "js") {
					array_push($this->pliki_js, $plik);
					return true;
				}elseif (strtolower($f) === "css") {
					array_push($this->pliki_css, $plik);
					return true;
				}else{
					$this->error = "file_extention_wrong";
					return false;
				}
			}
		}

		// usuwanie plików do ładowania 
		public function remove_php($src){
			return SFL::remove ($src, "php");
		}
		public function remove_css($src){
			return SFL::remove ($src, "css");
		}
		public function remove_js($src){
			return SFL::remove ($src, "js");
		}

		public function remove ($src, $f = null) {
			if (!is_string(strtolower($src))){
				$this->error = "file_path_wrong";
				return false;
			}else{
				if (strtolower($f) === "php") {
					if ($search = array_search($src, $this->pliki_php)) {
						unset($this->pliki_php[$search]);
					}
					return true;
				}elseif (strtolower($f) === "js") {
					if ($search = array_search($src, $this->pliki_js)) {
						unset($this->pliki_js[$search]);
					}
					return true;
				}elseif (strtolower($f) === "css") {
					if ($search = array_search($src, $this->pliki_css)) {
						unset($this->pliki_css[$search]);
					}
					return true;
				}else{
					$this->error = "file_extention_wrong";
					return false;
				}
			}
		}

		// funkcjia ładowania plików php
		public function load_php($a = SORT_ASC, $t = "lvl"){
			return SFL::load ("php", $a, $t);
		}
		public function load_css($a = SORT_ASC, $t = "lvl"){
			return SFL::load ("css", $a, $t);
		}
		public function load_js($a = SORT_ASC, $t = "lvl"){
			return SFL::load ("js", $a, $t);
		}

		public function load ($array, $order = SORT_ASC, $on = "lvl") {
			if (!is_string(strtolower($array))){
				$this->error = "file_path_wrong";
				return false;
			}else{
				if (strtolower($array) === "php") {
					$sort = SFL::array_sort($this->pliki_php, $on, $order);
					if (is_array($sort)) {
						$ile = count($sort);
						for($i=0; $i < $ile; $i++){
							require_once ($this->pliki_php[$i]['src']) ;
						}
						return true;
					}else{
						$this->error = "error_sort";
						return false;
					}
				}elseif (strtolower($array) === "js") {
					$sort = SFL::array_sort($this->pliki_js, $on, $order);
					if (is_array($sort)) {
						$ile = count($sort);
						for($i=0; $i < $ile; $i++){
							echo '<script src="'. $this->pliki_js[$i]['src'] .'" bm-type="async"></script>';
						}
						return true;
					}else{
						$this->error = "error_sort";
						return false;
					}
				}elseif (strtolower($array) === "css") {
					$sort = SFL::array_sort($this->pliki_css, $on, $order);
					if (is_array($sort)) {
						$ile = count($sort);
						for($i=0; $i < $ile; $i++){
							echo '<link rel="stylesheet" href="'. $this->pliki_css[$i]['src'] .'" bm-type="async">';
						}
						return true;
					}else{
						$this->error = "error_sort";
						return false;
					}
				}else{
					$this->error = "file_extention_wrong";
					return false;
				}
			}
		}
		
		public function array_sort($array, $on, $order=SORT_ASC){
			
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

		public function error () {
			echo $this->error;
		}
		
	}
	
?>
<?php
/**
 * This file is part of the blackmin package.
 *
 * (c) BlackMin
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BlackMin\Plugin;

use ErrorException;

function get_plugin_bm($siteUrl){
    // zmienna przechowywująca dane o wbudowanych pluginach(widget) blackmin
    $bm_widget = [];
    // importowanie zmiennych globalnych
    global $szukaj_posta_kk;

    // widget blackmin (login)
    $bm_widget["logowanie"] = '
			<section class="tsr fs-100 tsr-p-10px bm-logowanie"><a href="'.$siteUrl.'bm/logowanie.php">Logowanie</a></section>
		';
    // widget blackmin (search)
    $bm_widget["wyszukiwarka"] = '
				<form accept-charset="UTF-8" action="" method="get" autocomplete="off" class="tsr-p-10px search_form_bm">	
					<section class="tsr tsr-position-relative">
						<input type="search" name="search" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj" value="'. $szukaj_posta_kk .'">
						<input type="image" name="search" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10" src="'.$siteUrl.'public/pliki/ikony/szukaj.png" >
					</section>
				</form>		
		';

    // sprawdzanie wszystkich pluginów
    return $bm_widget;
}

class Widget extends Base
{
    private $siteUrl = '';
    // zmienne przchowywujące dane o zastosowanych widgetach
    protected $top_plugin = '',
        $left_plugin = '',
        $right_plugin = '',
        $bottom_plugin = '',
        $footer_plugin = '';
    // zmienna przechwywuje dane o starcie indexu pluginów
    protected $start_naglowek = '
			<div class="tsr bm_plugins_container bm_widget_container">
		';
    // zmienna przechwywuje dane o końcu indexu pluginów
    protected $start_widget_naglowek = '
			<div class="tsr bm_plugins_container bm_widget_container">
		';
    // zmienna odpowiedzialna za ukrywanie nagłówka konkretnego pluginu
    protected $naglowek_plugin = false;

    // funckcja ukrywająca nagłowek konkretnego widgetu
    public function header_hide($t){
        // sprawdzanie czy poprawnie wprowadzono dane
        if(is_bool($t)){
            //ustawianie wartośći nagłównka czy ma zostać schowany(true) czy nie(false)
            $this->naglowek_plugin = $t;
        }else{
            throw new ErrorException("Błąd: BM_CLASS_PLUGIN_HEADER_HIDE. Wprowadzone dane są nieprawidłowe!", 1);
        }
    }

    // funkcja chroniona kompilująca widgety
    protected function kompilowanie_widget($t){
        // sprawdzanie czy dane są tablicą
        if(is_array($t)){
            // zmienna pzecowywująca gotowe wyniki skompilownych pluginów
            $o = '';
            // zliczanie elmentów w tablicy
            $ile = count($t);
            // pętla przeprowadząca operacje na objektach
            for($i = 0;$i < $ile; $i++){
                // sprawdzanie czy wyświetlić nagłówek
                if($this->naglowek_plugin === false){
                    // dodawanie nagłowka pluginu (indefikatora)
                    $o .= '<div class="tsr bm-widget-'. $t[$i]["plugin"] .'" bm-widget="'.  $t[$i]["plugin"] .'">';
                }
                // sprawdzanie czy widget jest wbudowany w bm
                if($t[$i]["plugin_full"] == "blackmin"){
                    // ładowanie pluginów (widget) wgranych w blackmin i posegrowanych dla dostępnych i łatwych do użycja dla programisty bm
                    //require_once BMPATH . BM . LADUJ . "plugin-bm.php";
                    // inkludowanie pliku
                    $x = get_plugin_bm($this->siteUrl);
                    $o .= $x[strtolower($t[$i]["plugin"])];
                }else{
                    // sprawdzanie czy plugin istnieje
                    if(is_dir ( "a/pluginy/".$t[$i]["plugin_full"] )  == true){
                        // rozpoczynanie kopilowanie html w php
                        ob_start();
                        // inkludowanie pliku
                        require (BMPATH . A . PLUGINY . $t[$i]["plugin_full"] ."/plugin-content.php");
                        // kompilowanie pliku
                        $out = ob_get_contents();
                        // zaczywywanie kompilowania pliku
                        ob_end_clean();
                        // dodawanie danych zmiennej $o
                        $o .= $out;
                        // zwalnianie danych z pamięci ram
                        ob_clean();
                    }
                };
                // sprawdzanie czy wyświetlić nagłówek
                if($this->naglowek_plugin === false){
                    // zamykanie nagłówka pluginu (indefikatora)
                    $o .= '</div>';
                }
            }
            // swracanie wyniku
            return $o;
        }else{
            return false;
        }
    }

    public function bm_top_widget(){
        // sprawdzanie czy objekt widget został dodany do wyświetlenia
        if(is_array(json_decode($this->top_plugin, true))){
            // zmienna przechowywujące wyrenderowane pluginu
            $t = '';
            // dodawanie header do wyniku renderowania
            $t .= $this->start_naglowek;
            // dodawanie wyrenderowanych widgrtów do wyniku
            $t .= self::kompilowanie_widget(json_decode($this->top_plugin, true));
            // dodawanie zamknięcia header do wyniku
            $t .= '</div>';
            // zwracanie wyniku
            return $t;
        }else{
            return false;
        }
    }
    public function bm_left_widget(){
        // sprawdzanie czy objekt widget został dodany do wyświetlenia
        if(is_array(json_decode($this->left_plugin, true))){
            // zmienna przechowywujące wyrenderowane pluginu
            $t = '';
            // dodawanie header do wyniku renderowania
            $t .= $this->start_naglowek;
            // dodawanie wyrenderowanych widgrtów do wyniku
            $t .= self::kompilowanie_widget(json_decode($this->left_plugin, true));
            // dodawanie zamknięcia header do wyniku
            $t .= '</div>';
            // zwracanie wyniku
            return $t;
        }else{
            return false;
        }
    }
    public function bm_right_widget(){
        // sprawdzanie czy objekt widget został dodany do wyświetlenia
        if(is_array(json_decode($this->right_plugin, true))){
            // zmienna przechowywujące wyrenderowane pluginu
            $t = '';
            // dodawanie header do wyniku renderowania
            $t .= $this->start_naglowek;
            // dodawanie wyrenderowanych widgrtów do wyniku
            $t .= self::kompilowanie_widget(json_decode($this->right_plugin, true));
            // dodawanie zamknięcia header do wyniku
            $t .= '</div>';
            // zwracanie wyniku
            return $t;
        }else{
            return false;
        }
    }
    public function bm_bottom_widget(){
        // sprawdzanie czy objekt widget został dodany do wyświetlenia
        if(is_array(json_decode($this->bottom_plugin, true))){
            // zmienna przechowywujące wyrenderowane pluginu
            $t = '';
            // dodawanie header do wyniku renderowania
            $t .= $this->start_naglowek;
            // dodawanie wyrenderowanych widgrtów do wyniku
            $t .= self::kompilowanie_widget(json_decode($this->bottom_plugin, true));
            // dodawanie zamknięcia header do wyniku
            $t .= '</div>';
            // zwracanie wyniku
            return $t;
        }else{
            return false;
        }
    }
    public function bm_footer_widget(){
        // sprawdzanie czy objekt widget został dodany do wyświetlenia
        if(is_array(json_decode($this->footer_plugin, true))){
            // zmienna przechowywujące wyrenderowane pluginu
            $t = '';
            // dodawanie header do wyniku renderowania
            $t .= $this->start_naglowek;
            // dodawanie wyrenderowanych widgrtów do wyniku
            $t .= self::kompilowanie_widget(json_decode($this->footer_plugin, true));
            // dodawanie zamknięcia header do wyniku
            $t .= '</div>';
            // zwracanie wyniku
            return $t;
        }else{
            return false;
        }
    }

    public function __invoke(array $parameters = [])
    {
        // pobieranie ustawień panelów z pluginami i przydzielanie ich do odpowedniej zmienej
        $this->top_plugin = $parameters["bm_top_widget"] ?? null;
        $this->left_plugin = $parameters["bm_left_widget"] ?? null;
        $this->right_plugin = $parameters["bm_right_widget"] ?? null;
        $this->bottom_plugin = $parameters["bm_bottom_widget"] ?? null;
        $this->footer_plugin = $parameters["bm_footer_widget"] ?? null;
        $this->siteUrl = $parameters['url_server'] ?? null;
    }
}

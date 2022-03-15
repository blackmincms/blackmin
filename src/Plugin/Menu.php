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

use BlackMin\View\View;

class Menu extends Base
{
    private $database;
    // zmiene do generowania menu black min'abs
    private $rodzic_tag_menu = "ol";
    private $dziecko_tag_menu = "li";
    private $rodzic_sub_menu_tag = "ul";
    private $class_rodzic_menu = "menu";
    private $class_dziecko_menu = "menu-children";
    private $class_sub_menu = "menu-sub-parent";

    private $menuItem = '';

    public function __construct(View $view, $database)
    {
        $this->database = $database;
        parent::__construct($view);
    }

    // funkcja sortująca itemu menu według kolejnośći
    // tablica z danymi do posortowania, tablica z strukturom sortującą, nazwa głównego kontenerta na sortowanie, box do przeciągania, box do przeczymywania itemów
    private function menu_sort($t, $x, $sort = "tsr-sortiner", $sorthandle = "tsr-sort-handle", $sort_item = "tsr-sort-item", $sortitem = "tsr-sortitem"){
        if((isset($t)) AND isset($x)){
            // sprawdzanie czy dane są w tablicy
            if((is_array($t)) AND (is_array($x))){
                // pobieranie indexu tablicy strukturalnej
                $ile_sort = count($x);
                // sprawdzanie czy tablica nie jest pusta
                if($ile_sort != 0){
                    // zmienna przechowywująca strukture menu
                    $r = "";
                    // pętla do operacji na danych
                    for($i = 0; $i < $ile_sort; $i++){
                        $rev = array_search($x[$i]["id"], array_column($t, "id"));
                        $menu_items = json_decode($t[$rev]["bm_wartosc"], true);

                        $r .= '<'. $this->dziecko_tag_menu .' class="'. $this->class_dziecko_menu .'"><a href="'.$menu_items[1].'">'.$menu_items[0].'</a>';

                        if(isset($x[$i]["children"])){
                            $r .= '<'. $this->rodzic_sub_menu_tag .' class="'. $this->class_sub_menu .'">';
                            $r .= self::menu_sort($t, $x[$i]["children"]);
                            $r .= '</'. $this->rodzic_sub_menu_tag .'>';
                        }

                        $r .= '</'. $this->dziecko_tag_menu .'>';
                    }

                    // zwracanie danych posortowanych
                    return $r;
                }else{
                    return null;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // funkcjia do zmiany tagu html dla generowanego menu
    public function set_tag_menu($rodzic_tag, $dziecko_tag, $rodzic_sub_menu_tag){
        $this->rodzic_tag_menu = $rodzic_tag;
        $this->dziecko_tag_menu = $dziecko_tag;
        $this->rodzic_sub_menu_tag = $rodzic_sub_menu_tag;
    }

    // funkcjia do zmiany klasy html dla generowanego menu
    public function add_class_menu($rodzic_class, $dziecko_class, $class_sub_menu){
        $this->class_rodzic_menu .= $rodzic_class;
        $this->class_dziecko_menu .= $dziecko_class;
        $this->class_sub_menu .= $class_sub_menu;
    }

    // funkcjia do zmiany klasy html dla generowanego menu
    public function set_class_menu($rodzic_class, $dziecko_class, $class_sub_menu){
        $this->class_rodzic_menu = $rodzic_class;
        $this->class_dziecko_menu = $dziecko_class;
        $this->class_sub_menu = $class_sub_menu;
    }

    // funkcjia do ładowania menu
    public function renderHtml()
    {
        return $this->menuItem;
    }

    public function __invoke(array $parameters = [])
    {
        $menu = $parameters['bm_menu_structur'] ?? '';
        // pobieranie wszysatkich itemów z menu
        $q = $this->database->query("SELECT * FROM `|prefix|bm_postmeta` WHERE `bm_kontent` LIKE 'menu'");

        // sprawdzanie czy menu zawiera elmenty
        if((count(json_decode($menu, true))) AND (count($q)) != 0){
            // renderowanie i zwracanie wyniku
            $this->menuItem = '<'. $this->rodzic_tag_menu .' class="'. $this->class_rodzic_menu .'">' . self::menu_sort($q, json_decode($menu, true)) .  '</'. $this->rodzic_tag_menu .'>';
        }
    }
}

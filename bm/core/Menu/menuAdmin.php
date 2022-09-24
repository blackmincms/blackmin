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
*	This file is menu | admin panel
*/

    namespace BlackMin\Menu;

    final class menuAdmin {

        /**
		 * 	@var array
		 */
        protected $menuE = [
            [
                "name" => "Panel",
                "url" => "panel",
                "icon" => "home.png",
                "children" => NULL /* [
                   [
                        "name" => "Update",
                        "url" => "update",
                        "icon" => null
                   ]
                ] */
            ] , [
                "name" => "Dodaj Post",
                "url" => "add-post",
                "icon" => "post.png",
                "children" => [
                    [
                        "name" => "Wszystkie Posty",
                        "url" => "post",
                        "icon" => null
                    ] , [
                        "name" => "Dodaj Kategoria Tag",
                        "url" => "add-category-tag",
                        "icon" => null
                    ] , [
                        "name" => "Kategoria Tag",
                        "url" => "category-tag",
                        "icon" => null
                    ]
                ]
            ] , [
                "name" => "Dysk",
                "url" => "disk",
                "icon" => "dysk.png",
                "children" => [
                    [
                        "name" => "Dodaj element",
                        "url" => "add-file",
                        "icon" => null
                    ]
                ]
            ] , [
                "name" => "Motyw",
                "url" => "theme",
                "icon" => "motywy.png",
                "children" => [
                    [
                        "name" => "Dostosuj Motyw",
                        "url" => "customize-theme",
                        "icon" => null
                    ] , [
                        "name" => "Edytuj Menu",
                        "url" => "edit-menu",
                        "icon" => null
                    ]/*  , [
                        "name" => "Edytuj Motyw",
                        "url" => "edit-theme",
                        "icon" => null
                    ]  */, [
                        "name" => "Widżety",
                        "url" => "widget",
                        "icon" => null
                    ]
                ]
            ] , [
                "name" => "Pluginy",
                "url" => "plugin",
                "icon" => "plugin.png",
                "children" => null
            ] , [
                "name" => "Użytkownicy",
                "url" => "users",
                "icon" => "uzytkownicy.png",
                "children" => [
                    [
                        "name" => "Dodaj użytkownika",
                        "url" => "add-user",
                        "icon" => null
                    ] , [
                        "name" => "Profil",
                        "url" => "profile",
                        "icon" => null
                    ]
                ]
            ] , [
                "name" => "Ustawienia BM",
                "url" => "server-settings",
                "icon" => "ustawienia.png",
                "children" => [
                    [
                        "name" => "Ustawienia Witryny",
                        "url" => "site-settings",
                        "icon" => null
                    ] , [
                        "name" => "Ustawienia Postów",
                        "url" => "post-settings",
                        "icon" => null
                    ] , [
                        "name" => "Ustawienia Społeczne",
                        "url" => "social-settings",
                        "icon" => null
                    ] , [
                        "name" => "Tryb Konserwacji",
                        "url" => "maintenance-mode",
                        "icon" => null
                    ]
                ]
            ] , [
                "name" => "Zwiń menu",
                "url" => "__MENU__",
                "icon" => "szczalka2.png",
                "children" => null
            ]
        ];

        /**
		 * 	@var string
		 */
        protected $directPath = ("pliki/ikony/");
        
        private function valid (array $t):bool {
            $a = (array_key_exists("name", $t) ?? false);
            $b = (array_key_exists("url", $t) ?? false);
            $c = (array_key_exists("icon", $t) ?? false);

            if (($a !== false) && ($b !== false) && ($c !== false)) {
               return true;
            } else {
                return false;
            }
            
        }

        private function renderChil (array $t) {
            $temp = "";

            $temp .= '<section class="menu-left-hover">';

            $ile = count($t);
            for ($i=0; $i < $ile; $i++) {
                if ($this->valid($t[$i])) {
                    $temp .= '   
                        <a href="bm/admin/'.$t[$i]["url"].'.php">
                            <section class="menu-left-submenu">
                            '. $t[$i]["name"] .'
                            </section>
                        </a>
                    ';
                }else{
                    printf (`<div class="tsr-alert tsr-alert-error">BlackMin ERROR: valid menu error.</div>`);
                    return false;
                    exit ();
                }
            }    

            $temp .= '</section>';

            return $temp;
        }

        public function render () {
            $temp = "";

            $temp .= '<header class="tsr-nav-menu-left tsr-nav-menu-left2 tsr-menu-background tsr-pt-10px">';
            
            $ile = count($this->menuE);
            for ($i=0; $i < $ile; $i++) { 

                if ($this->valid($this->menuE[$i])) {
                    if ($this->menuE[$i]["url"] === "__MENU__") {
                        $temp .= '
                            <section class="tsr menu-left tsr-button-menu-left-minimalize">
                                    <aref href="bm/admin/#">
                                        <section class="menu-item">
                                            <img src="'.$this->directPath.$this->menuE[$i]["icon"].'" alt="'. $this->menuE[$i]["name"] .'" class="tsr-nav-menu-img-left">
                                            <section class="tsr-nav-menu-size2">'. $this->menuE[$i]["name"] .'</section>
                                        </section>
                                    </aref>
                            </section>
                        ';
                    } else {
                        $temp .= '
                            <section class="tsr menu-left">
                                    <a href="bm/admin/'.$this->menuE[$i]["url"].'.php">
                                        <section class="menu-item">
                                            <img src="'.$this->directPath.$this->menuE[$i]["icon"].'" alt="'. $this->menuE[$i]["name"] .'" class="tsr-nav-menu-img-left">
                                            <section class="tsr-nav-menu-size2">'. $this->menuE[$i]["name"] .'</section>
                                        </section>
                                    </a>
                                    ';
                                    ($this->menuE[$i]["children"] != null ? ($temp .= menuAdmin::renderChil($this->menuE[$i]["children"])) : "") ;
                        $temp .= '
                            </section>
                        ';
                    }
                    
                }else{
                    printf (`<div class="tsr-alert tsr-alert-error">BlackMin ERROR: valid menu error.</div>`);
                    return false;
                    exit ();
                }
            }
            
            $temp .= '</header>';
            return $temp;
        }

        public function renderViewOnly(){
            $t = $this->render();
            if ($t !== false) {
                echo $t;
            }
        }
    }
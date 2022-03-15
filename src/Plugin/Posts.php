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


class Posts extends Base
{
    private $database;

    private $bm_url;

    // zmiene odpowiedzialna za ilość ładowanych postów BlackMina
    private $load_post = 25;

    // zmiene odpowiedzilne za przchowywanie wiadomośći o postach
    private $id_post,
        $dodajacy_post,
        $tytul_post,
        $url_post,
        $kategoria_post ,
        $kategoria_post_post,
        $status_post,
        $password_post,
        $tagi_post,
        $datetime_post,
        $datetime_zmiany_post,
        $kto_edit_post,
        $visit_post,
        $komentarze,
        $miniaturka,
        $tresc_post;

    // zmiena przechowywująca hasło wpisane przez użytkownika do rozszyfrowania posta
    protected $update_password_post = "";

    // zmiena odpowiedzialna za zmienianie liczby znalezionych wyników
    private $ile_query_post_load = 0;

    // potwierdzenie czy zostało wpisane pobrawne hasło
    protected $czy_halo_dobre = null;
    // zmienna przechowywuje dane do szukania
    protected $search_post = null;

    public function __construct(View $view, $database)
    {
        $this->database = $database;
        parent::__construct($view);
    }

    // funkcjia do aktulizowania hasła wpisanego przez użytkownika
    public function change_password($t){
        $this->update_password_post = htmlspecialchars($t);
    }

    // funkcjia do aktulizowania ładowanego posta
    public function update_load_post($id){
        $this->load_post = htmlspecialchars($id);
    }
    // funkcjia szukająca szukająca posta wybranego przez usera
    public function search_post($t){
        $this->search_post = htmlspecialchars($t);
    }


    public function renderPost() {
        // pobieranie zmiennych globalnych
        //global $db_bm,$bm_url;

        // sprawdzanie danych do załadowania
        if($this->bm_url["checked_url"] == "root"){
            $wynik = $this->database->query("SELECT * FROM `bm_data_posty` WHERE (`status`LIKE 'public' OR `status`LIKE 'protect_password' OR `status`LIKE 'private') ORDER BY `id` DESC LIMIT ". $this->load_post, false);
            // dane opisowe do posta
            $this->ile_query_post_load = $wynik["num_rows"];
            // sprawdzanie czy znaleziono posta
            if($wynik["num_rows"] != 0){
                // dodawanie tablic
                $this->id_post = [];
                $this->dodajacy_post = [];
                $this->tytul_post = [];
                $this->url_post = [];
                $this->kategoria_post = [];
                $this->kategoria_post_post =  [];
                $this->status_post = [];
                $this->tagi_post =  [];
                $this->datetime_post = [];
                $this->datetime_zmiany_post = [];
                $this->kto_edit_post = [];
                $this->visit_post =  [];
                $this->komentarze =  [];
                $this->miniaturka = [];
                $this->tresc_post =  [];
                // pętla przetwarzająca dane
                for($i = 0; $i < $wynik["num_rows"]; $i++){
                    // sprawdzanie czy post jest chroniony hasłem
                    if( $wynik[$i]["status"] == "protect_password"){
                        // aktulizowanie danych o poscie
                        array_push($this->id_post, $wynik[$i]["id"]);
                        array_push($this->dodajacy_post, $wynik[$i]["dodajacy"]);
                        array_push($this->tytul_post,$wynik[$i]["tytul"]);
                        array_push($this->url_post, $wynik[$i]["url"]);
                        array_push($this->kategoria_post, "protect password");
                        array_push($this->kategoria_post_post, "protect password");
                        array_push($this->status_post, "protect_password");
                        array_push($this->tagi_post, "protect password");
                        array_push($this->datetime_post, $wynik[$i]["datetime"]);
                        array_push($this->datetime_zmiany_post, $wynik[$i]["datetime_zmiany"]);
                        array_push($this->kto_edit_post, $wynik[$i]["kto_edit"]);
                        array_push($this->visit_post, "protect password");
                        array_push($this->komentarze, "protect password");
                        array_push($this->miniaturka, $wynik[$i]["bm_miniaturka"]);
                        array_push($this->tresc_post, "protect password");
                    }elseif( $wynik[$i]["status"] == "private"){
                        // sprawdzanie czy user jest z administracji
                        if(isset($_SESSION['flaga']) >= 6){
                            // aktulizowanie danych o poscie
                            array_push($this->id_post, $wynik[$i]["id"]);
                            array_push($this->dodajacy_post, $wynik[$i]["dodajacy"]);
                            array_push($this->tytul_post,$wynik[$i]["tytul"]);
                            array_push($this->url_post, $wynik[$i]["url"]);
                            array_push($this->kategoria_post,$wynik[$i]["kategoria"]);
                            array_push($this->kategoria_post_post, $wynik[$i]["kategoria_post"]);
                            array_push($this->status_post, $wynik[$i]["status"]);
                            array_push($this->tagi_post, $wynik[$i]["tagi"]);
                            array_push($this->datetime_post, $wynik[$i]["datetime"]);
                            array_push($this->datetime_zmiany_post, $wynik[$i]["datetime_zmiany"]);
                            array_push($this->kto_edit_post, $wynik[$i]["kto_edit"]);
                            array_push($this->visit_post, $wynik[$i]["visit"]);
                            array_push($this->komentarze, $wynik[$i]["bm_komentarze"]);
                            array_push($this->miniaturka, $wynik[$i]["bm_miniaturka"]);
                            array_push($this->tresc_post, $wynik[$i]["tresc"]);
                        }else{
                            --$this->ile_query_post_load;
                        }
                    }else{
                        // aktulizowanie danych o poscie
                        array_push($this->id_post, $wynik[$i]["id"]);
                        array_push($this->dodajacy_post, $wynik[$i]["dodajacy"]);
                        array_push($this->tytul_post,$wynik[$i]["tytul"]);
                        array_push($this->url_post, $wynik[$i]["url"]);
                        array_push($this->kategoria_post,$wynik[$i]["kategoria"]);
                        array_push($this->kategoria_post_post, $wynik[$i]["kategoria_post"]);
                        array_push($this->status_post, $wynik[$i]["status"]);
                        array_push($this->tagi_post, $wynik[$i]["tagi"]);
                        array_push($this->datetime_post, $wynik[$i]["datetime"]);
                        array_push($this->datetime_zmiany_post, $wynik[$i]["datetime_zmiany"]);
                        array_push($this->kto_edit_post, $wynik[$i]["kto_edit"]);
                        array_push($this->visit_post, $wynik[$i]["visit"]);
                        array_push($this->komentarze, $wynik[$i]["bm_komentarze"]);
                        array_push($this->miniaturka, $wynik[$i]["bm_miniaturka"]);
                        array_push($this->tresc_post, $wynik[$i]["tresc"]);
                    }
                }
            }else{
                // ustawianie błędu przy ładowaniu danych
                // podawanie błędu 404
                // aktulizowanie danych o poscie
                $this->id_post = 0;
                $this->dodajacy_post = "ERROR_404";
                $this->tytul_post = "ERROR_404";
                $this->url_post = "ERROR_404";
                $this->kategoria_post =  "ERROR_404";
                $this->kategoria_post_post =  "ERROR_404";
                $this->status_post = "ERROR_404";
                $this->tagi_post =  "ERROR_404";
                $this->datetime_post = "ERROR_404";
                $this->datetime_zmiany_post = "ERROR_404";
                $this->kto_edit_post = "ERROR_404";
                $this->visit_post =  "ERROR_404";
                $this->komentarze =  "ERROR_404";
                $this->miniaturka = "ERROR_404";
                $this->tresc_post =  "ERROR_404";
            }
        }elseif($this->bm_url["checked_url"] == "search_page"){
            // sprawdzanie czy dev szuka innego posta/postów
            if($this->search_post === null){
                $s = $this->bm_url["path"];
            }else{
                $s = $this->search_post;
            }
            $wynik = $this->database->query2("SELECT * FROM `bm_data_posty` WHERE (`status`LIKE 'public' OR `status`LIKE 'protect_password' OR `status`LIKE 'private') AND `url` LIKE '%". $this->database->valid($s) ."%' ORDER BY `id` DESC LIMIT ". $this->load_post, false);

            // dane opisowe do posta
            $this->ile_query_post_load = $wynik["num_rows"];
            // sprawdzanie czy znaleziono posta
            if($wynik["num_rows"] != 0){
                // dodawanie tablic
                $this->id_post = [];
                $this->dodajacy_post = [];
                $this->tytul_post = [];
                $this->url_post = [];
                $this->kategoria_post = [];
                $this->kategoria_post_post =  [];
                $this->status_post = [];
                $this->tagi_post =  [];
                $this->datetime_post = [];
                $this->datetime_zmiany_post = [];
                $this->kto_edit_post = [];
                $this->visit_post =  [];
                $this->komentarze =  [];
                $this->miniaturka = [];
                $this->tresc_post =  [];
                // pętla przetwarzająca dane
                for($i = 0; $i < $wynik["num_rows"]; $i++){
                    // sprawdzanie czy post jest chroniony hasłem
                    if( $wynik[$i]["status"] == "protect_password"){
                        // aktulizowanie danych o poscie
                        array_push($this->id_post, $wynik[$i]["id"]);
                        array_push($this->dodajacy_post, $wynik[$i]["dodajacy"]);
                        array_push($this->tytul_post,$wynik[$i]["tytul"]);
                        array_push($this->url_post, $wynik[$i]["url"]);
                        array_push($this->kategoria_post, "protect password");
                        array_push($this->kategoria_post_post, "protect password");
                        array_push($this->status_post, "protect_password");
                        array_push($this->tagi_post, "protect password");
                        array_push($this->datetime_post, $wynik[$i]["datetime"]);
                        array_push($this->datetime_zmiany_post, $wynik[$i]["datetime_zmiany"]);
                        array_push($this->kto_edit_post, $wynik[$i]["kto_edit"]);
                        array_push($this->visit_post, "protect password");
                        array_push($this->komentarze, "protect password");
                        array_push($this->miniaturka, $wynik[$i]["bm_miniaturka"]);
                        array_push($this->tresc_post, "protect password");
                    }elseif( $wynik[$i]["status"] == "private"){
                        // sprawdzanie czy user jest z administracji
                        if(isset($_SESSION['flaga']) >= 6){
                            // aktulizowanie danych o poscie
                            array_push($this->id_post, $wynik[$i]["id"]);
                            array_push($this->dodajacy_post, $wynik[$i]["dodajacy"]);
                            array_push($this->tytul_post,$wynik[$i]["tytul"]);
                            array_push($this->url_post, $wynik[$i]["url"]);
                            array_push($this->kategoria_post,$wynik[$i]["kategoria"]);
                            array_push($this->kategoria_post_post, $wynik[$i]["kategoria_post"]);
                            array_push($this->status_post, $wynik[$i]["status"]);
                            array_push($this->tagi_post, $wynik[$i]["tagi"]);
                            array_push($this->datetime_post, $wynik[$i]["datetime"]);
                            array_push($this->datetime_zmiany_post, $wynik[$i]["datetime_zmiany"]);
                            array_push($this->kto_edit_post, $wynik[$i]["kto_edit"]);
                            array_push($this->visit_post, $wynik[$i]["visit"]);
                            array_push($this->komentarze, $wynik[$i]["bm_komentarze"]);
                            array_push($this->miniaturka, $wynik[$i]["bm_miniaturka"]);
                            array_push($this->tresc_post, $wynik[$i]["tresc"]);
                        }else{
                            --$this->ile_query_post_load;
                        }
                    }else{
                        // aktulizowanie danych o poscie
                        array_push($this->id_post, $wynik[$i]["id"]);
                        array_push($this->dodajacy_post, $wynik[$i]["dodajacy"]);
                        array_push($this->tytul_post,$wynik[$i]["tytul"]);
                        array_push($this->url_post, $wynik[$i]["url"]);
                        array_push($this->kategoria_post,$wynik[$i]["kategoria"]);
                        array_push($this->kategoria_post_post, $wynik[$i]["kategoria_post"]);
                        array_push($this->status_post, $wynik[$i]["status"]);
                        array_push($this->tagi_post, $wynik[$i]["tagi"]);
                        array_push($this->datetime_post, $wynik[$i]["datetime"]);
                        array_push($this->datetime_zmiany_post, $wynik[$i]["datetime_zmiany"]);
                        array_push($this->kto_edit_post, $wynik[$i]["kto_edit"]);
                        array_push($this->visit_post, $wynik[$i]["visit"]);
                        array_push($this->komentarze, $wynik[$i]["bm_komentarze"]);
                        array_push($this->miniaturka, $wynik[$i]["bm_miniaturka"]);
                        array_push($this->tresc_post, $wynik[$i]["tresc"]);
                    }
                }
            }else{
                // ustawianie błędu przy ładowaniu danych
                // podawanie błędu 404
                // aktulizowanie danych o poscie
                $this->id_post = 0;
                $this->dodajacy_post = "ERROR_404";
                $this->tytul_post = "ERROR_404";
                $this->url_post = "ERROR_404";
                $this->kategoria_post =  "ERROR_404";
                $this->kategoria_post_post =  "ERROR_404";
                $this->status_post = "ERROR_404";
                $this->tagi_post =  "ERROR_404";
                $this->datetime_post = "ERROR_404";
                $this->datetime_zmiany_post = "ERROR_404";
                $this->kto_edit_post = "ERROR_404";
                $this->visit_post =  "ERROR_404";
                $this->komentarze =  "ERROR_404";
                $this->miniaturka = "ERROR_404";
                $this->tresc_post =  "ERROR_404";
            }
        }elseif($this->bm_url["checked_url"] == "post_page"){
            // sprawdzanie czy dev szuka innego posta/postów
            if($this->search_post === null){
                $s = $this->bm_url["path"];
            }else{
                $s = $this->search_post;
            }
            $wynik = $this->database->query("SELECT * FROM `bm_data_posty` WHERE (`status`LIKE 'public' OR `status`LIKE 'protect_password' OR `status`LIKE 'private') AND `url` LIKE '". $this->database->valid($s) ."' ORDER BY `id` DESC LIMIT 1", false);

            // dane opisowe do posta
            $this->ile_query_post_load = $wynik["num_rows"];

            // sprawdzanie czy znaleziono posta
            if($wynik["num_rows"] != 0){
                // sprawdzanie czy post jest chroniony hasłem
                if( $wynik[0]["status"] == "protect_password"){
                    if($this->update_password_post !== $wynik[0]["password_post"]){
                        // potwierdzenie że hasła do siebie pasują
                        $this->czy_halo_dobre = false;
                        // aktulizowanie danych o poscie
                        $this->id_post = 0;
                        $this->dodajacy_post = $wynik[0]["dodajacy"];
                        $this->tytul_post = $wynik[0]["tytul"];
                        $this->url_post = $wynik[0]["url"];
                        $this->kategoria_post =  "protect password";
                        $this->kategoria_post_post =  "protect password";
                        $this->status_post = "protect_password";
                        $this->tagi_post =  "protect password";
                        $this->datetime_post = $wynik[0]["datetime"];
                        $this->datetime_zmiany_post = $wynik[0]["datetime_zmiany"];
                        $this->kto_edit_post = $wynik[0]["kto_edit"];
                        $this->visit_post =  "protect password";
                        $this->komentarze =  "protect password";
                        $this->miniaturka = $wynik[0]["bm_miniaturka"];
                        $this->tresc_post =  "protect password";
                    }else{
                        // potwierdzenie że hasła do siebie pasują
                        $this->czy_halo_dobre = true;
                        // aktulizowanie danych o poscie
                        $this->id_post = $wynik[0]["id"];
                        $this->dodajacy_post = $wynik[0]["dodajacy"];
                        $this->tytul_post = $wynik[0]["tytul"];
                        $this->url_post = $wynik[0]["url"];
                        $this->kategoria_post = $wynik[0]["kategoria"];
                        $this->kategoria_post_post = $wynik[0]["kategoria_post"];
                        $this->status_post = $wynik[0]["status"];
                        $this->tagi_post = $wynik[0]["tagi"];
                        $this->datetime_post = $wynik[0]["datetime"];
                        $this->datetime_zmiany_post = $wynik[0]["datetime_zmiany"];
                        $this->kto_edit_post = $wynik[0]["kto_edit"];
                        $this->visit_post = $wynik[0]["visit"];
                        $this->komentarze = $wynik[0]["bm_komentarze"];
                        $this->miniaturka = $wynik[0]["bm_miniaturka"];
                        $this->tresc_post = $wynik[0]["tresc"];
                    }
                }elseif( $wynik[0]["status"] == "private"){
                    // sprawdzanie czy user jest z administracji
                    if(isset($_SESSION['flaga']) >= 6){
                        // aktulizowanie danych o poscie
                        $this->id_post = $wynik[0]["id"];
                        $this->dodajacy_post = $wynik[0]["dodajacy"];
                        $this->tytul_post = $wynik[0]["tytul"];
                        $this->url_post = $wynik[0]["url"];
                        $this->kategoria_post = $wynik[0]["kategoria"];
                        $this->kategoria_post_post = $wynik[0]["kategoria_post"];
                        $this->status_post = $wynik[0]["status"];
                        $this->tagi_post = $wynik[0]["tagi"];
                        $this->datetime_post = $wynik[0]["datetime"];
                        $this->datetime_zmiany_post = $wynik[0]["datetime_zmiany"];
                        $this->kto_edit_post = $wynik[0]["kto_edit"];
                        $this->visit_post = $wynik[0]["visit"];
                        $this->komentarze = $wynik[0]["bm_komentarze"];
                        $this->miniaturka = $wynik[0]["bm_miniaturka"];
                        $this->tresc_post = $wynik[0]["tresc"];
                    }else{
                        // podawanie błędu 404
                        // aktulizowanie danych o poscie
                        $this->id_post = 0;
                        $this->dodajacy_post = "ERROR_404";
                        $this->tytul_post = "ERROR_404";
                        $this->url_post = "ERROR_404";
                        $this->kategoria_post =  "ERROR_404";
                        $this->kategoria_post_post =  "ERROR_404";
                        $this->status_post = "ERROR_404";
                        $this->tagi_post =  "ERROR_404";
                        $this->datetime_post = "ERROR_404";
                        $this->datetime_zmiany_post = "ERROR_404";
                        $this->kto_edit_post = "ERROR_404";
                        $this->visit_post =  "ERROR_404";
                        $this->komentarze =  "ERROR_404";
                        $this->miniaturka = "ERROR_404";
                        $this->tresc_post =  "ERROR_404";
                    }
                }else{
                    // aktulizowanie danych o poscie
                    $this->id_post = $wynik[0]["id"];
                    $this->dodajacy_post = $wynik[0]["dodajacy"];
                    $this->tytul_post = $wynik[0]["tytul"];
                    $this->url_post = $wynik[0]["url"];
                    $this->kategoria_post = $wynik[0]["kategoria"];
                    $this->kategoria_post_post = $wynik[0]["kategoria_post"];
                    $this->status_post = $wynik[0]["status"];
                    $this->tagi_post = $wynik[0]["tagi"];
                    $this->datetime_post = $wynik[0]["datetime"];
                    $this->datetime_zmiany_post = $wynik[0]["datetime_zmiany"];
                    $this->kto_edit_post = $wynik[0]["kto_edit"];
                    $this->visit_post = $wynik[0]["visit"];
                    $this->komentarze = $wynik[0]["bm_komentarze"];
                    $this->miniaturka = $wynik[0]["bm_miniaturka"];
                    $this->tresc_post = $wynik[0]["tresc"];
                }

            }else{
                // ustawianie błędu przy ładowaniu danych
                // podawanie błędu 404
                // aktulizowanie danych o poscie
                $this->id_post = 0;
                $this->dodajacy_post = "ERROR_404";
                $this->tytul_post = "ERROR_404";
                $this->url_post = "ERROR_404";
                $this->kategoria_post =  "ERROR_404";
                $this->kategoria_post_post =  "ERROR_404";
                $this->status_post = "ERROR_404";
                $this->tagi_post =  "ERROR_404";
                $this->datetime_post = "ERROR_404";
                $this->datetime_zmiany_post = "ERROR_404";
                $this->kto_edit_post = "ERROR_404";
                $this->visit_post =  "ERROR_404";
                $this->komentarze =  "ERROR_404";
                $this->miniaturka = "ERROR_404";
                $this->tresc_post =  "ERROR_404";
            }
        }else{
            // podawanie błędu 404
            // aktulizowanie danych o poscie
            $this->id_post = 0;
            $this->dodajacy_post = "ERROR_404";
            $this->tytul_post = "ERROR_404";
            $this->url_post = "ERROR_404";
            $this->kategoria_post =  "ERROR_404";
            $this->kategoria_post_post =  "ERROR_404";
            $this->status_post = "ERROR_404";
            $this->tagi_post =  "ERROR_404";
            $this->datetime_post = "ERROR_404";
            $this->datetime_zmiany_post = "ERROR_404";
            $this->kto_edit_post = "ERROR_404";
            $this->visit_post =  "ERROR_404";
            $this->komentarze =  "ERROR_404";
            $this->miniaturka = "ERROR_404";
            $this->tresc_post =  "ERROR_404";
        }

        return true;

    }


    // sprawdzanie poprawnośći hasła jeżeli był chroniony post
    public function validate_password_post(){
        return $this->czy_halo_dobre;
    }

    // funkcjia do pobierania danych posta
    public function query_load_post(){
        return $this->ile_query_post_load;
    }

    public function id_post(){
        return $this->id_post;
    }

    public function author_post(){
        return $this->dodajacy_post;
    }

    public function title_post(){
        return $this->tytul_post;
    }

    public function url_post(){
        return $this->url_post;
    }

    public function format_post(){
        return $this->kategoria_post;
    }

    public function category_post(){
        return $this->kategoria_post_post;
    }

    public function status_post(){
        return $this->status_post;
    }

    public function tag_post(){
        return $this->tagi_post;
    }

    public function datetime_post(){
        return $this->datetime_post;
    }

    public function datetime_change_post(){
        return $this->datetime_zmiany_post;
    }

    public function user_edit_post(){
        return $this->kto_edit_post;
    }

    public function visit_post(){
        return $this->visit_post;
    }

    public function comments_post(){
        return $this->komentarze;
    }

    public function thumbnail_post(){
        return $this->miniaturka;
    }

    public function contents_post(){
        return $this->tresc_post;
    }

    public function __invoke(array $parameters = [])
    {
        $this->load_post = $parameters["bm_default_load_post"] ?? 25;
        $this->bm_url = $parameters["bm_url"] ?? '';
    }
}

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
*	This file has load head admin | admin panel
*/

    namespace BlackMin\Head;

    use BlackMin\Head\Head as Head;

    final class HeadAdmin extends Head {

        function __construct(){
            Head::add_title("Admin Panel &gt;&gt; BlackMin");
            Head::add_keywords("Admin Panel &gt;&gt; BlackMin");
            Head::add_description("Admin Panel &gt;&gt; BlackMin");
            Head::set_robots("noindex, nofollow");
            Head::set_icon(BM_SETTINGS["url_server"] . "pliki/logo/logo_bm_white_2_100_100.png");
            Head::set_icon_ico(BM_SETTINGS["url_server"] . "pliki/logo/logo_bm_white_2_100_100.png");
            // css
            Head::add_css(BM_SETTINGS["url_server"] . "files/css/timonix_styles_rezult.css", "bm");
            Head::add_css("jquery_ui");
            Head::add_css(BM_SETTINGS["url_server"] . "files/css/timonix_styles_rezult.css", "bm");
            // js
            Head::add_script("jquery");
            Head::add_script("jquery_ui");
            Head::add_script(BM_SETTINGS["url_server"] . "files/js/timonix_styles_rezult.js", "bm");
            Head::add_script(BM_SETTINGS["url_server"] . "files/js/blackmin-autoload.js", "bm");
            Head::add_script(BM_SETTINGS["url_server"] . "files/js/blackmin-autocommend.js", "bm");
        }

        public function Load (){
            echo Head::load_head();
        }
    }
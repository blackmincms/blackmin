<?php 
    // reguire_once bm core
    require_once 'black-min.php';

    // Compare this snippet from bm\core\Theme\customize.php:

    // get theme from bm_settings array table and return it
    $themeCss = (isset(BM_SETTINGS["bm_customize_menu_style"]) ? unserialize(BM_SETTINGS['bm_customize_menu_style']) : NULL);
    $background_theme = ($themeCss !== NULL ? $themeCss["background-theme"] : "");
    $color_font_theme = ($themeCss !== NULL ? $themeCss["color-font-theme"] : "");
    $color_font_link_theme = ($themeCss !== NULL ? $themeCss["color-font-link-theme"] : "");
    $color_font_link_hover_theme = ($themeCss !== NULL ? $themeCss["color-font-link-hover-theme"] : "");
    $color_font_link_active_theme = ($themeCss !== NULL ? $themeCss["color-font-link-active-theme"] : "");
    $color_font_link_visited_theme = ($themeCss !== NULL ? $themeCss["color-font-link-visited-theme"] : "");
?>

<form accept-charset="UTF-8" action="update" url="Theme" method="post" id="blackminsend" class="fs-80" autocomplete="off">	
					
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-60 " >
            <span class="tsr-vertical-align-sub">
                Kolor Tła Motywu:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="color" name="background-theme" class="input" placeholder="Black Min CMS" value="<?php echo $background_theme ?>" noclear="true" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-60 " >
            <span class="tsr-vertical-align-sub">
                Kolor Czcionki Motywu:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="color" name="color-font-theme" class="input" placeholder="Black Min CMS" value="<?php echo $color_font_theme ?>" noclear="true" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-60 " >
            <span class="tsr-vertical-align-sub">
                Kolor Czcionki Linku Motywu:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="color" name="color-font-link-theme" class="input" placeholder="Black Min CMS" value="<?php echo $color_font_link_theme ?>" noclear="true" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-60 " >
            <span class="tsr-vertical-align-sub">
                Kolor Czcionki Linku Motywu:
            </span>
            <span class="tsr-vertical-align-sub fs-70">
                Po Najechaniu
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="color" name="color-font-link-hover-theme" class="input" placeholder="Black Min CMS" value="<?php echo $color_font_link_hover_theme ?>" noclear="true" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-60 " >
            <span class="tsr-vertical-align-sub">
                Kolor Czcionki Linku Motywu:
            </span>
            <span class="tsr-vertical-align-sub fs-70">
                Aktywny Link
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="color" name="color-font-link-active-theme" class="input" placeholder="Black Min CMS" value="<?php echo $color_font_link_active_theme ?>" noclear="true" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-60 " >
            <span class="tsr-vertical-align-sub">
                Kolor Czcionki Linku Motywu:
            </span>
            <span class="tsr-vertical-align-sub fs-70">
                Po Odwiedzeniu Strony
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="color" name="color-font-link-visited-theme" class="input" placeholder="Black Min CMS" value="<?php echo $color_font_link_visited_theme ?>" noclear="true" autocomplete="off"/>
        </section>
    </section>

    <section class="tsr tsr-inp tsr-mt-50">
        <button type="button" class="submit" action="update" url="Menu" id="submit_data" >Zapisz ustawienia</button>
    </section>	

    <section class="tsr tsr-inp tsr-mt-50">
        <div id="blackminsend_container"></div>
    </section>				

</form>	
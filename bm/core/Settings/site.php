<form accept-charset="UTF-8"  action="add" url="Settings" method="post" id="blackminsend" autocomplete="off">	
					
    <section class="tsr-inp"></section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Tytuł Witryny:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="tytul_witryny" class="input" placeholder="Black Min CMS" value="<?php echo BM_SETTINGS["bm_name_site"]; ?>" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Opis Witryny:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <textarea name="opis_witryny" rows="10" cols="80" placeholder="Wpisz Opis" autocomplete="off"><?php echo BM_SETTINGS["bm_description_site"]; ?></textarea>
        </section>
    </section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Słowa Kluczone Witryny:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="slowa_kluczowe_witryny" class="input" placeholder="Black Min CMS" value="<?php echo BM_SETTINGS["bm_keywords"]; ?>" autocomplete="off"/>
            <label class="fs-70">Słowa kluczowe odzielone po "," przecinku.</label>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Ikona Witryny:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="icone_ico_witryny" class="input" placeholder="Black Min" value="<?php echo BM_SETTINGS["bm_icon_site"]; ?>" autocomplete="off"/>
            <label class="fs-70">Typ pliku (.ico).</label>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Ikona Witryny:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="icone_witryny" class="input" placeholder="Black Min" value="<?php echo BM_SETTINGS["bm_icon_png_site"]; ?>" autocomplete="off"/>
            <label class="fs-70">Typ pliku (.png, .jpg).</label>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Logo Witryny:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="logo_witryny" class="input" placeholder="Black Min" value="<?php echo BM_SETTINGS["bm_logo"]; ?>" autocomplete="off"/>
            <label class="fs-70">Typ pliku (.png, jpg, itp).</label>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Banner Witryny:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="banner_witryny" class="input" placeholder="Black Min" value="<?php echo BM_SETTINGS["bm_banner"]; ?>" autocomplete="off"/>
            <label class="fs-70">Typ pliku (.png, .jpg, itp).</label>
        </section>
    </section>	
    <section class="tsr tsr-inp tsr-mt-50">
        <button type="button" value="Wykonaj akcję!" class="input buttom submit_data" action="categorytag" id="submit_data">Wykonaj akcję!</button>
    </section>	
    
    <section class="tsr tsr-inp tsr-mt-50">
        <div id="blackminsend_container"></div>
    </section>			
    
</form>	
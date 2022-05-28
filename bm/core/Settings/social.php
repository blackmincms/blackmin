<form accept-charset="UTF-8"  action="add" url="Settings" method="post" id="blackminsend" autocomplete="off">	
					
    <section class="tsr-inp"></section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-70 " >
            <span class="tsr-vertical-align-sub">
                Skrócona Polityka Prywatnośći:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="bm_spolecznosc_opis" class="input" placeholder="Black Min CMS" value="<?php echo BM_SETTINGS["bm_cookie_description"]; ?>" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-70 " >
            <span class="tsr-vertical-align-sub">
                Link do Polityki Prywatnośći:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="bm_spolecznosc_link" class="input" placeholder="Black Min CMS" value="<?php echo BM_SETTINGS["bm_cookie_link"]; ?>" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-70 " >
            <span class="tsr-vertical-align-sub">
                Link do Informacji o Ciasteczkach:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="bm_spolecznosc_link_info_cookies" class="input" placeholder="Black Min CMS" value="<?php echo BM_SETTINGS["bm_cookie_privacy_policy_link"]; ?>" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-70 " >
            <span class="tsr-vertical-align-sub">
                Tekst Akceptujący Ciasteczka:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="bm_spolecznosc_text_akcept" class="input" placeholder="Black Min CMS" value="<?php echo BM_SETTINGS["bm_cookie_accept"]; ?>" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr tsr-inp tsr-mt-50">
        <button type="button" value="Wykonaj akcję!" class="input buttom submit_data" action="categorytag" id="submit_data">Wykonaj akcję!</button>
    </section>	
    
    <section class="tsr tsr-inp tsr-mt-50">
        <div id="blackminsend_container"></div>
    </section>			
    
</form>	
<form accept-charset="UTF-8"  action="add" url="Settings" method="post" id="blackminsend" autocomplete="off">	
					
    <section class="tsr-inp"></section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Url Serwera Black Min:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="url" name="url_serwera_bm" class="input" placeholder="Black Min" value="" autocomplete="off"/>
        </section>
    </section>	
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Url Witryny Black Min:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="url" name="url_witryny_bm" class="input" placeholder="Black Min CMS" value="" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Adres email Witryny:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="email" name="mail_witryny" class="input" placeholder="Black Min CMS" value="" autocomplete="off"/>
            <label class="fs-70">Mail będzie używany do celach administracyjnych i powiadomień.</label>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Domyśna rola nowych użytkowników:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <select name="ranga_bm" class="select" utocomplete="off">
                <option value="współpracownik">Współpracownik</option>
                <option value="redaktor">Redaktor</option>
                <option value="moderator">Moderator</option>
                <option value="administrator" >Administrator</option>
                <option value="właśćiciel" >Właśćiciel</option>
            </select>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Język Witryny:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <select name="jezyk_witryny" class="select" utocomplete="off">
                <option value="pl_PL">Polski</option>
            </select>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Strfa Czasowa:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <select name="strefa_czasowa_witryny" class="select" utocomplete="off">
                <option value="Europe/Warsaw">Warszawa</option>
            </select>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Format Daty:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="date_witryny" class="input" placeholder="m.d.Y" value="" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Format Godziny:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="time_witryny" class="input" placeholder="H:i" value="" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Nick Głównego Administratora Witryny:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="admin_witryny" class="input" placeholder="Black Min" value="<?php echo BM_STATUS["bm_installation_admin"]; ?>" autocomplete="off"/>
            <label class="fs-70">Nick głównego administratora witryny. Będzie on wykorzystywany do kontaktu w razie problemów z stroną (Dostęp Tylko dla administracji).</label>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Email Głównego Administratora Witryny:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="email" name="email_admin_witryny" class="input" placeholder="Black Min" value="<?php echo BM_STATUS["bm_admin_mail"]; ?>" autocomplete="off"/>
            <label class="fs-70">Email głównego administratora witryny. Będzie on wykorzystywany do kontaktu w razie problemów z stroną (Będzie wyświetlany w razie ploblemów z witryną).</label>
        </section>
    </section>
    <section class="tsr tsr-inp tsr-mt-50">
        <button type="button" value="Wykonaj akcję!" class="input buttom submit_data" action="categorytag" id="submit_data">Wykonaj akcję!</button>
    </section>	
    
    <section class="tsr tsr-inp tsr-mt-50">
        <div id="blackminsend_container"></div>
    </section>			
    
</form>	
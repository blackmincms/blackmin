<form accept-charset="UTF-8"  action="add" url="Settings" method="post" id="blackminsend" autocomplete="off">	
					
    <section class="tsr-inp"></section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Tryb Konserwacji:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <select name="tryb" class="select tryb" autocomplete="off">
                <option value="false">nie</option>
                <option value="true">tak</option>
            </select>
        </section>
    </section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Tytuł Konserwacji:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="tryb_tytul" class="input" placeholder="Black Min CMS" value="" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Opis Konserwacji:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <textarea name="tryb_opis" rows="10" cols="80" placeholder="Wpisz Opis" autocomplete="off"></textarea>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Czas Trwania Konserwacji:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="datetime-local" name="tryb_datetime" class="input" placeholder="Black Min" value="" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr tsr-inp tsr-mt-50">
        <button type="button" value="Wykonaj akcję!" class="input buttom submit_data" action="categorytag" id="submit_data">Wykonaj akcję!</button>
    </section>	
    
    <section class="tsr tsr-inp tsr-mt-50">
        <div id="blackminsend_container"></div>
    </section>			
    
</form>	
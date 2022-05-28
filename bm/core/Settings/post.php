<form accept-charset="UTF-8"  action="add" url="Settings" method="post" id="blackminsend" autocomplete="off">	
					
    <section class="tsr-inp"></section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Domyśny Status Postów:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <select name="domysny_status_posta" id="status_post">
                <option value="public">Publiczny</option>
                <option value="private">Prywatny</option>
                <option value="protect_password" >Zabezpieczony hasłem</option>
                <option value="szkic" >szkic</option>
            </select>
        </section>
    </section>
    <section class="tsr">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Domyśny Format posta:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <select name="domysny_format_posta" id="format_post">
                <option value="post">zwykły post</option>
                <option value="info">informacja</option>
                <option value="wazne_info">ważna informacja</option>
                <option value="ostrzezenie">ostrzeżenie</option>
                <option value="najwazniejsze_info">najważniejsza informacja</option>
            </select>
        </section>
    </section>
    <section class="tsr">					
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Domyśne Ładowanie Postów:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="number" name="domysne_laduj_posty" class="input" placeholder="Black Min" value="" autocomplete="off"/>
        </section>
    </section>

    <section class="tsr tsr-inp tsr-mt-50">
        <button type="button" value="Wykonaj akcję!" class="input buttom submit_data" action="categorytag" id="submit_data">Wykonaj akcję!</button>
    </section>	
    
    <section class="tsr tsr-inp tsr-mt-50">
        <div id="blackminsend_container"></div>
    </section>			
    
</form>	
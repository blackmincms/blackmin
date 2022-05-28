<form accept-charset="UTF-8"  action="update" url="user" method="post" id="blackminsend" autocomplete="off">	
					
    <section class="tsr-inp"></section>
 
    <section class="tsr nick">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Nick:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="nick" class="input tsr-display-none bm-toogle-edit" placeholder="nick" autocomplete="off" value=""/>
            <div class="tsr tsr-fl tsr-text-algin-left bm-toogle-edit nick_view">
            </div>
        </section>
    </section>	
    <section class="tsr imie">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Imie:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="imie" class="input tsr-display-none bm-toogle-edit" placeholder="imie" autocomplete="off" value=""/>
            <div class="tsr tsr-fl tsr-text-algin-left bm-toogle-edit imie_view">
            </div>
        </section>
    </section>
    <section class="tsr nazwisko">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Nazwisko:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="nazwisko" class="input tsr-display-none bm-toogle-edit" placeholder="imie" autocomplete="off" value=""/>
            <div class="tsr tsr-fl tsr-text-algin-left bm-toogle-edit nazwisko_view">
            </div>
        </section>
    </section>
    <section class="tsr ">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Avatar:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="text" name="avatar" class="input tsr-display-none bm-toogle-edit" placeholder="avatar" autocomplete="off" value=""/>
            <div class="tsr tsr-fl tsr-text-algin-left bm-toogle-edit tsr-width-100 tsr-height-100 avatar_view img">
            </div>
        </section>
    </section>
    <section class="tsr mail">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Mail:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="email" name="mail" class="input tsr-display-none bm-toogle-edit" placeholder="mail" autocomplete="off" value=""/>
            <div class="tsr tsr-fl tsr-text-algin-left bm-toogle-edit mail_view">
            </div>
        </section>
    </section>
    <section class="tsr plec bm-toogle-edit" >
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Płeć:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <div class="tsr tsr-fl tsr-text-algin-left płeć">
            </div>
        </section>
    </section>
    <section class="tsr date_dolonczenia bm-toogle-edit">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Data dołączenia:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <div class="tsr tsr-fl tsr-text-algin-left data">
            </div>
        </section>
    </section>
    <section class="tsr dostep">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Dostęp:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <select name="dostep" class="tsr-display-none bm-toogle-edit">
                <option value="aktywacja_konta">Aktywacja Konta</option>
                <option value="dostęp">Dostęp</option>
                <option value="brak_dostępu">Brak Dostępu</option>
                <option value="zawieszony" >Zawieszony</option>
                <option value="zablokowany" >Zablokowany</option>
                <option value="zbanowany" >Zbanowany</option>
            </select>
            <div class="tsr tsr-fl tsr-text-algin-left bm-toogle-edit dostep_view">
            </div>
        </section>
    </section>
    <section class="tsr ranga">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Ranga:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <select name="ranga" class="tsr-display-none bm-toogle-edit">
                <option value="współpracownik">Współpracownik</option>
                <option value="redaktor">Redaktor</option>
                <option value="moderator">Moderator</option>
                <option value="administrator" >Administrator</option>
                <option value="właśćiciel" >Właśćiciel</option>
            </select>
            <div class="tsr tsr-fl tsr-text-algin-left bm-toogle-edit ranga_view">
            </div>
        </section>
    </section>
    <section class="tsr online bm-toogle-edit">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Online:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <div class="tsr tsr-fl tsr-text-algin-left online">
            </div>
        </section>
    </section>
    <section class="tsr ostatnio_aktywny bm-toogle-edit">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Ostatnio Aktywny:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <div class="tsr tsr-fl tsr-text-algin-left aktywny">
            </div>
        </section>
    </section>	
    <section class="tsr haslo tsr-display-none bm-toogle-edit">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Hasło:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="password" name="haslo" class="input" placeholder="hasło" autocomplete="off"/>
        </section>
    </section>
    <section class="tsr haslo2 tsr-display-none bm-toogle-edit">
        <section class="col-inp-25 tsr-p-10px fs-90 " >
            <span class="tsr-vertical-align-sub">
                Powtórz Hasło:
            </span>
        </section>
        <section class="col-inp-75 tsr-p-10px fs-90" >
            <input type="password" name="haslo2" class="input" placeholder="hasło" autocomplete="off"/>
        </section>
    </section>
    
    <section class="tsr tsr-inp tsr-mt-50">
        <button type="button" value="Edytuj Dane!" class="input buttom" id="edit_date">Edytuj Dane!</button>
    </section>
    
    <section class="tsr tsr-inp tsr-mt-10 tsr-display-none bm-toogle-edit">
        <button type="button" value="Wykonaj akcję!" class="input buttom submit_data" action="user" id="submit_data">Wykonaj akcję!</button>
    </section>	
    
    <section class="tsr tsr-inp tsr-mt-50">
        <div id="blackminsend_container"></div>
    </section>			
    
</form>	
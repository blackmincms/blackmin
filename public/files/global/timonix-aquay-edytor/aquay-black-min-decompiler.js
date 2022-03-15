/*
@
@		>>>> AQUAY <<<<
@
@	Timonix Aquay Edytor
@	Edytor Tekstowy i blokowy
@	Versja: beta 0.4
@	Autor: Timonix
@  Cobright: Wszelkie prawa zasczeżone 
@
@		>>>> AQUAY <<<<
@
*/
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do de-kompilowania kodu zrozumiałego dla edytora aquay
	
	Black Min cms,
	
	#plik: 1.4
*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	function decompiler_aquay_black_min(text) {
		
		// tworzenie zmienych text i edit_text to puźniejszego sprawdzenia poprawnośći w kompilowaniu
		var text = text;
		
		// informacja o rozpoczęciu kompilowania przez kompilator aquay > black min
		console.info("DeKompilowanie kodu: " + aquay);
		
		// DeKompilowanie kodu zrozumiałego dla black min'aLinkcolor

		// usuwanie komentarzy (znaczników) na których opiera się wyświetlanie postów Black Mina 
		text = text.replace("<!-- koniec text -->", "");
		text = text.replace("<!-- poczatek text / type-text / Black Min cms  -->", "");
		text = text.replace("<!-- koniec cytat -->", "");
		text = text.replace("<!-- poczatek cytat / type-cytat / Black Min cms  -->", "");
		text = text.replace("<!-- koniec naglowek -->", "");
		text = text.replace("<!-- poczatek naglowek / type-naglowek / Black Min cms  -->", "");
		text = text.replace("<!-- poczatek kod / type-kod / Black Min cms  -->", "");
		text = text.replace("<!-- koniec kod -->", "");
		text = text.replace("<!-- poczatek wlasny kod / type-wlasny-kod / Black Min cms  -->", "");
		text = text.replace("<!-- koniec wlasny kod -->", "");
		text = text.replace("<!-- koniec obrazek -->", "");
		text = text.replace("<!-- poczatek obrazek / type-obrazek / Black Min cms  -->", "");
		text = text.replace("<!-- koniec galeria -->", "");
		text = text.replace("<!-- poczatek galeria / type-galeria / Black Min cms  -->", "");
		text = text.replace("<!-- koniec plik -->", "");
		text = text.replace("<!-- poczatek plik / type-plik / Black Min cms  -->", "");
		
		// tworzenie diva na którym będziemy przeprowadzać kompilacje 
		
		var add_element_decompiler = document.createElement("aquay_decompiler");
		
		add_element_decompiler.setAttribute('aquay_decompiler', "kompiler aquay / black min");
		add_element_decompiler.setAttribute('id', "decompiler_aquay_black_min");
		add_element_decompiler.setAttribute('class', "aquay-decompiler");
		add_element_decompiler.innerHTML = text;
		
		$("body").append(add_element_decompiler);
		
		// DeKompilowanie czystego tekstu (akapita)	
		// tworzenie diva który przechowa nam tekst do edycj
		const add_edytuj_text = document.createElement("div");

		add_edytuj_text.innerText = "edytuj text";
		add_edytuj_text.classList.add("aquay-type-title");
		
		$("#decompiler_aquay_black_min").find(".blackmin-text").addClass("aquay-edytor-text aquay-edytuj-text");
		$("#decompiler_aquay_black_min").find(".aquay-edytor-text").removeClass("blackmin-text");
		$("#decompiler_aquay_black_min").find(".aquay-edytor-text").wrap('<div class="aquay-edytuj-container" data-blok-type="type_blok/text">');
		$("#decompiler_aquay_black_min").find(".aquay-edytor-text").closest(".aquay-edytuj-container").prepend(add_edytuj_text);
		$("#decompiler_aquay_black_min").find(".aquay-edytor-text").attr("contenteditable", "true").attr("tabindex", "0");
		
		// DeKompilowanie cytatu
		// tworzenie diva który przechowa nam tekst do edycj
		const add_edytuj_cytat = document.createElement("div");

		add_edytuj_cytat.innerText = "edytuj cytat";
		add_edytuj_cytat.classList.add("aquay-type-title");
		
		$("#decompiler_aquay_black_min").find(".blackmin-cytat").addClass("aquay-edytor-cytat aquay-edytuj-text");
		$("#decompiler_aquay_black_min").find(".aquay-edytor-cytat").removeClass("blackmin-cytat");
		$("#decompiler_aquay_black_min").find(".aquay-edytor-cytat").wrap('<div class="aquay-edytuj-container" data-blok-type="type_blok/cytat">');
		$("#decompiler_aquay_black_min").find(".aquay-edytor-cytat").closest(".aquay-edytuj-container").prepend(add_edytuj_cytat);
		$("#decompiler_aquay_black_min").find(".aquay-edytor-cytat").attr("contenteditable", "true").attr("tabindex", "0");
		
		// DeKompilowanie nagłówka
		// tworzenie diva który przechowa nam tekst do edycj
		const add_edytuj_naglowek = document.createElement("div");

		add_edytuj_naglowek.innerText = "edytuj nagłówek";
		add_edytuj_naglowek.classList.add("aquay-type-title");
		
		$("#decompiler_aquay_black_min").find(".blackmin-naglowek").addClass("aquay-edytor-naglowek aquay-edytuj-text");
		$("#decompiler_aquay_black_min").find(".aquay-edytor-naglowek").removeClass("blackmin-naglowek");
		$("#decompiler_aquay_black_min").find(".aquay-edytor-naglowek").wrap('<div class="aquay-edytuj-container" data-blok-type="type_blok/cytat">');
		$("#decompiler_aquay_black_min").find(".aquay-edytor-naglowek").closest(".aquay-edytuj-container").prepend(add_edytuj_naglowek);
		$("#decompiler_aquay_black_min").find(".aquay-edytor-naglowek").attr("contenteditable", "true").attr("tabindex", "0");
		
		// DeKompilowanie kodu
		const add_edytuj_kod = document.createElement("div");

		add_edytuj_kod.innerText = "edytuj kod";
		add_edytuj_kod.classList.add("aquay-type-title");
		
		$("#decompiler_aquay_black_min").find(".blackmin-kod").addClass("aquay-edytor-kod aquay-edytuj-text");
		$("#decompiler_aquay_black_min").find(".aquay-edytor-kod").removeClass("blackmin-kod");
		$("#decompiler_aquay_black_min").find(".aquay-edytor-kod").wrap('<div class="aquay-edytuj-container" data-blok-type="type_blok/kod">');
		$("#decompiler_aquay_black_min").find(".aquay-edytor-kod").closest(".aquay-edytuj-container").prepend(add_edytuj_kod);
		$("#decompiler_aquay_black_min").find(".aquay-edytor-kod").attr("contenteditable", "true").attr("tabindex", "0");				
		
		// DeKompilowanie własnego kodu html
		const add_edytuj_wlasny_kod = document.createElement("div");

		add_edytuj_wlasny_kod.innerText = "edytuj własny kod html";
		add_edytuj_wlasny_kod.classList.add("aquay-type-title");
		
		$("#decompiler_aquay_black_min").find(".blackmin-wlasny-kod").addClass("aquay-edytor-wlasny_kod aquay-edytuj-text");
		$("#decompiler_aquay_black_min").find(".aquay-edytor-wlasny_kod").removeClass("blackmin-wlasny-kod");
		$("#decompiler_aquay_black_min").find(".aquay-edytor-wlasny_kod").wrap('<div class="aquay-edytuj-container" data-blok-type="type_blok/wlasny_kod">');
		$("#decompiler_aquay_black_min").find(".aquay-edytor-wlasny_kod").closest(".aquay-edytuj-container").prepend(add_edytuj_wlasny_kod);
		$("#decompiler_aquay_black_min").find(".aquay-edytor-wlasny_kod").attr("contenteditable", "true").attr("tabindex", "0");
		
		// DeKompilowanie obrazka
		const add_edytuj_obrazek = document.createElement("div");

		add_edytuj_obrazek.innerText = "edytuj obrazek";
		add_edytuj_obrazek.classList.add("aquay-type-title");
		
		// tworzenie butona do dodawania mediów z dysku bm
		const add_button_media_obrazek = document.createElement("div");

		add_button_media_obrazek.innerText = "Dodaj z Dysku";
		add_button_media_obrazek.classList.add("aquay-add-media");
		add_button_media_obrazek.classList.add("aquay-top-separator");
		add_button_media_obrazek.classList.add("tsr-xpmodal");
		add_button_media_obrazek.setAttribute("id", "aquay_" + aquay_add_klucz);
		add_button_media_obrazek.setAttribute("aquay-multiply", "false");
		add_button_media_obrazek.setAttribute("aquay-obiect-put", ".aquay_" + aquay_add_klucz);
		add_button_media_obrazek.setAttribute("aquay-type", "image");
		add_button_media_obrazek.setAttribute("aquay-obiect-type", "img");
		
		$("#decompiler_aquay_black_min").find(".blackmin-container-obrazek").addClass("aquay-obrazek");
		$("#decompiler_aquay_black_min").find(".aquay-obrazek").removeClass("blackmin-container-obrazek");		
		$("#decompiler_aquay_black_min").find(".aquay-obrazek").wrap('<div class="aquay-edytuj-container" data-blok-type="type_blok/obrazek"></div>').wrap('<div class="aquay-edytor-obrazek aquay-edytuj-obrazek" data-type="type/obrazek" tabindex="0"></div>').wrap('<div class="aquay-load-obrazek aquay-top-separator aquay_'+ aquay_add_klucz +'"></div>');	
		$(".blackmin-obrazek").find(".aquay-edytuj-container").unwrap("<div>");
		$("#decompiler_aquay_black_min").find(".aquay-edytor-obrazek").closest(".aquay-edytuj-container").prepend(add_edytuj_obrazek);
		$("#decompiler_aquay_black_min").find(".aquay-edytor-obrazek").prepend(add_button_media_obrazek);
		$("#decompiler_aquay_black_min").find(".aquay-edytor-obrazek").prepend('<div class="aquay-obrazek-url">');
		$("#decompiler_aquay_black_min").find(".aquay-edytor-obrazek").find('.aquay-obrazek-url').append('<div class="aquay-input-title">Wklej własny obrazek</div><input type="url" name="aquay-url-paste" class="input aquay-input aquay-link" placeholder="Wklej własny obrazek" autocomplete="off">');
		$("#decompiler_aquay_black_min").find(".aquay-edytor-obrazek").find('.aquay-add-media').append('<div class="tsr-modal"><section class="tsr load-data"><section class="tsr-alert tsr-alert-info">Ładowanie danych</section></section></div>');
	
		aquay_add_klucz++;
	
		// DeKompilowanie galeria
		const add_edytuj_galeria = document.createElement("div");

		add_edytuj_galeria.innerText = "edytuj galerie";
		add_edytuj_galeria.classList.add("aquay-type-title");
		
		// tworzenie butona do dodawania mediów z dysku bm
		const add_button_media_galeria = document.createElement("div");

		add_button_media_galeria.innerText = "Dodaj z Dysku";
		add_button_media_galeria.classList.add("aquay-add-media");
		add_button_media_galeria.classList.add("aquay-top-separator");
		add_button_media_galeria.classList.add("tsr-xpmodal");
		add_button_media_galeria.setAttribute("id", "aquay_" + aquay_add_klucz);
		add_button_media_galeria.setAttribute("aquay-multiply", "true");
		add_button_media_galeria.setAttribute("aquay-obiect-put", ".aquay_" + aquay_add_klucz);
		add_button_media_galeria.setAttribute("aquay-type", "image");
		add_button_media_galeria.setAttribute("aquay-obiect-type", "img");
		
		$("#decompiler_aquay_black_min").find(".blackmin-container-galeria").addClass("aquay-galeria");
		$("#decompiler_aquay_black_min").find(".aquay-galeria").removeClass("blackmin-container-galeria");
		$("#decompiler_aquay_black_min").find(".blackmin-galeria").attr("tabindex", "0").addClass("aquay-edytor-galeria aquay-edytuj-galerie");
		$("#decompiler_aquay_black_min").find(".aquay-edytor-galeria").removeClass(".blackmin-galeria").wrapInner('<div class="aquay-load-galeria aquay-top-separator aquay_'+ aquay_add_klucz +'"></div>');
		$("#decompiler_aquay_black_min").find(".aquay-edytor-galeria").removeClass(".blackmin-galeria");
		$("#decompiler_aquay_black_min").find(".aquay-edytor-galeria").prepend(add_button_media_galeria);
		$("#decompiler_aquay_black_min").find(".aquay-edytor-galeria").wrap('<div class="aquay-edytuj-container" data-blok-type="type_blok/galeria"></div>');
		$("#decompiler_aquay_black_min").find(".aquay-edytor-galeria").closest(".aquay-edytuj-container").prepend(add_edytuj_galeria);		
		$("#decompiler_aquay_black_min").find(".aquay-edytor-galeria").find('.aquay-add-media').append('<div class="tsr-modal"><section class="tsr load-data"><section class="tsr-alert tsr-alert-info">Ładowanie danych</section></section></div>');

		aquay_add_klucz++;
		
		// DeKompilowanie pobierz plik
		const add_edytuj_plik = document.createElement("div");

		add_edytuj_plik.innerText = "pobierz plik";
		add_edytuj_plik.classList.add("aquay-type-title");
		
		// tworzenie butona do dodawania mediów z dysku bm
		const add_button_media_plik = document.createElement("div");

		add_button_media_plik.innerText = "Dodaj z Dysku";
		add_button_media_plik.classList.add("aquay-add-media");
		add_button_media_plik.classList.add("aquay-top-separator");
		add_button_media_plik.classList.add("tsr-xpmodal");
		add_button_media_plik.setAttribute("id", "aquay_" + aquay_add_klucz);
		add_button_media_plik.setAttribute("aquay-multiply", "true");
		add_button_media_plik.setAttribute("aquay-obiect-put", ".aquay_" + aquay_add_klucz);
		add_button_media_plik.setAttribute("aquay-type", "all");
		add_button_media_plik.setAttribute("aquay-obiect-type", "text");
		
		$("#decompiler_aquay_black_min").find(".blackmin-button-plik").addClass("aquay-load-plik aquay-top-separator aquay-edytuj-text aquay-input aquay-button-pobierz aquay_" + aquay_add_klucz).attr("contenteditable", "true");
		$("#decompiler_aquay_black_min").find(".aquay-button-pobierz").removeClass("blackmin-button-plik");
		
		$("#decompiler_aquay_black_min").find(".blackmin-plik").attr("tabindex", "0").addClass("aquay-edytor-plik aquay-edytuj-plik");
		$("#decompiler_aquay_black_min").find(".aquay-edytor-plik").removeClass(".blackmin-plik");
		
		$("#decompiler_aquay_black_min").find(".aquay-edytor-plik").prepend(add_button_media_plik);
		$("#decompiler_aquay_black_min").find(".aquay-edytor-plik").wrap('<div class="aquay-edytuj-container" data-blok-type="type_blok/plik"></div>');
		$("#decompiler_aquay_black_min").find(".aquay-edytor-plik").closest(".aquay-edytuj-container").prepend(add_edytuj_plik);		
		$("#decompiler_aquay_black_min").find(".aquay-edytor-plik").find('.aquay-add-media').append('<div class="tsr-modal"><section class="tsr load-data"><section class="tsr-alert tsr-alert-info">Ładowanie danych</section></section></div>');		
		
		aquay_add_klucz++;
		
		// informacja o Wstawianie danych przez komilator aquay > black min
		console.info("Wstawianie informacji o pośćie i komilowanych danych: " + aquay);
		
		// informacja o Wstawianie danych przez komilator aquay > black min
		console.info("Wstawianie informacji o kodzie: " + aquay);
		
		// pobieranie skompilowanego kodu i zwrucenie go 
		var aquay_blackmin_get_comilate_kod = $("#decompiler_aquay_black_min").find("blackmin_kod").html();
		
		// usuwanie komilatora aquay > black min 
		$("#decompiler_aquay_black_min").remove();
		
		// informacja o zakończeniu kompilowania przez komilator aquay > black min
		console.info("Zakończono dekomilowanie kodu: " + aquay);
		
		return aquay_blackmin_get_comilate_kod;
		
	}
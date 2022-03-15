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
	
	ten plik służy do kompilowania kody zrozumiałego dla black min'a
	
	Black Min cms,
	
	#plik: 1.4
*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	function compiler_aquay_black_min(text) {
		
		// tworzenie zmienych text i edit_text to puźniejszego sprawdzenia poprawnośći w kompilowaniu
		var text_sprawdz = text;
		var edit_text = text;
		
		// informacja o rozpoczęciu kompilowania przez kompilator aquay > black min
		console.info("Kompilowanie kodu: " + aquay);
		
		// kompilowanie kodu zrozumiałego dla black min'aLinkcolor
		
		// tworzenie diva na którym będziemy przeprowadzać kompilacje 
		
		var add_element_compiler = document.createElement("aquay_compiler");
		
		add_element_compiler.setAttribute('aquay_compiler', "kompiler aquay / black min");
		add_element_compiler.setAttribute('id', "compiler_aquay_black_min");
		add_element_compiler.setAttribute('class', "aquay-compiler");
		add_element_compiler.innerHTML = text;
		
		$("html").append(add_element_compiler);
		
		// kompilowanie czystego tekstu (akapita)
		$("#compiler_aquay_black_min").find(".aquay-edytor-text").unwrap("<div>");
		$("#compiler_aquay_black_min").find(".aquay-type-title").remove();
		$("#compiler_aquay_black_min").find(".aquay-edytor-text").removeAttr("contenteditable").removeAttr("tabindex").removeClass("aquay-edytuj-text");
		$("#compiler_aquay_black_min").find(".aquay-edytor-text").addClass("blackmin-text");
		$("#compiler_aquay_black_min").find(".blackmin-text").removeClass("aquay-edytor-text");
		$("#compiler_aquay_black_min").find(".blackmin-text").after("<!-- koniec text ");
		$("#compiler_aquay_black_min").find(".blackmin-text").before("<!-- poczatek text / type-text / Black Min cms  ");
		
		// kompilowanie cytatu
		$("#compiler_aquay_black_min").find(".aquay-edytor-cytat").unwrap("<div>");
		$("#compiler_aquay_black_min").find(".aquay-type-title").remove();
		$("#compiler_aquay_black_min").find(".aquay-edytor-cytat").removeAttr("contenteditable").removeAttr("tabindex").removeClass("aquay-edytuj-text");
		$("#compiler_aquay_black_min").find(".aquay-edytor-cytat").addClass("blackmin-cytat");
		$("#compiler_aquay_black_min").find(".blackmin-cytat").removeClass("aquay-edytor-cytat");
		$("#compiler_aquay_black_min").find(".blackmin-cytat").after("<!-- koniec cytat ");
		$("#compiler_aquay_black_min").find(".blackmin-cytat").before("<!-- poczatek cytat / type-cytat / Black Min cms  ");
		
		// kompilowanie nagłówka
		$("#compiler_aquay_black_min").find(".aquay-edytor-naglowek").unwrap("<div>");
		$("#compiler_aquay_black_min").find(".aquay-type-title").remove();
		$("#compiler_aquay_black_min").find(".aquay-edytor-naglowek").removeAttr("contenteditable").removeAttr("tabindex").removeClass("aquay-edytuj-text");
		$("#compiler_aquay_black_min").find(".aquay-edytor-naglowek").addClass("blackmin-naglowek");
		$("#compiler_aquay_black_min").find(".blackmin-naglowek").removeClass("aquay-edytor-naglowek");
		$("#compiler_aquay_black_min").find(".blackmin-naglowek").after("<!-- koniec naglowek ");
		$("#compiler_aquay_black_min").find(".blackmin-naglowek").before("<!-- poczatek naglowek / type-naglowek / Black Min cms  ");
		
		// kompilowanie kodu
		$("#compiler_aquay_black_min").find(".aquay-edytor-kod").unwrap("<div>");
		$("#compiler_aquay_black_min").find(".aquay-type-title").remove();
		$("#compiler_aquay_black_min").find(".aquay-edytor-kod").removeAttr("contenteditable").removeAttr("tabindex").removeClass("aquay-edytuj-text");
		$("#compiler_aquay_black_min").find(".aquay-edytor-kod").addClass("blackmin-kod");
		$("#compiler_aquay_black_min").find(".blackmin-kod").removeClass("aquay-edytor-kod");
		$("#compiler_aquay_black_min").find(".blackmin-kod").after("<!-- koniec kod ");
		$("#compiler_aquay_black_min").find(".blackmin-kod").before("<!-- poczatek kod / type-kod / Black Min cms  ");
		
		// kompilowanie własnego kodu html
		$("#compiler_aquay_black_min").find(".aquay-edytor-wlasny_kod").unwrap("<div>");
		$("#compiler_aquay_black_min").find(".aquay-type-title").remove();
		$("#compiler_aquay_black_min").find(".aquay-edytor-wlasny_kod").removeAttr("contenteditable").removeAttr("tabindex").removeClass("aquay-edytuj-text");
		$("#compiler_aquay_black_min").find(".aquay-edytor-wlasny_kod").addClass("blackmin-wlasny-kod");
		$("#compiler_aquay_black_min").find(".blackmin-wlasny-kod").removeClass("aquay-edytor-wlasny_kod");
		$("#compiler_aquay_black_min").find(".blackmin-wlasny-kod").after("<!-- koniec wlasny kod ");
		$("#compiler_aquay_black_min").find(".blackmin-wlasny-kod").before("<!-- poczatek wlasny kod / type-wlasny-kod / Black Min cms  ");
		
		// kompilowanie obrazka
		$("#compiler_aquay_black_min").find(".aquay-edytor-obrazek").unwrap("<div>");
		$("#compiler_aquay_black_min").find(".aquay-galeria").unwrap("<div>");
		$("#compiler_aquay_black_min").find(".aquay-type-title").remove();
		$("#compiler_aquay_black_min").find(".aquay-add-media").remove();
		$("#compiler_aquay_black_min").find(".aquay-edytor-obrazek").removeAttr("contenteditable").removeAttr("tabindex").removeClass("aquay-edytuj-obrazek");
		$("#compiler_aquay_black_min").find(".aquay-edytor-obrazek").addClass("blackmin-obrazek");
		$("#compiler_aquay_black_min").find(".blackmin-obrazek").removeClass("aquay-edytor-obrazek");
		$("#compiler_aquay_black_min").find(".blackmin-obrazek").find("img").addClass("blackmin-container-obrazek");
		$("#compiler_aquay_black_min").find(".blackmin-container-obrazek").removeClass("aquay-obrazek");
		$("#compiler_aquay_black_min").find(".blackmin-container-obrazek").unwrap("<div>");
		$("#compiler_aquay_black_min").find(".blackmin-obrazek").after("<!-- koniec obrazek ");
		$("#compiler_aquay_black_min").find(".blackmin-obrazek").before("<!-- poczatek obrazek / type-obrazek / Black Min cms  ");
		
		// kompilowanie galeria
		$("#compiler_aquay_black_min").find(".aquay-edytor-galeria").unwrap("<div>");
		$("#compiler_aquay_black_min").find(".aquay-obrazek").unwrap("<div>");
		$("#compiler_aquay_black_min").find(".aquay-type-title").remove();
		$("#compiler_aquay_black_min").find(".aquay-obrazek-url").remove();
		$("#compiler_aquay_black_min").find(".aquay-add-media").remove();
		$("#compiler_aquay_black_min").find(".aquay-edytor-galeria").removeAttr("contenteditable").removeAttr("tabindex").removeClass("aquay-edytuj-galerie");
		$("#compiler_aquay_black_min").find(".aquay-edytor-galeria").addClass("blackmin-galeria");
		$("#compiler_aquay_black_min").find(".aquay-edytor-galeria").find("img").addClass("blackmin-container-galeria").removeClass("aquay-galeria");
		$("#compiler_aquay_black_min").find(".blackmin-galeria").removeClass("aquay-edytor-galeria");
		$("#compiler_aquay_black_min").find(".blackmin-galeria").after("<!-- koniec galeria ");
		$("#compiler_aquay_black_min").find(".blackmin-galeria").before("<!-- poczatek galeria / type-galeria / Black Min cms  ");
		
		// kompilowanie pobierz plik
		$("#compiler_aquay_black_min").find(".aquay-edytor-plik").unwrap("<div>");
		$("#compiler_aquay_black_min").find(".aquay-type-title").remove();
		$("#compiler_aquay_black_min").find(".aquay-add-media").remove();
		$("#compiler_aquay_black_min").find(".aquay-edytor-plik").removeAttr("contenteditable").removeAttr("tabindex").removeClass("aquay-edytuj-plik");
		$("#compiler_aquay_black_min").find(".aquay-edytor-plik").addClass("blackmin-plik");
		$("#compiler_aquay_black_min").find(".blackmin-plik").removeClass("aquay-edytor-plik");
		$("#compiler_aquay_black_min").find(".blackmin-plik").find("button").removeAttr("class").addClass("blackmin-button-plik").removeAttr("contenteditable").removeAttr("tabindex").removeAttr("tabindex");
		$("#compiler_aquay_black_min").find(".blackmin-plik").after("<!-- koniec plik ");
		$("#compiler_aquay_black_min").find(".blackmin-plik").before("<!-- poczatek plik / type-plik / Black Min cms  ");
		
		// informacja o pobieranie danych przez komilator aquay > black min
		console.info("Pobieranie informacji o pośćie i komilowanych danych: " + aquay);
		
		// dodawanie diva z klasą do zabespieczenia danych przed utratą
		$("#compiler_aquay_black_min").wrapInner("<blackmin_kod>");
		$("#compiler_aquay_black_min").find("blackmin_kod").addClass("blackmin-kod").attr("data-blackmin-datetime", "datetime-edytor-aquay").attr("data-blackmin-user", "user-edytor-aquay");
		
		// informacja o pobieranie danych przez komilator aquay > black min
		console.info("Pobieranie informacji o kodzie: " + aquay);
		
		// pobieranie skompilowanego kodu i zwrucenie go 
		var aquay_blackmin_get_comilate_kod = $("#compiler_aquay_black_min").html();
		
		// usuwanie komilatora aquay > black min 
		$("#compiler_aquay_black_min").remove();
		
		// informacja o zakończeniu kompilowania przez komilator aquay > black min
		console.info("Zakończono komilowanie kodu: " + aquay);
		
		return aquay_blackmin_get_comilate_kod;
		
	}
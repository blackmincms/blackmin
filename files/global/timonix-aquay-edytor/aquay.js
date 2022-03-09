/*
@
@		>>>> AQUAY <<<<
@
@	Timonix Aquay Edytor
@	Edytor Blokowy (Tekstowy)
@	Versja: 1.0
@	Autor: Timonix
@
@		>>>> AQUAY <<<<
@
*/
	
	// tworzenie logów do konsoli przeglądarki
	console.info("Iniciowanie: aquay");
	console.info("Startowanie: aquay");
	console.info("Ładowanie: aquay");
	
	var aquay_text = $(".aquay-text");
	

	var showingSourceCode = false;
	var isInEditMode = true;
	var aquay_edytuj_frame = $(".aquay-text");
	
	var aquay_add_klucz = 0;
	
	var aquay_selected_text = undefined;
	
	var getSelectionStart = function() {
      var node = document.getSelection().anchorNode,
          startNode = (node && node.nodeType === 3 ? node.parentNode : node);
      return startNode;
    }

	function GetSelection () {
		// pobieranie zaznaczonego tekstu
		let selection = (window.getSelection().type != "None" ? window.getSelection() : undefined),
			active = (selection != undefined ? document.activeElement : undefined),
			range = (selection != undefined ? selection.getRangeAt(0) : undefined),
			boundary = (selection != undefined ? range.getBoundingClientRect() : undefined),
			text = (selection != undefined ? selection.toString() : undefined);
			
		// sprawdzanie czy istnieje zaznaczenie
		if (selection != undefined && text != "" && selection.type == "Range"){
			return {
				start: function () {
					return {
						tag: $(range.startContainer)[0].parentNode.tagName.toLowerCase(),
						target: $(range.startContainer)[0].parentNode,
						lenght: range.startOffset
					};
				} ,
				stop: function () {
					return {
						tag: $(range.endContainer)[0].parentNode.tagName.toLowerCase(),
						target: $(range.endContainer)[0].parentNode,
						lenght: range.endOffset
					}
				},
				orginalStart: function () {
					return {
						tag: $(selection.anchorNode)[0].parentNode.tagName.toLowerCase(),
						target: $(selection.anchorNode)[0].parentNode,
						lenght: selection.anchorOffset
					};
				} ,
				orginalStop: function () {
					return {
						tag: $(selection.focusNode)[0].parentNode.tagName.toLowerCase(),
						target: $(selection.focusNode)[0].parentNode,
						lenght: selection.focusOffset
					}
				},
				selection: selection,
				parent: active,
				text: text,
				range: range,
				boundary: boundary,
				orginal: function () {
					let text = "",
						activeElTagName = active ? active.tagName.toLowerCase() : null;
					if ((activeElTagName == "textarea") || (activeElTagName == "input" &&  /^(?:text|search|password|tel|url)$/i.test(active.type)) && (typeof active.selectionStart == "number")) {
						text = active.value.slice(active.selectionStart, active.selectionEnd);
					} else if (active) {
						text = text;
					}
					return text;
				},
				clone: function () {
					return range.cloneContents();
				},
				same: function () {
					return $(selection.anchorNode)[0].parentNode === $(selection.focusNode)[0].parentNode ? true : false;
				}
			}
		}else{
			return undefined;
		}
	}

	// zmianna zaznaczenia select
	function aquaySelectedOption(s, t) {
		// pobiweranie selcta do zmienienia
		let q = $(s);
		// sprawdzanie czy select istnieje i czy istnieje opcja do zaznaczenia
		if(q != undefined){
			// sprawdzenie czy istnieje 
			if(q.find('option[value='+ t +']')){
				q.find('option[value='+ t +']').attr('selected','selected');
				return true;
			}else{
				return false
			}
		}
	}
		
	document.addEventListener("mouseup", (e) => {
		if(GetSelection() != undefined){
			// sprawdzanie czy rodzic jest zaznaczalny		
			if($(GetSelection().start().target.closest(".aquay-edytuj-text")).hasClass("aquay-edytuj-text") == true){
				aquay_selected_text = GetSelection();
			}
		}else{
			if (GetSelection() != undefined) {
				if ($(GetSelection().start().target.closest(".aquay-edytuj-text")) != undefined) {
					if($(GetSelection().start().target.closest(".aquay-edytuj-text")).hasClass("aquay-edytuj-text") == false){
						$(".tsr-modal-active .tsr-modal-close").click();
					}
				}else{
					window.setTimeout(function (){
						$(".tsr-modal-active .tsr-modal-close").click();
					}, 0, true);
				}
			}else {
				if(!((e.target.nodeName.toLowerCase() == "textarea") || (e.target.nodeName.toLowerCase()  == "input") || (e.target.nodeName.toLowerCase()  == "select"))){
					if ($(e.target.closest(".aquay-edytuj-text")) === undefined) {
						$(".tsr-modal-active .tsr-modal-close").click();
					}
				}
			}
		}
    })
	
	// funkcje edytora tekstu aquay
	function aquay_edytor (command) {
		document.execCommand(command, false , null);
	}
	
	function aquay_edytor_format (command, arg) {
		document.execCommand(command, false, arg);
	}

	function aquay_edytor_link (command) {		
		var theSelection = window.getSelection();
		var theRange = theSelection.getRangeAt(0);
		
		var url_add= $('input[name="url_add"]').val();
		var tytul_add= $('input[name="tytul_add"]').val();
		var target_add= $('select[name="target_add"]').val();
		
	}

	function aquay_edytor_toggle_kod () {
		if(showingSourceCode){
			var aquay_tresc = $(".aquay-text").text();
			$(".aquay-text").html(aquay_tresc);
			showingSourceCode = false;
		}else{
			var aquay_kod = $(".aquay-text").html();
			$(".aquay-text").text(aquay_kod);
			showingSourceCode = true;
		}
	}

	function aquay_edytor_toggle_edytuj () {
		if(isInEditMode){
			$(".aquay-text").designMode = 'Off';
			isInEditMode = false;
			$(".aquay-edytuj-text").attr("contenteditable", "false");
		}else{
			$(".aquay-text").designMode = 'On';
			$(".aquay-edytuj-text").attr("contenteditable", "true");
			isInEditMode = true;
		}
	}	

	function aquay_edytor_get_code () {
		var aquay_get_kod = $(".aquay-text").html();
		console.info("Pobieranie kodu: " + aquay);
		console.info("Kod został pobrany prawidłowo: " + aquay);
		return aquay_get_kod;
	}	

	// pobranie danych do dodania linku
	
	$(document).on('click', '#link_add', function(oEvent){	
		var url_add = ($('input[name="url_add"]')[1].value == "" ? "home" : $('input[name="url_add"]')[1].value);
		var tytul_add = ($('input[name="tytul_add"]')[1].value == "" ? undefined : $('input[name="tytul_add"]')[1].value);
		var target_add = ($('select[name="target_add"]')[1].value == "" ? "_self" : $('select[name="target_add"]')[1].value);	
		
		// fokusowanie elementu
		aquay_selected_text.parent.focus();
		// tworzenie nowego objektu range
		let range = new Range();
		// ustawianie zakresów do zaznaczenia
		range.setStart(aquay_selected_text.start().target.firstChild, aquay_selected_text.start().lenght);
		range.setEnd(aquay_selected_text.stop().target.firstChild, aquay_selected_text.stop().lenght);
		// usuwanie poprzedniego zaznaczenia
		window.getSelection().removeAllRanges();
		// zaznaczenie odpowiedniego zakresu
		window.getSelection().addRange(range);
		
		// edytowanie linku
		document.execCommand('createLink', false, "aquay_link_to_editable");
		//aquay_edytor_format('createLink', url_add);
		
		// pobieranie linku do edycji
		let link_edit = $('a[href="aquay_link_to_editable"]');
		// ustawianie atrybutów
		(url_add != undefined ? link_edit.attr("href", url_add) : '');
		(tytul_add != undefined ? link_edit.attr("title", tytul_add) : '');
		(target_add != undefined ? link_edit.attr("target", target_add) : '');
		// pobieranie linku do kontroli
		let link_edit_control = $('a[href="aquay_link_to_editable"]');
		// sprawdzanie czy zmieniono link poprawnie
		if (link_edit_control !== undefined && link_edit_control.attr("href") === "aquay_link_to_editable") {
			// usuwanie linku
			aquay_edytor_format('unlink');
		}else{
			// pobieranie zaznaczenia tekstu
			if(GetSelection() != undefined){
				// sprawdzanie czy rodzic jest zaznaczalny
				if($(GetSelection().parent).hasClass("aquay-edytuj-text")){
					// aktulizowanie zanaczenia
					aquay_selected_text = GetSelection();
				}
			}
		}
		
		console.info("aquay: dodawanie linku");
	});	

	$(document).on('click', ".aquay .link", function(oEvent){	
		if (aquay_selected_text != undefined) {
			if(aquay_selected_text.same() === true) {
				if(aquay_selected_text.start().tag == "a" && aquay_selected_text.stop().tag == "a"){
					$('input[name="url_add"]').attr("value", $(aquay_selected_text.start().target).attr("href"));
					$('input[name="tytul_add"]').attr("value", $(aquay_selected_text.start().target).attr("title"));
					//zaznaczanie odpowiedniej opcij
					aquaySelectedOption($('select[name="target_add"]'), $(aquay_selected_text.start().target).attr("target"));
				}
			}
			if(GetSelection() != undefined){
				let sel = (document.activeElement != undefined ? true : false);
				if (sel === true) {
					// sprawdzanie czy rodzic jest zaznaczalny	
					if($(GetSelection().start().target.closest(".aquay-edytuj-text")).hasClass("aquay-edytuj-text") == false){
						$(".tsr-modal-active .tsr-modal-close").click();
					}
				}else{
					$(".tsr-modal-active .tsr-modal-close").click();
				}
			}else{
				$(".tsr-modal-active .tsr-modal-close").click();
			}
		}else{
			$(".tsr-modal-active .tsr-modal-close").click();
		}
	});	
	
	// pokazywanie menu wyboru wstawiania nowych elementów po pliknięciu
	
	$(document).on("click", ".aquay-edytor-menu", function(oEvent){
		$(".aquay-edytor-element-menu").toggleClass("aquay-edytor-menu-visable");
		 return false;
	});	
	
	$(document).click(function (event) {
		if ($(event.target).closest(".aquay-edytor-element-menu").length === 0) {
			$(".aquay-edytor-element-menu").removeClass("aquay-edytor-menu-visable");
		}
	});
	
	// po wpisaniu 1 znaku przycisk do dodawania z dysku zostanie schowany
	// jeżeli będzie miał wartosc null to pokażemy przycisk z powrotem
	$(document).on("keyup", ".aquay-link", function(oEvent){
		var aquay_keypress = $(this).closest(".aquay-link").val().length;
		
		if (aquay_keypress >= 1) {
			$(this).closest(".aquay-edytuj-container").find(".aquay-add-media").addClass("aquay-hidden");
			var url_get_img = $(this).closest(".aquay-edytuj-container").find(".aquay-link").val();
			
			// tworzenie elementu img jeżeli zostanie podana wartosc
			var add_img_obrazek = document.createElement("img");
			add_img_obrazek.setAttribute('src', url_get_img);
			add_img_obrazek.setAttribute('alt', url_get_img);
			add_img_obrazek.setAttribute('title', url_get_img);
			add_img_obrazek.setAttribute('class', "aquay-obrazek");
			
			$(this).closest(".aquay-edytuj-container").find(".aquay-load-obrazek").find(".aquay-obrazek").remove();
			$(this).closest(".aquay-edytuj-container").find(".aquay-load-obrazek").append(add_img_obrazek);
		}else{
			$(this).closest(".aquay-edytuj-container").find(".aquay-add-media").removeClass("aquay-hidden");
			$(this).closest(".aquay-edytuj-container").find(".aquay-load-obrazek").find(".aquay-obrazek").remove();
		}
		
	});	
	
	// usuwanie elementów po podwójnym kliknięciu na nazwę bloku
	$(document).on("dblclick", ".aquay-type-title", function(oEvent){
		console.log("sdsd");
		$(this).closest(".aquay-type-title").closest(".aquay-edytuj-container").remove();
	});	

	// sortowanie kontenerów bloków
	// przeciąganie w górę i w dół
	$( function() {
		$( ".aquay-text" ).sortable({
		  connectWith: ".aquay-text",
		  handle: ".aquay-type-title",
		  cancel: ".aquay-toggle",
		  placeholder: "aquay-placeholder"
		});
	 
		$( ".aquay-edytuj-container" )
		//.prepend( "<span class='ui-icon ui-icon-minusthick aquay-toggle'></span>")
		  //.addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
		  .find( ".aquay-type-title" )
			//.addClass( "ui-widget-header ui-corner-all" )
			//.prepend( "<span class='ui-icon ui-icon-minusthick aquay-toggle'></span>");
			;
	 
		$( ".aquay-toggle" ).on( "click", function() {
		  var icon = $( this );
		  //icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
		  icon.closest( ".aquay-edytuj-container" ).find( ".aquay-edytuj-text" ).toggle();
		});
	});

	// modal ------- modal ---- aquay ---- modal -------- modal //

	// tworzenie modal boxa
	$(document).on("click", ".aquay-open-modal", function(oEvent){
		var aquay_open_modal = $(this).closest(".aquay-open-modal").attr('id');
		var aquay_this_button = $(this).closest(".aquay-open-modal").attr('id');
		var aquay_this_multiply = $(this).closest(".aquay-open-modal").attr('data-multiply');
		var aquay_this_typebox = $(this).closest(".aquay-edytuj-container").attr('data-blok-type');
		var aquay_this_element = ".aquay-modal-" + aquay_open_modal;

		// dodawanie do html klasy > blokada przesuwania (scrola)
		$("html").addClass("aquay-modal-html");
		
		// blokowanie dodawania własnego obrazka po przez url
		//////$(this).closest(".aquay-edytuj-container").find(".aquay-obrazek-url").addClass("aquay-hidden");
		var this_obrzek_url = $(this).closest(".aquay-edytuj-container").find(".aquay-obrazek-url");

		// sprawdzanie czy dany modal box jstnieie. jeżeli tak to go pokażemy jeżeli nie to tworzymy go na nowo i wyświetlamy
		if($(aquay_this_element).length==1) {
			$(aquay_this_element).removeClass("aquay-hidden");
		} else {
			// tworzenie elementu modal by wyświetlić zawartość
			var add_modal_div = document.createElement("div");
			add_modal_div.setAttribute('title', "aquay / black min / modal");
			add_modal_div.setAttribute('class', "aquay-modals" + " aquay-modal-" + aquay_open_modal);
			add_modal_div.setAttribute('id', "aquay-modal-" + aquay_open_modal);
			
			// dodawanie stworzonego elementu do dokumentu html 
			$(this).closest("body").append(add_modal_div);
			
			// tworzenie elementu modal container by wyświetlić dopasowaną zawartość
			var add_modal_div_container = document.createElement("div");
			add_modal_div_container.setAttribute('title', "aquay / black min / modal");
			add_modal_div_container.setAttribute('class', "aquay-modal-container");
			
			// dodawanie stworzonego elementu do dokumentu html 
			$(aquay_this_element).append(add_modal_div_container);
			
			// tworzenie elementu modal container by wyświetlić dopasowaną zawartość
			var add_modal_div_container_load = document.createElement("div");
			add_modal_div_container_load.setAttribute('title', "aquay / black min / modal load");
			add_modal_div_container_load.setAttribute('class', "aquay-modal-load");
			
			// dodawanie stworzonego elementu do dokumentu html 
			$(aquay_this_element).find(".aquay-modal-container").append(add_modal_div_container_load);

			// tworzenie elementu modal container by wyświetlić dopasowaną zawartość
			var add_modal_closed = document.createElement("div");
			add_modal_closed.setAttribute('title', "aquay / black min / modal closed");
			add_modal_closed.setAttribute('class', "aquay-modal-closed");
			
			// dodawanie stworzonego elementu do dokumentu html 
			$(aquay_this_element).find(".aquay-modal-container").append(add_modal_closed);
			
			load_dysk_media("25", aquay_this_multiply, aquay_this_element, aquay_this_typebox, aquay_this_button, aquay_open_modal);			
		}
		
		return false;
	});	

	// przypisywanie modalowi funkcji bez kliknięcia
	$(document).on("click", ".jquery-modal", function(oEvent){
		return false;
	});	
	
	// zamykanie modal boxa po kliknięciu na czarne pole
	$(document).click(function (event) {
		if ($(event.target).closest(".aquay-modal-container").length === 0) {
			$(".aquay-modals").addClass("aquay-hidden");
			
			// usuwanie z html klasy > blokada przesuwania (scrola)
			$("html").removeClass("aquay-modal-html");
			// odblokowanie dodawania własnego obrazka po przez url
			$(this).closest(".aquay-edytuj-container").find(".aquay-obrazek-url").removeClass("aquay-hidden");
		}
	});
	
	// zamykanie modal boxa po kliknięciu na zakmkcji modal box
	$(document).on("click", ".aquay-modal-closed", function(oEvent){
		$(".aquay-modals").addClass("aquay-hidden");
			
		// usuwanie z html klasy > blokada przesuwania (scrola)
		$("html").removeClass("aquay-modal-html");
		// odblokowanie dodawania własnego obrazka po przez url
		$(this).closest(".aquay-edytuj-container").find(".aquay-obrazek-url").removeClass("aquay-hidden");
		$(this).closest(aquay_open_modal).closest(".aquay-edytuj-container").find(".aquay-obrazek-url").removeClass("aquay-hidden");
		$(this_obrzek_url).removeClass("aquay-hidden");
	});	

	// zamykanie modal boxa po kliknięciu na zakmkcji modal box
	function aquay_cloase_modal(){
		$(".aquay-modals").addClass("aquay-hidden");
		
		// usuwanie z html klasy > blokada przesuwania (scrola)
		$("html").removeClass("aquay-modal-html");
		// odblokowanie dodawania własnego obrazka po przez url
		$(this).closest(".aquay-edytuj-container").find(".aquay-obrazek-url").removeClass("aquay-hidden");
	};	
	
	// ładowanie pliku który doda nam zdjęcie z dysku (db)

	function load_dysk_media(ile_load, multiply, get_plik, typebox, button, klucz) {
		console.log(button);
		$.ajax({
			type:"POST",
			//url:"laduj/all-dysk-get-media.php",
			url:"admin-dysk-get-media.php",
			data:{
				ile_load:ile_load,
				multiply:multiply,
				get_plik:get_plik,
				typebox:typebox,
				button:button,
				klucz:klucz,
			}
		})
		.done(function(info){
			//$('#contajner_post_add').text("");
			$(get_plik).find(".aquay-modal-container").find(".aquay-modal-load").append(info);
			$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
		})
		.fail(function(){
			alert("Wystąpił błąd. Spróbuj ponownie później");
		});
		
	}	
	
	// modal ------- modal ---- aquay ---- modal -------- modal //

	// funkcjia do pobierania pliku i wstawianie go do boxa img 
	function add_media_to_element(akcja_records, typebox, button, src________) {
		var this_button_add = "#" + button;
		var src = "";
		console.log(typebox);console.log(this_button_add);
		
		// howanie dodawania włanego niestandardowego zdjecja
		$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-obrazek-url").addClass("aquay-hidden");
		
		// sprawdzenie czy element dodający to zdjęcie
		if (typebox == "type_blok/black_min_miniaturka_post"){

			// pobieranie src wybranego img
			src = $('.id-records-'+ akcja_records).find(".img").attr("src");
			alt = $('.id-records-'+ akcja_records).find(".img").attr("title");
			
			// tworzenie elementu img jeżeli zostanie podana wartosc
			var add_img_obrazek = document.createElement("img");
			add_img_obrazek.setAttribute('src', src);
			add_img_obrazek.setAttribute('alt', alt);
			add_img_obrazek.setAttribute('title', alt);
			add_img_obrazek.setAttribute('class', "black-min-miniaturka-post");
			
			$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-obrazek").find(".black-min-miniaturka-post").remove();
			$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-obrazek").append(add_img_obrazek);
			
		}

		// sprawdzenie czy element dodający to zdjęcie
		if (typebox == "type_blok/obrazek"){

			// pobieranie src wybranego img
			src = $('.id-records-'+ akcja_records).find(".img").attr("src");
			alt = $('.id-records-'+ akcja_records).find(".img").attr("title");
			data_obrazek = $('.id-records-'+ akcja_records).find(".img").attr("data-grafika");
			
			// tworzenie elementu img jeżeli zostanie podana wartosc
			var add_img_obrazek = document.createElement("img");
			add_img_obrazek.setAttribute('src', src);
			add_img_obrazek.setAttribute('alt', alt);
			add_img_obrazek.setAttribute('title', alt);
			add_img_obrazek.setAttribute('class', "aquay-obrazek");
			add_img_obrazek.setAttribute('data-grafika', data_obrazek);
			
			$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-obrazek").find(".aquay-obrazek").remove();
			$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-obrazek").append(add_img_obrazek);
			
		}
		
		if (typebox == "type_blok/galeria"){
			
			// usuwanie poprzedniego img aby zastąpić nowym
			$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-galeria").find(".aquay-galeria").remove();
			
			for (var i=0; i< akcja_records.length; i++){

				// pobieranie src wybranego img
				src = $('.id-records-'+ akcja_records[i]).find(".img").attr("src");
				alt = $('.id-records-'+ akcja_records).find(".img").attr("title");
				data_obrazek = $('.id-records-'+ akcja_records).find(".img").attr("data-grafika");
				
				// tworzenie elementu img jeżeli zostanie podana wartosc
				var add_img_obrazek = document.createElement("img");
				add_img_obrazek.setAttribute('src', src);
				add_img_obrazek.setAttribute('alt', alt);
				add_img_obrazek.setAttribute('title', alt);
				add_img_obrazek.setAttribute('class', "aquay-galeria");
				add_img_obrazek.setAttribute('data-grafika', data_obrazek);
				
				$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-galeria").append(add_img_obrazek);

			}
			
		}

		if (typebox == "type_blok/plik"){
			
			// usuwanie poprzedniego img aby zastąpić nowym
			$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-galeria").find(".aquay-galeria").remove();
			
			for (var i=0; i< akcja_records.length; i++){

				// pobieranie src wybranego img
				src = $('.id-records-'+ akcja_records[i]).find(".img").attr("data-sciezka")
				
				$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-plik").attr("data-pobierz", src);

			}
			
		}
	
		aquay_cloase_modal();
	};
	
	$(document).ready(function() { 
		$(".aquay-blok-akapit").on( "click", function() {
			$(".aquay-kopia-blok-text > div").clone().appendTo(".aquay-text");
		});
	});
		
	$(document).on('click', ".aquay-blok-cytat", function(oEvent){	
		$(".aquay-kopia-blok-cytat > div").clone().remove('div[class=".aquay-kopia-blok-text"]').appendTo(".aquay-text");
	});	

	$(document).on('click', ".aquay-blok-naglowek", function(oEvent){	
		$(".aquay-kopia-blok-naglowek > div").clone().appendTo(".aquay-text");
	});	
	
	$(document).on('click', ".aquay-blok-kod", function(oEvent){	
		$(".aquay-kopia-blok-kod > div").clone().appendTo(".aquay-text");
	});	

	$(document).on('click', ".aquay-blok-wlasny-html", function(oEvent){	
		$(".aquay-kopia-blok-wlasny-html > div").clone().appendTo(".aquay-text");
	});	
	
	$(document).on('click', ".aquay-blok-obrazek", function(oEvent){	
		$(".aquay-kopia-blok-obrazek > div").clone().appendTo(".aquay-text").closest(".aquay-edytuj-container").find(".aquay-add-media").attr("id", "aquay_" + aquay_add_klucz).attr("aquay-obiect-put", ".aquay_" + aquay_add_klucz).closest(".aquay-edytor-obrazek").find(".aquay-load-obrazek").addClass("aquay_" + aquay_add_klucz);
		aquay_add_klucz++;
	});	
	
	$(document).on('click', ".aquay-blok-galeria", function(oEvent){	
		$(".aquay-kopia-blok-galeria > div").clone().appendTo(".aquay-text").closest(".aquay-edytuj-container").find(".aquay-add-media").attr("id", "aquay_" + aquay_add_klucz).attr("aquay-obiect-put", ".aquay_" + aquay_add_klucz).closest(".aquay-edytor-galeria").find(".aquay-load-galeria").addClass("aquay_" + aquay_add_klucz);
		aquay_add_klucz++;
	});	
	
	$(document).on('click', ".aquay-blok-plik", function(oEvent){	
		$(".aquay-kopia-blok-plik > div").clone().appendTo(".aquay-text").closest(".aquay-edytuj-container").find(".aquay-add-media").attr("id", "aquay_" + aquay_add_klucz).attr("aquay-obiect-put", ".aquay_" + aquay_add_klucz).closest(".aquay-edytor-plik").find(".aquay-load-plik").addClass("aquay_" + aquay_add_klucz);
		aquay_add_klucz++;
	});	
	
	// powiadomienie o zakończeniu ładowania
	
	$(document).ready(function() { 
		console.info("Ładowanie Zakończone: aquay");
	});










	// this a new function editora
	function aquay (__t = ".aquay-editor-container", aquay_path = "files/global/timonix-aquay-edytor/") {
		// load start
		console.info("Aquay: Ładowanie");
		console.info("Aquay: Iniciowanie");
		console.info("Aquay: Startowanie");

		// default settings aquay editor
		var settings = {
			"error_timer" : 1000,
			"load_editor_item" : ["all"],
			"aquay_default_font" : [
				{
					"altona_sans": ["AltonaSans-Italic.ttf", "AltonaSans-Regular.ttf"],
					"console": ["Console.ttf","Console_Input.ttf", "Console_Relay.ttf", "Console_Output.ttf"],
					"dark_seventh": ["Dark_Seventh_Personal_Use.otf"],
					"harmony_4": ["HARMONY_Personal_use.otf"],
					"monea_alegante": ["Monea_Alegante.otf"],
					"open_sans": ["OpenSans-Italic.ttf", "OpenSans.ttf"],
					"oxygen": ["Oxygen-Bold.ttf", "Oxygen-Light.ttf","Oxygen-Regular.ttf"],
					"saling_cinta": ["Saling_Cinta.ttf"],
					"ubuntu": ["Ubuntu-Regular.ttf","Ubuntu-MediumItalic.ttf","Ubuntu-Medium.ttf","Ubuntu-LightItalic.ttf","Ubuntu-Light.ttf","Ubuntu-Italic.ttf","Ubuntu-BoldItalic.ttf","Ubuntu-Bold.ttf"]
			 	}
			]
		};
		let buffor = [];

		// check tsr moduls
		function CheckModuls() {
			if (typeof window.tsr != undefined) {
				return true;
			} else {
				console.error("Aquay: Not 'tsr' modules avaliable");
				Window.error("Aquay: Not 'tsr' modules avaliable");
			}
		}

		// get selection
		function GetSelection () {
			// pobieranie zaznaczonego tekstu
			let selection = (window.getSelection().type != "None" ? window.getSelection() : undefined),
				active = (selection != undefined ? document.activeElement : undefined),
				range = (selection != undefined ? selection.getRangeAt(0) : undefined),
				boundary = (selection != undefined ? range.getBoundingClientRect() : undefined),
				text = (selection != undefined ? selection.toString() : undefined);
				
			// sprawdzanie czy istnieje zaznaczenie
			if (selection != undefined && text != "" && selection.type == "Range"){
				return {
					start: function () {
						return {
							tag: $(range.startContainer)[0].parentNode.tagName.toLowerCase(),
							target: $(range.startContainer)[0].parentNode,
							lenght: range.startOffset
						};
					} ,
					stop: function () {
						return {
							tag: $(range.endContainer)[0].parentNode.tagName.toLowerCase(),
							target: $(range.endContainer)[0].parentNode,
							lenght: range.endOffset
						}
					},
					orginalStart: function () {
						return {
							tag: $(selection.anchorNode)[0].parentNode.tagName.toLowerCase(),
							target: $(selection.anchorNode)[0].parentNode,
							lenght: selection.anchorOffset
						};
					} ,
					orginalStop: function () {
						return {
							tag: $(selection.focusNode)[0].parentNode.tagName.toLowerCase(),
							target: $(selection.focusNode)[0].parentNode,
							lenght: selection.focusOffset
						}
					},
					selection: selection,
					parent: active,
					text: text,
					range: range,
					boundary: boundary,
					orginal: function () {
						let text = "",
							activeElTagName = active ? active.tagName.toLowerCase() : null;
						if ((activeElTagName == "textarea") || (activeElTagName == "input" &&  /^(?:text|search|password|tel|url)$/i.test(active.type)) && (typeof active.selectionStart == "number")) {
							text = active.value.slice(active.selectionStart, active.selectionEnd);
						} else if (active) {
							text = text;
						}
						return text;
					},
					clone: function () {
						return range.cloneContents();
					},
					same: function () {
						return $(selection.anchorNode)[0].parentNode === $(selection.focusNode)[0].parentNode ? true : false;
					}
				}
			}else{
				return undefined;
			}
		}
	
		// zmianna zaznaczenia select
		function aquaySelectedOption(s, t) {
			// pobiweranie selcta do zmienienia
			let q = $(s);
			// sprawdzanie czy select istnieje i czy istnieje opcja do zaznaczenia
			if(q != undefined){
				// sprawdzenie czy istnieje 
				if(q.find('option[value='+ t +']')){
					q.find('option[value='+ t +']').attr('selected','selected');
					return true;
				}else{
					return false
				}
			}
		}

		// load function
		async function load (url = "settings.json", he = "json") {

			if (he === "json") {
				he = {"Content-Type": "application/json"};
				try {
					await fetch(aquay_path + url, {
						method: "GET",
						headers: new Headers(he),	
					})
					.then(res => res.json())
					.then(res => {
						parse_data(res, he);
						return true;
					})
				} catch (error) {
					console.error('Aquay: error load assets "' + aquay_path + url + '" | ' + error);
					return false;
				}
			}else{
				he = {"Content-Type": "text/plain"};
				try {
					await fetch(aquay_path + url, {
						method: "GET",
						headers: new Headers(he),	
					})
					.then(res => res.text())
					.then(res => {
						parse_data(res, he);
						return res;
					})
				} catch (error) {
					console.error('Aquay: error load assets "' + aquay_path + url + '" | ' + error);
					return false;
				}
			}
		}

		// function tests browser caches
		function cache_test(type) {
			var storage;
			try {
				storage = window[type];
				var x = '__aquay_storage_test__';
				storage.setItem(x, x);
				storage.removeItem(x);
				return true;
			}
			catch(e) {
				return e instanceof DOMException && (
					// everything except Firefox
					e.code === 22 ||
					// Firefox
					e.code === 1014 ||
					// test name field too, because code might not be present
					// everything except Firefox
					e.name === 'QuotaExceededError' ||
					// Firefox
					e.name === 'NS_ERROR_DOM_QUOTA_REACHED') &&
					// acknowledge QuotaExceededError only if there's something already stored
					(storage && storage.length !== 0);
			}
		}

		// function parse settings (json parse string)
		function parse_data(odp, d) {
			let storage = window.sessionStorage;

			if (Array.isArray(odp) || typeof (odp) === "object") {
				if (d === "json") {
					if (cache_test("sessionStorage")) {
						storage.setItem("aquay_settings", JSON.stringify(odp));
						return true;
					} else {
						return odp;
					}
				}
			}else if (d = "text") {
				if (cache_test("sessionStorage")) {
					storage.setItem("aquay_block_schemat", JSON.stringify(odp));
					return true;
				} else {
					return odp;
				}
			} else {
				return false;
			}
		}

		// function get settings (json parse string)
		function setting(t = "all") {
			console.log(load("settings.json", "json"));
			if (cache_test("sessionStorage")) {
				let storage = window.sessionStorage;
				if (t === "all") {
					if (storage.getItem("aquay_settings")) {
						return JSON.parse(storage.getItem("aquay_settings"));
					} else {
						load("settings.json", "json");
					}
				} else {
					if (storage.getItem("aquay_settings")) {
						let x = Array.prototype.search(JSON.parse(storage.getItem("aquay_settings")), t);
						console.log(x);
						if (x != false) {
							return x;
						} else {
							throw new error("error", "Aquay: wystąpił nie znany błąd!");
						}
					} else {
						load("settings.json", "json");
					}
				}
			} else {
				if (t === "all") {
					return setting;
				}else{
					let x = Array.prototype.search(setting, t);
					if (x != false) {
						return x;
					} else {
						throw new error("error", "Aquay: wystąpił nie znany błąd!");
					}
				}
			}
		}

		Array.prototype.search = (t, e) => {
			if (t[e]) {
				return t[e];
			} else {
				return false;
			}
		};

		// function get block scheme
		function block_scheme (t = "") {
			console.log(load("aquay.html", "text"));
			if (cache_test("sessionStorage")) {
				let storage = window.sessionStorage;
				if (storage.getItem("aquay_block_schemat")) {
					let x = ($(JSON.parse(storage.getItem("aquay_block_schemat"))).find(".aquay-edytuj-container"));
					if (x != undefined) {
						console.log($(JSON.parse(storage.getItem("aquay_block_schemat"))).find(".aquay-edytuj-container"));
						return x;
					} else {
						throw new error("error", "Aquay: wystąpił nie znany błąd!");
					}
				} else {
					load("aquay.html", "text");
				}
			} else {
				// reporting error
				console.error("Aquay: Wystąpił błąd krytyczny modułu ('scheme')");
			}			
		}

		setting();
		block_scheme();
		// function error raport
		function error(t = "error", m = "Aquay: wystąpił nieznany błąd", c = "container", a = true) {
			if((/^(container|aquay|index|bottom|top)$/).test(c.toString())) {
				if ((/^(error|info|warning|war|normal|success)$/).test(t.toString())) {
					if (t === "war") {
						t = "warning";
					}
					// alert path | navigate in aquay dom
					let path = $(document).find(__t);
					if (c = "aquay") {
						path = path.find(".Aquay-Container-block");
					}else if (c = "index") {
						path = $(document).find(".Aquay-editor-container-error");
					}else if (c = "bottom") {
						path = path.find(".Aquay-Container-block .aquay-alert-bottom");
					}else if (c = "top") {
						path = path.find(".Aquay-Container-block .aquay-alert-bottom");
					}
				}else{
					console.error("Aquay: błędny typ alertu");
				}
			}else{
				console.error("Aquay: błędny kontener alertu");
			}
		}

		// inports fonts
		function include_font (t = null) {
			var link = document.createElement('link');
			link.setAttribute('rel', 'stylesheet');
			link.setAttribute('type', 'text/css');
			link.setAttribute('href', aquay_path);
			document.head.appendChild(link);
		}

		// function load interface
		function uis () {
			let aquay_container = $(__t);
			// add aquay container
			aquay_container.append('<div class="aquay">');
			// find aquay
			aquay_container = aquay_container.find(".aquay");
			// add head and body
			aquay_container.append('<section class="aquay-nawigacja aquay-navigate">');
			aquay_container.append('<div class="aquay-block-editor" contenteditable="true" name="aquayblock">');
			// get head and body
			let head = aquay_container.find(".aquay-navigate"),
				body = aquay_container.find(".aquay-block-editor");
			
			// load navigate
			load_navigate(head);
			
		}
		// function load navigate
		function load_navigate(t) {
			let head = $(t);
			let items = setting("load_editor_item");
			console.log(items);

			if (items[0] === "all") {
				
			} else {
				
			}
		}

		uis();

		// load end
		console.info("Aquay: Ładowanie Zakończone");
	}
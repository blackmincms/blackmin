/*
//
//				Timonix Script Rezult - reguły javascript\jquery
//												V.2.0
//					Wszelkie Prawa Zaszczeżone by Timonix
//
*/

	// informacja o starcie tsr
	console.info("iniciowanie: tsr");
	console.info("ładowanie: tsr");
	console.info("startowanie: tsr");
	
	
	
	
	/* pobieranie szerokośći i wysokośći okna (window.document) */
	// rzeczywista rozdzielczość ekrana
	let orginal_screenX = window.screen.width;
	var orginal_screenY = window.screen.height;
	var orginal_screenWidth = window.screen.width;
	var orginal_screenHeight = window.screen.height;
	var orginal_Width = window.screen.width;
	var orginal_Height = window.screen.height;
	// skalowana rozdzielczość ekrana
	var screenX = this.innerWidth;
	var screenY = this.innerHeight;
	var screenWidth = this.innerWidth;
	var screenHeight = this.innerHeight;
	var Width = this.innerWidth;
	var Height = this.innerHeight;

	// funkcjie validujące dane
	function is_json(str) {
		try {
			JSON.parse(str);
		} catch (e) {
			return false;
		}
		return true;
	}

	// nasłuchiwanie window ze zminą rozdzielczośći ekranu + aktulizowanie elementów DOM po zmianie rozdzielczość
	
	window.addEventListener("resize", function() {
		// skalowana rozdzielczość ekrana
		screenX = window.screen.innerWidth;
		screenY = window.screen.innerWidth;
		screenWidth = window.screen.innerWidth;
		screenHeight = window.screen.innerWidth;
		Width = window.screen.innerWidth;
		Height = window.screen.innerWidth;
	});
	
	// wykonywanie kontrolera rezise {}
	function tsr_controler_rezise(fun) {
		window.addEventListener("resize", fun);
	};
	// wykonywanie kontrolera click {}
	function tsr_controler_click(fun) {
		window.addEventListener("click", fun);
		$(document).on("click", fun);
	};

	// funkcja dodająca funkcjie do kontrolerów (rezise, pozytion, url_state itp)
	function tsr_controler(arg, fun) {
		// sprawdzanie czy użytkownik podał właśćiwy dostępny kontroler tsr
		if(arg == "rezise"){
			tsr_controler_rezise(fun);
		}else if(arg == "click"){
		}else if(arg.indexOf == " "){
			console.error("Błędny kontroler tsr: " + arg);
			console.trace(arg, fun)
			return "wrong_tsr_controller";			
		}else if(arg.indexOf == ""){
			console.error("Błędny kontroler tsr: " + arg);
			console.trace(arg, fun)
			return "wrong_tsr_controller";			
		}else{
			console.error("Błędny kontroler tsr: " + arg);
			console.trace(arg, fun)
			return "wrong_tsr_controller";
		}
	}
	
	// statyczna funkcja zwracająca zaokroglony wynik bez żadnych znaków(nie (-1) tylko (1))
	function tsr_abs(t) {
		return Math.abs(t);
	}
	
	// statyczna funkcja zwracająca wynik dodatni(1) lub ujemny(-1) zależnośći od wartość
	function tsr_sign(t) {
		return Math.sign(t);
	}
	
	// klasa css [.tsr-click] po której zostanie wyzwolona funkcjia linku 
	$(document).on('click', "a.tsr-click, .tsr-click-link", function(e){	
		
		// pobranie linku do zmiennej
		const t = $(event.target);
		const h = t.closest(".tsr-click, .tsr-click-link").attr("href");
		
		// otwieranie linku
		window.open(h, "_top");
	});
	

	/* tsr-alert ON */
	// zamykanie komunikatów po kliknięciu
	$(document).on("click", ".tsr-alert, .tsr-error, .tsr-warn, .tsr-warning, .tsr-success, .tsr-info", function(t){	
		t.preventDefault();
		
		$(this).not(".tsr-button").animate({opacity: "0"}, 1000).delay(100).hide(50, function () { $(this).remove(); });
	});	
	/* tsr-alert OFF */

	/* funcka zaznacza daną opcje ON */
	function selectedOption(s, t) {
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
	/* funcka zaznacza daną opcje OFF */
	tsr_controler("rezise", function (){
		/* if ($(document).find('[tsr-content]')) {
			var screenRelativeTop =  ($(document).find('[tsr-content]').offset().top) - (window.scrollY || 
												window.pageYOffset || document.body.scrollTop);
		}
		if ($(document).find('[tsr-content]')) {
			var screenRelativeLeft = ($(document).find('[tsr-content]').offset().left) - (window.scrollX ||
                                           window.pageXOffset || document.body.scrollLeft);
		} */
	})
		
	// this function is parse date
	function dateFormat(date) {
		let dateF = new Date(date);
		const d = dateF.getDate();
		const m = dateF.getMonth(); 
		const y = dateF.getFullYear();
		const g = dateF.getHours();
		const min = dateF.getMinutes();

		if ((isNaN(d)) && (isNaN(m)) && (isNaN(y)) && (isNaN(g)) && (isNaN(min))) {
			return date;
		} else {
			return (d <= 9 ? "0" + d : d) + "." + (m <= 9 ? "0" + m : m) + "." + y + " " + g + ":" + min;
		}
	}

	function tsr_screen_position(arg) {
		
		var width_content = arg.outerWidth();
		var height_content = arg.outerHeight();
		
		var left_position = arg.offset().left;
		var top_position = arg.offset().top ;
		var right_position = (screenX - ( left_position + width_content ));
		var bottom_position = (screenY - ( top_position + height_content ));
		
		return {
			left: left_position,
			top: top_position,
			right: right_position,
			bottom: bottom_position
		}
	}

	Array.prototype.remove=function(s){
		for(i=0;i<s.length;i++){
		if(s==this[i]) this.splice(i, 1);
		}
	}

	// ready scrol bar animation
	$(document).ready(function() { 

		$('a[href^="#"]').on('click', function(event) {
		
			var target = $( $(this).attr('href') );
		
			if( target.length ) {
				event.preventDefault();
				$('html, body').animate({
					scrollTop: target.offset().top
				}, 1500);
			}
		});
	});

	function odliczanie()
	{
		var dzisiaj = new Date();
		
		var godzina = dzisiaj.getHours();
		if (godzina<10) godzina = "0"+godzina;
		
		var minuta = dzisiaj.getMinutes();
		if (minuta<10) minuta = "0"+minuta;
		
		var sekunda = dzisiaj.getSeconds();
		if (sekunda<10) sekunda = "0"+sekunda;
		
		document.getElementById("zegar").innerHTML = godzina+":"+minuta+":"+sekunda;
		 
		 setTimeout("odliczanie()",1000);
	}

	/* funckja zaznaczająca zmieniony checkbox ON */
	$(document).ready(function(){
		$(document).on("click", ".checkbox:not(:disabled)", function(){
			// szukanie inputa do zaznaczenia
			($(this).closest(".checkboxs").find('input[type="checkbox"]:not(:disabled)').attr("checked") != "checked") ? $(this).closest(".checkboxs").find('input[type="checkbox"]:not(:disabled)').prop('checked', true).attr("checked", "checked") : $(this).closest(".checkboxs").find('input[type="checkbox"]:not(:disabled)').prop('checked', false).removeAttr("checked");
		});
	});
	/* funckja zaznaczająca zmieniony checkbox OFF */	

	/* funkcja zarządzająca alertami tsr ON */

	function tsr_alert(type = "error", message, pb = ".tsr-alert-box", ht = "append", h = true, ile = 500) {
		// session storage
		let ss = window.sessionStorage;
		let li = 0;
		if (ss.getItem('tsr_alert_count_schift') == null) {
			ss.setItem('tsr_alert_count_schift', 0);
			li = 0;
		} else {
			li = ss.getItem('tsr_alert_count_schift');
			ss.setItem('tsr_alert_count_schift', li++);
		}
		if ((/^(error|info|warning|war|normal|success)$/).test(type.toString())) {
			if (type === "war") {
				type = "warning";
			}
			if (message.lenght == 0) {
				console.warn("tsr Alert: brak wiadomośći");
				return false;
			}else if ((/^(append|prepend|before|after|text|html)$/).test(ht.toString()) === false) {
				console.error("tsr Alert: Błedna metoda dodająca");
				return false;
			} else {
				if (h === true) {
					if (ht == "append") {
						$(pb).append('<div class="tsr-alert tsr-alert-'+ type +'" tsr-alert-id="'+ li +'">'+ message +'</div>');
					} else if (ht == "prepend") {
						$(pb).prepend('<div class="tsr-alert tsr-alert-'+ type +'" tsr-alert-id="'+ li +'">'+ message +'</div>');
					} else if (ht == "before") {
						$(pb).before('<div class="tsr-alert tsr-alert-'+ type +'" tsr-alert-id="'+ li +'">'+ message +'</div>');
					} else if (ht == "after") {
						$(pb).after('<div class="tsr-alert tsr-alert-'+ type +'" tsr-alert-id="'+ li +'">'+ message +'</div>');
					} else if (ht == "text") {
						$(pb).text('<div class="tsr-alert tsr-alert-'+ type +'" tsr-alert-id="'+ li +'">'+ message +'</div>');
					} else if (ht == "html") {
						$(pb).html('<div class="tsr-alert tsr-alert-'+ type +'" tsr-alert-id="'+ li +'">'+ message +'</div>');
					}
					setTimeout (function (li) {
						$(document).find(`div[tsr-alert-id='${li}']`).not(".tsr-button").animate({opacity: "0"}, 1000).delay(100).hide(50, function () { $(this).remove(); });
					}, ile, li);
				} else {
					if (ht == "append") {
						$(pb).append('<div class="tsr-alert tsr-alert-'+ type +'" tsr-alert-id="'+ li +'">'+ message +'</div>');
					} else if (ht == "prepend") {
						$(pb).prepend('<div class="tsr-alert tsr-alert-'+ type +'" tsr-alert-id="'+ li +'">'+ message +'</div>');
					} else if (ht == "before") {
						$(pb).before('<div class="tsr-alert tsr-alert-'+ type +'" tsr-alert-id="'+ li +'">'+ message +'</div>');
					} else if (ht == "after") {
						$(pb).after('<div class="tsr-alert tsr-alert-'+ type +'" tsr-alert-id="'+ li +'">'+ message +'</div>');
					} else if (ht == "text") {
						$(pb).text('<div class="tsr-alert tsr-alert-'+ type +'" tsr-alert-id="'+ li +'">'+ message +'</div>');
					} else if (ht == "html") {
						$(pb).html('<div class="tsr-alert tsr-alert-'+ type +'" tsr-alert-id="'+ li +'">'+ message +'</div>');
					}
				}
				ss.setItem('tsr_alert_count_schift', li++);
				return true;
			}
		} else {
			console.error("tsr Alert: Błędny typ");
			return false;
		}
	}

	/* funkcja zarządzająca alertami tsr OFF */
	
	$(function() {
		
		// funkcja dostosująca zawartość strony do borderu (loyaut)
		// żeby zawartość nie wychodziła po za ekran i była dynamiczne dostosowywana
		function tsr_auto_rezise(event){
			// funkcjia deweloperska
		}
		function tsr_auto_rezise_content(e){
			// przypisywanie elementu roboczego do zmiennej
			var e = $(this);
			// pobieranie marginesu kontentu
			var margin = e.attr('tsr-content-margin');
			var margin_left = e.attr('tsr-content-margin-left');
			var margin_top = e.attr('tsr-content-margin-top');
			var margin_right = e.attr('tsr-content-margin-right');
			var margin_bottom = e.attr('tsr-content-margin-bottom');
			// sprawdzanie czy znaleziono dany atrybut
			// jzżeli nie zwracanie 0
			// zliczanie ze sobą marginesów
			if(margin === undefined){
				margin = 0;
			}else{
				margin = Number(margin);
			}
			if(margin_left === undefined){
				margin_left += margin;
			}else{
				margin_left = Number(margin_left);
			}
			if(margin_top === undefined){
				margin_top += margin;
			}else{
				margin_top = Number(margin_top);
			}
			if(margin_right === undefined){
				margin_right += margin;
			}else{
				margin_right = Number(margin_right);
			}
			if(margin_bottom === undefined){
				margin_bottom += margin;
			}else{
				margin_bottom = Number(margin_bottom);
			}
			
			const class_none = e.hasClass('tsr-display-none');
			// pobieranie pozycji
			var width_content = e.outerWidth();
			var height_content = e.outerHeight();
			var width_cont = e.width();
			var height_cont = e.height();
			var top_height = e.offset().top;
			var left_width = e.offset().left;
			var scrol_top = e.scrollTop();
			var scrol_left = e.scrollLeft();
			// wyliczenie pozycji po za ekranem
			var right_width_content = left_width + width_content;
			var left_width_content = left_width + width_content;
			var left_width_content_screenX = left_width + width_content - screenX;
			
			var rect = e.getBoundingClientRect;

			// sprawdzanie czy obiekt nie jest schowany
			if(class_none == false){
				var width_content = e.outerWidth();
				var height_content = e.outerHeight();
				
				var left_position = e.offset().left;
				var top_position = e.offset().top ;
				var right_position = (screenX - ( left_position + width_content ));
				var bottom_position = (screenY - ( top_position + height_content ));
				
				var left_position = Math.abs(left_position);
				var top_position = Math.abs(top_position);
				var right_position = Math.abs(right_position);
				var bottom_position = Math.abs(bottom_position);
				
				var position_absolute = tsr_screen_position(e);
				
				if(tsr_sign(position_absolute.left) == -1){
					e.css("left", 0 + margin_left + "px");
				}else if(tsr_sign(position_absolute.top) == -1){
					e.css("top", 0 + margin_top + "px");

				}else if(tsr_sign(position_absolute.right) == -1){
					e.css("right", 0 + margin_right + "px");
				}else if(tsr_sign(position_absolute.bottom) == -1){
					e.css("bottom", 0 + margin_bottom + "px");
				}else if(tsr_sign(position_absolute.left) == 1){
					e.css("left", "");
				}else if(tsr_sign(position_absolute.top) == 1){
					e.css("top", "");
				}else if(tsr_sign(position_absolute.right) == 1){
					e.css("right", "");
				}else if(tsr_sign(position_absolute.bottom) == 1){
					e.css("bottom", "");
				}else{
					e.css("left", "");
					e.css("top", "");
					e.css("right", "");
					e.css("bottom", "");
				}
			}
			
		};

	// funkcja szukająca rodzica elementu hovera
	// funkcja animuje tooltipa rodzica w taki sposów aby był przykleiony do rodzica i był dopasowany do ekranu
	function _constructor(e){
	
	}
	$(_constructor());
	$(window).change(_constructor());
	
		// funkcja dopasowuwująca tooltipa do rozdzielcziśći ekranu
		function tsr_rezise_tooltip (r, dz){
			dz.css("width", "");
			dz.css("height", "");
			dz.css("left", "");
			dz.css("right", "");
			dz.css("top", "");
			dz.css("bottom", "");
			dz.css("margin-left", "");
			dz.css("margin-right", "");
			dz.css("margin-top", "");
			dz.css("margin-bottom", "");
			
			// pobieranie marginesu kontentu
			var margin = dz.attr('tsr-content-margin');
			var margin_left = dz.attr('tsr-content-margin-left');
			var margin_top = dz.attr('tsr-content-margin-top');
			var margin_right = dz.attr('tsr-content-margin-right');
			var margin_bottom = dz.attr('tsr-content-margin-bottom');
			// sprawdzanie czy znaleziono dany atrybut
			// jzżeli nie zwracanie 0
			// zliczanie ze sobą marginesów
			if(margin === undefined){
				margin = 0;
			}else{
				margin = Number(margin);
			}
			if(margin_left === undefined){
				margin_left = margin;
			}else{
				margin_left = Number(margin_left);
			}
			if(margin_top === undefined){
				margin_top = margin;
			}else{
				margin_top = Number(margin_top);
			}
			if(margin_right === undefined){
				margin_right = margin;
			}else{
				margin_right = Number(margin_right);
			}
			if(margin_bottom === undefined){
				margin_bottom = margin;
			}else{
				margin_bottom = Number(margin_bottom);
			}
			
			const class_none = dz.hasClass('tsr-display-none');
			// pobieranie pozycji rodzica
			var width_content = r.outerWidth();
			var height_content = r.outerHeight();
			var width_cont = r.width();
			var height_cont = r.height();
			var top_height = r.offset().top;
			var left_width = r.offset().left;
			var scrol_top = r.scrollTop();
			var scrol_left = r.scrollLeft();
			// pobieranie pozycji dziecka
			var width_content_ = dz.outerWidth();
			var height_content_ = dz.outerHeight();
			var width_cont_ = dz.width();
			var height_cont_ = dz.height();
			var top_height_ = dz.offset().top;
			var left_width_ = dz.offset().left;
			var scrol_top_ = dz.scrollTop();
			var scrol_left_ = dz.scrollLeft();
			// wyliczenie pozycji po za ekranem

			var scX = window.innerWidth;
			var scY = window.innerHeight;
			
			var lle = (left_width + ((width_content / 2) - (width_content_ / 2))); // pozycja elementu od lewej strony (w px)
			var ppe = (left_width + ((width_content / 2) + (width_content_ / 2))); // pozycja elementu od lewej strony + element (w px)
			var tte = (top_height + height_content); // pozycja elementu od góry strony (w px)
			var bbe = (top_height + ((height_content ) + (height_content_))); // pozycja elementu od góry strony + element (w px)
			var withe = ((left_width + ((width_content / 2) + (width_content_ / 2))) - scX); // wyliczanie różnicy mędzy elementem a ekranem (w px)
			var heighte = (top_height + ((height_content ) + (height_content_)) - scY); // wyliczanie różnicy mędzy elementem a ekranem (w px)
				
			// zmienna przechowywująca przykleienie do ekranu lle,ppe
			var llep=false, ppep=false;	
			
			// sprawdzanie czy tooltip jest aktywny
				if((width_content_ + (margin_left + margin_right)) >= scX){
					dz.css("top", ( margin_top) + "px");
					dz.css("left", 0 + margin_left + "px");
					dz.css("right", 0 + margin_right + "px");
					dz.css("width", ((((ppe) - withe) - margin_left) - margin_right) + "px");
					dz.css("margin-right", "0px");
					dz.css("margin-left", "0px");
				}else if(lle < 0){
					llep = true;
					dz.css("top", ( margin_top) + "px");
					dz.css("left", 0 + margin_left + "px");
					dz.css("right", "");
					dz.css("margin-left", "0px");
					dz.css("margin-right", "");
				}else if(ppe > scX){
					ppep = true;
					dz.css("top", ( margin_top) + "px");
					dz.css("right", 0 + margin_right + "px");
					dz.css("left", "");
					dz.css("margin-right", "0px");
					dz.css("margin-left", "");
				}else{
					dz.css("top", ( margin_top) + "px"); 	
				}
				if(tte < 0){
					console.log(lle);console.log(scX);console.log("tte");
					dz.css("top", (tte + margin_top) + "px");
					dz.css("bottom", "");
					dz.css("margin-top", "0px");
					dz.css("margin-bottom", "");
				}else if((bbe + (margin_top + margin_bottom)) > scY){
					console.log(ppe);console.log(scX);console.log("tte&bbe");
					dz.css("top", (tte + margin_top) + "px");
					dz.css("bottom", 0 + margin_bottom + "px");
					dz.css("height", ((((bbe - tte) - heighte) - margin_bottom) - margin_top) + "px");
					dz.css("margin-top", "0px");
					dz.css("margin-bottom", "0px");
				}
		}

		// funkcja pokazująca i chowająca kontent (tooltip)
		function tsr_rezcon (event){
			// funkcja chowająca wszystkie inne statyczne tooltipy
			tsr_rezcon_hide(this);
			
			var el = $(this);
			var previevTarget = $(event.target);
			
			// sprawdzanie czy nie zostało kliknięte dziecko
			if(previevTarget.closest(".tsr-hide").hasClass('tsr-display-block') != true ){

				// sprawdzanie czy element ma byt ("tsr-phide")
				if(el.attr("tsr-phide") == undefined){
					el.attr('tsr-phide', "false");
					el.find('.tsr-hide').first().attr('tsr-hide', "false");
					el.trigger('click');
					return false;
				}else{	
					var tsr_phide = el;
					var tsr_phide_h = el.attr("tsr-phide");
					// element śledzący
					var tsr_phide_c = el.find('.tsr-hide');
					var tsr_phide_ch = tsr_phide_c.attr('tsr-hide');
					// sprawdzanie czy nie wystąpił błąd z znalezieniem eventu
					// jeśli tak powtórzenie działań
				
					if(tsr_phide_c.hasClass('tsr-display-block') == true){
						tsr_phide_c.addClass("tsr-display-none").removeClass("tsr-display-block");
						if(tsr_phide_h == "true"){
							tsr_phide.attr('tsr-phide', "false");
							if(tsr_phide_ch == "true"){
								tsr_phide_c.attr('tsr-hide', "false");
							}
						}else if(tsr_phide_h == "true"){
							if(tsr_phide_ch == "true"){
								tsr_phide_c.attr('tsr-hide', "false");
							}
						}
					}else if(tsr_phide_c.hasClass('tsr-display-none') == true){
						tsr_rezise_tooltip(el, tsr_phide_c);
						
						tsr_phide_c.removeClass("tsr-display-none").addClass("tsr-display-block");
						if(tsr_phide_h == "false"){
							tsr_phide.attr('tsr-phide', "true");
							if(tsr_phide_ch == "false"){
								tsr_phide_c.attr('tsr-hide', "true");
							}
						}else if(tsr_phide_h == "false"){
							if(tsr_phide_ch == "false"){
								tsr_phide_c.attr('tsr-hide', "true");
							}
						}
					}
				
				}
			}

			return false;
		}
		// funkcja chowająca wszystkie tooltipy
		function tsr_rezcon_hide (parents){
			
			// dodarodzic do śledzeniasta
			if(parents != "null"){
				var ta =  $(".tsr-phide").not(parents);
			}
			if(ta.length) {
				for(var i=0;i<ta.length; i++){

					var tsr_phide_c = $(ta[i]).find(".tsr-hide");
					if(tsr_phide_c.hasClass('tsr-display-block') == true){
						console.info("999888");console.info("999888");
						$(ta[i]).attr('tsr-phide', "false");
						tsr_phide_c.attr('tsr-hide', "false");
						tsr_phide_c.addClass("tsr-display-none").removeClass("tsr-display-block");
					}
				}
			}
			
		}
		
		// opsługa ukrytego kontentu po kliknięciu
		$(document).on("click", ".tsr-phide:not(.tsr-hide)", tsr_rezcon);
		$(document).on("click", function (event) {
			if ($(event.target).closest(".tsr-hide").length === 0) {
				tsr_rezcon_hide();
			}
		});	
		
		tsr_controler("rezise", function(){
			var ees_staron = $(".tsr-phide");
			for(var i = 0; i< ees_staron.length; i++){
				if($(ees_staron[i]).find(".tsr-hide").hasClass("tsr-display-block")){
					tsr_rezise_tooltip($(ees_staron[i]), $(ees_staron[i]).find(".tsr-hide"))
				}
			}
		});

	
	
	});	

	
	var tsr = function(t){
		t();
	};
	var tsr_constructor = function(name, prototype){
		
	};
$(function() { 
	var pozCur = 0, // pozycja startowa kursora
		pozSli = 0, // pozycja slidera (1, 2, 3, 4, itp)
		posSlider = 0, // pozycia slidera po przeciągnięciu
		animateSlider = false, // zmienna przechowywująca informacje o animowaniu slider
		animSli = 500, // czas animowania funkcji
		activeEvent = false, // przechowywanie eventu działania slidera 
		pozmaxSlider = 2; // pozycja maksywalna slidera pokazuję maksywalne przesunięcie slidera [zawsze liczone od 0] zawsze (-1)
		
	
	function tsr_slider_left(event){		
		if(pozSli > 0){ 
			pozSli--
		};
		
		tsr_slider_slideStop(event);		
	}
	function tsr_slider_right(event){	
		if(pozSli < pozmaxSlider){
			pozSli++
		};;
		
		tsr_slider_slideStop(event);
	}
	function tsr_slider_slideMove(e){
		
	}
	function tsr_slider_slideStop(event){
		if(event === undefined){
			var slider = $(".tsr-pslider");
		}else{
			var slider = $(event).closest(".tsr-pslider");
		};
		
		var slider_active = $(".tsr-pslider-active");
		
		slider_active.addClass("tsr-pslider-animate");
		animateSlider = true;
		slider_active.removeClass("tsr-pslider-active");
		
		slider_active = $(".tsr-pslider-animate");
		slider_active_slider = slider_active.find(".tsr-slider");
		
		slider_active_slider.css("transform", "translate3d("+ (-pozSli*100) +"%,0,0)");
		slider_active_slider.css("transition", "all "+ animSli +"ms ease 0s");
		slider_active.attr("tsr-element-position", pozSli);

			if(pozSli > 0){ 
				$(".tsr-pslider-animate").find(".tsr-slider-left").removeClass("tsr-display-none").addClass("tsr-display-block");
				$(".tsr-pslider-animate").find(".tsr-slider-right").removeClass("tsr-display-none").addClass("tsr-display-block");
			};	
			if(pozSli == 0){ 
				$( ".tsr-pslider-animate").find(".tsr-slider-left").addClass("tsr-display-none").removeClass("tsr-display-block");
			};	
			if(pozSli == pozmaxSlider){ 
				$( ".tsr-pslider-animate").find(".tsr-slider-right").addClass("tsr-display-none").removeClass("tsr-display-block");
			};	
		
		setTimeout(function(){
			animateSlider = false;
			slider_active_slider.css("transition", "");
			slider_active.removeClass("tsr-pslider-animate");
		}, animSli);
		
	}
	
	// opsługo slidera
	$(document).on("click", ".tsr-slider-left", function(event){
		if(activeEvent == false){
			activeEvent = true;
			tsr_slider_left(event);
			setTimeout(function(){
				activeEvent = false;
			}, animSli);
		}
	});
	$(document).on("click", ".tsr-slider-right", function(event){
		if(activeEvent == false){
			activeEvent = true;
			tsr_slider_right(event);
			setTimeout(function(){
				activeEvent = false;
			}, animSli);
		};
	});
	
	$(document).on("mousedown touchstart", ".tsr-pslider", function(event) {
		if(animateSlider == false){
				$(this).addClass("tsr-pslider-active");
				
				// pobieranie maksymalnego przesunięca slidera
				if($(this).attr("tsr-element-max-position") != undefined){
					// sprawdzanie czy dany vartość konfiguracyjna jest liczbą całą
					pozmaxSlider = (($(this).attr("tsr-element-max-position")) - 1); // ustawianie maxymalnej pozycji slidera
				}
				
				// sprawdzanie czy dany slider ma konfiguracjie
				if($(this).attr("tsr-element-position") === undefined){
					$(this).attr("tsr-element-position", pozSli); // ustawienie konfiguracji pozycji startowej slidera
				}else{
					pozSli = $(this).attr("tsr-element-position"); // pobieranie pozycji slidera
				}
			
				var pozCur = event.pageX || event.originalEvent.touches[0].pageX,
				widMon = $(window).width();
				posSlider = 0;
			
			tsr_slider_slideMove(event);
			$(".tsr-pslider").on("mousemove touchmove", function(event) {
				
				var x = event.pageX || event.originalEvent.touches[0].pageX; 
				
				posSlider = (pozCur - x) / widMon * 100 ;
				console.log(posSlider, (-pozSli*100 - posSlider), pozSli, pozmaxSlider);
		  
				$(".tsr-pslider-active").find(".tsr-slider").css("transform", "translate3d("+ (-pozSli*100 - posSlider) +"%,0,0)");
			});
		};
	});
	$(document).on("mouseup touchend", function(e) {
		// usunięcie binduów na sliderze (myszki, dotyku)
		$( ".tsr-pslider-active").off("mousemove touchmove");
		if(animateSlider == false){
			if (posSlider > -8 && posSlider < 8) {
				tsr_slider_slideStop();
				return;
			}
			if (posSlider <= -8) {
				tsr_slider_left();
				
				if(pozSli > 0){ 
					$( ".tsr-pslider-active").find(".tsr-slider-left").removeClass("tsr-display-none").addClass("tsr-display-block");
				};				
			}
			if (posSlider >= 8) {
				tsr_slider_right();
				
				if(pozSli == 0){ 
					$( ".tsr-pslider-active").find(".tsr-slider-left").addClass("tsr-display-none").removeClass("tsr-display-block");
				};
				
			}		
		};
	});	
});	

	/* funckja opługująca modal box (tsr) */
	function tsr_modal(t = false, pm = ".tsr-pmodal", p = ".tsr-modal", callback = null){
		var ileModal = 0, // zmienna przechowuje ilość otworzonych modal boxów (otwieranie tego samego nie nowego)
			scroll,
			pa;		

		$(document).on("click.modal", pm, function(){
			// pobieranie pozycji scrolbar
			scroll = $(window).scrollTop();
			// ukrywanie scrolvar
			$("html").css("overflow", "hidden");
			
			// sprawdzanie czy modal inny modal box jest otwarty
			tsr_modal_hide(t, true);
			
			var pmodal = $(this);
			var modal = pmodal.find(p);
			var modal_html = (modal.html() != undefined ? modal.html() : p);
			var modalPi = pmodal.attr("tsr-modal-pi");
			var modalmax = pmodal.attr("tsr-modal-max");
			var modalI = $('div.tsr-modal-container[tsr-modal-i="'+ pmodal.attr("tsr-modal-pi") +'"]').attr("tsr-modal-i");
			var modal_container = $('div.tsr-modal-container[tsr-modal-i="'+ pmodal.attr("tsr-modal-pi") +'"]');
			var modal_close = pmodal.attr("tsr-modal-close");
			var modal_selected = (pmodal.attr("tsr-modal-selected") != undefined ? pmodal.attr("tsr-modal-selected") : undefined);
			
			// przypisywanie rodzica do zmiennej funkcyinej
			pa = pmodal;
			// sprawdzanie czy modal istnieje
			if((modalPi != undefined)){
				modal_container.removeClass("tsr-display-none").addClass("tsr-modal-active");		
			}else if((modalPi == modalI) && (modalPi != undefined)){
				modal_container.removeClass("tsr-display-none").addClass("tsr-modal-active");
			}else{
				pmodal.attr("tsr-modal-pi", ileModal); // dodawanie zliczania modal boxa
				// sprawdzanie czy modal istnieje w rodzicu
				if(modal_html == undefined){
					modal_html = "undefined";
					console.error("modal is undefined");
				}else if (is_json(modal_html)) {
					modal_html = JSON.parse(modal_html);
				}else if (typeof modal_html == 'object') {
					modal_html = $("<div>").append(modal_html)[0].innerHTML;
				}

				if (typeof modal_html == 'object') {
					// wstawianie modal box'a
					$("body").append(`<div class="tsr-modal-container tsr-modal-active"> <div class="tsr-modal-container-content"> <div class="tsra"> ${modal_html} </div> <div class="tsr-modal-close tsr-modal-closed-button"></div> </div> </div>`);
					$(".tsr-modal-active .tsra").append(modal_html);
				}else{
					// wstawianie modal box'a
					$("body").append(`<div class="tsr-modal-container tsr-modal-active"> <div class="tsr-modal-container-content"> <div class="tsra"> ${modal_html} </div> <div class="tsr-modal-close tsr-modal-closed-button"></div> </div> </div>`).closest();
				}

				$(".tsr-modal-active").attr("tsr-modal-i", ileModal); // dodawanie zliczania modal boxa
				ileModal++ // dodawanie o jeden liczy modal boxów
				
				// wykonywanie ustawień modal boxa
				if(modal_close === undefined){
					if(t == true){
						$(".tsr-modal-active").addClass("tsr-modal-closed");
					}else if(t == "false"){
						$(".tsr-modal-active").removeClass("tsr-modal-closed");
					}
				}else{
					if(modal_close == "true"){
						$(".tsr-modal-active").addClass("tsr-modal-closed");
					}else if(modal_close == "false"){
						$(".tsr-modal-active").removeClass("tsr-modal-closed");
					}
				};
				
				// sprawdzanie czy blogada zaznaczenia istnieje
				if	(modal_selected != undefined) {
					if (modal_selected === false) {
						$(".tsr-modal-active").addClass("tsr-modal-selected");
						$(".tsr-modal-active > *").addClass("tsr-modal-selected");
					}else{
						if ($(".tsr-modal-active").hasClass("tsr-modal-selected")) {
							$(".tsr-modal-active").removeClass("tsr-modal-selected");
							$(".tsr-modal-active > *").removeClass("tsr-modal-selected");
						}
					}
				}
				
				// sprawdzanie czy użyć moaksymalnej rozdzielczośći okna czy użyć auto proporcji
				if(modalmax == "true"){
					$(".tsr-modal-active").find(".tsr-modal-container-content").addClass("tsr-modal-container-content-max");
				}else if(modalmax == "width"){
					$(".tsr-modal-active").find(".tsr-modal-container-content").addClass("tsr-modal-container-content-width");
				}else if(modalmax == "height"){
					$(".tsr-modal-active").find(".tsr-modal-container-content").addClass("tsr-modal-container-content-height");
				}			
				
				// sprawdzanie czy callback istnieje
				if(callback != null){
					// is function
					if(typeof callback == 'function'){
						// wywoływanie funkcji
						callback(ileModal, pmodal, modal, $("tsr-modal-container tsr-modal-active"));
					}
				}
			}
		
		}); // pokazywanie modal boxa
		
		function tsr_modal_hide(t = false, m = false){
			// spradzanie czy usunąć overflow
			if(m == false){			
				// ukrywanie overflow
				$("html, body").css("overflow", "");
			}
			// sprawdzanie czy modal jest do usunięcia
			if($(".tsr-modal-active").hasClass("tsr-modal-closed") == true){
				$(".tsr-modal-active").remove();
				$(pa).removeAttr("tsr-modal-pi");
			}else{
				if(t == true){
					$(".tsr-modal-active").remove();
					$(pa).removeAttr("tsr-modal-pi");
				}else{
					$(".tsr-modal-active").addClass("tsr-display-none").removeClass("tsr-display-block").removeClass("tsr-modal-active");
				}
			}
		}
		
		// opsługa modal box'a po kliknięciu
		$(document).on("click", ".tsr-modal-active", function (event) { 
		// ukrywanie modal boxa po kliknięciu na overlay
			if ($(event.target).closest(".tsr-modal-container-content").hasClass("tsr-modal-container-content") === false) {
				tsr_modal_hide();			
			}
			return false;
		});
		$(document).on("click", ".tsr-modal-closed-button", tsr_modal_hide); // ukrywanie modal boxa
	}
	
	// wyzwalanie domyśnej funkcji tsr_modal
	tsr_modal(t = false, ".tsr-pmodal", ".tsr-modal");

	// funkcjia blokująca submit | buttony | form
	function tsr_blocked_submit(t = 5000,block = ""){
		var a = "";
		// sprawdzanie czy block ma jakąś wartość
		if(block.lenght != 0){
			a = ",";
		}
		
		// wyłączanie butonów
		$('button, [type="submit"], .tsr-disable-button, .tsr-disabled-button, .tsr-disable-buttons, .tsr-disabled-buttons'+a+block).attr("disable", "true").attr("disabled", "true");
		
		setTimeout(function(){
			// włączanie bótonów
			$('button, [type="submit"], .tsr-disable-button, .tsr-disabled-button, .tsr-disable-buttons, .tsr-disabled-buttons'+a+block).removeAttr("disable").removeAttr("disabled");
		}, t);
	}
	
	// funkcja zliczająca index elementów
	function tsr_index(r, dz , d = null, box = null, t = null){
		// zmienna przechowywująca dane o strukturze
		var a = [],
			b = "";
		// pobieranie elementu rodzica
		let gr = $(document).find(r);
		// pobieranie elementu dziecka
		let gdz = gr.children(dz);
		console.log(gr);console.log(gdz);
		// sprawdzanie czy obiekt docelowy ma dzieci o podanej klasie (dz)
		if(gdz.length ==  0){
			// sprawdzanie czy rodzic posiada szukany atrybut
			if(gr.attr(d) != undefined){
				// zamienianie orginalnego obiektu na obiekt rodzica
				gdz = gr;
			// sprawdzanie czy dziecko rodzica posiada szukany obiekt
			}else if(gr.children(t) != undefined){
				// zamienianie orginalnego obiektu na obiekt rodzica
				gdz = gr;
			}else{
				// zamienianie orginalnego obiektu na obiekt rodzica
				gdz = gr.children(box).children(dz);
			}
		}
		// sprawdzanie czy objekt można zindexować
		if(gdz.length !=  0){
			// pętla pobierająca dane do struktury
			for(var i = 0; i < gdz.length; i++){
				// sprawdzanie czy zaindexować data elementu czy  sam element
				if(d == null){
					// sprawdzanie czy rodzic nie jest pusty
					if(gdz[i].length != 0){
						// tworzenie tablicy do przechowywania danych struktury
						let c = {item :gdz[i].outerHTML};
						// spradzanie czy element ma dziecko
						if($(gdz[i]).find(box).length != 0){
							c["children"] = (tsr_index($(gdz[i]).find(box).first(), dz, d, box, t));
						}
						// dodawanie obiektu do struktury indexowania
						a.push(c);
					}
				}else if(d == "title"){
					// sprawdzanie czy rodzic nie jest pusty
					if($(gdz[i]).children(t).first().length != 0){
						// tworzenie tablicy do przechowywania danych struktury
						let c = {title: null};
						// dodawanie danych do id
						c["title"] = $(gdz[i]).children(t).first().text();
						// spradzanie czy element ma dziecko
						if($(gdz[i]).find(box).length != 0){
							c["children"] = (tsr_index($(gdz[i]).find(box).first(), dz, d, box, t));
						}
						// dodawanie obiektu do struktury indexowania
						a.push(c);
					}
				}else if(d == "text"){
					// sprawdzanie czy rodzic nie jest pusty
					if($(gdz[i]).children(t).first().length != 0){
						// dodawanie danych do id
						if(i == 0){
							b +=  ($(gdz[i]).children(t).first().text());
						}else{
							b += "," + ($(gdz[i]).children(t).first().text());
						}
						// spradzanie czy element ma dziecko
						if($(gdz[i]).find(box).length != 0){
							b += "," + (tsr_index($(gdz[i]).find(box).first(), dz, d, box, t));
						}
					}
				}else if(t == "text"){
					// sprawdzanie czy rodzic nie jest pusty
					if($(gdz[i]).length != 0){					
						// dodawanie danych do id
						if(i == 0){
							b +=  $(gdz[i]).attr(d);
						}else{
							b += "," + $(gdz[i]).attr(d);
						}
						// spradzanie czy element ma dziecko
						if($(gdz[i]).find(box).length != 0){
							b += "," + (tsr_index($(gdz[i]).find(box).first(), dz, d, box, t));
						}
					}
				}else{
					// sprawdzanie czy rodzic nie jest pusty
					if($(gdz[i]).length != 0){			
						// sprawdzanie czy objekt istneje
						if($(gdz[i]).attr(d) != undefined){					
						// tworzenie tablicy do przechowywania danych struktury
						let c = {id: null};
							// dodawanie danych do id
							c["id"] = $(gdz[i]).attr(d);
							// spradzanie czy element ma dziecko
							if($(gdz[i]).find(box).length != 0){
								c["children"] = (tsr_index($(gdz[i]).find(box).first(), dz, d, box, t));
							}
							// dodawanie obiektu do struktury indexowania
							a.push(c);
						}
					}
				}
			}
		}
		if((d == "text") || (t == "text")){
			return b;
		}else{
			// zwracanie wyniku index'owania
			return a;
		}
	}

	// funckja ładujące strony do kontenerów i zarządzanie nimi
	async function tsr_load_page(url, p = null){
	// zmienne przechowywujące konfiguracje ładowania strony
	var count_strona_load = 0,
		strona_load_akcja = "ajax.php",
		strona_load_append = $(document).find(".container, .container-all");
		// pobieranie danych url
		var urls = new URL(window.location.protocol+"//"+window.location.hostname+url);
		strona_load_page_find = strona_load_append.find('.tsr-load-page[tsr-url-title="'+urls.pathname+'"]'),
		// pobieranie strony aktywnej
		strona_load_page_active = strona_load_append.find('.tsr-page-active');
		
		// dodawanie kontenera przechowywującego stronę w kontenerze
		if(strona_load_page_find.attr("tsr-url-title") == undefined){
			
			$.ajax({
				type:"POST",
				url:"ajax.php" + window.location.search,
				data:{
					akcja:"load_page",
					strona_laduj:url,
				}
			})
			.done(function(info){
				// sprawdzanie czy istnieje aktywny element 
				if(strona_load_page_active != undefined){
					if(strona_load_page_active.hasClass("tsr-page-save") == true){
						strona_load_page_active.addClass("tsr-display-none");
						strona_load_page_active.removeClass("tsr-page-active");
					}else{
						strona_load_page_active.remove();
					}
				}
				strona_load_append.append('<div class="tsr tsr-load-page tsr-page-active" tsr-url-title="'+url+'"> '+info+' </div>');
				
			})
			.fail(function(){
				alert("Wystąpił błąd. Spróbuj ponownie później");
			});
		}else{
			// sprawdzanie czy istnieje aktywny element 
			if(strona_load_page_active.attr("tsr-url-title") != strona_load_page_find.attr("tsr-url-title")){
				alert(strona_load_page_active.hasClass("tsr-page-save"));
				if(strona_load_page_active.hasClass("tsr-page-save") == true){
					// chowanie aktywnej strony
					strona_load_page_active.addClass("tsr-display-none");
					strona_load_page_active.removeClass("tsr-page-active");
					// pokazywanie ukrytej strony
					strona_load_page_find.removeClass("tsr-display-none");
					strona_load_page_find.addClass("tsr-page-active");
				}else{
					// usuwanie aktywnej strony
					strona_load_page_active.remove();
					// pokazywanie ukrytej strony
					strona_load_page_find.removeClass("tsr-display-none");
					strona_load_page_find.addClass("tsr-page-active");
				}
			}
		}
		
	}

	// funkcjia zmieniająca url na żywo
	function ChangeUrl(title, url) {
		if (typeof (history.pushState) != "undefined") {
			var obj = { Title: title, Url: url };
			history.pushState(obj, obj.Title, obj.Url);
		} else {
			alert("Browser does not support HTML5.");
		}
	}
	$(document).on("click", ".tsr-zmiana-url", function(oEvent){
		// pobieranie url tytuł
		var urls = new URL(window.location.protocol+"//"+window.location.hostname+$(this).attr("tsr-url"));
		
		ChangeUrl($(this).attr("tsr-url"), $(this).attr("tsr-url"));
		tsr_load_page(urls.pathname);
		
	}); 
	$(document).on("click", ".tsr-zmiana-aurl", function(e){
		// wyłącznie dymyśniej akcji js
		e.preventDefault();
		// pobieranie url tytuł
		var urls = new URL(window.location.protocol+"//"+window.location.hostname+ $(this).attr("href"));
		
		ChangeUrl($(this).attr("href"), $(this).attr("href"));
		tsr_load_page(urls.pathname);
		
	}); 
	// sprawdzanie czy strona zawiera asynchronicze ładowanie strona
	// sprawdzanie czy w html(class) znajduje się klasa(tsr-load-content-page)
	$(document).ready(function(){
		if($(document).find("html").hasClass("tsr-load-content-page")){
			// pobieranie url tytuł
			var urls = new URL(window.location.protocol+"//"+window.location.hostname+window.location.pathname);
			tsr_load_page(urls.pathname);		
		}
	});
	// fynkcja zmieniająca url i doładywująca strone po wywułaniu funkcji
	function tsr_change_page(t){
		var urls = new URL(window.location.protocol+"//"+window.location.hostname+t);
		ChangeUrl(t, t);
		tsr_load_page(urls.pathname)
	}

	// funkcja pętlująca dane(html) i dodająca je do wybranej lakalizaci
	// dane array, wzór danych html z (tablicą {tablica['zmienna']}), (tablica głwna {tablica}) ,, append dodaj do kontenera
	function tsr_fordata(data, array, tab, append){
		var tab = data; 
		var i = 1;
		
		for(var tab = 0;tab < data.lenght; tab++){
		}
		
	}

	// funckja ładujące dane z serwera
	async function tsr_load_data(urls, datas = "", data2 = "", jsons = true, fun = null){
		// sprawdzanie czy konwerowanie na json jest włączone - domyśnie: tak
		if(jsons == true){
			datas = JSON.stringify(datas);
		}
		
		$.ajax({
			type:"POST",
			url:"ajax.php"+data2,
			data:{
				akcja:"load_data",
				data_laduj:urls,
				data: datas,
			}
		})
		.done(function(info, arg){
			 
			if(is_json(info)){
				// konwerowanie json to string
				info = JSON.parse(info);	
				if(fun == null){
					console.log("tsr_load_data: "+urls+". Complete load");
					console.warn("tsr_load_data: function is null");
				}else{
					fun(info);
					
					console.log("tsr_load_data: "+urls+". Complete load");
				}
				
				return true;
			}else{
				console.error("tsr_load_data: not type avaliable");
				return false;
			}
		})
		.fail(function(){
			// zwracanie błędu o i pokazywanie go
			alert("Wystąpił błąd. Spróbuj ponownie później");
		});
	}	

	// funckja wysyłające dane z serwera
	async function tsr_data(urls, datas = "", data2 = "", jsons = true, fun = null){	
		// sprawdzanie czy konwerowanie na json jest włączone - domyśnie: tak
		if(jsons == true){
			datas = JSON.stringify(datas);
		}
	
		$.ajax({
			type:"POST",
			url:"ajax.php"+data2,
			data:{
				akcja:urls,
				data: datas,
			}
		})
		.done(function(info, arg){
			
			if(jsons == false){
				if(fun == null){
					console.log("tsr_data: "+urls+". Complete load");
					console.warn("tsr_data: function is null");
				}else{
					fun(info);
					
					console.log("tsr_data: "+urls+". Complete load");
				}
				
				return true;
			}else{
				if(is_json(info)){
					// konwerowanie json to string
					info = JSON.parse(info);	
					
					if(fun == null){
						console.log("tsr_data: "+urls+". Complete load");
						console.warn("tsr_data: function is null");
					}else{
						fun(info);
						
						console.log("tsr_data: "+urls+". Complete load");
					}
					
					return true;
				}else{
					return false;
				}
			}
		})
		.fail(function(){
			// zwracanie błędu o i pokazywanie go
			alert("Wystąpił błąd. Spróbuj ponownie później");
		});
	}	

	// funckja wysyłające dane z serwera
	async function tsr_ajax(urls, datas = "", data2 = "", jsons = true, fun = null, fune = null){	
		// sprawdzanie czy konwerowanie na json jest włączone - domyśnie: tak
		if(jsons == true){
			datas = JSON.stringify(datas);
		}
	
		$.ajax({
			type:"POST",
			url: urls+data2,
			data: datas
		})
		.done(function(info, arg){
			
			if(jsons == false){
				if(fun == null){
					console.log("tsr_data: "+urls+". Complete load");
					console.warn("tsr_data: function is null");
					return true;
				}else if(fun == "return"){
					// zwracanie wyniku
					return  info.toString();
				}else{
					fun(info);
					
					console.log("tsr_data: "+urls+". Complete load");
					return true;
				}
			}else{
				if(is_json(info)){
					// konwerowanie json to string
					info = JSON.parse(info);	
					
					if(fun == null){
						console.log("tsr_data: "+urls+". Complete load");
						console.warn("tsr_data: function is null");
					}else{
						fun(info);
						
						console.log("tsr_data: "+urls+". Complete load");
					}
					
					return true;
				}else{
					console.error("tsr_data: not type avaliable");
					return false;
				}
			}
		})
		.fail(function(){
			// zwracanie błędu o i pokazywanie go
			// sprawdzanie czy callback istnieje
			if(fune != null){
				// is function
				if(typeof fune == 'function'){
					// wywoływanie funkcji
					fune(urls);
				}
			}else{
				// zwracanie błędu o i pokazywanie go
				alert("tsr_data: unknown error");
			}
		});
	}	
	
	// algorytm zaznaczający wszystkie checkbox po kliknięciu w główny checkbox
	function tsr_checkboxall(pchec_container = ".tsr-checkbox-container", pchec = ".tsr-pcheckbox", chec = ".tsr-checkbox"){
		var pchec_container = $(document).find(pchec_container);
	
		// zaznaczanie checkbox po kliknięciu w głowny checkbox
		$(pchec_container).on("click", pchec,function() {    
			$(pchec_container).find(':checkbox.tsr-checkbox').prop('checked', this.checked);  
			$(pchec_container).find(':checkbox.tsr-pcheckbox').prop('checked', this.checked);    
		 });
		 
		$(pchec_container).on("click", chec,function() {     
			// sprawdzanie czy checkbox = zaznaczonymi checkbox
			// jeśli tak zaznaczanie głównego checkbox jeśli nie odznaczonie głównego checkbox
			if($(pchec_container).find(chec).length == $(pchec_container).find(chec+":checked").length){
				$(pchec_container).find(':checkbox.tsr-pcheckbox').prop('checked', true); 
			}else{
				$(pchec_container).find(':checkbox.tsr-pcheckbox').prop('checked', false);
				tsr_get_checkbox_data();
			}
		});
		
	}

	// algorytm zaznaczający wszystkie checkbox (wystylizowany checkbox) po kliknięciu w główny checkbox
	function tsr_checkboxall2(pchec_container = ".tsr-checkbox-container", pchec = ".tsr-pcheckbox", chec = ".tsr-checkbox"){
		var pchec_container = $(document).find(pchec_container);
		// zaznaczanie checkbox po kliknięciu w głowny checkbox
		$(pchec_container).on("click", pchec+':not(:disabled)',function() {    
			// zmienna przechowywuje zmiene o dyfoltowych checkbox'ach
			let x = $(this).closest("label.checkboxs").find('input[type="checkbox"]');
			// sprawdzenie czy znaleziono objekt
			if(x.attr("disabled") != "disabled"){
				$(pchec_container).find(':checkbox'+chec+':not(:disabled)').prop('checked', !x.prop('checked')).attr("checked", !x.prop('checked'));  
				$(pchec_container).find(':checkbox'+pchec+':not(:disabled)').not("[disabled]").not($(this).closest("label.checkboxs").find('input[type="checkbox"]:not(:disabled)')).prop('checked',  !x.prop('checked')).attr("checked", !x.prop('checked'));   
			}
		 });
		 
		$(document).find(pchec_container).on("click", chec+':not(:disabled)', function(event) {  
			queueMicrotask((event) => {
				setTimeout( function(event){
					// sprawdzanie czy checkbox = zaznaczonymi checkbox
					// jeśli tak zaznaczanie głównego checkbox jeśli nie odznaczonie głównego checkbox
					if($(pchec_container).find('input[type="checkbox"]:not(:disabled)'+chec).length == $(pchec_container).find('input[type="checkbox"][checked="checked"]'+ chec +':not(:disabled)').length){
						$(pchec_container).find(pchec+':checkbox:not(:disabled)').not("[disabled]").prop('checked', true).attr("checked", true);  
					}else{
						$(pchec_container).find(pchec+':checkbox:not(:disabled)').not("[disabled]").prop('checked', false).attr("checked", false);  
					}
				} , 0);
			});
		});
		
	}
	
	// funkcja pobierająca dane z zaznaczonych checkbox'ów
	function tsr_get_checkbox_data(data = "tsr-data", pchec_container = ".tsr-checkbox-container", pchec = ".tsr-pcheckbox", chec = ".tsr-checkbox"){
		var pchec_container = $(document).find(pchec_container),
			t = {};
			
		if($(pchec_container).find(pchec).attr(data) != undefined){
			t["name"] = $(pchec_container).find(pchec).attr(data);
		}
			
		t["content"] = [];
		
		for(var i = 0; i< $(pchec_container).find('input[checked="checked"]'+chec).length; i++){
			if($(pchec_container).find('input[checked="checked"]'+chec).eq(i).attr(data) != undefined){
				t["content"][i] = $(pchec_container).find('input[checked="checked"]'+chec).eq(i).attr(data);
			}
		}
		
		return t;
	}

	// czeba dopracować tabele żeby dopracować tą funkcje
	function tsr_checkbox_del(data = "tsr-data", pchec_container = ".tsr-checkbox-container",chec = ".tsr-checkbox", pchec = ".tsr-row-del"){
		var t = $(document).find(pchec_container);
		let a = $(t).find('input[checked="checked"]'+chec);
		for(var i = 0; i< a.length; i++){
			if(a.eq(i).attr(data) != undefined){
				$(a[i]).closest(pchec).hide(1000, function () { $(this).remove(); });
			}
		}
		return true;
	}
	// bez zaznaczonego checkbox
	function tsr_checkbox_del2(data = "tsr-data", pchec_container = ".tsr-checkbox-container",chec = ".tsr-checkbox", pchec = ".tsr-row-del"){
		var t = $(document).find(pchec_container);
		let a = $(t).find(chec);
		for(var i = 0; i< a.length; i++){
			if(a.eq(i).attr(data) != undefined){
				$(a[i]).closest(pchec).hide(1000, function () { $(this).remove(); });
			}
		}
		return true;
	}
	
	
	// funckja sortująca tabelowo (można przesuwać)
	function tsr_sortiner(data = "tsr-data", psort_container = "tsr-psort-container",sort = "tsr-sortiner", sortitem = "tsr-sortitem", index = 2, box = "tsr-sortbox", klon = false, delay = 25) {
		// pominięcie interfeisu drag and drop ze względu na małąkompatebilnośći ze smartfonami (testowane rozwiązanie)
		
		// zmienna przechowywująca 
		let statY = 0,
			statX = 0,
			pozcY = 0,
			pozcX = 0;
			move = false,
			is_klon = true;
		// zmienne przchowywujące dane o innej liście do posortowania
		var box_p,
			pozboxpY,
			pozboxpX;
			
		// zmienna opdowaiada za bufforowania obiektu przeciąganego	
		var buff,
			klon_buff = klon;
		
		$(document).on("mousedown touchstart", ".tsr-sort-handle", function(event) {
			
			let tes = $(this).closest(sort);
			
			// sprawdzanie czy istnieje klasa przeciągająca do innego pox'a
			if($(box).length != 0){
				box_p = $(box);
				pozboxpY = box_p.offset().top;
				pozboxpX = box_p.offset().left;
				
				// buforowanie elementu przeciągającego
				buff = tes.clone();
			}
				
			// przypisanie zmiennej początkowej
			statY = $(tes).offset().top;
			statX = $(tes).offset().left;
			
			// pobieranie zewnęcznych wymiarów obiektu, wrzucanie je do zmiennych
			let width = tes.outerWidth(true);
			let height = tes.outerHeight(true);
			
			// pobieranie pozycji kursora i przypisanie ich do zmiennych
			var x = event.pageX || event.originalEvent.touches[0].pageX; 
			var y = event.pageY || event.originalEvent.touches[0].pageY; 
			
			// pypisywanie pozycji złapanego elementu;
			pozcY = (y - statY);
			pozcX = (x - statX);
			
			// sprawdzanie czy listę można sortować
			if($(psort_container).find(this).hasClass("tsr-sort-handle")){
				// zmianianie zmiennej move na true
				move = true;
				// dodawanie placeholder za item
				$(this).closest(sort).before('<div class="tsr tsr-sortiner-placeholder" style="height: '+ tes.outerHeight(true) +'px;"></div>');
				// tworzenie obiektu clona
				let obj_sort_item = $(this).closest(sort);
				// przypisywanie nowych referencji
				obj_sort_item.removeClass(sort.substr(1)).addClass("tsr-sortiner-active tsr-sortiner-drag tsr-position-absolute").css("width", width + "px").css("height", height + "px").css("top", $(obj_sort_item).offset().top + "px").css("left", $(obj_sort_item).offset().left + "px");
				
				// dodawanie elementu sortujacego do body
				$("body").append(obj_sort_item);
			}
			
		});
		
		$(document).on("mouseup touchend", function(event) {
			// wyłączenie rouchu przeciągniętego elementu
			move = false;
			
			// usuwanie elementu zastępczego
			$(".tsr-sortiner-active").find(".tsr-sort-handle").off("mousemove touchmove");
			$(".tsr-sortiner-active").off("mousemove touchmove");
			$(".tsr-sortiner-active").off("mousemove").off("touchmove");
			
			// pobieranie itemu sortowanego do pamięći virtualnej
			var buffor = $(".tsr-sortiner-active");
			// usuwanie elementu zastępczego
			$(".tsr-sortiner-active").find(".tsr-sort-handle").off("mousemove touchmove");
			
			// usuwanie atrybutów
			buffor.addClass(sort.substr(1)).removeClass("tsr-sortiner-active tsr-sortiner-drag tsr-position-absolute").css("transform", "").css("width", "").css("height", "").css("top", "").css("left", "").off("mousemove touchmove").off("mousemove touchmove");
			
			// powracanie itemu po przesunięciu
			$(".tsr-sortiner-placeholder").before(buffor);
			
			// usuwanie placeholder
			$(".tsr-sortiner-placeholder").remove();
			
			// wyłączenie możliwośći animowania przeciągniętego elementu
			tsr_sort_anim = false;
			
			// sprawdzanie czy element ma zostać skopiowany > kontrolowanie klonowania
			if(klon_buff == true){
				klon = true;
			}
			// wyłączenie klonowania 2 raz
			if(is_klon == false){
				is_klon = true;
			}
			
		});	
		
		$(document).on("mousemove touchmove",  function(event) {
			
			// sprawdzanie czy jest ruch
			if(move == true){
			
				setTimeout((function () {
					 
					 // ustawianie zmienych
					 // null, rodzic do przeciągającego elementu, poprzedni element, następny element, ilość dzieci w rodzicu
					 var list, parent, prev, next, depth,
					opt   = this.options,
					mouse = this.mouse;
					
					// pobieranie elementu głównego
					var tes = $(".tsr-sortiner-placeholder");
					
					// pobieranie pozycji kursora
					var x = event.pageX || event.originalEvent.touches[0].pageX,
						y = event.pageY || event.originalEvent.touches[0].pageY; 
					
					// przypisanie zmiennej początkowej
					statY = $(tes).offset().top;
					statX = $(tes).offset().left;
					
					// przesuwanie placeholder
					$(".tsr-sortiner-active").css("top", (y - pozcY) + "px").css("left", (x - pozcX) + "px");
					
					// pobieranie danych o pazycjach elementów
					prev = tes.prev();
					next = tes.next();
					
					// sprawdzanie czy obiekt można kopiować
					if(klon != true){
						// sprawdzanie czy element ma klasę
						if(next.hasClass(sort.substr(1))) {
							// sprawdzanie czy element przeciągany można odłączyc od rodzica
							if((statY + ($(next).outerHeight(true))) < y){
								// sprawdzenie czy nastepny element istnieje
								if(next != undefined) { 
									// przenoszenie elemntu (ducha) do następnego obiektu listy
									$(next).after($(".tsr-sortiner-placeholder"));
								}
							}
						}
						
						// sprawdzanie czy element poprzedni ma klasę sortującą
						if(prev.hasClass(sort.substr(1))) {
							// sprawdzenie czy element ma zostac przyłączony do rodzica
							if((statY - ($(prev).outerHeight(true) / 2)) > y){
								// przenoszenie elementu (ducha) do poprzedniego obiektu listy
								$(prev).before($(".tsr-sortiner-placeholder"));
								
							}
							// spradzanie czy element ma zostać odłączony od rodzica
							if((statX + ($(prev).outerWidth(true) / 4)) < x){
								// sprawdzanie czy lista nie przekracza limitu przeciągania
								if(tes.parents(sortitem).length+1  < index){
									
									// sprawdzanie czy lista nie przekracza limitu przeciągania wraz z limitem obiektu przeciągającego
									if((($(tes).parents(sortitem).length+1) + ($(".tsr-sortiner-active").find(sortitem).length ))  < index){
										
										// sprawdzanie czy rodzic ma klasę sortującą
										if($(prev).hasClass(sort.substr(1))){
											// sprawdzenie czy elemtn nie ma dzieci
											if($(prev).children(sortitem).length == 0){
												// dodawanie elementu sotującego do listy
												$(prev).append('<div class="'+ sortitem.substr(1) +'"></div>');
											}
											// sprawdzenie czy elemtn ma dzieci
											if($(prev).children(sortitem).length == 1){
												// dodawanie elementu (ducha) do pierwszego elemtu listy
												$(prev).find(sortitem).first().append($(".tsr-sortiner-placeholder"));
											}
										}
									}
								}
							}
						}
					}
					
					// sprawdzanie czy element przeciągany ma klasę sortującą
					if($(tes).closest(sort).hasClass(sort.substr(1))) {
						// sprawdzenie czy element jest przeciągnięty
						if((statX) > x){
							
							if($(tes.parentNode).hasClass(sort.substr(1))){
								$(tes).closest(sort).before(tes);
							}
							
							var reg = $(tes).closest(sort);
							
							if($(tes).closest(sort).children(sortitem).length == 1){
								$(tes).closest(sort).before(tes);
								
								//sprawdzanie czy elment do sortowania dzieci jest pusty
								if($(reg).children(sortitem).first().children().length == 0){
									$(reg).children(sortitem).first().remove();
								}
							}
							
						}
					}
					
					// sprawdzanie czy box do przeciągnięcia istnije
					if($(box).length != 0){
						// pętla przeprowadzajća operacje na obiektach
						for(var i = 0; i < $(box).length; i++){
							box_p = $(box);
							pozboxpY = box_p.eq(i).offset().top;
							pozboxpX = box_p.eq(i).offset().left;
							
							// sprawdzanie czy element mieśi się w kontenerze do przeciągnięcia
							if(((pozboxpY + (box_p.eq(i).height())) > y) && ((pozboxpY + ((box_p.eq(i).outerHeight(true) - box_p.eq(i).height()) / 2)) < y) && ((pozboxpX + (box_p.eq(i).width())) > x) && ((pozboxpX ) < x)){
								// sprawdzanie czy objekt był już skopiowany
								// sprawdzenie czy element jest jedyny
								if($(".tsr-sortiner-placeholder").closest(box_p.eq(i)).length == 0){
									// sprawdzanie czy moża kopiować obiekty
									if(klon_buff == true && is_klon == true){
										// kopiowanie elementu przeciągającego do (ducha) z buffora
										$(".tsr-sortiner-placeholder").after(buff);
									}
									// przenoszenie elemetu (ducha) do nowego box'a
									$(box_p.eq(i)).append($(".tsr-sortiner-placeholder"));
									
									// umożliwianie ruchu elementu
									move = true;
									// blokowania kopiowania elementu
									klon = false;
									
									// wyłączenie klonowania po pierwszym sklonowaniu
									is_klon = false;
									
									// sprawdzanie czy llista jest pusta
									if($(box_p.eq(i)).children().length == 0){
										// dodawanie klasy pustej do głownej listy
										$(box_p.eq(i)).addClass("tsr-sort-no-drag");
									}else{
										// sprawdzanie czy głowna lista ma klasę pustą
										if($(box_p.eq(i)).hasClass("tsr-sort-no-drag")){
											// usuwanie klasy pustej z głównej listy
											$(box_p.eq(i)).removeClass("tsr-sort-no-drag");
										}
									}
								}
							}
						}
						// sprawdzanie czy użytkownik powrucił do box'a startowego
						// w następnej aktulizacji 
					}
				}).bind(this), delay);
			}
			
			// pętla sprawdzająca puste listy sortujące
			for(var i = 0;i < $(psort_container).length; i++){
				let o = $(psort_container);
				
				// sprawdzanie czy llista jest pusta
				if($(o[i]).children().length == 0){
					// sprawdzanie czy dany objekt ma dodaną klasę
					if(!$(o[i]).hasClass("tsr-sort-no-drag")){
						// dodawanie klasy pustej do głownej listy
						$(o[i]).addClass("tsr-sort-no-drag");
					}
				}else{
					// sprawdzanie czy głowna lista ma klasę pustą
					if($(o[i]).hasClass("tsr-sort-no-drag")){
						// usuwanie klasy pustej z głównej listy
						$(o[i]).removeClass("tsr-sort-no-drag");
					}
				}
			}
			
		});
	}
	
	// funkcjia indexująca listę sortującą
	function tsr_sortiner_index(r, dz , d = null, box = null, t = null){
		// zmienna przechowywująca dane o strukturze
		var a = [],
			b = "";
		// pobieranie elementu rodzica
		let gr = $(document).find(r);
		// pobieranie elementu dziecka
		let gdz = gr.children(dz);
		
		// sprawdzanie czy obiekt docelowy ma dzieci o podanej klasie (dz)
		if(gdz.length ==  0){
			// sprawdzanie czy rodzic posiada szukany atrybut
			if(gr.attr(d) != undefined){
				// zamienianie orginalnego obiektu na ogiekt rodzica
				gdz = gr;
			// sprawdzanie czy dziecko rodzica posiada szukany ogiekt
			}else if(gr.children(t) != undefined){
				// zamienianie orginalnego obiektu na ogiekt rodzica
				gdz = gr;
			}else{
				// zamienianie orginalnego obiektu na ogiekt rodzica
				gdz = gr.children(box).children(dz);
			}
		}
		
		// pętla pobierająca dane do struktury
		for(var i = 0; i < gdz.length; i++){
			// sprawdzanie czy zaindexować data elementu czy  sam element
			if(d == null){
				// tworzenie tablicy do przechowywania danych struktury
				let c = {item :gdz[i].outerHTML};
				// spradzanie czy element ma dziecko
				if($(gdz[i]).find(box).length != 0){
					c["children"] = (tsr_sortiner_index($(gdz[i]).find(box).first(), dz, d, box, t));
				}
				// dodawanie obiektu do struktury indexowania
				a.push(c);
			}else if(d == "title"){
				// tworzenie tablicy do przechowywania danych struktury
				let c = {title: null};
				// dodawanie danych do id
				c["title"] = $(gdz[i]).children(t).first().text();
				// spradzanie czy element ma dziecko
				if($(gdz[i]).find(box).length != 0){
					c["children"] = (tsr_sortiner_index($(gdz[i]).find(box).first(), dz, d, box, t));
				}
				// dodawanie obiektu do struktury indexowania
				a.push(c);
			}else if(d == "text"){
				// dodawanie danych do id
				if(i == 0){
					b +=  ($(gdz[i]).children(t).first().text());
				}else{
					b += "," + ($(gdz[i]).children(t).first().text());
				}
				// spradzanie czy element ma dziecko
				if($(gdz[i]).find(box).length != 0){
					b += "," + (tsr_sortiner_index($(gdz[i]).find(box).first(), dz, d, box, t));
				}
				// dodawanie obiektu do struktury indexowania
			}else if(t == "text"){
				// dodawanie danych do id
				if(i == 0){
					b +=  $(gdz[i]).attr(d);
				}else{
					b += "," + $(gdz[i]).attr(d);
				}
				// spradzanie czy element ma dziecko
				if($(gdz[i]).find(box).length != 0){
					b += "," + (tsr_sortiner_index($(gdz[i]).find(box).first(), dz, d, box, t));
				}
			}else{
				// tworzenie tablicy do przechowywania danych struktury
				let c = {id: null};
				
				// dodawanie danych do id
				c["id"] = $(gdz[i]).attr(d);
				// spradzanie czy element ma dziecko
				if($(gdz[i]).find(box).length != 0){
					c["children"] = (tsr_sortiner_index($(gdz[i]).find(box).first(), dz, d, box, t));
				}
				// dodawanie obiektu do struktury indexowania
				a.push(c);
			}
		}
		if((d == "text") || (t == "text")){
			return b;
		}else{
			// zwracanie wyniku index'owania
			return a;
		}
	}

	// funkcjia konwertująca zdjęcja na dane (base64)
	async function getBase64FromUrl (url) {
		const data = await fetch(url);
		const blob = await data.blob();
		return new Promise((resolve) => {
			const reader = new FileReader();
			reader.readAsDataURL(blob); 
			reader.onloadend = () => {
				const base64data = reader.result;   
				resolve(base64data);
			}
		});
	}
	// funkcja pobierająca zdięcje z plikiem i przetwarza go na dane base64
	// t = plik do przekonwertowania, s = ścieżka do szukania / wstawienia pliku, c = funkcja callback
	function tsr_thumbnail(t, s = null, c = null){	
		// tworzenie funkcji czytającej pliki
		reader = new FileReader();
		
		// czytanie danych z pliku
		reader.onload = (function(f) {
			// sprawdzanie czy callback istnieje
			if(c != null){
				// tworzenie nowej funkcji 
				return function(e){
					// tworzenie zdjęcja podglądowego
					 c(e, s);
				}
			}else{
				return function(e){e.target.result.toString();};
			}
		})(t);
		// sprawdzanie czy callback istnieje
		if(c != null){
			// czytanie danych z url
			reader.readAsDataURL(t);
		}else{
			// czytanie danych z url
			reader.readAsText(t);
		}
	}
	
	// funkcja przesyłająca plik na serwer i zwraca błędy
	// form = objekt form, pupload_container = główny kontener do przeciągania, box = pudełko z opsługą drag and drop, ty = roszerzenie, mul = multipart (pliki przesyłane razem), a = funkcjia callback, siz = rozmiar pliku
	function tsr_upload(url, form = ".tsr-upload",pupload_container = ".tsr-upload-container", box = ".tsr-upload-box", ty = "*", mul = true, a = null, siz = 4000000){
		// zmienna przechowywująca id wszystkich przesłanych plików
		var ind = 0,
			obj = [],
			status_upload = false,
			kolejka = [],
			tsr_upload_error_count = 0;
		
		// funkcja robartująca o błędzie
		function tsr_upload_error(e, m = null){
			// ukrywanie progress bar
			$(e).addClass("tsr-upload-luk-error").find(".tsr-upload-progress-bar ").delay(1500).addClass("tsr-display-none");
			// pokazanie alertu o błędnym przesłaniu
			$(e).find(".tsr-upload-alert").removeClass("tsr-display-none").find(".tsr-upload-error").delay(1500).removeClass("tsr-display-none");
				setTimeout( function() {
					console.log(e);
					// ukrywanie alertu o prprawnym przesłaniu 
					$(e).find(".tsr-upload-alert").remove().addClass("tsr-display-none").find(".tsr-upload-error").delay(1500).addClass("tsr-display-none");
				}, 3000);
			  
			// sprawdzenie czy ustawiono wiadomość
			if(m != null){
			  
				console.warn(m);
				$(pupload_container).append('<section class="tsr-alert tsr-alert-error"> '+ m +' </section>');
				$(pupload_container).find(".tsr-alert-error").delay(5000).animate({opacity: "0"}, 1000).delay(100).hide(50, function () { $(this).remove(); });
			}
		}

		// funkcja pokazująca błędy
		function tsr_upload_alert(e, m, t, c = 2500){
				$(pupload_container).append('<section class="tsr-alert tsr-alert-'+ t +'"> '+ m +' </section>');
				$(pupload_container).find(".tsr-alert-"+ t).delay(c).animate({opacity: "0"}, 1000).delay(100).hide(50, function () { $(this).remove(); });
		}
		
		// funkcja raportująca o poprawnym wysłaniu
		function tsr_upload_success(e, m = null){
			// sprawdzanie czy czeba łodować po kolei
			if(id.length != 0){
				// czekanie 1,5 sekundy na ukrycje progress bar
				setTimeout( function(id) {
					
					for(var i = 0; i < id.length; i++){
						// sprawdzanie czy plik nie jest błędnym
						if($(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').hasClass("tsr-upload-luk-error") == false){
					
							// ukrywanie progress bar po wysłaniu pliku
							$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').addClass("tsr-upload-luk-success").find(".tsr-upload-progress-bar ").delay(1500).addClass("tsr-display-none");
							// pokazanie alertu o prprawnym przesłaniu
							$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').find(".tsr-upload-alert").removeClass("tsr-display-none").find(".tsr-upload-success").delay(1500).removeClass("tsr-display-none");
								setTimeout( function(id) {
								// ukrywanie alertu o prprawnym przesłaniu 
								$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').find(".tsr-upload-alert").addClass("tsr-display-none").find(".tsr-upload-success").delay(1500).addClass("tsr-display-none");
							  }, 3000, id);
					  
						}
					}
					  
				}, 1500, id);
			}else{
				// sprawdzanie czy plik nie jest błędnym
				if($(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ id +']').hasClass("tsr-upload-luk-error") == false){
					// czekanie 1,5 sekundy na ukrycje progress bar
					setTimeout( function() {console.error();
						// ukrywanie progress bar po wysłaniu pliku
						$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ id +']').addClass("tsr-upload-luk-success").find(".tsr-upload-progress-bar ").delay(1500).addClass("tsr-display-none");
						// pokazanie alertu o prprawnym przesłaniu
						$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ id +']').find(".tsr-upload-alert").removeClass("tsr-display-none").find(".tsr-upload-success").delay(1500).removeClass("tsr-display-none");
							setTimeout( function() {
							// ukrywanie alertu o prprawnym przesłaniu 
							$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ id +']').find(".tsr-upload-alert").addClass("tsr-display-none").find(".tsr-upload-success").delay(1500).addClass("tsr-display-none");
						  }, 3000);
					}, 1500);
				}
			}			
		}
		
		// interfejs click do domyśniej akcji formularza upload
		$(box).on("click", function(){
		});
		
		// domyśna akcja kliknięcja na na form(input[file])
		var x = document.getElementsByClassName(box.substring(1));
		x[0].addEventListener('click', () => {
		  x[0].getElementsByClassName('file')[0].click()
		})
		
		x[0].getElementsByClassName('file')[0].addEventListener('change', (e) => {
			tsr_upload_start();
		})
		
		// interfejs drag and drop i operacje na nim
		$(form).on("drag dragstart dragend dragover dragenter dragleave drop",  function(event) {
			// usuwanie domyśnych działać przeglądarki
			event.preventDefault();
			event.stopPropagation();
		}).on('dragover dragenter', function() {
			// dodawanie klasy ducha do kontynera do przeciągania
			$(pupload_container).addClass('tsr-upload-is-dragover');
		}).on('dragleave dragend drop', function() {
				// usuwanie klasy ducha z kontynera do przeciągania
				$(pupload_container).removeClass('tsr-upload-is-dragover');
		 }).on('drop', function(e) {
			tsr_upload_start(e);
		 });
		 
		 // funkcja startująca operacje na plikach i wysłanie ich
		 function tsr_upload_start(e = null){
			// usuwanie domyśnej wiadomość 
			$(pupload_container).find(".tsr-upload-info").addClass("tsr-display-none");
			// utworzenie objektu przechowywującego dane o plikach
			var formData = new FormData();	
			// sprawdzanie czy można pobrać plik z api(drag and drop) czy z domyśnej akcji(input[file])
			if(e != null){
				// pobieranie danych o plikach
				var droppedFiles = e.originalEvent.dataTransfer.files;
			}else{
				// pobieranie danych o plikach
				var droppedFiles = x[0].getElementsByClassName('file')[0].files;
			}
			// zmiena z flagami o błedzie
			var flag = 0;
			var flag_count = 0;
			
			// pętla dodająca itemy z akcjiami przesłanych plików
			for(var i = 0; i < droppedFiles.length; i++){
				// przywracanie ustawień domyśnych
				flag = 0;
				// zmienna z danymi o pliku
				var file = droppedFiles[i],
					name = file.name,
					//size = bytesToSize(file.size),
					type = file.type,
					reader = new FileReader();
				
				// kopiowanie szkieletu aplikacji
				let szkielet = $(pupload_container).find(".tsr-upload-item").first().clone();
				
				// tworzenie cache z danymi objektu (do łatwiejszej nawigacji)
				var cache = szkielet.find(".tsr-upload-title").text(droppedFiles[i]['name']).closest(".tsr-upload-item").find(".tsr-upload-size").text(droppedFiles[i]['size'] + " b").closest(".tsr-upload-item").attr("tsr-upload-file", ind);
				// spradzanie czy plik jest zdjęciem
				if(droppedFiles[i].type.startsWith('image/')){
					
						tsr_thumbnail(file, cache, function(e, cache){$(cache).find(".tsr-upload-img").attr("src", e.target.result).closest(".tsr-upload-item").addClass("tsr-upload-image-preview");});
					
				}else{
					// usuwanie zdięcja podglądowego jeśeli nie ma zdięcja do wyświetlenia
					cache = cache.find(".tsr-upload-preview").empty().closest(".tsr-upload-item");
				}
				// dodawanie procesu objektu do okna dragable
				$(box).append(cache);				

				// sprawdzanie czy plik nie przekracza wielkośći
				if(file.size <= siz){
						
				}else{
					  tsr_upload_error(cache, "tsr upload alert: "+ name +" > plik jest za duży!");
					  
					  flag = 1;
					  console.error("tsr upload alert: plik jest za duży!");
				}
				
				// spradzanie czy typ pliku zgadza się 
				if(ty !== "*"){
					// zmienna przechowywująca dane o znalezionym roszerzeniu
					var istype = false;
					// rozdzielenie ciągu (string) na tablice po (,)
					var typ = ty.split(",");
					// sprawdzanie czy typ danych nie jest pusty i jest poprawny
					if(typ.length != 0 && flag != 1){
						flag = 1;
						// pętla przeprowadzająca operacje na typach plików
						for(var j = 0; j < typ.length; j++){
							// rozkładanie typu na czyniki
							let g = typ[j].trim().split("/");
							// sprawdzanie czy są główne typy do sprawdzenia
							if(Array.isArray(g) == true && g.length == 2){
								// rozpad typu pliku na główny i typ pliku
								let a = g[0].toString().trim().split("."),
									b =  type.split("/");						
								// sprawdzenie czy dany typ pliku zgadza z filtrowanym plikiem
								if(a.length == 2){
									// sprawdzanie czy roszerzenie zgadza się z roszerzeniem szukanym
									if(a[1] == b[1]){
										// ustawienie typu i flagi na znaleziono typ pliku
										istype = true;
										flag = 0;
									}
								}else{
									// spradzanie czy głwny typ zgadza się z głownym szykanym typem plików
									if(g[0] == b[0]){
										// ustawienie typu i flagi na znaleziono typ pliku
										istype = true;
										flag = 0;
									}
								}
							}else{
								// rozpad typu pliku na główny i typ pliku
								let a = g[0].toString().trim().split("."),
									b =  type.split("/");	
								// sprawdzenie czy dany typ pliku zgadza z filtrowanym plikiem
								if(a.length == 2){
									// sprawdzanie czy roszerzenie zgadza się z roszerzeniem szukanym
									if(a[1] == b[1]){
										// ustawienie typu i flagi na znaleziono typ pliku
										istype = true;
										flag = 0;
									}
								}else{
									// spradzanie czy głwny typ zgadza się z głownym szykanym typem plików
									if(a[0] == b[1]){
										// ustawienie typu i flagi na znaleziono typ pliku
										istype = true;
										flag = 0;
									}
								}
							}
							
						}
						
						if(istype == false){
							flag = 1;
							
							console.error("tsr upload alert: the file type not found");
							tsr_upload_error(cache, "tsr upload alert: "+ name +" > nie znaleziono  rozszerzenia pliku!");
						}
					}
				}else{
					var istype = true;
				}
				
				// sprawdzanie czy nie ma błędu z plikami
				if(flag == 0 && istype == true){
					// dodawanie błędu do flagi
					flag_count++;
					// dodawanie plików do zapytania xhr (http)
					formData.append("file[]", file, name);
					// dodawanie id zakceptowanych plików
					obj.push(ind);
				}else{
					// dodawanie błędu do flagi
					flag = 0;
				}
				
				// zmiększanie id plików o (1)
				ind++;				
			}
			
			// sprawdzanie czy znaleziono jakiś błąd
			if(flag == 1){
				flag = 0;
			}
			
			if(flag_count != 0){
			
				// sprawdzanie czy muliply jest włączone
				if(mul == false){
					// wysyłanie danych
					
					// zmienna tymczasowa przechowywująca id pliku
					let g = obj;		
					// dodawanie danych do kolejki przed wysłaniem
					kolejka.push({formData, g});
					// resetowanie tablicy przechowywującej dane o zvalidowanych plikach
					obj = [];
				}else{
					let i = 0;
					// pętla pobierająca dane z dopuszczonych plików i przeprowadza na nich operacje
					for (var value of formData.values()) {
						
						// utworzenie objektu przechowywującego dane o plikach
						let formData = new FormData();
						// dodawanie pliku do formData
						formData.append("file",value);
						
						// zmienna tymczasowa przechowywująca id pliku
						let g = obj[i];
						// dodawanie danych do kolejki przed wysłaniem
						kolejka.push({formData, g });
						
						// zwiększanie id o jeden
						i++;
					}
					// resetowanie tablicy przechowywującej dane o zvalidowanych plikach
					obj = [];
					// resetowanie licznika
					i = 0;
				}
				
				// sprawdzanie czy upload plików wystartował
				if(status_upload == false){
					// sprawdzenie czy istnieje element do wysłania
					if(kolejka.length != 0){
						upload(kolejka[0]['formData'], kolejka[0]['g']);
					}
				}
			
			}
			
			// funkcjia wysyłająca dane na serwer;
			function upload(formDatas, id = null){
				// sprawdzanie czy nie ma błędu
				if(status_upload == false){
					// zmiana statusu na wysyłanie pliku
					status_upload = true;
					
					// konwertowania id na tablice
					if(Array.isArray(id) == false){
						id = [id];
					}
					
					if(formDatas != null){
					
						// tworzenie nowego xhr (zapytania http)
						xhr = new XMLHttpRequest();

						// otwieranie zapytanie i ustawienie odpowiedniego protokołu
						xhr.open('POST', url, true);
						// dodanie odpowiednich flag
						xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest', 'Cache-Control', 'no-cache', 'multipart/form-data');
						xhr.overrideMimeType('text/plain; charset=x-user-defined-binary');
						// dodawanie eventów nasłuchowych do zapytania xhr
						// funkcjia uruchamia się przy starcje
						xhr.addEventListener('loadstart', function (event) {
						});
						// funkcjia uruchamia się przy ładowaniu danych
						xhr.addEventListener('load', function (event) {
							//console.log(event);
							$(".tsr-upload-bar").addClass("done");
						});
						// funkcjia uruchamia się przy zakończeniu ładowania danych
						xhr.addEventListener('loadend', function (event) {
							
							// sprawdzanie czy nie ma błędów i czy poprawnie się połączono
							if (xhr.status == 200){
								// sprawdzanie czy callback jest funkcjią
								if(typeof(a) === 'function'){
									// wywołanie callback
									a(xhr.response, id);
								}
								
								// zmiena opsługuje błąd struktury upload serwer 
								let jso = false;
								// sprawdzanie błędów zwruconych przez serwer
								if(is_json(xhr.response)){
									// json decode > wynik zwrucony z serwera
									jso = JSON.parse(xhr.response).result;	
								}
								if(jso == "error"){
									// json decode > wynik zwrucony z serwera
									let jso = JSON.parse(xhr.response);									
									if(jso.result == "error"){
										// pętla do przetwarzania tablic i pojendyczyczh plików
										for(var i = 0; i < id.length; i++){	
											// funkcja generująca i opsługująca błędy w wysyłaniu danych
											tsr_upload_error($(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']'), jso.message);
										}
										
										// resetowanie licznika z błędami
										tsr_upload_error_count = 0;
										
										// zmiana statusu na wysyłanie pliku
										status_upload = false;
										// usuwanie z kolejki przesłanych danych
										 kolejka.shift();
										// sprawdzenie czy istnieje element do wysłania
										if(kolejka.length != 0){
											// odpalenie kolejknego pobierania
											upload(kolejka[0]['formData'], kolejka[0]['g']); 
										}
										  
										return true;										
									}
								}else{
				
									// sprawdzanie czy czeba łodować po kolei
									if(Array.isArray(id)){
										// czekanie 1,5 sekundy na ukrycje progress bar
										setTimeout( function(id) {
											
											for(var i = 0; i < id.length; i++){
												// sprawdzanie czy plik nie jest błędnym
												if($(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').hasClass("tsr-upload-luk-error") == false){
													
													// ukrywanie progress bar po wysłaniu pliku
													$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').addClass("tsr-upload-luk-success").find(".tsr-upload-progress-bar ").delay(1500).addClass("tsr-display-none");
													// pokazanie alertu o prprawnym przesłaniu
													$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').find(".tsr-upload-alert").removeClass("tsr-display-none").find(".tsr-upload-success").delay(1500).removeClass("tsr-display-none");
													setTimeout( function(id) {
														// ukrywanie alertu o prprawnym przesłaniu 
														$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id) +']').find(".tsr-upload-alert").remove().addClass("tsr-display-none").find(".tsr-upload-success").delay(1500).addClass("tsr-display-none");
													  }, 3000, id[i]);
											  
												}
											}
											  
										}, 1500, id);
									}else{
										// sprawdzanie czy plik nie jest błędnym
										if($(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ id +']').hasClass("tsr-upload-luk-error") == false){
											// czekanie 1,5 sekundy na ukrycje progress bar
											setTimeout( function() {console.error();
												// ukrywanie progress bar po wysłaniu pliku
												$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ id +']').addClass("tsr-upload-luk-success").find(".tsr-upload-progress-bar ").delay(1500).addClass("tsr-display-none");
												// pokazanie alertu o prprawnym przesłaniu
												$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ id +']').find(".tsr-upload-alert").removeClass("tsr-display-none").find(".tsr-upload-success").delay(1500).removeClass("tsr-display-none");
													setTimeout( function() {
													// ukrywanie alertu o prprawnym przesłaniu 
													$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ id +']').find(".tsr-upload-alert").addClass("tsr-display-none").find(".tsr-upload-success").delay(1500).addClass("tsr-display-none");
												  }, 3000);
											}, 1500);
										}
									}
									
									// pokazywanie aletu o ponownym upload
									tsr_upload_alert(pupload_container, "Plik został wysłany pomyślnie!", "success", 2500);								
									
									// resetowanie licznika z błędami
									tsr_upload_error_count = 0;
									
									// zmiana statusu na wysyłanie pliku
									status_upload = false;
									// usuwanie z kolejki przesłanych danych
									 kolejka.shift();
									// sprawdzenie czy istnieje element do wysłania
									if(kolejka.length != 0){
										// odpalenie kolejknego pobierania
										upload(kolejka[0]['formData'], kolejka[0]['g']); 
									}
									  
									return true;
								}
							}else if (xhr.status >= 500){
								console.error("tsr upload alert: Something went wrong on the server!");
								
							}else if (xhr.status >= 400){
								console.error("tsr upload alert: Something went wrong with the request on our side!");
							}else{
								console.error("tsr upload alert: No HTTP error indicated, yet the error event fired?!");
							}		
						});
						// funkcjia uruchamia się przy postępie czy przesyłaniu danych 
						xhr.addEventListener('progress', function (event) {
						});
						// funkcjia uruchamia się przy wykrycju błędu
						xhr.addEventListener('error', function (event) {
							if (xhr.status >= 500){
								console.error("tsr upload alert: Something went wrong on the server!");
								
								// pętla do przetwarzania tablic i pojendyczyczh plików
								for(var i = 0; i < id.length; i++){
									// usuwanie błędu pliku i ustawianie go na oszczeżenie(reupload)
									$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').removeClass("tsr-upload-luk-error").addClass("tsr-upload-luk-reupload").find('.tsr-upload-bar').css('width', 50 + '%').css("background-color", "darkgoldenrod");;
									$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').find('.tsr-upload-bar-info').text(50 + ' %');
								}
								
								// zwiększanie błędu w przetworzaniu danych
								tsr_upload_error_count++;
								
								// opuźnienie wykonania kolejnego wysłania danych i sprawdzenia błędów
								setTimeout( function() {
								
									// sprawdzanie czy nie osiągnięto limitu błędów
									if(tsr_upload_error_count >= 4){
										// pętla do przetwarzania tablic i pojendyczyczh plików
										for(var i = 0; i < id.length; i++){							
											// funkcja generująca i opsługująca błędy w wysyłaniu danych
											tsr_upload_error($(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']'), "tsr upload alert: Błąd serwera! proszę powtórzyć czynność później!");
										}
										
										// resetowanie licznika z błędami i usuwanie plików z niepowodzeniem
										tsr_upload_error_count = 0;
										
										// zmiana statusu na wysyłanie pliku
										status_upload = false;
										// usuwanie z kolejki przesłanych danych
										 kolejka.shift();
										// sprawdzenie czy istnieje element do wysłania
										if(kolejka.length != 0){
											// odpalenie kolejknego pobierania
											upload(kolejka[0]['formData'], kolejka[0]['g']); 
										}
										  
										return true;										
									}else{
										// pokazywanie aletu o ponownym upload
										tsr_upload_alert(pupload_container, "Błąd w przeysłaniu pliku, Ponowne wysłanie pliku!", "warning", 2500);										
										// zmiana statusu na wysyłanie pliku
										status_upload = false;
										// sprawdzenie czy istnieje element do wysłania
										if(kolejka.length != 0){
											// odpalenie kolejknego pobierania
											upload(kolejka[0]['formData'], kolejka[0]['g']); 
										}
										  
										return true;			

									}
								
								}, 2500);									
							}else if (xhr.status >= 400){
								console.error("tsr upload alert: Something went wrong with the request on our side!");
								
								// pętla do przetwarzania tablic i pojendyczyczh plików
								for(var i = 0; i < id.length; i++){
									// usuwanie błędu pliku i ustawianie go na oszczeżenie(reupload)
									$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').removeClass("tsr-upload-luk-error").addClass("tsr-upload-luk-reupload").find('.tsr-upload-bar').css('width', 50 + '%').css("background-color", "darkgoldenrod");;
									$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').find('.tsr-upload-bar-info').text(50 + ' %');
								}
								
								// zwiększanie błędu w przetworzaniu danych
								tsr_upload_error_count++;
								
								// opuźnienie wykonania kolejnego wysłania danych i sprawdzenia błędów
								setTimeout( function() {
								
									// sprawdzanie czy nie osiągnięto limitu błędów
									if(tsr_upload_error_count >= 4){
									// pętla do przetwarzania tablic i pojendyczyczh plików
									for(var i = 0; i < id.length; i++){							
										// funkcja generująca i opsługująca błędy w wysyłaniu danych
										tsr_upload_error($(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']'), "tsr upload alert: Błąd klienta! proszę powtórzyć czynność później!");
									}
										
										// resetowanie licznika z błędami i usuwanie plików z niepowodzeniem
										tsr_upload_error_count = 0;
										
										// zmiana statusu na wysyłanie pliku
										status_upload = false;
										// usuwanie z kolejki przesłanych danych
										 kolejka.shift();
										// sprawdzenie czy istnieje element do wysłania
										if(kolejka.length != 0){
											// odpalenie kolejknego pobierania
											upload(kolejka[0]['formData'], kolejka[0]['g']); 
										}
										  
										return true;										
									}else{
										// pokazywanie aletu o ponownym upload
										tsr_upload_alert(pupload_container, "Błąd w przeysłaniu pliku, Ponowne wysłanie pliku!", "warning", 2500);
										// zmiana statusu na wysyłanie pliku
										status_upload = false;
										// sprawdzenie czy istnieje element do wysłania
										if(kolejka.length != 0){
											// odpalenie kolejknego pobierania
											upload(kolejka[0]['formData'], kolejka[0]['g']); 
										}
										  
										return true;			

									}
								
								}, 2500);								
							}else{
								console.error("tsr upload alert: No HTTP error indicated, yet the error event fired?!");
								
								// pętla do przetwarzania tablic i pojendyczyczh plików
								for(var i = 0; i < id.length; i++){
									// usuwanie błędu pliku i ustawianie go na oszczeżenie(reupload)
									$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').removeClass("tsr-upload-luk-error").addClass("tsr-upload-luk-reupload").find('.tsr-upload-bar').css('width', 50 + '%').css("background-color", "darkgoldenrod");;
									$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').find('.tsr-upload-bar-info').text(50 + ' %');
								}
								
								// zwiększanie błędu w przetworzaniu danych
								tsr_upload_error_count++;
								
								// opuźnienie wykonania kolejnego wysłania danych i sprawdzenia błędów
								setTimeout( function() {
								
									// sprawdzanie czy nie osiągnięto limitu błędów
									if(tsr_upload_error_count >= 4){
									// pętla do przetwarzania tablic i pojendyczyczh plików
										for(var i = 0; i < id.length; i++){							
											// funkcja generująca i opsługująca błędy w wysyłaniu danych
											tsr_upload_error($(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']'), "tsr upload alert: Błąd sieci, nieoczekiwanie przerwane połączenie z serwerem! proszę powtórzyć czynność później!");
										}
										
										// resetowanie licznika z błędami i usuwanie plików z niepowodzeniem
										tsr_upload_error_count = 0;
										
										// zmiana statusu na wysyłanie pliku
										status_upload = false;
										// usuwanie z kolejki przesłanych danych
										 kolejka.shift();
										// sprawdzenie czy istnieje element do wysłania
										if(kolejka.length != 0){
											// odpalenie kolejknego pobierania
											upload(kolejka[0]['formData'], kolejka[0]['g']); 
										}
										  
										return true;										
									}else{
										// pokazywanie aletu o ponownym upload
										tsr_upload_alert(pupload_container, "Błąd w przeysłaniu pliku, Ponowne wysłanie pliku!", "warning", 2500);
										// zmiana statusu na wysyłanie pliku
										status_upload = false;
										// sprawdzenie czy istnieje element do wysłania
										if(kolejka.length != 0){
											// odpalenie kolejknego pobierania
											upload(kolejka[0]['formData'], kolejka[0]['g']); 
										}
										  
										return true;			

									}
								
								}, 2500);
							}
						});
						// funkcjia uruchamia się przy zaczymaniu przesyłu
						xhr.addEventListener('abort', function (event) {
						});	
						
						//
						xhr.upload.addEventListener("load", function () {
							$(".tsr-upload-bar").addClass("done");
						});
						// Upload progress
						xhr.upload.addEventListener("progress", function (event) {
							if (event.lengthComputable) {
								var complete = (event.loaded / event.total * 100 | 0);
								// sprawdzanie czy czeba łodować po kolei
								if(Array.isArray(id)){
									for(var i = 0; i < id.length; i++){
										// sprawdzanie czy plik nie jest błędnym
										if($(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').hasClass("tsr-upload-luk-error") == false){
											$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').find('.tsr-upload-bar').css('width', complete + '%');
											$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').find('.tsr-upload-bar-info').text(complete + ' %');
										}
									}
								}else{
									// sprawdzanie czy plik nie jest błędnym
									if($(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ id +']').hasClass("tsr-upload-luk-error") == false){
										$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ id +']').find('.tsr-upload-bar').css('width', complete + '%');
										$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ id +']').find('.tsr-upload-bar-info').text(complete + ' %');
									}
								}
							}
						});

					   // Download progress
					   xhr.addEventListener("progress", function(event){
						   if (event.lengthComputable) {
							   var percentComplete = event.loaded / event.total;
							   // Do something with download progress
							   var complete = (event.loaded / event.total * 100 | 0);
								// sprawdzanie czy czeba łodować po kolei
								if(Array.isArray(id)){
									for(var i = 0; i < id.length; i++){
									   if($(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').hasClass("tsr-upload-luk-error") == false){
											$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').find('.tsr-upload-bar').css('width', complete + '%').css("background-color", "lightskyblue");
											$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ (id[i]) +']').find('.tsr-upload-bar-info').text(complete + ' %');
									   }
								   }
								}else{
									// sprawdzanie czy plik nie jest błędnym
									if($(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ id +']').hasClass("tsr-upload-luk-error") == false){
										$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ id +']').find('.tsr-upload-bar').css('width', complete + '%').css("background-color", "lightskyblue");
										$(pupload_container).find('.tsr-upload-item[tsr-upload-file='+ id +']').find('.tsr-upload-bar-info').text(complete + ' %');
									}								
								}
						   }
					   }, false);	
					   
					   xhr.onerror = function () {
							console.log("** An error occurred during the transaction");
						};
					   
						// wywyłanie danych 
						xhr.send(formDatas);			

					}
						
				}
			}			 
		 }
		 
	};	
	
	// menu mobile ON //
	
	$(document).ready(function(){
	
		$(".tsr-button-menu-mobile").click(function(){
			$(".tsr-button-menu-mobile").toggleClass("change");
			$(".tsr-nav-menu-mobile").toggleClass("tsr-nav-menu-mobile-toogle");
		});
	
	});

	// menu mobile OFF //
	
	// menu left nts ON //
	
	$(document).ready(function(){
	
		$(".menu-item-size-button").click(function(){
			$(this).toggleClass("menu-item-size-button-rotate");
			$(this).closest(".tsr-nav-menu-left-nts").toggleClass("tsr-nav-menu-left-nts-minimalize");
			$(".container-right").toggleClass("tsr-navigation-right-minimalize");
			$(".container-left").toggleClass("tsr-navigation-left-minimalize");
			$(".tsr-stopka-navigation-right").toggleClass("tsr-navigation-right-minimalize");
			$(".tsr-stopka-navigation-left").toggleClass("tsr-navigation-left-minimalize");
		});
		
		$(".tsr-menu-left-button").click(function(){
			$(".tsr-nav-menu-left-nts").toggleClass("tsr-nav-menu-left-nts-active");
		});
	
	});
  
	// menu left nts OFF //

	// menu left ON //
	
	$(document).ready(function(){
	
		$(".tsr-button-menu-left").click(function(){
			$(".tsr-button-menu-left").toggleClass("change");
			$(".tsr-nav-menu-left").toggleClass("tsr-nav-menu-visable");
			$(".viewport").animate({width: "100%"}, 1000);
		});
	
	});
  
	// menu left OFF //
  
	// menu right ON //

	$(document).ready(function(){
		
		$(".tsr-button-menu-right").click(function(){
			$(".tsr-button-menu-right").toggleClass("change");
			$(".tsr-nav-menu-right").toggleClass("tsr-nav-menu-visable");
			$(".viewport").animate({width: "100%"}, 1000);
		});
	
	});
	
	// menu right OFF //
	
	// menu left minimalize ON //
	
	$(document).ready(function(){
	
		$(".tsr-button-menu-left-minimalize").click(function(){
			$(".tsr-nav-menu-left").toggleClass("tsr-nav-menu-left-minimalize");
			$(".tsr-stopka-navigation-right").toggleClass("tsr-navigation-right-minimalize");
			$(".container-right").toggleClass("tsr-navigation-right-minimalize");
			$(".tsr-nav-menu-size").toggleClass("tsr-display-none");
			$(".tsr-nav-menu-size2").toggleClass("tsr-display-none");
			if ($(".tsr-button-menu-left-minimalize").find(".tsr-nav-menu-size").hasClass("tsr-display-none")){
				document.cookie = "left_navbar_tsr=1";
			}else{
				document.cookie = "left_navbar_tsr=0";
			}		
		});
	
	});
  
	// menu left minimalize OFF //
	
	// menu right minimalize ON //

	$(document).ready(function(){
		
		$(".tsr-button-menu-right-minimalize").click(function(){
			$(".tsr-nav-menu-right").toggleClass("tsr-nav-menu-right-minimalize");
			$(".tsr-stopka-navigation-left").toggleClass("tsr-navigation-left-minimalize");
			$(".container-left").toggleClass("tsr-navigation-left-minimalize");
			$(".tsr-nav-menu-size").toggleClass("tsr-display-none");
			$(".tsr-nav-menu-size2").toggleClass("tsr-display-none");
			if ($(".tsr-button-menu-right-minimalize").find(".tsr-nav-menu-size").hasClass("tsr-display-none")){
				document.cookie = "right_navbar_tsr=1";
			}else{
				document.cookie = "righr_navbar_bm=0";
			}
		});
	
	});
	
	// menu right minimalize OFF //	

	// pokaż kafelki albo tabelkę przy renderowaniu strony w zależnośći na co kliknie użytkownik //

	$(document).ready(function(){
		
		$(".tsr-click-tabelka").click(function(){
			$(".tsr-recors-table").toggleClass("tsr-display-none");
			$(".tsr-recors-miniaturs").toggleClass("tsr-display-none");
			$(".tsr-records-title").toggleClass("tsr-display-none");
			$(".tsr-records-submit").toggleClass("tsr-display-none");
		});
		
		$(".tsr-click-kafelki").click(function(){
			$(".tsr-recors-table").toggleClass("tsr-display-none");
			$(".tsr-recors-miniaturs").toggleClass("tsr-display-none");
			$(".tsr-records-title").toggleClass("tsr-display-none");
			$(".tsr-records-submit").toggleClass("tsr-display-none");
		});
	
	});
	
	// menu right minimalize OFF //	

	// funkcjia ciasteczek ON //
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+ d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
	
	function getCookie(cname) {
		var name = cname + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		for(var i = 0; i <ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}	
	// funkcjia ciasteczek OFF //

	// ciosteczko do zapamiętywania wysuniętego menu admina ON //

	$(document).ready(function(){
		if (getCookie("left_navbar_tsr") == 1){
			$(".tsr-nav-menu-left").addClass("tsr-nav-menu-left-minimalize");
			$(".tsr-stopka-navigation-right").addClass("tsr-navigation-right-minimalize");
			$(".container-right").addClass("tsr-navigation-right-minimalize");
			$(".tsr-nav-menu-size").addClass("tsr-display-none");
			$(".tsr-nav-menu-size2").addClass("tsr-display-none");
		}
		if (getCookie("right_navbar_tsr") == 1){
			$(".tsr-nav-menu-right").addClass("tsr-nav-menu-right-minimalize");
			$(".tsr-stopka-navigation-left").addClass("tsr-navigation-left-minimalize");
			$(".container-left").addClass("tsr-navigation-left-minimalize");
			$(".tsr-nav-menu-size").addClass("tsr-display-none");
			$(".tsr-nav-menu-size2").addClass("tsr-display-none");
		}
	});
	
	// ciosteczko do zapamiętywania wysuniętego menu admina OFF //
	
	// kontener ze kontem użytkownika i aplikacjiami ON //
	$(document).ready(function(){
		$(".timonix-aplication-box-item").hover(function() {
		}, function(){
			$(this).delay(1000).css("background-color", "").delay(1000);
		});
		$(".timonix-aplication-box-item").hover(function() {
			 $(this).removeClass("timonix-aplication-box-item").addClass("timonix-aplication-box-item-active");
		}, function(){
			 $(this).addClass("timonix-aplication-box-item").removeClass("timonix-aplication-box-item-active");
		});
		$(".timonix-aplication-box-navigation").hover(function() {
		}, function(){
		});
		
		$(document).on("click", ".timonix-aplication-box-navigation", function(oEvent){

		})
		$(document).on("click", function (event) {
			if ($(event.target).closest(".timonix-aplication-box-content").length === 0) {
				
			}
		});

		$(document).on("click", ".menu-avatar-container", function(oEvent){
		})
		$(document).on("click", function (event) {
			if ($(event.target).closest(".menu-avatar-container-content").length === 0) {
			}
		});
		
	});

	
	// kontener ze kontem użytkownika i aplikacjiami OFF //
	
	// toltip statyczny i podażający za myszką ON //
	
	// sprawdzanie czy istnieje toltip do wyświetlenia
	var tsr_tooltip = $(document).find('section[tsr-toltip]');
	
	var tsr_content = $(document).find('[tsr-content]');
	var tsr_content_maargin = tsr_content.find('[tsr-content-maargin]');
	var element_height = tsr_content.offsetWidth;
 function trackMove(event) {
     currentTarget = $(event.currentTarget)
     tooltip = currentTarget.closest().find(".menu-avatar-container-content")
     //  if the mouse pointer is between 
     currentTargetRight = currentTarget.offset().left + currentTarget.outerWidth()
     tooltipWidth = tooltip.outerWidth()

     $(".console").html("event.clientX = " + event.clientX.toString() + "<br/>");
     $(".console").append("currentTargetRight - (tooltip.outerWidth()) = " + (currentTargetRight - (tooltip.outerWidth())).toString() + "<br/>");
     $(".console").append("currentTargetRight = " + currentTargetRight + "<br/>");
     if (event.clientX < (currentTarget.offset().left + (tooltip.outerWidth() / 2))) {
         tooltip.css("left", "0px");
         tooltip.css("right", "");
        
     } else if (event.clientX > (currentTargetRight - (tooltip.outerWidth() / 1.5))) {
         tooltip.css("right", "0px");
         tooltip.css("left", "");
       

     } else if (event.clientX > (currentTarget.offset().left + (tooltip.outerWidth() / 2)) && event.clientX < (currentTargetRight - (tooltip.outerWidth() / 2))) {
        
         tooltip.css("left", parseInt(event.clientX) - (tooltip.outerWidth() / 2) + "px");
         tooltip.css("right", "");
         

     }

 }
  
(function ($) {

    $.fn.easyTooltip = function (options) {

        // default configuration properties
        var defaults = {
            xOffset: 10,
            yOffset: 35,
            tooltipId: "easyTooltip",
            content: "fg",
            useElement: "fg"
        };

        var options = $.extend(defaults, options);
        var content;

        this.each(function () {
            $(this).hover(function (e) {
                content = (options.useElement != "") ? $("#" + options.useElement).html() : content;
                if (content != "" && content != undefined) {
                    var $tooltip = $("<div id='" + options.tooltipId + "'>" + content + "</div>");
                    $("body").append($tooltip);

                    if ($(window).width() < (e.pageX + $tooltip.width() + options.xOffset)) {
                        $tooltip
                            .css("top", (e.pageY - options.yOffset) + "px")
                            .css("left", (e.pageX - $tooltip.outerWidth() - options.xOffset) + "px")
                            .show();
                    } else {
                        $tooltip
                            .css("top", (e.pageY - options.yOffset) + "px")
                            .css("left", (e.pageX + options.xOffset) + "px")
                            .show();
                    }
                }
            },
            function () {
                $("#" + options.tooltipId).remove();
            });
            $(this).mousemove(function (e) {
                var $tooltip = $("#" + options.tooltipId);
                if ($(window).width() < (e.pageX + $tooltip.width() + options.xOffset)) {
                    $tooltip
                            .css("top", (e.pageY - options.yOffset) + "px")
                            .css("left", (e.pageX - $tooltip.outerWidth() - options.xOffset) + "px")
                            .show();
                } else {
                    $tooltip
                            .css("top", (e.pageY - options.yOffset) + "px")
                            .css("left", (e.pageX + options.xOffset) + "px")
                            .show();
                }
            });
        });

    };

})(jQuery);

	/* This is demo script tsr DOM */
	// # Juan Carlos
	
	Browser.DOM = function (html, scope) {
		// Creates empty node and injects html string using .innerHTML 
		// in case the variable isn't a string we assume is already a node
		var node;
		if (html.constructor === String) {
			var node = document.createElement('div');
			node.innerHTML = html;
		} else {
			node = html;
		}
	 
		// Creates of uses and object to which we will create variables
		// that will point to the created nodes
	 
		var _scope = scope || {};
	 
		// Recursive function that will read every node and when a node
		// contains the var attribute add a reference in the scope object
	 
		function toScope(node, scope) {
			var children = node.children;
			for (var iChild = 0; iChild < children.length; iChild++) {
				if (children[iChild].getAttribute('var')) {
					var names = children[iChild].getAttribute('var').split('.');
					var obj = scope;
					while (names.length > 0)
					{
						var _property = names.shift();
						if (names.length == 0)
						{
							obj[_property] = children[iChild];
						}
						else
						{
							if (!obj.hasOwnProperty(_property)){
								obj[_property] = {};
							}
							obj = obj[_property];
						}
					}
				}
				toScope(children[iChild], scope);
			}
		}
	 
		toScope(node, _scope);
	 
		if (html.constructor != String) {
			return html;
		}
		// If the node in the highest hierarchy is one return it
	 
		if (node.childNodes.length == 1) {
		 // if a scope to add node variables is not set
		 // attach the object we created into the highest hierarchy node
		 
			// by adding the nodes property.
			if (!scope) {
				node.childNodes[0].nodes = _scope;
			}
			return node.childNodes[0];
		}
	 
		// if the node in highest hierarchy is more than one return a fragment
		var fragment = document.createDocumentFragment();
		var children = node.childNodes;
		
		// add notes into DocumentFragment
		while (children.length > 0) {
			if (fragment.append){
				fragment.append(children[0]);
			}else{
			   fragment.appendChild(children[0]);
			}
		}
	 
		fragment.nodes = _scope;
		return fragment;
	 }

	 /* 
	 	demo use tsr DOM
	 
		var UI = {};
		var template = '';
		template += '<div class="repository">'
		template += ' <div var="name"></div>';
		template += ' <p var="text"></p>'
		template += ' <img var="image"/>'
		template += '</div>';

		var item = Browser.DOM(template, UI);

		UI.name.innerHTML = data.name;
		UI.text.innerHTML = data.description;
		UI.image.src = data.owner.avatar_url;

	 */

console.info("ładowanie zakończone: tsr");
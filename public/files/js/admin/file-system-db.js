/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik opsługuję całą logikę file-system-db
	
	Black Min cms,
	
	#plik: 1.1.9.4
*/

	$(document).ready(function(){	
		tsr_modal(true, ".tsr-xpmodal", ".tsr-modal", function(a,b,c,d){			
			let aquay_put = ($(b).attr("aquay-obiect-put") != undefined ? $(b).attr("aquay-obiect-put") : "null"),
				aquay_type = ($(b).attr("aquay-type") != undefined ? $(b).attr("aquay-type") : "all"),
				aquay_multiply = ($(b).attr("aquay-multiply") != undefined ? $(b).attr("aquay-multiply") : "true"),
				aquay_obiect_type = ($(b).attr("aquay-obiect-type") != undefined ? $(b).attr("aquay-obiect-type") : "img");
			
			tsr_ajax("laduj/get-file-system-db.php", {
				modal: a,
				location_container: aquay_put,
				file_type: aquay_type,
				multiply: aquay_multiply,
				aquay_obiect_type: aquay_obiect_type
			}, "", false, function(e){
				$(".tsr-modal-active").find(".tsr-modal-container-content > .tsra > .load-data").text("").append(e);
			}, function(){
				$(".tsr-modal-active").find(".tsr-modal-container-content > .tsra > .load-data").html('<section class="tsr-alert tsr-alert-error">Bład połączenia z serwerem!</section>');
			});
		})	
	
		// sprawdzenie czy użytkownik wybrał akcje zmień folder pliku
		// jeeli wybrał to pokazujemy diva do wpisania nowej nazwy folderu
		$(document).on("change", ".bm-rename-folder",function() {
			var status_akcja = $(this).val();
			if ($(this).val() == "rename_folder") {
				$(document).find(".akcja_pliku_zmienazwe").css("display", "block");
			}else{
				$(document).find(".akcja_pliku_zmienazwe").css("display", "none");
			}
			
		});
		
	});
	
	// wykkonywanie akcji 
	$(document).on("click", "#action_file_system_db", function() {
		// pobieranie akcji do wykonania
		let t = ($('select[name="akcja_pliku"]').val() != undefined ? $('select[name="akcja_pliku"]').val() : "add_media"),
			a = tsr_get_checkbox_data(data = "tsr-data", pchec_container = ".bm-checkbox-container", pchec = ".bm-pcheckbox", chec = ".bm-checkbox"), // pobieranie indexów z checkbox'a
			g = $(document).find(".bm-get-file-system-db").attr("bm-action"), // pobieranie folderu z wrzucenia pliku
			z = $(document).find(".bm-get-file-system-db").attr("bm-obiect-type"), // pobieranie typu zwracanych danych
			m = ($(document).find(".bm-file-system-db").find('input.bm-pcheckbox').attr("disabled") === "disabled") ? true : false , // multiply
			f = $('input[name="folder_zmien"]').val(); // pobieranie nazwy folderu do zmiany
		// sprawdzanie czy poprawne są dane
		if (t == "add_media") {
			if (g == "null"){
				$(".tsr-modal-active").find(".aquay-laduj-file").html('<section class="tsr-alert tsr-alert-waring">Błędne dane!</section>');
			}else{
				// sprawdzanie czy zwrucić text czy img obiektu
				if(z == "img"){
					if(m === true){
						// sprawdzanie czy wybrono plik
						if((a).length != 0){
							// pobieranie śćieżek do pliku
							let pm = $(".bm-file-record-active").find("img.img").attr("bm-grafika"),
								pp = $(".bm-file-record-active").find("img.img").attr("bm-sciezka"),
								pt = $(".bm-file-record-active").find("img.img").attr("title");
								pa = $(".bm-file-record-active").find("img.img").attr("alt");
							$(document).find(g).html('<img src="'+ pp +'" title="'+ pt +'" alt="'+ pa +'" bm-thumbnail="'+ pm +'" />');
						}
					}else{
						let pp_parent = $(".bm-file-record-active");
							console.log(pp_parent , a.length)
						// sprawdzanie czy wybrono plik
						if((a).length != 0){
							let pp_parent = $(".bm-file-record-active");
							console.log(pp_parent);
							// czyszczenie folderu docelowego
							$(document).find(g).html("");
							for(let i = 0; i < $(".bm-file-record-active").length; i++){
								// pobieranie śćieżek do pliku
								let pm = $(pp_parent.eq(i)).find("img.img").attr("bm-grafika"),
									pp = $(pp_parent.eq(i)).find("img.img").attr("bm-sciezka"),
									pt = $(pp_parent.eq(i)).find("img.img").attr("title");
									pa = $(pp_parent.eq(i)).find("img.img").attr("alt");
								$(document).find(g).append('<img src="'+ pm +'" title="'+ pt +'" alt="'+ pa +'" bm-src="'+ pp +'" class="aquay-galeria" />');
							}
						}				
					}
				}else{
					// sprawdzanie czy wybrono plik
					if($(".bm-file-record-active").length != 0){
						let pp_parent = $(".bm-file-record-active");
						for(let i = 0; i < $(".bm-file-record-active").length; i++){
							// pobieranie śćieżek do pliku
							let pm = $(pp_parent.eq(i)).find("img.img").attr("bm-grafika"),
								pp = $(pp_parent.eq(i)).find("img.img").attr("bm-sciezka"),
								pt = $(pp_parent.eq(i)).find("img.img").attr("title");
								pa = $(pp_parent.eq(i)).find("img.img").attr("alt");
							$(document).find(g).attr("data-pobierz", pp);
						}
					}					
				}
			}
		}else if (t == "delete") {
			console.log($(document).find(".bm-file-record-active").find("img").attr("bm-sciezka"));
			
			let g_p = $(document).find(".bm-file-record-active").find("img"),
				g_p_delete = [];
			
			for(let i = 0; i < g_p.length; i++){
				console.log(g_p.eq(i).attr("bm-sciezka"), g_p.eq(i).attr("bm-grafika"));
				let path = g_p.eq(i).attr("bm-sciezka"),
					thumbnail = g_p.eq(i).attr("bm-grafika");
				
				if(path != undefined && thumbnail != undefined){
					g_p_delete.push({path, thumbnail});
				}
			}
			
			console.log(g_p_delete);
			
			if(a.length != 0 && g_p_delete.length != 0){
				tsr_ajax("insert/plik-usun.php", {
					pliki: g_p_delete,
					iot: a["content"].toString()
				}, '', false, function(e){
					$(".tsr-modal-active").find(".aquay-laduj-file").append(e);
				}, function(){
					$(".tsr-modal-active").find(".aquay-laduj-file").html('<section class="tsr-alert tsr-alert-error">Bład połączenia z serwerem!</section>');
				});			
			}
			
			//console.log(tsr_index(".bm-file-system-db", $(document).find(".bm-file-record-active").find("img"), "bm-sciezka"));
		}else if (t == "rename_folder") {
			// sprawdzanie czy istnieją pliki do zmiany folderu
			if(a["content"].length > 0){
				tsr_ajax("insert/plik-zmien-folder.php", {
					pliki: a["content"].toString(),
					nazwa_folderu: f
				}, '', false, function(e){
					$(".tsr-modal-active").find(".aquay-laduj-file").append(e);
				}, function(){
					$(".tsr-modal-active").find(".aquay-laduj-file").html('<section class="tsr-alert tsr-alert-error">Bład połączenia z serwerem!</section>');
				});
			}
		}else{
			$(".tsr-modal-active").find(".aquay-laduj-file").html('<section class="tsr-alert tsr-alert-waring">Błędne dane!</section>');
		}
		
		console.log(a, a["content"].toString(), g, f);
	});

	// funkcja ładująca dane o plikach
	// ile ładowanych rekordów, jaki typ danych ma zostać załadowany, czy pliki mają być pojedycze czy wielokrotne, folder szukanych plików, nazwa szukanego pliku,	
	function load_upload_file_db(ile = 25, t = "all", m = true, f = "null", s = "null") {
		tsr_ajax("laduj/file-system-db.php", {
			load: ile,
			file_type: t,
			multiply: m,
			directory: f,
			file: s
		}, "", false, function(e){
			$(".tsr-modal-active").find(".aquay-laduj-file").text("").append(e);
			tsr_checkboxall2(".bm-file-table", ".bm-pcheckbox", ".bm-checkbox");
			changeDisabled("true", $("input.bm-pcheckbox"), !m);
			changeColor(".bm-file-system-db", ".bm-pcheckbox", ".bm-checkbox", m);
		}, function(){
			$(".tsr-modal-active").find(".aquay-laduj-file").html('<section class="tsr-alert tsr-alert-error">Bład połączenia z serwerem!</section>');
		});			
	}
	// zmianna zaznaczenia select
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
	// sprawdzanie czy zablokować możliwość zmiany roszerzenia pliku
	function changeDisabled(a,s, t = "disabled") {
		let sa = $(s);
		if(a != "all"){
			sa.attr("disabled", t);
		}
	}
	
	// funkcja blokująca multi zaznaczanie checkbox'ów
	function changeMultiply(p, e, t) {
		let pa = $(p);
		if(t === false){
			$(pa).on("click", "span" + e, function(){
				// odznaczanie innych checkbox'ów
				let pe = pa.find("input" + e + ':checked'); 
				for(let i = 0; i < pe.length; i++){
					pe.eq(i).prop("checked", false).removeAttr("checked");
				}
			});
		}
	}
	
	// funkcja zarządzająca wysyłanie danych z form
	function sentForm(f, s) {
		let pf = $(f),
			pfi = pf.find("input");
		// zmienna pzechowywuje konfig danych do wysłania
		let sentBM = (function(r,i,f,s,a){
			// dodawanie komunikatu o ładowaniu danych
			$(".tsr-modal-active").find(".aquay-laduj-file").prepend('<section class="tsr-alert tsr-alert-info">Ładowanie danych</section>');
			// ładowanie plików wgranych na serwer	
			load_upload_file_db(i, r, (pf.find('select[name="roszerzenie"]').attr("disabled") === "disabled") ? true : false, f, s);
		});
		
		// wysyłanie formularza po kliknięciu na przycisk
		$(pf).on("click", s, function(){
			let r = ($('select[name="roszerzenie"]').val() != undefined ? $('select[name="roszerzenie"]').val() : "all"),
			i = ($('input[name="ile_load"]').val() != undefined ? $('input[name="ile_load"]').val() : "25"),
			f = ($('input[name="folder"]').val() != "" ? $('input[name="folder"]').val() : "null"),
			s = ($('input[name="szukaj"]').val() != "" ? $('input[name="szukaj"]').val() : "null"),
			a = ($('select[name="akcja_pliku"]').val() != undefined ? $('select[name="akcja_pliku"]').val() : "add_media");
			// pobieranie danych
			sentBM(r,i,f,s,a);
		});

		$(pfi).on("keypress", function(evt){
			let keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
			if(keyCode == 13) {
				let r = ($('select[name="roszerzenie"]').val() != undefined ? $('select[name="roszerzenie"]').val() : "all"),
				i = ($('input[name="ile_load"]').val() != undefined ? $('input[name="ile_load"]').val() : "25"),
				f = ($('input[name="folder"]').val() != "" ? $('input[name="folder"]').val() : "null"),
				s = ($('input[name="szukaj"]').val() != "" ? $('input[name="szukaj"]').val() : "null"),
				a = ($('select[name="akcja_pliku"]').val() != undefined ? $('select[name="akcja_pliku"]').val() : "add_media");
				// pobieranie danych
				sentBM(r,i,f,s,a);
			}
		});
		
	}
	
	// funkcja kolorująca zaznaczony rekord 
	function changeColor(f, p, d, m = true) {
		let fa = $(document).find(f);
		// sprawdzanie czy działa multi zaznaczenie
		if(m == true){
			//  nasłuchiwanie kliknięcja rodzica
			$(fa).on('click', 'span' + p, function() {
				// sprawdzanie czy checkbox jest zaznaczony
				if($(this).closest("label.checkboxs").find('input[type="checkbox"]').attr("checked") === "checked"){
					$(this).closest(".bm-file-table").find(".bm-file-record").removeClass("bm-file-record-active").css("background-color", "");
				}else{
					$(this).closest(".bm-file-table").find(".bm-file-record").addClass("bm-file-record-active").css("background-color", "#d4a4a4");
				}
			});
		}
		//  nasłuchiwanie kliknięcja dziecka
		$(fa).on('click', 'span' + d, function() {
			// sprawdzanie czy działa multi zaznaczenie
			if(m == true){
				// sprawdzanie czy tabela jest aktywna
				if($(this).closest(".bm-file-record").hasClass("bm-file-record-active")){
					$(this).closest(".bm-file-record").removeClass("bm-file-record-active").css("background-color", "");
				}else{
					$(this).closest(".bm-file-record").addClass("bm-file-record-active").css("background-color", "#d4a4a4");
				};
			}else{
				$(document).find(".bm-file-record-active").removeClass("bm-file-record-active").css("background-color", "");
				$(this).closest(".bm-file-record").addClass("bm-file-record-active").css("background-color", "#d4a4a4");
			}
		});
	}
	
	// funkcja chowająca wiersze w tabeli
	function removeElements() {
		// ukrywanie usuniętych elementów
		$(".bm-file-record-active").css("background-color", "rgb(195 14 14)").css("transition", "all 0.5s cubic-bezier(0.95, 0.04, 0.93, 0.64)").delay(500).animate({opacity: "0"}, 1000).delay(100).hide(50, function () { $(this).remove(); });
	}
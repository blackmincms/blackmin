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

	// this a new function editora
	function aquay (__t = ".aquay-editor-container", aquay_path = "files/global/timonix-aquay-edytor/", only = false) {
		// load start
		console.info("Aquay: Ładowanie");
		console.info("Aquay: Iniciowanie");
		console.info("Aquay: Startowanie");

		// default settings aquay editor
		var settings = {
			"error_timer" : 1000,
			"load_editor_item" : ["all"],
			"aquay_default_font" : {
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
		};
		let buffor = 0;
		let error_count;
		// default navigation items
		const aquay_item = {
			0: ["toogle_editable","|","cut","copy","selectAll","|","undo","redo","|","removeFormat"],
			1: ["bold","italic","underline","strikeThrough","subscript","superscript","|","justifyLeft","justifyCenter","justifyRight","justifyFull","|","indent","outdent","|","insertUnorderedList","insertOrderedList","|","insertParagraph","|","link","unlink"],
			2: ["formatBlock","fontSize","fontName","foreColor","hiliteColor","|","add"]	
		};
		const aquay_item_ = {
			"toogle_editable": "button/hiddenfield-big.png",
			"cut": "clipboard/cut-big.png",
			"copy": "clipboard/copy-big.png",
			"selectAll": "text/selectall-big.png",
			"undo": "undo/undo-big.png",
			"redo": "undo/redo-big.png",
			"removeFormat": "clipboard/removeformat-big.png",
			"bold": "stylize/bold-big.png",
			"italic": "stylize/italic-big.png",
			"underline": "stylize/underline-big.png",
			"strikeThrough": "stylize/strike-big.png",
			"subscript": "stylize/subscript-big.png",
			"superscript": "stylize/superscript-big.png",
			"justifyLeft": "justify/justifyleft-big.png",
			"justifyCenter": "justify/justifycenter-big.png",
			"justifyRight": "justify/justifyright-big.png",
			"justifyFull": "justify/justifyblock-big.png",
			"indent": "akapit/bidiltr-big.png",
			"outdent": "akapit/bidirtl-big.png",
			"insertUnorderedList": "list/bulletedlist-big.png",
			"insertOrderedList": "list/numberedlist-big.png",
			"insertParagraph": "linia/horizontalrule-big.png",
			"link": "flags/link-big.png",
			"unlink": "flags/unlink-big.png",
			"foreColor": "color/textcolor-big.png",
			"hiliteColor": "color/bgcolor-big.png",
			"add": "add_element/showblocks-add.png"	
		};
		// translate to pl
		const translate_pl = {
			"toogle_editable": "Blokada Edycji",
			"cut": "Wytnij",
			"copy": "Kopiuj",
			"selectAll": "Zaznacz całość",
			"undo": "Cofnij",
			"redo": "Ponów",
			"removeFormat": "Usuń formatowanie",
			"bold": "Pogróbienie",
			"italic": "Pochylenie",
			"underline": "Podkreślenie",
			"strikeThrough": "Przekreślenie",
			"subscript": "Index dolny",
			"superscript": "Index górny",
			"justifyLeft": "Wyśrodkuj do lewej",
			"justifyCenter": "Wyśrodkuj",
			"justifyRight": "Wyśrodkuj do prawej",
			"justifyFull": "Wyjustuj",
			"indent": "Akapit od lewej",
			"outdent": "Akapit od prawej",
			"insertUnorderedList": "Lista kropkowana",
			"insertOrderedList": "Lista numerowana",
			"insertParagraph": "Przerwa",
			"link": "Link",
			"unlink": "Usuń link",
			"foreColor": "Kolor tekstu",
			"hiliteColor": "Kolor tła",
			"fontName": "Czcionka",
			"fontSize": "Wielkość tekstu",
			"formatBlock": " Nagłówek",
			"add": "Dodaj element"	
		};
		// default block
		const __block = {
			0 : {"name": "text", "display": "Tekst", "title": "Dodaj normalny tekst", "img": ""},
			1 : {"name": "quote", "display": "Cytat", "title": "Dodaj swój cytat", "img": ""},
			2 : {"name": "heading", "display": "Nagłówek", "title": "Dodaj nagłówek artykułu", "img": ""},
			3 : {"name": "picture", "display": "Zdięcje", "title": "Dodaj zdjęcie", "img": ""},
			4 : {"name": "gallery", "display": "Galeria", "title": "Dodaj galerię", "img": ""},
			5 : {"name": "file", "display": "Plik", "title": "Dodaj plik z serwera", "img": ""},
			6 : {"name": "code", "display": "kod", "title": "Dodaj kod do uruchomienia w przęglądarce", "img": ""},
			7 : {"name": "own_code", "display": "Własny kod", "title": "Dodaj kod do podglądu (podświetlenie składnij)", "img": ""}
		};
		// saved selection
		let aquaySelection = undefined;
		let aquaySelectText = undefined;
		let aquaySelectNode = undefined;
		let aquaySelectNodeFocus = undefined;
		let aquayAddFile = undefined;
		// link container adds
		let aquay_links = `
				<section class="tsr aquay-modal-container-colision">
					<section class="col-inp-25 tsr-p-10px fs-90 ">
						<span class="tsr-vertical-align-sub">
							url:
						</span>
					</section>
				<section class="col-inp-75 tsr-p-10px fs-90 aquay-modal-container-colision">
					<input type="url" name="url_add" class="input" placeholder="https://example.pl" autocomplete="off" focus="false" />
				</section>
				</section><section class="tsr aquay-modal-container-colision">
					<section class="col-inp-25 tsr-p-10px fs-90 ">
						<span class="tsr-vertical-align-sub">
							target:
						</span>
					</section>
					<section class="col-inp-75 tsr-p-10px fs-90 aquay-modal-container-colision">
						<select name="target_add">
							<option value="_self">W tej samej karcie</option>
							<option value="_blank">W nowej karcie</option>
							<option value="_parent">W ramce</option>
							<option value="_top">W nowym oknie</option>
						</select>
					</section>
				</section><div class="tsr tsr-mt-50 tsr-clear-both aquay-modal-container-colision">
					<section class="tsr tsr-inp col-2 tsr-pr-10px ">
						<button type="button" value="Dodaj link" class="buttom aquay_add_link" >Dodaj link</button>
					</section>
					<section class="tsr tsr-button tsr-error tsr-modal-closed-button col-2">
						<span>
							Anuluj!
						</span>
					</section>
				</div>
			`
		;
		// add file from db
		let aquay_file = `
			<div class="tsr-modal">
				<section class="tsr load-aquay">
					<section class="tsr-alert tsr-alert-info">Ładowanie danych</section>
				</section>
			</div>
		`;
		/** @jsx dom */
		const dom = (name, props, ...children) => {
			const elem = document.createElement(name);

			Object.keys(props || {}).forEach(k => {
				if (k === 'style') {
					Object.keys(props[k]).forEach(sk => {
						elem.style[sk] = props[k][sk];
					});
				} else {
					elem[k] = props[k];
				}
			});

			const addChild = (child) => {
				if (Array.isArray(child)) {
					child.forEach(c => addChild(c));
				} else if (typeof child === 'object') {
					elem.appendChild(child);
				} else {
					elem.appendChild(document.createTextNode(child));
				}
			}

			(children || {}).forEach(c => addChild(c));

			return elem;
		};

		/* let time = storage.getItem("aquay_settings_time");
		if (time !== null) {
			// sprawdzanie czy ustawienia nie sa starsze niz 24 godzine
			if (time < (new Date().getTime() - (1000 * 60 * 60 * 24))) {
				// jesli tak to pobieranie ustawien
				load("settings.json", "json");
			} else {
				// jesli nie to pobieranie ustawien z cache
				return JSON.parse(storage.getItem("aquay_settings"));
			}
		} else {
			storage.setItem("aquay_settings_time", Date.now());
		} */

		// load aquay editors
		window.addEventListener("load", () => {
			try {
				if (CheckModuls()) {
					setting();
					block_scheme();
					loading();					
				}
			} catch (error) {
				console.error("Aquay: Not 'tsr' modules avaliable | " + error);
				window.alert("Aquay: Not 'tsr' modules avaliable");
			}
		});

		// The buffer function
		function buffers(t) {
			
		}

		function loading() {
			setTimeout(() => {
				if (setting() === undefined) {
				 	setting();
				}
				 if (block_scheme() === undefined) {
					block_scheme();
				}
				
				if (buffor <= 2) {
					add_font();
					uis();
					blocks();
					load_block();
					de_compiler_action();
					return true;
				} else {
					if (error_count != 50) {
						error_count++;
						return loading();
					} else {
						console.error("Aquay: ERROR load editors");
						tsr_alert("error", "Aquay: ERROR load editors");
					}
				}
			}, 250);
		}

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

		function getCaretCharOffset(element) {
			var caretOffset = 0;
		  
			if (window.getSelection) {
			  var range = window.getSelection().getRangeAt(0);
			  var preCaretRange = range.cloneRange();
			  preCaretRange.selectNodeContents(element);
			  preCaretRange.setEnd(range.endContainer, range.endOffset);
			  caretOffset = preCaretRange.toString().length;
			}else if (document.selection && document.selection.type != "Control") {
			  var textRange = document.selection.createRange();
			  var preCaretTextRange = document.body.createTextRange();
			  preCaretTextRange.moveToElementText(element);
			  preCaretTextRange.setEndPoint("EndToEnd", textRange);
			  caretOffset = preCaretTextRange.text.length;
			}
		  
			return caretOffset;
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

		/* let time = storage.getItem("aquay_settings_time");
		if (time !== null) {
			// sprawdzanie czy ustawienia nie sa starsze niz 24 godzine
			if (time < (new Date().getTime() - (1000 * 60 * 60 * 24))) {
				// jesli tak to pobieranie ustawien
				load("settings.json", "json");
			} else {
				// jesli nie to pobieranie ustawien z cache
				return JSON.parse(storage.getItem("aquay_settings"));
			}
		} else {
			storage.setItem("aquay_settings_time", Date.now());
		} */

		// load function
		async function load (url = "settings.json", type = "json") {

			if (type === "json") {
				he = {"Content-Type": "application/json"};
				try {
					await fetch(aquay_path + url, {
						method: "GET",
						headers: new Headers(he),	
					})
					.then(res => res.json())
					.then(res => {
						buffor++;
						return parse_data(res, type);
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
						buffor++;
						return parse_data(res, type);
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
						storage.setItem("aquay_settings_time", Date.now());
						return true;
					} else {
						return odp;
					}
				}
			}else if (d = "text") {
				if (cache_test("sessionStorage")) {
					storage.setItem("aquay_block_schemat", JSON.stringify(odp));
					storage.setItem("aquay_block_schemat_time", Date.now());
					return true;
				} else {
					return odp;
				}
			} else {
				return false;
			}
		}

		// this funnction is check has settings property and add do settings
		function parse_settings(settingss) {
			// test a settingss is Object
			// if (!Object.settingss) {
			// 	console.warn("Aquay: settings is not array!");
			// }

			let keys = Object.keys(settingss);
			let ile = keys.length;
			for (let i = 0; i < ile; i++) {
				// add property to settings
				settings[keys[i]] = settingss[keys[i]];			
			}
		}

		// function get settings (json parse string)
		function setting(t = "all") {
			if (cache_test("sessionStorage")) {
				let storage = window.sessionStorage;
				if (t === "all") {
					if (storage.getItem("aquay_settings")) {
						// let time = storage.getItem("aquay_settings_time");
						// if (time !== null) {
						// 	// sprawdzanie czy ustawienia nie sa starsze niz 24 godzine
						// 	if (time >= (new Date().getTime() - (1000 * 60 * 60 * 24))) {
						// 		// jesli tak to pobieranie ustawien
						// 		return load("settings.json", "json");
						// 	} else {
						// 		// jesli nie to pobieranie ustawien z cache
						// 		return JSON.parse(storage.getItem("aquay_settings"));
						// 	}
						// } else {
						// 	// storage.setItem("aquay_settings_time", Date.now());
						// 	return JSON.parse(storage.getItem("aquay_settings"));
						// }
						parse_settings(JSON.parse(storage.getItem("aquay_settings")));
						return JSON.parse(storage.getItem("aquay_settings"));
					} else {
						let set = load("settings.json", "json");
						parse_settings(set);
						return set;
					}
				} else {
					if (storage.getItem("aquay_settings")) {
						

						let x = Array.prototype.search(JSON.parse(storage.getItem("aquay_settings")), t);
						if (x != false) {
							return x;
						} else {
							return settings[t];
						}
					} else {
						load("settings.json", "json");
					}
				}
			} else {
				if (t === "all") {
					if (only === true) {
						return load("settings.json", "json");
					} else {
						return settings;
					}
				}else{
					if (only === true) {
						let x = Array.prototype.search(load("settings.json", "json"), t);
						if (x != false) {
							return x;
						} else {
							return settings[t];
						}
					} else {
						let x = Array.prototype.search(setting, t);
						if (x != false) {
							return x;
						} else {
							return settings[t];
						}
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
		function block_scheme (t = "text") {
			if (cache_test("sessionStorage")) {
				let storage = window.sessionStorage;
				if (storage.getItem("aquay_block_schemat")) {
					let x = (t === "*" ? JSON.parse(storage.getItem("aquay_block_schemat")): $(JSON.parse(storage.getItem("aquay_block_schemat"))).find("section.aquay-edytuj-blok-kopiuj.aquay-kopia-blok-" + t).find(".aquay-edytuj-container"));					
					if (x != undefined) {
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

		// function add font
		function add_font() {
			let t = setting("aquay_default_font");
			let ile = Object.keys(t).length;
			for (let i = 0; i < ile; i++) {
				const e = t[Object.keys(t)[i]];
				let ile2 = e.length;
				for (let x = 0; x < ile2; x++) {
					const el = e[x];
					include_font(el, Object.keys(t)[i]);
					
					if (x === 0) {
						setTimeout(() => {
							const e1 = Object.keys(t)[i].replace("_", " ");
							$(document).find(__t).find("select.fontName, .fontName").append(`<option value="${e1.toLocaleUpperCase()}">${e1}</option>`);
						}, setting("load_editor_item") * 2);
					}
				}
			}
		}

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
		function include_font (t, e) {
			let link = document.createElement('link');
			link.setAttribute('rel', 'font');
			link.setAttribute('type', 'font');
			link.setAttribute('fontparent', e);
			link.setAttribute('href', aquay_path + 'font/' + e + "/" + t);
			document.head.appendChild(link);

			let exp = `<style fontparent="${e}">
				@font-face {
					font-family: '${e}';
					src: url('${aquay_path}font/${e}/${t}');
				}
			</style>`;
			$(document).find("head").append(exp);
		}

		// function load blocks editors
		function blocks(t = "text") {
			let body = $(__t).find(".aquay-block-editor");
			body.append(block_scheme(t))
		}

		// function load default block editors
		function load_block() {
			// __block
			let head = $(__t).find(".aquay-navigate .add");
			head.append('<section class="aquay-edytor-element-menu"></section>');
			head = head.find(".aquay-edytor-element-menu");

			// add
			let ile = Object.keys(__block).length;
			for (let i = 0; i < ile; i++) {
				const e = __block[i];
				
				head.append(`<div class="aquay-edytor-menu-icons aquay-blok-${e.name}" data-blok="${e.name}" title="${e.title}">
								${e.display}
							</div>`);
			}

			window.setTimeout(() => {
				head.on("click", ".aquay-edytor-menu-icons", (t) => {
					blocks ($(t.currentTarget).attr("data-blok"));
				})
			}, 0);
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
			aquay_container.append('<div class="aquay-block-editor" aquayeditable="true" name="aquayblock">');
			// get head and body
			let head = aquay_container.find(".aquay-navigate"),
				body = aquay_container.find(".aquay-block-editor");
			
			// load navigate
			load_navigate(head);

			window.queueMicrotask( () => {
				// tsr_sortiner("aquay-data", ".aquay-block-editor", ".aquay-edytuj-container", ".aquay-sorting", 0);
				$( ".aquay-block-editor" ).sortable({
					connectWith: ".aquay-block-editor",
					handle: ".aquay-type-title",
					cancel: ".aquay-toggle",
					placeholder: "aquay-placeholder"
				  });
				listener();
			} );
		}
		// wywuływanie modal po click link
		function parseHTML(html) {
			var t = document.createElement('template');
			t.innerHTML = html;
			return t.content;
		}
		// function decompilar action
		function de_compiler_action() {
			// check is deCompiler action 
			if (document.querySelector(__t).hasAttribute("value")) {
				aquayDecompiler(__t, block_scheme("*"));
			}
		}
		// function add addEventListener
		function listener() {
			window.queueMicrotask( () => {
				let items = setting("load_editor_item");
				if (items[0] === "all") {
					items = aquay_item;
				}

				let head = $(__t).find(".aquay-navigate");

				let ile = Object.keys(items).length;
				for (let i = 0; i < ile; i++) {

					const e = items[i];
					let ile2 = e.length;
					for (let x = 0; x < ile2; x++) {
						if (e[x] !== "|") {
							if ((/^(formatBlock|fontSize|fontName|foreColor|hiliteColor)$/).test(e[x])) {
								$(head).on("change", `.${e[x]}`, (t) => {
									aquay_event(t, "change", e[x]);
								});
							} else {
								$(head).on("click", `.${e[x]}`, (t) => {
									aquay_event(t, "click", e[x]);
								});
							}
						}
					}
				}

				$(document).on("click mouseup keydown mousedown keyup", __t + " .aquay-edytuj-text", (t) => {
					let storage = window.sessionStorage;

					if (cache_test("sessionStorage")) {
						if (storage.getItem("aquay_selection")) {
							storage.setItem("aquay_selection", JSON.stringify(GetSelection()));
						} else {
							storage.setItem("aquay_selection", JSON.stringify(GetSelection()));
						}
					}
					(GetSelection() === undefined ? aquaySelection = ($(__t).find(t.target).hasClass("aquay-edytuj-text") === true ? $(__t).find(t.target) : ($(t.target).closest(".aquay-edytuj-text").hasClass("aquay-edytuj-text") === true ? $(t.target).closest(".aquay-edytuj-text") : undefined )) : aquaySelection = GetSelection() );

					aquaySelectText = getCaretCharOffset(t.currentTarget);
					aquaySelectNode = window.getSelection();
					aquaySelectNodeFocus = {
						"focus": aquaySelectNode.extentNode,
						"goTo": aquaySelectNode.extentOffset
					};
				});

				tsr_modal(false , __t + " .link", aquay_links);
				
				$(document).on("click", __t + " .link", (t) => {
					$(__t + " .link").attr("tsr-modal-close", "false");
					setTimeout(() => {
						if (aquaySelection != undefined) {
							let url = ($(aquaySelection.selection.focusNode.parentNode).attr("href") === undefined ? undefined : $(aquaySelection.selection.focusNode.parentNode).attr("href"));
							let tar = ($(aquaySelection.selection.focusNode.parentNode).attr("target") === undefined ? undefined : $(aquaySelection.selection.focusNode.parentNode).attr("target"));
							if (url != undefined) {
								$('.tsr-modal-active input[name="url_add"]').val(url);
							} else {
								$('.tsr-modal-active input[name="url_add"]').val("");
							}
							if (tar != undefined) {
								$('.tsr-modal-active select[name="target_add"]').val(tar);
							}
						}
					}, 0);
				});

				$(document).on("click", ".tsr-modal-active .aquay_add_link", (t) => {
					if (aquaySelection != undefined || aquaySelectNodeFocus != undefined) {
						// get form value
						let parent = $(document).find(".tsr-modal-active"),
							url = parent.find('input[name="url_add"]').val(),
							target = parent.find('select[name="target_add"]').val();
						(target === undefined ? "_blank" : target);
						if (url.length === 0) {
							
						} else {
							if (aquaySelection.length) {							
								if ($(aquaySelection[0]).hasClass("aquay-edytuj-text")) {
									if (aquaySelectNodeFocus != undefined) {
										let elm = aquaySelection[0],
										range = document.createRange(),
										sel;
										elm.focus();
										range.setStart(aquaySelectNodeFocus.focus, aquaySelectNodeFocus.goTo);
										range.setEnd(aquaySelectNodeFocus.focus, aquaySelectNodeFocus.goTo);
										sel = window.getSelection();
										sel.removeAllRanges();
										sel.addRange(range);
									}
									if (aquay_editables('createLink', url)) {
										setTimeout(() => {
											(GetSelection() === undefined ? aquaySelection = ($(__t).find(t.target).hasClass("aquay-edytuj-text") === true ? $(__t).find(t.target) : undefined) : aquaySelection = GetSelection() );

											$(aquaySelection.selection.focusNode.parentNode).attr("target", target);
										}, 0);
									}
									$('.tsr-modal-active input[name="url_add"]')[0].value = '';
									$('.tsr-modal-active .tsr-modal-close').click();						
								} else {
									
								}
							} else {


								if ($(aquaySelection.parent).hasClass("aquay-edytuj-text")) {
									// fokusowanie elementu
									aquaySelection.parent.focus();
									// tworzenie nowego objektu range
									let range = new Range();
									// ustawianie zakresów do zaznaczenia
									range.setStart(aquaySelection.range.startContainer, aquaySelection.range.startOffset);
									range.setEnd(aquaySelection.range.endContainer, aquaySelection.range.endOffset);
									// usuwanie poprzedniego zaznaczenia
									window.getSelection().removeAllRanges();
									// zaznaczenie odpowiedniego zakresu
									window.getSelection().addRange(range);

									// new a hrew changer
									// const ranges = aquaySelection.range;
									// const wrapper = document.createElement('a');
									// wrapper.setAttribute("href", url);
									// wrapper.setAttribute("target", target);
									
									// wrapper.appendChild(ranges.extractContents());
									// wrapper.querySelectorAll("a[href]").forEach((value, key, array) => {
									// 	return value.setAttribute("target", target);
									// });
									// ranges.insertNode(wrapper);
									// console.log(wrapper, wrapper.innerHTML);

									if (aquay_editables('createLink', url)) {
										setTimeout(() => {

											$(aquaySelection.selection.focusNode.parentNode).attr("target", target);
											$(aquaySelection.selection.focusNode.anchorNode).attr("target", target);

											let selection = GetSelection();
											if ((selection !== undefined) || (selection.same())) {
												const ranges = selection.range;
												const wrapper = document.createElement('span');
												
												wrapper.appendChild(ranges.extractContents());
												wrapper.querySelectorAll("a[href]").forEach((value, key, array) => {
													return value.setAttribute("target", target);
												});
												ranges.insertNode(wrapper);
											}
										}, 0);
									}
									$('.tsr-modal-active input[name="url_add"]')[0].value = '';
									$('.tsr-modal-active .tsr-modal-close').click();
								} else {
									
								}
							}
						}
					}
				});

				$(__t).on("dblclick", ".aquay-type-title", function (oEvent) {
					$(this).closest(".aquay-edytuj-container").remove();
				})

				$(__t).on("click", function (event) {
					if(!$(event.target).closest('.add').length && !$(event.target).is('.add')) {
						let ads = $(__t).find(".aquay-navigate .aquay-edytor-element-menu");
						ads.removeClass("aquay-edytor-menu-visable");
					}  
				});
			} );

			$(__t).on("click", ".aquay-add-media", (t) => {
				aquayAddFile = t;
				let ob = $(t.target).attr("aquay-type"),
					mul = $(t.target).attr("aquay-multiply");			

				// check is "disk_manager" in settings
				if (settings["disk_manager"] === undefined) {
					console.log("Aquay: use default disk manager");
					queueMicrotask(() => {
						// check if search class is false
						if ($(aquayAddFile.target).hasClass("aquay-add-media-image")) {
							fileSystemBM(".aquay-edytor-picture", ".aquay-add-media-image", ".aquay-load-obrazek", "image", true, false, "img");
						} else if ($(aquayAddFile.target).hasClass("aquay-add-media-gallery")) {
							fileSystemBM(".aquay-edytor-gallery", ".aquay-add-media-gallery", ".aquay-load-galeria", "image", false, true, "img");
						} else if ($(aquayAddFile.target).hasClass("aquay-add-media-file")) {
							fileSystemBM(".aquay-edytor-file", ".aquay-add-media-file", ".aquay-load-plik", "*", false, true, "data");
						} else {
							console.error("Aquay: Add File Button is undefined!");
							return false;
						}
					});
					return true;
				}

				if (settings["disk_manager"] !== undefined) {
					queueMicrotask(() => {
						console.log("Aquay: use costam disk manager.");
					});
					return true;
				}
			});

			// replace input data to aquay picture
			$(__t).on("keyup", 'input[name="aquay-url-parse"]', (t) => {
				let url = $(t.target).val();
				let set_img = $(t.target).closest(".aquay-edytor-picture").find(".aquay-load-obrazek");
				let add_media = $(t.target).closest(".aquay-edytor-picture").find(".aquay-add-media");
				if (url.length != 0) {
					set_img.html(`<img src="${url}" alt="${url}" title="${url}" src-orginal="${url}" title-orginal="${url}" class="aquay-image" loading="lazy">`);
					if (!add_media.hasClass("aquay-hidden")) {
						add_media.addClass("aquay-hidden");
					}
				} else {
					set_img.find("img").remove();
					if (add_media.hasClass("aquay-hidden")) {
						add_media.removeClass("aquay-hidden");
					}
				}
			});
		}
		// function aquay_event listener
		function aquay_event(t, o, e) {
			if (o === "click") {
				if (e === "toogle_editable") {
					let edit = $(__t).find(".aquay-block-editor");
					if (edit.attr("aquayeditable") == "true") {
						edit.attr("aquayeditable", false);
						edit.find(".aquay-edytuj-text").attr("contenteditable", false);
					} else {
						edit.attr("aquayeditable", true);
						edit.find(".aquay-edytuj-text").attr("contenteditable", true);
					}
				} else if (e === "add") {
					let ads = $(t.currentTarget).find(".aquay-edytor-element-menu");
					if (($(t.target).hasClass('aquay-edytor-element-menu') === false)  ) {
						if (ads.hasClass("aquay-edytor-menu-visable")){
							if ($(t.target.parentNode).hasClass("aquay-edytor-element-menu") == false) {
								ads.removeClass("aquay-edytor-menu-visable");
							}
						}else{
							ads.addClass("aquay-edytor-menu-visable");
						}
					}
				} else {
					aquay_editables(e);
				}
			}else if (o === "change") {
				return aquay_editables(e, t.currentTarget.value);
			}else{
				throw new TypeError("Aquay: type method not avaliable");
			}

			// saved stats to cache
			let storage = window.sessionStorage;
			// save last events
			let s = {
				"type": (t.type == undefined ? undefined : t.type),
				"time": new Date,
				"data": (t.data == undefined ? undefined : t.data),
				"html": (t.currentTarget.outerHTML == undefined ? undefined : t.currentTarget.outerHTML),
				"innerhtml": (t.currentTarget.innerHTML == undefined ? undefined : t.currentTarget.innerHTML),
				"path": (t.originalEvent.path == undefined ? undefined : JSON.stringify(t.originalEvent.path.slice(0, -1))),
				"pointerType": (t.originalEvent.pointerType == undefined ? undefined : t.originalEvent.pointerType),
				"alt": (t.target.alt == undefined ? undefined : t.target.alt),
				"name": (e == undefined ? undefined : e)
			}
			storage.setItem("aquay_last_event", JSON.stringify(s));
			// save list events
			if (storage.getItem("aquay_list_events")) {
				let x = JSON.parse(storage.getItem("aquay_list_events"));
				x[Object.keys(x).length] = s;
				storage.setItem("aquay_list_events", JSON.stringify(x) );
			} else {
				storage.setItem("aquay_list_events", JSON.stringify({0:s}) );
			}

			return false;
		}
		// function editable blocks
		function aquay_editables(t,a = null) {
			return document.execCommand(t, false, a);
		}
		// function load navigate
		function load_navigate(t) {
			let head = $(t);
			let items = setting("load_editor_item");
			if (items[0] === "all") {
				items = aquay_item;
			}
			let ile = Object.keys(items).length;
			for (let i = 0; i < ile; i++) {
				head.append('<section class="aquay-sekcjia aquay-nav-'+ i +'">');
				let a1 = head.find(".aquay-nav-"+ i +"");

				const e = items[i];
				let ile2 = e.length;
				for (let x = 0; x < ile2; x++) {
					if (e[x] === "|") {
						a1.append('<div class="aquay-ikona aquay-bar"></div>');
					}else if (e[x] === "formatBlock") {
						a1.append(`<select class="aquay-select aquay-input-margin ${e[x]}" alt="${translate_pl[e[x]]}" title="${translate_pl[e[x]]}">
							<option value="SPAN">Tekst</option>
							<option value="P">Akapit</option>
							<option value="H1">Nagłówek 1</option>
							<option value="H2">Nagłówek 2</option>
							<option value="H3">Nagłówek 3</option>
							<option value="H4">Nagłówek 4</option>
							<option value="H5">Nagłówek 5</option>
							<option value="H6">Nagłówek 6</option>
							<option value="DIV">Div</option>
							<option value="SECTION">Sekcja</option>
						</select>`);
					}else if (e[x] === "fontName"){
						a1.append(`<select class="aquay-select aquay-input-margin ${e[x]}" alt="${translate_pl[e[x]]}" title="${translate_pl[e[x]]}">
							<option value="Arial">Arial</option>
							<option value="Comic Sans MS">Comic Sans MS</option>
							<option value="Courier">Courier</option>
							<option value="Georgia">Georgia</option>
							<option value="Tahoma">Tahoma</option>
							<option value="Times New Roman">Times New Roman</option>
							<option value="Verdana">Verdana</option>
						</select>`);
					}else if (e[x] === "fontSize"){
						a1.append(`<select class="aquay-select aquay-input-margin ${e[x]}" type="number" alt="${translate_pl[e[x]]}" title="${translate_pl[e[x]]}">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
						</select>`);
					}else if (e[x] === "foreColor"){
						a1.append(`<div class="aquay-color cursor-pointer" title=""><img src="${aquay_path}ikony/${aquay_item_[e[x]]}" loading="lazy" alt="${translate_pl[e[x]]}" title="${translate_pl[e[x]]}"><input type="color" class="aquay-input-color aquay-input-margin ${e[x]}" alt="${translate_pl[e[x]]}" title="${translate_pl[e[x]]}"></div>`);
					}else if (e[x] === "hiliteColor"){
						a1.append(`<div class="aquay-color cursor-pointer" title="${translate_pl[e[x]]}"><img src="${aquay_path}ikony/${aquay_item_[e[x]]}" loading="lazy" alt="${translate_pl[e[x]]}" title="${translate_pl[e[x]]}"><input type="color" class="aquay-input-color aquay-input-margin ${e[x]}" alt="${translate_pl[e[x]]}" title="${translate_pl[e[x]]}"></div>`);
					}else{
						a1.append(`<section class="aquay-ikona cursor-pointer ${e[x]}"><img src="${aquay_path}ikony/${aquay_item_[e[x]]}" loading="lazy" alt="${translate_pl[e[x]]}" title="${translate_pl[e[x]]}" /></section>`);
					}
				}
			}
		}

		// load end
		console.info("Aquay: Ładowanie Zakończone");
	}

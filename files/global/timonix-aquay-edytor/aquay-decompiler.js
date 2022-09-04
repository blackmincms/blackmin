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


function aquayDecompiler(aquay_container_path = ".aquay-editor-container", aquay_blocks) {
		
		// check if aquay container has value
		if (!document.querySelector(aquay_container_path).hasAttribute("value")) {
			return  false;
		}

		// get aquay text formated
		let aquay_formated = document.querySelector(aquay_container_path).value;
		// check aquay formated not empty
		if ((aquay_formated !== undefined) && (aquay_formated.length  <= 0)) {
			alert("Aquay: Wystąpił błąd pod czas analizy kodu aquay.")
			return false;
		}

		// set aquay time debug
		let TD = performance.now();

		// informacja o rozpoczęciu kompilowania przez kompilator aquay > black min
		console.info("Aqua: DeKompilowanie kodu");

		// new DOMParser
		const parser = new DOMParser();
		let aquay_parse = parser.parseFromString(aquay_formated, "text/html");
		let aquay_blocks_parse = parser.parseFromString(aquay_blocks, "text/html");

		let aquay_type = aquay_parse.querySelectorAll("[aquay-type]");

		// remove value in aquay container
		document.querySelector(aquay_container_path).removeAttribute("value");

		// the cache aquay
		let aquay_cache = new DocumentFragment();

		// check if aquay_type not empty
		if (aquay_type.length === 0) {
			alert("Aquay: Dane sformatowane 'aquay' został uszkodzony!");
			return false;
		}

		aquay_type.forEach((element, key, array) => {
			let block_find = aquay_blocks_parse.querySelector(`[aquay-type="${element.getAttribute("aquay-type")}"]`);
			// check block_find is exist
			if (block_find === undefined) {
				console.error("Aquay dc: aquay block not found");
				return;
			}

			let aquay_typeed = element.getAttribute("aquay-type");

			element.removeAttribute("class");
			element.removeAttribute("aquay-type");
			
			let aquay_coppy = block_find.closest("div.aquay-edytuj-container").cloneNode(true);
			if (aquay_typeed == "type/file") {
				aquay_coppy.querySelector("[aquay-type]").setAttribute("title", element.getAttribute("title"));
				aquay_coppy.querySelector("[aquay-type]").setAttribute("title-orginal", element.getAttribute("title-orginal"));
				aquay_coppy.querySelector("[aquay-type]").setAttribute("src-orginal", element.getAttribute("src-orginal"));
				aquay_coppy.querySelector("[aquay-type]").innerHTML = element.innerHTML;
			}else if (aquay_typeed == ("type/text")) {
				aquay_coppy.querySelector("[aquay-type]").innerHTML = element.outerHTML;
			} else {
				aquay_coppy.querySelector("[aquay-type]").innerHTML = element.innerHTML;
			}
			aquay_cache.appendChild(aquay_coppy);
		})

		// check if all is fine
		if (aquay_cache.children.length !== aquay_type.length) {
			alert("Aquay: Wystąpił błąd pod czas formatowania kodu aquay!");
			return false;
		}
		
		// add cache to aquay document
		// document.querySelector('div.aquay-block-editor').innerHTML = aquay_cache.children;
		document.querySelector('div.aquay-block-editor').innerHTML = "";
		// document.querySelector('div.aquay-block-editor').appendChild = aquay_cache;
		document.querySelector('div.aquay-block-editor').appendChild(aquay_cache);

		// informacja o Wstawianie danych przez komilator aquay > black min
		console.info("Aquay: Wstawianie informacji o kodzie aquay");
		// informacja o zakończeniu kompilowania przez komilator aquay > black min
		console.info("Aquay: Zakończono dekomilowanie kodu");

		// wyświetlanie informaji o szybkośći kompilacji
		console.log(`Aquay: Debug time is: ${((performance.now()) - (TD))} ms`);

		return true;
		
	}

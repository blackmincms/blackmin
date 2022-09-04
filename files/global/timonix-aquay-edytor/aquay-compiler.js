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

	function aquayCompiler(aquay_container_path = ".aquay-editor-container") {

		// informacja o pobieranie danych przez komilator aquay > black min
		console.info("Aquay: Pobieranie informacji o kodzie");
		// set aquay time debug
		let TD = performance.now();

		let aquay_container = document.querySelector(aquay_container_path);

		// check aquay_container undefined
		if (aquay_container == undefined) {
			console.error("Aquay: Brak edytora docelowego!");
			alert("Aquay: Brak edytora docelowego!");
		}

		// find Aquay editor code format
		let aquay_editor_code_format = aquay_container.querySelector(".aquay-block-editor").innerHTML;

		// check to geting code format

		if (aquay_editor_code_format === undefined) {
			console.error("Aquay: Wystąpił nie znany błąd pod czas pobieranie sformatowanego tekstu!");
			tsr_alert("error", "Aquay: Wystąpił nie znany błąd pod czas pobieranie sformatowanego tekstu!", aquay_container, "before")
		}
		
		// informacja o rozpoczęciu kompilowania przez kompilator aquay > black min
		console.info("Aquay: Kompilowanie kodu");
		
		// kompilowanie kodu zrozumiałego dla black min'aLinkcolor
		
		// tworzenie diva na którym będziemy przeprowadzać kompilacje 
		
		var add_element_compiler = document.createElement("aquay_compiler");
		
		add_element_compiler.setAttribute('aquay_compiler', "kompiler aquay / black min");
		add_element_compiler.setAttribute('id', "compiler_aquay_black_min");
		add_element_compiler.setAttribute('class', "aquay-compiler");
		add_element_compiler.setAttribute('style', "display: none; width: 0px; height: 0px; left: -9999px;")
		add_element_compiler.innerHTML = aquay_editor_code_format;
		
		$("html").append(add_element_compiler);

		// new DOMParser
		// const parser = new DOMParser();
		// let aquay_parse = parser.parseFromString(aquay_editor_code_format, "text/html");

		// find (aquay_compiler)
		let aquay_compiler = document.querySelector("aquay_compiler.aquay-compiler");
		// console.log(aquay_parse);
		// the cache aquay
		// let aquay_cache = new DocumentFragment();
		// aquay_cache.appendChild(aquay_parse);

		// get list formated element
		let aquay_list_formated_element = aquay_compiler.querySelectorAll('[aquay-type]');

		let aquay_list_formated_element_html = [];
		aquay_list_formated_element.forEach((element, index, array) => {
			let aquay_type = element.getAttribute("aquay-type")
			aquay_list_formated_element_html.push(`<!-- Aquay formated element : ${aquay_type} : ON -->`);
			if (element.classList.contains('aquay-html-referer')) {
				element.setAttribute("class", "");
				element.classList.add("aquay-formatted-" + aquay_type.split("/")[1])

				element.removeAttribute("tabindex");
				element.removeAttribute("contenteditable");

				if (aquay_type === "type/file") {
					let elNodeName = element.nodeName.toLowerCase();
					let newString = element.outerHTML.trim().replace('<'+ elNodeName,'<button');
	
					newString = newString.slice(0,newString.lastIndexOf('</button>'));    

					newString = newString + "</button>";
					element = newString;
				}
				aquay_list_formated_element_html.push(element);
			} else {
				element.setAttribute("class", "");
				element.classList.add("aquay-formatted-" + aquay_type.split("/")[1])

				element.removeAttribute("tabindex");
				element.removeAttribute("contenteditable");

				if (aquay_type === "type/file") {
					let elNodeName = element.nodeName.toLowerCase();
					let newString = element.outerHTML.trim().replace('<'+ elNodeName,'<button');
	
					newString = newString.slice(0,newString.lastIndexOf('</button>'));    

					newString = newString + "</button>";
					element = newString;
				}
				aquay_list_formated_element_html.push(element.innerHTML);
			} 
			if (aquay_type === "type/text") {
				let childrens = Array.from(element.children);
				childrens.forEach((elements, indexs, arrays) => {
					if (elements.classList.contains('tsr-sort-handle')) {
						return;
					}
					elements.setAttribute("aquay-type", aquay_type);
					elements.setAttribute("class", "");
					elements.classList.add("aquay-formatted-" + aquay_type.split("/")[1])

					elements.removeAttribute("tabindex");
					elements.removeAttribute("contenteditable");

					Array.from(elements.children).forEach((value, index, array) => {
						if (value.nodeName.toLowerCase() == "br") {
							return value.textContent = "\n";
						}
					});

					aquay_list_formated_element_html.push(elements);
				});
			}
			aquay_list_formated_element_html.push(`<!-- Aquay formated element : OFF -->`);
		});

		$(aquay_compiler).html(`<aquay_formatted time="${Date.now()}" aqv="1.0"> </aquay_formatted>`).find("aquay_formatted").html(aquay_list_formated_element_html);

		// get formatted data
		let formatted = $(aquay_compiler).html();

		// remove aquay compiler tag
		$(aquay_compiler).remove();
		
		// informacja o zakończeniu kompilowania przez komilator aquay > black min
		console.info("Aquay: Zakończono komilowanie kodu");

		// wyświetlanie informaji o szybkośći kompilacji
		console.log(`Aquay: Debug time is: ${((performance.now()) - (TD))} ms`);
		
		return formatted.toString();
		
	} 

/*
//
//				Black min cms - reguły javascriptjquery
//									V.1.2
//				  Wszelkie Prawa Zaszczeżone by Timonix
//
*/

	// Filtrowanie i dodawnie do strony kodu napisanego przez autora posta ON //

	window.addEventListener("load", function(event) {

		// dodawanie klasy do kontentu posta
		var a =  document.getElementsByClassName("blackmin-wlasny-kod");
		if(a.length != 0) {
			for(let i=0;i<a.length; i++){
				let wkod2 = a[i].innerText;
				a[i].textContent  = "";
				a[i].insertAdjacentHTML("beforeend",wkod2);
			}
		}
	
	});
	
	// Filtrowanie i dodawnie do strony kodu napisanego przez autora posta OFF //	
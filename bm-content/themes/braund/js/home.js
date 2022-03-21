/*
//
//				Braund teamplate style - reguły javascript\jquery
//									V.1.0
//				  Wszelkie Prawa Zaszczeżone by Timonix
//
*/

	$(document).ready(function(){

		//console.log($("blackmin_kod").find(".blackmin-obrazek").length);
		//console.log($("blackmin_kod").find(".blackmin-obrazek"));
		
		//console.log($("braund-post-"));
		
		var x = $('.blackmin-obrazek');
		var OOs = $('.blackmin-obrazek');
		
		var OO = $('.blackmin-obrazek');
		var GG = $('.blackmin-galeria');
		var PP = $('.blackmin-plik');
/*if(x.length) {
	x.parent("blackmin_kod").after('<div class="braund-namescape-img">Post Zawiera Zdięcja!</div>');
	x.remove();
   console.log('Znaleziono ' + x.length + ' elementów.');
}*/
		
		//function replace_tag_braund(klucz){
		// usuwanie zdjęć
		//if($("blackmin_kod").find(".blackmin-obrazek").length){
		//	$("blackmin_kod").find(".blackmin-obrazek").remove();
		//	if($(".braund-namescape-img").length == 0){
		//		//$("blackmin_kod").after('<div class="braund-namescape-img">Post Zawiera Zdięcja!</div>');
		//	}
		//}		

		if(OO.length) {
			OO.parent("blackmin_kod").after('<div class="braund-namescape-img">Post Zawiera Zdięcja!</div>');
			OO.remove();
		}
		
		//if(OO.length) {
		//	$("blackmin_kod").find(".blackmin-obrazek").remove();
		//	if($(OO).find(".braund-namescape-img").length == 0){
		//		OO.after('<div class="braund-namescape-img">Post Zawiera Zdięcja!</div>');
		//	}
		//}
		
		// usuwanie galerij
		/*if($("blackmin_kod").find(".blackmin-galeria").length){
			$("blackmin_kod").find(".blackmin-galeria").remove();;
			if($(".braund-namescape-img").length == 0){
				//$("blackmin_kod").after('<div class="braund-namescape-img">Post Zawiera Zdięcja!</div>');
			}
		}*/

		if(GG.length) {
			GG.parent("blackmin_kod").after('<div class="braund-namescape-img">Post Zawiera Galerie!</div>');
			GG.remove();
		}
		
		// usuwanie pliklów do pobrania
		/*if($("blackmin_kod").find(".blackmin-plik").length){
			$("blackmin_kod").find(".blackmin-plik").remove();;
			if($(".blackmin-plik").length == 0){
			//	$("blackmin_kod").after('<div class="braund-namescape-img">Post Zawiera Plik do Pobrania!</div>');
			}
		}*/

		if(PP.length) {
			PP.parent("blackmin_kod").after('<div class="braund-namescape-img">Post Zawiera Plik do Pobrania!</div>');
			PP.remove();
		}

		if($("blackmin_kod").find(".blackmin-wlasny-kod").length){
			$("blackmin_kod").find(".blackmin-wlasny-kod").remove();;
		}

		// dodawanie klasy do kontentu posta
		$("blackmin_kod").addClass("blackmin-kod-home");
		
		//}
		
	});
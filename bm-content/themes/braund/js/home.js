/*
//
//				Braund teamplate style - reguły javascript\jquery
//									V.2.0
//
*/

	let conLoad = document.addEventListener("DOMContentLoaded", () => {
		let postFinder = document.querySelectorAll(".braund-post");

		postFinder.forEach((value) => {
			let post = (value.children[0]);
			
			let a = 0, b = 0, c = 0;
			
			post.querySelectorAll(".aquay-formatted-picture, .aquay-formatted-gallery, .aquay-formatted-file, .aquay-formatted-code, .aquay-formatted-own_code").forEach((value) => {if (value.classList.contains("aquay-formatted-picture")) {a++;}; if (value.classList.contains("aquay-formatted-gallery")) {b++;}; if (value.classList.contains("aquay-formatted-file")) {c++;}; value.remove();});
			
			queueMicrotask(() => {
				post.childNodes.forEach(element => {
					if (element.nodeName == "#comment" || element.name == "#comment") {
						return post.removeChild(element);
					}
				});
			});
			
			value.innerHTML =  post.innerHTML;
			
			if (a !== 0) {
				value.insertAdjacentHTML("afterend", '<div class="braund-namescape-img">Post Zawiera Zdięcja!</div>');
			}
			if (b !== 0) {
				value.insertAdjacentHTML("afterend", '<div class="braund-namescape-img">Post Zawiera Galerie!</div>');
			}
			if (c !== 0) {
				value.insertAdjacentHTML("afterend", '<div class="braund-namescape-img">Post Zawiera Plik do Pobrania!</div>');
			}
		});
	});

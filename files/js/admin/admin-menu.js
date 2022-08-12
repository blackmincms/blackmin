/**
*	"Black Min" 
*	
*	For the full copyright and license information, please view the LICENSE
*	file that was distributed with this source code.
*
*	@package BlackMin
*	
*	#file: 2.0
*
*	this file is auto rendering data in edit menu | admin panel
*/

    function adminEditMenu(data, parent, b) {
        tsr_sortiner("tsr-data",".tsr-psort-container",".tsr-sortiner",".tsr-sortitem",3,".tsr-sortbox1",false, 50);
		tsr_sortiner("tsr-data",".tsr-psort-container-item",".tsr-sortiner",".tsr-sortitem",3,".tsr-sortbox", false, 50);

        parent = $(document).find("#blackminload_container");
        LoadEditMenu (parent);

		// skrypt dodający nowy element do menu
		$( "#blackminsend" ).on( "click", "#submit_data", function() {
			add_menu_item();
		});	

		// click on tsr-sort-item-button
		$(document).on("click", ".tsr-sort-item-button", function(){
			$(this).closest(".tsr-sortiner").find(".tsr-sort-item").toggleClass("tsr-display-block");
		});
		
		// click on bm-button-cancel
		$(document).on("click", ".bm-button-cancel", function(){
			$(this).closest(".tsr-sortiner").find(".tsr-sort-item").toggleClass("tsr-display-block");
		});

		// click on edit_menu_item
		$(document).on("click", "#blackminload .edit_menu_item", function(e){
			e.preventDefault();
			let item_menu = $(this).closest(".tsr-sortiner");
			let id = item_menu.attr("tsr-index");
			let url = item_menu.find('input[name="adres-url-rename"]').val();
			let title = item_menu.find('input[name="tytul-menu-rename"]').val();
			let data = {"bm_content": JSON.stringify({"action": "rename", "url": "Menu", "params": {"id": id, "url": url, "title": title}})};

			tsr_ajax("bm/core/Delegate/DelegateBM.php", data, "", false, function (info){
				const dataMenu = JSON.parse(info);

				// check if menu is empty
				if (dataMenu.status !== undefined) {
					tsr_alert(dataMenu.status, dataMenu.message, item_menu.find(".tsr-sort-item"), "append", true, 500);
					// check data is success
					if (dataMenu.status == "success") {
						// set title
						item_menu.find('.tsr-sort-handle').text(title);
					}
				} else {
					// set error
					tsr_alert("error", "Wystąpił błąd pod czas zapisywania danych!", item_menu.find(".tsr-sort-item"), "append", true, 500);
				}
			});
		});

		// click on delete_menu_item
		$(document).on("click", ".tsr-modal-active input.bm-button-ac", function(e){
			e.preventDefault();
			let parent = $(".tsr-modal-active").find(".tsra");
			let id = $(this).attr("bm-action-data");
			let data = {"bm_content": JSON.stringify({"action": "del", "url": "Menu", "params": {"id": id}})};

			tsr_ajax("bm/core/Delegate/DelegateBM.php", data, "", false, function (info){
				const dataMenu = JSON.parse(info);

				// check if menu is empty
				if (dataMenu.status !== undefined) {
					tsr_alert(dataMenu.status, dataMenu.message, parent, "append", true, 500);
					// check data is success
					if (dataMenu.status == "success") {
						// remove item
						$('.tsr-sortiner[tsr-index="'+ id +'"]').remove();

						// check 2s and remove modal
						setTimeout(function(){
							$(".tsr-modal-active").remove();
						}
						, 2000);
					}
				} else {
					// set error
					tsr_alert("error", "Wystąpił błąd pod czas usuwania danych!", parent, "append", true, 500);
				}
			});
		});

		// click on submit_data
		$("#blackminload").on("click", "#submit_data", function(e){
			e.preventDefault();
			let bm_menu_structur = tsr_sortiner_index(".tsr-psort-container", ".tsr-sortiner", "tsr-index", ".tsr-sortitem");
			let data = {"bm_content": JSON.stringify({"action": "update", "url": "Menu", "params": {"bm_menu_structur": bm_menu_structur}})};

			tsr_ajax("bm/core/Delegate/DelegateBM.php", data, "", false, function (info){
				const dataMenu = JSON.parse(info);

				// check if menu is empty
				if (dataMenu.status !== undefined) {
					tsr_alert(dataMenu.status, dataMenu.message, parent, "append", true, 500);
				} else {
					// set error
					tsr_alert("error", "Wystąpił błąd pod czas aktualizowania danych!", parent, "append", true, 500);
				}
			});
		});
    }

    function LoadEditMenu (parent) {
        let data = {"bm_content": JSON.stringify({"action": "get", "url": "Menu", "params": []})};

        tsr_ajax("bm/core/Delegate/DelegateBM.php", data, "", false, function (info){
            const dataMenu = JSON.parse(info);

			// check if menu is empty
			if (dataMenu.length == 0) {
				tsr_alert("info", "Brak danych do załadowania!", parent, "html", false);
			} else if (dataMenu == undefined) {
				tsr_alert("war", "Wystąpił błąd pod czas pobierania danch!", parent, "html", false);
			} else if (dataMenu.type !== undefined) {
				tsr_alert(dataMenu.type, dataMenu.message, parent, "html", false);
			} else {
				// render menu
				render_menu(dataMenu, parent);
			}
        });
    }

	function render_menu(data, parent, is_once = true) {
		// check "bm_menu_items" is set
		if ((data.bm_menu_items === undefined) || (data.bm_menu_structur === undefined)) {
			// set error message
			tsr_alert("error", "Wystąpił błąd pod czas renderowania Menu", parent, "html", false);
		} else if (data.bm_menu_structur.length == 0) {
			// set error message
			tsr_alert("info", "Brak danych do załadowania!", parent, "html", false);

			new_menu_items(data, true, parent);	
		} else {
			// render menu
			let menu_render = render_menu_items(parent, data["bm_menu_items"], data["bm_menu_structur"]);

			// check menu_render not error
			if ((menu_render === undefined || (menu_render === false) || (menu_render === null))) {
				// set error message
				tsr_alert("error", "Wystąpił nie znany błąd podczas renderowania Menu", parent, "html", false);
			} else {
				// set menu
				$(parent).html(menu_render[0]);

				new_menu_items(menu_render[1], false, parent);


			}
		}
	}

	// function check if new menu items
	function new_menu_items(data, is_once, parent) {
		// map id_meta to id from data object
		let id_chil = data.map(function(item) {
			// buffor for id
			let id_buffor = {};

			// add item.id_meta to buffor
			id_buffor.id = item.id_meta;

			return id_buffor;
		});

		// check id_chil not empty
		if ((id_chil.length === 0) || (is_once === true)) {
			// remove element class "bm-container-item-dellete"
			parent.closest("#blackminload").find(".bm-container-item-dellete").addClass("tsr-display-none");
		} else {
			// render menu 
			render_menu({bm_menu_items: data, bm_menu_structur: id_chil}, parent.closest("#blackminload").find("#blackminload_container_item"), false);	
			parent.closest("#blackminload").find(".bm-container-item-dellete").removeClass("tsr-display-none");				
		}
	}

	function render_menu_items(parent, data, data_structur, sort = "tsr-sortiner", sorthandle = "tsr-sort-handle", sort_item = "tsr-sort-item", sortitem = "tsr-sortitem") {
		// buffor for menu items
		let buffor = "";

		// render menu items
		data_structur.forEach(function(item, index, array){
			// check id is set
			if (item["id"] === undefined) {
				// set error message
				tsr_alert("error", "Struktura Menu jest uszkodzona", parent, "html", false);
				return false;
			}

			// filter menu item for current id
			let menu_item = data.filter(function(item_menu, index_menu, array_menu){
				return item["id"] === item_menu["id_meta"];
			});

			// json decode menu item
			let menu_item_json = JSON.parse(menu_item[0]["bm_value"]);

			// set menu item title from menu_item[0]
			let menu_item_title = menu_item_json[0];
			// set menu item url from menu_item[0]
			let menu_item_url = menu_item_json[1];
			// set menu item typ from menu_item[0]
			let menu_item_typ = menu_item_json[2];
			
			// set menu item id from menu_item[0]
			let menu_item_id = menu_item[0]["id_meta"];
			// set menu bm_name from menu_item[0]
			let menu_item_bm_name = menu_item[0]["bm_name"];
			// set menu bm_parent from menu_item[0]
			let menu_item_bm_parent = menu_item[0]["bm_parent"];


			buffor += `<div class="${sort}" tsr-index="${menu_item_id}">
				<div class="${sorthandle}">
					${menu_item_title}
				</div>
				<div class="${sort_item}">
					<section class="tsr fs-100">
						<section class="col-ms40 tsr-mt-10">
							Własny url
						</section>
						<section class="col-ms60">
							<input type="text" name="adres-url-rename" class="input" placeholder="Edytuj url" value="${menu_item_url}"/>
						</section>
					</section>
					<section class="tsr fs-100">									
						<section class="col-ms40 tsr-mt-10">
							Własny Tytuł
						</section>
						<section class="col-ms60">
							<input type="text" name="tytul-menu-rename" class="input" placeholder="Edytuj Tytuł" value="${menu_item_title}"/>
							<input type="hidden" name="item_type" class="input tsr-display-none" value="${menu_item_typ}"/>
						</section>
					</section>	
					<section class="tsr tsr-mt-20">
						<button type="button" class="submit edit_menu_item" value="Edytuj element menu"  >
							Edytuj element menu
						</button>
					</section>
					<section class="tsr r-0 fs-100 tsr-visable-hover add-text-alert-rename">

						<section class="tsr-button tsr-visable-hover-element tsr-visibility-visable-2 bm-delete">		
                                            
							<span class="tsr-pmodal red" tsr-modal-close="true">
								Usuń
								<section class="tsr-modal" tsr-modal-close="true">
									<section class="tsr">
										<span class="tsr tsr-border-bottom-dashed">Potwierdź akcję</span>
										
										<input type="button" class="col-2 tsr-p-5px tsr-button bm-button-ac " bm-action-data="${menu_item_id}" value="Usuń!">
										<section class="col-2 tsr-button tsr-error tsr-modal-closed  bm-button-delete tsr-modal-closed-button">
											Anuluj!
										</section>
											
									</section>
								</section>
							</span>

						</section>

						<section class="tsr-fr tsr-button tsr-visable-hover-element bm-cancel">
							<span class="bm-button-cancel">
								anuluj
							</span>	
						</section>

					</section>
					<section class="tsr-mt-5">
						edytuj element menu > ${menu_item_typ}
					</section>
				</div>
			`;
			
			// check if menu item has children
			if (item["children"] !== undefined) {
				buffor += `<div class="${sortitem}">`;
				// render children
				let menu_chil = render_menu_items(parent, data, item["children"], sort, sorthandle, sort_item, sortitem);
				buffor += menu_chil[0];
				buffor += `</div>`;
			}
								
			buffor += `<section class="tsr-sort-item-button cursor-pointer">+</section>
				</div>
			`;

			// delete this item from data
			data.filter(function(item_menu, index_menu, array_menu){
				if (item["id"] === item_menu["id_meta"]) {
					array_menu.splice(index_menu, 1);
				}
			});
		});

		return [buffor, data];
	}

	// send data to server and get response use tsr_ajax
	function add_menu_item () {
		// set parent form
		let parentSend = document.getElementById("blackminsend");

		// get data from form
		let url = parentSend.querySelector('input[name="url-menu"]').value;
		let title = parentSend.querySelector('input[name="title-menu"]').value;

		// messageBox
		let messageBox = parentSend.querySelector("#blackminsend_container");
		
		if (url == "" || title == "") {
			if (url == "") {
				$(parentSend.querySelector('input[name="url-menu"]')).effect( "shake" );
			}	
			if (title == "") {
				$(parentSend.querySelector('input[name="url-menu"]')).effect( "shake" );
			}
			
			tsr_alert("war", "Nie wypełniłeś wszystkich informacji", messageBox, "append", true, 500);
		}else {

			// const data = {};
			let data = {"bm_content": JSON.stringify({"action": "add", "url": "menu", "params": {"url": url, "title": title}})};

			// send data to server
			$.ajax({
				type:"POST",
				url:"bm/core/Delegate/DelegateBM.php",
				data: data
			})
			.done(function(info){
				info = JSON.parse(info);

				if (info["status"] == "success") {
					tsr_alert("success", "Dodano nowy element!", messageBox, "append", true);

					// clear form
					parentSend.querySelector('input[name="url-menu"]').value = "";
					parentSend.querySelector('input[name="title-menu"]').value = "";

					// load menu
					load_edit_menu();
				} else {
					tsr_alert(info["status"], info["message"], messageBox, "append", true);
				}
			})
			.fail(function(){
				alert("Wystąpił błąd. Spróbuj ponownie później");
			});

		}
	}

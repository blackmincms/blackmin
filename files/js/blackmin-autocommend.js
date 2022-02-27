/*
	CMS ,,Black Min''  Został stworzony przez timonix.pl
	
	ten plik służy do Automatycznego zarządzania opcjami w form/tabeli
	
	Black Min cms,
	
	#plik: 1.0
*/

    function bm_autocomment (e) {
        let t = document.querySelector("#blackminload_container #blackmin_action");
        // bm button action confirmed
        let ta = document.querySelectorAll("#blackminload_container .bm-row-delete");
        if (t != undefined) {
            if (t.length != 0) {   

                t.addEventListener("click", (e) => {
                    tsr_blocked_submit(2500,"#blackminload_container .bm-row-delete");
                    // pobieranie dancyhh z zaznaczonych checkbox
                    let b = tsr_get_checkbox_data("bm-data", "#blackminload_container", ".bm-pcheckbox", ".bm-checkbox");
                    let a = t.getAttribute("action");
                    if (a != undefined) {
                        tsr_ajax("insert/"+ a.trim() +".php", b, "", false, function (e){
                            const b = JSON.parse(e);
                            if (b["status"] == "error") {
                                tsr_alert ("error", b["message"], t, "after", true, 2500);
                            } else if (b["status"] == "info") {
                                tsr_alert ("info", b["message"], t, "after", true, 1500);
                            } else if (b["status"] == "warn") {
                                tsr_alert ("warning", b["message"], t, "after", true, 2500);
                            } else if (b["status"] == "warning") {
                                tsr_alert ("warning", b["message"], t, "after", true, 2500);
                            } else if (b["status"] == "normal") {
                                tsr_alert ("normal", b["message"], t, "after", true, 1500);
                            } else if (b["status"] == "success") {
                                tsr_alert ("success", b["message"], t, "after", true, 1500);
                                // usuwanie danych
                                tsr_checkbox_del("bm-data", "#blackminload_container", ".bm-checkbox", ".bm-row-dl");
                            } else {
                                tsr_alert ("error", "Błąd serwera - nie prawidłowe dane!", t, "after", true, 1500);
                                console.error();
                            }
                        });
                    }else{
                        console.error("BlackMin autocommand: Nie znaleziono wywyołania akcji!");
                    }
                });

            }
        }
        
        if (ta != undefined) {
            if (ta.length != 0) {   

               for (let i = 0; i < ta.length; i++) {
                ta[i].addEventListener("click", (e) => {
                    window.setTimeout(
                        () => {
                            let tab = document.querySelector(".tsr-modal-active .bm-button-ac");
                            let x = document.querySelector(".tsr-modal-active .tsr-modal-container-content .tsra");
                            if (tab != undefined) {
                                if (tab.length !=0) {
                                tab.addEventListener("click", (e2) => {
                                        tsr_blocked_submit(2500, ".tsr-modal-active .bm-button-ac");
                                        // pobieranie dancyhh z zaznaczonych checkbox
                                        let c = tab.getAttribute("bm-action-data");
                                        let c2 = {"name": "kt", "content": {"0" : c}};
                                        let a = t.getAttribute("action");
                                        if (a != undefined) {
                                            tsr_ajax("insert/"+ a.trim() +".php", c2, "", false, function (e){
                                                const b = JSON.parse(e);
                                                if (b["status"] == "error") {
                                                    tsr_alert ("error", b["message"], x, "append", true, 2500);
                                                } else if (b["status"] == "info") {
                                                    tsr_alert ("info", b["message"], x, "append", true, 1500);
                                                } else if (b["status"] == "warn") {
                                                    tsr_alert ("warning", b["message"], x, "append", true, 2500);
                                                } else if (b["status"] == "warning") {
                                                    tsr_alert ("warning", b["message"], x, "append", true, 2500);
                                                } else if (b["status"] == "normal") {
                                                    tsr_alert ("normal", b["message"], x, "append", true, 1500);
                                                } else if (b["status"] == "success") {
                                                    tsr_alert ("success", b["message"], x, "append", true, 1500);
                                                    // usuwanie danych
                                                    tsr_checkbox_del2("bm-data", "#blackminload_container", 'input.bm-checkbox[bm-data="'+ c +'"]', ".bm-row-dl");
                                                } else {
                                                    tsr_alert ("error", "Błąd serwera - nie prawidłowe dane!", t, "append", true, 1500);
                                                    console.error();
                                                }
                                            });
                                        }else{
                                            console.error("BlackMin autocommand: Nie znaleziono wywyołania akcji!");
                                        }
                                });
                                }
                            }
                        }
                    , 50);
                });
               }

            }
        }

        tsr_checkboxall2("#blackminload_container", ".bm-pcheckbox", ".bm-checkbox");

    };
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
*	ten plik służy do Automatycznego zarządzania opcjami w form/tabeli | admin panel
*/

    function bm_autocomment (e) {
        let t = document.querySelector("#blackminload_container #blackmin_action");
        let tx = document.querySelector("#blackmin_change_action #akcja");
        // bm button action confirmed
        let ta = document.querySelectorAll("#blackminload_container .bm-row-delete");
        if (t != undefined) {
            if (t.length != 0) {   

                if (tx != undefined) {
                    // changet rename visability
                    tx.addEventListener("change", (e) => {
                        // sprawdzaqnie czy istnieje zmiana akcji submit
                        if (tx != undefined) {
                            if (tx.value === "rename") {
                                $("#blackmin_change_action #bm_input_rename").css("display", "block");
                            }else{
                                $("#blackmin_change_action #bm_input_rename").css("display", "none");
                            }
                        }
                    });
                }
                // request post
                t.addEventListener("click", (e) => {
                    tsr_blocked_submit(2500,"#blackminload_container .bm-row-delete");
                    // pobieranie dancyhh z zaznaczonych checkbox
                    let x = tsr_get_checkbox_data("bm-data", "#blackminload_container", ".bm-pcheckbox", ".bm-checkbox");
                    let a = t.getAttribute("action");
                    // action type device
                    let act = "del";
                    // sprawdzaqnie czy istnieje zmiana akcji submit
                    if (tx != undefined) {
                        if (tx.value == "rename") {
                            a = t.getAttribute("rename");
                            // pobieranie inputa rename
                            let k = document.querySelector("#blackmin_change_action #folder_change");
                            if (k != undefined) {
                                x.rename = k.value;
                            } else {
                                tsr_alert ("error", "Błąd pobierania danych do zmianny", document.querySelector("#blackmin_change_action"), "after", true, 1500);
                            }
                        }
                        act = tx.value;
                    }
                    if (a != undefined) {
                        let xe = {"bm_content": JSON.stringify({"action": act, "url": a.trim(), "parm": x})};
                        tsr_ajax("bm/core/Delegate/DelegateBM.php", xe, "", false, function (e){
                            const f = JSON.parse(e);
                            if (f["status"] == "error") {
                                tsr_alert ("error", f["message"], t, "after", true, 2500);
                            } else if (f["status"] == "info") {
                                tsr_alert ("info", f["message"], t, "after", true, 1500);
                            } else if (f["status"] == "warn") {
                                tsr_alert ("warning", f["message"], t, "after", true, 2500);
                            } else if (f["status"] == "warning") {
                                tsr_alert ("warning", f["message"], t, "after", true, 2500);
                            } else if (f["status"] == "normal") {
                                tsr_alert ("normal", f["message"], t, "after", true, 1500);
                            } else if (f["status"] == "success") {
                                tsr_alert ("success", f["message"], t, "after", true, 1500);
                            } else if (f["status"] == "success_del") {
                                tsr_alert ("success", f["message"], t, "after", true, 1500);
                                // usuwanie danych
                                tsr_checkbox_del("bm-data", "#blackminload_container", ".bm-checkbox", ".bm-row-dl");
                            } else {
                                tsr_alert ("error", "Błąd serwera - nie prawidłowe dane!", t, "after", true, 1500);
                                console.error("BlackMin autocommand: Błąd serwera - nie prawidłowe dane!");
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
                                        let f = document.querySelector("#blackminload_container .bm-pcheckbox").getAttribute("bm-data");
                                        let c2 = {"name": f, "content": {"0" : c}};
                                        let a = t.getAttribute("action");
                                        if (a != undefined) {
                                            let xe = {"bm_content": JSON.stringify({"action": "del", "url": a.trim(), "parm": c2})};
                                            tsr_ajax("bm/core/Delegate/DelegateBM.php", xe, "", false, function (e){
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
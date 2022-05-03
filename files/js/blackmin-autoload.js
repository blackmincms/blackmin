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
*	ten plik służy do Automatycznego ładowania danych z serwera | admin panel
*/

    window.addEventListener("load", () => {
        const t = document.forms.namedItem("blackminload");

        console.log("BlackMin autoload: start");
        
        if (t != undefined) {
        let a = t.getAttribute("action");
            if (a.trim().length != 0) {
                let b = document.getElementById("blackminload_container");

                if (b) {

                    let c = t.elements;

                    // wysyłanie danych
                    send(a, c, "", b);

                    // nasłuchiwanie form do automatycznego aktulizaji danych
                    addEvent (c, a, b);
                    
                }else{
                    console.error("BlackMin autoload: Nie znaleziono kontenera docelowego!");
                }

                function addEvent(x, a, b) {
                    for (let i = 0; i < x.length; i++) {
                        const e = x[i];

                        if (e.tagName.toLowerCase() == "input" || e.tagName.toLowerCase() == "textarea") {
                            e.addEventListener("keyup", (z) => {
                                send (a, x, "", b);
                            });
                            
                            e.addEventListener("change", (z) => {
                                send (a, x, "", b);
                            });
                        }else if (e.tagName.toLowerCase() == ("select")) {
                            e.addEventListener("change", (z) => {
                                send (a, x, "", b);
                            });
                        }
                        
                    }
                    
    
                    // sprawdzanie czy input ma element klikalny
                    let at = document.querySelector('section[type="search"], div[type="search"]');
                    if (at.length != 0) {
                        for (let x = 0; x < at.length; x++) {
                            const ate = at[x];
                            
                            ate.addEventListener("click", (z) => {
                                send (a, x, "", b);
                            });
                        }
                    }              
                }

                function send(a, t, c, b, action = "get") {
                    tsr_alert("info", "Ładowanie danych", b, "html", false);
                    let x = {"bm_content": JSON.stringify({"action": action, "url": a.trim(), "param": getValue(t)})};
                    tsr_ajax ("bm/core/Delegate/DelegateBM.php", x, c, false, function (out) {
                        tsr_alert("success", "Dane załadowane prawidłowo!", b, "before", true, 250);
                        if (typeof out == "object" || is_json(out)) {
                                let data = JSON.parse(out);
                            if (data["num_rows"] === 0) {
                                tsr_alert("info", "Brak Danych Do Załadowania", b, "html", false);
                            } else if (data["status"] !== undefined) {
                                tsr_alert(data["status"], data["message"], b, "html", false);
                            } else {
                                a = a.trim().toLowerCase();
                                if (a == "media") {
                                    mediaRender(data, b, a);
                                }else if (a == "post") {
                                    defaultRender(data, b, a, ["authores","status", "type", "tag", "category", "datetime"], ["Dodający", "status", "typ", "tag", "kategoria", "data"], ["id_post", "title", "url"])
                                }else if (a == "categorytag") {
                                    defaultRender(data, b, a, ["bm_short_name", "bm_description", "bm_type"], ["Skr.Nazwa", "Opis", "Typ"], ["id_postmeta", "bm_name"], [25,30,10])
                                } else {
                                    tsr_alert("error", "Wystąpił nieznany błąd!", b, "html", false);
                                }
                            }
                        } else {
                            b.innerHTML = out ;
                        }
                        bm_autocomment();
                    }, function () {
                        tsr_alert("error", "Wystąpił błąd pod czas ładowania danych", b, "html", false);
                    });
                }

            }
        }

        function getValue(x) {
            let buff = {};

            for (let i = 0; i < x.length; i++) {
                buff[x[i].name] = x[i].value;               
            }

            return buff;

        }

        if (t == undefined) {
            const ta = document.forms.namedItem("blackminsend");
            let a = ta.getAttribute("action");
            let u = ta.getAttribute("url");

            bm_autoeditsenddata(u.trim());

            if (ta != undefined) {
                const g = document.getElementById("submit_data");
                if (g != undefined) {
                    g.addEventListener("click", (e) => {
                        e.preventDefault();
                        tsr_blocked_submit(2500, ".submit_data");
                        const xa = ta.getAttribute("action");
                        if (xa != undefined) {
                            if (xa.trim() != 0) {
                                let x = {"bm_content": JSON.stringify({"action": a.trim(), "url": u.trim(), "param": getValue(ta)})};
                                tsr_ajax("bm/core/Delegate/DelegateBM.php", x, "", false, function (e){
                                    const b = JSON.parse(e);
                                    if (b["status"] == "error") {
                                        tsr_alert ("error", b["message"], ta, "after", true, 2500);
                                    } else if (b["status"] == "info") {
                                        tsr_alert ("info", b["message"], ta, "after", true, 1500);
                                    } else if (b["status"] == "warn") {
                                        tsr_alert ("warning", b["message"], ta, "after", true, 2500);
                                    } else if (b["status"] == "warning") {
                                        tsr_alert ("warning", b["message"], ta, "after", true, 2500);
                                    } else if (b["status"] == "normal") {
                                        tsr_alert ("normal", b["message"], ta, "after", true, 1500);
                                    } else if (b["status"] == "location") {
                                        window.location = b["message"];
                                        tsr_alert ("info", "BlackMin: Nastąpi Przekierowanie!", ta, "after", true, 1500);
                                    } else if (b["status"] == "success") {
                                        tsr_alert ("success", b["message"], ta, "after", true, 1500);
                                        clear_form(ta);
                                    } else {
                                        tsr_alert ("error", "Błąd serwera - nie prawidłowe dane!", ta, "after", true, 1500);
                                    }
                                });
                            } else {
                                tsr_alert("war", "Błędne dane docelowych!", ta, "after", true);
                            }
                        } else {
                            tsr_alert("error", "Brak danych docelowych!", ta, "after", true);
                        }
                    });
                } else {
                    tsr_alert("error", "Wystąpił błąd pod czas formatowania danych html!", ta, "after", true);
                }
            }
        }

        async function bm_autoeditsenddata(a) {
            let form = document.querySelector("#blackminload_execute_container");

            if (form !== undefined) {
                let scheme = (form.getAttribute("blackmin") ?? undefined);
                let id_object = (form.getAttribute("id-object") ?? undefined);

                let inp = form.querySelectorAll("input, textarea, select");

                for (let i = 0; i < inp.length; i++) {
                    inp[i].setAttribute("disabled", "disable");
                }
                if ((scheme !== undefined) && (id_object !== undefined) && (id_object !== undefined)) {

                   if (id_object != "null") {
                        tsr_alert("info", "Ładowanie danych do edycji", form, "before", true);
                        let x = {"bm_content": JSON.stringify({"action": "get", "url": a.trim(), "param": {"id": id_object}})};
                        tsr_ajax ("bm/core/Delegate/DelegateBM.php", x, "", false, function (out) {
                            tsr_alert("success", "Dane załadowane prawidłowo!", form, "before", true, 200);
                            if (typeof out == "object" || is_json(out)) {
                                    let data = JSON.parse(out);
                                if (data["num_rows"] === 0) {
                                    tsr_alert("info", "Brak Danych Do Edycji", form, "html", false);
                                } else if (data["status"] !== undefined) {
                                    tsr_alert(data["status"], data["message"], form, "html", false);
                                } else {
                                    bm_autoedit(scheme, data, form);
                                }
                            } else {
                                form.innerHTML = out ;
                            }
                        }, function () {
                            tsr_alert("error", "Wystąpił błąd pod czas ładowania danych", form, "html", false);
                        });
                   } else {
                        tsr_alert("error", "Wystąpił błąd pod czas pobierania id objektu do edycji!", form, "html", false);
                   }

                }else{
                    tsr_alert("error", "Wystąpił błąd pod czas pobierania danych!", form, "html", false);
                }
            }
        }

        function clear_form(t) {
            for (let i = 0; i < t.length; i++) {
                if ((t[i].tagName.toLowerCase() == "input") || (t[i].tagName.toLowerCase() == "textarea")) {
                    t[i].value = '';
                }               
            }
        }
    })
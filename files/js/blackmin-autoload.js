/*
	CMS ,,Black Min''  Został stworzony przez timonix.pl
	
	ten plik służy do Automatycznego ładowania danych z serwera
	
	Black Min cms,
	
	#plik: 1.0
*/

    window.addEventListener("load", () => {
        const t = document.forms.namedItem("blackminload");
        const a = t.getAttribute("action");

        console.log("BlackMin autoload: start");
        
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

            function getValue(x) {
                let buff = {};

                for (let i = 0; i < x.length; i++) {
                    buff[x[i].name] = x[i].value;               
                }

                return buff;

            }

            function send(a, t, c, b) {
                tsr_alert("info", "Ładowanie danych", b, "html", false);
                tsr_ajax ("laduj/" + a.trim() + ".php", getValue(t), c, false, function (out) {
                    tsr_alert("success", "Dane załadowane prawidłowo!", b, "before", true, 250);
                    b.innerHTML = out ;
                    bm_autocomment();
                }, function () {
                    tsr_alert("error", "Wystąpił błąd pod czas ładowania danych", b, "html", false);
                });
            }

        }
    })
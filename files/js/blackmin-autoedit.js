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
*	ten plik służy do Automatycznych zamian form na dane do edycji  | admin panel
*/

    function bm_autoedit (scheme, data, form) {
        let schematic = scheme.split(",");

        if (schematic !== undefined) {
            if (schematic.length !== 0) {
                for (let i = 0; i < schematic.length; i++) {
                    try {
                        const inp = schematic[i].split(";");
                        if ((inp[0] === "div") || (inp[0] === "section")) {console.log(inp);
                            let out = "";
                            if (inp[1] === "datetime") {
                                if (data[0][inp[2]] === data[0][inp[3]]) {
                                    out = '<section class="tsr fs-100">Opublikowano: ' + data[0][inp[2]] + '</section>';
                                }else{
                                    out = '<section class="tsr fs-100">Edytowano Plik Dnia: ' + data[0][inp[3]] + '</section>';
                                }
                            }else if (inp[1] === "path") {
                                out = `<a href="${data[0][inp[2]]}"> ${data[0][inp[2]]} </a>`;
                            }else if (inp[1] === "img") {
                                out = `<img src="${data[0][inp[2]]}" alt="${data[0][inp[2]]}"></img>`;
                            }else{
                                out = (inp[2] !== undefined ? data[0][inp[2]] : data[0][inp[1]]);
                            }

                            form.querySelector(inp[0] + "." + inp[1]).innerHTML = (out);
                        } else {
                            form.querySelector(inp[0] + '[name="'+ inp[1] +'"]').value = (inp[2] !== undefined ? data[0][inp[2]] : data[0][inp[1]]);
                            form.querySelector(inp[0] + '[name="'+ inp[1] +'"]').removeAttribute("disabled", "disable");
                        }
                    } catch (error) {
                        tsr_alert("info", "Wystąpił błąd pod czas wprowadzania danych do aktulizacji", form, "html", false);
                    }
                }
            } else {
                tsr_alert("info", "Brak Danych Do Edycji", form, "html", false);
            }
        } else {
            tsr_alert("info", "Brak Danych Do Edycji", form, "html", false);
        }
    };
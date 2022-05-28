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

                        let cache = data[0];

                        if ((data[0].bm_name !== undefined) && ( data[0].bm_value !== undefined)) {
                            for (let j = 0; j < data["num_rows"]; j++) {
                                if (inp[2] === data[j]["bm_name"]) {
                                    cache = data[j]["bm_value"];
                                    break;
                                }
                            }
                            
                            if (inp[2] != "--d" ?? true) {
                                if ((inp[0] === "input") || (inp[0] === "textarea")) {
                                    if ((form.querySelector(inp[0] + '[name="'+ inp[1] +'"]').value.length === 0)) {
                                        form.querySelector(inp[0] + '[name="'+ inp[1] +'"]').value = cache;
                                    }
                                } else {
                                    form.querySelector(inp[0] + '[name="'+ inp[1] +'"]').value = cache;
                                }
                            }

                            form.querySelector(inp[0] + '[name="'+ inp[1] +'"]').removeAttribute("disabled", "disable");

                        } else {
                            if ((inp[0] === "div") || (inp[0] === "section")) {
                                let out = "";
                                if (inp[1] === "datetime") {
                                    if (cache[inp[2]] === cache[inp[3]]) {
                                        out = '<section class="tsr fs-100">Opublikowano: ' + cache[inp[2]] + '</section>';
                                    }else{
                                        out = '<section class="tsr fs-100">Edytowano Plik Dnia: ' + cache[inp[3]] + '</section>';
                                    }
                                }else if (inp[1] === "path") {
                                    out = `<a href="${cache[inp[2]]}"> ${cache[inp[2]]} </a>`;
                                }else if (inp[1] === "img") {
                                    out = `<img src="${cache[inp[2]]}" alt="${cache[inp[2]]}"></img>`;
                                }else{
                                    out = (inp[2] !== undefined ? cache[inp[2]] : cache[inp[1]]);
                                }
    
                                if (inp[2] == "--h" ?? false) {
                                    form.querySelector(inp[0] + "." + inp[1]).remove();
                                }else if (inp[2] == "--d" ?? false) {
                                    form.querySelector(inp[0] + '[name="'+ inp[1] +'"]').removeAttribute("disabled", "disable");
                                } else {
                                    form.querySelector(inp[0] + "." + inp[1]).innerHTML = (out);
                                }
                            } else {
                                if (inp[2] == "--h" ?? false) {
                                    form.querySelector(inp[0] + '[name="'+ inp[1] +'"]').remove();
                                }else if (inp[2] == "--d" ?? false) {
                                    form.querySelector(inp[0] + '[name="'+ inp[1] +'"]').removeAttribute("disabled", "disable");
                                } else {
                                    form.querySelector(inp[0] + '[name="'+ inp[1] +'"]').value = (inp[2] !== undefined ? cache[inp[2]] : cache[inp[1]]);
                                    form.querySelector(inp[0] + '[name="'+ inp[1] +'"]').removeAttribute("disabled", "disable");   
                                }
                            }
                        }

                    } catch (error) {
                        tsr_alert("war", "Wystąpił błąd pod czas wprowadzania danych do aktulizacji", form, "html", false);
                        console.error("BLACKMIN: ERROR. " + error);
                    }
                }
            } else {
                tsr_alert("info", "Brak Danych Do Edycji", form, "html", false);
            }
        } else {
            tsr_alert("info", "Brak Danych Do Edycji", form, "html", false);
        }
    };
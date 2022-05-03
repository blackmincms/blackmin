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

    function bm_autoedit (scheme, data, form) {
        let schematic = scheme.split(",");

        if (schematic !== undefined) {
            if (schematic.length !== 0) {
                for (let i = 0; i < schematic.length; i++) {
                    try {
                        const inp = schematic[i].split(";");
                        form.querySelector(inp[0] + '[name="'+ inp[1] +'"]').value = (inp[2] !== undefined ? data[0][inp[2]] : data[0][inp[1]]);
                        form.querySelector(inp[0] + '[name="'+ inp[1] +'"]').removeAttribute("disabled", "disable");
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
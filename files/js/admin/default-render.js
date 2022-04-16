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
*	this file is auto rendering data in table | admin panel
*/

    function defaultRender(t, p, a, q, qt, ids, m = null) {
        let parent = $(document).find(p);
        
        if (typeof t == "object" || is_json(t)) {
            if (t["num_rows"] != undefined) {
                if (t["num_rows"] != 0) {
                    let out = "";

                    let pl = "";

                    let ile = q.length;
                    for (let i = 0; i < ile; i++) {
                        
                        pl += `
                            <td class="tsr-width-${(m != null ? m : "100px")} tsr-width-100-3 tsr-display-block-3 tsr-p-5px tsr-algin-left-2" bm-data="${q[i]}">
                                ${(qt[i] != undefined ? qt[i] : q[i])}
                            </td>
                        `;

                    }

                    out += ( `
                        <table class="tsr fs-60 tsr-border-groove1-all">
                        <thead class="tsr-width-100 fs-120 tsr-border-bottom-solid-black-1">
                            <tr>
                                <th class="tsr-width-25px" bm-data="bm-r-id">
                                    <label class="checkboxs">
                                        <input type="checkbox" class="bm-pcheckbox" bm-data="${a}">
                                        <span class="checkbox "></span>
                                    </label>
                                </th>
                                <td class="tsr-width-35 tsr-width-30-5 tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-title">
                                    Nazwa
                                </td>
                                ${pl}
                            </tr>
                        </thead>
                        <tbody class="tsr-width-100 tsr-border-bottom-solid-black-1">
                    `);

                    for (i=0; i < t["num_rows"]; i++) {
                        let lt = "";
                        for (let i2 = 0; i2 < ile; i2++) {
                            
                            let odp;

                            if (q[i2] === "datetime") {
                                odp = ((t[i]["datetime"] === t[i]["datetime_change"]) ? t[i]["datetime"] : ("Edytowano: " + t[i]["datetime_change"]));
                            }else{
                                odp = ((t[i][q[i2]]).length == 0 ? "brak" : t[i][q[i2]]);
                            }

                            lt += `
                                <td class="tsr-display-block-3 tsr-p-5px tsr-word-break tsr-algin-left-2" bm-data="${q[i2]}"> ${odp} </td>
                            `;
    
                        }

                        out += ( `
                            <tr class="tsr-color-table bm-row-dl" bm-row-data="${i}">
                                <th bm-data="bm-r-id"> 
                                    <label class="checkboxs">
                                        <input type="checkbox" class="bm-checkbox" bm-data="${t[i][ids[0]]}">
                                        <span class="checkbox "></span>
                                    </label>
                                </th>
                                <td class="tsr-display-block-2 tsr-p-5px tsr-word-break tsr-algin-left" bm-data="bm-title"> ${t[i][ids[1]]}  
                                    <section class="tsr fs-80 tsr-visable-hover tsr-visibility-visable-2">
                                        <section class="fs-100 tsr-button tsr-visable-hover-element tsr-visibility-visable-2 bm-row-delete">		
                                            
                                            <span class="tsr-pmodal red" tsr-modal-close="true">
                                                Usuń
                                                <section class="tsr-modal" tsr-modal-close="true">
                                                    <section class="tsr">
                                                        <span class="tsr fs-110 tsr-border-bottom-dashed">Potwierdź akcję</span>
                                                        
                                                        <input type="button" class="col-2 fs-70 tsr-p-5px tsr-button bm-button-ac " bm-action-data="${t[i][ids[0]]}" value="Tak, usuń!" />
                                                        <section class="col-2 tsr-button tsr-error tsr-modal-closed  bm-button-delete tsr-modal-closed-button">
                                                            Anuluj!
                                                        </section>
                                                            
                                                    </section>
                                                </section>
                                            </span>

                                        </section>
                                        <section class="fs-100 tsr-button tsr-visable-hover-element tsr-visibility-visable-2 bm-row-edit">
                                            <a href="bm/admin/edit-${a}.php?edit=${t[i][ids[0]]}">
                                                Edytuj	
                                            </a>
                                        </section>
                                        <section class="fs-100 tsr-button tsr-visable-hover-element tsr-visibility-visable-2 bm-row-view">
                                            <a href="${(ids[2] != undefined ? t[i][ids[2]] : "")}">
                                                Zobacz	
                                            </a>
                                        </section>
                                    </section>
                                </td>
                                ${lt}
                            </tr>
                        `);
                    }

                    out += ( `
                        </tbody>
                        </table>
            
                        <section class="tsr tsr tsr-mt-20">
                            <input type="submit" value="Wykonaj akcję!" class="input buttom" action="media" rename="media" id="blackmin_action"/>
                        </section>
                    `);
                    
                    parent.html(out);
                } else {
                    tsr_alert("info", "BlackMin: Brak danych do wyświetlenia.", parent, "html", false);
                }
            } else {
                tsr_alert("alert", "BlackMin: Błędne dane wejśćiowe (render)", parent, "html", false);
            }
        }else{
            tsr_alert("alert", "BlackMin: Wystąpił błąd pod czas renderowania danych", parent, "html", false);
        }
    }
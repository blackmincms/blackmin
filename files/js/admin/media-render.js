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
*	this file is auto rendering data in media table | admin panel
*/

    function mediaRender(t, p, a, q, qt, ids, m = null) {
        let parent = $(document).find(p);
        
        if (typeof t == "object" || is_json(t)) {
            if (t["num_rows"] != undefined) {
                if (t["num_rows"] != 0) {
                    let out = "";

                    let pl = "";

                    let ile = q.length;
                    for (let i = 0; i < ile; i++) {
                        
                        pl += `
                            <td class="tsr-width-${(m != null ? (m[i] != undefined ? m[i] : "100px") : "100px")} tsr-width-100-3 tsr-display-block-3 tsr-p-5px tsr-algin-left-2" bm-data="${q[i]}">
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

                            if (q[i2] === "bm_datetime_upload") {
                                odp = ((t[i]["bm_datetime_upload"] === t[i]["bm_datetime_changed"]) ? dateFormat(t[i]["bm_datetime_upload"]) : ("Edytowano: " + dateFormat(t[i]["bm_datetime_changed"])));
                            }else{
                                odp = ((t[i][q[i2]]).length === 0 ? "brak" : t[i][q[i2]]);
                            }

                            lt += `
                                <td class="tsr-display-block-3 tsr-p-5px tsr-word-break tsr-algin-left-2" bm-data="${q[i2]}"> ${odp} </td>
                            `;
    
                        }

                        let imgM = "";
                        let imgMa = "";

                        if (t[i]['bm_thumbnail'] !== "null") {
                            imgM = `
                                <img src="${t[i]['bm_thumbnail']}" title="${t[i]['bm_name_orginal']}" src-orginal="${t[i]['bm_path']}" class="img tsr-miniaturka tsr-vertical-align-middle" style="max-width: 75px;" loading="lazy">
                            `;

                            imgMa = `
                                <section class="fs-100 tsr-button tsr-visable-hover-element tsr-visibility-visable-2 bm-row-view">		
                                            
                                    <span class="tsr-pmodal" tsr-modal-close="true">
                                        Zobacz
                                        <section class="tsr-modal" tsr-modal-close="true">
                                            <section class="tsr">
                                                <img src="${t[i]['bm_path']}" title="${t[i]['bm_name_orginal']}" class="img tsr-miniaturka tsr-vertical-align-middle" loading="lazy">  
                                            </section>
                                        </section>
                                    </span>

                                </section>
                            `;
                        }

                        let package = {
                                "src": t[i]['bm_thumbnail'],
                                "srcOrginal": t[i]['bm_path'],
                                "name": t[i][ids[1]],
                                "nameOrginal": t[i]['bm_name_orginal']
                            };

                        out += ( `
                            <tr class="tsr-color-table bm-row-dl" bm-row-data="${i}">
                                <th bm-data="bm-r-id"> 
                                    <label class="checkboxs">
                                        <input type="checkbox" class="bm-checkbox" bm-data="${t[i][ids[0]]}">
                                        <span class="checkbox "></span>
                                    </label>
                                </th>
                                <td class="tsr-display-block-2 tsr-p-5px tsr-word-break tsr-algin-left" bm-data="bm-title" meta="${btoa(JSON.stringify(package))}">
                                    ${imgM}
                                    ${t[i][ids[1]]} 
                                    <section class="tsr fs-80 tsr-mt-20">${t[i]['bm_name_orginal']}</section>
                                    <section class="tsr fs-80 tsr-visable-hover tsr-visibility-visable-2">
                                        <section class="fs-100 tsr-button tsr-visable-hover-element tsr-visibility-visable-2 bm-row-delete">		
                                            
                                            <span class="tsr-pmodal red" tsr-modal-close="true">
                                                Usuń
                                                <section class="tsr-modal" tsr-modal-close="true">
                                                    <span class="tsr fs-110 tsr-border-bottom-dashed">Potwierdź akcję</span>
                                                    
                                                    <section class="tsr-button tsr-success bm-button-ac tsr-float-inherit" bm-action-data="${t[i][ids[0]]}" >Tak, usuń!</section>
                                                    <section class="tsr-button tsr-error tsr-modal-closed  bm-button-delete tsr-modal-closed-button tsr-float-inherit tsr-mr-10">
                                                        Anuluj!
                                                    </section>
                                                </section>
                                            </span>
                                        </section>
                                        <section class="fs-100 tsr-button tsr-visable-hover-element tsr-visibility-visable-2 bm-row-edit">
                                            <a href="bm/admin/edit-${a}.php?edit=${t[i][ids[0]]}">
                                                Edytuj	
                                            </a>
                                        </section>
                                        ${
                                            imgMa
                                        }
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
                            <input type="submit" value="Wykonaj akcję!" class="input buttom" action="${a}" rename="${a}" id="blackmin_action"/>
                        </section>
                    `);
                    
                    parent.html(out);
                    queueMicrotask(() => {
                        tsr_checkboxall("#blackminload_container", ".bm-pcheckbox", ".bm-checkbox");
                        tsr_checkboxall(".tsr-modal-active #blackminload_container", ".bm-pcheckbox", ".bm-checkbox");
                        tsr_checkboxall2(".tsr-modal-active #blackminload_container", ".bm-pcheckbox", ".bm-checkbox");
                    })
                } else {
                    tsr_alert("info", "BlackMin: Brak danych do wyświetlenia.", parent, "html", false);
                }
            } else {
                tsr_alert("war", "BlackMin: Błędne dane wejśćiowe (render)", parent, "html", false);
            }
        }else{
            tsr_alert("error", "BlackMin: Wystąpił błąd pod czas renderowania danych", parent, "html", false);
        }
    }
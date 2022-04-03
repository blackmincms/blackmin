
    function mediaRender(t, p) {
        let parent = $(document).find(p);

        if (typeof t == "object" || is_json(t)) {
            if (t["num_rows"] != undefined) {
                if (t["num_rows"] != 0) {
                    let out = "";
                    out += ( `
                        <table class="tsr fs-60 tsr-border-groove1-all">
                        <thead class="tsr-width-100 fs-120 tsr-border-bottom-solid-black-1">
                            <tr>
                                <th class="tsr-width-25px" bm-data="bm-r-id">
                                    <label class="checkboxs">
                                        <input type="checkbox" class="bm-pcheckbox" bm-data="dysk">
                                        <span class="checkbox "></span>
                                    </label>
                                </th>
                                <td class="tsr-width-35 tsr-width-30-5 tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-title">
                                    Nazwa/Orginalna Nazwa
                                </td>
                                <td class="tsr-width-150px tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-author">
                                    Autor
                                </td>
                                <td class="tsr-width-30 tsr-width-25-5  tsr-width-100-2tsr-display-block-2 tsr-p-5px" bm-data="bm-description">
                                    Opis
                                </td>
                                <td class="tsr-width-100px tsr-width-150px-3 tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-folder">
                                    Folder
                                </td>
                                <td class="tsr-width-100px tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-file-type">
                                    Rozszerzenie
                                </td>
                                <td class="tsr-width-100px tsr-width-50px-3 tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-datetime">
                                    Data Opublikowania
                                </td>
                            </tr>
                        </thead>
                        <tbody class="tsr-width-100 tsr-border-bottom-solid-black-1">
                    `);

                    for (i=0; i < t["num_rows"]; i++) {
                        let data = (t[i]["bm_datetime_upload"] == t[i]["bm_datetime_upload"] ? t[i]["bm_datetime_upload"] : ("Edytowano: " . t[i]["bm_datetime_upload"])); 
                        let opis = ((t[i]["bm_description"]) == "" ? "brak" : t[i]["bm_description"]);
                        let miniaturka = (t[i]["bm_thumbnail"] == "null" ? "" : (`<img src="${t[i]["bm_thumbnail"]}" alt="M" title="${t[i]["bm_name"]}" width="75" height="75"  class="img tsr-miniaturka tsr-vertical-align-middle tsr-width-75px tsr-mr-10" loading="lazy">`));
                        out += ( `
                            <tr class="tsr-color-table bm-row-dl" bm-row-data="${i}">
                                <th bm-data="bm-r-id"> 
                                    <label class="checkboxs">
                                        <input type="checkbox" class="bm-checkbox" bm-data=" ${t[i]["id_file"]} ">
                                        <span class="checkbox "></span>
                                    </label>
                                </th>
                                <td class="tsr-display-block-2 tsr-p-5px tsr-word-break tsr-algin-left" bm-data="bm-title"> ${ miniaturka + t[i]["bm_name"]} 
                                <section class="tsr fs-80 tsr-mt-20">${ t[i]["bm_name_orginal"] }</section>
                                    <section class="tsr fs-80 tsr-visable-hover tsr-visibility-visable-2">
                                        <section class="fs-100 tsr-button tsr-visable-hover-element tsr-visibility-visable-2 bm-row-delete">		
                                            
                                            <span class="tsr-pmodal red" tsr-modal-close="true">
                                                Usuń
                                                <section class="tsr-modal" tsr-modal-close="true">
                                                    <section class="tsr">
                                                        <span class="tsr fs-110 tsr-border-bottom-dashed">Potwierdź akcję</span>
                                                        
                                                        <input type="button" class="col-2 fs-70 tsr-p-5px tsr-button bm-button-ac " bm-action-data="${t[i]["id_file"]}" value="Tak, usuń!" />
                                                        <section class="col-2 tsr-button tsr-error tsr-modal-closed  bm-button-delete tsr-modal-closed-button">
                                                            Anuluj!
                                                        </section>
                                                            
                                                    </section>
                                                </section>
                                            </span>
            
                                        </section>
                                        <section class="fs-100 tsr-button tsr-visable-hover-element tsr-visibility-visable-2 bm-row-edit">
                                            <a href="edit-file-data.php?edit=${t[i]["id_file"]} ">
                                                Edytuj	
                                            </a>
                                        </section>
                                    </section>
                                </td>
                                <td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-author"> ${t[i]["autor"]} </td>
                                <td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-description"> ${opis} </td>
                                <td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-folder"> ${t[i]["bm_folder"]} </td>
                                <td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-file-type"> ${t[i]["bm_file_type"]} </td>
                                <td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-category"> ${data} </td>
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
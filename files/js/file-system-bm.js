
    function fileSystemBM(parentFS = ".bm-fspbm", source = ".bm-fsbm", target = ".bm-fsbm-url",file = "*", once = false, muliply = true, view = "background") {
        console.log("fileSystemBM");
        // console.log(parentFS, source, target);
        tsr_modal(false, source, `
            <div class="bm-fsbm-container">
                <class class="tsr-alert tsr-alert-info"> Ładowanie danych z serwera! </class>
            </div>
        `, function (a,parentSource,c,d,e) {
            console.log("fileSystemBM: Ładowanie dysku zdalnego!");
            
            let parents = $(".tsr-modal-container.tsr-modal-active").find(".bm-fsbm-container");

            tsr_alert("info", "Ładowanie dysku zdalnego!", parents, "html", false);

            dataLoader("load", "Media", "filter", function (data) {
                $(parents).html(data).find("form#blackminload").attr("bm-source", source).attr("bm-target", target).attr("bm-file", file).attr("bm-once", once).attr("bm-muliply", muliply).find('select[name="roszerzenie"]').val("image");

                if (file !== "*") {
                    $(parents).find('select[name="roszerzenie"]').attr("disabled", "disabled");
                }
                
                if (once) {
                    $(parents).find('input.bm-pcheckbox').attr("disabled", "disabled");
                }

                $(parents).find('select[name="akcja"]').append(`<option value="add">Dodaj</option>`).val("add");

                $(parents)[0].childNodes[6].remove();

                bm_autoload(".tsr-modal-container.tsr-modal-active", function () {
                    if (once) {
                        $(parents).find('input.bm-pcheckbox').attr("disabled", "disabled");

                        // check click on checkbox
                        $(parents).find('span.checkbox').on("click", function () {
                            $(parents).find(".checkall").find(".bm-checkbox").not($(this).closest(".checkboxs").find('input[type="checkbox"]')).attr("checked", false).prop("checked", false);
                        });
                    } 

                    $(parents).find("#blackmin_action").on("click", function () {

                        // get all checkeds
                        let checkeds = $(parents).find(".bm-checkbox:checked");
                        let checkeds_length = $(parents).find(".bm-checkbox:checked").length;

                        // check parentFS not null
                        let targetSource = (parentFS !== null ? $(parentSource).closest(parentFS).find(target) : target);   

                        let cacheDownload = "";

                        for (let i = 0; i < checkeds_length; i++) {
                            // check if checkbox is checked
                            if ($(checkeds[i]).attr("checked") !== undefined) {
                                let meta = $(checkeds[i]).closest(".bm-row-dl").find('td[meta]').attr("meta");
                                
                                // check src and title is undefined
                                if (meta === undefined) {
                                    tsr_alert("info", "Brak danych o pliku obrazu", $(parents).find("#blackmin_action"), "before", true, 250);
                                    continue;
                                }

                                // decode meta
                                meta = JSON.parse(atob(meta));                      
                                
                                // check id target is undefined
                                if ($(target).length === 0) {
                                    tsr_alert("war", "Brak elementu docelowego!", $(parents).find("#blackmin_action"), "before", true, 500);
                                }
                                
                                // set src and title to target
                                (meta["src"] === "null" ?? $(targetSource).attr("src", meta["src"]));
                                $(targetSource).attr("src-orginal", meta["srcOrginal"]);
                                $(targetSource).attr("title", meta["name"]);
                                $(targetSource).attr("title-orginal", meta["nameOrginal"]);
                                // check view to img or background-image
                                if ((view === "background")  && (meta["src"] !== "null")) {
                                    $(targetSource).attr("src", meta["src"])
                                    $(targetSource).css("background-image", "url(" + meta["src"] + ")");
                                }
                                if ((view === "img") && (meta["src"] !== "null")) {
                                    if (once) {
                                        $(targetSource).html(`<img src="${meta["src"]}" alt="${meta["name"]}" title="${meta["name"]}" title-orginal="${meta["nameOrginal"]}" src-orginal="${meta["srcOrginal"]}" loading="lazy" src-orginal="${meta["srcOrginal"]}"  />`);
                                    } else {
                                        if (i === 0) {
                                            $(targetSource).html("");
                                        }
                                        $(targetSource).append(`<img src="${meta["src"]}" alt="${meta["name"]}" title="${meta["name"]}" title-orginal="${meta["nameOrginal"]}" src-orginal="${meta["srcOrginal"]}" loading="lazy" src-orginal="${meta["srcOrginal"]}"  />`);
                                    }
                                }
                                if ((view !== "img") && (view !== "background")) {
                                    if (i === 0) {
                                        cacheDownload += meta["srcOrginal"];
                                    } else {
                                        cacheDownload += "," + meta["srcOrginal"];
                                    }

                                }

                                if (file === "*") {
                                    $(targetSource).attr("src-orginal", cacheDownload);
                                }

                                // add succes message
                                tsr_alert("success", "Plik załadowany prawidłowo", $(parents).find("#blackmin_action"), "before", true, 150);
                            } else {
                                tsr_alert("info", "Nie wybrano żadnego obrazka", $(parents).find("#blackmin_action"), "before", true, 250);
                                break;
                            }
                        }
                    });
                    
                });
            }, false);
        });
    }

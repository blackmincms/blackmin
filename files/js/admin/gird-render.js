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
*	this file is render gird table to view preview data | admin panel
*/

    function girdRender(t, p, nameAction) {
        let parent = $(document).find(p);
        
        if (typeof t == "object" || is_json(t)) {
            let ile = t.length;
            if (ile === 0) {
                tsr_alert("info", "BlackMin: Brak danych do wyświetlenia.", parent, "html", false);
            }
            let out = "";

            out += `<div style="display: grid;
                grid-column-gap: 5px;
                grid-row-gap: 5px;" class="bm-gird-render">`;

            try {
                for (let i = 0; i < ile; i++) {
                    const element = t[i];

                    let name = element["name"];
                    let miniaturs = propertySearch( element["children"], "thumbnail");
                    let package = propertySearch( element["children"], "package");

                    if (!miniaturs) {
                        tsr_alert("alert", "BlackMin: Wystąpił w pobieraniu miniaturki! - " + name, parent, "append", true);
                    }
                    if (!package) {
                        tsr_alert("alert", "BlackMin: Wystąpił w pobieraniu ustawień! - " + name, parent, "append", true);
                    }

                    let deactivate = "";

                    if ((element["active"] !== undefined) && (nameAction !== "theme")) {

                        deactivate = `
                            <section class="tsr-fr tsr-button tsr-success tsr-mr-10 tsr-visable-hover-element">
                                <span class="tsr-pmodal">
                                    DezAktywuj
                                    <section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="true" tsr-modal-max="false">
                                        <section class="tsr-fr tsr-button tsr-success tsr-visable-hover-element tsr-float-inherit deactivate-post" bm-name="${name}">
                                            <span>DezAktywuj</span>
                                        </section>
                                        <section class="tsr-fr tsr-button tsr-error tsr-mr-10 tsr-float-inherit tsr-modal-closed-button">
                                            <span>Anuluj</span>
                                        </section>
                                    </section>
                                </span>	
                            </section>
                        `;
                    }

                    out += (`
                        <div class="gird-chilld background-gray" bm-id-gird="${i}" bm-mod-name="${name}" bm-mod-pack="${package}" bm-mod-mini="${miniaturs}">
                            <a class="img-efect-normalize2 tsr-pmodal">
                                <img src="${miniaturs}" title="${name}" alt="Miniaturka" class="img tsr-miniaturka tsr-vertical-align-middle" style="width: 100%;height: 200px;object-fit: fill;" loading="lazy" />
                                <section class="img-efect-normalize-subtitle2">
                                    Zobacz
                                </section>
                                <!-- modal box z informacjami o motywie -->
                                <section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false" tsr-modal-max="true">
                                    <section class="tsr">
                                        <section class="fs-90 tsr tsr-mt-20 tsr-mb-20 tsr-overflow-hidden tsr-cut-string">Motyw ${name}</section>
                                        
                                        <section class="tsr bm-package tsr-mt-20 tsr-algin-left tsr tsr-pr-25px tsr-width-50  tsr-width-100-4">
                                            <section class="tsr fs-70">
                                                <section class="col-inp-25">
                                                    Pełny Tytuł Motywu:
                                                </section>
                                                <section class="col-inp-75 name">
                                                    Brak.
                                                </section>
                                            </section>
                                            <section class="tsr fs-70">
                                                <section class="col-inp-25">
                                                    Autor Mowywu:
                                                </section>
                                                <section class="col-inp-75 author">
                                                    Brak.
                                                </section>
                                            </section>
                                            <section class="tsr fs-70">
                                                <section class="col-inp-25">
                                                    Opis Motywu:
                                                </section>
                                                <section class="col-inp-75 description">
                                                    Brak.
                                                </section>
                                            </section>					
                                            <section class="tsr fs-70">
                                                <section class="col-inp-25">
                                                    Data Stworzenia Motywu:
                                                </section>
                                                <section class="col-inp-75 data_created">
                                                    Brak.
                                                </section>
                                            </section>
                                            <!--<section class="tsr fs-70">
                                                <section class="col-inp-25">
                                                    Strona Motywu Black Min:
                                                </section>
                                                <section class="col-inp-75">
                                                    <span href="" class="tsr-click-link link">
                                                            Brak.
                                                    </span>
                                                </section>
                                            </section>-->
                                            <section class="tsr fs-70">
                                                <section class="col-inp-25">
                                                    Wersja Motywu:
                                                </section>
                                                <section class="col-inp-75 version">
                                                    Brak.
                                                </section>
                                            </section>
                                            <section class="tsr fs-70">
                                                <section class="col-inp-25">
                                                    Strona Autora Motywu:
                                                </section>
                                                <section class="col-inp-75">
                                                    <span href="" class="tsr-click-link cursor-pointer link author_website">
                                                        Brak.
                                                    </span>
                                                </section>
                                            </section>										
                                            <section class="tsr fs-70">
                                                <section class="col-inp-25">
                                                    Ścieżka Pliku:
                                                </section>
                                                <section class="tsr-inp-75">
                                                    <span href="" class="tsr-click-link cursor-pointer link path">
                                                        Brak.
                                                    </span>	
                                                </section>
                                            </section>
                                        </section>

                                        <img src="${miniaturs}" title="${name}" alt="miniaturka" class="img tsr-mt-20  tsr-width-50  tsr-width-100-4" loading="lazy">
                                        <section class="tsr r-0 fs-100 tsr-visable-hover">
                                            <section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
                                                <span class="tsr-pmodal">
                                                    Zobacz Motyw
                                                    <section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false" tsr-modal-max="true">
                                                        <img src="${miniaturs}" title="${name}" alt="Miniaturka" class="img2 " loading="lazy"/>
                                                    </section>
                                                </span>	
                                            </section>

                                            ${
                                                (element["active"] !== undefined ? "" : `
                                                    <section class="tsr-fr tsr-button tsr-error tsr-mr-10 tsr-visable-hover-element">
                                                        <span class="tsr-pmodal">
                                                             Usuń
                                                            <section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="true" tsr-modal-max="false">
                                                                <section class="tsr-fr tsr-button tsr-success tsr-visable-hover-element tsr-float-inherit del-post" bm-name="${name}">
                                                                    <span>Wykonaj</span>
                                                                </section>
                                                                <section class="tsr-fr tsr-button tsr-error tsr-mr-10 tsr-float-inherit tsr-modal-closed-button">
                                                                    <span>Anuluj</span>
                                                                </section>
                                                            </section>
                                                        </span>	
                                                    </section>
                                                `)
                                            }
                                            
                                            ${
                                                (element["active"] !== undefined ? "" : `
                                                    <section class="tsr-fr tsr-button tsr-success tsr-mr-10 tsr-visable-hover-element">
                                                        <span class="tsr-pmodal">
                                                            Aktywuj
                                                            <section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="true" tsr-modal-max="false">
                                                                <section class="tsr-fr tsr-button tsr-success tsr-visable-hover-element tsr-float-inherit activate-post" bm-name="${name}">
                                                                    <span>Aktywuj</span>
                                                                </section>
                                                                <section class="tsr-fr tsr-button tsr-error tsr-mr-10 tsr-float-inherit tsr-modal-closed-button">
                                                                    <span>Anuluj</span>
                                                                </section>
                                                            </section>
                                                        </span>	
                                                    </section>
                                                `)
                                            }
                                            
                                            ${
                                                deactivate
                                            }

                                        </section>
                                        
                                    </section>
                                </section>
                            </a>
                            <section class="fs-70 tsr-cut-string ${(element["active"] === undefined ? "background-green tsr-pb-15px tsr-pt-20px" : "background-dark-red tsr-pt-5px tsr-pb-5px")} tsr-p-10px tsr-algin-left">
                                ${
                                    (element["active"] === undefined ? "" : `
                                        <section class="tsr-button tsr-normal">
                                                Aktywny
                                        </section>
                                    `)
                                }
                                    ${name}
                                </section>
                            </section>
                        </div>
                    `);
                }
            } catch (error) {
                tsr_alert("alert", "BlackMin: Wystąpił nie znany błąd", parent, "html", false);
            }

            out += `</div>`;

            parent.html(out);
        }else{
            tsr_alert("alert", "BlackMin: Wystąpił błąd pod czas renderowania danych", parent, "html", false);
        }
    };

    // Funkcja wywoływana przy wybraniu motywu | eng: function called when theme is selected
    queueMicrotask(() => {
        getPackage();
    });

    // this function is search data in property
    function propertySearch(array, property) {
        let ile = array.length;
        let id = null;
        for (let i = 0; i < ile; i++) {
            if ((array[i]["name"]).split(".")[0] === property) {
                id = i;
                break;
            }
        }

        if (id === null) {
            return false;
        }

        return (array[id]["path"]).slice(9);
    }

    // click to button
    $(document).on("click", ".activate-post", function () {
        const name = $(this).attr("bm-name");
        // send data to server
        sendData(name, "activation");
    });

    // click to button with del-post class
    $(document).on("click", ".del-post", function () {
        const name = $(this).attr("bm-name");
        // send data to server
        sendData(name, "del");
    });

    // click to button with deactivate-post class
    $(document).on("click", ".deactivate-post", function () {
        const name = $(this).attr("bm-name");
        // send data to server
        sendData(name, "deactivation");
    });

    // crate function send data to server
    function sendData(data, action) {
        const parent = $(document).find(".tsr-modal-container.tsr-modal-active").find(".tsra");

        let url = $("#blackminload_execute_container #blackminload").attr("action");

        let out = {
            "bm_content": JSON.stringify({
            "action": action,
            "url": url,
            "params":{
                "data": data
            }
        })};

        // get the parnet node
        const parentNode = $(document).find("div[bm-mod-name='" + data + "']");

        tsr_ajax("bm/core/Delegate/DelegateBM.php", out, "", false, (data) => {
            data = JSON.parse(data);
            tsr_alert(data["status"], "BlackMin: " + data["message"], parent, "append", true);
            // add class tsr-orange to parent
            parentNode.find("section").css("background-color", "orange");
            if (action === "del" && data["status"] === "success") {
                // change img color to red
                parentNode.find("img").css("filter", "grayscale(1)");
                setTimeout(() => {
                    // add class background-red and remove background-orange to parent
                    parentNode.find("section").css("background-color", "red");
                    setTimeout(() => {
                        parentNode.remove();   
                    }, 1500);
                }, 500);
            }

        }, (error) => {
            tsr_alert(error["status"], "BlackMin: Wystąpił błąd podczas łączenia z serwerem", parent, "append", true);
        });
    }

    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("blackminload").style.top = "50px";
        } else {
            document.getElementById("blackminload").style.top = "-50px";
        }
        prevScrollpos = currentScrollPos;
    }

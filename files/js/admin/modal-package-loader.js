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
*	this file is load package (theme | plugin) | admin panel
*/

    function getPackage() {  
        var getUrl = window.location;
        var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/";
        
        // get all click action in moduls
        $(document).on("click", "a.tsr-pmodal", function (oEvent) {
            const Tparent = $(this).closest(".gird-chilld");
            let name = Tparent.attr("bm-mod-name");
            let url = Tparent.attr("bm-mod-pack");
            let miniatu = Tparent.attr("bm-mod-mini");

            let parent = $(".tsr-modal-container.tsr-modal-active").find(".tsra .bm-package");

            // add to parent info for load data
            tsr_alert("info", "BM load data: Ładowanie danych!", parent, "append", true, 1500);

            // get package data with feth
            let Request = FetchPostData(url, data = {}, (error) => {
                tsr_alert("error", "BM load data: Wystąpił błąd pod czas pobieranie danych z serwera!", parent, "append", true, 5000);
            });

            Request.then(data => {
                if (data !== false) {
                    // add to parent success info for load data
                    tsr_alert("success", "BM load data: Ładowanie danych zakończone!", parent, "append", true, 1500);

                    const nameF = (data["name"] !== undefined ? data["name"] : "Brak.");
                    const description = (data["description"] !== undefined ? data["description"] : "Brak.");
                    const author = (data["authors"] !== undefined ? data["authors"] : "Brak.");
                    const version = (data["version"] !== undefined ? data["version"] : "Brak.");
                    const date_created = (data["date_created"] !== undefined ? data["date_created"] : "Brak.");
                    const authors_website = (data["authors_website"] !== undefined ? data["authors_website"] : "Brak.");

                    parent.find(".name").html(nameF);
                    parent.find(".description").html(description);
                    parent.find(".author").html(author);
                    parent.find(".version").html(version);
                    parent.find(".path").html(baseUrl + url.slice(0,-12));
                    parent.find(".path").attr("href" ,baseUrl + url.slice(0,-12));
                    parent.find(".data_created").html(date_created);
                    parent.find(".author_website").html(authors_website);
                    parent.find(".author_website").attr("href" ,authors_website);
                }
            })
        });
    };

    // Example POST method implementation:
    async function FetchPostData(url = '', data = {}, errorCalBack) {
        try {

            const request = new Request(url);
            // Default options are marked with *
            const response = await fetch(request, {
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                mode: 'cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: 'same-origin', // include, *same-origin, omit
                headers: {
                'Content-Type': 'application/json'
                // 'Content-Type': 'application/x-www-form-urlencoded',
                },
                redirect: 'follow', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: ((is_json(data) === false && data.lenght >= 3) ?? JSON.stringify(data)) // body data type must match "Content-Type" header
            });

            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                return false;
            }

            if (response.ok === true && ((response.status >= 200) && (response.status <= 299)) && response.headers.get('content-type') && response.headers.get('content-type').includes('application/json')) {
                return await response.json(); // parses JSON response into native JavaScript objects  
            }
        } catch (error) {
            console.error("BM Fetch: " + error);
            errorCalBack(error);
            return false;
        }
    }

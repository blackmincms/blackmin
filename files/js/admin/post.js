
    function post() {
        // start loading post data

        // if window loaded
        window.addEventListener('load', function () {
            var parent = $('#blackminload_execute_container');
            // if parent not found
            if (parent === undefined || parent === null || parent.length === 0) {
                console.error('BMLoader: blackminload_execute_container not found');
                return false;
            }
            renderTag(parent);
            renderCategory();
            
            // quesemicrotask
            this.queueMicrotask(function () {
                setMiniatureWithDB();
            });

            document.querySelector('select[name="status"]').addEventListener("change", function (t) {
                if (this.value === "protect_password") {
                    document.getElementById("protect_password").style.display = "block";
                    return;
                }
                document.getElementById("protect_password").style.display = "none";
                return;
            })
        });
    }

    function renderTag (parent) {
        // render tag
        let tag = dataLoader("get", "Categorytag", {"KT":"tag","ile_load":"20","szukaj":""}, function(data) {

            let tag = [];

            for (let index = 0; index < data["num_rows"]; index++) {
                tag.push(data[index]["bm_name"]);
            }
            queueMicrotask(() => {
                $('input[name="tag"]').timonixSuggestags({
                    type : 'timonix_styles_rezult',
                    suggestions: tag});
            });
        }, false);
        
        if (tag === false) {
            tsr_alert("error", "Wystąpił błąd podczas ładowania danych", parent, "before", true);
        }        
    }

    function renderCategory() {
        // render category
        let categorys = dataLoader("get", "Categorytag", {"KT":"category","ile_load":"20","szukaj":""}, function(data) {

            let select = document.querySelector('select[name="category"]');

            // check is row not empty
            if (data["num_rows"] === 0) {
                // add 
                return false;
            }

            for (let index = 0; index < data["num_rows"]; index++) {              
                let option = document.createElement('option');
                option.value = data[index]["bm_name"];
                option.innerHTML = data[index]["bm_name"];  
                select.appendChild(option);
            }

            if (select.hasAttribute("value")) {
                select.value = select.getAttribute("value");
            }
        }, false);
        
        if (categorys === false) {
            tsr_alert("error", "Wystąpił błąd podczas ładowania danych", parent, "before", true);
        }     
    }

    function setMiniatureWithDB() {
        // get miniature
        fileSystemBM(null ,".bm-fsbm", ".bm-fsbm-url", "image", true, false);
    }
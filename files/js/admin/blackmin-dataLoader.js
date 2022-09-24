

    function dataLoader(action, url, data, callback, message = true, infoType = "before", hide = true) {
        // gte parent (blackminload_execute_container)
        var parent = $('#blackminload_execute_container');

        if (parent === undefined || parent === null || parent.length === 0) {
            console.error('BMLoader: blackminload_execute_container not found');
            return false;
        }

        if (message) {
            tsr_alert("info", "Ładowanie danych", parent, infoType, hide);
        }

        let dataSource = {"bm_content": JSON.stringify({"action": action, "url": url, "params": data})};

        tsr_ajax ("bm/core/Delegate/DelegateBM.php", dataSource, "", false, function (out) {
            
            if (message) {
                tsr_alert("success", "Dane załadowane prawidłowo!", parent, "before", hide, 250);
            }

            let type = typeof out;
            let isJson = is_json(out);

            let dataServer = out;

            if (type === "object" || isJson) {
                dataServer = JSON.parse(out);
                if (dataServer["num_rows"] === 0) {
                    if (message) {
                        tsr_alert("info", "Brak Danych Do Załadowania", parent, infoType, hide);
                    }
                } else if (dataServer["status"] !== undefined) {
                    if (message) {
                        tsr_alert(dataServer["status"], dataServer["message"], parent, infoType, hide);
                    }
                }
            }
            callback(dataServer);

            return true;
        }, function (info) {
            if (message) {
                tsr_alert("error", "Wystąpił błąd pod czas ładowania danych", parent, "before", hide);
            }
            return false;
        });

        return true;
    }
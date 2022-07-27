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
*	this file is auto rendering data in widget table | admin panel
*/

    function adminWidget(data, parent, b) {
        // clerar parent
        $(parent).empty();

        parent = $(document).find("#blackminload");

        // const find r3 class
        let sortbox = $(parent).find(".r3");
        // const find r4 class
        let sortbox2 = $(parent).find(".r4");
        // const find r5 class
        let sortbox3 = $(parent).find(".r5");
        // const find r6 class
        let sortbox4 = $(parent).find(".r6");
        // const find r7 class
        let sortbox5 = $(parent).find(".r7");


        // check data not empty
        if (!checkWidgetData(data, "bm_bottom_widget") && !checkWidgetData(data, "bm_footer_widget") && !checkWidgetData(data, "bm_left_widget") && !checkWidgetData(data, "bm_right_widget") && !checkWidgetData(data, "bm_top_widget")) {
            tsr_alert("error", "Wystąpił Bład pod czas renderowania danych!", parent, "append", true);
        } else {
            // add data to table
            addWidgetData(data["bm_bottom_widget"], sortbox4);
            addWidgetData(data["bm_footer_widget"], sortbox5);
            addWidgetData(data["bm_left_widget"], sortbox2);
            addWidgetData(data["bm_right_widget"], sortbox3);
            addWidgetData(data["bm_top_widget"], sortbox);
        }

        // instalize sortable and draggable for data Widget
        tsr_sortiner("tsr-data",".r1, .r2",".tsr-sortiner",".tsr-sortitem",1,".tsr-sortbox4", true, 50);
        tsr_sortiner("tsr-data",".r3, .r4, .r5, .r6, .r7",".tsr-sortiner",".tsr-sortitem",1,".tsr-sortbox4", false, 50);
        

        // instalize sortable and draggable for data Widget

		
        // usuwanie elementów po podwójnym kliknięciu na nazwę bloku
        $(document).on("dblclick", ".tsr-remove, .tsr-sortiner", function(oEvent){
            oEvent.preventDefault();
            $(this).closest(".tsr-sortiner").remove();

        });

        // document.querySelector("#blackmin_action").addEventListener("click", function(oEvent){
            

        $('#blackmin_action').click('click', function(evt1){
            evt1.preventDefault();

            // get data to save
            let form = {
                bm_top_widget:JSON.stringify(tsr_index(".r3", ".tsr-sortiner", "title", ".tsr-sortitem", ".tsr-sort-handle")),
                bm_left_widget:JSON.stringify(tsr_index(".r4", ".tsr-sortiner", "title", ".tsr-sortitem", ".tsr-sort-handle")),
                bm_right_widget:JSON.stringify(tsr_index(".r5", ".tsr-sortiner", "title", ".tsr-sortitem", ".tsr-sort-handle")),
                bm_bottom_widget:JSON.stringify(tsr_index(".r6", ".tsr-sortiner", "title", ".tsr-sortitem", ".tsr-sort-handle")),
                bm_footer_widget:JSON.stringify(tsr_index(".r7", ".tsr-sortiner", "title", ".tsr-sortitem", ".tsr-sort-handle")),
                bm_top_widget2:JSON.stringify(tsr_index(".r3", ".tsr-sortiner", "tsr-data", ".tsr-sortitem", ".tsr-sort-handle", "text")),
                bm_left_widget2:JSON.stringify(tsr_index(".r4", ".tsr-sortiner", "tsr-data", ".tsr-sortitem", ".tsr-sort-handle", "text")),
                bm_right_widget2:JSON.stringify(tsr_index(".r5", ".tsr-sortiner", "tsr-data", ".tsr-sortitem", ".tsr-sort-handle", "text")),
                bm_bottom_widget2:JSON.stringify(tsr_index(".r6", ".tsr-sortiner", "tsr-data", ".tsr-sortitem", ".tsr-sort-handle", "text")),
                bm_footer_widget2:JSON.stringify(tsr_index(".r7", ".tsr-sortiner", "tsr-data", ".tsr-sortitem", ".tsr-sort-handle", "text")),
            }

            // const data = {};
            let data = {"bm_content": JSON.stringify({"action": "update", "url": "Widget", "param": form})};
            
            $.ajax({
                type:"POST",
                url:"bm/core/Delegate/DelegateBM.php",
                data: data
            })
            .done(function(info){
                info = JSON.parse(info);

                if (info["status"] == "success") {
                    tsr_alert("success", "Zapisano zmiany!", parent, "append", true);
                } else {
                    tsr_alert(info["status"], info["message"], parent, "append", true);
                }
            })
            .fail(function(){
                alert("Wystąpił błąd. Spróbuj ponownie później");
            });
        })    

    }

    // this function is foreach data and add to table
    function addWidgetData(data, parent) {
        try {
                if (data.length === 0) {
                    console.log("Widget: " + data + " is empty");
                } else {
                const appendChild = $(parent);
                data.forEach(function (element, index, array) {
                    appendChild.append(`<div class="tsr-sortiner" tsr-index="${index}" tsr-data="${element["name"]}"><div class="tsr-sort-handle cursor-all-scrol">${element["name_full"]}</div><section class="tsr-sort-item-button cursor-pointer tsr-remove">x</section></div>`)
                });
            }
        } catch (error) {
            console.log(error);
        }
    }

    // this function is check data 
    function checkWidgetData(data, name) {
        if (data[name] != undefined) {
            return true;
        } else {
            return false;
        }
    }
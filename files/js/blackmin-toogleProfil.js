

    window.addEventListener("load", async () => {
        const check_parent = document.querySelector("#blackminload_execute_container");

        if (check_parent) {
            document.querySelector("#edit_date").addEventListener("click", () => {
                let toogle_class = document.querySelectorAll(".bm-toogle-edit");

                for (let i = 0; i < toogle_class.length; i++) {
                    if (toogle_class[i].classList.toggle("tsr-display-none")) {

                    }
                }
            });
        }
    });
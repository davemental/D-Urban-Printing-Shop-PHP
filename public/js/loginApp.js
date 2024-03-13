"use strict";

/** IMPORT MODULES */
import {
    showAlert,
    ajax
} from "./utils.js";

const btnLogin = document.querySelector('[data-login_btn]');
btnLogin?.addEventListener("click", (ev) => {
    ev.preventDefault();

    const { username, password } = document.querySelector(".login-container form");

    let errMsg = [];

    if (username.value.trim() === "") {
        errMsg.push("Username is required");
    } 

    if (password.value.trim() === "") {
        errMsg.push("Password is required");
    }

    if (errMsg.length > 0) { 
        showAlert("Invalid Feilds", errMsg.map(item => '• '+ item).join('<br>'));
    } else {

        const formData = new FormData();
        
        formData.append('username', username.value.trim());
        formData.append('password', password.value.trim());

        ajax({
            url: "account-login-request",
            headers: {
                body: formData,
                method: "POST",
            },
            success(data) {
                alertify.set("notifier", "position", "top-right");
                if (data?.error) {
                    alertify.error(data.error);
                } else if (data?.success) {
                    alertify.success(data.success);

                    setTimeout(() => window.open("./admin", "_self"), 2000);
                }
            },
            error(err) {
                console.log(err);
                alertify.set("notifier", "position", "top-right");
                alertify.error(`Upload failed, <br>${err.message}`);
            }
        });
    }
})
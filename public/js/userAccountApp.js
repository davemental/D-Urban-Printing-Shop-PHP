"use strict";

/** IMPORT MODULES */
import {
    showAlert,
    removeSpecials,
    ajax,
    isUserNameValid
} from "./utils.js";

const btnSave = document.querySelector("[data-save]");
btnSave?.addEventListener("click", ev => {
    ev.preventDefault();
    handleSaveAccount();
})

function handleSaveAccount() {

    const form = document.querySelector(".user-account form");
    const { id, username, name, email, password, retype_password } = form;

    let errMsg = [];

    if (username.value.trim() === "") {
        errMsg.push("Username is required");
    } 

    if (!isUserNameValid(username.value.trim())) { 
        errMsg.push("Invalid username. Username can only be letters, numbers, underscore, and period.")
    }

    if (name.value.trim() === "") {
        errMsg.push("Name is required");
    }

    if (email.type === "email") {
        const re = /\S+@\S+\.\S+/;
        if (!re.test(email.value)) {
            errMsg.push(`Input email is invalid`);
        }
    }

    if (password.value.trim() === "") {
        errMsg.push("Password is required");
    }

    if (password.value != retype_password.value) {
        errMsg.push("The retype password dont match");
    }

    if (errMsg.length > 0) { 
        showAlert("Invalid Feilds", errMsg.map(item => '• '+ item).join('<br>'));
    } else {

        const formData = new FormData();
        
        formData.append('username', username.value.replace(/\s/g, ""));
        formData.append('name', removeSpecials(name.value));
        formData.append('email', email.value);
        formData.append('password', password.value);
        formData.append('id', id.value);

        ajax({
            url: "update-user-account",
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
                    username.focus();
                }
            },
            error(err) {
                console.log(err);
                alertify.set("notifier", "position", "top-right");
                alertify.error(`Upload failed, <br>${err.message}`);
            }
        });
    }

}



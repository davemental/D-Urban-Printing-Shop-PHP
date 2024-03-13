"use strict";

/** IMPORT MODULES */
import {
    showAlert,
    strip_tags,
    ajax,
    isUserNameValid,
    humanReadableTime
} from "./utils.js";


const overlay = document.createElement("div");
overlay.classList.add("overlay", "modal-overlay");

const registerModal = () => {

    const modal = document.createElement('div');
    modal.classList.add('modal');
    modal.innerHTML = /*html*/`
        <div class="modal-content">
            <div class="modal-header">
                <button data-modal_close_btn>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                        <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
                    </svg>
                </button>
            </div>

            <div class="create-account">
                <div>
                    <span class="text-title-m">Register New Account</span>
                </div>

                <form>
                    <div>
                        <label for="username">User Name</label>
                        <input type="text" name="username" placeholder="Your unique user name" value="" />
                    </div>

                    <div>
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="Your name" value="" />
                    </div>
                
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="youremail@gamil.com" value="" />
                    </div>

                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="your password" value="" />
                    </div>

                    <div>
                        <label for="retype_password">Re-Type Password</label>
                        <input type="password" name="retype_password" placeholder="re-type your password" value="" />
                    </div>

                    <div class="button-control">
                        <button class="secondary-btn center" data-save>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                <path d="M720-400v-120H600v-80h120v-120h80v120h120v80H800v120h-80Zm-360-80q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm80-80h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0-80Zm0 400Z"/>
                            </svg>
                            <span>Create New</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>`;

    const show = () => {
        document.body.appendChild(overlay);
        document.body.appendChild(modal);
    }

    const close = () => { 
        document.body.removeChild(overlay);
        document.body.removeChild(modal);
        setTimeout(()=> window.location.reload(), 300);
    }

    /**close modal */
    modal.querySelector('[data-modal_close_btn]').addEventListener("click", close);

    const btnSave = modal.querySelector('[data-save]');
    btnSave?.addEventListener("click", (ev) => {
        ev.preventDefault();

        const form = modal.querySelector(".create-account form");
        const { username, name, email, password, retype_password } = form;
    
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
            formData.append('name', strip_tags(name.value));
            formData.append('email', email.value);
            formData.append('password', password.value);
    
            ajax({
                url: "create-new-user-account",
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
                        form.reset();
                        btnSave.disabled = true;
                    }
                },
                error(err) {
                    console.log(err);
                    alertify.set("notifier", "position", "top-right");
                    alertify.error(`Upload failed, <br>${err.message}`);
                }
            });
        }
    });

    return {show, close}
}

const btnNewAccount = document.querySelector('[data-new_account_btn]');
btnNewAccount?.addEventListener('click', () => {
    const {show} = registerModal();
    show();
});


/** format date in user list */
window.onload = () => {
    const $date_entries = document.querySelectorAll('[data-date_entry]');
    $date_entries?.forEach(entry => entry.innerHTML = humanReadableTime(entry.getAttribute('data-date_entry')))
}
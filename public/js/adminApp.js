"option strict";

import {
    changeActiveStatusOfMainNav
} from "./utils.js";


/** change main navigation background color when current */
window.onload = () => {
    changeActiveStatusOfMainNav();
    alertNotificationWhenQuoteReceived();
};

/** LOGOUT BTN */
const btnLogout = document.querySelector('[data-logout_btn]');
btnLogout?.addEventListener("click", (ev) => {
    ev.preventDefault();

    alertify.set("notifier", "position", "top-right");

    alertify.confirm('Logout', 'Are you sure you want to logout?',
        function () {
            alertify.success('Logout successful, you will be redirected to home page in few moments')

            setTimeout(()=> window.open("./admin-logout", "_self"), 2000);
        }
        , function () {
            alertify.error('Canceled')
        }).set('labels', { ok: 'Yes', cancel: 'No' }); 
    
})


function alertNotificationWhenQuoteReceived() { 

    setInterval(() => {

        const url = window.location.href;
        let endPoint = "listen-request-received";

        if (url.includes("edit-product") || url.includes("request-details")) {
            endPoint = "../listen-request-received"
        }

        fetch(endPoint, {
            method: "POST",
        }).then(res => res.json())
            .then(res => {
                
                const receivedStatus = document.querySelector(".received-status");
                receivedStatus.textContent = res === undefined ? 0 : parseInt(res);
                
            }).catch(err => console.error(err));
    }, 2000);
}
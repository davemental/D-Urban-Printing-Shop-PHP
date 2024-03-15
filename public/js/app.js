"use strict";

/** IMPORT MODULES */
import {
    scrollFunction,
    removeSpecials,
    ajax,
    showAlert,
    debounce,
} from "./utils.js";

window.onscroll = () => scrollFunction();

const submitContactBtn = document.querySelector("[data-submit_btn]");
const sendInquiryBtn = document.querySelector("[data-send_inquiry]");
const searchInput = document.querySelector("[data-search_input]");

/** add click event in submit button */
submitContactBtn?.addEventListener("click", (ev) => {
    ev.preventDefault();
    handleSubmitContact();
});

/** handle click event in button - send inquiry in get quote page */
sendInquiryBtn?.addEventListener("click", (ev) => {
    ev.preventDefault();
    handleSendInquirySubmit();
});

/** product search using debounce */
searchInput?.addEventListener(
    "keyup",
    debounce((ev) => {
        const searchResultCon = document.querySelector("[data-search_results]");
        const searchResultItemCon = document.querySelector(
            "[data-search_results_item]"
        );
        const form = document.querySelector("[data-search_form]");
        const { search_key } = form;

        if (search_key.value.trim() == "") {
            searchResultCon?.classList.remove("show");
        } else {
            const formData = new FormData();
            formData.append("search_key", removeSpecials(search_key.value));

            ajax({
                url: "request-product-search",
                headers: {
                    body: formData,
                    method: "POST",
                },
                success(data) {
                    // remove all exist DOM child
                    while (searchResultItemCon?.firstChild) {
                        searchResultItemCon?.firstChild.remove();
                    }

                    searchResultCon?.classList.add("show");

                    if (data.length > 0) {
                        data.forEach((item) => {
                            let itemRes = document.createElement("a");
                            itemRes.classList.add("result-item");
                            itemRes.setAttribute(
                                "href",
                                `./product-item?id=${item.id}`
                            );
                            itemRes.innerHTML = `${item.title}`;
                            searchResultItemCon?.appendChild(itemRes);
                        });
                    } else {
                        let itemRes = document.createElement("p");
                        itemRes.classList.add("result-item");
                        itemRes.innerHTML = `Not found`;
                        searchResultItemCon?.appendChild(itemRes);
                    }
                },
                error(err) {
                    console.log(err);
                },
            });
        }
    }, 400)
); /** 500ms delay after stop typing */

searchInput?.addEventListener("keyup", (ev) => {
    if (ev.key === "Escape") {
        document
            .querySelector("[data-search_results]")
            ?.classList.remove("show");
        ev.target.value = "";
    }
});

function handleSendInquirySubmit() {
    const form = document.querySelector("[data-send_inquiry_form]");
    const {
        name,
        email,
        contact_number,
        company,
        address,
        product,
        quantity,
        details,
        file_upload,
    } = form;
    const sizeLimit = 3_000_000; // 3mb
    let errMsg = [];

    if (name.value.trim() === "") {
        errMsg.push("Name is required");
    }
    if (email.type === "email") {
        const re = /\S+@\S+\.\S+/;
        if (!re.test(email.value)) {
            errMsg.push(`Input email is invalid`);
        }
    }
    if (contact_number.value.trim() === "") {
        errMsg.push("Contact number is required");
    }
    if (address.value.trim() === "") {
        errMsg.push("Address is required");
    }
    if (product.value.trim() === "") {
        errMsg.push("Selected Product is required");
    }
    if (parseInt(quantity.value) == 0 || quantity.value.trim() === "") {
        errMsg.push("Estimated order quantity is required");
    }
    if (details.value.trim() === "") {
        errMsg.push("Your inquiry message/details is required");
    }
    if (file_upload.files.length > 0) {
        if (file_upload.files[0].size > sizeLimit) {
            errMsg.push("File size limit is 3MB");
        }
    }

    if (errMsg.length > 0) {
        showAlert(
            "Invalid Fields:",
            errMsg.map((item) => "<p>• " + item).join("</p>")
        );
    } else {
        const formData = new FormData();

        formData.append("name", removeSpecials(name.value));
        formData.append("email", email.value);
        formData.append("contact_number", removeSpecials(contact_number.value));
        formData.append("company", removeSpecials(company.value));
        formData.append("address", removeSpecials(address.value));
        formData.append("product", product.value);
        formData.append("quantity", quantity.value);
        formData.append("details", removeSpecials(details.value));
        formData.append("file_upload[]", file_upload.files[0]);

        ajax({
            url: "submit-inquiry-form",
            headers: {
                body: formData,
                method: "POST",
            },
            success(data) {
                if (data?.error) {
                    alertify
                        .alert(
                            `
                    <div class="error-message">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                            <path d="m40-120 440-760 440 760H40Zm138-80h604L480-720 178-200Zm302-40q17 0 28.5-11.5T520-280q0-17-11.5-28.5T480-320q-17 0-28.5 11.5T440-280q0 17 11.5 28.5T480-240Zm-40-120h80v-200h-80v200Zm40-100Z"/>
                        </svg>
                        <p>${data.error}</p>
                    </div>`
                        )
                        .set("basic", true);
                } else if (data?.success) {
                    alertify
                        .alert(
                            `
                        <div class="success-message">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                    viewBox="0 0 50 50" xml:space="preserve">
                                <circle style="fill:#25AE88;" cx="25" cy="25" r="25"/>
                                <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="
                                    38,15 22,33 12,25 "/>
                            </svg>
                            <p>${data.success}</p>
                        </div>`
                        )
                        .set("basic", true);

                    form.reset();
                    sendInquiryBtn.disabled = true;
                }
            },
            error(err) {
                console.log(err);
                alertify
                    .alert(
                        `
                <div class="error-message">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                        <path d="m40-120 440-760 440 760H40Zm138-80h604L480-720 178-200Zm302-40q17 0 28.5-11.5T520-280q0-17-11.5-28.5T480-320q-17 0-28.5 11.5T440-280q0 17 11.5 28.5T480-240Zm-40-120h80v-200h-80v200Zm40-100Z"/>
                    </svg>
                    <p>Some problems encountered while sending your request. Please try again later</p>
                </div>`
                    )
                    .set("basic", true);
            },
        });
    }
}

/**use to handle the submission of the contact form */
function handleSubmitContact() {
    const form = document.querySelector("[data-contact_form]");
    const { name, email, contact_number, message } = form;
    let errMsg = [];

    if (name.value.trim() === "") {
        errMsg.push("Name is required");
    }
    if (email.type === "email") {
        const re = /\S+@\S+\.\S+/;
        if (!re.test(email.value)) {
            errMsg.push(`Input email is invalid`);
        }
    }
    if (contact_number.value.trim() === "") {
        errMsg.push("Contact number is required");
    }
    if (message.value.trim() === "") {
        errMsg.push("Your inquiry message/details is required");
    }

    if (errMsg.length > 0) {
        showAlert(
            "Invalid Fields:",
            errMsg.map((item) => "<p>• " + item).join("</p>")
        );
    } else {
        const formData = new FormData();

        formData.append("name", removeSpecials(name.value));
        formData.append("email", email.value);
        formData.append("contact_number", removeSpecials(contact_number.value));
        formData.append("message", removeSpecials(message.value));

        ajax({
            url: "submit-contact-form",
            headers: {
                body: formData,
                method: "POST",
            },
            success(data) {
                if (data?.error) {
                    alertify
                        .alert(
                            `
                    <div class="error-message">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                            <path d="m40-120 440-760 440 760H40Zm138-80h604L480-720 178-200Zm302-40q17 0 28.5-11.5T520-280q0-17-11.5-28.5T480-320q-17 0-28.5 11.5T440-280q0 17 11.5 28.5T480-240Zm-40-120h80v-200h-80v200Zm40-100Z"/>
                        </svg>
                        <p>${data.error}</p>
                    </div>`
                        )
                        .set("basic", true);
                } else if (data?.success) {
                    alertify
                        .alert(
                            `
                        <div class="success-message">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                    viewBox="0 0 50 50" xml:space="preserve">
                                <circle style="fill:#25AE88;" cx="25" cy="25" r="25"/>
                                <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="
                                    38,15 22,33 12,25 "/>
                            </svg>
                            <p>${data.success}</p>
                        </div>`
                        )
                        .set("basic", true);

                    form.reset();
                    submitContactBtn.disabled = true;
                }
            },
            error(err) {
                console.log(err);
                alertify
                    .alert(
                        `
                <div class="error-message">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                        <path d="m40-120 440-760 440 760H40Zm138-80h604L480-720 178-200Zm302-40q17 0 28.5-11.5T520-280q0-17-11.5-28.5T480-320q-17 0-28.5 11.5T440-280q0 17 11.5 28.5T480-240Zm-40-120h80v-200h-80v200Zm40-100Z"/>
                    </svg>
                    <p>Some problems encountered while sending your request. Please try again later</p>
                </div>`
                    )
                    .set("basic", true);
            },
        });
    }
}

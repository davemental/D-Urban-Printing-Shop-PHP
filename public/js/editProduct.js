"use strict";

import {
    ajax,
    showAlert
} from "./utils.js";

let featured_img_filename = "";
let sample_img_filenames = [];

const btnSave = document.querySelector("[data-save_product]");
const form = document.querySelector('.edit-product form');

featured_img_filename = document.querySelector("[data-featured_img]").getAttribute("data-file");

document.querySelectorAll("[data-sample_img]").forEach(img => {
    sample_img_filenames.push(img.getAttribute("data-file"));
});

btnSave.addEventListener("click", (ev) => { 
    ev.preventDefault();

    const { title, description, featured_product_image, sample_product_image } = form;
    const formData = new FormData();

    formData.append('id', form.getAttribute("data-product_id"));
    formData.append('title', title.value);
    formData.append('description', description.value);
    
    /** append only if theres an upload */
    if (featured_product_image.files.length > 0) { 
        formData.append('featured_img[]', featured_product_image.files[0]);
    }

    /** append only if theres an upload */
    if (sample_product_image.files.length > 0) { 
        Array.prototype.forEach.call(sample_product_image.files, file => {
            formData.append('sample_img[]', file);
        });
    }

    if (sample_imgs_filename_removed.length > 0) {
        Array.prototype.forEach.call(sample_imgs_filename_removed, item => {
            formData.append('removed_sample_img[]', item);
        });
     }

    ajax({
        url: "../save-edit-product",
        headers: {
            body: formData,
            method: "POST",
        },
        success(data){ 
            if (data?.error) {
                showAlert("Failed in saving updated information", data.error);
            } else if (data?.success){
                showAlert("Update Successful", data.success);
            }
        },
        error(err) {
            console.log(err.message);
        }
    })
});
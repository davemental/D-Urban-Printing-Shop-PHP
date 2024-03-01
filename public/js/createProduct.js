"option strict";

import {
    ajax
} from "./utils.js";

const form = document.querySelector('.add-product form');

function handleSubmitProduct(ev) {
    ev.preventDefault();

    const { title, description, featured_product_image, sample_product_image } = form;
    const formData = new FormData();

    formData.append('title', title.value);
    formData.append('description', description.value);
    formData.append('featured_img[]', featured_product_image.files[0]);

    Array.prototype.forEach.call(sample_product_image.files, file => {
        formData.append('sample_img[]', file);
    });

    ajax({
        url: "create-add-product",
        headers: {
            body: formData,
            method: "POST",
        },
        success(data){ 
            if (data?.error) {
                showAlert("Creation Failed", data.error);
            } else if (data?.success){
                showAlert("Create Successful", data.success);

                // Reset form
                title.value = "";
                description.value = "";
                featured_product_image.value = "";
                sample_product_image.value = "";

                document.querySelectorAll(".image-item-featured")?.forEach(image => image.remove());
                document.querySelectorAll(".image-item-sample")?.forEach(image => image.remove());
                tex.destroy(document.getElementById("editor"));
                uploadFiles = [];
                
                resetTextEditor();
            }
        },
        error(err) {
            console.log(err);
        }
    })
}

function showAlert(title,message) {
    alertify.alert()
    .setting({
    'title': title,
        'message': `${message}`,
    
        notifier: {
            delay: 5,
            closeButton: false,
        }
}).show();
}

function resetTextEditor() {
    
    const tex = window.tex;
    tex.init({
        element: document.getElementById("editor"),
        buttons:  ['fontSize', 'bold', 'italic', 'underline', 'strikethrough', 'heading1', 'heading2', 'paragraph', 'removeFormat', 'quote', 'olist', 'ulist', 'line', 'link', 'image', 'textColor', 'textBackColor', 'indent', 'outdent', 'undo', 'redo', 'justifyCenter', 'justifyFull', 'justifyLeft', 'justifyRight'],
        onChange: (content) => {
            // console.log(content);
        }
    });
}

// attaching event handle to save btn
const saveBtn = document.querySelector("[data-save_product]");
saveBtn.addEventListener("click", handleSubmitProduct);


document.querySelector('.test').addEventListener("click", () => { 
    console.log(document.querySelector('.s_upload__inputfile').files);
    console.log(uploadFiles);
})

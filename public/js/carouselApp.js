"option strict";

/** MODULE  IMPORTS */
import {
    ajax
} from "./utils.js";

const btnSave = document.querySelector("[data-save]");
btnSave?.addEventListener("click", ev => {
    ev.preventDefault();


    uploadImageCarousel();
})

function uploadImageCarousel() {

    const { sample_product_image } = document.querySelector(".image-carousel form");
    const imgsPreview = document.querySelectorAll("[data-sample_img]");

    if (imgsPreview.length == 0 && sample_product_image.files.length == 0 && sample_imgs_filename_removed.length == 0) { 
        alertify.set("notifier", "position", "top-right");
        alertify.error('No images selected');
        return;
    }

    const formData = new FormData();

    Array.prototype.forEach.call(sample_product_image.files, file => {
        formData.append('img_carousel[]', file);
    });

    if (sample_imgs_filename_removed.length > 0) {
        Array.prototype.forEach.call(sample_imgs_filename_removed, item => {
            formData.append('removed_img[]', item);
        });
     }

    ajax({
        url: "upload-image-carousel",
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

                // Reset form
                document.querySelector(".image-carousel form").reset();
                uploadFiles = [];
            }
        },
        error(err) {
            console.log(err);
            alertify.set("notifier", "position", "top-right");
            alertify.error(`Upload failed, <br>${err.message}`);
        }
    });
}

let uploadFiles = [];
const sizeLimit = 2_000_000; // 2mb size limit
let sample_imgs_filename_removed = []; // save images remove for edit product


function ImgUpload(ev) {
    ev.preventDefault();

    let imgWrap = document.querySelector(".upload__img-wrap");
    let maxLength = parseInt(ev.target.getAttribute("data-max_length"));
    let errorMsg = [];

    let files = ev.target.files;
    // console.table(files);

    let filesArr = Array.prototype.slice.call(files);
    let iterator = 0;
    const imgsPreview = document.querySelectorAll("[data-sample_img]");

    filesArr.forEach(function (f, index) {
        if (!f.type.match("image.*")) {
            errorMsg.push(`<b>${f.name}</b> - <i class="text-body-xs">Invalid file format</i>`)
            return false;

        } else if (f.size > sizeLimit) {
            errorMsg.push(`<b>${f.name}</b> - <i class="text-body-xs">File limit size reached</i>`);
            return false;

        } else if ((uploadFiles.length + parseInt(imgsPreview.length)) > maxLength) {
            // console.log(uploadFiles.length);
            errorMsg.push(`<br/><b>You reached the maximum number to files to upload</b>`);
            return false;

        } else {
            let len = 0;
            for (let i = 0; i < uploadFiles.length; i++) {
                if (uploadFiles[i] !== undefined) {
                    len++;
                }
            }
            if (len > maxLength) {
                return false;
            } else {
                uploadFiles.push(f);
                // uploadFiles.push(f);

                let reader = new FileReader();
                reader.onload = function (e) {
                    let uBox = document.createElement("div");
                    uBox.classList.add("image-item-sample");
                    uBox.innerHTML =
                        `<div class='upload__img-box'>
                            <div
                                style="background-image: url('${e.target.result}')" 
                                data-number="${document.getElementsByClassName('upload__img-close').length}"
                                data-file="${f.name}"
                                class='img-bg'>
                                <div class='upload__img-close'></div>
                            </div>
                        </div>`;
                    
                    imgWrap.appendChild(uBox);
                    iterator++;
                };
                reader.readAsDataURL(f);
            }
        }
    });

    // update input file list
    syncUploadFileArrayToInput(ev.target)

    // display the error message
    if (errorMsg.length > 0) { 

        //grab the dialog instance using its parameter-less constructor then set multiple settings at once.
        alertify.alert()
            .setting({
            'closable': true,
            'title': 'List of Files Failed to Upload:',
            'label':'Close',
            'message': `<b>NOTE:</b> file size must not exceed 2mb, file format must be "JPEG, JPG, PNG, WEBP". <br/><br/>${errorMsg.map(item => '• '+ item).join('<br>')}`,
        }).show();
    }
}

function syncUploadFileArrayToInput(input) {
    input.value = null;
    let data = new DataTransfer();

    for (let i = 0; i < uploadFiles.length; i++) {
        let file = uploadFiles[i];
        data.items.add(file);
    }
    
    return input.files = data.files;
}

// capture document click event
document.addEventListener("click", function (e) {
    for (var target = e.target; target != this; target = target.parentNode) {

        // Remove selected image from list
        if (e.target.classList.contains("upload__img-close")) {
            let file = e.target.parentNode.dataset["file"];
            // console.log(file);
            for (let i = 0; i < uploadFiles.length; i++) {
                if (uploadFiles[i].name === file) {
                    uploadFiles.splice(i, 1);
                    break;
                }
            }

            //remove from DOM
            e.target.parentElement.parentElement.parentElement.remove();

            //remove from file list
            syncUploadFileArrayToInput(this.documentElement.querySelector(".s_upload__inputfile"));

            // save remove file name
            sample_imgs_filename_removed.push(file);
            return false;
        }
    }
}, false)

// atach event listener to input file
document.querySelector(".s_upload__inputfile")?.addEventListener("change", ImgUpload);


// atach event to feature product image input file
document.querySelector(".f_upload__inputfile")?.addEventListener("change", function (ev) {
    ev.preventDefault();

    let imgWrap = document.querySelector(".f_upload__img-wrap");
    let errorMsg = [];

    let file = ev.target.files[0];

    if (!file.type.match("image.*")) {
        errorMsg.push(`<b>${file.name}</b> - <i class="text-body-xs">Invalid file format</i>`);
    } else if (file.size > sizeLimit) {
        errorMsg.push(`<b>${file.name}</b> - <i class="text-body-xs">File limit size reached</i>`);
    } else {

        // clear previous image
        document.querySelectorAll(".image-item-featured").forEach(image => image.remove());
    
        let reader = new FileReader();
        reader.onload = function (e) {
            let uBox = document.createElement("div");
            uBox.classList.add("image-item-featured");
            uBox.innerHTML =
                `<div class='f_upload__img-box'>
                    <div
                        style="background-image: url('${e.target.result}')" 
                        data-number="${document.getElementsByClassName('upload__img-close').length}"
                        data-file="${file.name}"
                        class='img-bg'>
                    </div>
                </div>`;
            
            imgWrap.appendChild(uBox);
        };
        reader.readAsDataURL(file);
    }

    // display the error message
    if (errorMsg.length > 0) { 
       
        alertify.alert()
            .setting({
            'closable': true,
            'title': 'Invalid Upload File:',
            'label':'Close',
            'message': `<b>NOTE:</b> file size must not exceed 2mb, file format must be "JPEG, JPG, PNG, WEBP". <br/><br/>${errorMsg.map(item => '• '+ item).join('<br>')}`,
        }).show();
    }
});



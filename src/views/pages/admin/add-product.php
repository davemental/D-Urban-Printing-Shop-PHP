 

    
<section class="content-wrapper">

    <div class="page-title">
        <h1><?php echo $title;?></h1>
    </div>

    <div class="add-product">
        <form action="" enctype="multipart/form-data">

            <div>
                <label for="title" class="primary-label">Product Name<span class="red">*</span></label>
                <input type="text" name="title" placeholder="Product Name" minlength="8" maxlength="100" required/>
            </div>

            <div>
                <label for="description" class="primary-label">Product Description<span class="red">*</span></label>
                <textarea id="editor" name="description"></textarea>
            </div>

            <div>
                <label for="featured_product" class="primary-label">Featured Product Image<span class="red">*</span></label>
                <div class="upload__box">
                    <div class="f_upload__img-wrap">
                      
                      <div class="upload__btn-box" >
                          <label class="upload__btn">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20" height="20">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                              </svg>

                              <p>Click to upload image</p>
                              <input type="file" class="f_upload__inputfile" name="featured_product_image"  accept=".jpg, .jpeg, .png, .webp|image/*" required />
                          </label>
                      </div>

                      <!-- this will populate with images -->
                    </div>
                </div>
            </div>

            <div>
                <label class="primary-label">Sample Product Images (<span class="text-body-s"><i>Each image size should not exceed 2mb, and a maximum of 20 images only</i></span>)</label>
                <div class="upload__box">
                    <div class="upload__img-wrap">
                      
                      <div class="upload__btn-box" >
                          <label class="upload__btn">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20" height="20">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                              </svg>

                              <p>Click to upload images</p>
                              <input type="file" class="s_upload__inputfile" name="sample_product_image" accept=".jpg, .jpeg, .png, .webp|image/*" data-max_length="19" multiple required>
                          </label>
                      </div>

                      <!-- this will populate with images -->
                    </div>
                </div>
            </div>

            <div>
                <button class="secondary-btn" data-save_product>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                        <path d="M640-640h120-120Zm-440 0h338-18 14-334Zm16-80h528l-34-40H250l-34 40Zm184 270 80-40 80 40v-190H400v190Zm182 330H200q-33 0-56.5-23.5T120-200v-499q0-14 4.5-27t13.5-24l50-61q11-14 27.5-21.5T250-840h460q18 0 34.5 7.5T772-811l50 61q9 11 13.5 24t4.5 27v196q-19-7-39-11t-41-4v-122H640v153q-35 20-61 49.5T538-371l-58-29-160 80v-320H200v440h334q8 23 20 43t28 37Zm138 0v-120H600v-80h120v-120h80v120h120v80H800v120h-80Z"/>
                    </svg>
                    <span>Save Product</span>
                </button>
            </div>
        </form>
    </div>
</section>


</main>

<!-- Rich text editor -->
<script src="<?php echo APP_URL; ?>/public/js/plugins/tex.js"></script>
<script src="<?php echo APP_URL; ?>/public/js/imageUpload.js"></script>


<!-- Initialize Tex Editor -->
<script>
        const tex = window.tex;
        tex.init({
            element: document.getElementById("editor"),
            buttons:  ['fontSize', 'bold', 'italic', 'underline', 'strikethrough', 'heading1', 'heading2', 'paragraph', 'removeFormat', 'quote', 'olist', 'ulist', 'line', 'link', 'image', 'textColor', 'textBackColor', 'indent', 'outdent', 'undo', 'redo', 'justifyCenter', 'justifyFull', 'justifyLeft', 'justifyRight'],
            onChange: (content) => {
                // console.log(content);
            }
        });
      
</script>

<script type="module" async src="<?php echo APP_URL;?>/public/js/createProduct.js"></script>
 

    
<section class="content-wrapper">

    <div class="page-title">
        <h1><?php echo $title;?></h1>
    </div>

    <div class="add-product">
        <form action="" enctype="multipart/form-data">

            <div>
                <label for="title">Product Name*</label>
                <input type="text" name="title" placeholder="Product Name" required/>
            </div>

            <div>
                <label for="description">Product Description*</label>
                <textarea id="editor" name="description" required></textarea>
            </div>

            <div>
                <label for="featured_product">Featured Product Image*</label>
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
                <label>Sample Product Images (<span class="text-body-s"><i>Each image size should not exceed 2mb, and a maximum of 20 images only</i></span>)</label>
                <div class="upload__box">
                    <div class="upload__img-wrap">
                      
                      <div class="upload__btn-box" >
                          <label class="upload__btn">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20" height="20">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                              </svg>

                              <p>Click to upload images</p>
                              <input type="file" class="s_upload__inputfile" name="sample_product_image" accept=".jpg, .jpeg, .png, .webp|image/*" data-max_length="20" multiple required>
                          </label>
                      </div>

                      <!-- this will populate with images -->
                    </div>
                </div>
            </div>

            <div>
                <input type="submit" value="Save Product" class="primary-btn" />
            </div>
        </form>


    </div>
</section>


</main>

<!-- Rich text editor -->
<script src="<?php echo APP_URL; ?>/public/js/tex.js"></script>
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

<script src="<?php echo APP_URL;?>/public/js/createProduct.js"></script>
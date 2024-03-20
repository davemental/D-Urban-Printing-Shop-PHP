 

    
<section class="content-wrapper">

    <div class="page-title">
        <h1><?php echo $title; ?></h1>
    </div>

    <div class="edit-product">
        <form action="" enctype="multipart/form-data" data-product_id="<?php echo $productData->id ?>">

            <div>
                <label for="title" class="primary-label">Product Name<span class="red">*</span></label>
                <input type="text" name="title" placeholder="Product Name" value="<?php echo $productData->title ?>" minlength="8" maxlength="100" required/>
            </div>

            <div>
                <label for="description" class="primary-label">Product Description<span class="red">*</span></label>
                <textarea id="editor" name="description">
                    <?php echo $productData->description ?>
                </textarea>
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
                              <input type="file" class="f_upload__inputfile" name="featured_product_image"  accept=".jpg, .jpeg, .png, .webp|image/*" />
                          </label>
                      </div>

                      <div class="image-item-featured">
                        <div class='f_upload__img-box'>
                            <div
                                style="background-image: url('<?php echo APP_URL . 'public/images/uploads/products/' . $productData->featured_img; ?>')" 
                                data-number="0"
                                data-file="<?php echo $productData->featured_img; ?>"
                                data-featured_img
                                class='img-bg'>
                            </div>
                        </div>
                      </div>

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
                              <input type="file" class="s_upload__inputfile" name="sample_product_image" accept=".jpg, .jpeg, .png, .webp|image/*" data-max_length="19" multiple >
                          </label>
                      </div>

                      <!-- this will populate with images -->
                      <?php 
                        
                        if (!$productData->sample_img === "" OR !empty($productData->sample_img)) {

                            $sample_images = explode(", ", $productData->sample_img);
                            $count = 0;

                            foreach($sample_images as $img) {
                            
                                echo '
                                    <div class="image-item-sample">
                                        <div class="upload__img-box">
                                            <div
                                                style="background-image: url('. APP_URL . 'public/images/uploads/products/' . $img .')" 
                                                data-number="' . $count .'"
                                                data-file="'. $img .'"
                                                data-sample_img
                                                class="img-bg">
                                                <div class="upload__img-close"></div>
                                            </div>
                                        </div>
                                    </div>
                                ';
                                $count += 1;
                            }
                        }
                        
                        ?>
                    </div>
                </div>
            </div>

            <div>
                <button class="secondary-btn" data-save_product>
                    <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15">
                        <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z"/>
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

<script type="module" async src="<?php echo APP_URL; ?>/public/js/editProduct.js"></script>
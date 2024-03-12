 

    
<section class="content-wrapper">

    <div class="page-title">
        <h1><?php echo $title; ?></h1>
    </div>

    <div class="edit-product">
        <form action="" enctype="multipart/form-data" data-product_id="<?php echo $productData->id ?>">

            <div>
                <label for="title">Product Name*</label>
                <input type="text" name="title" placeholder="Product Name" value="<?php echo $productData->title ?>" required/>
            </div>

            <div>
                <label for="description">Product Description*</label>
                <textarea id="editor" name="description">
                    <?php echo $productData->description ?>
                </textarea>
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
                <label>Sample Product Images (<span class="text-body-s"><i>Each image size should not exceed 2mb, and a maximum of 20 images only</i></span>)</label>
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
                <button class="primary-btn" data-save_product>Save Product</button>
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
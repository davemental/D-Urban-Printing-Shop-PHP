
<section class="content-wrapper">
    <div class="page-title">
        <h1><?php echo $title; ?></h1>
        <p>This carousel will display in home page</p>
        <p>To remove image, just click the "<b>X</b>" button on upper right, then click save.</p>
        <p>Image Aspect Ratio 3:8:1 ex: 1900px X 500px</p>
    </div>


    <div class="image-carousel">
        <form>

            <div>
                <label>Images Carousel (<span class="text-body-s"><i>Each image size should not exceed 3mb, and a maximum of 5 images only</i></span>)</label>
                <div class="upload__box">
                    <div class="upload__img-wrap">
                        
                        <div class="upload__btn-box" >
                            <label class="upload__btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20" height="20">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                                </svg>

                                <p>Click to upload images</p>
                                <input type="file" class="s_upload__inputfile" name="sample_product_image" accept=".jpg, .jpeg, .png, .webp|image/*" data-max_length="4" multiple>
                            </label>
                        </div>

                        <!-- this will populate with images -->
                        <?php 
                        
                        if (count($imgData) > 0) {

                            $count = 0;

                            foreach ($imgData as $img) {
                                echo '
                                    <div class="image-item-sample">
                                        <div class="upload__img-box">
                                            <div
                                                style="background-image: url('. APP_URL . 'public/images/carousel/' . $img->img_name .')" 
                                                data-number="' . $count .'"
                                                data-file="'. $img->img_name .'"
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
                <button class="secondary-btn" data-save>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none"/><path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm2 16H5V5h11.17L19 7.83V19zm-7-7c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3zM6 6h9v4H6z"/>
                    </svg>
                   <span>Save</span>
                </button>
            </div>

        </form>
    </div>

</section>
</main>

<script src="<?php echo APP_URL; ?>/public/js/imageUpload.js"></script>
<script type="module" src="<?php echo APP_URL; ?>/public/js/carouselApp.js"></script>
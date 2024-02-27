<main class="bg-texture-primary" data-main>
    <section class="product-item-container">
        <div class="t-item-container">
            <div class="item-img-container">
                <img src="<?php echo APP_URL . '/public/images/uploads/products/'. $productData->featured_img; ?>" alt="" />
            </div>
            <div class="item-description text-body-m">
                <h1 class="text-title-l"><b><?php echo $productData->title; ?></b></h1>
                
                <?php echo $productData->description; ?>
            </div>
        </div>

        <div class="b-item-container">
            <div class="b-item-title title-texture-primary">
                <h2 class="text-title-l">More Sample Designs</h2>
            </div>

            <div class="product-list">
                <?php 
                    $sample_images = explode(', ', $productData->sample_img);
                    foreach ($sample_images as $item) {

                        echo ' <article class="item-container">
                            <div class="item shrink-on-hover">
                                <a data-fslightbox href="'. APP_URL .'/public/images/uploads/products/'. $item .'" class="item-anchor" aria-label=""></a>
                                <img src="'. APP_URL .'/public/images/uploads/products/'. $item .'" alt="" />
                            </div>
                        </article>';
                    }
                ?>
            </div>
        </div>

        <div class="customize-getquote">
            <a href="<?php echo APP_URL; ?>get-a-quote" class="primary-btn" aria-label="">Request A Free Quote Now</a>
        </div>
    </section>
</main>

<script src="<?php echo APP_URL; ?>/public/js/fslightbox.js"></script>
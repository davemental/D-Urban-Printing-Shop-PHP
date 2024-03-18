<main data-main>
    <div class="page-title-container title-texture-primary">
        <h1 class="text-title-l"><b>Products</b></h1>
    </div>

    <div class="product-container bg-texture-primary">

        <section class="products">

            <div class="product-list">

                <?php 
                
                    foreach($productData as $item) {

                    echo '<article class="item-container">
                            <div class="item shrink-on-hover">
                                <a href="' .APP_URL .'product-item?id= ' . $item->id . '" class="item-anchor" aria-label=""></a>
                                <img src="' .APP_URL .'/public/images/uploads/products/' . $item->featured_img . '" alt="" />
                            </div>
                        </article>';
                    }
                
                ?>
            </div>
        </section>

    </div>
</main>
    
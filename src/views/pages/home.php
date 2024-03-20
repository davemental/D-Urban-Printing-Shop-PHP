<main data-main>

    <section id="home">

        <!-- FEATURED PRODUCT IMAGE CAROUSEL -->
        <div class="carousel-wrapper" js-carousel-wrapper>
            <!-- Counter -->
            <!-- <div class="slide-number">
                <span class="slide-number-text" js-slide-number-text> 1 / 5</span>
            </div> -->

            <!-- Images -->
            <?php 

                if (count($imgSlide) > 0) {
                    foreach($imgSlide as $img) {
                        echo '
                            <div class="carousel-item" js-carousel-item>
                                <img src="' . APP_URL . '/public/images/carousel/'. $img->img_name .'" alt="">
                            </div>';
                        }
                } else {
                echo '
                    <div class="carousel-item" js-carousel-item>
                        <img src="'. APP_URL .'/public/images/no-image.jpg" alt="">
                    </div>
                    ';
                }
               
            ?>
            <!-- Navigation Arrows -->
            <button type="button" class="carousel-arrow prev" data-carousel-arrows data-dir="prev"> &#x2039; </button>
            <button type="button" class="carousel-arrow next" data-carousel-arrows data-dir="next"> &#x203A; </button>
            
            <!-- Pagination Dots -->
            <div class="carousel-dots" data-carousel-dots>
                <button type="button" class="dots" data-active-dot js-data-dots data-dots-index="1"> </button>
                <button type="button" class="dots" js-data-dots data-dots-index="2"> </button>
                <button type="button" class="dots" js-data-dots data-dots-index="3"> </button>
                <button type="button" class="dots" js-data-dots data-dots-index="4"> </button>
                <button type="button" class="dots" js-data-dots data-dots-index="5"> </button>
            </div>
        </div>
    </section>

    <div class="bg-texture-primary">

    
        <div class="container page-title-container">
            <h2 class="text-title-xl"><b>WHAT WE OFFER</b></h2>
            <p class="text-body-m">
                D-Urban Print can provide high quality product without compromised.
                We also cater based on your needs. Your ideas we can make it reality.
            </p> 
        </div>

        <section id="products" class="container">
            <div class="product-list">
                <?php 
                    if (count($productData) > 0) {
                        foreach($productData as $item) {
                            echo '<article class="item-container">
                                    <div class="item shrink-on-hover">
                                        <a href="' .APP_URL .'product-item?id= ' . $item->id . '" class="item-anchor" aria-label=""></a>
                                        <img src="' .APP_URL .'/public/images/uploads/products/' . $item->featured_img . '" alt="" />
                                    </div>
                                </article>';
                            }
                    } else {
                        echo '<article class="item-container">
                                <div class="item shrink-on-hover">
                                    <a href="#" class="item-anchor" aria-label=""></a>
                                    <img src="' .APP_URL .'/public/images/no-image2.jpg" alt="" />
                                </div>
                            </article>';
                    }
                ?>
            </div>

            <div class="bottom-page-container">
                <a href="<?php echo APP_URL; ?>products" class="primary-btn center wl" alt="all products">ALL PRODUCTS</a>
            </div>
        </section>
    </div>

    <section id="about" class="container-secondary bg-texture-secondary">
        <div class="about-container">
            <div class="about-container-l">
                <span class="primary-wrapper text-title-l">
                    WHO WE ARE
                </span>
                <p class="about-description text-body-m">
                    D-Urban Print has been recognized and trusted manufacturing company in the Province of Bukidnon 
                    that specialize in mass production of customized apparels such as company uniforms, sports ware,
                    promotional giveaways and many more at a very competitive price without compromising the quality.
                </p>
                
                <a href="<?php echo APP_URL; ?>about-us" class="primary-btn text-body-m" alt="Learn more">
                    LEARN MORE
                </a>
            </div>
            
            <div class="about-container-r">
                <video width="320" height="240" autoplay muted controls>
                    <source src="<?php echo APP_URL; ?>\public\videos\vid1.mp4" type="video/mp4">
                    Your browser does not support the video tag
                </video>
            </div>
        </div>
    </section>

    <section id="instant-quote" class="container-secondary">
        <div class="in-quote-con">
            <div class="qoute-subcon-l">
                <h2 class="text-title-l">
                    Get an INSTANT FREE QUOTE<br>
                    NOW
                </h2>

                <br><br>
                <p class="text-body-m">We aim to provide great customer service. For inquiries and price quotation, here are all the ways you can contact us.</p>
                
                <br>
                <ul class="contact-list">
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                            <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-body-m">Purok 5A North Poblacion, Maramag, Bukidnon 8714</p>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                            <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-body-m">0935-198-5328</p>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20">
                            <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                        </svg>
                        <p class="text-body-m">urbanprints2022@gmail.com</p>
                    </li>
                </ul> 
                
                <div class="in-quote-social socials-primary">
                    <div class="social-item-primary expand-on-hover">
                        <a class="item-anchor" href="#"></a>
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><rect fill="none" height="24" width="24"/>
                            <path d="M22,12c0-5.52-4.48-10-10-10S2,6.48,2,12c0,4.84,3.44,8.87,8,9.8V15H8v-3h2V9.5C10,7.57,11.57,6,13.5,6H16v3h-2 c-0.55,0-1,0.45-1,1v2h3v3h-3v6.95C18.05,21.45,22,17.19,22,12z"/>
                        </svg>
                    </div>
                    <div class="social-item-primary expand-on-hover">
                        <a class="item-anchor" href="#"></a>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="24" width="24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </div>
                    <div class="social-item-primary expand-on-hover">
                        <a class="item-anchor" href="#"></a>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20">
                            <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                        </svg>
                    </div>
                    <div class="social-item-primary expand-on-hover">
                        <a class="item-anchor" href="#"></a>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="qoute-subcon-r">
                <form class="form-secondary" method="post" action="" data-contact_form>
                    <input type="text" name="name" id="" placeholder="Name *" minlength="8" maxlength="50" required/> 
                    <input type="email" name="email" id="" placeholder="Email *"  minlength="8" maxlength="50" required/> 
                    <input type="text" name="contact_number" id="" placeholder="Contact Number *" minlength="8" maxlength="50" required/> 
                    <textarea name="message" rows="6" placeholder="Message *" minlength="8" maxlength="100" required></textarea>
                    <button class="primary-btn center" data-submit_btn>Submit</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Image Carousel JS Script -->
    <script  src="<?php echo APP_URL; ?>/public/js/plugins/carousel.js" defer></script>
</main>


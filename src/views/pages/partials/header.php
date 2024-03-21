<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="public/fav-icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="public/fav-icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="public/fav-icon/favicon-16x16.png">
    <link rel="manifest" href="public/fav-icon/site.webmanifest">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Alertify Plugin -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>

    <!-- Image Carousel Plugin Style -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/carousel.css">

    <!-- Main style sheet -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/global.css">
    <link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/main.css">
</head>
<body>
    
<header class="header-container bg-texture-secondary" data-header>

    <section class="header-banner">
        <div class="l-sub-header">
            <a href="<?php echo APP_URL; ?>">
                <div class="logo-container" data-image-logo><img src="<?php echo APP_URL; ?>/public/images/logo.png" alt="" />
                </div>
            </a>
        </div>
        
        <div class="r-sub-header">
            <div class="social-media">
                <p class="text-body-m">Connect with Us</p>
                <div class="expand-on-hover">
                    <a class="item-anchor" href="#"></a>
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><rect fill="none" height="24" width="24"/>
                        <path d="M22,12c0-5.52-4.48-10-10-10S2,6.48,2,12c0,4.84,3.44,8.87,8,9.8V15H8v-3h2V9.5C10,7.57,11.57,6,13.5,6H16v3h-2 c-0.55,0-1,0.45-1,1v2h3v3h-3v6.95C18.05,21.45,22,17.19,22,12z"/>
                    </svg>
                </div>
                <div class="expand-on-hover">
                    <a class="item-anchor" href="#"></a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="24" width="24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                </div>
                
                <div class="expand-on-hover">
                    <a class="item-anchor" href="#"></a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="24" width="24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </div>

                <div class="expand-on-hover">
                    <a class="item-anchor" href="#"></a>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" height="24" width="24">
                        <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            <form class="search-form form-primary" data-search_form>
                <div class="search-form-field">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    </svg>
                    <input type="text" name="search_key" placeholder="Type to Search" data-search_input/>
                </div>
                
                <div class="search-results" data-search_results>
                    <i class="text-body-s">Search Results:</i>
                    <div data-search_results_item>

                    </div>
                    <!-- RENDER HERE THE RESULTS -->
                </div>
            </form>
        </div>
    </section>

    <section>
        <nav class="header-navigation">
            <a href="<?php echo APP_URL; ?>">Home</a>
            <a href="<?php echo APP_URL; ?>products">Products</a>
            <a href="<?php echo APP_URL; ?>get-a-quote">Get A Quote</a>
            <a href="<?php echo APP_URL; ?>about-us">About Us</a>
            <a href="<?php echo APP_URL; ?>faqs">FAQs</a>
        </nav>


        <!-- MOBILE MENU -->
        <div class="header-navigation-mobile">
            <button data-mobile_menu_btn>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                    <path d="M0 0h24v24H0V0z" fill="none"/>
                    <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
                </svg>
            </button>

            <nav class="header-navigation-mobile-menu bg-texture-secondary" data-mobile_menu_container>
                <a href="<?php echo APP_URL; ?>">Home</a>
                <a href="<?php echo APP_URL; ?>products">Products</a>
                <a href="<?php echo APP_URL; ?>get-a-quote">Get A Quote</a>
                <a href="<?php echo APP_URL; ?>about-us">About Us</a>
                <a href="<?php echo APP_URL; ?>faqs">FAQs</a>
            </nav>
        </div>
    </section>

</header>


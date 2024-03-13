<!DOCTYPE html>
<html lang="en" data-theme="light">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title; ?></title>
        <!-- Favicon -->

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Main style sheet -->
        <link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/global.css">
        <link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/admin.css">

        <!-- Alertify Plugin -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    </head>
    <body>
        <main>
            <section class="login-container">
                <span class="text-title-m">Login to Account</span>
                <form>
                    <div>
                        <label for="username">User Name</label>
                        <input type="text" name="username" placeholder="Username/Email" value="" />
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Password" value="" />
                    </div>
                    <div>
                        <button class="secondary-btn center" data-login_btn>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                <path d="M480-120v-80h280v-560H480v-80h280q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H480Zm-80-160-55-58 102-102H120v-80h327L345-622l55-58 200 200-200 200Z"/>
                            </svg>    
                            <span>Login</span>
                        </button>
                    </div>
                </form>
            </section>
        </main>

        <footer>
            <p>© 2020 - 2024 D-Urban Print. All rights reserved.</p>
        </footer>
        <script type="module" async src="<?php echo APP_URL;?>/public/js/loginApp.js"></script>
    </body>
</html>
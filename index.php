<?php

require_once __DIR__ . "/src/config/config.php";
require_once __DIR__ ."/src/router/Routes.php";
require_once __DIR__ ."/src/cores/Core.php";

spl_autoload_register(function ($file) {
    if (file_exists(__DIR__ . "/src/helpers/$file.php")) {
        require_once __DIR__ . "/src/helpers/$file.php";
    } else if (file_exists(__DIR__."/src/models/$file.php")) {
        //load all models
        require_once __DIR__."/src/models/$file.php";
    }
});

$core = new Core($routes);
$core->run();
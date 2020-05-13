<?php
define('PUBLICA', __DIR__);
define('BASE', dirname(PUBLICA));
define('APP', BASE . '/app');
define('VENDOR', BASE . '/vendor');
define('RAIZ', dirname($_SERVER["SCRIPT_NAME"]));
define('AMBIENTE', "produccion");

// require VENDOR . '/autoload.php';
require APP . "/bootstrap_web.php";
// var_dump($_SERVER["PHP_SELF"]);
// var_dump($_SERVER["SCRIPT_NAME"]);
// $carpeta = dirname($_SERVER["SCRIPT_FILENAME"]);
// $carpeta2 = dirname($_SERVER["PHP_SELF"]);
// $carpeta3 = dirname($_SERVER["REQUEST_URI"]);
// $carpeta4 = dirname($_SERVER["SCRIPT_NAME"]);

// var_dump($carpeta);
// var_dump($carpeta2);
// var_dump($carpeta3);
// var_dump($carpeta4);

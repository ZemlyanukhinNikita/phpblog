<?php

use config\Router;

session_start();

require_once '../config/Loader.php';

$loader = new Loader();

spl_autoload_register([$loader, 'loadClass']);

$routes = new Router();

$routes->start();
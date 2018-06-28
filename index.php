<?php
//phpinfo();

use config\Router;

require_once 'config/Database.php';
require_once 'config/Loader.php';

$loader = new Loader();

spl_autoload_register([$loader, 'loadClass']);
//$db = new Database();
//$qw = $db->getConnection();
//foreach($qw->query('SELECT * from news') as $row) {
//    print_r($row);
//}
$routes = new Router();

$routes->start();
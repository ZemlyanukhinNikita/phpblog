<?php
//phpinfo();
include 'config/config.php';
include 'config/Database.php';
$db = new Database();
$qw = $db->getConnection();
foreach($qw->query('SELECT * from news') as $row) {
    print_r($row);
}

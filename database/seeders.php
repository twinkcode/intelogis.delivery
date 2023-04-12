<?php
namespace Database;

require_once 'DB.php';
$pdo = DB::getInstance()->getPdo();




require_once 'SeedShipmentsTable.php';
(new SeedShipmentsTable($pdo))->seed();

//$res = $pdo->query('select * from sh');

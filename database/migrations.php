<?php

namespace Database;

require_once 'DB.php';
$pdo = DB::getInstance()->getPdo();
var_dump(sizeof($argv));
var_dump($argv);

require_once 'CreateShipmentsTableMigration.php';
if (isset($argv[1]) && $argv[1] == 'down')
    (new CreateShipmentsTableMigration($pdo))->down();
else
    (new CreateShipmentsTableMigration($pdo))->up();


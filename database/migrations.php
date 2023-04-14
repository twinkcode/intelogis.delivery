<?php

namespace Database;

require_once 'DB.php';
$pdo = DB::getInstance()->getPdo();

require_once 'CreateShipmentsTableMigration.php';
$ShipmentsTableMigration = new CreateShipmentsTableMigration($pdo);
isset($argv[1]) && $argv[1] == 'down'
    ? $ShipmentsTableMigration->down()
    : $ShipmentsTableMigration->up();


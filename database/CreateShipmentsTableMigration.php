<?php
namespace Database;
use PDO;
class CreateShipmentsTableMigration
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function up()
    {
        $this->pdo->exec('CREATE TABLE IF NOT EXISTS shipments (
            id INTEGER PRIMARY KEY,
            sourceKladr VARCHAR(20),
            targetKladr VARCHAR(20),
            weight REAL,
            created_at TEXT
        )');
    }

    public function down()
    {
        $this->pdo->exec('DROP TABLE IF EXISTS shipments');
    }
}

<?php
namespace Database;
use PDO;
class DB
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $config_env = parse_ini_file(__DIR__ . '/../.env');
        $_ENV['DATABASE_FILE'] = __DIR__ . '/../'. $config_env['DATABASE_FILE'];
        $dsn = "sqlite:" . $_ENV['DATABASE_FILE'];
        $this->pdo = new PDO($dsn);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}

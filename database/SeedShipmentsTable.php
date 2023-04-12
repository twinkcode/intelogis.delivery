<?php

namespace Database;

use PDO;

class SeedShipmentsTable
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Заполняем таблицу отправлений случайными данными
     *
     * @param $count int количество отправлений. По умолчанию 5 (можно задать cli-параметром: "-c=N")
     * @return void
     * @throws \Exception
     */
    public function seed($count = 5)
    {
        $opts = getopt('c:');
        if ($opts) $count = $opts['c'] && is_numeric($opts['c']) ? (int)$opts['c'] : $count;

        $tableExistQuery = $this->pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='shipments';");
        $tableExist = $tableExistQuery->fetchAll(PDO::FETCH_ASSOC);

        if ($tableExist) {
            require_once './src/helpers.php';
            for ($i = 0; $i < $count; $i++) {

                $sourceKladr = generateRandomString();
                $targetKladr = generateRandomString();
                $weight = rand_float(1, 29);

                $dateFrom = new \DateTime();
                $dateFromSubDays = mt_rand(1, 10);
                $dateFrom->modify("-$dateFromSubDays day");
                $dateTo = new \DateTime();
                $dateToSubDays = mt_rand(1, 10);
                $dateTo->modify("+$dateToSubDays day");
                $date = randomDate($dateFrom->format("Y-m-d H:i:s"), $dateTo->format("Y-m-d H:i:s"));

                $query = $this->pdo->prepare('INSERT INTO shipments (sourceKladr , targetKladr, weight, created_at) VALUES (?, ?, ?, ?)');
                $query->execute([$sourceKladr, $targetKladr, $weight, $date]);
            }

        } else throw new \Exception('table shipments not exist');
    }

}

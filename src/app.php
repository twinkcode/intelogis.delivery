<?php

namespace DeliveryModule\Delivery;

use Database\DB;
use DeliveryModule\Exceptions\DeliveryException;

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database/DB.php';

$fast_delivery = new DeliveryServiceDecorator(new FastDeliveryService());
$slow_delivery = new DeliveryServiceDecorator(new SlowDeliveryService());

$pdo = DB::getInstance()->getPdo();
try {
    $shipments = $pdo->query('SELECT sourceKladr, targetKladr, weight FROM shipments');
} catch (\PDOException $e) {
    echo "Run migrations and seeders before start app..."; die();
}
$shipments = $shipments->fetchAll($pdo::FETCH_ASSOC);


/**
 * Вывод таблиц в браузер
 * @param array $shipments
 * @param DeliveryServiceDecorator $delivery
 * @return array
 * @throws DeliveryException
 */
function extracted(array $shipments, DeliveryServiceDecorator $delivery): array
{
    foreach ($shipments as $shipment) {
        echo "<tr>";
        $row = $delivery->calculatePrice(
            $shipment['sourceKladr'],
            $shipment['targetKladr'],
            $shipment['weight']
        );
        if (!$row['error']) {
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
        } else
            echo "<td colspan='2' style='color: red'>Error: " . $row['error'] . "</td>";
        echo "<tr>";
    }
    return array($shipment, $row);
}

echo '<div class="bootstrap-wrapper"><div class="container"><div class="row">';
foreach (['fast_delivery', 'slow_delivery'] as $delivery) {
    echo "<div class='col-md-6'><h2>$delivery</h2><table><thead><th>price</th><th>date</th></thead><tbody>";
    list($shipment, $row) = extracted($shipments, $$delivery);
    echo "</tbody></table></div>";
}
echo "</div></div></div>";
echo <<<HTML
<style> 
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
td {
padding: 5px 1em;
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/dmhendricks/bootstrap-grid-css@4.1.3/dist/css/bootstrap-grid.min.css" />
HTML;


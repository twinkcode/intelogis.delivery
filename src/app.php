<?php

namespace DeliveryModule\Delivery;

use Database\DB;

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database/DB.php';

$fast_delivery = new DeliveryServiceDecorator(new FastDeliveryService());
$slow_delivery = new DeliveryServiceDecorator(new SlowDeliveryService());

$pdo = DB::getInstance()->getPdo();
$shipments = $pdo->query('SELECT sourceKladr, targetKladr, weight FROM shipments');
$shipments = $shipments->fetchAll(\PDO::FETCH_ASSOC);

echo '<div class="bootstrap-wrapper">
	<div class="container">
		<div class="row">';
echo "<div class='col-md-6'><h2>Fast delivery</h2>";
echo "<table><tbody>";
foreach ($shipments as $shipment) {
    echo "<tr>";
    $row = $fast_delivery->calculatePrice(
        $shipment['sourceKladr'],
        $shipment['targetKladr'],
        $shipment['weight']
    );
    if (!$row['error']) {
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
    } else
        echo "<td>" . $row['error'] . "</td>";
    echo "<tr>";
}
echo "</tbody></table></div>";

echo "<div class='col-md-6'><h2>Slow delivery</h2>";
echo "<table><tbody>";
foreach ($shipments as $shipment) {
    echo "<tr>";
    $row = $slow_delivery->calculatePrice(
        $shipment['sourceKladr'],
        $shipment['targetKladr'],
        $shipment['weight']
    );
    if (!$row['error']) {
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
    } else
        echo "<td>" . $row['error'] . "</td>";
    echo "<tr>";
}
echo "</tbody></table></div>";
echo "</div></div></div>";
echo "<style> 
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
td {
padding: 5px 1em;
}
</style>";
echo '<link rel="stylesheet" href="//cdn.jsdelivr.net/gh/dmhendricks/bootstrap-grid-css@4.1.3/dist/css/bootstrap-grid.min.css" />';

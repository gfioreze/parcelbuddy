<?php

require_once('Models/DeliveryPointDataSet.php');

header('Content-type: application/json');

$deliveryPointDataSet = new DeliveryPointDataSet();

// Retrieve delivery point information
$deliveryPoints = $deliveryPointDataSet->getDeliveryPointInfo();

$jsonDeliveryPoints = json_encode($deliveryPoints);
echo $jsonDeliveryPoints;
exit();
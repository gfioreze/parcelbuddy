<?php
require_once('Models/DeliveryPointDataSet.php');

header('Content-type: application/json');
$deliveryPointDataSet = new DeliveryPointDataSet();
$deliveryPoints = $deliveryPointDataSet->getDeliveryPointInfo();
$jsonDeliveryPoints = json_encode($deliveryPoints);
echo $jsonDeliveryPoints;
exit();
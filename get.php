<?php
// Load necessary classes
require_once('Models/DeliveryPointDataSet.php');

// Instance of DeliveryPointDataSet class
$deliveryPointDataSet = new DeliveryPointDataSet();

// Retrieve delivery point information
$deliveryPoints = $deliveryPointDataSet->getDeliveryPointInfo();

// Output JSON format
header('Content-type: application/json');
$jsonDeliveryPoints = json_encode($deliveryPoints);
echo $jsonDeliveryPoints;
exit();
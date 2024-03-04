<?php
// Load necessary classes
require_once('Models/DeliveryPointDataSet.php');

// Instance of DeliveryPointDataSet class
$deliveryPointDataSet = new DeliveryPointDataSet();

// Retrieve delivery point information
$deliveryPoints = $deliveryPointDataSet->getDeliveryPointInfo();

// Output JSON format
header('Content-type: application/json');
echo json_encode($deliveryPoints);
exit();
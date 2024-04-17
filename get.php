<?php
/*This script retrieves delivery point information from the database and
returns it in JSON format. It serves as an endpoint for AJAX requests
made by the client-side code to fetch delivery point data (live search and map markers)*/

// Require DeliveryPointDataSet which provides SQL query methods
require_once('Models/DeliveryPointDataSet.php');

// Content type header indicates response is in json format
header('Content-type: application/json');
// Instance of DeliveryPointDataSet class
$deliveryPointDataSet = new DeliveryPointDataSet();
// Call to getDeliveryPointInfo to retrieve all delivery points
$deliveryPoints = $deliveryPointDataSet->getDeliveryPointInfo();
// Encode the delivery point data as json
$jsonDeliveryPoints = json_encode($deliveryPoints);
// Output the data
echo $jsonDeliveryPoints;
// Terminate the script
exit();
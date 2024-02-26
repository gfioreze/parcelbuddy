<?php
session_start();

// Include necessary classes and the header HTML template
require_once('Models/DeliveryPointDataSet.php');
require_once('Views/template/header.phtml');

// Create a view for the delete record page
$view = new stdClass();
$view->pageTitle = 'Delete record';
$deliveryPoint = new DeliveryPointDataSet();

// Check if 'id' is set in the URL and is a valid integer
if(isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the delivery point with the specified ID
    $deliveryPoint->deleteDeliveryPoint($id);
}

// Redirect to the dashboard page after deleting the record
header('Location: dashboard.php');

// Include the footer HTML template
require_once('Views/template/footer.phtml');
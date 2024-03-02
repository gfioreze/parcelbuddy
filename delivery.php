<?php
require_once('Models/DeliveryPointDataSet.php');
session_start();

// Create a view for the parcels page
$view = new stdClass();
$view->pageTitle = 'Parcels';

// Instance of DeliveryPointDataSet class
$deliveryPointDataSet = new DeliveryPointDataSet();
$view->deliveryPointStatus = $deliveryPointDataSet->getDeliveryStatus();

// Display all or only searched values
if (isset ($_GET['searchBtn'])) {
    $searchTerm = $_GET['search'];
    $view->deliveryPointDataSet = $deliveryPointDataSet->getDeliveryPointByName($searchTerm);
} else {
    $view->deliveryPointDataSet = $deliveryPointDataSet->getDeliveryPointInfo();
}

// Check if the user is not logged in
if (!isset($_SESSION['login'])) {
    // Include the login.php file for authentication
    header('Location: login.php');
    exit(); // Stop further execution
}

// Include the HTML view file for the parcels page
require_once('Views/delivery.phtml');
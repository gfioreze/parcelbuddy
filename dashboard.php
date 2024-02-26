<?php
require_once('Models/DeliveryPointDataSet.php');
session_start();

// Create a view for the dashboard page
$view = new stdClass();
$view->pageTitle = 'Dashboard';
$view->message = '';

// Instance of DeliveryPointDataSet class
$deliveryPointDataSet = new DeliveryPointDataSet();

// Display all or only searched values
if (isset ($_GET['searchBtn'])) {
    $searchTerm = $_GET['search'];
    $view->deliveryPointDataSet = $deliveryPointDataSet->getDeliveryPointByName($searchTerm);
} else {
    $view->deliveryPointDataSet = $deliveryPointDataSet->getDeliveryPointInfo();
}

// Check if the user is not logged in or is not an admin (usertype 2)
if (!isset($_SESSION['login']) || $_SESSION['usertype'] === 2) {
    // Redirect to the login page
    header('Location: login.php');
    exit(); // Stop further execution
}

// Include the HTML view file for the dashboard page
require_once('Views/dashboard.phtml');
<?php
require_once('Models/DeliveryPointDataSet.php');
session_start();

// Create a view for the parcels page
$view = new stdClass();
$view->pageTitle = 'Parcels';

// Instance of DeliveryPointDataSet class
$deliveryPointDataSet = new DeliveryPointDataSet();
$view->deliveryPointStatus = $deliveryPointDataSet->getDeliveryStatus();

// Pagination
$itemsPerPage = 10;
$totalItems = count($deliveryPointDataSet->getDeliveryPointInfo());
$totalPages = ceil($totalItems / $itemsPerPage);

$pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;
$pageNumber = max(1, min($pageNumber, $totalPages));

$view->totalPages = $totalPages;
$view->pageNumber = $pageNumber;

// Display all or only searched values
if (isset ($_GET['searchBtn'])) {
    $searchTerm = $_GET['search'];
    $view->deliveryPointDataSet = $deliveryPointDataSet->getDeliveryPointByName($searchTerm);
} else {
    //$view->deliveryPointDataSet = $deliveryPointDataSet->getDeliveryPointInfo();
    $view->deliveryPointDataSet = $deliveryPointDataSet->getPagedDeliveryPointInfo($pageNumber, $itemsPerPage);
}

// Check if the user is not logged in
if (!isset($_SESSION['login'])) {
    // Include the login.php file for authentication
    header('Location: login.php');
    exit(); // Stop further execution
}

// Include the HTML view file for the parcels page
require_once('Views/delivery.phtml');
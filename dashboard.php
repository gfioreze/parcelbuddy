<?php
require_once('Models/DeliveryPointDataSet.php');
session_start();

// Create a view for the dashboard page
$view = new stdClass();
$view->pageTitle = 'Dashboard';
$view->message = '';

// Instance of DeliveryPointDataSet class
$deliveryPointDataSet = new DeliveryPointDataSet();
$view->deliveryPointStatus = $deliveryPointDataSet->getDeliveryStatus();

// Pagination
$itemsPerPage = 10;

// Determine the total number of items based on the search results if a search is performed
if (isset($_GET['searchBtn'])) {
    $searchTerm = $_GET['search'];
    $totalItems = count($deliveryPointDataSet->getDeliveryPointBySearch($searchTerm));
} else {
    $totalItems = count($deliveryPointDataSet->getDeliveryPointInfo());
}

$totalPages = ceil($totalItems / $itemsPerPage);

$pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;
$pageNumber = max(1, min($pageNumber, $totalPages));

$view->totalPages = $totalPages;
$view->pageNumber = $pageNumber;

// Display all or only searched values
if (isset($_GET['searchBtn'])) {
    $searchTerm = $_GET['search'];
    $view->deliveryPointDataSet = $deliveryPointDataSet->getDeliveryPointBySearch($searchTerm);
} else {
    $view->deliveryPointDataSet = $deliveryPointDataSet->getPagedDeliveryPointInfo($pageNumber, $itemsPerPage);
}

// Check if the user is not logged in or is not an admin (usertype 2)
if (!isset($_SESSION['login']) || $_SESSION['usertype'] === 2) {
    // Redirect to the login page
    header('Location: login.php');
    exit(); // Stop further execution
}

// Include the HTML view file for the dashboard page
require_once('Views/dashboard.phtml');

<?php
require_once('Models/DeliveryPointDataSet.php');
session_start();

// Create a view for the dashboard page
$view = new stdClass();
$view->pageTitle = 'Parcel';
$view->message = '';

// Instance of DeliveryPointDataSet class
$deliveryPointData = new DeliveryPointDataSet();

// Check if the parcel ID is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    //$parcelID = $_GET['id'];
    $parcelID = filter_input(INPUT_GET, 'id');
    $singleDeliveryPointData = $deliveryPointData->getSingleDeliveryPoint($parcelID);

    if (!isset($_SESSION['login'])) {
        // Redirect to the login page
        header('Location: login.php');
        exit(); // Stop further execution
    } else {
        require_once('Views/parcel.phtml');
    }
}
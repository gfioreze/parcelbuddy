<?php
require_once('Models/DeliveryPointDataSet.php');
session_start();

// Create a view for the dashboard page
$view = new stdClass();
$view->pageTitle = 'Parcel';
$view->message = '';
$parcelID = filter_input(INPUT_GET, 'id');

// Instance of DeliveryPointDataSet class
$deliveryPointData = new DeliveryPointDataSet();
$singleDeliveryPointData = $deliveryPointData->getSingleDeliveryPoint($parcelID);

// Check if the parcel ID is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    //$parcelID = $_GET['id'];
    $parcelID = filter_input(INPUT_GET, 'id');
    $singleDeliveryPointData = $deliveryPointData->getSingleDeliveryPoint($parcelID);
    //$view->singleDeliveryPointData;

    if (!isset($_SESSION['login'])) {
        // Redirect to the login page
        header('Location: login.php');
        exit(); // Stop further execution
    } else {
        require_once('Views/parcel.phtml');
    }
}
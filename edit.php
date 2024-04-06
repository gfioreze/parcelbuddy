<?php
session_start();

// Include necessary classes for user and delivery data
require_once('Models/UserDataSet.php');
require_once('Models/DeliveryPointDataSet.php');

// Create a view for the edit parcel entry page
$view = new stdClass();
$view->pageTitle = 'Edit parcel entry';
$view->message = '';
$id = $recipient = $address1 = $address2 = $postcode = $lat = $long = $deliverer = $status = '';
$userData = new UserDataSet();
$view->userDataSet = $userData->getAllDeliverers();
$deliveryPointData = new DeliveryPointDataSet();
$view->statusOptions = $deliveryPointData->getDeliveryStatus();

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Validate and retrieve the 'id' parameter from the URL
    $id = filter_input(INPUT_GET, 'id');
    // Fetch the current data values for the specified delivery point
    $deliveryPointInfo = $deliveryPointData->getSingleDeliveryPoint($id);
    if ($deliveryPointInfo) {
        // Populate variables with retrieved values
        $recipient = $deliveryPointInfo['name'];
        $address1 = $deliveryPointInfo['address_1'];
        $address2 = $deliveryPointInfo['address_2'];
        $postcode = $deliveryPointInfo['postcode'];
        $lat = $deliveryPointInfo['lat'];
        $long = $deliveryPointInfo['long'];
        $deliverer = $deliveryPointInfo['deliverer'];
        $status = $deliveryPointInfo['status'];
    }
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $recipient = $_POST['recipient'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $postcode = $_POST['postcode'];
    $lat = $_POST['lat'];
    $long = $_POST['long'];
    $deliverer = $_POST['deliverer'];
    $status = $_POST['status'];

    // Instance of DeliveryPointDataSet class
    $deliveryData = new DeliveryPointDataSet();

    // Update the delivery point using the provided data
    $addDeliveryPoint = $deliveryData->updateDeliveryPoint($recipient, $address1, $address2, $postcode, $deliverer, $lat, $long, $status, $id);

    // Check if any rows were affected
    if ($addDeliveryPoint > 0) {
        $view->message = '<p class="text-success">' . 'Delivery point updated successfully' . '</p>';
    } else {
        $view->message = '<p class="text-danger">' . 'No rows affected' . '</p>';
    }
}

// Include the HTML view file for the edit parcel entry page
require_once('Views/edit.phtml');
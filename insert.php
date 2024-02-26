<?php
session_start();

require_once('Models/UserDataSet.php');
require_once('Models/DeliveryPointDataSet.php');

$view = new stdClass();
$view->pageTitle = 'Insert parcel entry';
$view->message = '';
$deliveryData = '';
$errors = [];
$recipient = $address1 = $address2 = $postcode = $lat = $long = $deliverer = $status = '';
$userData = new UserDataSet();
$view->userDataSet = $userData->getAllDeliverers();
$deliveryPointData = new DeliveryPointDataSet();
$view->statusOptions = $deliveryPointData->getDeliveryStatus();

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $ok = true;

    // Check if recipient is set and not empty
    if (!isset($_POST['recipient']) || $_POST['recipient'] === '') {
        $ok = false;
        $errors[] = 'Recipient name cannot be empty';
    } else {
        $recipient = $_POST['recipient'];
    }

    // Check if address1 is set and not empty
    if (!isset($_POST['address1']) || $_POST['address1'] === '') {
        $ok = false;
        $errors[] = 'Address line 1 cannot be empty';
    } else {
        $address1 = $_POST['address1'];
    }

    // Check if address2 is set and not empty
    if (!isset($_POST['address2']) || $_POST['address2'] === '') {
        $ok = false;
        $errors[] = 'Address line 2 cannot be empty';
    } else {
        $address2 = $_POST['address2'];
    }

    // Check if postcode is set and not empty
    if (!isset($_POST['postcode']) || $_POST['postcode'] === '') {
        $ok = false;
        $errors[] = 'Postcode cannot be empty';
    } else {
        $postcode = $_POST['postcode'];
    }

    // Check if lat is set and not empty
    if (!isset($_POST['lat']) || $_POST['lat'] === '') {
        $ok = false;
        $errors[] = 'Latitude cannot be empty';
    } else {
        $lat = $_POST['lat'];
    }

    // Check if long is set and not empty
    if (!isset($_POST['long']) || $_POST['long'] === '') {
        $ok = false;
        $errors[] = 'Longitude cannot be empty';
    } else {
        $long = $_POST['long'];
    }

    if(!isset($_POST['deliverer']) || $_POST['deliverer'] === '') {
        $ok = false;
        $errors[] = 'Please choose a deliverer';
    } else {
        $deliverer = $_POST['deliverer'];
    }

    // Check if status is set and not empty
    if (!isset($_POST['status']) || $_POST['status'] === '') {
        $ok = false;
        $errors[] = 'Please choose a status';
    } else {
        // Map status values to corresponding numeric values
        $status = $_POST['status'];
    }

    // If all data is valid, add the new delivery point
    if ($ok) {
        $deliveryData = new DeliveryPointDataSet();
        $addDeliveryPoint = $deliveryData->addNewDeliveryPoint($recipient, $address1, $address2, $postcode, $lat, $long, $deliverer, $status);
        $view->message = '<p class="text-success">' . 'Delivery point added successfully' . '</p>';
    } else {
        $view->message = '<p class="text-danger">' . 'No rows affected: blank fields are not allowed' . '</p>';
    }
}

require_once('Views/insert.phtml'); // Include the HTML view file
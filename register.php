<?php
session_start();

require_once('Models/UserDataSet.php');

$view = new stdClass();
$view->pageTitle = 'Register';
$view->message = '';

if (isset($_POST['submit'])) {
    $ok = true;

    // Check if the full name is set and not empty
    if (!isset($_POST['full_name']) || $_POST['full_name'] === '') {
        $ok = false;
    } else {
        $fullName = $_POST['full_name'];
    }

    // Check if the username is set and not empty
    if (!isset($_POST['username']) || $_POST['username'] === '') {
        $ok = false;
    } else {
        $username = $_POST['username'];
    }

    // Check if the email is set and not empty
    if (!isset($_POST['email']) || $_POST['email'] === '') {
        $ok = false;
    } else {
        $email = $_POST['email'];
    }

    // Check if the password is set and not empty
    if (!isset($_POST['password']) || $_POST['password'] === '') {
        $ok = false;
    } else {
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    }

    // If all data is valid, add the new user
    if ($ok) {
        $userData = new UserDataSet();
        $addNewUser = $userData->addUser($fullName, $username, $hash, $email);
        $view->message = '<p class="text-success">' . 'User registered with success' . '</p>';
    }
}

require_once('Views/register.phtml'); // Include the HTML view file
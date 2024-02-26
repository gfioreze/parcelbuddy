<?php
session_start();

$view = new stdClass();
$view->pageTitle = 'Log out';

// Check if a user is logged in
if (isset($_SESSION['username']) && ($_SESSION['login'])) {
    // Unset and destroy the session variables
    unset($_SESSION['username']);
    unset($_SESSION['login']);
    //session_destroy();

    // Redirect to the index page after logout
    header('Location: index.php');
}

require_once('Views/logout.phtml'); // Include the HTML view file
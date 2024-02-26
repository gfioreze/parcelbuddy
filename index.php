<?php
session_start();

// Create a view for the home page
$view = new stdClass();
$view->pageTitle = 'Home';

// Include the login.php file for any necessary login logic
require_once('login.php');

// Include the HTML view file for the home page
require_once('Views/index.phtml');
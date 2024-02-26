<?php
require_once('Models/UserDataSet.php');
require_once('Models/UserData.php');

// Create a view for the login page
$view = new stdClass();
$view->pageTitle = 'Login';
$view->message = '';

// Check if the login form is submitted
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Instance of UserDataSet Class
    $userDataSet = new UserDataSet();

    // Get user data based on the provided username and password
    $user = $userDataSet->getLoginData($username, $password);

    // Check if the user exists and has the user type 1 (admin)
    if (($user != null) && ($user->getUserType() === 1)) {
        // Set session variables for admin user
        $_SESSION['username'] = $username;
        $_SESSION['login'] = 'true';
        $_SESSION['usertype'] = $user->getUserType();
        $view->message = '<p class="text-success">' . 'Welcome' .  $user->getUserName() . '</p>';
        header('Location: dashboard.php'); // Redirect to the dashboard for admin users
    }
    // Check if the user exists and has a user type other than 1 (not admin)
    elseif (($user != null) && ($user->getUserType() != 1)) {
        // Set session variables for non-admin users
        $_SESSION['username'] = $username;
        $_SESSION['login'] = 'true';
        $_SESSION['usertype'] = $user->getUserType();
        $view->message = '<p class="text-success">' . 'Welcome' .  $user->getUserName() . '</p>';
        header('Location: delivery.php'); // Redirect to the delivery page for non-admin users
    }
    // Invalid user or login credentials
    else {
        // Display an error message on the login page
        $view->message = 'Invalid username or password';
    }
}

require_once('Views/login.phtml'); // Include the HTML view file
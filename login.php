<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('Models/UserDataSet.php');
require_once('Models/UserData.php');

$view = new stdClass();
$view->pageTitle = 'Login';
$view->message = '';

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $userDataSet = new UserDataSet();

    // Fetch user by username
    $user = $userDataSet->getUser($username);

    if ($user !== null && password_verify($password, $user->getPassword())) {
        $_SESSION['username'] = $user->getUserName();
        $_SESSION['login'] = true;
        $_SESSION['usertype'] = $user->getUserType();

        if ($user->getUserType() === 1) {
            header('Location: dashboard.php');
        } else {
            header('Location: delivery.php');
        }
        exit;
    } else {
        $view->message = '<p class="text-danger">Invalid username or password</p>';
    }
}

require_once('Views/login.phtml');
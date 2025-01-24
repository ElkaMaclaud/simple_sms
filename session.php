<?php
session_start();

function isLoggedIn() {
    // var_dump($_SESSION);
    return isset($_SESSION['user_id']);
}

function login($user_id) {
    $_SESSION['user_id'] = $user_id;
}

function logout() {
    session_destroy();
    header('Location: index.php');
    exit;
}
?>
<?php
$title = "Login";
session_start();
include 'session.php';
include 'auth.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = authenticateUser($username, $password);
    if ($user) {
        login($user['username']);
        header('Location: index.php');
        exit;
    } else {
        $error = "Неверные учетные данные.";
    }
}

include_once "blocks/header.php";
?>

    <h1>Login</h1><br>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <div class="container mt-2">
        <form method="post">
            <input type="text" name="username" placeholder="Username" required  class="form-control"><br>
            <input type="password" name="password" placeholder="Password" required  class="form-control"><br>
            <button type="submit" class="btn btn-success">Login</button>
        </form><br>
    </div>
    <a href="register.php">Don't have an account? Register</a>

<?php 
require_once "blocks/footer.php";
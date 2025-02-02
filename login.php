<?php
$title = "Login";
include 'session.php';
include 'auth.php';
include 'db.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $user = authenticateUser($pdo ,$name, $password);
    if ($user) {
        login($user['name']);
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
            <input type="text" name="name" placeholder="name" required  class="form-control"><br>
            <input type="password" name="password" placeholder="Password" required  class="form-control"><br>
            <button type="submit" class="btn btn-success">Login</button>
        </form><br>
    </div>
    <a href="register.php">Don't have an account? Register</a>

<?php 
require_once "blocks/footer.php";
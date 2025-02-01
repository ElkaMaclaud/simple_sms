<?php
include 'session.php';
include 'auth.php';
$title = "Register";

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];

    if (registerUser($name, $password)) {
        header('Location: login.php');
        exit;
    } else {
        $error = "Пользователь с таким именем уже существует.";
    }
}

include_once "blocks/header.php"
?>
    <h1>Register</h1><br>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <div class="container mt-2">
        <form method="post">
            <input type="text" name="name" placeholder="name" required  class="form-control"><br>
            <input type="password" name="password" placeholder="Password" required  class="form-control"><br>
            <button type="submit" class="btn btn-success">Register</button>
        </form><br>
    </div>
    <a href="login.php">Already have an account? Login</a>
<?php 
require_once "blocks/footer.php";
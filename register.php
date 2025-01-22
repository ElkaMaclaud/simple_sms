<?php
include 'session.php';
include 'auth.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (registerUser($username, $password)) {
        header('Location: login.php');
        exit;
    } else {
        $error = "Пользователь с таким именем уже существует.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <a href="login.php">Already have an account? Login</a>
</body>
</html>
<?php
include 'session.php';
if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}
include 'auth.php'; 
$posts = json_decode(file_get_contents('data/posts.json'), true) ?: [];
$index = $_GET['index'] ?? null;
$post = $posts[$index] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
    <a href="index.php">Back to Posts</a>
</body>
</html>
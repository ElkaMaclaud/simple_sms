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

include_once "blocks/header.php";
?>

    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
    <a href="index.php">Back to Posts</a>

<?php
    require_once "blocks/footer.php";

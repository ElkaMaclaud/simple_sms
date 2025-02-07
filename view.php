<?php
include 'session.php';
include 'db.php';
if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}
include 'auth.php'; 

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Неверный идентификатор поста.");
}

$postId = (int)$_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->execute(['id' => $postId]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC); 

    if (!$post) {
        die("Пост не найден.");
    }
} catch(PDOException $e) {
    die("Ошибка при получении постов: " . $e->getMessage());
}

include_once "blocks/header.php";
?>

    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <p class="text"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
    <a href="index.php">Back to Posts</a>

<?php
    require_once "blocks/footer.php";

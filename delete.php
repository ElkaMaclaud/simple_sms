<?php
include 'session.php';
include 'db.php';
$title = "Delete";
if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}
include 'auth.php'; 
$postId = (int)$_GET['id'];
try {
    $stmt = $pdo->prepare("delete from posts WHERE id = :postId");
    $stmt->execute(['postId' => $postId]);

    if ($stmt->rowCount() === 0) {
        die("Пост не найден или уже удалён.");
    } else {
        echo "Пост успешно удалён.";
    }
} catch(PDOException $e) {
    die("Ошибка при удалении поста: " . $e->getMessage());
}

// if ($index !== null && isset($posts[$index])) {
//     unset($posts[$index]);
//     file_put_contents('data/posts.json', json_encode(array_values($posts)));
// }
header('Location: index.php');
exit;
?>
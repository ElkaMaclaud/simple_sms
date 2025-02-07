<?php
include 'session.php';
include "db.php";
$title = "Edit Post";

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}
include 'auth.php'; 
$postId = (int)$_GET['id'];

// $posts = json_decode(file_get_contents('data/posts.json'), true) ?: [];
// $index = $_GET['index'] ?? null;
// $post = $posts[$index] ?? null;
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("update posts set title=:title, content=:content where id=:postId");
    
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        echo 'Ошибка при вставке данных.';
    }
}

    include_once "blocks/header.php";
?>  
    
    <h1>Edit Post</h1>
    <form method="post">
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required  class="form-control"><br/>
        <textarea name="content" required   class="form-control"><?php echo htmlspecialchars($post['content']); ?></textarea><br/>
        <button type="submit"  class="btn btn-success">Save</button>
    </form><br/>
    <a href="index.php">Back to Posts</a>
<?php
    require_once "blocks/footer.php";
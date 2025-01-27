<?php
include 'session.php';
$title = "Create";
session_start();

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}
include 'auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $posts = json_decode(file_get_contents('data/posts.json'), true) ?: [];
    $newPost = [
        'title' => $_POST['title'],
        'content' => $_POST['content']
    ];
    $posts[] = $newPost;
    file_put_contents('data/posts.json', json_encode($posts));
    header('Location: index.php');
    exit;
}
?>
    <h1>Create Post</h1>
    <form method="post">
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        <button type="submit">Save</button>
    </form>
    <a href="index.php">Back to Posts</a>
    <?php
    require_once "blocks/footer.php";

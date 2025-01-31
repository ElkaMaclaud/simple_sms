<?php
include 'session.php';
session_start();
$title = "Edit Post";

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}
include 'auth.php'; 

$posts = json_decode(file_get_contents('data/posts.json'), true) ?: [];
$index = $_GET['index'] ?? null;
$post = $posts[$index] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post['title'] = $_POST['title'];
    $post['content'] = $_POST['content'];
    $posts[$index] = $post;
    file_put_contents('data/posts.json', json_encode($posts));
    header('Location: index.php');
    exit; 
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
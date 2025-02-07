<?php

require_once __DIR__ . '/db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'session.php';
include 'db.php';
$title = "Simple CMS";

try {
    $stmt = $pdo->query("select title, id from posts order by created_at desc");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Ошибка при получении постов: " . $e->getMessage());
}

include_once "blocks/header.php";
?>
    
    <h1>Posts</h1>
    <?php if (isLoggedIn()): ?>
        <div class="welcome-message">
        <h3>Welcome, <?php echo htmlspecialchars($_SESSION['user_id']); ?>!</h3> <a href="logout.php">Logout</a></div>
        <a href="create.php">Create New Post</a>
    <?php else: ?>
        <a href="login.php">Login</a> | <a href="register.php">Register</a>
    <?php endif; ?>
    <div>
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <div class="wrapperLinkContainer">
                <button class="wrapperLink">
                    <a href="view.php?id=<?php echo $post['id']; ?>">
                        <?php echo htmlspecialchars($post['title']); ?>
                    </a>
                </button>
                <?php if (isLoggedIn()): ?>
                    - <button class="wrapperLink">
                        <a href="edit.php?id=<?php echo $post['id']; ?>">Edit</a>
                    </button>
                    - <button class="wrapperLink">
                        <a href="delete.php?id=<?php echo $post['id']; ?>">Delete</a>
                    </button>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No posts available.</p>
    <?php endif; ?>
</div>
<?php 
require_once "blocks/footer.php";
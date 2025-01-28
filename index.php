<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'session.php';
$title = "Simple CMS";
$posts = json_decode(file_get_contents('data/posts.json'), true) ?: [];


include_once "blocks/header.php";
?>
    
    <h1>Posts</h1>
    <?php if (isLoggedIn()): ?>
        <div class="welcome-message">
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['user_id']); ?>!</p> <a href="logout.php">Logout</a></div>
        <a href="create.php">Create New Post</a>
    <?php else: ?>
        <a href="login.php">Login</a> | <a href="register.php">Register</a>
    <?php endif; ?>
    <ul>
        <?php foreach ($posts as $index => $post): ?>
            <li>
                <a href="view.php?index=<?php echo $index; ?>"><?php echo htmlspecialchars($post['title']); ?></a>
                <?php if (isLoggedIn()): ?>
                    - <a href="edit.php?index=<?php echo $index; ?>">Edit</a>
                    - <a href="delete.php?index=<?php echo $index; ?>">Delete</a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php 
require_once "blocks/footer.php";
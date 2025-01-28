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
        <h3>Welcome, <?php echo htmlspecialchars($_SESSION['user_id']); ?>!</h3> <a href="logout.php">Logout</a></div>
        <a href="create.php">Create New Post</a>
    <?php else: ?>
        <a href="login.php">Login</a> | <a href="register.php">Register</a>
    <?php endif; ?>
    <div>
        <?php foreach ($posts as $index => $post): ?>
            <div class="wrapperLinkContainer">
                <button class="wrapperLink"><a href="view.php?index=<?php echo $index; ?>"><?php echo htmlspecialchars($post['title']); ?></a></button>
                <?php if (isLoggedIn()): ?>
                    - <button class="wrapperLink"><a href="edit.php?index=<?php echo $index; ?>">Edit</a></button>
                    - <button class="wrapperLink"><a href="delete.php?index=<?php echo $index; ?>">Delete</a></button>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php 
require_once "blocks/footer.php";
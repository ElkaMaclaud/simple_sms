<?php
include 'session.php';
$posts = json_decode(file_get_contents('data/posts.json'), true) ?: [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple CMS</title>
</head>
<body>
    <h1>Posts</h1>
    <?php if (isLoggedIn()): ?>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['user_id']); ?>! <a href="logout.php">Logout</a></p>
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
</body>
</html>
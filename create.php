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
include_once "blocks/header.php";
?>
    <h1>Create Post</h1>
    <form method="post">
        <input type="text" name="title" class="form-control"><br>
        <textarea name="content" required  class="form-control"></textarea><br>
        <button type="submit" class="btn btn-success">Save</button>
    </form><br/>
    <a href="index.php">Back to Posts</a>
    <?php
    require_once "blocks/footer.php";

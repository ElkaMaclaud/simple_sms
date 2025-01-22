<?php
include 'session.php';
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
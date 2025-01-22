<?php
include 'session.php';
if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}
include 'auth.php'; 
$posts = json_decode(file_get_contents('data/posts.json'), true) ?: [];
$index = $_GET['index'] ?? null;

if ($index !== null && isset($posts[$index])) {
    unset($posts[$index]);
    file_put_contents('data/posts.json', json_encode(array_values($posts)));
}
header('Location: index.php');
exit;
?>
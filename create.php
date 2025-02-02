<?php
include 'session.php';
include 'db.php';
$title = "Create";
session_start();

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}
include 'auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $posts = json_decode(file_get_contents('data/posts.json'), true) ?: [];
    // $newPost = [
    //     'title' => $_POST['title'],
    //     'content' => $_POST['content']
    // ];
    // $posts[] = $newPost;
    // file_put_contents('data/posts.json', json_encode($posts));
    // Подготовка данных для вставки
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");
    
    // Привязка параметров
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);

    // Выполнение запроса
    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        echo 'Ошибка при вставке данных.';
    }
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

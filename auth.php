<?php

function registerUser($db, $username, $password) {
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $userExists = $stmt->fetchColumn();

    if ($userExists) {
        return false; 
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->execute([
        ':username' => $username,
        ':password' => $hashedPassword
    ]);

    return true;
}
function authenticateUser($db, $username, $password) {

    $stmt = $db->prepare("SELECT * FROM users WHERE username = $1");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $user; 
    }

    return false; 
}

?>




<!-- function registerUser($username, $password) {
    $users = json_decode(file_get_contents('data/users.json'), true) ?: [];
    
    // Проверка на существование пользователя
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return false; // Пользователь уже существует
        }
    }

    // Хеширование пароля
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $users[] = [
        'username' => $username,
        'password' => $hashedPassword
    ];
    file_put_contents('data/users.json', json_encode($users));
    return true;
}

function authenticateUser($username, $password) {
    $users = json_decode(file_get_contents('data/users.json'), true) ?: [];
    
    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            return $user; // Успешная аутентификация
        }
    }
    return false; // Неверные учетные данные
} -->
<?php

function registerUser($db, $name, $password) {
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE name = :name");
    $stmt->execute([':name' => $name]);
    $userExists = $stmt->fetchColumn();

    if ($userExists) {
        return false; 
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (name, password) VALUES (:name, :password)");
    $stmt->execute([
        ':name' => $name,
        ':password' => $hashedPassword
    ]);

    return true;
}
function authenticateUser($db, $name, $password) {

    $stmt = $db->prepare("SELECT * FROM users WHERE name = :name");
    $stmt->execute([$name]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // if ($user && password_verify($password, $user['password'])) {
    //     return $user; 
    // }
    if ($user && $password === $user['password']) {
        return $user;
    }

    return false; 
}

?>




<!-- function registerUser($name, $password) {
    $users = json_decode(file_get_contents('data/users.json'), true) ?: [];
    
    // Проверка на существование пользователя
    foreach ($users as $user) {
        if ($user['name'] === $name) {
            return false; // Пользователь уже существует
        }
    }

    // Хеширование пароля
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $users[] = [
        'name' => $name,
        'password' => $hashedPassword
    ];
    file_put_contents('data/users.json', json_encode($users));
    return true;
}

function authenticateUser($name, $password) {
    $users = json_decode(file_get_contents('data/users.json'), true) ?: [];
    
    foreach ($users as $user) {
        if ($user['name'] === $name && password_verify($password, $user['password'])) {
            return $user; // Успешная аутентификация
        }
    }
    return false; // Неверные учетные данные
} -->
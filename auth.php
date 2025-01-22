<?php

function registerUser($username, $password) {
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
}

?>
<?php
require_once __DIR__ . '/config.php';

// Перевіряє, чи залогінений користувач
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Перевіряє, чи має юзер роль адміністратора
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Перенаправлення на сторінку логіну, якщо не залогінений
function ensureLoggedIn() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}
?>

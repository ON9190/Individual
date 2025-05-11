<?php
// admin/index.php

// Підключаємо функції, сесію та БД
require_once __DIR__ . '/../functions.php';

// Якщо не залогінений — кидаємо на форму адмін-входу
ensureLoggedIn();
if (!isAdmin()) {
    header('Location: ../admin.php');
    exit;
}

// Підключаємо шапку та бічне меню адмінки
include __DIR__ . '/include/header.php';
include __DIR__ . '/include/sidebar.php';
?>

<main class="admin-container">
  <h1>Панель адміністратора</h1>
  <p>Ласкаво просимо, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>!</p>
  <ul class="admin-menu">
    <li><a href="entries.php">📝 Керування записами</a></li>
    <li><a href="users.php">👥 Керування користувачами</a></li>
    <li><a href="../index.php">🔙 Повернутися на сайт</a></li>
    <li><a href="../logout.php">🚪 Вийти</a></li>
  </ul>
</main>

<?php
// Підключаємо підвал адмінки
include __DIR__ . '/include/footer.php';

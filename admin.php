<?php
// admin.php

// 1) Безпечні налаштування сесії
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);


// 2) Підключаємо функції й БД
require_once __DIR__ . '/functions.php';

// 3) Ініціалізуємо змінні
$error = '';

// 4) Генеруємо CSRF-токен, якщо його ще немає
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// 5) Обробка форми входу
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 5.1 Перевірка CSRF
    if (empty($_POST['csrf_token']) || 
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $error = 'Невірний CSRF-токен.';
    } else {
        // 5.2 Зчитуємо дані
        $username = trim($_POST['username']   ?? '');
        $password =           $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $error = 'Всі поля обов’язкові.';
        } else {
            // 5.3 Шукаємо лише адміністраторів
            $stmt = $mysqli->prepare("
                SELECT id, password_hash 
                  FROM users 
                 WHERE username = ? AND role = 'admin'
            ");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($row = $res->fetch_assoc()) {
                // 5.4 Перевірка пароля
                if (password_verify($password, $row['password_hash'])) {
                    // 5.5 Успішний вхід — регенеруємо сесію
                    session_regenerate_id(true);
                    $_SESSION['user_id']  = $row['id'];
                    $_SESSION['username'] = $username;
                    $_SESSION['role']     = 'admin';
                    header('Location: admin/');
                    exit;
                }
            }
            $error = 'Невірний логін або пароль.';
        }
    }
}

// 6) Підключаємо шапку адмінки (і тут же admin.css)
include __DIR__ . '/admin/include/header.php';
?>

  <h2>Вхід для адміністратора</h2>

  <?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="post" class="admin-form">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
    <label>
      Логін:<br>
      <input type="text" name="username" required>
    </label><br><br>
    <label>
      Пароль:<br>
      <input type="password" name="password" required>
    </label><br><br>
    <button type="submit">Увійти</button>
  </form>

<?php
// 7) Підключаємо підвал адмінки
include __DIR__ . '/admin/include/footer.php';

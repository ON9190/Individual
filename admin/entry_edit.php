<?php
// admin/entry_edit.php
require_once __DIR__ . '/../functions.php';
ensureLoggedIn();
if (!isAdmin()) {
    header('Location: ../admin.php');
    exit;
}

$error = '';
$id    = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null;
$title = '';
$body  = '';

// Якщо редагуємо — підтягуємо існуючі дані
if ($id) {
    $stmt = $mysqli->prepare("
      SELECT title, body
        FROM entries
       WHERE id = ?
    ");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows === 0) {
        header('Location: entries.php');
        exit;
    }
    $row = $res->fetch_assoc();
    $title = $row['title'];
    $body  = $row['body'];
}

// Обробка форми
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $body  = trim($_POST['body']  ?? '');

    if ($title === '' || $body === '') {
        $error = 'Обидва поля — заголовок і текст — обов’язкові.';
    } else {
        if ($id) {
            // Оновлення
            $stmt = $mysqli->prepare("
              UPDATE entries
                 SET title = ?, body = ?
               WHERE id    = ?
            ");
            $stmt->bind_param('ssi', $title, $body, $id);
            $stmt->execute();
        } else {
            // Створення
            $stmt = $mysqli->prepare("
              INSERT INTO entries (user_id, title, body, created_at)
              VALUES (?, ?, ?, NOW())
            ");
            // записуємо під поточним адміном
            $stmt->bind_param('iss', $_SESSION['user_id'], $title, $body);
            $stmt->execute();
        }
        header('Location: entries.php');
        exit;
    }
}

// Підключаємо шаблони
include __DIR__ . '/include/header.php';
include __DIR__ . '/include/sidebar.php';
?>

<main class="admin-container">
  <h1><?= $id ? 'Редагувати' : 'Додати' ?> запис</h1>
  <?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
  <form method="post" class="admin-form">
    <label>
      Заголовок:<br>
      <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required>
    </label>
    <br><br>
    <label>
      Текст:<br>
      <textarea name="body" rows="10" required><?= htmlspecialchars($body) ?></textarea>
    </label>
    <br><br>
    <button type="submit"><?= $id ? 'Зберегти зміни' : 'Створити запис' ?></button>
    <a href="entries.php" class="btn">⟵ Назад</a>
  </form>
</main>

<?php include __DIR__ . '/include/footer.php'; ?>

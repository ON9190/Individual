<?php
// admin/entries.php
require_once __DIR__ . '/../functions.php';
ensureLoggedIn();
if (!isAdmin()) {
    header('Location: ../admin.php');
    exit;
}

// Видалення запису
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $delId = (int)$_GET['delete'];
    $stmt = $mysqli->prepare("DELETE FROM entries WHERE id = ?");
    $stmt->bind_param('i', $delId);
    $stmt->execute();
    header('Location: entries.php');
    exit;
}

// Підключаємо шаблони
include __DIR__ . '/include/header.php';
include __DIR__ . '/include/sidebar.php';

// Вибираємо всі записи
$res = $mysqli->query("
    SELECT e.id, e.title, u.username, e.created_at
      FROM entries e
      JOIN users u ON e.user_id = u.id
     ORDER BY e.created_at DESC
");
?>

<main class="admin-container">
  <h1>Керування записами</h1>
  <p><a href="entry_edit.php" class="btn">➕ Додати новий запис</a></p>
  <table class="admin-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Заголовок</th>
        <th>Автор</th>
        <th>Дата</th>
        <th>Дії</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = $res->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= date('d.m.Y H:i', strtotime($row['created_at'])) ?></td>
        <td>
          <a href="entry_edit.php?id=<?= $row['id'] ?>">✏️</a>
          <a href="entries.php?delete=<?= $row['id'] ?>"
             onclick="return confirm('Видалити запис #<?= $row['id'] ?>?')">🗑️</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</main>

<?php include __DIR__ . '/include/footer.php'; ?>

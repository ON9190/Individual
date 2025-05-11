<?php
require_once 'functions.php';
ensureLoggedIn();
include 'includes/header.php';

// --- Оновлення профілю ---
$profile_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Зміна імені
    $new_username = trim($_POST['username'] ?? '');
    if ($new_username && $new_username !== $_SESSION['username']) {
        $stmt = $mysqli->prepare("UPDATE users SET username = ? WHERE id = ?");
        $stmt->bind_param('si', $new_username, $_SESSION['user_id']);
        if ($stmt->execute()) {
            $_SESSION['username'] = $new_username;
            $profile_message .= "Ім'я оновлено. ";
        }
    }
    // Зміна пароля
    if (!empty($_POST['password'])) {
        $new_password = $_POST['password'];
        $hash = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
        $stmt->bind_param('si', $hash, $_SESSION['user_id']);
        if ($stmt->execute()) {
            $profile_message .= "Пароль оновлено. ";
        }
    }
    // Завантаження аватара (простий варіант)
    if (!empty($_FILES['avatar']['name'])) {
        $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif'];
        if (in_array($ext, $allowed)) {
            $avatar_path = 'assets/img/avatar_' . $_SESSION['user_id'] . '.' . $ext;
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar_path)) {
                $stmt = $mysqli->prepare("UPDATE users SET avatar = ? WHERE id = ?");
                $stmt->bind_param('si', $avatar_path, $_SESSION['user_id']);
                $stmt->execute();
                $profile_message .= "Аватар оновлено. ";
            }
        } else {
            $profile_message .= "Дозволені лише jpg, png, gif. ";
        }
    }
}

// --- Отримуємо дані користувача ---
$stmt = $mysqli->prepare("
  SELECT username, created_at, avatar
  FROM users
  WHERE id = ?
");
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Кількість дописів
$stmt = $mysqli->prepare("SELECT COUNT(*) FROM entries WHERE user_id = ?");
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($post_count);
$stmt->fetch();
$stmt->close();

// Власні дописи
$entries = [];
$stmt = $mysqli->prepare("SELECT id, title, DATE_FORMAT(created_at, '%d.%m.%Y') AS date FROM entries WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $entries[] = $row;
}

// Аватар
$avatar = (!empty($user['avatar']) && file_exists($user['avatar'])) ? $user['avatar'] : 'assets/img/avatar-placeholder.png';
?>

<section class="profile">
  <div class="profile-header">
    <div class="profile-avatar">
      <img src="<?= htmlspecialchars($avatar) ?>" alt="Аватар" />
    </div>
    <div class="profile-info">
      <h2><?= htmlspecialchars($user['username']) ?></h2>
      <div class="profile-stats">
        <span><strong><?= $post_count ?></strong> дописів</span>
        <span><strong>0</strong> підписників</span> <!-- Заглушка -->
      </div>
      <button class="profile-edit-btn" id="editProfileBtn">Редагувати обліковий запис</button>
      <?php if ($profile_message): ?>
        <div class="profile-message"><?= htmlspecialchars($profile_message) ?></div>
      <?php endif; ?>
      <div class="profile-edit-menu" id="editProfileMenu">
        <form method="post" enctype="multipart/form-data">
          <label>Ім'я користувача:<br>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>">
          </label><br>
          <label>Завантажити аватар:<br>
            <input type="file" name="avatar" accept="image/*">
          </label><br>
          <label>Новий пароль:<br>
            <input type="password" name="password">
          </label><br>
          <button type="submit">Зберегти</button>
        </form>
      </div>
      <div class="profile-meta">
        <span>Реєстрація: <?= date('d.m.Y', strtotime($user['created_at'])) ?></span>
      </div>
    </div>
  </div>

  <h3>Ваші дописи</h3>
  <div class="profile-entries-grid">
    <?php if (count($entries)): ?>
      <?php foreach ($entries as $entry): ?>
        <div class="profile-entry-card">
          <a href="entry.php?id=<?= $entry['id'] ?>">
            <h4><?= htmlspecialchars($entry['title']) ?></h4>
            <time><?= $entry['date'] ?></time>
          </a>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>У вас ще немає дописів.</p>
    <?php endif; ?>
  </div>
</section>

<script>
document.getElementById('editProfileBtn').addEventListener('click', function() {
  document.getElementById('editProfileMenu').classList.toggle('open');
});
</script>

<footer class="site-footer">
    <div class="footer-content">
        <!-- тут ваші секції футера -->
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 Всі права захищені</p>
    </div>
</footer>

<?php include 'includes/footer.php'; ?>

<?php
require_once 'functions.php';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $username = trim($_POST['username']);
  $password = $_POST['password'];
  if ($username && $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("
      INSERT INTO users (username, password_hash, role, created_at)
      VALUES (?, ?, 'user', NOW())
    ");
    $stmt->bind_param('ss', $username, $hash);
    if ($stmt->execute()) {
      header('Location: login.php');
      exit;
    } else {
      $error = 'Помилка реєстрації';
    }
  } else {
    $error = 'Всі поля обов’язкові';
  }
}
include 'includes/header.php';
?>
<h2>Реєстрація</h2>
<?php if (!empty($error)): ?>
  <p class="error"><?=$error?></p>
<?php endif; ?>
<form method="post">
  <label>Логін:<input type="text" name="username" required></label><br>
  <label>Пароль:<input type="password" name="password" required></label><br>
  <button type="submit">Зареєструватися</button>
</form>
<?php include 'includes/footer.php'; ?>

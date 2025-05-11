<?php
require_once 'functions.php';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $username = trim($_POST['username']);
  $password = $_POST['password'];
  $stmt = $mysqli->prepare("
    SELECT id, password_hash, role
    FROM users
    WHERE username = ?
  ");
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $res = $stmt->get_result();
  if ($row = $res->fetch_assoc()) {
    if (password_verify($password, $row['password_hash'])) {
      $_SESSION['user_id']   = $row['id'];
      $_SESSION['username']  = $username;
      $_SESSION['role']      = $row['role'];
      header('Location: index.php');
      exit;
    }
  }
  $error = 'Невірний логін або пароль';
}
include 'includes/header.php';
?>
<h2>Увійти</h2>
<?php if (!empty($error)): ?><p class="error"><?=$error?></p><?php endif; ?>
<form method="post">
  <label>Логін:<input type="text" name="username" required></label><br>
  <label>Пароль:<input type="password" name="password" required></label><br>
  <button type="submit">Увійти</button>
</form>
<?php include 'includes/footer.php'; ?>

<nav class="navbar">
  <div class="logo">
    <a href="<?php echo BASE_URL; ?>index.php">Бортовий журнал</a>
    <button class="nav-toggle" aria-label="toggle navigation">☰</button>
  </div>
  <ul class="nav-menu">
    <li><a href="<?php echo BASE_URL; ?>index.php">Головна</a></li>
    <?php if(isLoggedIn()): ?>
      <li><a href="<?php echo BASE_URL; ?>profile.php">Профіль</a></li>
      <li><a href="<?php echo BASE_URL; ?>entry.php">Новий запис</a></li>
      <li><a href="<?php echo BASE_URL; ?>logout.php">Вихід</a></li>
    <?php else: ?>
      <li><a href="<?php echo BASE_URL; ?>login.php">Увійти</a></li>
      <li><a href="<?php echo BASE_URL; ?>register.php">Реєстрація</a></li>
    <?php endif; ?>
  </ul>
</nav>

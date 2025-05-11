<?php


require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/config.php';


require_once 'functions.php';
include 'includes/header.php';
?>

<section class="journal-list-section">
  <h1>Останні записи</h1>
  <section class="journal-list">
    <?php
      $res = $mysqli->query("SELECT id, title, DATE_FORMAT(created_at, '%d.%m.%Y') AS date FROM entries ORDER BY created_at DESC");
      while ($row = $res->fetch_assoc()):
    ?>
      <article class="entry-preview">
        <a href="entry.php?id=<?= $row['id'] ?>">
          <h2><?= htmlspecialchars($row['title']) ?></h2>
          <time><?= $row['date'] ?></time>
        </a>
      </article>
    <?php endwhile; ?>
  </section>
</section>

<?php include 'includes/footer.php'; ?>

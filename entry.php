<?php
require_once 'functions.php';
include 'includes/header.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header('Location: index.php');
  exit;
}
$id = intval($_GET['id']);
$stmt = $mysqli->prepare("
  SELECT e.title, e.body, e.created_at, u.username
  FROM entries e
  JOIN users u ON e.user_id = u.id
  WHERE e.id = ?
");
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0): ?>
  <p>Запис не знайдено.</p>
<?php else:
  $row = $res->fetch_assoc(); ?>
  <article class="entry-full">
    <h1><?=htmlspecialchars($row['title'])?></h1>
    <p class="meta">
      Автор: <?=htmlspecialchars($row['username'])?> |
      <?=date('d.m.Y H:i', strtotime($row['created_at']))?>
    </p>
    <div class="body">
      <?=nl2br(htmlspecialchars($row['body']))?>
    </div>
  </article>
<?php endif;

include 'includes/footer.php';

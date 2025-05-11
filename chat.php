<?php
require_once 'functions.php';
ensureLoggedIn();

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD']==='POST') {
    // нове повідомлення
    $to   = intval($_POST['to']);
    $body = trim($_POST['body']);
    if ($body !== '') {
        $stmt = $mysqli->prepare("
          INSERT INTO messages (from_id, to_id, body) VALUES (?,?,?)
        ");
        $stmt->bind_param('iis', $_SESSION['user_id'], $to, $body);
        $stmt->execute();
    }
    exit(json_encode(['status'=>'ok']));
}

// long-poll: віддай останні N
$after = intval($_GET['after'] ?? 0);

$stmt = $mysqli->prepare("
  SELECT m.id, u.username AS from_name, m.body, m.sent_at
    FROM messages m
    JOIN users u ON m.from_id = u.id
   WHERE m.id > ?
     AND ((m.from_id=? AND m.to_id=?) OR (m.from_id=? AND m.to_id=?))
");
$uid = $_SESSION['user_id'];
$other = intval($_GET['with']);
$stmt->bind_param('iiiii', $after, $uid, $other, $other, $uid);
$stmt->execute();
$res = $stmt->get_result();
echo json_encode($res->fetch_all(MYSQLI_ASSOC));

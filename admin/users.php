<<?php
require_once __DIR__ . '/../functions.php';
ensureLoggedIn();
if (!isAdmin()) {
    header('Location: ../admin.php');
    exit;
}
?>


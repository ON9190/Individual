<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Бортовий журнал</title>
  <link rel="stylesheet" href="/project-root/assets/css/main.css">
</head>
<body>
<?php include __DIR__ . '/navbar.php'; ?>
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<?php include __DIR__ . '/sidebar.php'; ?>
<button class="sidebar-toggle" id="sidebarOpen" aria-label="Відкрити меню">&#9776;</button>
<div class="layout">
  <main class="container">

<script>

function closeSidebar() {
  sidebar.classList.remove('open');
  overlay.classList.remove('active');
}
closeBtn.addEventListener('click', closeSidebar);
overlay.addEventListener('click', closeSidebar);
</script>

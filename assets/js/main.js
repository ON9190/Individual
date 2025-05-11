document.addEventListener('DOMContentLoaded', function() {
  const sidebar = document.getElementById('sidebar');
  const openBtn = document.getElementById('sidebarOpen');
  const closeBtn = document.getElementById('sidebarClose');
  const overlay = document.getElementById('sidebarOverlay');

  // Виїжджання кнопки при підведенні курсору до краю (тільки якщо меню закрите)
  document.addEventListener('mousemove', function(e) {
    if (e.clientX < 30 && !sidebar.classList.contains('open')) {
      openBtn.classList.add('active');
    } else {
      openBtn.classList.remove('active');
    }
  });

  // Відкриття меню
  openBtn.addEventListener('click', function(e) {
    sidebar.classList.add('open');
    overlay.classList.add('active');
    openBtn.classList.add('hidden'); // Повністю сховати кнопку
  });

  // Закриття меню
  function closeSidebar() {
    sidebar.classList.remove('open');
    overlay.classList.remove('active');
    openBtn.classList.remove('hidden'); // Показати кнопку
  }
  closeBtn.addEventListener('click', closeSidebar);
  overlay.addEventListener('click', closeSidebar);
});
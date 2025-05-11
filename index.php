<?php


require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/config.php';


require_once 'functions.php';
include 'includes/header.php';
?>

<div class="main-page-layout">
  <!-- Верхній блок -->
  <section class="main-topbar">
    <h2>Гарячі теми та новинки авто</h2>
    <div class="main-topbar-content">
      <div>🔥 Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
      <div>🚗 Новинка: BMW X5 2024 вже в Україні!</div>
      <div>🛠️ ТОП-5 порад з обслуговування авто</div>
    </div>
  </section>

  <!-- Лівий блок -->
  <aside class="main-sidebar">
    <h3>Фільтри</h3>
    <ul>
      <li>Новинки</li>
      <li>Підписки</li>
      <li>AI асистент</li>
    </ul>
    <form class="sidebar-search">
      <input type="text" placeholder="Пошук за словом/маркою/моделлю">
      <select>
        <option>Виберіть марку</option>
        <option>BMW</option>
        <option>Audi</option>
        <option>Mercedes</option>
        <option>Renault</option>
        <option>Volkswagen</option>
      </select>
      <button type="submit">Пошук</button>
    </form>
    <div class="sidebar-similar">
      <h4>Схожі авто</h4>
      <ul>
        <li>BMW X3</li>
        <li>Audi Q5</li>
        <li>Mercedes GLC</li>
      </ul>
    </div>
  </aside>

  <!-- Центральний блок -->
  <main class="main-content">
    <h2>Останні дописи</h2>
    <div class="posts-grid">
      <div class="post-card">
        <h3>Lorem Ipsum Title 1</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vitae velit ex.</p>
      </div>
      <div class="post-card">
        <h3>Lorem Ipsum Title 2</h3>
        <p>Maecenas sit amet tincidunt elit. Etiam nec magna euismod, cursus nulla at, dictum ex.</p>
      </div>
      <div class="post-card">
        <h3>Lorem Ipsum Title 3</h3>
        <p>Curabitur ac lacus arcu. Sed vehicula varius lectus auctor viverra.</p>
      </div>
      <div class="post-card">
        <h3>Lorem Ipsum Title 4</h3>
        <p>Morbi a bibendum metus. Donec scelerisque sollicitudin enim eu venenatis.</p>
      </div>
    </div>
  </main>

  <!-- Правий блок -->
  <aside class="main-rightbar">
    <h3>Реклама</h3>
    <div class="ad-block">Реклама 1: Lorem ipsum dolor sit amet.</div>
    <div class="ad-block">Реклама 2: Нові авто зі знижкою!</div>
    <div class="ad-block">Реклама 3: Страхування авто онлайн.</div>
  </aside>
</div>

<?php include 'includes/footer.php'; ?>

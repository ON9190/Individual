USE drive_journal;

-- Приклад: адміністратор та демо-користувач
INSERT INTO users (username, password_hash, role) VALUES
  ('admin',  '$2y$10$SegRHknpdN0NrGDdpw.pS.QUiapOA9lPxInoW93ejsSi8dabA5yde', 'admin'),
  ('demo',   '$2y$10$examplehashfordemopassword',  'user');

-- Декілька записів для тесту
INSERT INTO entries (user_id, title, body) VALUES
  (1, 'Ласкаво просимо', 'Це перший запис у бортовому журналі.'),
  (2, 'Тестовий запис', 'Тут можна записувати будь-яку інформацію про поїздку.');

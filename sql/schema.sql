-- 1) Створюємо базу (якщо ще не створена) і одразу переходимо в неї
CREATE DATABASE IF NOT EXISTS drive_journal
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE drive_journal;

-- 2) Таблиця користувачів
CREATE TABLE IF NOT EXISTS users (
  id             INT AUTO_INCREMENT PRIMARY KEY,
  username       VARCHAR(50)  NOT NULL UNIQUE,
  password_hash  VARCHAR(255) NOT NULL,
  role           ENUM('user','admin') NOT NULL DEFAULT 'user',
  created_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3) Таблиця записів журналу
CREATE TABLE IF NOT EXISTS entries (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  user_id     INT            NOT NULL,
  title       VARCHAR(255)   NOT NULL,
  body        TEXT           NOT NULL,
  created_at  DATETIME       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

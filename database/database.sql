CREATE DATABASE IF NOT EXISTS library_demo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE library_demo;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS books (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    author VARCHAR(120) NOT NULL,
    published_year SMALLINT NULL,
    status ENUM('Available','Borrowed') NOT NULL DEFAULT 'Available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Demo login: admin@example.com / password
INSERT INTO users (name,email,password_hash) VALUES
('Library Admin','admin@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi')
ON DUPLICATE KEY UPDATE email=VALUES(email);

INSERT INTO books (title,author,published_year,status) VALUES
('Clean Code','Robert C. Martin',2008,'Available'),
('The Pragmatic Programmer','Andrew Hunt and David Thomas',1999,'Borrowed'),
('Introduction to Algorithms','Thomas H. Cormen et al.',2009,'Available');

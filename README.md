# Library Desk — PHP & MySQL Example

A small classroom demonstration of a PHP/MySQL project with a clean repository structure.

## Features
- Login with a demo account
- Session-protected dashboard
- Book totals: all, available, and borrowed
- Search books by title or author
- Add a book
- Sign out

## Stack
PHP 8+, MySQL/MariaDB, PDO, HTML, CSS, and JavaScript.

## Project structure
```text
library-management-example/
├── assets/
│   ├── script.js
│   └── style.css
├── database.php
├── database.sql
├── dashboard.php
├── index.php
├── login.php
├── logout.php
├── save_book.php
└── README.md
```

## Run with XAMPP
1. Copy this folder into `htdocs`.
2. Start Apache and MySQL.
3. Open phpMyAdmin (`http://localhost/phpmyadmin`).
4. Import `database.sql`.
5. Check the MySQL credentials in `database.php`.
6. Visit `http://localhost/library-management-example/`.

## Demo credentials
Email: `admin@example.com`  
Password: `password`

## What the files demonstrate
- `database.php`: centralized PDO database connection.
- `login.php`: credential checking and session creation.
- `dashboard.php`: protected page, database queries, and book listing.
- `save_book.php`: server-side validation and prepared INSERT statement.
- `assets/style.css`: page styling and responsive layout.
- `assets/script.js`: show/hide interaction for the add-book form.
- `database.sql`: database and sample data setup.
- `README.md`: project purpose and setup instructions.

## Scope and security note
This is a teaching demo, not a production-ready library system. A real system should add CSRF protection, role-based access, audit logging, stronger operational security, and complete borrower/transaction workflows. Never reuse the demo password or commit real credentials.

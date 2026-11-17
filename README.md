# Library Management System (Library Desk)

A web-based application for managing a library's book collection. Staff sign in, see how many books are available or borrowed, search the catalog, and add new books.

> Built with PHP and MySQL as a classroom example of a clean, well-documented repository. It is a teaching demo, not a production system.

![Library dashboard](docs/screenshots/dashboard.png)

## Tech Stack

| Layer | Technology |
|---|---|
| Frontend | HTML, CSS, JavaScript (no framework) |
| Backend | PHP 8+ with PDO |
| Database | MySQL / MariaDB |
| Development environment | XAMPP |

## Features

- **User authentication:** login with email and password (hashed passwords, session-based access)
- **Protected dashboard:** pages redirect to the login screen if you are not signed in
- **Book overview:** totals for all, available, and borrowed books
- **Book listing:** title, author, publication year, and status
- **Search:** find books by title or author
- **Book management:** add a book with server-side validation
- **Sign out:** ends the session and clears the session cookie

**Not included yet:** borrower management, borrowing/returning transactions, and transaction history.

## Project Structure

```text
library-management-example/
├── assets/
│   ├── script.js        # Show/hide the add-book form
│   └── style.css        # Styling and responsive layout
├── database.php         # PDO database connection (configuration)
├── database.sql         # Creates the database, tables, and sample data
├── index.php            # Redirects to login or dashboard
├── login.php            # Credential check and session creation
├── dashboard.php        # Protected page: stats, search, book list
├── save_book.php        # Validates and inserts a new book
├── logout.php           # Ends the session
└── README.md
```

## Getting Started

**Requirements:** [XAMPP](https://www.apachefriends.org/) (Apache, PHP 8+, MySQL) or any equivalent PHP and MySQL setup.

1. **Clone the repository** into XAMPP's `htdocs` folder:
   ```bash
   git clone https://github.com/<your-username>/library-management-example.git
   ```
2. **Start Apache and MySQL** from the XAMPP Control Panel.
3. **Import the database:** open [phpMyAdmin](http://localhost/phpmyadmin), go to the **Import** tab, and select `database.sql`. This creates the `library_demo` database with sample data.
4. **Configure the database connection** in `database.php` if your setup differs from the XAMPP defaults:
   ```php
   $host = '127.0.0.1';
   $dbname = 'library_demo';
   $username = 'root';
   $password = '';
   ```
5. **Open the app** in your browser: <http://localhost/library-management-example/>

### Demo Account

| Email | Password |
|---|---|
| `admin@example.com` | `password` |

Use this account for local testing only, and never reuse it or commit real credentials.

## Security Note

Passwords are hashed, database queries use prepared statements, and output is escaped. However, this demo does not yet include CSRF protection or role-based access, so it should not be deployed publicly as-is.

<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
require_once __DIR__ . '/database.php';

$search = trim($_GET['search'] ?? '');
if ($search !== '') {
    $stmt = $pdo->prepare('SELECT * FROM books WHERE title LIKE :q OR author LIKE :q ORDER BY title');
    $stmt->execute(['q' => '%' . $search . '%']);
} else {
    $stmt = $pdo->query('SELECT * FROM books ORDER BY title');
}
$books = $stmt->fetchAll();
$total = (int)$pdo->query('SELECT COUNT(*) FROM books')->fetchColumn();
$available = (int)$pdo->query("SELECT COUNT(*) FROM books WHERE status='Available'")->fetchColumn();
$borrowed = (int)$pdo->query("SELECT COUNT(*) FROM books WHERE status='Borrowed'")->fetchColumn();
function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard | Library Desk</title><link rel="stylesheet" href="assets/style.css">
<script src="assets/script.js" defer></script>
</head>
<body>
<header class="topbar">
    <a class="brand" href="dashboard.php"><span class="brand-mark small">LD</span> Library Desk</a>
    <div class="topbar-right"><span class="welcome">Hello, <?= e($_SESSION['user_name'] ?? 'User') ?></span><a href="logout.php">Sign out</a></div>
</header>
<main class="container">
    <section class="page-heading">
        <div><p class="eyebrow">OVERVIEW</p><h1>Library dashboard</h1><p class="muted">A simple view of your library collection.</p></div>
        <button class="button" id="showAddForm" type="button">+ Add a book</button>
    </section>
    <section class="stats-grid">
        <article class="stat-card"><span>Total books</span><strong><?= $total ?></strong></article>
        <article class="stat-card"><span>Available</span><strong><?= $available ?></strong></article>
        <article class="stat-card"><span>Borrowed</span><strong><?= $borrowed ?></strong></article>
    </section>
    <section class="panel" id="addBookPanel" hidden>
        <div class="panel-heading"><div><p class="eyebrow">NEW RECORD</p><h2>Add a book</h2></div><button class="icon-button" id="hideAddForm" type="button">×</button></div>
        <form class="book-form" method="post" action="save_book.php">
            <label>Title<input name="title" maxlength="150" required></label>
            <label>Author<input name="author" maxlength="120" required></label>
            <label>Year<input name="published_year" type="number" min="1000" max="2100" value="2026"></label>
            <label>Status<select name="status"><option>Available</option><option>Borrowed</option></select></label>
            <button class="button">Save book</button>
        </form>
    </section>
    <section class="panel">
        <div class="panel-heading"><div><p class="eyebrow">COLLECTION</p><h2>Books</h2></div>
            <form class="search-form" method="get"><input type="search" name="search" value="<?= e($search) ?>" placeholder="Search title or author"><button class="button button-secondary">Search</button></form>
        </div>
        <?php if (!$books): ?><p class="empty-state">No books found. Add a book or try another search.</p>
        <?php else: ?><div class="table-wrap"><table>
            <thead><tr><th>Title</th><th>Author</th><th>Year</th><th>Status</th></tr></thead><tbody>
            <?php foreach ($books as $book): ?><tr>
                <td class="book-title"><?= e($book['title']) ?></td><td><?= e($book['author']) ?></td>
                <td><?= e($book['published_year'] ?? '—') ?></td>
                <td><span class="status <?= $book['status']==='Available'?'available':'borrowed' ?>"><?= e($book['status']) ?></span></td>
            </tr><?php endforeach; ?>
            </tbody></table></div><?php endif; ?>
    </section>
    <p class="footer-note">Library Desk · PHP and MySQL classroom example</p>
</main>
</body></html>

<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
require_once __DIR__ . '/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: dashboard.php'); exit; }

$title = trim($_POST['title'] ?? '');
$author = trim($_POST['author'] ?? '');
$yearInput = trim($_POST['published_year'] ?? '');
$status = $_POST['status'] ?? 'Available';

if ($title === '' || $author === '' || !in_array($status, ['Available', 'Borrowed'], true)) {
    http_response_code(400); exit('Invalid book details. Go back and check the form.');
}
$year = $yearInput === '' ? null : filter_var($yearInput, FILTER_VALIDATE_INT);
if ($yearInput !== '' && ($year === false || $year < 1000 || $year > 2100)) {
    http_response_code(400); exit('Enter a valid publication year.');
}
$stmt = $pdo->prepare('INSERT INTO books (title, author, published_year, status) VALUES (:title,:author,:year,:status)');
$stmt->execute(['title'=>$title, 'author'=>$author, 'year'=>$year, 'status'=>$status]);
header('Location: dashboard.php');
exit;

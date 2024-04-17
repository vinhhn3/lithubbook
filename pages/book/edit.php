<?php
session_start(); // start a session

if (!isset($_SESSION['user_id'])) {
    header('Location: ../user/login.html'); // redirect to login page if $email is not in the session
    exit;
}

if (!isset($_GET['id'])) {
    echo 'something went wrong';
    exit;
}

$id = $_GET['id'];

// pdo instance

$host = 'localhost';
$db   = 'lithubbook';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

// Assuming you have a PDO instance $pdo
$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

if (!$book) {
    echo 'Book not found';
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
</head>
<body>
    <form method="post" action="../../services/book/update.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($book['id']) ?>">
        Title: <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>"><br>
        Author: <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>"><br>
        Price: <input type="number" name="price" value="<?= htmlspecialchars($book['price']) ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
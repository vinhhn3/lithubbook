<?php
function connectToDatabase()
{
  $host = 'localhost';
  $db = 'lithubbook';
  $user = 'root';
  $pass = '';
  $charset = 'utf8mb4';

  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  $opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ];
  return new PDO($dsn, $user, $pass, $opt);
}

function login($email, $password)
{
  $pdo = connectToDatabase();

  $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
  $stmt->execute([$email, $password]);
  $user = $stmt->fetch();

  if ($user) {
    $_SESSION['user_id'] = $user['id'];
    return true;
  } else {
    return false;
  }
}

session_start(); // start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (login($email, $password)) {
    header('Location: ../../pages/book/books.php');
  } else {
    echo 'Invalid email or password';
  }
}

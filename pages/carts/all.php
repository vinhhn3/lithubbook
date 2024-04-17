<!-- Display all carts of the user -->

<?php

session_start(); // start a session

if (!isset($_SESSION['user_id'])) {
  echo ("Not authrozied");
  exit;
}

// pdo instance

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
$pdo = new PDO($dsn, $user, $pass, $opt);

// Prepare the statement

$stmt = $pdo->prepare('SELECT * FROM carts WHERE user_id = :user_id');
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!-- // Render the carts -->

<!DOCTYPE html>
<html>

<head>
  <title>Carts</title>
</head>

<body>
  <h1>Carts</h1>
  <a href="">Add new Cart</a>
  <table>
    <?php
    if ($result): ?>
      <tr>
        <th>Cart Id</th>
        <th>User Id</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
      <?php while ($result): ?>
        <tr>
          <?php foreach ($result as $value): ?>
            <td>
              <?php echo htmlspecialchars($value); ?>
            </td>
          <?php endforeach; ?>
          <td>
            <a href="">View Details</a>
            <a href="" class="btn btn-primary">Delete Cart</a>
          </td>
        </tr>
        <?php $result = $stmt->fetch(PDO::FETCH_ASSOC); ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </table>
</body>

</html>
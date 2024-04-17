<?php
session_start(); // start a session

if (!isset($_SESSION['user_id'])) {
  echo ("Not authrozied");
  exit;
}

// use mysqli to connection
$host = 'localhost';
$db = 'lithubbook';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
// Connect to the database

$db = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($db, "SELECT * FROM favorites WHERE user_id = " . $_SESSION['user_id']);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <table>
    <tr>
      <th>User ID</th>
      <th>Book ID</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?php echo $row['user_id']; ?></td>
        <td><?php echo $row['book_id']; ?></td>
        <td>
          <a href="../../services/favorites/remove.php?book_id=<?php echo $row['book_id'] ?>" class="btn btn-danger">
            Remove
          </a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>

</html>
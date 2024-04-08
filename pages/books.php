<?php
session_start(); // start a session

if (!isset($_SESSION['email'])) {
    header('Location: login.html'); // redirect to login page if $email is not in the session
    exit;
}

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'lithubbook');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select all books
$result = mysqli_query($db, "SELECT * FROM books");
?>
<!-- Todo: display all books with add to cart button -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Document</title>
  </head>
  <body>
    <h1>Books</h1>
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Price</th>
            <th scope="col">Add to Cart</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <th scope="row"><?php echo $row['id']; ?></th>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><button class="btn btn-primary">Add to Cart</button></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
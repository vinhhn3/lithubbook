

<!-- Insert to table -->

<!-- Redirect to books.php if insert is successful -->

<?php

$title = $_POST['title'];
$author = $_POST['author'];
$price = $_POST['price'];

echo $title . " " . $author . $price; // print to screen

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'lithubbook');

// Check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

// Prepare sql statement
$sql = "INSERT INTO books (title, author, price) VALUES ('$title', '$author', '$price')";

// Insert book to database

if ($db->query($sql) === TRUE) {
  echo "New record created successfully";
  header('Location: ../../pages/book/books.php');
} else {
  echo "Created failed";
}

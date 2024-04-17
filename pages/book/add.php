<!-- Design the HTML form to add new book  -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add new Book</title>
</head>

<body>
  <h1>Adding new Book</h1>
  <form action="/lithubbook/services/book/add.php" method="post">
    <div>
      <label>Title:</label>
      <input type="text" name="title" />
    </div>
    <div>
      <label>Author:</label>
      <input type="text" name="author" />
    </div>
    <div>
      <label>Price:</label>
      <input type="number" name="price" />
    </div>
    <button type="submit">Add new book</button>
  </form>
</body>

</html>
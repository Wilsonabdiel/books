<?php
include_once 'db_connect.php';

// CREATE Operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $publication = $_POST['publication'];

    $sql = "INSERT INTO books (title, author, genre, publication) VALUES ('$title', '$author', '$genre', '$publication')";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// READ Operation
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);

// UPDATE Operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $publication = $_POST['publication'];

    $sql = "UPDATE books SET title='$title', author='$author', genre='$genre', publication='$publication' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// DELETE Operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM books WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Collection</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Book Collection</h2>

        <!-- Add Book Form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Author:</label>
                <input type="text" name="author" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Genre:</label>
                <input type="text" name="genre" class="form-control">
            </div>
            <div class="form-group">
                <label>Publication Year:</label>
                <input type="number" name="publication" class="form-control">
            </div>
            <button type="submit" name="create" class="btn btn-primary">Add Book</button>
        </form>
        <hr>

        <!-- Display Book List -->
        <h3>Book List</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Publication Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['author']; ?></td>
                        <td><?php echo $row['genre']; ?></td>
                        <td><?php echo $row['publication']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Edit Book Form -->
<?php if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_sql = "SELECT * FROM books WHERE id=$id";
    $edit_result = mysqli_query($conn, $edit_sql);
    $edit_row = mysqli_fetch_assoc($edit_result);
?>

<script>
        // Scroll down to the "Edit Book Form" section when the page loads
        window.onload = function() {
            document.getElementById('edit-book-section').scrollIntoView({ behavior: 'smooth' });
        };
</script>

    <div id="edit-book-section"></div>

    <h3>Edit Book</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $edit_row['id']; ?>">
        <div class="form-group">
            <label>Title:</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($edit_row['title']); ?>" required>
        </div>
        <div class="form-group">
            <label>Author:</label>
            <input type="text" name="author" class="form-control" value="<?php echo htmlspecialchars($edit_row['author']); ?>" required>
        </div>
        <div class="form-group">
            <label>Genre:</label>
            <input type="text" name="genre" class="form-control" value="<?php echo htmlspecialchars($edit_row['genre']); ?>">
        </div>
        <div class="form-group">
            <label>Publication Year:</label>
            <input type="number" name="publication" class="form-control" value="<?php echo htmlspecialchars($edit_row['publication']); ?>">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update Book</button>
    </form>
<?php } ?>

